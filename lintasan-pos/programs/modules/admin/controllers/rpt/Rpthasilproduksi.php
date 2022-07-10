<?php
class Rpthasilproduksi extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rpthasilproduksi_m') ;
        $this->bdb = $this->rpthasilproduksi_m ;
        $this->ss  = "ssrpthasilproduksi_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rpthasilproduksi', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglAwal'] = date_2s($va['tglAwal']);
        $va['tglAkhir'] = date_2s($va['tglAkhir']);
        $vdb    = $this->rpthasilproduksi_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->rpthasilproduksi_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vaset['cmdPreview']    = '<button type="button" onClick="bos.rpthasilproduksi.cmdpreviewdetail(\''.$dbr['faktur'].'\')"
                                     class="btn btn-success btn-grid">Preview Detail</button>' ;
            $vaset['cmdPreview']    = html_entity_decode($vaset['cmdPreview']) ;
            $vare[]     = $vaset ;
        }

        $vare    = array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function PreviewDetail(){
        $va    = $this->input->post() ;
        $cFaktur = $va['faktur'] ;
        echo('w2ui["bos-form-rpthasilproduksi_grid2"].clear();');
        $data = $this->rpthasilproduksi_m->GetDataPerFaktur($cFaktur) ;
       
        if(!empty($data)){
            echo('
                  with(bos.rpthasilproduksi.obj){
                     find("#faktur").val("'.$data['faktur'].'") ;
                     find("#fakturprod").val("'.$data['fakturproduksi'].'") ;
                     find("#stock").val("'.$data['stock'].'") ;
                     find("#namastock").val("'.$data['keterangan'].'") ;
                     find("#satuan").val("'.$data['satuan'].'") ;
                     find("#perbaikan").val("'.$data['perbaikan'].'") ;
                     find("#qty").val("'.string_2s($data['qty']).'") ;
                     find("#tgl").val("'.date_2d($data['tgl']).'") ;                     
                     find("#bb").val("'.string_2s($data['bb']).'") ;
                     find("#bop").val("'.string_2s($data['bop']).'") ;
                     find("#btkl").val("'.string_2s($data['btkl']).'") ;
                     find("#hp").val("'.string_2s($data['hargapokok']).'") ;
                     find("#jumlah").val("'.string_2s($data['jumlah']).'") ;
                     find("#hpperbaikan").val("'.string_2s($data['hargapokokperbaikan']).'") ;
                     find("#jmlperbaikan").val("'.string_2s($data['jumlahperbaikan']).'") ;
                  }

              ') ;

            $d = $this->rpthasilproduksi_m->getDetailPH($data['fakturproduksi']) ;
            $vare = array();
            $n = 0 ;
            while($dbr = $this->rpthasilproduksi_m->getrow($d)){
                $n++;
                $vaset          = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no']    = $n;
                $vare[]         = $vaset ;
            }

            $vare = json_encode($vare);
            echo('
            bos.rpthasilproduksi.loadmodalpreview("show") ;
            bos.rpthasilproduksi.grid2_reloaddata();
            w2ui["bos-form-rpthasilproduksi_grid2"].add('.$vare.');
         ');
        }
    }

    public function initreport(){
        $va      = $this->input->post() ;
        $cFaktur  = $va['fakturprod'];

        $file   = setfile($this, "rpt", __FILE__ , $va) ;
        savesession($this, $this->ss . "file", $file ) ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        file_put_contents($file, json_encode(array()) ) ;

        $file    = getsession($this, $this->ss . "file") ;
        $data    = @file_get_contents($file) ;
        $data    = json_decode($data,true) ;
        $db      = $this->bdb->getDetailPH($cFaktur) ;
        $nDebet  = 0 ;
        $nKredit = 0 ;
        $nSaldo  = 0 ;
        $s = 0 ;
        while($dbr = $this->bdb->getrow($db)){
            $no      = ++$s ;
            $data[]  = array("No"=>$no,
                             "Kode"=>$dbr['kode'],
                             "Keterangan"=>$dbr['keterangan'],
                             "Qty"=>string_2s($dbr['qty']),
                             "Satuan"=>$dbr['satuan'],
                             "HP"=>string_2s($dbr['hp']),
                             "JmlHP"=>string_2s($dbr['jmlhp'])
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rpthasilproduksi.openreport() ; ') ;
    }

    public function initreportTotal(){
        $va         = $this->input->post() ;
        $dTglAwal   = date_2s($va['tglawal']);
        $dTglAkhir  = date_2s($va['tglakhir']);
        $file       = setfile($this, "rpt_hptotal", __FILE__ , $va) ;
        savesession($this, $this->ss . "file", $file ) ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        file_put_contents($file, json_encode(array()) ) ;

        $file    = getsession($this, $this->ss . "file") ;
        $data    = @file_get_contents($file) ;
        $data    = json_decode($data,true) ;
        $db      = $this->bdb->getTotalPP($dTglAwal,$dTglAkhir) ;
        $s       = 0 ;
        while ($dbRow = $this->bdb->getrow($db)) {
            $no      = ++$s ;
            $data[]  = array("No"=>$no,
                             "Faktur"=>$dbRow['faktur'],
                             "Faktur Prod"=>$dbRow['fakturproduksi'],
                             "Tgl"=>date_2d($dbRow['tgl']),
                             "QTY STD"=>string_2s($dbRow['qtystd']),
                             "N STD"=>string_2s($dbRow['std']),
                             "QTY Aktual"=>string_2s($dbRow['qtyaktual']),
                             "N Aktual"=>string_2s($dbRow['aktual'])
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rpthasilproduksi.openreporttotal() ; ') ;

    }

    public function showreport(){
        $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
        $file = getsession($this, $this->ss . "file") ;
        $data = @file_get_contents($file) ;
        $data = json_decode($data,true) ;
        //if(!empty($data)){
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



            /*$nTotalSaldo  = 0 ;
            $nNumber = 0 ;
            foreach ($data as $key => $value) {
                $nNumber       = string_2n($value['Jumlah']) ;
                $nTotalSaldo  += $nNumber;
            }
            $nTotalSaldo = string_2s($nTotalSaldo) ;*/

            $total   = array();
           /* $total[] = array("Ket"=>"<b>Total",
                             "Jumlah"=>$nTotalSaldo."</b>",);*/

            $font = 8 ;

            $vDetail = array() ;
            $vDetail[] = array("1"=>"Faktur","2"=>" : ","3"=> $va['faktur'],"4"=>"","5"=>"Fkt. Produksi","6"=>" : ","7"=>$va['fakturprod'],"8"=>"","9"=>"Tanggal","10"=>" : ","11"=>date_2d($va['tgl'])) ;    
            $vDetail[] = array("1"=>"Perbaikan","2"=>" : ","3"=> $va['perbaikan'],"4"=>"","5"=>"","6"=>"","7"=>"","8"=>"","9"=>"","10"=>"","11"=>"") ;    

            $footer = array() ;
            $footer[] = array("1"=>"Produk","2"=>" : ","3"=> $va['namastock'],"4"=>"","5"=>"BB","6"=>" : ","7"=>$va['bb'],"8"=>"","9"=>"Qty","10"=>" : ","11"=>$va['qty'] . " [" . $va['satuan'] . "]") ;
            $footer[] = array("1"=>"HP. Perbaikan","2"=>" : ","3"=>$va['hpperbaikan'],"4"=>"","5"=>"BTKL","6"=>" : ","7"=>$va['btkl'],"8"=>"","9"=>"HP","10"=>" : ","11"=>$va['hp']) ;
            $footer[] = array("1"=>"Jml. Perbaikan","2"=>" : ","3"=> $va['jmlperbaikan'],"4"=>"","5"=>"BOP","6"=>" : ","7"=>$va['bop'],"8"=>"","9"=>"Jml HP","10"=>" : ","11"=>$va['jumlah']) ;


            $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezText("<b>DETAIL HASil PRODUKSI</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($vDetail,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>10,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"left"),
                                             "3"=>array("width"=>15,"justification"=>"left"),
                                             "4"=>array("justification"=>"left"),
                                             "5"=>array("width"=>10,"justification"=>"left"),
                                             "6"=>array("width"=>3,"justification"=>"left"),
                                             "7"=>array("width"=>15,"justification"=>"left"),
                                             "8"=>array("justification"=>"left"),
                                             "9"=>array("width"=>10,"justification"=>"left"),
                                             "10"=>array("width"=>3,"justification"=>"left"),
                                             "11"=>array("width"=>15,"justification"=>"left"))
                                        )
                                  ) ;

            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($data,"","",
                                   array("fontSize"=>$font,
                                         "cols"=> array(
                                             "No"           =>array("width"=>5,"justification"=>"right"),
                                             "Kode"         =>array("width"=>12,"justification"=>"center"),
                                             "Keterangan"   =>array("wrap"=>1),
                                             "Qty"          =>array("width"=>10,"justification"=>"right"),
                                             "Satuan"       =>array("width"=>12,"justification"=>"left"),
                                             "HP"           =>array("width"=>12,"justification"=>"right"),
                                             "JmlHP"        =>array("width"=>12,"justification"=>"right")
                                         ))
                                  ) ;
            $this->bospdf->ezTable($total,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                         "cols"=> array(
                                             "Ket"=>array("justification"=>"center"),
                                             "Jumlah"=>array("width"=>12,"justification"=>"right"),
                                         )
                                        )
                                  ) ;

            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($footer,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>12,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"left"),
                                             "3"=>array("width"=>15,"justification"=>"left"),
                                             "4"=>array("justification"=>"left"),
                                             "5"=>array("width"=>12,"justification"=>"left"),
                                             "6"=>array("width"=>3,"justification"=>"left"),
                                             "7"=>array("width"=>15,"justification"=>"left"),
                                             "8"=>array("justification"=>"left"),
                                             "9"=>array("width"=>12,"justification"=>"left"),
                                             "10"=>array("width"=>3,"justification"=>"left"),
                                             "11"=>array("width"=>15,"justification"=>"left"))
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
        /*}else{
            echo('kosong') ;
        }*/
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

            $nTotalQtySTD      = 0 ;
            $nTotalSTD      = 0 ;
            $nTotalQtyAktual      = 0 ;
            $nTotalAktual      = 0 ;
            foreach ($data as $key => $value) {
                $nTotalQtySTD += string_2n($value['QTY STD']) ;
                $nTotalSTD += string_2n($value['N STD']) ;
                $nTotalQtyAktual += string_2n($value['QTY Aktual']) ;
                $nTotalAktual += string_2n($value['N Aktual']) ;

            }


            $total   = array();
            $total[] = array("Ket"=>"<b>Total",
                             "QTY STD"=>string_2s($nTotalQtySTD),
                             "N STD"=>string_2s($nTotalSTD),
                             "QTY Aktual"=>string_2s($nTotalQtyAktual),
                             "N Aktual"=>string_2s($nTotalAktual));

            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'P', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezText("<b>LAPORAN TOTAL PERINTAH PRODUKSI</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("<b>Periode : " .$va['tglawal']. " s/d " . $va['tglakhir'] . "</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($data,"","",
                                   array("fontSize"=>$font,
                                         "cols"=> array(
                                             "No"=>array("width"=>5,"justification"=>"right"),
                                             "Faktur"=>array("wrap"=>1,"justification"=>"center"),
                                             "Faktur Prod"=>array("wrap"=>1,"justification"=>"center"),
                                             "Tgl"=>array("width"=>12,"wrap"=>1,"justification"=>"center"),
                                             "QTY STD"=>array("width"=>12,"justification"=>"right"),
                                             "N STD"=>array("width"=>12,"justification"=>"right"),
                                             "QTY Aktual"=>array("width"=>12,"justification"=>"right"),
                                             "N Aktual"=>array("width"=>12,"justification"=>"right")
                                         ))
                                  ) ;
            $this->bospdf->ezTable($total,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                         "cols"=> array(
                                             "Ket"=>array("justification"=>"center"),
                                             "QTY STD"=>array("width"=>12,"justification"=>"right"),
                                             "N STD"=>array("width"=>12,"justification"=>"right"),
                                             "QTY Aktual"=>array("width"=>12,"justification"=>"right"),
                                             "N Aktual"=>array("width"=>12,"justification"=>"right")
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
