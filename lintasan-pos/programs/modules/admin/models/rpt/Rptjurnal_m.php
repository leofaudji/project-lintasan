<?php
class Rptjurnal_m extends Bismillah_Model{
   public function loadgrid($va){ 
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ; 
      $where    = array("tgl >= '".date_2s($va['tglawal'])."' and tgl <= '".date_2s($va['tglakhir'])."'") ;    
      $where    = implode(" AND ", $where) ; 
      
      $f        = "b.id no,b.tgl,b.faktur,concat(r.jenis,'--',b.rekening) as rekening,r.keterangan as ketrekening,b.keterangan,b.debet,b.kredit,b.username" ;     
      $join     = "left join keuangan_rekening r on r.kode = b.rekening"  ;
      $dbd      = $this->select("keuangan_bukubesar b", $f, $where, $join, "", "b.id ASC") ;
 
      $row      = 0 ;
      $dba      = $this->select("keuangan_bukubesar b", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){   
         $row   = $dbra['id'] ;
      } 

      return array("db"=>$dbd, "rows"=> $row ) ;
   }  
}
?>
