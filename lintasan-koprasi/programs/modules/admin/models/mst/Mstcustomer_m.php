<?php
class Mstcustomer_m extends Bismillah_Model{ 
   public function getkode($u=true){
      $k       = "CUST" ; 
      return $this->getincrement($k, $u, 6) ;  
   } 
 
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(nama LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "*" ; 
      $dbd      = $this->select("mst_customer", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("mst_customer", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      } 
      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function saving($va, $id){ 
      $f    = $va ; 
      $f['tgl']  = date_2s($f['tgl']) ; 
      if($id == ""){       
         $f['kode']    = $this->getkode() ;
      } 
      $w    = "id = " . $this->escape($id) ; 
      $this->update("mst_customer", $f, $w) ;
   }

   public function getmst_customer($id){
      $va = array() ;
      $dba      = $this->select("mst_customer", "*","id = '$id'") ;
      if($dbra  = $this->getrow($dba)){
         $va   = $dbra ; 
      } 
      return $va ;
   } 

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ; 
      $d    = $this->getval("*", $w, "mst_customer") ;
      return !empty($d) ? $d : false ;
   }
}
?>
