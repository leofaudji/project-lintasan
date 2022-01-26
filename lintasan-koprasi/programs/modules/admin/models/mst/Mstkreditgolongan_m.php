<?php
class Mstkreditgolongan_m extends Bismillah_Model{  
 
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $customer = getsession($this, "customer")  ;
      $where 	 = array("customer = '$customer'") ; 
      if($search !== "") $where[]	= "(keterangan LIKE '%{$search}%')" ; 
      $where 	 = implode(" AND ", $where) ;
      $f        = "*" ; 
      $dbd      = $this->select("kredit_golongan", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("kredit_golongan", "COUNT(id) id", $where) ; 
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }   
      return array("db"=>$dbd, "rows"=> $row ) ;
   }  

   public function saving($va, $id){ 
      $f    = $va ; 
      $f['customer'] = getsession($this, "customer")  ;
      $w    = "id = " . $this->escape($id) ; 
      $this->update("kredit_golongan", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("*", $w, "kredit_golongan") ;
      return !empty($d) ? $d : false ;
   }
}
?>
