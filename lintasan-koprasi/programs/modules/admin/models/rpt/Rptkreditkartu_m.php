<?php
class Rptkreditkartu_m extends Bismillah_Model{ 
   
   public function loadgrid($va){  
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ;
      $va['tgl'] = date_2s($va['tgl']) ;   
      $where    = array("t.id_kantor = '$id_kantor' AND tm.rekening = '".$va['rekening']."' AND tm.tgl <= '".$va['tgl']."'") ;       
      if($search !== "") $where[]   = "(t.rekening LIKE '{$search}%' OR m.nama LIKE '%{$search}%' OR m.alamat LIKE '%{$search}%' OR m.telepon LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  

      $f        = "tm.id,tm.tgl,t.rekening,m.nama,tm.keterangan,tm.dpokok,tm.kpokok,tm.dbunga,tm.kbunga,tm.denda,tm.datetime,tm.username" ;    
      $join     = "left join kredit_rekening t on t.id_kantor = tm.id_kantor AND t.rekening = tm.rekening
                   left join mst_anggota m on t.id_kantor = m.id_kantor and m.kode = t.kode_anggota"  ;
      $dbd      = $this->select("kredit_angsuran tm", $f, $where, $join, "", "tm.tgl ASC", $limit) ;

      $row      = 0 ;  
      $dba      = $this->select("kredit_angsuran tm", "COUNT(tm.id) id", $where,$join) ;  
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ; 
   }  
 
}
?>
