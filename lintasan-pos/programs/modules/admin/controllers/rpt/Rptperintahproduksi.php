<?php

class Rptperintahproduksi extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptperintahproduksi_m') ;
        $this->load->model('func/func_m') ;
        $this->bdb = $this->rptperintahproduksi_m ;
        $this->ss  = "ssrptperintahproduksi_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptperintahproduksi', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglAwal'] = date_2s($va['tglAwal']);
        $va['tglAkhir'] = date_2s($va['tglAkhir']);
        $vdb    = $this->rptperintahproduksi_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->rptperintahproduksi_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vaset['cmdPreview']    = '<button type="button" onClick="bos.rptperintahproduksi.cmdpreviewdetail(\''.$dbr['faktur'].'\')"
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
        echo('w2ui["bos-form-rptperintahproduksi_grid2"].clear();');
        $data = $this->rptperintahproduksi_m->GetDataPerFaktur($cFaktur) ;
        if(!empty($data)){
            echo('
                  with(bos.rptperintahproduksi.obj){
                     find("#faktur").val("'.$data['faktur'].'") ;
                     find("#stock").val("'.$data['stock'].'") ;
                     find("#namastock").val("'.$data['keterangan'].'") ;
                     find("#satuan").val("'.$data['satuan'].'") ;
                     find("#qty").val("'.string_2s($data['qty']).'") ;
                     find("#bop").val("'.string_2s($data['bop']).'") ;
                     find("#btkl").val("'.string_2s($data['btkl']).'") ;
                     find("#bb").val("'.string_2s($data['bb']).'") ;
                     find("#hp").val("'.string_2s($data['hargapokok']).'") ;
                     find("#jumlah").val("'.string_2s($data['jumlah']).'") ;
                     find("#tgl").val("'.$data['tgl'].'") ;
                     find("#perbaikan").val("'.$data['perbaikan'].'") ;
                     find("#hpperbaikan").val("'.string_2s($data['hargapokokperbaikan']).'") ;
                     find("#jmlperbaikan").val("'.string_2s($data['jumlahperbaikan']).'") ;
                  }

              ') ;
            $d = $this->rptperintahproduksi_m->getDetailPP($cFaktur) ;
            $vare = array();
            $n = 0 ;
            while($dbr = $this->rptperintahproduksi_m->getrow($d)){
                $n++;
                $vaset          = $dbr ;
                $vaset['recid'] = $n;
                $vaset['totqty'] = $dbr['qty'] * $data['qty'];
                $vaset['no']    = $n;
                $vare[]         = $vaset ;
            }

            $vare = json_encode($vare);
            echo('
            bos.rptperintahproduksi.loadmodalpreview("show") ;
            bos.rptperintahproduksi.grid2_reloaddata();
            w2ui["bos-form-rptperintahproduksi_grid2"].add('.$vare.');
         ');
        }
    }

    public function initreport(){
        $va      = $this->input->post() ;
        $cFaktur  = $va['faktur'];

        $file   = setfile($this, "rpt", __FILE__ , $va) ;
        savesession($this, $this->ss . "file", $file ) ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        file_put_contents($file, json_encode(array()) ) ;

        $file    = getsession($this, $this->ss . "file") ;
        $data    = @file_get_contents($file) ;
        $data    = json_decode($data,true) ;
        $db      = $this->bdb->getDetailPP($cFaktur) ;
        $nDebet  = 0 ;
        $nKredit = 0 ;
        $nSaldo  = 0 ;
        $s = 0 ;
        $qtytot = string_2n($va['qty']);
        while($dbr = $this->bdb->getrow($db)){
            $no      = ++$s ;
            $data[]  = array("No"=>$no,
                             "Kode"=>$dbr['kode'],
                             "Keterangan"=>$dbr['keterangan'],
                             "Qty"=>string_2s($dbr['qty']),
                             "Satuan"=>$dbr['satuan'],
                             "HP"=>string_2s($dbr['hp']),
                             "JmlHP"=>string_2s($dbr['jmlhp']),
                             "Qty BB" => string_2s($dbr['qty'] * $qtytot)
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptperintahproduksi.openreport() ; ') ;
    }

    public function initreportTotal(){
        $va         = $this->input->post() ;
        $dTglAwal   = date_2s($va['tglawal']);
        $dTglAkhir  = date_2s($va['tglakhir']);
        $file       = setfile($this, "rpt_pptotal", __FILE__ , $va) ;
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
                             "Tgl"=>date_2d($dbRow['tgl']),
                             "BB"=>string_2s($dbRow['bb']),
                             "BTKL"=>string_2s($dbRow['btkl']),
                             "BOP"=>string_2s($dbRow['bop']),
                             "Harga Pokok"=>string_2s($dbRow['hargapokok'])
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptperintahproduksi.openreporttotal() ; ') ;

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
            $vDetail[] = array("1"=>"Faktur","2"=>" : ","3"=> $va['faktur'],"4"=>"","5"=>"Tanggal","6"=>" : ","7"=>date_2d($va['tgl']),"8"=>"","9"=>"Perbaikan","10"=>" : ","11"=>$va['perbaikan']) ;

            $footer = array() ;
            $footer[] = array("1"=>"Produk","2"=>" : ","3"=> $va['namastock'],"4"=>"","5"=>"BB","6"=>" : ","7"=>$va['bb'],"8"=>"","9"=>"Qty","10"=>" : ","11"=>$va['qty'] . " [" . $va['satuan'] . "]") ;
            $footer[] = array("1"=>"HP. Perbaikan","2"=>" : ","3"=> $va['hpperbaikan'],"4"=>"","5"=>"BTKL","6"=>" : ","7"=>$va['btkl'],"8"=>"","9"=>"HP","10"=>" : ","11"=>$va['hp']) ;
            $footer[] = array("1"=>"Jml. Perbaikan","2"=>" : ","3"=> $va['jmlperbaikan'],"4"=>"","5"=>"BOP","6"=>" : ","7"=>$va['bop'],"8"=>"","9"=>"Jml HP","10"=>" : ","11"=>$va['jumlah']) ;


            $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $cabang = substr($va['faktur'],2,3);//getsession($this,"cabang");
            $arrcab = $this->func_m->GetDataCabang($cabang);
            $this->bospdf->ezText($arrcab['kode'] ." - ".$arrcab['nama'],$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText($arrcab['alamat'] . " / ". $arrcab['telp'],$font,array("justification"=>"center")) ;

            $this->bospdf->ezText("<b>DETAIL PERINTAH PRODUKSI</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($vDetail,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>12,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"left"),
                                             "3"=>array("width"=>14,"justification"=>"left"),
                                             "4"=>array("justification"=>"left"),
                                             "5"=>array("width"=>12,"justification"=>"left"),
                                             "6"=>array("width"=>3,"justification"=>"left"),
                                             "7"=>array("width"=>14,"justification"=>"left"),
                                             "8"=>array("justification"=>"left"),
                                             "9"=>array("width"=>12,"justification"=>"left"),
                                             "10"=>array("width"=>3,"justification"=>"left"),
                                             "11"=>array("width"=>14,"justification"=>"left"))
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
                                             "JmlHP"        =>array("width"=>12,"justification"=>"right"),
                                            "Qty BB"          =>array("width"=>10,"justification"=>"right")))
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
                                             "3"=>array("width"=>14,"justification"=>"left"),
                                             "4"=>array("justification"=>"left"),
                                             "5"=>array("width"=>12,"justification"=>"left"),
                                             "6"=>array("width"=>3,"justification"=>"left"),
                                             "7"=>array("width"=>14,"justification"=>"left"),
                                             "8"=>array("justification"=>"left"),
                                             "9"=>array("width"=>12,"justification"=>"left"),
                                             "10"=>array("width"=>3,"justification"=>"left"),
                                             "11"=>array("width"=>14,"justification"=>"left"))
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

            $nTotalHP      = 0 ;
            $nTotalBB      = 0 ;
            $nTotalBTKL      = 0 ;
            $nTotalBOP      = 0 ;
            foreach ($data as $key => $value) {
                $nTotalHP += string_2n($value['Harga Pokok']) ;
                $nTotalBB += string_2n($value['BB']) ;
                $nTotalBTKL += string_2n($value['BTKL']) ;
                $nTotalBOP += string_2n($value['BOP']) ;

            }


            $total   = array();
            $total[] = array("Ket"=>"<b>Total",
                             "BB"=>string_2s($nTotalBB),
                             "BTKL"=>string_2s($nTotalBTKL),
                             "BOP"=>string_2s($nTotalBOP),
                             "HP"=>string_2s($nTotalHP));

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
                                             "Tgl"=>array("width"=>12,"wrap"=>1,"justification"=>"center"),
                                             "BB"=>array("width"=>12,"justification"=>"right"),
                                             "BTKL"=>array("width"=>12,"justification"=>"right"),
                                             "BOP"=>array("width"=>12,"justification"=>"right"),
                                             "Harga Pokok"=>array("width"=>12,"justification"=>"right")
                                         ))
                                  ) ;
            $this->bospdf->ezTable($total,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                         "cols"=> array(
                                             "Ket"=>array("justification"=>"center"),
                                             "BB"=>array("width"=>12,"justification"=>"right"),
                                             "BTKL"=>array("width"=>12,"justification"=>"right"),
                                             "BOP"=>array("width"=>12,"justification"=>"right"),
                                             "HP"=>array("width"=>12,"justification"=>"right")
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
