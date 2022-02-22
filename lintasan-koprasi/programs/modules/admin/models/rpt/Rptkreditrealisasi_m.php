<?php
class Rptkreditrealisasi_m extends Bismillah_Model{ 
   
   public function loadgrid($va){  
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ;
      $va['tglawal']    = date_2s($va['tglawal']) ;     
      $va['tglakhir']   = date_2s($va['tglakhir']) ;     
      $where    = array("t.id_kantor = '$id_kantor' AND t.tgl >= '".$va['tglawal']."' AND t.tgl <= '".$va['tglakhir']."'") ;    
      if($search !== "") $where[]   = "(t.rekening LIKE '%{$search}%' OR m.nama LIKE '%{$search}%' OR m.alamat LIKE '%{$search}%' OR m.telepon LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;   

      $f        = "t.id,t.tgl,t.rekening,m.nama,m.alamat,m.telepon,t.plafond,t.sukubunga,t.lama,t.ao" ;    
      $join     = "left join kredit_angsuran tm on tm.id_kantor = t.id_kantor AND tm.rekening = t.rekening 
                   left join mst_anggota m on m.id_kantor = t.id_kantor and m.kode = t.kode_anggota"  ;  
      $dbd      = $this->select("kredit_rekening t", $f, $where, $join, "t.rekening", "t.tgl ASC", $limit) ;   

      $row      = 0 ;  
      $dba      = $this->select("kredit_rekening t", $f, $where,$join, "t.rekening", "t.rekening ASC") ;  
      $row      = $this->rows($dba) ;
      
      return array("db"=>$dbd, "rows"=> $row ) ;  
   }  
 
}
?>
