<?php
class Rptlk extends Bismillah_Controller{
   protected $bdb ;
   protected $ss ;
   public function __construct(){
      parent::__construct() ;
      $this->load->helper('toko');
      $this->load->model("load_m") ;
		$this->bdb 	= $this->load_m ;
      $this->ss  = "ssrptlk_" ;
   }

   public function index(){
      savesession($this, $this->ss . "kode_jenis", "") ;
      $d    = array("setdate"=>date_set()) ;
      $this->load->view('rpt/rptlk', $d) ;
   }

   public function initreport(){
      $va 	= $this->input->post() ;
      $s    = intval($va['s']) ;
      $e    = intval($va['e']) ;

      $j    = "" ;
      $w    = array() ;
      $tglaw= date_2s($va['tgl_awal']) ;
      $tglak= date_2s($va['tgl_akhir']) ;
      $w[]  = "tgl >= " . $this->bdb->escape($tglaw) . " AND tgl <= " . $this->bdb->escape($tglak) ;
      $w    = implode(" AND ", $w) ;

      if($e == 0){
         $e      = 0 ;
         $db     = $this->bdb->select("v_rpt_laba_kotor", "COUNT(id) id", $w, $j) ; //kudu ngawe view
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
         $db     = $this->bdb->select("v_rpt_laba_kotor", "*", $w, $j, "", "id ASC" ,$s.",100") ;
         while($r= $this->bdb->getrow($db)){
            $s++ ;
            $f      = "<b>" . $r['faktur'] . "</b>" . chr(13) . chr(10) .
                        "Tanggal: " . date("d-m-Y", strtotime($r['tgl'])) ;
            $ket    = "" ;
            if($r['retur_faktur'] !== ""){
               $ket = "<b>Retur: ".$r['retur_faktur']."</b> " .
                       date("d-m-Y", strtotime($r['retur_tgl'])) . " - " . $r['retur_keterangan'] ;
            }
            if($r['retur_faktur'] !== ""){
               $r['total_sub'] = 0 ;
               $r['hp']    = 0 ;
            }
            $data[] = array("FAKTUR"=>$f,"BARANG"=>$r['brg_nama'], "QTY"=>($r['qty']),
                           "HARGA"=>number_format($r['harga']),
                           "TOTAL"=>$r['total_sub'],
                           "HPP"=>$r['hp'],
                           "LK"=>$r['total_sub']-$r['hp'],
                           "KET"=>$ket) ;

         }

         if($s < $e){
				file_put_contents($file, json_encode($data) ) ;
				echo(' bos.rptlk.initreport('.$s.','.$e.') ') ;
         }else{
            //total
            $tot    = array("total"=>0, "hpp"=>0, "lk"=>0) ;
            foreach ($data as $key => $value) {
               $data[$key]['TOTAL'] = number_format($value['TOTAL']) ;
               $data[$key]['HPP']   = number_format($value['HPP']) ;
               $data[$key]['LK']    = number_format($value['LK']) ;

               $tot['total'] += $value['TOTAL'] ;
               $tot['hpp']   += $value['HPP'] ;
               $tot['lk']    += $value['LK'] ;
            }
            $data[] = array("FAKTUR"=>"","BARANG"=>"", "QTY"=>"",
                           "HARGA"=>number_format($r['harga']),
                           "TOTAL"=>"<b>".number_format($tot['total'])."</b>",
                           "HPP"=>"<b>".number_format($tot['hpp'])."</b>",
                           "LK"=>"<b>".number_format($tot['lk'])."</b>",
                           "KET"=>"") ;

            file_put_contents($file, json_encode($data) ) ;
				echo(' bos.rptlk.openreport() ; ') ;
         }
      }else{
			echo('alert("Maaf Data Kosong") ; bos.rptlk.cmdview.button("reset") ;') ;
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
         $this->bospdf->ezText("<b>LABA KOTOR</b>",$font+4,array("justification"=>"center")) ;
         $this->bospdf->ezText("Tanggal: " . $va['tgl_awal'] . " s/d "  .$va['tgl_akhir'],$font+2,array("justification"=>"center")) ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($data,"","",
            array("fontSize"=>$font,
						"cols"=> array(
                     "FAKTUR"=>array("width"=>15,"wrap"=>1),
                     "BARANG"=>array("width"=>40,"wrap"=>1),
                     "QTY"=>array("width"=>4,"wrap"=>1,"justification"=>"right"),
                     "HARGA"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
                     "TOTAL"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
                     "HPP"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
                     "LK"=>array("width"=>6,"wrap"=>1,"justification"=>"right"),
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
