<?php
class Harga_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ;
      if($search !== "") $where[]	= "(sku LIKE '{$search}%' OR nama LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id, sku, nama, kategori, satuan, jenis, hp, harga, (harga-hp) laba, tgl_ex, stok" ;
      $dbd      = $this->select("v_gr_brg", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("v_gr_brg", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row) ;
   }

   public function saving($va){
      $tgl     = date("Y-m-d") ; 
      $id      = $va['id'] ;
      $n       = $va['n'] ;
      $u       = getsession($this, "username") ;
      if($va['col'] == "8"){ //hp
         $this->toko_m->savehp($tgl, "manual", "manual", $id, $va['qty'], $n) ;
      }else if($va['col'] == "7"){
         $this->toko_m->saveharga($tgl, $id, $va['qty'], $n) ;
      }else if($va['col'] == "6"){//tgl
         $ff   = array("tgl_ex"=>$n) ;
         $w    = "id_brg = " . $this->escape($id) ;
         $this->edit("brg_stok", $ff, $w) ;
      }
   }
}
?>
