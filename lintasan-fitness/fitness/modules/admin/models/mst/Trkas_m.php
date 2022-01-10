<?php
class Trkas_m extends Bismillah_Model{
   public function getfaktur($c="K",$l=true){
      $k       = $c . date("ymd") ; 
      return $k . $this->getincrement($k, $l, 4) ; 
   }

   public function saving($va, $id){
      $f    = $va ; 
      $f2   = $va ;
      if($f['jenis'] == "KM"){
         $c = "KM" ;
         $f['rekening'] = "1.102" ;
         $f['debet']   = $f['jumlah'] ;
         $f['kredit']  = 0 ;
         $f2['debet']   = 0 ;
         $f2['kredit']  = $f['jumlah'] ;
      }else{
         $c = "KK" ;
         $f2['rekening'] = "1.102" ;
         $f2['debet'] = 0 ;
         $f2['kredit'] = $f['jumlah'] ;
         $f['debet']   = $f['jumlah'] ; 
         $f['kredit']  = 0 ;
      }   
      $faktur = $this->getfaktur($c,true) ;   
      $f['faktur'] = $faktur ;
      $f['tgl'] = date_2s($f['tgl']) ; 
      $f['datetime'] = date_now() ; 
      $f['username'] = getsession($this, "username") ;
      $f2['faktur'] = $faktur ;
      $f2['tgl'] = date_2s($f2['tgl']) ; 
      $f2['datetime'] = date_now() ; 
      $f2['username'] = getsession($this, "username") ;
      unset($f['jumlah']) ; 
      unset($f['jenis']) ;  
      unset($f2['jumlah']) ; 
      unset($f2['jenis']) ;  
      $this->insert("keuangan_jurnal", $f) ; 
      $this->insert("keuangan_jurnal", $f2) ; 
      $this->insert("keuangan_bukubesar", $f) ; 
      $this->insert("keuangan_bukubesar", $f2) ; 
   }


}
?>
