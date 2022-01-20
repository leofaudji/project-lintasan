<?php
class Tabungan_m extends Bismillah_Model{

   public function getfaktur($l=true){
      $k       = "TB" . getsession($this,"kode_kantor") . date("ymd") ;          
      return $k . $this->getincrement($k, $l, 6) ;    
   }

   public function setmutasi($f){ 
      $customer = getsession($this,"customer") ;
      $debet = $f['jumlah'] ;
      $kredit = 0 ;
      $dk = "D" ;

      $w = "customer = '$customer' AND kode = '{$f['kode_transaksi']}'" ;
      $db  = $this->select("tabungan_kodetransaksi", "dk", $w) ; 
      if($dbr  = $this->getrow($db)){ 
         $dk   = $dbr['dk'] ;     
      }
      
      if($dk == "K"){
         $debet = 0 ;
         $kredit = $f['jumlah'] ; 
      }

      $va   = array("id_kantor"=>$f['id_kantor'],"faktur"=>$f['faktur'],"tgl"=>$f['tgl'],
                    "rekening"=>$f['rekening'],"kode_transaksi"=>$f['kode_transaksi'],
                    "keterangan"=>$f['keterangan'],"debet"=>$debet,"kredit"=>$kredit, 
                    "datetime"=>$f['datetime'],"username"=>$f['username']) ; 
      $this->insert("tabungan_mutasi", $va) ;  
   }

}
?>
