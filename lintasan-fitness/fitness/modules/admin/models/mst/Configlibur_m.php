   <?php
class Configlibur_m extends Bismillah_Model{ 

   public function trpelanggan($va){
      $id = $va['pelanggan'] ;
      $tr = $va['tarif'] ;
      $n = 0 ;
      $tgl      = date("Y-m-d") ; 
      $where    = "kode = '$tr' and tgl <= '$tgl'" ;
      $dba      = $this->select("tarif", "jumlah", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $n   = $dbra['jumlah'] ;
      }

      $where    = "tgl <= '$tgl' and pelanggan = '$id' and tarif = '$tr'" ;
      $dba      = $this->select("pelanggan_tarif", "jumlah", $where, "", "", "id DESC","0,1") ;
      if($dbra  = $this->getrow($dba)){ 
         $n   = $dbra['jumlah'] ;
      } 

      return $n ;
   }
   
}
?>