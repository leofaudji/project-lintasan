<?php

class Rptreturstock extends Bismillah_Controller{
   protected $bdb ;
   protected $ss ;
   protected $abc ;
   public function __construct(){
      parent::__construct() ;
      $this->load->helper('bdate');
      $this->load->model('rpt/rptreturstock_m') ;
      $this->load->model('func/Perhitungan_m') ;
      $this->bdb = $this->rptreturstock_m ;
      $this->ss  = "ssrptreturstock_" ;
   }

   public function index(){
      $d    = array("setdate"=>date_set()) ;
      $this->load->view('rpt/rptreturstock', $d) ;
   }

   public function loadgrid(){
      $va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $va['tglAwal'] = date_2s($va['tglAwal']);
      $va['tglAkhir'] = date_2s($va['tglAkhir']);
      $vdb    = $this->rptreturstock_m->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->rptreturstock_m->getrow($dbd) ){
         $vaset   = $dbr ;
         $vaset['tgl'] = date_2d($vaset['tgl']);
         $vaset['cmdPreview']    = '<button type="button" onClick="bos.rptreturstock.cmdpreviewdetail(\''.$dbr['faktur'].'\')"
                                     class="btn btn-success btn-grid">Preview Detail</button>' ;
         $vaset['cmdPreview']    = html_entity_decode($vaset['cmdPreview']) ;
         $vare[]     = $vaset ;
      }

      $vare    = array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
   }

   public function PreviewDetailPembelianStock(){
      $va    = $this->input->post() ;
      $cFaktur = $va['faktur'] ;
      echo('w2ui["bos-form-rptreturstock_grid2"].clear();');
      $data = $this->rptreturstock_m->GetDataPerFaktur($cFaktur) ;
      if(!empty($data)){
         echo('
                  with(bos.rptreturstock.obj){
                     find("#faktur").val("'.$data['faktur'].'") ;
                     find("#supplier").val("'.$data['supplier'].'") ;
                     find("#subtotal").val("'.$data['subtotal'].'") ;
                     find("#total").val("'.$data['total'].'") ;
                     find("#tgl").val("'.$data['Tgl'].'") ;
                  }

              ') ;
         $data = $this->rptreturstock_m->getDetailReturPembelian($cFaktur) ;
         $vare = array();
         $n = 0 ;
         while($dbr = $this->rptreturstock_m->getrow($data)){
            $n++;
            $vaset          = $dbr ;
            $vaset['recid'] = $n;
            $vaset['no']    = $n;
            $vare[]         = $vaset ;
         }

         $vare = json_encode($vare);
         echo('
            bos.rptreturstock.loadmodalpreview("show") ;
            bos.rptreturstock.grid2_reloaddata();
            w2ui["bos-form-rptreturstock_grid2"].add('.$vare.');
         ');
      }
   }

   public function initreport(){
      $va      = $this->input->post() ;
      $cFaktur  = $va['cFaktur'];
      $w    = "p.faktur = '".$cFaktur."'" ;

      $file   = setfile($this, "rpt", __FILE__ , $va) ;
      savesession($this, $this->ss . "file", $file ) ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      file_put_contents($file, json_encode(array()) ) ;

      $file    = getsession($this, $this->ss . "file") ;
      $data    = @file_get_contents($file) ;
      $data    = json_decode($data,true) ;
      $db      = $this->bdb->getDetailReturPembelian($cFaktur) ;
      $nDebet  = 0 ;
      $nKredit = 0 ;
      $nSaldo  = 0 ;
      $s = 0 ;
      while($dbr = $this->bdb->getrow($db)){
         $no      = ++$s ;
         $data[]  = array("#"=>$no,
                          "Keterangan"=>$dbr['keterangan'],
                          "HargaSatuan"=>number_format($dbr['HargaSatuan']),
                          "qty"=>number_format($dbr['qty']),
                          "satuan"=>$dbr['satuan'],
                          "Total"=>number_format($dbr['total'])
                       ) ;
      }
      file_put_contents($file, json_encode($data) ) ;
      echo(' bos.rptreturstock.openreport() ; ') ;
   }

   public function initreportTotal(){
      $va         = $this->input->post() ;
      $dTglAwal   = date_2s($va['tglawal']);
      $dTglAkhir  = date_2s($va['tglakhir']);
      $file       = setfile($this, "rpt_belitotal", __FILE__ , $va) ;
      savesession($this, $this->ss . "file", $file ) ;
      savesession($this, $this->ss . "va", json_encode($va) ) ;
      file_put_contents($file, json_encode(array()) ) ;

      $file    = getsession($this, $this->ss . "file") ;
      $data    = @file_get_contents($file) ;
      $data    = json_decode($data,true) ;
      $db      = $this->bdb->getTotalReturPembelian($dTglAwal,$dTglAkhir) ;
      $s       = 0 ;
      while ($dbRow = $this->bdb->getrow($db)) {
         $no      = ++$s ;
         $data[]  = array("#"=>$no,
                          "faktur"=>$dbRow['faktur'],
                          "tgl"=>$dbRow['tgl'],
                          "subtotal"=>number_format(abs($dbRow['subtotal'])),
                          "total"=>number_format($dbRow['total']),
                          "cabang"=>$dbRow['cabang'],
                          "gudang"=>$dbRow['gudang'],
                          "supplier"=>$dbRow['supplier']
                        ) ;
      }
      file_put_contents($file, json_encode($data) ) ;
      echo(' bos.rptreturstock.openreporttotal() ; ') ;

   }

   public function showreport(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $file = getsession($this, $this->ss . "file") ;
      $data = @file_get_contents($file) ;
      $data = json_decode($data,true) ;
      if(!empty($data)){
         //tanda tangan
         $now  = date_2b(date("Y-m-d")) ;
         $kota = $this->bdb->getconfig("kota") . ", " . $now['d'] . ' ' . $now['m'] . ' ' . $now['y'];
         $ttd  = json_decode($this->bdb->getconfig("ttd"), true) ;
         $vttd = array() ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=> $kota ,"5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"Mengetahui,","3"=>"","4"=>"Menyetujui,","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"(.........................)","3"=>"","4"=>"(.........................)","5"=>"") ;



         $nTotalSaldo  = 0 ;
         $nNumber = 0 ;
         foreach ($data as $key => $value) {
            $nNumber       = str_replace(",", "", $value['Total']) ;
            $nTotalSaldo  += $nNumber;
         }
         $nTotalSaldo = number_format($nTotalSaldo) ;

         $total   = array();
         $total[] = array("Ket"=>"<b>Total",
                          "Jumlah"=>$nTotalSaldo);

         $font = 8 ;
         $exTgl = explode("-",$va['tgl']);
         $dTglFaktur = $exTgl['2'] . "-" . $exTgl['1'] . "-" . $exTgl['0'];

         $vDetail = array() ;
         $vDetail[] = array("1"=>"<b>Faktur</b>","2"=>" : ","3"=> $va['cFaktur'],"4"=>"","5"=>"","6"=>"", ) ;
         $vDetail[] = array("1"=>"<b>Supplier</b>","2"=>" : ","3"=> $va['supplier'],"4"=>"","5"=>"","6"=>"", ) ;
         $vDetail[] = array("1"=>"<b>Tanggal</b>","2"=>" : ","3"=> $dTglFaktur,"4"=>"","5"=>"","6"=>"", ) ;


         $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                        'opt'=>array('export_name'=>'Kartu Stock') ) ;
         $this->load->library('bospdf', $o) ;
         $this->bospdf->ezText("<b>DETAIL RETUR PEMBELIAN STOCK</b>",$font+4,array("justification"=>"center")) ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($vDetail,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("width"=>10,"justification"=>"left"),
                                          "2"=>array("width"=>3,"justification"=>"left"),
                                          "3"=>array("width"=>15,"justification"=>"left"),
                                          "4"=>array("width"=>10,"justification"=>"left"),
                                          "5"=>array("width"=>10,"justification"=>"left"),
                                          "6"=>array("width"=>50,"justification"=>"left"),)
                                 )
                              ) ;

         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($data,"","",
                                 array("fontSize"=>$font,
                                       "cols"=> array(
                                             "#"            =>array("width"=>2,"justification"=>"right"),
                                             "Keterangan"   =>array("wrap"=>1),
                                             "HargaSatuan"  =>array("width"=>12,"justification"=>"right"),
                                             "qty"          =>array("width"=>6,"justification"=>"center"),
                                             "satuan"       =>array("width"=>9,"justification"=>"center"),
                                             "Total"        =>array("width"=>12,"justification"=>"right")))
                                 ) ;
         $this->bospdf->ezTable($total,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                       "cols"=> array(
                                             "Ket"=>array("justification"=>"center"),
                                             "Jumlah"=>array("width"=>12,"justification"=>"right")
                                          )
                                 )
                              ) ;

         $this->bospdf->ezText("") ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($vttd,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("justification"=>"right"),
                                          "2"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "3"=>array("width"=>40,"wrap"=>1),
                                          "4"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "5"=>array("wrap"=>1,"justification"=>"center"))
                                 )
                              ) ;
         $this->bospdf->ezStream() ;
      }else{
         echo('kosong') ;
      }
   }

   public function showreporttotal(){
      $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
      $file = getsession($this, $this->ss . "file") ;
      $data = @file_get_contents($file) ;
      $data = json_decode($data,true) ;
      if(!empty($data)){
         //tanda tangan
         $now  = date_2b(date("Y-m-d")) ;
         $kota = $this->bdb->getconfig("kota") . ", " . $now['d'] . ' ' . $now['m'] . ' ' . $now['y'];
         $ttd  = json_decode($this->bdb->getconfig("ttd"), true) ;
         $vttd = array() ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=> $kota ,"5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"Mengetahui,","3"=>"","4"=>"Menyetujui,","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
         $vttd[] = array("1"=>"","2"=>"(.........................)","3"=>"","4"=>"(.........................)","5"=>"") ;

         $nTotalSubTotal   = 0 ;
         $nTotalTotal      = 0 ;
         foreach ($data as $key => $value) {
            $nSubTotal        = str_replace(",", "", $value['subtotal']) ;
            $nTotal           = str_replace(",", "", $value['total']) ;
            $nTotalSubTotal  += $nSubTotal;
            $nTotalTotal  += $nTotal;
         }

         $nTotalSubTotal   = number_format($nTotalSubTotal) ;
         $nTotalTotal      = number_format($nTotalTotal) ;

         $total   = array();
         $total[] = array("Ket"=>"<b>Total",
                          "JumlahTotalSubTotal"=>$nTotalSubTotal,
                          "JumlahTotalTotal"=>$nTotalTotal,
                          "Ket2"=>"</b>");

         $font = 8 ;
         $o    = array('paper'=>'A4', 'orientation'=>'landscape', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                        'opt'=>array('export_name'=>'Kartu Stock') ) ;
         $this->load->library('bospdf', $o) ;
         $this->bospdf->ezText("<b>LAPORAN TOTAL RETUR PEMBELIAN</b>",$font+4,array("justification"=>"center")) ;
         $this->bospdf->ezText("<b>Periode : " .$va['tglawal']. " s/d " . $va['tglakhir'] . "</b>",$font+4,array("justification"=>"center")) ;
         $this->bospdf->ezText("") ;
          $this->bospdf->ezTable($data,"","",
                                 array("fontSize"=>$font,
                                       "cols"=> array(
                                             "#"=>array("width"=>2,"justification"=>"right"),
                                             "faktur"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "tgl"=>array("width"=>10,"wrap"=>1,"justification"=>"center"),
                                             "subtotal"=>array("width"=>10,"justification"=>"right"),
                                             "total"=>array("width"=>10,"justification"=>"right"),
                                             "cabang"=>array("width"=>5,"justification"=>"center"),
                                             "gudang"=>array("width"=>5,"justification"=>"center")
                                          ))
                                 ) ;
         $this->bospdf->ezTable($total,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                       "cols"=> array(
                                             "Ket"=>array("width"=>27,"justification"=>"center"),
                                             "JumlahTotalSubTotal"=>array("width"=>10,"justification"=>"right"),
                                             "JumlahTotalTotal"=>array("width"=>10,"justification"=>"right"),
                                             "Ket2"=>array("justification"=>"center"),
                                          )
                                 )
                              ) ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($vttd,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("justification"=>"right"),
                                          "2"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "3"=>array("width"=>40,"wrap"=>1),
                                          "4"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "5"=>array("wrap"=>1,"justification"=>"center"))
                                 )
                              ) ;
         $this->bospdf->ezStream() ;
      }else{
         echo('kosong') ;
      }
   }
}

?>
