<?php
class Rptk extends Bismillah_Controller{
   protected $bdb ;
   protected $ss ;
   public function __construct(){
      parent::__construct() ;
      $this->load->helper('toko');
      $this->load->model("load_m") ;
		$this->bdb 	= $this->load_m ;
      $this->ss  = "ssrptk_" ;
   }

   public function index(){
      savesession($this, $this->ss . "kode_jenis", "") ;
      $d    = array("setdate"=>date_set()) ;
      $this->load->view('rpt/rptk', $d) ;
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
         $w[] = "tgl_aktif = " . $this->bdb->escape($tgl) ;
         if($va['retur_faktur'] == "1"){
            $w[] = "retur_faktur <> ''" ;
         }else{
            $w[] = "retur_faktur = ''" ;
         }
      }
      $w    = implode(" AND ", $w) ;

      if($e == 0){
         $e      = 0 ;
         $db     = $this->bdb->select("v_rpt_konsiyasi", "COUNT(id) id", $w, $j) ; //kudu ngawe view
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
         $db     = $this->bdb->select("v_rpt_konsiyasi", "*", $w, $j, "", "id ASC" ,$s.",100") ;
         while($r= $this->bdb->getrow($db)){
            $s++ ;
            $f      = "<b>" . $r['faktur'] . "</b>" . chr(13) . chr(10) .
                        "Barang diterima: " . date("d-m-Y", strtotime($r['tgl_aktif'])) ;
            $sup    = $r['sup_kode'] . " - " . $r['sup_nama'] ;
            $brg    = $r['brg_sku'] . " - " . $r['brg_nama'] ;
            $ket    = array();
            if($r['keterangan'] !== "") $ket[] = $r['keterangan'] ;
            if($r['retur_faktur'] <> ''){
               $ket[]= "<b>Retur: ".$r['retur_faktur']."</b> " .
                        date("d-m-Y", strtotime($r['retur_tgl'])) . " - " . $r['retur_keterangan'] ;
            }
            $ket    = implode(chr(13) . chr(10) , $ket) ;
            $data[] = array("FAKTUR"=>$f, "SUPPLIER"=>$sup,
                            "BARANG"=>$brg, "QTY;AWAL"=>($r['qty']),"QTY;SISA"=>($r['qty_sisa']),
                            "HARGA"=>($r['harga']),
                            "BAYAR"=>$r['retur_bayar'], "KET"=>$ket) ;

         }

         if($s < $e){
				file_put_contents($file, json_encode($data) ) ;
				echo(' bos.rptk.initreport('.$s.','.$e.') ') ;
         }else{
            //total
            $tot    = array("total"=>0, "qtya"=>0, "qtys"=>0) ;
            foreach ($data as $key => $value) {
               $data[$key]['HARGA'] = number_format($value['HARGA']) ;
               $data[$key]['QTY;AWAL']   = number_format($value['QTY;AWAL']) ;
               $data[$key]['QTY;SISA']   = number_format($value['QTY;SISA']) ;
               $data[$key]['BAYAR']      = number_format($value['BAYAR']) ;

               $tot['total'] += $value['BAYAR'] ;
               $tot['qtya']  += $value['QTY;AWAL'] ;
               $tot['qtys']  += $value['QTY;SISA'] ;
            }
            $data[] = array("FAKTUR"=>"", "SUPPLIER"=>"","BARANG"=>"",
                            "QTY;AWAL"=>"<b>".number_format($tot['qtya'])."</b>",
                            "QTY;SISA"=>"<b>".number_format($tot['qtys'])."</b>","HARGA"=>"",
                            "BAYAR"=>"<b>".number_format($tot['total'])."</b>", "KET"=>"") ;
            file_put_contents($file, json_encode($data) ) ;
				echo(' bos.rptk.openreport() ; ') ;
         }
      }else{
			echo('alert("Maaf Data Kosong") ; bos.rptk.cmdview.button("reset") ;') ;
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
         $this->bospdf->ezText("<b>DAFTAR KONSIYASI BARANG</b>",$font+4,array("justification"=>"center")) ;
         if($va['faktur'] == "")
            $this->bospdf->ezText("Tanggal: " . $va['tgl'],$font+2,array("justification"=>"center")) ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($data,"","",
            array("fontSize"=>$font,
						"cols"=> array(
                     "FAKTUR"=>array("width"=>15,"wrap"=>1),
                     "SUPPLIER"=>array("width"=>20,"wrap"=>1),
                     "BARANG"=>array("width"=>20,"wrap"=>1),
                     "QTY;AWAL"=>array("width"=>4,"wrap"=>1,"justification"=>"right"),
                     "QTY;SISA"=>array("width"=>4,"wrap"=>1,"justification"=>"right"),
                     "HARGA"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
                     "BAYAR"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
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
