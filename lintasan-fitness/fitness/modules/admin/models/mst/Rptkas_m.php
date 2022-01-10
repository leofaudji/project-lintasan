<?php
class Rptkas_m extends Bismillah_Model{
   public function getfaktur($l=true){
      $k       = "JR" . date("ymd") ; 
      return $k . $this->getincrement($k, $l, 4) ; 
   }
 
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ; 
      $where    = array("b.tgl >= '".date_2s($va['tglawal'])."' and b.tgl <= '".date_2s($va['tglakhir'])."' and b.rekening like '1.102%' ") ;    
      if($search !== "") $where[]   = "(b.rekening LIKE '{$search}%' OR b.keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;   
       
      $f        = "b.id no,b.tgl,b.faktur,b.rekening,b.keterangan,b.debet,b.kredit,b.kredit total,b.kredit jumlah,b.username" ;      
      $join     = "left join keuangan_rekening r on r.kode = b.rekening"  ;
      $dbd      = $this->select("keuangan_bukubesar b", $f, $where, $join, "", "b.id ASC", $limit) ;
 
      $row      = 0 ;
      $dba      = $this->select("keuangan_bukubesar b", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      } 

      $saldoawal = 0 ;      
      $where = "b.tgl < '".date_2s($va['tglawal'])."' and b.rekening like '1.102%'" ;
      $dba      = $this->select("keuangan_bukubesar b","sum(b.debet-b.kredit) saldoawal", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $saldoawal   = $dbra['saldoawal'] ;
      } 
 
      return array("db"=>$dbd, "rows"=> $row,"saldoawal"=>$saldoawal ) ; 
   } 
   
}
?>
