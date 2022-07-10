<?php

class Rptpembelianstock extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptpembelianstock_m') ;
        $this->load->model('func/Perhitungan_m') ;
        $this->bdb = $this->rptpembelianstock_m ;
        $this->ss  = "ssrptpembelianstock_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptpembelianstock', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglAwal'] = date_2s($va['tglAwal']);
        $va['tglAkhir'] = date_2s($va['tglAkhir']);
        $vdb    = $this->rptpembelianstock_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->rptpembelianstock_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vaset['cmdPreview']    = '<button type="button" onClick="bos.rptpembelianstock.cmdpreviewdetail(\''.$dbr['faktur'].'\')"
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
        echo('w2ui["bos-form-rptpembelianstock_grid2"].clear();');
        $data = $this->rptpembelianstock_m->GetDataPerFaktur($cFaktur) ;
        if(!empty($data)){
            echo('
                  with(bos.rptpembelianstock.obj){
                     find("#faktur").val("'.$data['faktur'].'") ;
                     find("#fktpo").val("'.$data['fktpo'].'") ;
                     find("#supplier").val("'.$data['supplier'].'") ;
                     find("#subtotal").val("'.string_2s($data['subtotal']).'") ;
                     find("#diskon").val("'.string_2s($data['diskon']).'") ;
                     find("#ppn").val("'.string_2s($data['ppn']).'") ;
                     find("#persppn").val("'.string_2s($data['persppn']).'") ;
                     find("#total").val("'.string_2s($data['total']).'") ;
                     find("#tgl").val("'.$data['Tgl'].'") ;
                  }

              ') ;
            $data = $this->rptpembelianstock_m->getDetailPembelian($cFaktur) ;
            $vare = array();
            $n = 0 ;
            while($dbr = $this->rptpembelianstock_m->getrow($data)){
                $n++;
                $vaset          = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no']    = $n;
                $vare[]         = $vaset ;
            }

            $vare = json_encode($vare);
            echo('
            bos.rptpembelianstock.loadmodalpreview("show") ;
            bos.rptpembelianstock.grid2_reloaddata();
            w2ui["bos-form-rptpembelianstock_grid2"].add('.$vare.');
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
        $db      = $this->bdb->getDetailPembelian($cFaktur) ;
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
                             "Pembelian"=>number_format($dbr['pembelian']),
                             "Total"=>number_format($dbr['total'])
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptpembelianstock.openreport() ; ') ;
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
        $db      = $this->bdb->getTotalPembelian($dTglAwal,$dTglAkhir) ;
        $s       = 0 ;
        while ($dbRow = $this->bdb->getrow($db)) {
            $no      = ++$s ;
            $data[]  = array("#"=>$no,
                             "faktur"=>$dbRow['faktur'],
                             "tgl"=>$dbRow['tgl'],
                             "fktpo"=>$dbRow['faktur'],
                             "subtotal"=>number_format(abs($dbRow['subtotal'])),
                             "diskon"=>number_format($dbRow['diskon']),
                             "ppn"=>number_format($dbRow['ppn']),
                             "total"=>number_format($dbRow['total']),
                             "cabang"=>$dbRow['cabang'],
                             "gudang"=>$dbRow['gudang'],
                             "supplier"=>$dbRow['supplier']
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptpembelianstock.openreporttotal() ; ') ;

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
                             "Jumlah"=>$nTotalSaldo,
                             "Ket2"=>"</b>");

            $font = 8 ;
            $exTgl = explode("-",$va['tgl']);
            $dTglFaktur = $exTgl['2'] . "-" . $exTgl['1'] . "-" . $exTgl['0'];

            $vDetail = array() ;
            $vDetail[] = array("1"=>"<b>Faktur</b>","2"=>" : ","3"=> $va['cFaktur'],"4"=>"FakturPO","5"=>":","6"=>$va['fktpo'], ) ;
            $vDetail[] = array("1"=>"<b>Supplier</b>","2"=>" : ","3"=> $va['supplier'],"4"=>"PPn (%)","5"=>":","6"=>$va['persppn'], ) ;
            $vDetail[] = array("1"=>"<b>Tanggal</b>","2"=>" : ","3"=> $dTglFaktur,"4"=>"","5"=>"","6"=>"", ) ;


            $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezText("<b>DETAIL PEMBELIAN STOCK</b>",$font+4,array("justification"=>"center")) ;
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
                                             "Pembelian"    =>array("width"=>12,"justification"=>"right"),
                                             "Total"        =>array("width"=>12,"justification"=>"right")))
                                  ) ;
            $this->bospdf->ezTable($total,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                         "cols"=> array(
                                             "Ket"=>array("justification"=>"center"),
                                             "Jumlah"=>array("width"=>12,"justification"=>"right"),
                                             "Ket2"=>array("width"=>12,"justification"=>"center"),
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
            $nTotalDiskon     = 0 ;
            $nTotalPPN        = 0 ;
            $nTotalTotal      = 0 ;
            foreach ($data as $key => $value) {
                $nSubTotal        = str_replace(",", "", $value['subtotal']) ;
                $nDiskon          = str_replace(",", "", $value['diskon']) ;
                $nPPN             = str_replace(",", "", $value['ppn']) ;
                $nTotal           = str_replace(",", "", $value['total']) ;
                $nTotalSubTotal  += $nSubTotal;
                $nTotalDiskon  += $nDiskon;
                $nTotalPPN  += $nPPN;
                $nTotalTotal  += $nTotal;
            }

            $nTotalSubTotal   = number_format($nTotalSubTotal) ;
            $nTotalDiskon     = number_format($nTotalDiskon) ;
            $nTotalPPN        = number_format($nTotalPPN) ;
            $nTotalTotal      = number_format($nTotalTotal) ;

            $total   = array();
            $total[] = array("Ket"=>"<b>Total",
                             "JumlahTotalSubTotal"=>$nTotalSubTotal,
                             "JumlahTotalDiskon"=>$nTotalDiskon,
                             "JumlahTotalPPN"=>$nTotalPPN,
                             "JumlahTotalTotal"=>$nTotalTotal,
                             "Ket2"=>"</b>");

            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'landscape', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezText("<b>LAPORAN TOTAL PEMBELIAN</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("<b>Periode : " .$va['tglawal']. " s/d " . $va['tglakhir'] . "</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($data,"","",
                                   array("fontSize"=>$font,
                                         "cols"=> array(
                                             "#"=>array("width"=>2,"justification"=>"right"),
                                             "faktur"=>array("width"=>12,"wrap"=>1,"justification"=>"center"),
                                             "tgl"=>array("width"=>10,"wrap"=>1,"justification"=>"center"),
                                             "fktpo"=>array("width"=>12,"wrap"=>1,"justification"=>"center"),
                                             "subtotal"=>array("width"=>10,"justification"=>"right"),
                                             "diskon"=>array("width"=>10,"justification"=>"right"),
                                             "ppn"=>array("width"=>10,"justification"=>"right"),
                                             "total"=>array("width"=>10,"justification"=>"right"),
                                             "cabang"=>array("width"=>5,"justification"=>"center"),
                                             "gudang"=>array("width"=>5,"justification"=>"center")
                                         ))
                                  ) ;
            $this->bospdf->ezTable($total,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                         "cols"=> array(
                                             "Ket"=>array("width"=>36,"justification"=>"center"),
                                             "JumlahTotalSubTotal"=>array("width"=>10,"justification"=>"right"),
                                             "JumlahTotalDiskon"=>array("width"=>10,"justification"=>"right"),
                                             "JumlahTotalPPN"=>array("width"=>10,"justification"=>"right"),
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
