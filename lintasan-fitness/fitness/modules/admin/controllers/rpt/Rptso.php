<?php
class Rptso extends Bismillah_Controller{
   protected $bdb ;
   protected $ss ;
   public function __construct(){
      parent::__construct() ;
      $this->load->helper('toko');
      $this->load->model("load_m") ;
		$this->bdb 	= $this->load_m ;
      $this->ss  = "ssrptso_" ;
   }

   public function index(){
      savesession($this, $this->ss . "kode_jenis", "") ;
      $d    = array("setdate"=>date_set()) ;
      $this->load->view('rpt/rptso', $d) ;
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
      if($va['faktur'] !== ""){
         $w[] = "faktur = " . $this->bdb->escape($va['faktur']) ;
      }else{
         $tgl = date_2s($va['tgl']) ;
         $w[] = "tgl = " . $this->bdb->escape($tgl) ;
      }
      $w    = implode(" AND ", $w) ;

      if($e == 0){
         $e      = 0 ;
         $db     = $this->bdb->select("v_rpt_opname", "COUNT(id) id", $w, $j) ; //kudu ngawe view
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
         $db     = $this->bdb->select("v_rpt_opname", "*", $w, $j, "", "id ASC" ,$s.",100") ;
         while($r= $this->bdb->getrow($db)){
            $s++ ;
            $f      = "<b>" . $r['faktur'] . "</b>" ;
            $brg    = $r['brg_nama'] ;
            $ket    = array();
            $data[] = array("FAKTUR"=>$f, "TGL"=>date("d-m-Y", strtotime($r['tgl'])),
                            "BARANG"=>$brg, "STOK;AWAL"=>($r['stok']), "STOK;BENAR"=>($r['stok_ac']),
                            "STOK;SELISIH"=>($r['qty']), "HARGA"=>number_format($r['harga']),
                            "U/R"=>$r['total'], "KET"=>$r['keterangan']) ;

         }

         if($s < $e){
				file_put_contents($file, json_encode($data) ) ;
				echo(' bos.rptso.initreport('.$s.','.$e.') ') ;
         }else{
            //total
            $tot    = array("total"=>0) ;
            foreach ($data as $key => $value) {
               $data[$key]['U/R'] = number_format($value['U/R']) ;

               $tot['total'] += $value['U/R'] ;
            }
            $data[] = array("FAKTUR"=>"","BARANG"=>"",
                            "STOK;AWAL"=>"", "STOK;BENAR"=>"",
                            "STOK;SELISIH"=>"","HARGA"=>"",
                            "U/R"=>"<b>".number_format($tot['total'])."</b>", "KET"=>"") ;
            file_put_contents($file, json_encode($data) ) ;
				echo(' bos.rptso.openreport() ; ') ;
         }
      }else{
			echo('alert("Maaf Data Kosong") ; bos.rptso.cmdview.button("reset") ;') ;
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
         $this->bospdf->ezText("<b>DAFTAR STOK OPNAME BARANG</b>",$font+4,array("justification"=>"center")) ;
         if($va['faktur'] == "")
            $this->bospdf->ezText("Tanggal: " . $va['tgl'],$font+2,array("justification"=>"center")) ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($data,"","",
            array("fontSize"=>$font,
						"cols"=> array(
                     "FAKTUR"=>array("width"=>8,"wrap"=>1),
                     "TGL"=>array("width"=>6,"wrap"=>1,"justification"=>"center"),
                     "BARANG"=>array("width"=>40,"wrap"=>1),
                     "STOK;AWAL"=>array("width"=>5,"wrap"=>1,"justification"=>"right"),
                     "STOK;BENAR"=>array("width"=>5,"wrap"=>1,"justification"=>"right"),
                     "STOK;SELISIH"=>array("width"=>5,"wrap"=>1,"justification"=>"right"),
                     "HARGA"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
                     "U/R"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
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
