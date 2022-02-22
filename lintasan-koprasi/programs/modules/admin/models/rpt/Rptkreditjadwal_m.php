<?php
class Rptkreditjadwal_m extends Bismillah_Model{ 
   
   public function loadgrid($va){  
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ;  
      $va['tgl'] = date_2s($va['tgl']) ;   
      $where    = array("t.id_kantor = '$id_kantor' AND t.rekening = '".$va['rekening']."'") ;       
      if($search !== "") $where[]   = "(t.rekening LIKE '{$search}%')" ;
      $where    = implode(" AND ", $where) ;  

      $f        = "t.*" ;    
      $dbd      = $this->select("kredit_rekening t", $f, $where, "", "", "", $limit) ;

      $row      = 0 ;  
      $dba      = $this->select("kredit_rekening t", "COUNT(t.id) id,t.lama", $where,"") ;  
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['lama'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ; 
   }  
 
}
?>
