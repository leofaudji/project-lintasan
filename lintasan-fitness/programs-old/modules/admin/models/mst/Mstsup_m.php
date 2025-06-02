<?php
class Mstsup_m extends Bismillah_Model{
   public function getkode($u=true){
      $k       = "SUP" ;
      return $k . $this->getincrement($k, $u, 4) ;
   }

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ;
      if($search !== "") $where[]	= "(sku LIKE '{$search}%' OR nama LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id, kode, nama, hp, alamat" ;
      $dbd      = $this->select("mst_supplier", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("mst_supplier", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function saving($va, $id){
      $f    = $va ;
      if($id == ""){
         $f['kode']    = $this->getkode() ;
      }
      $w    = "id = " . $this->escape($id) ; 
      $this->update("mst_supplier", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;
      $d    = $this->getval("*", $w, "mst_supplier") ;
      return !empty($d) ? $d : false ;
   }
}
?>
