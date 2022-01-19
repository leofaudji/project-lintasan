<?php
class Trtabunganpembukaan_m extends Bismillah_Model{  
   public function getkode($u=true){
      $k       = "TB" . getsession($this,"kode_kantor") . date("ymd") ;         
      return $k . $this->getincrement($k, $u, 6) ;
   } 
  
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ;
      $where 	 = array("t.id_kantor = '$id_kantor'") ;    
      if($search !== "") $where[]	= "(t.kode_anggota LIKE '%{$search}%' OR m.nama LIKE '%{$search}%' OR m.alamat LIKE '%{$search}%' )" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "t.*,m.nama,m.alamat" ;     
      $dbd      = $this->select("tabungan_rekening t", $f, $where, "left join mst_anggota m on m.kode = t.kode_anggota", "", "t.id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("tabungan_rekening t", "COUNT(t.id) id", $where, "left join mst_anggota m on m.kode = t.kode_anggota") ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      } 
      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function saving($va, $id){      
      $f    = $va ; 
      $f['tgl']  = date_2s($f['tgl']) ;
      if($id == ""){       
         $f['id_kantor']   = getsession($this,"id_kantor") ;
         //$f['faktur']      = $this->getkode() ;       
         $f['rekening']    = implode(".",array($f['golongan_tabungan'],$f['kode_anggota'])) ;
         $f['datetime']    = date_now() ; 
         $f['username']    = getsession($this, "username") ;
      } 
      $w    = "id = " . $this->escape($id) ; 
      $this->update("tabungan_rekening", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ; 
      $d    = $this->getval("*", $w, "tabungan_rekening") ;
      return !empty($d) ? $d : false ;
   }

   public function loadgrid3($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where    = array("id_kantor = '$id_kantor'") ; 
      //$where[]  = "jenis = 'P'" ;
      if($search !== "") $where[]  = "(kode LIKE '{$search}%' OR nama LIKE '%{$search}%'  OR alamat LIKE '%{$search}%'  OR telepon LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;
      $dbd      = $this->select("mst_anggota", "kode,nama,alamat,telepon", $where, "", "", "id DESC", $limit) ; 
      $dba      = $this->select("mst_anggota", "id", $where) ;

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }

   public function getdata($kode){
      $data = array() ;
      $where = "kode = " . $this->escape($kode);
      if($d = $this->getval("*",$where, "mst_anggota")){
          $data = $d; 
      }
      return $data ;
  }
}
?>
