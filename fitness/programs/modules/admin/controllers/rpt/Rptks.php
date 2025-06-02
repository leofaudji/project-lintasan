<?php
class Rptks extends Bismillah_Controller{
   protected $bdb ;
   protected $ss ;
   public function __construct(){
      parent::__construct() ;
      $this->load->helper('toko');
      $this->load->model("load_m") ;
		$this->bdb 	= $this->load_m ;
      $this->ss  = "ssrptks_" ;
   }

   public function index(){
      savesession($this, $this->ss . "kode_jenis", "") ;
      $d    = array("setdate"=>date_set()) ;
      $this->load->view('rpt/rptks', $d) ;
   }

   public function setkode_jenis(){
      $va 	= $this->input->post() ;
      savesession($this, $this->ss . "kode_jenis", $va['kode']) ;
   }

   public function initreport(){
      $va 	= $this->input->post() ;
      $s    = intval($va['s']) ;
      $e    = intval($va['e']) ;

      $j    = "" ;
      $w    = array() ;
      $tgl = date_2s($va['tgl']) ;
      $w[] = "tgl = " . $this->bdb->escape($tgl) ;
      $w    = implode(" AND ", $w) ;

      if($e == 0){
         $e      = 0 ;
         $db     = $this->bdb->select("v_gr_konversi", "COUNT(id) id", $w, $j) ; //kudu ngawe view
         if($r= $this->bdb->getrow($db)){
            $e   = $r['id'] ;
         }
         $file   = setfile($this, "rpt", __FILE__ , $va) ;
         savesession($this, $this->ss . "file", $file ) ;
         savesession($this, $this->ss . "va", json_encode($va) ) ;
         file_put_contents($file, json_encode(array()) ) ;
      }

      if($e > 0){
         $file   = getsession($this, $this->ss . "file") ;
         $data   = @file_get_contents($file) ;
			$data   = json_decode($data,true) ;
         $db     = $this->bdb->select("v_gr_konversi", "*", $w, $j, "", "id ASC" ,$s.",100") ;
         while($r= $this->bdb->getrow($db)){
            $s++ ;
            $f      = "<b>" . $r['faktur'] . "</b>" . chr(13) . chr(10) .
                        "Tanggal: " . date("d-m-Y", strtotime($r['tgl'])) ;
            $ket    = array($r['keterangan']);
            $ket    = implode(chr(13) . chr(10) , $ket) ;
            $data[] = array("FAKTUR"=>$f,"BARANG;KONVERSI"=>$r['nama_brg'], "BARANG;K.QTY"=>($r['qty']),
                           "BARANG;TUJUAN"=>$r['nama_brg_tujuan'], "BARANG;T.QTY"=>($r['qty_tujuan']),
                           "HARGA"=>number_format($r['harga']), "TOTAL"=>number_format($r['total']),
                           "KET"=>$ket) ;

         }

         if($s < $e){
				file_put_contents($file, json_encode($data) ) ;
				echo(' bos.rptks.initreport('.$s.','.$e.') ') ;
         }else{
            file_put_contents($file, json_encode($data) ) ;
				echo(' bos.rptks.openreport() ; ') ;
         }
      }else{
			echo('alert("Maaf Data Kosong") ; bos.rptks.cmdview.button("reset") ;') ;
		}
   }

   public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $file = getsession($this, $this->ss . "file") ;
      $data = @file_get_contents($file) ;
      $data = json_decode($data,true) ;
      if(!empty($data)){
         $font = 8 ;
         $o    = array('paper'=>'A4', 'orientation'=>'landscape', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                        'opt'=>array('export_name'=>'DaftarSupplier_' . getsession($this, "username") ) ) ;
         $this->load->library('bospdf', $o) ;
         $this->bospdf->ezText("<b>DAFTAR KONVERSI BARANG</b>",$font+4,array("justification"=>"center")) ;
         if($va['retur_faktur'] == "0")
            $this->bospdf->ezText("Tanggal: " . $va['tgl'],$font+2,array("justification"=>"center")) ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($data,"","",
            array("fontSize"=>$font,
						"cols"=> array(
                     "FAKTUR"=>array("width"=>15,"wrap"=>1),
                     "BARANG;KONVERSI"=>array("width"=>20,"wrap"=>1),
                     "BARANG;K.QTY"=>array("width"=>4,"wrap"=>1,"justification"=>"right"),
                     "BARANG;TUJUAN"=>array("width"=>20,"wrap"=>1),
                     "BARANG;T.QTY"=>array("width"=>4,"wrap"=>1,"justification"=>"right"),
                     "HARGA"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
                     "TOTAL"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
                     "KET"=>array("wrap"=>1))
				)
      	) ;
         $this->bospdf->ezStream() ;
      }else{
         echo('data kosong') ;
      }
   }
}
?>
