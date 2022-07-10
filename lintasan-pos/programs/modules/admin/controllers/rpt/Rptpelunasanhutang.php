<?php
class Rptpelunasanhutang extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptpelunasanhutang_m') ;
        $this->bdb = $this->rptpelunasanhutang_m ;
        $this->ss  = "ssrptpelunasanhutang_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptpelunasanhutang', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglawal'] = date_2s($va['tglawal']);
        $va['tglakhir'] = date_2s($va['tglakhir']);
        $vdb    = $this->rptpelunasanhutang_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->rptpelunasanhutang_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vaset['cmdPreview']    = '<button type="button" onClick="bos.rptpelunasanhutang.cmdpreviewdetail(\''.$dbr['faktur'].'\')"
                                     class="btn btn-success btn-grid">Preview</button>' ;
            $vaset['cmdPreview']    = html_entity_decode($vaset['cmdPreview']) ;
            $vare[]     = $vaset ;
        }

        $vare    = array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function PreviewDetail(){
        $va    = $this->input->post() ;
        $cFaktur = $va['faktur'] ;
        echo('w2ui["bos-form-rptpelunasanhutang_grid2"].clear();');
        $data = $this->rptpelunasanhutang_m->GetDataPerFaktur($cFaktur) ;
        if(!empty($data)){
            echo('
                  with(bos.rptpelunasanhutang.obj){
                    find("#faktur").val("'.$data['faktur'].'") ;
                    find("#tgl").val("'.date_2d($data['tgl']).'");
                    find("#bankkas").val("'.$data['ketrekkasbank'].'");
                    find("#supplier").val("'.$data['namasupplier'].'");
                    find("#pembelian").val("'.string_2s($data['pembelian']).'") ;
                    find("#retur").val("'.string_2s($data['retur']).'") ;
                    find("#subtotal").val("'.string_2s($data['subtotal']).'") ;
                    find("#tfkas").val("'.string_2s($data['kasbank']).'") ;
                    find("#persekot").val("'.string_2s($data['persekot']).'") ;
                    find("#diskon").val("'.string_2s($data['diskon']).'") ;
                    find("#pembulatan").val("'.string_2s($data['pembulatan']).'") ;
                  }

              ') ;
            $data = $this->rptpelunasanhutang_m->getDetail($cFaktur) ;
            $vare = array();
            $n = 0 ;
            while($dbr = $this->rptpelunasanhutang_m->getrow($data)){
                $n++;
                $vaset          = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no']    = $n;
                $vare[]         = $vaset ;
            }

            $vare = json_encode($vare);
            echo('
            bos.rptpelunasanhutang.loadmodalpreview("show") ;
            bos.rptpelunasanhutang.grid2_reloaddata();
            w2ui["bos-form-rptpelunasanhutang_grid2"].add('.$vare.');
         ');
        }
    }

    public function initreport(){
        $va      = $this->input->post() ;
        $faktur  = $va['faktur'];

        $file   = setfile($this, "rpt", __FILE__ , $va) ;
        savesession($this, $this->ss . "file", $file ) ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        file_put_contents($file, json_encode(array()) ) ;

        $file    = getsession($this, $this->ss . "file") ;
        $data    = @file_get_contents($file) ;
        $data    = json_decode($data,true) ;
        $db      = $this->bdb->getDetailpelunasanhutang($faktur) ;
        $nDebet  = 0 ;
        $nKredit = 0 ;
        $nSaldo  = 0 ;
        $s = 0 ;
        while($dbr = $this->bdb->getrow($db)){
            $no      = ++$s ;
            $data[]  = array("No"=>$no,
                             "FKT"=>$dbr['fkt'],
                             "Jumlah"=>string_2s($dbr['jumlah']),
                             "Jenis"=>$dbr['jenis']
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptpelunasanhutang.openreport() ; ') ;
    }

    public function initreportTotal(){
        $va         = $this->input->post() ;
        $tglawal   = date_2s($va['tglawal']);
        $tglakhir  = date_2s($va['tglakhir']);
        $file       = setfile($this, "rpt_pelunasanhutangtotal", __FILE__ , $va) ;
        savesession($this, $this->ss . "file", $file ) ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        file_put_contents($file, json_encode(array()) ) ;

        $file    = getsession($this, $this->ss . "file") ;
        $data    = @file_get_contents($file) ;
        $data    = json_decode($data,true) ;
        $db      = $this->bdb->getTotalpelunasanhutang($tglawal,$tglakhir) ;
        $s       = 0 ;
        while ($dbRow = $this->bdb->getrow($db)) {
            $no      = ++$s ;
            $data[]  = array("No"=>$no,
                             "Faktur"=>$dbRow['faktur'],
                             "Tgl"=>$dbRow['tgl'],
                             "Supplier"=>$dbRow['supplier'],
                             "Pembelian"=>string_2s($dbRow['pembelian']),
                             "Retur"=>string_2s($dbRow['retur']),
                             "Subtotal"=>string_2s($dbRow['subtotal']),
                             "Diskon"=>string_2s($dbRow['diskon']),
                             "Pembulatan"=>string_2s($dbRow['pembulatan']),
                             "Persekot"=>string_2s($dbRow['persekot']),
                             "Kasbank"=>string_2s($dbRow['kasbank']),
                             "Ketrekkasbank"=>$dbRow['ketrekkasbank'],
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptpelunasanhutang.openreporttotal() ; ') ;

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





            $font = 8 ;
            $exTgl = explode("-",$va['tgl']);
            $dTglFaktur = $exTgl['2'] . "-" . $exTgl['1'] . "-" . $exTgl['0'];

            $vDetail = array() ;
            $vDetail[] = array("1"=>"<b>Faktur</b>","2"=>" : ","3"=> $va['faktur'],"4"=>"Supplier","5"=>":","6"=>$va['supplier'], ) ;
            $vDetail[] = array("1"=>"<b>Tanggal</b>","2"=>" : ","3"=> $va['tgl'],"4"=>"","5"=>"","6"=>"", ) ;
            
            $vDetail2 = array() ;
            $vDetail2[] = array("1"=>"<b>Pembelian</b>","2"=>" : ","3"=> $va['pembelian'],"4"=>"","5"=>"Persekot","6"=>":","7"=>$va['persekot'],"8"=>"","9"=>"Diskon","10"=>":","11"=>$va['diskon']) ;
            $vDetail2[] = array("1"=>"<b>Retur</b>","2"=>" : ","3"=> $va['retur'],"4"=>"","5"=>"Kas / Bank","6"=>":","7"=>$va['tfkas'],"8"=>"","9"=>"Pembulatan","10"=>":","11"=>$va['pembulatan']) ;
            $vDetail2[] = array("1"=>"<b>Subtotal</b>","2"=>" : ","3"=> $va['subtotal'],"4"=>"","5"=>"Rek Kas / Bank","6"=>":","7"=>$va['bankkas'],"8"=>"","9"=>"","10"=>"","11"=>"" ) ;


            $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezText("<b>DETAIL PELUNASAN HUTANG</b>",$font+4,array("justification"=>"center")) ;
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
                                             "No"            =>array("width"=>4,"justification"=>"right"),
                                             "Fkt"   =>array("width"=>20,"wrap"=>1),
                                             "Jumlah"  =>array("width"=>12,"justification"=>"right"),
                                             "Jenis"          =>array("justification"=>"left")))
                                  ) ;

            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($vDetail2,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>10,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"left"),
                                             "3"=>array("justification"=>"left"),
                                             "4"=>array("width"=>5,"justification"=>"left"),
                                             "5"=>array("width"=>10,"justification"=>"left"),
                                             "6"=>array("width"=>3,"justification"=>"left"),
                                             "7"=>array("justification"=>"left"),
                                             "8"=>array("width"=>5,"justification"=>"left"),
                                             "9"=>array("width"=>10,"justification"=>"left"),
                                             "10"=>array("width"=>3,"justification"=>"left"),
                                             "11"=>array("justification"=>"left"))
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

            $totalpembelian   = 0 ;
            $totalretur       = 0 ;
            $totalsubtotal    = 0 ;
            $totalkasbank     = 0 ;
            $totaldiskon     = 0 ;
            $totalpembulatan     = 0 ;
            foreach ($data as $key => $value) {
                $totalpembelian        += string_2n($value['Pembelian']) ;
                $totalretur        += string_2n($value['Retur']) ;
                $totalsubtotal        += string_2n($value['Subtotal']) ;
                $totalkasbank        += string_2n($value['Kasbank']) ;
                $totaldiskon        += string_2n($value['Diskon']) ;
                $totalpembulatan        += string_2n($value['Pembulatan']) ;
            }


            $total   = array();
            $total[] = array("Ket"=>"<b>Total",
                             "Pembelian"=>string_2s($totalpembelian),
                             "Retur"=>string_2s($totalretur),
                             "Subtotal"=>string_2s($totalsubtotal),
                             "Diskon"=>string_2s($totaldiskon),
                             "Pembulatan"=>string_2s($totalpembulatan),
                             "Persekot"=>"",
                             "Kasbank"=>string_2s($totalkasbank),
                             "Ket2"=>"</b>");

            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'landscape', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezText("<b>LAPORAN TOTAL PELUNASAN HUTANG</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("<b>Periode : " .$va['tglawal']. " s/d " . $va['tglakhir'] . "</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($data,"","",
                                   array("fontSize"=>$font,
                                         "cols"=> array(
                                             "No"=>array("width"=>2,"justification"=>"right"),
                                             "Faktur"=>array("width"=>12,"wrap"=>1,"justification"=>"center"),
                                             "Tgl"=>array("width"=>10,"wrap"=>1,"justification"=>"center"),
                                             "Supplier"=>array("width"=>12,"wrap"=>1),
                                             "Pembelian"=>array("width"=>8,"justification"=>"right"),
                                             "Retur"=>array("width"=>8,"justification"=>"right"),
                                             "Subtotal"=>array("width"=>8,"justification"=>"right"),
                                             "Diskon"=>array("width"=>8,"justification"=>"right"),
                                             "Pembulatan"=>array("width"=>8,"justification"=>"right"),
                                             "Persekot"=>array("width"=>8,"justification"=>"right"),
                                             "Kasbank"=>array("width"=>8,"justification"=>"right"),
                                             "Ketrekkasbank"=>array("wrap"=>1)
                                         ))
                                  ) ;
            $this->bospdf->ezTable($total,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                         "cols"=> array(
                                             "Ket"=>array("width"=>36,"justification"=>"center"),
                                             "Pembelian"=>array("width"=>8,"justification"=>"right"),
                                             "Retur"=>array("width"=>8,"justification"=>"right"),
                                             "Subtotal"=>array("width"=>8,"justification"=>"right"),
                                             "Diskon"=>array("width"=>8,"justification"=>"right"),
                                             "Pembulatan"=>array("width"=>8,"justification"=>"right"),
                                             "Kasbank"=>array("width"=>8,"justification"=>"right"),
                                             "Kasbank"=>array("width"=>8,"justification"=>"right"),
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
