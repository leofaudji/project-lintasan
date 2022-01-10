<?php
  require_once "./include/df.php" ; 
  require_once "./include/obj.php" ; 
  //print_r($_SERVER);
  if($_SERVER['HTTP_USER_AGENT'] == HTTP_USER_AGENT['APP_WEB'] || substr($_SERVER['HTTP_USER_AGENT'],0,7) == "Postman"){
    $basename_api = BASENAME_API ; 
    $path = $_SERVER['PATH_INFO'] ;
    $vapath = explode("/",$path) ; 
    //print_r($vapath);
    if($_SERVER['REQUEST_METHOD'] == "GET" || $_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "DELETE"){
      $endpoint = $vapath[1] ;
      switch($endpoint){ 
        case $basename_api . "/" : http_response_code(200) ; print("restricted access"); break ;
        case "master"     : require_once "./class/data_master/index.php" ; break ; 
        case "transaksi"  : require_once "./class/data_transaksi/index.php" ; break ; 
        case "laporan"    : require_once "./class/data_laporan/index.php" ; break ; 
        case "login"      : require_once "./class/login.php" ; break ; 
        default : http_response_code(ERROR_NOT_FOUND); print(ERROR_NOT_FOUND . " Not found."); break;               
      }
    }else{
      http_response_code(ERROR_METHOD_NOT_ALLOWED); print(ERROR_METHOD_NOT_ALLOWED . " Method not allowed.");
    }  
  }else{
    http_response_code(ERROR_HTTP_AGENT_NOT_FOUND); print(ERROR_HTTP_AGENT_NOT_FOUND . " Agent not found."); ;
  }

?>