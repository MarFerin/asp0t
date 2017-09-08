$(function() {
    getServerList();
    $viewTsBack = $('#viewts').children().last();
    $viewTsBack.click(function(){
        location.hash = '#managets';
    });
    $viewTsBack.removeClass("close");
    $viewTsBack.addClass("back");
    $viewClientBack = $('#viewclient').children().last()
    $viewClientBack.click(function(){
        location.hash = '#viewts';
    });
    $viewClientBack.removeClass("close");
    $viewClientBack.addClass("back");
    location.hash = '#';
});
var sensitivePass = "aspot_89";
function runAjaxQuery(){
    var sendJson = {"Passkey":sensitivePass};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {ajaxQuery:sendJson},
        success: function(data) {
            var p = 0;
        }
    });
}
function viewTeamspeak(elem){
    var port = elem.childNodes[0].rows[0].cells[1].innerHTML;
    var sendJson = {"Port":port, "Passkey":sensitivePass};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "html",
        data: {viewTeamspeak:sendJson},
        success: function(data) {
            $('#viewtsdiv').empty();
            $('#viewtsdiv').append(data);
            $('table.client').prop('draggable',true);
            $('table.client').on('dragstart',function(e){
                var elemId = this.id;
                var sid = parseInt(elemId.substr(7,elemId.indexOf("_cl")-7));
                var clid = parseInt(elemId.substr(elemId.indexOf("cl")+2));
                var sendJson = {"sid":sid,"clid":clid,"id":elemId};
                e.originalEvent.dataTransfer.setData('text/plain', JSON.stringify(sendJson));
            });
            $('table.channel,table.spacer').on('dragenter',function(){
                $(this).addClass('drag-over');
            });
            $('table.channel,table.spacer').on('dragleave',function(){
                $(this).removeClass('drag-over');
            });
            $('table.channel,table.spacer').on('dragover',function(e){
                e.preventDefault();
            });
            $('table.channel,table.spacer').on('drop',function(e,ui){
                $(this).removeClass('drag-over');
                var data = e.originalEvent.dataTransfer.getData("text/plain");
                var jsonData = JSON.parse(data);
                var cid = $(this).attr('summary');
                var elemId = this.id;
                var sendJson = {"sid":jsonData.sid, "clid":jsonData.clid, "cid":cid, "Passkey":sensitivePass};
                $.ajax({
                    type: "POST",
                    url: "/ajax.php",
                    dataType: "json",
                    data: {moveClient:sendJson},
                    success: function(data) {
                        $('#'+jsonData.id).insertAfter('#'+elemId);
                    }
                });

            });
            $('table.client').click(function() {
                elemId = this.id;
                $('#viewclientdiv').empty();
                var $clientTable = $(this).clone();
                $clientTable.css({'margin-bottom': "1rem",'border-bottom': "solid grey 1px"});
                $clientTable.removeClass("client");
                $clientTable.children()[0].rows[0].cells[0].remove();
                $clientTable.appendTo("#viewclientdiv");
                clid = parseInt(elemId.substr(elemId.indexOf("cl")+2));
                sid = parseInt(elemId.substr(7,elemId.indexOf("_cl")-7));
                getClientInfo(sid,clid);
                location.hash = '#viewclient';
            })
            location.hash = '#viewts';
        }
    });
}
function getClientInfo(sid,clid){
    var sendJson = {"sid":sid, "clid":clid, "Passkey":sensitivePass};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {getClientInfo:sendJson},
        success: function(data) {
            $('#viewclientdiv').append('<div id="serverGroups" class="field half first"></div>');
            for(i = 0;i<data["All Groups"].length;i++){
                $('#serverGroups').append('<input type="checkbox" id="sg'+data["All Groups"][i]+'" name="sg'+
                data["All Groups"][i]+'">'+
                '<label style="width:100%" for="sg'+data["All Groups"][i]+'">'+(data["Icons"][i]==null?'':('<img src="'+data["Icons"][i]+
                '" style="vertical-align: middle; width: 16px; height: 16px"> '))+data["Group Names"][i]+'</label>');
            }
            $('#serverGroups').append('<button id="applyGroups" style="margin-top: 0.4rem;" onclick="applyGroups('+sid+','+clid+')">Apply</button>');
            for(i = 0;i<data["Client Groups"].length;i++){
                $('#sg'+data["Client Groups"][i]).prop('checked', true);
            }
            $('#viewclientdiv').append('<div id="info" class="field half"></div>');
            $('#info').append('<label style="margin-bottom: 0px;">Version:</label>');
            $('#info').append('<p style="margin: 0 0 1.2rem 0">'+data["Version"]+'</p>');
            $('#info').append('<label style="margin-bottom: 0px;">Online since:</label>');
            $('#info').append('<p style="margin: 0 0 1.2rem 0">'+data["Online Since"]+'</p>');
            $('#info').append('<label style="margin-bottom: 0px;">Idle Time:</label>');
            $('#info').append('<p style="margin: 0 0 1.2rem 0">'+data["Idle Time"]+'</p>');
        }
    });
}
function applyGroups(sid,clid){
    var groups = {};
    var serverGroups = $('#serverGroups').children();
    for(i=0;i<serverGroups.length-1;i+=2){
        groups[parseInt(($(serverGroups[i]).attr('id')).substring(2))] = $(serverGroups[i]).is(':checked');
    }
    var sendJson = {"sid":sid, "clid":clid, "Passkey":sensitivePass, "groups":groups};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {applyGroups:sendJson},
        success: function(data) {
            var z = data;
        }
    });
}
function deleteInactive(){
    var sendJson = {"Passkey":sensitivePass};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {deleteInactive:sendJson},
        success: function(data) {
            swal({
                title: data["Count"]+" teamspeaks deleted.",
                type: "success",
                allowOutsideClick: true,
                showConfirmButton: true
            });
        }
    });
}
function editts(port){
    var sendJson = {"Port":port, "Passkey":sensitivePass};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {getTeamspeakData:sendJson},
        success: function(data) {
            var subdomain, domain;
            $('#eserver-name').val(data["Name"]);
            $('#eslots').val(data["Slots"]);
            if(data["Subdomain"][0].includes(".agarspot.com")){
                subdomain = data["Subdomain"][0].substring(0,(data["Subdomain"][0].length-13));
                $('#eserver-subdomain').val(subdomain);
                $('#edomain-name').val(1);
                domain = 1;
            }
            else{
                subdomain = data["Subdomain"][0].substring(0,(data["Subdomain"][0].length-11));
                $('#eserver-subdomain').val(subdomain);
                $('#edomain-name').val(3);
                domain = 3;
            }
            if(data["clientPerms"]){
                $('#eclient-permissions').prop('checked', true);
            }
            if(data["channelClientPerms"]){
                $('#echannel-client-permissions').prop('checked', true);
            }
            location.hash = '#editts';
            $('#edit').click(function(){applyedit(port,subdomain,domain);});
        }
    });
}
function applyedit(port,subdomain,domain){
    if(evalidation()){
        var sendJson = {"Passkey":sensitivePass, "Port":port, "cDomain":domain, "cSubdomain":subdomain, "ServerName":$('#eserver-name').val(), 
                "Slots":$('#eslots').val(),"nDomain":$('#edomain-name').val(), "nSubdomain":$('#eserver-subdomain').val(), 
                "ClientPerms":$('#eclient-permissions').is(':checked'), "ChannelClientPerms":$('#echannel-client-permissions').is(':checked')};
        $.ajax({
            type: "POST",
            url: "/ajax.php",
            dataType: "json",
            data: {applyEdit:sendJson},
            success: function(data) {
                if(data["Error"]==0){
                    $("#edit").off('click'); 
                    $("#edit").click(function(){applyedit(port,$('#eserver-subdomain').val(),$('#edomain-name').val());});
                }
                else{
                }
            }
        });
    }
}
function deletets(port){
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this teamspeak!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete it!",
            closeOnConfirm: true
        },
        function(){
            var sendJson = {"Port":port, "Passkey":sensitivePass};
            $.ajax({
                type: "POST",
                url: "/ajax.php",
                dataType: "json",
                data: {deleteTeamspeak:sendJson},
                success: function(data) {
                    $('#managetsdiv > #'+port).remove();
                }
            });
    });
}
function resetts(port){
    swal({
        title: "Are you sure?",
        text: "All data will be reset.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Reset it!",
        closeOnConfirm: false
    },
    function(){
        var sendJson = {"Port":port, "Passkey":sensitivePass};
        $.ajax({
            type: "POST",
            url: "/ajax.php",
            dataType: "json",
            data: {resetTeamspeak:sendJson},
            success: function(data) {
                $('#'+port).detach().appendTo("#managetsdiv");
                $(document).scrollTop($(document).height());
                var token = data["Token"];
                $('#url-to-copy').val(token);
                swal({
                    title: "",
                    text: 'Key: <code style="font-size: 14px">'+token+'</code><button id="copyCode" class="button icon copy fa-clipboard" onclick="copyURL()" style="display:inline;font-size: 14px;padding: 0 0.5em 0 0.5em;margin: 0px"></button>',
                    html: true,
                    type: "success",
                    allowOutsideClick: true,
                    showConfirmButton: false
                });
                $("#copyCode")[0].onclick = null;
                $("#copyCode").attr('onclick','copyURL()');
            }
        });
    });
}
function getServerList(){
    var sendJson = {"Passkey":sensitivePass};
    $.ajax({
        type: "POST",
        url: "/ajax.php",
        dataType: "json",
        data: {manageTeamspeaks:sendJson},
        success: function(data) {
            $('#managetsdiv').empty();
            $('#managetsdiv').append('<table width=100% style="border-bottom:1px solid white"><tr><td style="font-weight:bold; width:13rem">'+
                'Server Name</td><td style="width: 3rem; font-weight:bold">Port</td><td style="width: 3rem;'+
                ' font-weight:bold">Slots</td><td style="font-weight:bold">'+
                'Subdomain</td><td style="width: 4rem;font-weight:bold">Tools</td><tr></table>');
            for(i=0;i<data.length;i++){
                $('#managetsdiv').append('<table id="'+data[i].Port+'" style="width: 100%; align-items: center; vertical-align: middle;'+
                    ' border-bottom:1px solid #525252"><tr><td class="serverList" onclick="viewTeamspeak(this)" style="vertical-align: middle"><table>'+
                    '<tr><td class="serverName">'+
                    data[i].Name+'</td><td style="width: 3rem">'+data[i].Port+'</td><td style="width: 3rem">'+
                    data[i].Online+'/'+data[i].Slots+'</td><td class="serverSubdomain">'+
                    data[i].Subdomain[0]+'</td></tr></table></td><td><a href="ts3server://104.45.30.123:'+data[i].Port+'" class="tool icon fa-paper-plane"></a>'+
                    '<a onclick="editts('+data[i].Port+')" class="tool icon fa-pencil"></a>'+
                    '<a onclick="deletets('+data[i].Port+')" class="tool icon fa-trash"></a>'+
                    '<a onclick="resetts('+data[i].Port+')" class="tool icon fa-refresh"></a>'+'</td></tr></table>');
            }
        }
    });
}