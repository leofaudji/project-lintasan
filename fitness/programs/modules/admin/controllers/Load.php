<?php
class Load extends Bismillah_Controller{
   private $bdb ;
   public function __construct(){
      parent::__construct() ;
      $this->load->model('load_m') ;
      $this->bdb    = $this->load_m ;
   }

   public function load_id_supplier(){
      $q    = $this->input->get('q') ;
      $vare = array() ;
      $w    = "nama LIKE '%". $this->bdb->escape_like_str($q) ."%' OR kode LIKE '%". $this->bdb->escape_like_str($q) ."%'" ;
		$dbd 	= $this->bdb->select("mst_supplier", "id, kode ,nama", $w, "", "", "", "0,5") ;
		while($dbr    = $this->bdb->getrow($dbd)){
			$vare[]    = array("id"=>$dbr['id'], "text"=>$dbr['kode'] . " - "  . $dbr['nama']) ;
		}
		echo(json_encode($vare)) ;
   }

   public function load_id_pelanggan(){
      $q    = $this->input->get('q') ;
      $vare = array() ;
      $w    = "nama LIKE '%". $this->bdb->escape_like_str($q) ."%' OR kode LIKE '%". $this->bdb->escape_like_str($q) ."%'" ;
		$dbd 	= $this->bdb->select("mst_pelanggan", "id, kode ,nama", $w, "", "", "", "0,5") ;
		while($dbr    = $this->bdb->getrow($dbd)){
			$vare[]    = array("id"=>$dbr['id'], "text"=>$dbr['kode'] . " - "  . $dbr['nama']) ;
		}
		echo(json_encode($vare)) ;
   }

   public function load_id_brg(){
      $q    = $this->input->get('q') ;
      $vare = array() ;
      $w    = "(nama LIKE '%". $this->bdb->escape_like_str($q) ."%' OR sku LIKE '%". $this->bdb->escape_like_str($q) ."%')" ;
		$dbd 	= $this->bdb->select("mst_brg", "id, sku ,nama", $w, "", "", "", "0,5") ;
		while($dbr    = $this->bdb->getrow($dbd)){
			$vare[]    = array("id"=>$dbr['id'], "text"=>$dbr['nama'] . " (".$dbr['sku'].")") ;
		}
		echo(json_encode($vare)) ;
   }

   public function load_id_brg_po(){
      $q    = $this->input->get('q') ;
      $vare = array() ;
      $ss   = getsession($this, "ssbrg_jenis", "0") ;
      $w    = "(nama LIKE '%". $this->bdb->escape_like_str($q) ."%' OR sku LIKE '%". $this->bdb->escape_like_str($q) ."%')" ;
      $w   .= " AND jenis = " . $ss ;
		$dbd 	= $this->bdb->select("mst_brg", "id, sku ,nama", $w, "", "", "", "0,5") ;
		while($dbr    = $this->bdb->getrow($dbd)){
			$vare[]    = array("id"=>$dbr['id'], "text"=>$dbr['nama'] . " (".$dbr['sku'].")") ;
		}
		echo(json_encode($vare)) ;
   }

   public function load_brg_kat(){
      $q    = $this->input->get('q') ;
		$vare = array() ;
      $w    = "kategori LIKE '%". $this->bdb->escape_like_str($q) ."%'" ;
		$dbd 	= $this->bdb->select("mst_brg_kat", "id, kategori", $w, "", "", "", "0,5") ;
		while($dbr    = $this->bdb->getrow($dbd)){
			$vare[]    = array("id"=>$dbr['id'], "text"=>$dbr['kategori']) ;
		}
		echo(json_encode($vare)) ;
   }

   public function load_brg_sat(){
      $q    = strtolower($this->input->get('q')) ;
		$vare = array() ;
      $va   = $this->bdb->getconfig("brg_satuan") ;
      if($va !== "") $va    = json_decode($va, true) ;
      foreach ($va as $key => $value) {
         $v       = TRUE ;
         if(trim($q) !== ""){
            $v    = (strpos(strtolower($value), $q) > -1) ? TRUE : FALSE ;
         }
         if($v){
            $vare[]  = array("id"=>$value, "text"=>$value) ;
         }
      }

		echo(json_encode($vare)) ;
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

   public function load_tarif(){
      $q    = $this->input->get('q') ;
      $vare = array() ; 
      $w    = "keterangan LIKE '%". $this->bdb->escape_like_str($q) ."%' OR kode LIKE '%". $this->bdb->escape_like_str($q) ."%'" ;
      $dbd  = $this->bdb->select("tarif", "id, kode ,keterangan", $w, "", "", "kode ASC", "0,10") ;
      while($dbr    = $this->bdb->getrow($dbd)){
         $vare[]    = array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - "  . $dbr['keterangan']) ;
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
}
?>
