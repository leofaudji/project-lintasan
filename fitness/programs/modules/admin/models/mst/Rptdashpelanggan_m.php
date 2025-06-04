<?php
class Rptdashpelanggan_m extends Bismillah_Model{
   
   public function loaddata(){ 
      $f        = "a.*,p.nama,p.alamat,p.telepon,p.statuspelanggan,p.tgl tglbuka,p.data_var" ; 
      $join     = "left join pelanggan p on p.kode = a.pelanggan" ;
      $dbd      = $this->select("absensi a", $f, "",$join, "", "a.id DESC", "1") ;
      $row      = array() ;
      if($dbra  = $this->getrow($dbd)){
         $row = $dbra ;
      } 
      return $row ;
   } 
   
    
}
?>