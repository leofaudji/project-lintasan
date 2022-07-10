<?php

class Rptpo extends Bismillah_Controller{
    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptpo_m') ;
        $this->load->model('func/Perhitungan_m') ;
		$this->load->model('func/func_m') ;
		$this->load->library('curl');
        $this->bdb = $this->rptpo_m ;
        $this->ss  = "ssrptpo_" ;
    }

    public function index(){
        $d    = array("setdate"=>date_set()) ;
        $this->load->view('rpt/rptpo', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglAwal'] = date_2s($va['tglAwal']);
        $va['tglAkhir'] = date_2s($va['tglAkhir']);
        $vdb    = $this->rptpo_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->rptpo_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vaset['cmdPreview']    = '<button type="button" onClick="bos.rptpo.cmdpreviewdetail(\''.$dbr['faktur'].'\')"
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
        echo('w2ui["bos-form-rptpo_grid2"].clear();');
        $data = $this->rptpo_m->GetDataPerFaktur($cFaktur) ;
        if(!empty($data)){
            echo('
                  with(bos.rptpo.obj){
                     find("#faktur").val("'.$data['faktur'].'") ;
                     find("#fktpr").val("'.$data['fktpr'].'") ;
                     find("#supplier").val("'.$data['supplier'].'") ;
                     find("#subtotal").val("'.string_2s($data['total']).'") ;
                     find("#total").val("'.string_2s($data['total']).'") ;
                     find("#tgl").val("'.$data['Tgl'].'") ;
                  }

              ') ;
            $data = $this->rptpo_m->getDetailPO($cFaktur) ;
            $vare = array();
            $n = 0 ;
            while($dbr = $this->rptpo_m->getrow($data)){
                $n++;
                $vaset          = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no']    = $n;
                $vare[]         = $vaset ;
            }

            $vare = json_encode($vare);
            echo('
            bos.rptpo.loadmodalpreview("show") ;
            bos.rptpo.grid2_reloaddata();
            w2ui["bos-form-rptpo_grid2"].add('.$vare.');
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
        $db      = $this->bdb->getDetailPO($cFaktur) ;
        $nDebet  = 0 ;
        $nKredit = 0 ;
        $nSaldo  = 0 ;
        $s = 0 ;
        while($dbr = $this->bdb->getrow($db)){
            $no      = ++$s ;
            $data[]  = array("#"=>$no,
                             "Kode"=>$dbr['kode'],
                             "Keterangan"=>$dbr['keterangan'],
                             "Spesifikasi"=>$dbr['spesifikasi'],
                             "Harga"=>number_format($dbr['harga']),
                             "Qty"=>number_format($dbr['qty']),
                             "Satuan"=>$dbr['satuan'],
                             "Total"=>number_format($dbr['jumlah'])
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptpo.openreport() ; ') ;
    }

    public function initreportTotal(){
        $va         = $this->input->post() ;
        $dTglAwal   = date_2s($va['tglawal']);
        $dTglAkhir  = date_2s($va['tglakhir']);
        $file       = setfile($this, "rpt_pototal", __FILE__ , $va) ;
        savesession($this, $this->ss . "file", $file ) ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        file_put_contents($file, json_encode(array()) ) ;

        $file    = getsession($this, $this->ss . "file") ;
        $data    = @file_get_contents($file) ;
        $data    = json_decode($data,true) ;
        $db      = $this->bdb->getTotalpo($dTglAwal,$dTglAkhir) ;
        $s       = 0 ;
        while ($dbRow = $this->bdb->getrow($db)) {
            $no      = ++$s ;
            $data[]  = array("#"=>$no,
                             "faktur"=>$dbRow['faktur'],
                             "fktpr"=>$dbRow['fktpr'],
                             "tgl"=>$dbRow['tgl'],
                             "total"=>number_format($dbRow['total']),
                             "cabang"=>$dbRow['cabang'],
                             "gudang"=>$dbRow['gudang'],
                             "supplier"=>$dbRow['supplier']
                            ) ;
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptpo.openreporttotal() ; ') ;

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
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"","6"=>"","7"=>"","8"=>"","9"=>"") ;
            $vttd[] = array("1"=>"Diajukan","2"=>"","3"=>"Diperiksa","4"=>"","5"=>"Verifikasi","6"=>"","7"=>"Disetujui","8"=>"","9"=>"Mengetahui") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"","6"=>"","7"=>"","8"=>"","9"=>"") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"","6"=>"","7"=>"","8"=>"","9"=>"") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"","6"=>"","7"=>"","8"=>"","9"=>"") ;
            $vttd[] = array("1"=>"(.........................)","2"=>"","3"=>"(.........................)","4"=>"","5"=>"(.........................)","6"=>"","7"=>"(.........................)","8"=>"","9"=>"(.........................)") ;
            $vttd[] = array("1"=>"Staff Pembelian","2"=>"","3"=>"Manager","4"=>"","5"=>"SPI","6"=>"","7"=>"Direktur","8"=>"","9"=>"Direksi") ;
            
            $vttd2 = array() ;
            $vttd2[] = array("1"=>"","2"=>"") ;
            $vttd2[] = array("1"=>"Tanda Tangan","2"=>"") ;
            $vttd2[] = array("1"=>"","2"=>"") ;
            $vttd2[] = array("1"=>"","2"=>"") ;
            $vttd2[] = array("1"=>"","2"=>"") ;
            $vttd2[] = array("1"=>"","2"=>"") ;
            $vttd2[] = array("1"=>"","2"=>"") ;
            $vttd2[] = array("1"=>"(.........................)","2"=>"") ;
            $vttd2[] = array("1"=>"Penerima","2"=>"") ;



            $nTotalSaldo  = 0 ;
            $nNumber = 0 ;
            foreach ($data as $key => $value) {
                $nNumber       = str_replace(",", "", $value['Total']) ;
                $nTotalSaldo  += $nNumber;
            }
            $nTotalSaldo = number_format($nTotalSaldo) ;

            $total   = array();
            $total[] = array("Ket"=>"<b>Total",
                             "Jumlah"=>$nTotalSaldo."</b>",);

            $font = 8 ;
            $exTgl = explode("-",$va['tgl']);
            $dTglFaktur = $exTgl['2'] . "-" . $exTgl['1'] . "-" . $exTgl['0'];

            $vDetail = array() ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Faktur","5"=>":","6"=>$va['cFaktur']) ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Supplier","5"=>":","6"=>$va['supplier']) ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Tanggal","5"=>":","6"=>$dTglFaktur) ;

            $vTitle = array() ;
            $vTitle[] = array("capt"=>" PURCHASE ORDER (PO) ") ;

            $vKetentuan = array() ;
            $vKetentuan[] = array("1"=>"1","2"=>"Term of payment..............hari setelah barang diterima oleh pihak perusahaan") ;
            $vKetentuan[] = array("1"=>"2","2"=>"Waktu pengiriman dan spesifikasi barang sesuai dengan permintaan dari perusahaan") ;
            $vKetentuan[] = array("1"=>"3","2"=>"Pembayaran akan dilakukan oleh pihak perusahaan ke nomor rekening bank supplier yang jelas dan data sebagai berikut:") ;
            $vKetentuan[] = array("1"=>"","2"=>"a. Nama bank") ;
            $vKetentuan[] = array("1"=>"","2"=>"b. No. rekening supplier") ;
            $vKetentuan[] = array("1"=>"","2"=>"c. Nama dalam rekening supplier") ;

            $vDiterima = array() ;
            $vDiterima[] = array("1"=>"Supplier","2"=>":","3"=>"....................................................") ;
            $vDiterima[] = array("1"=>"Contact Person","2"=>":","3"=>"....................................................") ;
            $vDiterima[] = array("1"=>"No. HP / Tlp Kantor","2"=>":","3"=>"....................................................") ;



            $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock','mtop'=>1) ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezLogoHeaderPage(base_url()."uploads/HeaderSJDO.jpg",'0','65','150','50');
            $this->bospdf->ezTable($vDetail,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>10,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"left"),
                                             "3"=>array("justification"=>"left"),
                                             "4"=>array("width"=>10,"justification"=>"left"),
                                             "5"=>array("width"=>3,"justification"=>"left"),
                                             "6"=>array("width"=>20,"justification"=>"left"),)
                                        )
                                  ) ;

            $this->bospdf->ezTable($vTitle,"","",
                                   array("fontSize"=>$font+3,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "capt"=>array("justification"=>"center"),)
                                        )
                                  ) ;

            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($data,"","",
                                   array("fontSize"=>$font,
                                         "cols"=> array(
                                             "#"            =>array("width"=>2,"justification"=>"right"),
                                             "Kode"  =>array("width"=>12,"justification"=>"center"),
                                             "Keterangan"   =>array("wrap"=>1),
                                             "Spesifikasi"   =>array("wrap"=>1),
                                             "Harga"  =>array("width"=>12,"justification"=>"right"),
                                             "Qty"          =>array("width"=>8,"justification"=>"right"),
                                             "Satuan"       =>array("width"=>9,"justification"=>"left"),
                                             "Total"        =>array("width"=>12,"justification"=>"right")))
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
            $this->bospdf->ezText("*) Ketentuan") ;
            $this->bospdf->ezTable($vKetentuan,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>3,"justification"=>"right"),
                                             "2"=>array("justification"=>"left","wrap"=>1))
                                        )
                                  ) ;
            $this->bospdf->ezText("");
            $this->bospdf->ezText($kota) ;
            $this->bospdf->ezTable($vttd,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "2"=>array("justification"=>"center"),
                                             "3"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "4"=>array("justification"=>"center"),
                                             "5"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "6"=>array("justification"=>"center"),
                                             "7"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "8"=>array("justification"=>"center"),
                                             "9"=>array("width"=>15,"wrap"=>1,"justification"=>"center"))
                                        )
                                  ) ;
             $this->bospdf->ezText("");
            $this->bospdf->ezText("<b>Diterima</b>") ;
            $this->bospdf->ezTable($vDiterima,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>15,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"center","wrap"=>1),
                                         "3"=>array("justification"=>"left","wrap"=>1))
                                        )
                                  ) ;
            
            $this->bospdf->ezTable($vttd2,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "2"=>array("justification"=>"center"))
                                        )
                                  ) ;
            $this->bospdf->ezText("");
            $this->bospdf->ezText("[!]  1.Supplier  2.Keuangan 3.Pembelian  4.Gudang");
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

            $nTotalTotal      = 0 ;
            foreach ($data as $key => $value) {
                $nTotal           = str_replace(",", "", $value['total']) ;
                $nTotalTotal  += $nTotal;
            }

            $nTotalTotal      = number_format($nTotalTotal) ;

            $total   = array();
            $total[] = array("Ket"=>"<b>Total",
                             "JumlahTotalTotal"=>$nTotalTotal,
                             "Ket2"=>"</b>");

            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'P', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezText("<b>LAPORAN TOTAL PURCHASE ORDER</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("<b>Periode : " .$va['tglawal']. " s/d " . $va['tglakhir'] . "</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($data,"","",
                                   array("fontSize"=>$font,
                                         "cols"=> array(
                                             "#"=>array("width"=>2,"justification"=>"right"),
                                             "faktur"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "fktpr"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "tgl"=>array("width"=>10,"wrap"=>1,"justification"=>"center"),
                                             "total"=>array("width"=>10,"justification"=>"right"),
                                             "cabang"=>array("width"=>5,"justification"=>"center"),
                                             "gudang"=>array("width"=>5,"justification"=>"center")
                                         ))
                                  ) ;
            $this->bospdf->ezTable($total,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                         "cols"=> array(
                                             "Ket"=>array("width"=>27,"justification"=>"center"),
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
	
	public function cetakdm(){
        $va 	= $this->input->post() ;
        //print_r($va);
		
		$faktur = $va['faktur'] ;
		

        $this->func_m->cetakpo($faktur);
    }
}

?>
