<?php
if($_SESSION['key'] == "" or $_GET['key'] == "") {
  header("Location : /cgi-sys/defaultwebpage.cgi");
    
  exit();
}
if($_GET['key'] == $key) {
}else{
  header("Location : /cgi-sys/defaultwebpage.cgi");
    
  exit();
}

