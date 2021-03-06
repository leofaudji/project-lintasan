<?php
class Trtabungantransaksi_m extends Bismillah_Model{

   public function getfaktur($l=true){ 
      $k       = "TB" . date("ymd") ;   
      return $k . $this->getincrement($k, $l, 4) ;  
   }   
  
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ; 
      $id_kantor = getsession($this, "id_kantor") ; 
      $rekening = $va['rekening'] ;
      $where    = array("t.id_kantor = '$id_kantor' and m.rekening = '$rekening'") ;      
      if($search !== "") $where[]   = "(m.kode LIKE '{$search}%' OR m.keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
      $f        = "m.*" ;       
      $dbd      = $this->select("tabungan_mutasi m", $f, $where, "left join tabungan_rekening t on t.rekening = m.rekening", "", "m.id ASC", $limit) ;

      $row      = 0 ; 
      $dba      = $this->select("tabungan_mutasi m", "COUNT(m.id) id", $where, "left join tabungan_rekening t on t.rekening = m.rekening") ;
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      }
 
      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function seekrekening($va){
      $rekening = $va['rekening'] ;    
      $value = array() ;
      $id_kantor = getsession($this, "id_kantor") ; 
      $where    = "t.id_kantor = '$id_kantor' and t.rekening = '$rekening'" ;  
      $f = "m.nama,m.alamat,m.telepon" ;
      $dba      = $this->select("tabungan_rekening t", "*", $where,"left join mst_anggota m on m.kode = t.kode_anggota") ;
      if($dbra  = $this->getrow($dba)){ 
         $value   = $dbra ;      
      }   
      return $value ;
   }

   public function seekketerangan($va){  
      $value = "" ; 
      $dba      = $this->select("tabungan_kodetransaksi", "keterangan","kode = '{$va['kode_transaksi']}'") ;     
      if($dbra  = $this->getrow($dba)){ 
         $value = $dbra ;     
      } 
      return $value ;
   }
 
   public function saving($va, $id){
      $f    = $va ; 
      $f['id_kantor'] = getsession($this, "id_kantor") ;  
      $f['faktur'] = $this->tabungan_m->getfaktur(true) ;     
      $f['tgl'] = date_2s($f['tgl']) ; 
      $f['datetime'] = date_now() ; 
      $f['username'] = getsession($this, "username") ;  
      unset($f['nama']) ;
      unset($f['alamat']) ;
      unset($f['telepon']) ;
      $this->tabungan_m->setmutasi($f) ;  
         
   }   

}
?>