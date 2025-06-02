<?php
class Trkasir_m extends Bismillah_Model{
   var $pelanggan = "" ;
   public function getfaktur($l=true){
      $k       = "KS" . date("ymd") ;   
      return $k . $this->getincrement($k, $l, 4) ;  
   }   
 
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      //$where    = "pelanggan = '".$va['pelanggan']."'" ;   
      $where    = array("pelanggan = '".$va['pelanggan']."'") ;     
      if($va['pelanggan2'] <> "") $where    = array("pelanggan = '".$va['pelanggan2']."'") ;
      if($search !== "") $where[]   = "(tarif LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
      $f        = "*" ;       
      $dbd      = $this->select("pelanggan_bayar", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("pelanggan_bayar", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      }
 
      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function stpelanggan($va){
      $id = $va['pelanggan'] ;
      $va = array() ;
      $tgl      = date("Y-m-d") ;
      $where    = "kode = '$id'" ; 
      $dba      = $this->select("pelanggan", "*", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $va   = $dbra ; 
      } 

      $va['total'] = 0 ;
      $dbb      = $this->select("pelanggan_bayar", "count(id) total","pelanggan='$id'") ;
      if($dbra  = $this->getrow($dbb)){ 
         $va['total']   = $dbra['total'] ; 
      } 


      return $va ;
   }
 
   public function seektarif($id){  
      $va = array("pendaftaran"=>10,"iuran"=>0,"sewagedung"=>0,"suplemen"=>0) ;  
      $n = 0 ;
      $tgl      = date("Y-m-d") ;
      $dba      = $this->select("tarif", "*","","","","") ;    
      while($dbra  = $this->getrow($dba)){ 
         if($dbra['kode'] == "BP") $va['pendaftaran'] = $dbra['jumlah'] ;
         if($dbra['kode'] == $id) $va['iuran'] = $dbra['jumlah'] ;    
      } 

      /*$where    = "tgl <= '$tgl' and pelanggan = '$id' and tarif = '$tr'" ;
      $dba      = $this->select("pelanggan_tarif", "jumlah", $where, "", "", "id DESC","0,1") ;
      if($dbra  = $this->getrow($dba)){ 
         $n   = $dbra['jumlah'] ;
      } */ 

      return $va ;
   }

   public function seekauto(){
      $va = array() ;
      $tgl      = date("Y-m-d") ;   
      $va['true']    = 0 ;
      $field    = "a.*,p.kode,p.nama,p.alamat,p.telepon,p.email,p.statuspelanggan" ;
      $join     = "left join pelanggan p on p.kode = a.pelanggan" ; 
      $dba      = $this->select("absensi_tmp a",$field,"",$join,"","id DESC","0,1") ;
      if($dbra  = $this->getrow($dba)){ 
         $va   = $dbra ;      
         $va['true'] = 1 ;
         $this->pelanggan = $dbra['kode'] ;    
         $this->delete("absensi_tmp", "id = " . $va['id']) ;
      } 
      return $va ;
   }
 
   public function saving($va, $id){
      $f    = $va ; 
      $f['faktur'] = $this->getfaktur(true) ;   
      $f['tgl'] = date_2s($f['tgl']) ; 
      $f['datetime'] = date_now() ; 
      $f['username'] = getsession($this, "username") ; 
      unset($f['kembalian']) ;
      unset($f['pelanggan2']) ;
      $this->insert("pelanggan_bayar", $f) ; 
      $total = $f['pendaftaran'] + $f['iuran'] + $f['sewagedung'] + $f['suplemen'] ; 
      $cket = " [" . $f['pelanggan'] . "] " . $this->getnama($f['pelanggan']) ; 
      $vkas = array("faktur"=>$f['faktur'],"tgl"=>$f['tgl'],"rekening"=>"1.102","keterangan"=>"Kas " . $f['keterangan'] . $cket,
                     "debet"=>$total,"kredit"=>0,"datetime"=>$f['datetime'],"username"=>$f['username']) ;
         $vpendaftaran = array("faktur"=>$f['faktur'],"tgl"=>$f['tgl'],"rekening"=>$this->getrekening("BP"),
                     "keterangan"=>"Pendaftaran " . $f['keterangan'] . $cket,
                     "debet"=>0,"kredit"=>$f['pendaftaran'],"datetime"=>$f['datetime'],"username"=>$f['username']) ;
         $viuran = array("faktur"=>$f['faktur'],"tgl"=>$f['tgl'],"rekening"=>$this->getrekening("MB"), 
                     "keterangan"=>"Iuran " . $f['keterangan'] . $cket,
                     "debet"=>0,"kredit"=>$f['iuran'],"datetime"=>$f['datetime'],"username"=>$f['username']) ;
         $vsewagedung = array("faktur"=>$f['faktur'],"tgl"=>$f['tgl'],"rekening"=>$this->getrekening("SG"), 
                     "keterangan"=>"Sewa Gedung " . $f['keterangan'] . $cket,
                     "debet"=>0,"kredit"=>$f['sewagedung'],"datetime"=>$f['datetime'],"username"=>$f['username']) ;
         $vsuplemen = array("faktur"=>$f['faktur'],"tgl"=>$f['tgl'],"rekening"=>$this->getrekening("SP"), 
                     "keterangan"=>"Suplemen " . $f['keterangan'] . $cket,
                     "debet"=>0,"kredit"=>$f['suplemen'],"datetime"=>$f['datetime'],"username"=>$f['username']) ;
      
      $this->updbukubesar($vkas); 
         $this->updbukubesar($vpendaftaran); 
         $this->updbukubesar($viuran); 
         $this->updbukubesar($vsewagedung); 
         $this->updbukubesar($vsuplemen);   
   }

   public function getrekening($id){ 
      $n = 0 ;
      $dba      = $this->select("tarif", "rekening","kode = '$id'") ;     
      if($dbra  = $this->getrow($dba)){ 
         $n = $dbra['rekening'] ;    
      } 
      return $n ;
   }
   
   public function getnama($id){ 
      $n = 0 ;
      $dba      = $this->select("pelanggan", "nama","kode = '$id'") ;     
      if($dbra  = $this->getrow($dba)){ 
         $n = $dbra['nama'] ;    
      }  
      return $n ;
   }

   public function updbukubesar($va){  
      if($va['debet'] > 0 || $va['kredit'] > 0){
         $this->insert("keuangan_bukubesar", $va) ; 
      }
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;
      $d    = $this->getval("id, tgl,kode, keterangan,jumlah", $w, "tarif") ;
      return !empty($d) ? $d : false ;
   } 

}
?>