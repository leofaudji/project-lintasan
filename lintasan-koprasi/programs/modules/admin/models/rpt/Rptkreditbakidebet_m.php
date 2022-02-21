<?php
class Rptkreditbakidebet_m extends Bismillah_Model{ 
   
   public function loadgrid($va){  
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ;
      $va['tgl'] = date_2s($va['tgl']) ;     
      $where    = array("t.id_kantor = '$id_kantor' AND t.rekening like '%{$va['rekening']}%'") ;       
      if($search !== "") $where[]   = "(t.rekening LIKE '%{$search}%' OR m.nama LIKE '%{$search}%' OR m.alamat LIKE '%{$search}%' OR m.telepon LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;   

      $f        = "t.id,t.tgl,t.rekening,m.nama,m.alamat,m.telepon,sum(tm.dpokok-tm.kpokok) saldoakhir" ;    
      $join     = "left join kredit_angsuran tm on tm.id_kantor = t.id_kantor AND tm.rekening = t.rekening AND tm.tgl <= '".$va['tgl']."' 
                   left join mst_anggota m on m.id_kantor = t.id_kantor and m.kode = t.kode_anggota"  ;  
      $dbd      = $this->select("kredit_rekening t", $f, $where, $join, "t.rekening", "t.rekening ASC", $limit) ;         

      $row      = 0 ;  
      $dba      = $this->select("kredit_rekening t", "COUNT(t.rekening) id", $where,$join, "t.rekening", "t.rekening ASC") ;  
      $row      = $this->rows($dba) ;
      
      return array("db"=>$dbd, "rows"=> $row ) ;  
   }  
 
}
?>
