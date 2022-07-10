<?php
class Load extends Bismillah_Controller{
   private $bdb ;
   public function __construct(){
      parent::__construct() ;
      $this->load->model('load_m') ;
      $this->bdb    = $this->load_m ;
   }

   public function load_rekening(){
      $q    = $this->input->get('q') ;
      $vare = array() ;  
      $w    = "(keterangan LIKE '%". $this->bdb->escape_like_str($q) ."%' OR kode LIKE '%". $this->bdb->escape_like_str($q) ."%') and jenis='D'" ;
      $dbd  = $this->bdb->select("keuangan_rekening", "id, kode ,keterangan", $w, "", "", "kode ASC") ;
      while($dbr    = $this->bdb->getrow($dbd)){
         $vare[]    = array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - "  . $dbr['keterangan']) ;
      }
      echo(json_encode($vare)) ; 
   }
    
   public function load_export(){
      $vare = array() ;  
      $vare[]    = array("id"=>'0', "text"=>"PDF") ;
      $vare[]    = array("id"=>'1', "text"=>"CSV") ;
      $vare[]    = array("id"=>'2', "text"=>"XLSX") ;
      echo(json_encode($vare)) ; 
   }
}
?>
