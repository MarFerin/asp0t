<?php
require_once("libraries/TeamSpeak3/TeamSpeak3.php");
include 'tsinfo.php';
if (isset($_POST['createTeamspeak'])) {
    $output = '{"Error":"10","Response":"Invalid Password"}';
    $receiveData = $_POST['createTeamspeak'];
    if($receiveData["Passkey"]=="aspot_22"){
        $output = createTeamspeak($receiveData);
    }
    echo $output;
}
if (isset($_POST['checkTSDNS'])) {
    $receiveData = $_POST['checkTSDNS'];
    $output = '{"Error":"0","Response":"Valid Subdomain"}';
    if(!is_valid_domain_name($receiveData['Subdomain']) || strlen($receiveData['Subdomain'])>30){
        $output = '{"Error":"2","Response":"Invalid Subdomain"}';
    }
    if(!checkIfValid($receiveData['Subdomain'],getDomain($receiveData['Domain']))){
        $output = '{"Error":"3","Response":"Subdomain Taken"}';
    }
    echo $output;
}
if (isset($_POST['updateTSDNS'])) {
    $receiveData = $_POST['updateTSDNS'];
    if($receiveData["Passkey"]!="aspot_22"){
        return '{"Error":"10","Response":"Invalid Password"}';
    }
    if(!is_valid_domain_name($receiveData['cSubdomain']) || strlen($receiveData['cSubdomain'])>30){
        return '{"Error":"2","Response":"Invalid Subdomain"}';
    }
    if(checkIfValid($receiveData['cSubdomain'],getDomain($receiveData['cDomain']))){
        return '{"Error":"4","Response":"Subdomain Does Not Exist"}';
    }
    if(!is_valid_domain_name($receiveData['nSubdomain']) || strlen($receiveData['nSubdomain'])>30){
        return '{"Error":"2","Response":"Invalid Subdomain"}';
    }
    if(!checkIfValid($receiveData['nSubdomain'],getDomain($receiveData['nDomain']))){
        return'{"Error":"3","Response":"Subdomain Taken"}';
    }
    $output = updateTSDNS($receiveData);
    echo $output;
}
if (isset($_POST['manageTeamspeaks'])) {
    $receiveData = $_POST['manageTeamspeaks'];
    if($receiveData["Passkey"]=="aspot_89"){
        //deleteInactive();
        $inipath = "/home/ts3srv/tsdns/tsdns_settings.ini";
        $config_array  = parse_ini_file($inipath);
        $ts3_ServerInstance = TeamSpeak3::factory($query);
        $listofservers = array();
        $serverList = $ts3_ServerInstance->serverList();
        foreach($serverList as $ts3_VirtualServer){
            $serverID = (string)$ts3_VirtualServer->virtualserver_id;
            $serverName = (string)$ts3_VirtualServer->virtualserver_name;
            $serverPort = (string)$ts3_VirtualServer->virtualserver_port;
            $serverSlots = (string)$ts3_VirtualServer->virtualserver_maxclients;
            $serverClients = (string)$ts3_VirtualServer->clientCount();
            $subdomain = array_keys($config_array, '52.233.128.182:'.$serverPort);
            $listofservers[$serverID]=array("Name"=>$serverName,"Subdomain"=>$subdomain,"Port"=>$serverPort,"Online"=>$serverClients,"Slots"=>$serverSlots);
        }
        $ts3_ServerInstance->logout();
        $listofservers = array_values($listofservers);
        echo json_encode($listofservers);
    }
}
if (isset($_POST['deleteTeamspeak'])) {
    $receiveData = $_POST['deleteTeamspeak'];
    if($receiveData["Passkey"]=="aspot_89"){
        deleteTeamspeak($receiveData["Port"]);
        echo '{"Error":"0"}';
    }
}
if (isset($_POST['resetTeamspeak'])) {
    $receiveData = $_POST['resetTeamspeak'];
    if($receiveData["Passkey"]=="aspot_89"){
        $token = resetTeamspeak($receiveData["Port"]);
        echo '{"Error":"0","Token":"'.$token.'"}';
    }
}
if (isset($_POST['checkActivity'])) {
    $receiveData = $_POST['deleteTeamspeak'];
    if($receiveData["Passkey"]=="aspot_89"){
        $returnData = checkActivity();
        echo json_encode($returnData);
    }
}
if (isset($_POST['viewTeamspeak'])) {
    $receiveData = $_POST['viewTeamspeak'];
    if($receiveData["Passkey"]=="aspot_89"){
        $ts3_VirtualServer = TeamSpeak3::factory($query."?server_port=".$receiveData["Port"]);
        echo $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("/images/viewericons/", "/images/countryflags/", "data:image"));
    }
}
if (isset($_POST['createAccount'])) {
    //$conn = new mysqli($servername, $username, $password, $dbname);
    //$receiveData = $_POST['createAccount'];
    //$sql = "INSERT INTO userinfo (firstname, lastname, email)
    //VALUES ('John', 'Doe', 'john@example.com')";

}

function addTSDNS($subdomain, $domain, $port) {
    $inipath = "/home/ts3srv/tsdns/tsdns_settings.ini";
    $config_array  = parse_ini_file($inipath);
    $config_array[strtolower($subdomain).$domain] = "52.233.128.182:".$port;
    write_php_ini($config_array,$inipath);
    $shell_output = shell_exec("sudo /home/ts3srv/tsdns/tsdnsserver --update");
    return '{"ShellOutput":"'.$shell_output.'"}';
}
function updateTSDNS($receiveData){
    $inipath = "/home/ts3srv/tsdns/tsdns_settings.ini";
    $config_array  = parse_ini_file($inipath);
    $config_array[strtolower($receiveData['nSubdomain']).getDomain($receiveData['nDomain'])] = $config_array[strtolower($receiveData['cSubdomain']).getDomain($receiveData['cDomain'])];
    unset($config_array[strtolower($receiveData['cSubdomain']).getDomain($receiveData['cDomain'])]);
    write_php_ini($config_array,$inipath);
    $shell_output = shell_exec("sudo /home/ts3srv/tsdns/tsdnsserver --update");
    return '{"ShellOutput":"'.$shell_output.'"}';
}
function write_php_ini($array, $file){
    $res = array();
    foreach($array as $key => $val){
        if(is_array($val)){
            $res[] = "[$key]";
            foreach($val as $skey => $sval) $res[] = "$skey=".(is_numeric($sval) ? $sval : ''.$sval.'');
        }
        else $res[] = "$key=".(is_numeric($val) ? $val : ''.$val.'');
    }
    safefilerewrite($file, implode("\r\n", $res));
}

function safefilerewrite($fileName, $dataToSave){
    if ($fp = fopen($fileName, 'w')){
        $startTime = microtime(TRUE);
        do{
            $canWrite = flock($fp, LOCK_EX);
            // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
            if(!$canWrite) usleep(round(rand(0, 100)*1000));
        } while ((!$canWrite)and((microtime(TRUE)-$startTime) < 5));

        //file was locked so now we can store information
        if ($canWrite){
            fwrite($fp, $dataToSave);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

}
function getDomain($value){
    if($value==1){
        return ".agarspot.com";
    }
    elseif($value==2){
        return ".tshub.io";
    }
    elseif($value==3){
        return ".ogarhub.io";
    }
    else{
        return ".agarspot.com";
    }
}

function is_valid_domain_name($domain_name){
    return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
            && preg_match("/^.{1,253}$/", $domain_name) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
}
function checkIfValid($subdomain, $domain){
    $inipath = "/home/ts3srv/tsdns/tsdns_settings.ini";
    $config_array  = parse_ini_file($inipath);
    foreach($config_array as $key => $value){
        if($key==strtolower($subdomain).$domain){
            return false;
        }
    }
    return true;
}
function checkActivity(){
    global $query;
    $inactiveServers = array();
    $ts3_ServerInstance = TeamSpeak3::factory($query);
    $serverList = $ts3_ServerInstance->serverList();
    foreach($serverList as $ts3_VirtualServer){
        $clientsOnline = $ts3_VirtualServer->clientCount();
        if($clientsOnline==0){
            $clientCount = $ts3_VirtualServer->clientCountDb();
            $arr_ClientList = $ts3_VirtualServer->clientListDb(0,$clientCount);
            $inactive = true;
            foreach($arr_ClientList as $client){
               $seconds = time() - $client['client_lastconnected'];
               $days    = floor($seconds / 86400);
               if($days<4){
                   $inactive=false;
               }
            }
            if($inactive){
                $serverID = (string)$ts3_VirtualServer->virtualserver_id;
                array_push($inactiveServers,$serverID);
            }   
        }
    }
    $ts3_ServerInstance->logout();
    return $inactiveServers;
}
function deleteInactive(){
    global $query;
    $inactiveServers = checkActivity();
    $inipath = "/home/ts3srv/tsdns/tsdns_settings.ini";
    $config_array  = parse_ini_file($inipath);
    $ts3_ServerInstance = TeamSpeak3::factory($query);
    foreach($inactiveServers as $sid){
        $port = $ts3_ServerInstance->serverGetPortById($sid);
        $ts3_ServerInstance->serverStop($sid);
        $ts3_ServerInstance->serverDelete($sid);
        $subdomains = array_keys($config_array, '52.233.128.182:'.$port);
        if(count($subdomains)>0){
            foreach($subdomains as $subdomain){
                unset($config_array[$subdomain]);
            }
        }
    }
    write_php_ini($config_array,$inipath);
    shell_exec("sudo /home/ts3srv/tsdns/tsdnsserver --update");
    $ts3_ServerInstance->logout();
}
function deleteTeamspeak($port) {
    global $query;
    $inipath = "/home/ts3srv/tsdns/tsdns_settings.ini";
    $config_array  = parse_ini_file($inipath);
    $ts3_ServerInstance = TeamSpeak3::factory($query);
    $sid = $ts3_ServerInstance->serverIdGetByPort($port);
    $ts3_ServerInstance->serverStop($sid);
    $ts3_ServerInstance->serverDelete($sid);
    $ts3_ServerInstance->logout();
    $subdomains = array_keys($config_array, '52.233.128.182:'.$port);
    if(count($subdomains)>0){
        foreach($subdomains as $subdomain){
            unset($config_array[$subdomain]);
        }
        write_php_ini($config_array,$inipath);
        shell_exec("sudo /home/ts3srv/tsdns/tsdnsserver --update");
    }
}
function resetTeamspeak($port) {
    global $query;
    $ts3_ServerInstance = TeamSpeak3::factory($query);
    $ts3_VirtualServer = $ts3_ServerInstance->serverGetByPort($port);
    $serverID = $ts3_VirtualServer->virtualserver_id;
    $serverName = $ts3_VirtualServer->virtualserver_name;
    $serverSlots = $ts3_VirtualServer->virtualserver_maxclients;
    $ts3_ServerInstance->serverDeselect();
    $ts3_ServerInstance->serverStop($serverID);
    $ts3_ServerInstance->serverDelete($serverID);
    $new_sid = $ts3_ServerInstance->serverCreate(array(
        "virtualserver_name"               => $serverName,
        "virtualserver_maxclients"         => $serverSlots,
        "virtualserver_port"               => $port
    ));
    $ts3_VirtualServer = $ts3_ServerInstance->serverGetById($new_sid["sid"]);
    include("ClanTemplate.php");
    createClanChannels($ts3_VirtualServer);
    createClanPermissions($ts3_VirtualServer);
    $serverToken = $new_sid["token"];
    return $serverToken;
}
function createTeamspeak($teamspeakData) {
    global $query;
    if(strlen($teamspeakData["ServerName"])>30){
        return '{"Error":"1","Response":"Invalid Server Name"}';
    }
    if(!is_valid_domain_name($teamspeakData["Subdomain"]) || strlen($teamspeakData["Subdomain"])>30){
        return '{"Error":"2","Response":"Invalid Subdomain"}';
    }
    if(!checkIfValid($teamspeakData["Subdomain"],getDomain($teamspeakData["Domain"]))){
        return '{"Error":"3","Response":"Subdomain Taken"}';
    }
    if(!is_numeric($teamspeakData["Slots"]) || $teamspeakData["Slots"]>500){
        return '{"Error":"5","Response":"Too many slots"}';
    }
    $ts3_ServerInstance = TeamSpeak3::factory($query);
    $ts3_ServerInstance->setPredefinedQueryName("server");
    $numberOfServers = count($ts3_ServerInstance);
    $portList = range(9001,9001+count($ts3_ServerInstance));
    foreach($ts3_ServerInstance as $ts3_VirtualServer){
        $tempserverPort = $ts3_VirtualServer->virtualserver_port;
        if($tempserverPort == 9987){
            continue;
        }
        if (($key = array_search($tempserverPort, $portList)) !== false) {
            unset($portList[$key]);
        }
    }
    $portList = array_values($portList);
    $serverPort = $portList[0];
    $new_sid = $ts3_ServerInstance->serverCreate(array(
        "virtualserver_name"               => $teamspeakData["ServerName"],
        "virtualserver_maxclients"         => $teamspeakData["Slots"],
        "virtualserver_port"               => $serverPort
    ));
    $serverToken = $new_sid["token"];
    $ts3_VirtualServer = $ts3_ServerInstance->serverGetById($new_sid["sid"]);
    $ts3_ServerGroup = $ts3_VirtualServer->serverGroupGetByName("Owner");
    if($teamspeakData["TeamspeakStyle"]==1||$teamspeakData["TeamspeakStyle"]==2){
        if($teamspeakData["TeamspeakStyle"]==1){
            include("ClanTemplate.php");
            createClanChannels($ts3_VirtualServer);
            createClanPermissions($ts3_VirtualServer);
        }
        else{

        }
    }
    if($teamspeakData["ClientPerms"]=="true"){
        $ts3_ServerGroup->permAssign("b_virtualserver_client_permission_list", 1);
        $ts3_ServerGroup->permAssign("i_needed_modify_power_virtualserver_client_permission_list", 75);
    }
    if($teamspeakData["ChannelClientPerms"]=="true"){
        $ts3_ServerGroup->permAssign("b_virtualserver_channelclient_permission_list", 1);
        $ts3_ServerGroup->permAssign("i_needed_modify_power_virtualserver_channelclient_permission_list", 75);
    }
    
    $ts3_VirtualServer->logout();
    addTSDNS($teamspeakData["Subdomain"],getDomain($teamspeakData["Domain"]),$serverPort);
    return '{"Error":"0","Response":{"URL":"'.$teamspeakData["Subdomain"].getDomain($teamspeakData["Domain"]).'","token":"'.$serverToken.'","port":"'.$serverPort.'"}}';
}
?>