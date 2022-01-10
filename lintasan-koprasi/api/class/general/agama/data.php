<?php
  //print_r($_SERVER) ;
  require_once "./include/obj.db.php" ; 
  $path = $_SERVER['PATH_INFO'] ;
  $vapath = explode("/",$path) ;
  if(count($vapath) > 3){
    $method = $vapath[3] ;
    $post = json_decode(file_get_contents("php://input"),true) ; 
    if(!empty($post) and is_array($post)){
      
      if(!empty($post['filter'])){  
        $filter = $post['filter'] ;
        $where    = (!empty($filter['where'])) ? $filter['where'] : '';
        $groupby  = (!empty($filter['groupby'])) ? $filter['groupby'] : '';
        $orderby  = (!empty($filter['orderby'])) ? $filter['orderby'] : '';
      }

      if($method == "set"){
        foreach($post['data'] as $key=>$value){ 
          $DB->Update("mst_agama",$post['data'],$where,false);
        }
      }else if($method == "get"){
        foreach($post['data'] as $key=>$value){ 
          $DB->Update("mst_agama",$post['data'],$where,false);
        }
      }else if($method == "delete"){
        foreach($post['data'] as $key=>$value){ 
          $DB->Update("mst_agama",$post['data'],$where,false);
        }
      }      
        
    }
  }
  //print_r($data);  

?>