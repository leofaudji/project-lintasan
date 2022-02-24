<?php
class Rptakuntansikas_m extends Bismillah_Model{ 
   
   public function loadgrid($va){    
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor        = getsession($this,"id_kantor") ;
      $va['tglawal']    = date_2s($va['tglawal']) ;     
      $va['tglakhir']   = date_2s($va['tglakhir']) ;     
      $where    = array("t.id_kantor = '$id_kantor'") ; //  AND t.rekening like '%{$va['rekening']}%'       
      if($search !== "") $where[]   = "(t.rekening LIKE '%{$search}%' OR m.nama LIKE '%{$search}%' OR m.alamat LIKE '%{$search}%' OR m.telepon LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;   

      $f        = "t.id,tm.tgl,tm.rekening,tm.keterangan,m.nama,tm.dpokok,tm.kpokok,tm.kbunga,tm.denda,tm.dtitipan,tm.ktitipan" ;    
      $join     = "left join kredit_rekening t on t.id_kantor = tm.id_kantor AND t.rekening = tm.rekening AND tm.tgl >= '".$va['tglawal']."' AND tm.tgl <= '".$va['tglakhir']."' 
                   left join mst_anggota m on m.id_kantor = t.id_kantor and m.kode = t.kode_anggota"  ;  
      $dbd      = $this->select("kredit_angsuran tm", $f, $where, $join, "", "tm.tgl ASC", $limit) ;   

      $row      = 0 ;  
      $dba      = $this->select("kredit_angsuran tm", $f, $where,$join, "", "tm.tgl ASC") ;  
      $row      = $this->rows($dba) ;
      
      return array("db"=>$dbd, "rows"=> $row ) ;  
   }  
 
}
?>
