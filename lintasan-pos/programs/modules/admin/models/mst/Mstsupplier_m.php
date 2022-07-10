<?php
class Mstsupplier_m extends Bismillah_Model{
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR nama LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $dbd      = $this->select("supplier", "*", $where, "", "", "kode ASC", $limit) ;
      $dba      = $this->select("supplier", "id", $where) ;

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }

   public function saving($kode, $va){
      $kode = getsession($this, "sssupplier_kode", "");
      $va['kode'] = $kode !== "" ? $va['kode'] : $this->getkode() ;
      $data    = array("kode"=>$va['kode'], "nama"=>$va['nama'],"email"=>$va['email'],
                       "notelepon"=>$va['notelepon'],"alamat"=>$va['alamat'],"namabank"=>$va['namabank'],
                       "rekening"=>$va['rekening'],"atasnamarekening"=>$va['atasnamarekening']) ;
      $where   = "kode = " . $this->escape($kode) ;
      $this->update("supplier", $data, $where, "") ;
   }

   public function getdata($kode){
      $data = array() ;
		if($d = $this->getval("*", "kode = " . $this->escape($kode), "supplier")){
         $data = $d;
		}
		return $data ;
   }

   public function deleting($kode){
      $this->delete("supplier", "kode = " . $this->escape($kode)) ;
   }
    
   public function getkode($l=true){
      $y    = date("ym");
      $n    = $this->getincrement("supplier", $l, 5);
      $n    = $n ;
      return $n ;
   }
}
?>
