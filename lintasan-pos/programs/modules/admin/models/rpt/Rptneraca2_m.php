<?php
class Rptneraca2_m extends Bismillah_Model{
   public function loadgrid($va){  
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ; 
      $where    = array("kode like '1%'") ;     
      if($search !== "") $where[]   = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  

      $f        = "kode,keterangan" ;      
      $dbd      = $this->select("keuangan_rekening", $f, $where, "", "", "kode ASC") ;

      $row      = 0 ; 
      $row1     = 0 ;
      $row23    = 0 ; 
      $dba      = $this->select("keuangan_rekening", "id,kode", $where) ;
      while($dbra  = $this->getrow($dba)){      
         if(substr($dbra['kode'],0,1) == "1") $row1++ ;
         ++$row ;
      } 

      return array("db"=>$dbd, "rows"=> $row,"row1"=>$row1) ;   
   } 

   public function loadgrid2($va){    
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ; 
      $where    = array("kode >= '2' and kode < '4'") ;     
      if($search !== "") $where[]   = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  

      $f        = "kode,keterangan" ;     
      $dbd      = $this->select("keuangan_rekening", $f, $where, "", "", "kode ASC") ;

      $row      = 0 ;
      $row1     = 0 ;
      $row23    = 0 ;
      $dba      = $this->select("keuangan_rekening", "id,kode", $where) ;
      while($dbra  = $this->getrow($dba)){      
         ++$row23 ; 
      } 

      return array("db"=>$dbd, "rows"=> $row,"row1"=>$row1,"row23"=>$row23) ;   
   }
}
?>
