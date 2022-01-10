<?php
  //print_r($_SERVER) ;
  require_once "./include/obj.db.php" ; 
  //print_r($_SERVER) ;
  $path = $_SERVER['PATH_INFO'] ;
  $vapath = explode("/",$path) ;
  
  $vareturn = array() ;
  
  $time = microtime(true);
      
  if(count($vapath) == 2){
    $post = json_decode(file_get_contents("php://input"),true) ; 
    if(!empty($post) and is_array($post)){
      
      $username = $post['data']['username'] ; 
      $password = $DB::Pass_Crypt($post['data']['password']) ;
      $where = "where username = '$username' and password LIKE '$password%'" ;

      $table = TABLE_MASTER[$vapath[1]] ;  
      $vadata = array() ;
        
      $sql = "SELECT username, fullname, data_var, lastchangepass, password FROM $table $where" ;
      //print $sql ;
      $db = $DB::SQL($sql); 
      $i = 0 ;
      if($row = $DB::GetRow($db)){
        $vadata = $row ;
      }
      if(!empty($DB::SQLError())){
        $vadata["failed_rows"] = $DB::SQLError() ;
        $vadata["failed_rows_data"] = $i ;
      }else{
        $vadata['succed_rows'] = $DB::AffectedRows() ;
      }
      $vareturn = array("data"=>$vadata) ;

    }else{
      $vareturn['message'] = "Empty post data" ;
    } 
    
  }else{
    $vareturn['message'] = "Invalid post data" ;
  } 
  
  $diff = microtime(true)-$time;
  $processtime =  $diff ;//* 1000; 
      
  $vareturn['header'] = array("datetime"=>$DB::Snow(),"process_time"=>$processtime) ;  
  print(json_encode($vareturn));

?>