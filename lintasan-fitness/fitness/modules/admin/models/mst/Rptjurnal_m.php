<?php
class Rptjurnal_m extends Bismillah_Model{
   public function getfaktur($l=true){
      $k       = "JR" . date("ymd") ; 
      return $k . $this->getincrement($k, $l, 4) ; 
   }
 
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ; 
      $where    = array("tgl >= '".date_2s($va['tglawal'])."' and tgl <= '".date_2s($va['tglakhir'])."'") ;    
      if($search !== "") $where[]   = "(b.rekening LIKE '{$search}%' OR b.keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  
      
      $f        = "b.id no,b.tgl,b.faktur,b.rekening,b.keterangan,b.debet,b.kredit,b.username" ;     
      $join     = "left join keuangan_rekening r on r.kode = b.rekening"  ;
      $dbd      = $this->select("keuangan_bukubesar b", $f, $where, $join, "", "b.id ASC", $limit) ;
 
      $row      = 0 ;
      $dba      = $this->select("keuangan_bukubesar b", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){   
         $row   = $dbra['id'] ;
      } 

      return array("db"=>$dbd, "rows"=> $row ) ;
   }  
}
?>
