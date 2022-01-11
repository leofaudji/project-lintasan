<?php
class Daftaranggota_m extends Bismillah_Model{ 
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
      $f        = "*" ; 
      $dbd      = $this->select("mst_anggota", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("mst_anggota", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      } 
      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function saving($va, $id){ 
      $f    = $va ; 
      $f['tgl']  = date_2s($f['tgl']) ;
      $f['tgl_lahir']  = date_2s($f['tgl_lahir']) ;
      if($id == ""){       
         $f['kode']    = $this->getkode() ;
      } 
      $w    = "id = " . $this->escape($id) ; 
      $this->update("mst_anggota", $f, $w) ;
   }

   public function getmst_anggota($id){
      $va = array() ;
      $dba      = $this->select("mst_anggota", "*","id = '$id'") ;
      if($dbra  = $this->getrow($dba)){
         $va   = $dbra ; 
      } 
      return $va ;
   } 

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ; 
      $d    = $this->getval("*", $w, "mst_anggota") ;
      return !empty($d) ? $d : false ;
   }
}
?>
