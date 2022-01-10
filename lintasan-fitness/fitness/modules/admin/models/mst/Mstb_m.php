<?php
class Mstb_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ;
      if($search !== "") $where[]	= "(sku LIKE '{$search}%' OR nama LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id, sku, nama, id_kat, satuan, jenis" ;
      $dbd      = $this->select("mst_brg", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("mst_brg", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function saving($va, $id){
      $f    = array("sku"=>$va['sku'], "nama"=>$va['nama'], "id_kat"=>$va['id_kat'],
                     "satuan"=>$va['satuan'], "jenis"=>$va['jenis']) ;
      $w    = "id = " . $this->escape($id) ;
      $this->update("mst_brg", $f, $w) ;
      if($id == ""){
         $id= $this->getval("id", "sku = '".$va['sku']."'", "mst_brg") ;
      }
      //upd harga
      $w    = "id_brg = " .$this->escape($id) ;
      $f    = array("id_brg"=>$id, "min"=>$va['min'], "harga"=>$va['harga']) ;
      $this->update("brg_stok",$f , $w, "id_brg") ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;
      $d    = $this->getval("*", $w, "v_brg") ;
      return !empty($d) ? $d : false ;
   }
}
?>
