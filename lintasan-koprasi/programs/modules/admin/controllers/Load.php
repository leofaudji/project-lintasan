<?php
class Load extends Bismillah_Controller{
   private $bdb ;
   public function __construct(){
      parent::__construct() ;
      $this->load->model('load_m') ;
      $this->bdb    = $this->load_m ;
   }

   public function load_level(){
      $q      = $this->input->get('q') ;
      $vare   = array() ;
      $vare[] = array("id"=>"0000","text"=>"0000 - Administrator") ;
      $w      = "code LIKE '". $this->bdb->escape_like_str($q) ."%' OR name LIKE '". $this->bdb->escape_like_str($q) ."%'" ;
      $dbd  = $this->bdb->select("sys_username_level", "code, name", $w, "", "", "code ASC", "0,5") ;
      while($dbr    = $this->bdb->getrow($dbd)){
         $vare[]    = array("id"=>$dbr['code'], "text"=>$dbr['code'] . ' - ' . $dbr['name'] ) ;
      }
      echo(json_encode($vare)) ;
   }

   public function load_pelanggan(){
      $q    = $this->input->get('q') ;
      $vare = array() ; 
      $w    = "nama LIKE '%". $this->bdb->escape_like_str($q) ."%' OR kode LIKE '%". $this->bdb->escape_like_str($q) ."%'" ;
      $dbd  = $this->bdb->select("pelanggan", "id, kode ,nama", $w, "", "", "kode ASC", "0,5") ;
      while($dbr    = $this->bdb->getrow($dbd)){
         $vare[]    = array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - "  . $dbr['nama']) ;
      }
      echo(json_encode($vare)) ;
   }

   public function load_rekening(){
      $q    = $this->input->get('q') ;
      $vare = array() ;  
      $w    = "(keterangan LIKE '%". $this->bdb->escape_like_str($q) ."%' OR kode LIKE '%". $this->bdb->escape_like_str($q) ."%') and jenis='D'" ;
      $dbd  = $this->bdb->select("keuangan_rekening", "id, kode ,keterangan", $w, "", "", "kode ASC", "0,5") ;
      while($dbr    = $this->bdb->getrow($dbd)){
         $vare[]    = array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - "  . $dbr['keterangan']) ;
      }
      echo(json_encode($vare)) ; 
   }

   public function load_rate(){
      $q    = $this->input->get('q') ;
      $vare = array() ;  
      $w    = "(golongan_tabungan LIKE '%". $this->bdb->escape_like_str($q) ."%' OR sukubunga LIKE '%". $this->bdb->escape_like_str($q) ."%')" ;
      $dbd  = $this->bdb->select("tabungan_rate", "id,golongan_tabungan,sukubunga", $w, "", "", "golongan_tabungan DESC", "0,5") ;
      while($dbr    = $this->bdb->getrow($dbd)){
         $vare[]    = array("id"=>$dbr['golongan_tabungan'], "text"=>$dbr['golongan_tabungan'] . " - "  . $dbr['sukubunga'] . " % ") ; 
      }
      echo(json_encode($vare)) ; 
   }
}
?>
