<?php
class Rpttabunganpembukaan_m extends Bismillah_Model{
   
   public function loadgrid($va){  
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ;
      $va['tglawal'] = date_2s($va['tglawal']) ; 
      $va['tglakhir'] = date_2s($va['tglakhir']) ;   
      $where    = array("t.id_kantor = '$id_kantor' AND t.tgl >= '".$va['tglawal']."' AND t.tgl <= '".$va['tglakhir']."' ") ;       
      if($search !== "") $where[]   = "(t.rekening LIKE '{$search}%' OR m.nama LIKE '%{$search}%' OR m.alamat LIKE '%{$search}%' OR m.telepon LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  

      $f        = "t.id,t.tgl,t.rekening,t.datetime,t.username,m.nama,m.alamat,m.telepon" ;    
      $join     = "left join mst_anggota m on t.id_kantor = m.id_kantor and m.kode = t.kode_anggota"  ;
      $dbd      = $this->select("tabungan_rekening t", $f, $where, $join, "", "t.id ASC", $limit) ;

      $row      = 0 ;  
      $dba      = $this->select("tabungan_rekening t", "COUNT(t.id) id", $where,$join) ; 
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ; 
   }  
 
}
?>
