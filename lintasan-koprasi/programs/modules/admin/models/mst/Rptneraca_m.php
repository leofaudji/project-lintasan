<?php
class Rptneraca_m extends Bismillah_Model{
   public function getfaktur($l=true){
      $k       = "JR" . date("ymd") ; 
      return $k . $this->getincrement($k, $l, 4) ; 
   } 
 
   public function loadgrid($va){  
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ; 
      $where    = array("kode like '1%'") ;     
      if($search !== "") $where[]   = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  
      
      $f        = "kode,keterangan" ;      
      $dbd      = $this->select("keuangan_rekening", $f, $where, "", "", "kode ASC", $limit) ;

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
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ; 
      $where    = array("kode >= '2' and kode < '4'") ;     
      if($search !== "") $where[]   = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  
      
      $f        = "kode,keterangan" ;     
      $dbd      = $this->select("keuangan_rekening", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $row1     = 0 ;
      $row23    = 0 ;
      $dba      = $this->select("keuangan_rekening", "id,kode", $where) ;
      while($dbra  = $this->getrow($dba)){      
         ++$row23 ; 
      } 

      return array("db"=>$dbd, "rows"=> $row,"row1"=>$row1,"row23"=>$row23) ;   
   } 

   public function getsaldoawal($tgl,$rekening){
      $c = substr($rekening,0,1) ;
      $tgl = date_2s($tgl) ; 
      if($c == "1" || $c == "5"){
         $f = "sum(debet-kredit) saldoawal" ; 
      }else{
         $f = "sum(kredit-debet) saldoawal" ;
      }
      $saldo = 0 ;
      $where = "tgl <= '".$tgl."' and rekening like '".$rekening."%'" ;
      $data = $this->select("keuangan_bukubesar", $f, $where) ;
      if($row = $this->getrow($data)){
         $saldo = $row['saldoawal'] ;
      }
      return $saldo ;    
   }


   public function getdebet($tgl,$rekening){
      $c = substr($rekening,0,1) ;
      $tgl = date_2s($tgl) ; 
      $f = "sum(debet) saldoawal" ; 
      $saldo = 0 ;
      $where = "tgl = '".$tgl."' and rekening like '".$rekening."%'" ;
      $data = $this->select("keuangan_bukubesar", $f, $where) ;
      if($row = $this->getrow($data)){
         $saldo = $row['saldoawal'] ;
      }
      return $saldo ;    
   }

   public function getkredit($tgl,$rekening){
      $c = substr($rekening,0,1) ;
      $tgl = date_2s($tgl) ; 
      $f = "sum(kredit) saldoawal" ; 
      $saldo = 0 ;
      $where = "tgl = '".$tgl."' and rekening like '".$rekening."%'" ;
      $data = $this->select("keuangan_bukubesar", $f, $where) ;
      if($row = $this->getrow($data)){
         $saldo = $row['saldoawal'] ;
      } 
      return $saldo ;      
   }   
 
}
?>
