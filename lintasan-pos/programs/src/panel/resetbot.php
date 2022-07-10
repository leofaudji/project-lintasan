<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['email_admin'])) {
    header("location: login.php");
}
unlink("../result/total_bot.txt");

echo "<script type='text/javascript'>window.top.location='index.php';</script>";