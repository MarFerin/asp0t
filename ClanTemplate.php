<?php
function createClanChannels($ts3_VirtualServer){
    $channelList = $ts3_VirtualServer->channelList();
    $defaultcid = array_keys($channelList)[0];
    $defaultChannel = array_values($channelList)[0];

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[*spacer1]___",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[cspacer]Clan Name",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[cspacer]Roster",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[cspacer]CW Record",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[*spacer2]___",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $defaultChannel->modify(array(
        "channel_name" => "Lobby",
        "channel_order" => $cid,
        "channel_needed_talk_power" => 100
    ));
    $ts3_VirtualServer->channelPermAssign($defaultcid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($defaultcid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($defaultcid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "AFK",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_needed_talk_power" => 100
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"b_client_channel_textmessage_send",0);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[*spacer3]___",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cpid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Gaming Rooms",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Gaming Room¹",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "cpid" => $cpid
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Gaming Room²",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "cpid" => $cpid
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Gaming Room³",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "cpid" => $cpid
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Gaming Room⁴",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "cpid" => $cpid
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[cspacer110]________________________",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cpid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Duo Rooms",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Duo¹",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "cpid" => $cpid,
        "channel_maxclients" => 2
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Duo²",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "cpid" => $cpid,
        "channel_maxclients" => 2
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Duo³",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "cpid" => $cpid,
        "channel_maxclients" => 2
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Duo⁴",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "cpid" => $cpid,
        "channel_maxclients" => 2
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[cspacer]________________________",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cpid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Quad Rooms",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Quad¹",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "cpid" => $cpid,
        "channel_maxclients" => 4
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Quad²",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "cpid" => $cpid,
        "channel_maxclients" => 4
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Quad³",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "cpid" => $cpid,
        "channel_maxclients" => 4
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Quad⁴",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "cpid" => $cpid,
        "channel_maxclients" => 4
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[*spacer4]___",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cpid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "CW Area",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE
    ));
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_join_power",55);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cpid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Home Team",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0,
        "cpid" => $cpid
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",55);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Away Team",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0,
        "cpid" => $cpid
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",55);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Spectators",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0,
        "cpid" => $cpid
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",55);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "[*spacer5]___",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",80);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Staff Room",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",70);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);

    $cid = $ts3_VirtualServer->channelCreate(array(
        "channel_name" => "Council Room",
        "channel_codec" => TeamSpeak3::CODEC_OPUS_VOICE,
        "channel_codec_quality" => 6,
        "channel_flag_permanent" => TRUE,
        "channel_flag_maxclients_unlimited" => FALSE,
        "channel_maxclients" => 0
    ));
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_delete_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_join_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_permission_modify_power",75);
    $ts3_VirtualServer->channelPermAssign($cid,"i_channel_needed_modify_power",75);
}
function createClanPermissions($ts3_VirtualServer){

    $sgid = $ts3_VirtualServer->serverGroupCreate("-----Tools-----");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",80);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",80);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",0);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",800);

    $sgid = $ts3_VirtualServer->serverGroupCreate("[Anti-PM]");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",801);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_private_textmessage_power",70);

    $sgid = $ts3_VirtualServer->serverGroupCreate("[Anti-Poke]");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",802);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_poke_power",75);

    $sgid = $ts3_VirtualServer->serverGroupCreate("[PM-Power]");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",803);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_private_textmessage_power",75);

    $sgid = $ts3_VirtualServer->serverGroupCreate("[Join Power]");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_semi_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_temporary",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_ignore_maxclients",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_join_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",804);

    $sgid = $ts3_VirtualServer->serverGroupCreate("[Join Power²]");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_semi_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_temporary",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_ignore_password",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_ignore_maxclients",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_join_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",805);

    $sgid = $ts3_VirtualServer->serverGroupCreate("-----Guest-----");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",80);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",80);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",0);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",900);

    $sgid = $ts3_VirtualServer->serverGroupCreate("Privileged Guest");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_semi_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_temporary",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_join_power",50);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_auto_update_type",15);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",903);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_kick_from_server_power",50);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_kick_from_channel_power",50);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_ban_power",50);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_move_power",50);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_private_textmessage_power",50);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_channel_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_offline_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_talk_power",50);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_modify_own_description",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_clones_uid",0);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_avatar_filesize",200000);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_channel_subscriptions",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_request_talker",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_file_download_power",25);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_file_browse_power",25);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_quota_mb_download_per_client",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_quota_mb_upload_per_client",-1);

    $sgid = $ts3_VirtualServer->serverGroupCreate("-----Member-----");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",80);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",80);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",0);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",1000);

    $sgid = $ts3_VirtualServer->serverGroupCreate("Member");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_semi_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_temporary",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_join_power",55);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_subscribe_power",55);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_description_view_power",55);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_auto_update_type",15);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",1001);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_kick_from_server_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_kick_from_channel_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_ban_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_move_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_private_textmessage_power",55);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_channel_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_offline_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_talk_power",55);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_poke_power",55);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_poke_power",50);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_modify_own_description",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_clones_uid",0);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_avatar_filesize",200000);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_channel_subscriptions",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_request_talker",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_file_download_power",25);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_file_browse_power",25);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_quota_mb_download_per_client",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_quota_mb_upload_per_client",-1);

    $sgid = $ts3_VirtualServer->serverGroupCreate("Moderator");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_semi_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_temporary",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_ignore_password",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_ignore_maxclients",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_join_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_subscribe_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_description_view_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_member_add_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_member_remove_power",60);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_auto_update_type",15);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",1002);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_kick_from_server_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_kick_from_server_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_kick_from_channel_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_kick_from_channel_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_ban_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_ban_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_move_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_move_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ban_list",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ban_create",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ban_delete_own",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_ban_max_bantime",3600);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_private_textmessage_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_channel_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_offline_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_talk_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_poke_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_poke_power",55);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_modify_own_description",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_clones_uid",0);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_avatar_filesize",200000);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_channel_subscriptions",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ignore_antiflood",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_request_talker",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_file_download_power",25);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_file_browse_power",25);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_quota_mb_download_per_client",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_quota_mb_upload_per_client",-1);

    $sgid = $ts3_VirtualServer->serverGroupCreate("Council");
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_semi_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_temporary",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_ignore_password",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_channel_join_ignore_maxclients",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_join_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_subscribe_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_channel_description_view_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_modify_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_member_add_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_add_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_member_remove_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_needed_member_remove_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_group_is_permanent",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_auto_update_type",15);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_group_sort_id",1003);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_kick_from_server_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_kick_from_server_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_kick_from_channel_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_kick_from_channel_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_ban_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_ban_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_move_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_move_power",70);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ban_list",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ban_create",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ban_delete_own",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ban_delete",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_ban_max_bantime",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_private_textmessage_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_server_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_channel_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_offline_textmessage_send",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_talk_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_poke_power",75);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_needed_poke_power",55);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_modify_own_description",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_clones_uid",0);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_avatar_filesize",200000);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_client_max_channel_subscriptions",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_ignore_antiflood",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_request_talker",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"b_client_avatar_delete_other",1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_file_download_power",25);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_file_browse_power",25);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_quota_mb_download_per_client",-1);
    $ts3_VirtualServer->serverGroupPermAssign($sgid,"i_ft_quota_mb_upload_per_client",-1);
}