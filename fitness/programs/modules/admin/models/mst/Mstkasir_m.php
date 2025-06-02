<?php
class Mstkasir_m extends Bismillah_Model{
   public function getkode($u=true){
      $k       = "PEL" ;
      return $k . $this->getincrement($k, $u, 4) ;
   } 

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(nama LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "a.id,p.kode,p.nama,p.alamat,p.statuspelanggan,a.tgl,a.jam" ; 
      $join		= "left join pelanggan p on p.kode = a.pelanggan" ;
      $dbd      = $this->select("absensi a", $f, $where, $join, "", "a.id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("absensi a", "COUNT(a.id) id", $where,$join) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function saving($va, $id){ 
      $f    = $va ; 
      $f['tgl']  = date_2s($f['tgl']) ;
      $f['tgllahir']  = date_2s($f['tgllahir']) ;
      if($id == ""){       
         $f['kode']    = $this->getkode() ;
      } 
      $w    = "id = " . $this->escape($id) ; 
      $this->update("pelanggan", $f, $w) ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ; 
      $d    = $this->getval("*", $w, "pelanggan") ;
      return !empty($d) ? $d : false ;
   }
}
?>
