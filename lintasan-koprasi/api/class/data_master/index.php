<?php 
  $path = $_SERVER['PATH_INFO'] ;
  $vapath = explode("/",$path) ;
  if(count($vapath) > 2){
    $endpoint = $vapath[2] ; 
    //print_r($_SERVER);
    $lmethod = false ;
    $vamethod = array("set","get","delete") ;
    if(count($vapath) > 3){
      foreach($vamethod as $key=>$value){
        if($value == $vapath[3]) $lmethod = true ;
      }   
    }
    
    if($lmethod){
      switch($endpoint){ 
        case "agama" : $Func::Require_File("./class/data_master/data.php") ; break ;   
        case "dati2" : $Func::Require_File("./class/data_master/data.php") ; break ;       
        case "cek" : $Func::Require_File("./class/data_master/data.php") ; break ;       
        default : http_response_code(ERROR_NOT_FOUND); print("404 not found"); break;                
      }   
    }else{
      http_response_code(ERROR_NOT_FOUND); print("404 not found"); 
    }  
  }
  

?>