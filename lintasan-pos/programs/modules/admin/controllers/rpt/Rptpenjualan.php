<?php
class Rptpenjualan extends Bismillah_Controller{

    protected $bdb ;
    protected $ss ;
    protected $abc ;
    public function __construct(){
        parent::__construct() ;
        $this->load->helper('bdate');
        $this->load->model('rpt/rptpenjualan_m') ;
        $this->load->model('func/func_m') ;
		$this->load->library('curl');
        $this->bdb = $this->rptpenjualan_m ;
        $this->ss  = "ssrptpenjualan_" ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('rpt/rptpenjualan', $d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglawal'] = date_2s($va['tglawal']);
        $va['tglakhir'] = date_2s($va['tglakhir']);
        $vdb    = $this->rptpenjualan_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $x      = 0 ;
        $totsubtotal = 0 ;
        $totdiskon = 0 ;
        $totppn = 0 ;
        $tottotal = 0 ;
        $tothpp = 0 ;
        $totlaba = 0 ;
        while( $dbr = $this->rptpenjualan_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['recid'] = $vaset['faktur'];
            $vaset['totlaba'] = $vaset['total'] - $vaset['tothpp'];
            $vaset['perslaba'] = $this->func_m->devide($vaset['totlaba'],$vaset['total']) * 100;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vaset['cmdPreviewDetail']    = '<button type="button" onClick="bos.rptpenjualan.cmdPreviewDetail(\''.$dbr['faktur'].'\')"
		                                     class="btn btn-success btn-grid">Preview Detail</button>' ;
            $vaset['cmdPreviewDetail']    = html_entity_decode($vaset['cmdPreviewDetail']) ;
            $vaset['no']  = ++$x;
            $vare[]     = $vaset ;
            $totsubtotal += $vaset['subtotal'];
            $totdiskon += $vaset['diskonnom'];
            $tottotal += $vaset['total'];
            $tothpp += $vaset['tothpp'];
            $totlaba += $vaset['totlaba'];
        }
        $totperslaba = $this->func_m->devide($totlaba,$tottotal) * 100;
        $vare[] = array("recid"=>'ZZZZ',"no"=> '', "faktur"=> '', "tgl"=> '','customer'=>'',
                        "subtotal"=>$totsubtotal,"diskonnom"=>$totdiskon,"total"=>$tottotal,"tothpp"=>$tothpp,
                        "totlaba"=>$totlaba,"perslaba"=>$totperslaba,"cmdPreviewDetail"=>'',"w2ui"=>array("summary"=> true));
        $vare    = array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }


    public function detailpenjualan(){
        $va 	 = $this->input->post() ;
        $cFaktur = $va['faktur'] ;
        echo('
					w2ui["bos-form-rptpenjualan_grid2"].clear();
					');
        $data = $this->rptpenjualan_m->GetDataPerFaktur($cFaktur) ;
        if(!empty($data)){
            $kembalian = $data['kas'] - $data['total'];
            echo('
		            with(bos.rptpenjualan.obj){
		               find("#faktur").val("'.$data['faktur'].'") ;
		               find("#tgl").val("'.date_2d($data['tgl']).'");
		               find("#customer").val("'.$data['namacustomer'].'") ;
                       find("#bayar").val("'.string_2s($data['kas']).'") ;
                       find("#diskonnom").val("'.string_2s($data['diskon']).'") ;
                       find("#sj").val("'.$data['sj'].'") ;
		               find("#total").val("'.string_2s($data['subtotal']).'") ;
		               find("#kembalian").val("'.string_2s($kembalian).'") ;
		            }

     	        ') ;

            //LOAD GRID DETAIL PENJUALAN STOCK
            $vare = array();
            $dbd = $this->rptpenjualan_m->getdatadetail($cFaktur) ;
            $n = 0 ;
            while($dbr = $this->rptpenjualan_m->getrow($dbd)){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['laba'] = $vaset['jumlah'] - $vaset['hpp'];
                $vaset['perslaba'] = $this->func_m->devide($vaset['laba'],$vaset['jumlah']) * 100;
                $vare[] = $vaset ;
            }
            $vare[] = array("recid"=>"ZZZZ","no" => '', "stock"=> '', "namastock"=> '', "harga"=> '', "qty"=> '', "satuan"=>'',"jumlah"=>'0.00',"hpp"=>'0.00',"laba"=>'0.00',"perslaba"=>'0.00',"w2ui"=>array("summary"=>true));
            $vare = json_encode($vare);


            echo('
		            bos.rptpenjualan.loadmodeldetail("show") ;
					bos.rptpenjualan.grid2_reloaddata();
					w2ui["bos-form-rptpenjualan_grid2"].add('.$vare.');
		            bos.rptpenjualan.grid2_sumtotal();
	            ');
        }
    }

    public function initReportTotal(){
        $va         = $this->input->post() ;
        $dTglAwal	= date_2s($va['tglawal']) ;
        $dTglAkhir	= date_2s($va['tglakhir']) ;
        $file   = setfile($this, "rptPenjualan", __FILE__ , $va) ;
        savesession($this, $this->ss . "file", $file ) ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        file_put_contents($file, json_encode(array()) ) ;

        $file         = getsession($this, $this->ss . "file") ;
        // $fileTotal    = getsession($this, $this->ssT . "file") ;
        $data    = @file_get_contents($file) ;
        $data    = json_decode($data,true) ;
        $db      = $this->bdb->getdatatotal($dTglAwal,$dTglAkhir) ;
        $nDebet  = 0 ;
        $nKredit = 0 ;
        $nSaldo  = 0 ;
        $s = 0 ;
        $nTotalGeneral = 0 ;
        while($dbr = $this->bdb->getrow($db)){
            $no      = ++$s ;
            $data[]  = array("No"=>$no,
                             "Faktur"=>$dbr['faktur'],
                             "Tgl"=>$dbr['tgl'],
                             "Customer"=>$dbr['namacustomer'],
                             "SubTotal"=>number_format($dbr['subtotal']),
                             "Diskon"=>number_format($dbr['diskon']),
                             "Total"=>number_format($dbr['total']) );

            $nTotalGeneral += $dbr['total'] ;

        }

        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptpenjualan.OpenReportTotal() ; ') ;
    }

    public function initReportDetailPenjualan(){
        $va       = $this->input->post() ;
        $cFaktur  = $va['cFaktur'];
        $w        = "p.faktur = '".$cFaktur."'" ;

        $file   = setfile($this, "rptDetailPenjualan", __FILE__ , $va) ;
        savesession($this, $this->ss . "file", $file ) ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        file_put_contents($file, json_encode(array()) ) ;

        $file    = getsession($this, $this->ss . "file") ;
        $data    = @file_get_contents($file) ;
        $data    = json_decode($data,true) ;
        $db      = $this->bdb->getdatadetail($cFaktur) ;
        $nDebet  = 0 ;
        $nKredit = 0 ;
        $nSaldo  = 0 ;
        $s 	     = 0 ;
        $nTotalPembelian = 0 ;
        $nKembalian = 0 ;
        while($dbr = $this->bdb->getrow($db)){
            $no      = ++$s ;
            $nTotalPembelian += $dbr['jumlah'];
            $data[]  = array("No"=>$no,
                             "Menu"=>$dbr['namastock'],
                             "Harga"=>number_format($dbr['harga']),
                             "Qty"=>number_format($dbr['qty']),
                             "Diskon"=>number_format($dbr['diskon']),
                             "Satuan"=>$dbr['satuan'],
                             "Jumlah"=>number_format($dbr['jumlah']));
        }
        file_put_contents($file, json_encode($data) ) ;
        echo(' bos.rptpenjualan.OpenReportDetail() ; ') ;
    }


    public function ShowReportTotal(){
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

            $nTotalSubTotal = 0 ;
            $nTotalTotal = 0 ;
            $nTotalDiskon = 0 ;
            foreach ($data as $key => $value) {
                $nSubTotal		= str_replace(",", "", $value['SubTotal']);
                $nTotal			= str_replace(",", "", $value['Total']);
                $nDiskon			= str_replace(",", "", $value['Diskon']);

                $nTotalSubTotal 	+= $nSubTotal ;
                $nTotalTotal 		+= $nTotal ;
                $nTotalDiskon 		+= $nDiskon ;
            }

            $nTotalSubTotal 	= number_format($nTotalSubTotal) ;
            $nTotalTotal 		= number_format($nTotalTotal) ;
            $nTotalDiskon 		= number_format($nTotalDiskon) ;

            $total   = array();
            $total[] = array("Ket"=>"<b>Total",
                             "SubTotal"=>$nTotalSubTotal,
                             "Diskon"=>$nTotalDiskon,
                             "Total"=>$nTotalTotal."</b>",
                            );

            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'landscape', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            $this->bospdf->ezText("<b>LAPORAN PENJUALAN</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("<b>Periode ". $va['tglawal'] ." s/d ". $va['tglakhir'] ."</b>",$font,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($data,"","",
                                   array("fontSize"=>$font,
                                         "cols"=> array(
                                             "No"=>array("width"=>3,"justification"=>"center"),
                                             "Faktur"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "Tgl"=>array("width"=>15,"wrap"=>1,"justification"=>"center"),
                                             "Customer"=>array("justification"=>"left"),
                                             "SubTotal"=>array("width"=>10,"justification"=>"right"),
                                             "Diskon"=>array("width"=>10,"justification"=>"right"),
                                             "Total"=>array("width"=>10,"justification"=>"right")))
                                  ) ;
            $this->bospdf->ezTable($total,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>1,
                                         "cols"=> array(
                                             "Ket"=>array("justification"=>"center"),
                                             "SubTotal"=>array("width"=>10,"justification"=>"right"),
                                             "Diskon"=>array("width"=>10,"justification"=>"right"),
                                             "Total"=>array("width"=>10,"justification"=>"right"),
                                         )
                                        )
                                  ) ;
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
            echo('Data Tidak Ada!') ;
        }
    }

    public function ShowReportDetail(){
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



            $vDetail = array() ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Faktur","5"=>":","6"=>$va['cFaktur']) ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Customer","5"=>":","6"=>$va['customer']) ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Tanggal","5"=>":","6"=>$va['tgl']) ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"SJ","5"=>":","6"=>$va['sj']) ;

            $vTitle = array() ;
            $vTitle[] = array("capt"=>" LAPORAN DETAIL PENJUALAN ") ;

            $vPayment = array() ;
            $vPayment[] = array("1"=>"<b>Total</b>","2"=>" : ","3"=> $va['total'],"4"=>"","5"=>"","6"=>"", ) ;
            $vPayment[] = array("1"=>"<b>Diskon</b>","2"=>" : ","3"=> $va['diskonnom'],"4"=>"","5"=>"","6"=>"", ) ;
            $vPayment[] = array("1"=>"<b>Pembayaran</b>","2"=>" : ","3"=> $va['bayar'],"4"=>"","5"=>"","6"=>"", ) ;
            $vPayment[] = array("1"=>"<b>Kembalian</b>","2"=>" : ","3"=> $va['kembalian'],"4"=>"","5"=>"","6"=>"", ) ;



            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'potrait', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock','mtop'=>1) ) ;
            $this->load->library('bospdf', $o) ;
           // $this->bospdf->ezLogoHeaderPage(base_url()."uploads/HeaderSJDO.jpg",'0','65','150','50');
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
                                             "No"=>array("width"=>5,"justification"=>"center"),
                                             "Menu"=>array("wrap"=>1,"justification"=>"left"),
                                             "Harga"=>array("width"=>12,"wrap"=>1,"justification"=>"right"),
                                             "Qty"=>array("width"=>5,"justification"=>"center"),
                                             "Satuan"=>array("caption"=>"Satuan","width"=>10,"justification"=>"center"),
                                             "Jumlah"=>array("width"=>12,"justification"=>"right")))
                                  ) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($vPayment,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>10,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"left"),
                                             "3"=>array("width"=>15,"justification"=>"right"),
                                             "4"=>array("width"=>10,"justification"=>"left"),
                                             "5"=>array("width"=>10,"justification"=>"left"),
                                             "6"=>array("justification"=>"left"),)
                                        )
                                  ) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezText("") ;
            /*$this->bospdf->ezTable($vttd,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("justification"=>"right"),
                                          "2"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "3"=>array("width"=>40,"wrap"=>1),
                                          "4"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "5"=>array("wrap"=>1,"justification"=>"center"))
                                 )
                              ) ;*/
            $this->bospdf->ezStream() ;
        }else{
            echo('Data Tidak Ada!') ;
        }
    }
	
	public function cetakdm(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;

        $this->func_m->cetakiv($faktur);
    }
}
?>
