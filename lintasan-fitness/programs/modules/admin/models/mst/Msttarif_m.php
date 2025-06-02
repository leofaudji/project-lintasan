<?php
class Msttarif_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ;
      if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id, tgl,kode,keterangan,jumlah,rekening" ;
      $dbd      = $this->select("tarif", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("tarif", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      } 

      return array("db"=>$dbd, "rows"=> $row ) ;
   }
 
   public function saving($va, $id){
      $f    = $va ;
      $w    = "id = " . $this->escape($id) ;
      $f['tgl'] = date_2s($f['tgl']) ; 
      $this->update("tarif", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;
      $d    = $this->getval("id, tgl,kode, keterangan,jumlah,rekening", $w, "tarif") ;
      return !empty($d) ? $d : false ;
   }
}
?>
