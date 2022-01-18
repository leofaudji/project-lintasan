<?php
class Tabunganperubahanrate_m extends Bismillah_Model{  
 
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(keterangan LIKE '%{$search}%')" ; 
      $where 	 = implode(" AND ", $where) ;
      $f        = "*" ; 
      $dbd      = $this->select("tabungan_rate", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("tabungan_rate", "COUNT(id) id", $where) ; 
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }   
      return array("db"=>$dbd, "rows"=> $row ) ;
   }  

   public function saving($va, $id){ 
      $f    = $va ; 
      $f['tgl'] = date_2s($f['tgl']) ;
      $w    = "id = " . $this->escape($id) ; 
      $this->update("tabungan_rate", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("*", $w, "tabungan_rate") ;
      return !empty($d) ? $d : false ;
   }
}
?>