<?php
class Rpttabunganbuku_m extends Bismillah_Model{ 
   
   public function loadgrid($va){  
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ;
      $va['tglawal'] = date_2s($va['tglawal']) ; 
      $va['tglakhir'] = date_2s($va['tglakhir']) ;   
      $where    = array("t.id_kantor = '$id_kantor' AND t.tgl >= '".$va['tglawal']."' AND t.tgl <= '".$va['tglakhir']."' AND tm.rekening = '".$va['rekening']."'") ;       
      if($search !== "") $where[]   = "(t.rekening LIKE '{$search}%' OR m.nama LIKE '%{$search}%' OR m.alamat LIKE '%{$search}%' OR m.telepon LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  

      $f        = "tm.id,tm.tgl,t.rekening,m.nama,tm.kode_transaksi,tm.keterangan,tm.debet,tm.kredit,tm.datetime,tm.username" ;    
      $join     = "left join tabungan_rekening t on t.id_kantor = tm.id_kantor AND t.rekening = tm.rekening
                   left join mst_anggota m on t.id_kantor = m.id_kantor and m.kode = t.kode_anggota"  ;
      $dbd      = $this->select("tabungan_mutasi tm", $f, $where, $join, "", "tm.id ASC", $limit) ;

      $row      = 0 ;  
      $dba      = $this->select("tabungan_mutasi tm", "COUNT(tm.id) id", $where,$join) ;  
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ; 
   }  
 
}
?>
