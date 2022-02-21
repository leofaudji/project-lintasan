<?php
class Anggota_m extends Bismillah_Model{

   public function getfaktur($l=true){
      $k       = "TB" . getsession($this,"kode_kantor") . date("ymd") ;          
      return $k . $this->getincrement($k, $l, 6) ;    
   }  

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where    = array("t.id_kantor = '$id_kantor'") ;  
      //$where[]  = "jenis = 'P'" ;
      if($search !== "") $where[]  = "(t.rekening LIKE '{$search}%' OR m.kode LIKE '{$search}%' OR m.nama LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
      $join     = "left join mst_anggota m on t.id_kantor = m.id_kantor AND m.kode = t.kode_anggota" ; 
      $dbd      = $this->select("tabungan_rekening t", "m.kode,t.rekening,m.nama,m.alamat,m.telepon", $where, $join, "", "t.id DESC", $limit) ; 
      $dba      = $this->select("tabungan_rekening t", "t.id", $where,$join) ;    

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }

   public function getdata($kode){
      $data = array() ;
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where = "id_kantor = '$id_kantor' AND kode = " . $this->escape($kode);
      if($d = $this->getval("*",$where, "mst_anggota")){
          $data = $d;  
      }
      return $data ;
   }
  

}
?>