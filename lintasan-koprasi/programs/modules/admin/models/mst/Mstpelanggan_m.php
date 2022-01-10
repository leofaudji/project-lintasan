<?php
class Mstpelanggan_m extends Bismillah_Model{ 
   public function getkode($u=true){
      $k       = "PEL" ;
      return $this->getincrement($k, $u, 6) ;
   } 
 
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(nama LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id,kode,kodefinger,nama,alamat,telepon,email,jeniskelamin,tempatlahir,tgllahir, tgl,statuspelanggan" ; 
      $dbd      = $this->select("pelanggan", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("pelanggan", "COUNT(id) id", $where) ;
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

   public function getpelanggan($id){
      $va = array() ;
      $dba      = $this->select("pelanggan", "*","id = '$id'") ;
      if($dbra  = $this->getrow($dba)){
         $va   = $dbra ; 
      } 
      return $va ;
   } 

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ; 
      $d    = $this->getval("*", $w, "pelanggan") ;
      return !empty($d) ? $d : false ;
   }
}
?>
