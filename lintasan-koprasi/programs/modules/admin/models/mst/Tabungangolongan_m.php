<?php
class Tabungangolongan_m extends Bismillah_Model{  
 
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(keterangan LIKE '%{$search}%')" ; 
      $where 	 = implode(" AND ", $where) ;
      $f        = "id,kode,keterangan" ; 
      $dbd      = $this->select("tabungan_golongan", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("tabungan_golongan", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }   
      return array("db"=>$dbd, "rows"=> $row ) ;
   }  

   public function saving($va, $id){ 
      $f    = $va ; 
      $w    = "id = " . $this->escape($id) ; 
      $this->update("tabungan_golongan", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("id,kode,keterangan", $w, "tabungan_golongan") ;
      return !empty($d) ? $d : false ;
   }
}
?>