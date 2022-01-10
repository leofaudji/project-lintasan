<?php
  //print_r($_SERVER) ;
  require_once "./include/obj.db.php" ; 
  $path = $_SERVER['PATH_INFO'] ;
  $vapath = explode("/",$path) ;
  
  $vareturn = array() ;
  
  $time = microtime(true);
      
  if(count($vapath) > 3){
    $post = json_decode(file_get_contents("php://input"),true) ; 
    $method    = ($vapath[1] == "master") ? $vapath[3] : $vapath[4] ; 
    if(!empty($post) and is_array($post)){
      
      $field = "*" ;
      $where = "" ;
      if(!empty($post['filter'])){  
        $filter = $post['filter'] ;
        $field    = (!empty($filter['field'])) ? $filter['field'] : '*';
        $where    = (!empty($filter['where'])) ? $filter['where'] : '';
        $vajoin   = (!empty($filter['vajoin'])) ? $filter['vajoin'] : '';
        $groupby  = (!empty($filter['groupby'])) ? $filter['groupby'] : '';
        $orderby  = (!empty($filter['orderby'])) ? $filter['orderby'] : '';
      }        

      $table = TABLE_MASTER[$vapath[2]] ;
      $vadata = array() ;
        
      if($method == "set"){
        $data  = $post['data'] ;
        // query multiple
        // INSERT INTO mst_agama(kode,keterangan) values ('001','Islam'),('002','Kristen');" ; 
        $sql     = "INSERT INTO " ; 
        $sql    .= $table ; 

        $vafield = array() ;
        $i       = 0 ;
        $values  = "" ;
        foreach($data as $key=>$value){
          
          // parsing field
          foreach($value as $key1=>$value1){
            $vafield[$key1] = $key1 ;
          }
          
          // parsing value
          foreach($value as $key2=>$value2){
            $vadata[$key2] = "'" . $value2 . "'" ; 
            $values = "" ;
          }

          $values = "(" . implode(",",$vadata) . ")" ;
          $vavalues[$i++] = $values ;

          //print($values) ;
          //print_r($vadata);

        }

        //print($vavalues) ;
        $values = implode(",",$vavalues) . ";" ;  
        //print_r($vadata) ;

        //print_r($vafield) ;
        $sql .= "(" . implode(",",$vafield) . ")" ;  
        $sql .= " values " . $values ;

        //print($sql) ;
        $DB::SQL($sql) ; 

        $vareturn['data'] = array("failed_rows"=>$DB::$Error,"failed_rows_data"=>array(),"succed_rows"=>$DB::AffectedRows()) ; 

      }else if($method == "get"){
        if(!empty($where)) $where = "where " . $where ;
        $sql = "SELECT $field FROM $table $where " ;
        //print $sql ;
        $db = $DB::SQL($sql); 
        $i = 0 ;
        while($row = $DB::GetRow($db)){
          $vadata["data" . ++$i] = $row ;
        }
        if(!empty($DB::SQLError())){
          $vadata["failed_rows"] = $DB::SQLError() ;
          $vadata["failed_rows_data"] = $i ;
        }else{
          $vadata['succed_rows'] = $DB::AffectedRows() ;
        }
        $vareturn['data'] = array("data"=>$vadata) ;

      }else if($method == "delete"){ 
        $DB::Delete($table,$where); 
        $vareturn['deleted_rows'] = $DB::AffectedRows() ;
      }    
      
      
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