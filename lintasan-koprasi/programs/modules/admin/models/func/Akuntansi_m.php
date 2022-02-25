<?php
class Akuntansi_m extends Bismillah_Model{

   public function getfaktur($f="JR",$l=true){ 
      $k       = $f . getsession($this,"kode_kantor") . date("ymd") ;           
      return $k . $this->getincrement($k, $l, 6) ;    
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
      $id_kantor = getsession($this,"id_kantor") ;
      $where = "id_kantor = '$id_kantor' AND tgl <= '".$tgl."' and rekening like '".$rekening."%'" ;
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
      $id_kantor = getsession($this,"id_kantor") ;
      $where = "id_kantor = '$id_kantor' AND tgl = '".$tgl."' and rekening like '".$rekening."%'" ;
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
      $id_kantor = getsession($this,"id_kantor") ;
      $where = "id_kantor = '$id_kantor' AND tgl = '".$tgl."' and rekening like '".$rekening."%'" ;
      $data = $this->select("keuangan_bukubesar", $f, $where) ;
      if($row = $this->getrow($data)){
         $saldo = $row['saldoawal'] ;
      } 
      return $saldo ;      
   }   

   
  

}
?>
