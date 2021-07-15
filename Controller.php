<?php

function setCredentials ($link){

    $domain = $_REQUEST['DOMAIN'];
    $protocol = $_REQUEST['PROTOCOL'];
    $lang = $_REQUEST['LANG'];
    $app_sid = $_REQUEST['APP_SID'];
    $auth_id = $_REQUEST['AUTH_ID'];
    $auth_expires = $_REQUEST['AUTH_EXPIRES'];
    $refresh_id = $_REQUEST['REFRESH_ID'];
    $member_id = $_REQUEST['member_id'];
    $date = date('d-m-Y H:i:s');

    $sql = "INSERT another_table(DOMAIN, PROTOCOL, LANG, APP_SID, AUTH_ID, AUTH_EXPIRES, REFRESH_ID, member_id, date_of_request) VALUES 
    ('$domain', '$protocol', '$lang', '$app_sid', '$auth_id', '$auth_expires', '$refresh_id', '$member_id', '$date')";
    $result = mysqli_query($link, $sql);

    return true;
}

function getCredentials ($link){

    $sql = "SELECT * FROM another_table ORDER BY date_of_request DESC LIMIT 1";
    $result = mysqli_query($link, $sql);
    $record = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $record;
}