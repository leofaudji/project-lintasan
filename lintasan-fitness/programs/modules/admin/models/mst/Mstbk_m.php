<?php
class Mstbk_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ;
      if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR kategori LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id, kategori" ;
      $dbd      = $this->select("mst_brg_kat", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("mst_brg_kat", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ;
   }
 
   public function saving($va, $id){
      $f    = $va ;
      $w    = "id = " . $this->escape($id) ;
      $this->update("mst_brg_kat", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;
      $d    = $this->getval("id, kategori, keterangan", $w, "mst_brg_kat") ;
      return !empty($d) ? $d : false ;
   }
}
?>
