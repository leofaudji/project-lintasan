<?php
class Trsoposting extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trsoposting_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trsoposting_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trsoposting',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trsoposting_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trsoposting_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trsoposting.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdcetak']    = '<button type="button" onClick="bos.trsoposting.cmdcetak(\''.$dbr['faktur'].'\')"
                                         class="btn btn-warning btn-grid">Cetak</button>' ;
            $vaset['cmdcetak']    = html_entity_decode($vaset['cmdcetak']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function loadgrid2(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $vdb                = $this->trsoposting_m->loadgrid2($va) ;
        $dbd                = $vdb['db'] ;
        $n = 0 ;
        while( $dbr = $this->trsoposting_m->getrow($dbd) ){
            $n++;
            $dbr['no'] = $n;
            $dbr['recid'] = $n;
            $dbr['saldosistem'] = $this->perhitungan_m->GetSaldoAkhirStock($dbr['kode'],date_2s($va['tgl']),$va['gudang']);
            $dbr['saldoreal'] = $this->trsoposting_m->saldorealopname($dbr['kode'],date_2s($va['tgl']),$va['gudang']);
            $dbr['selisih'] = $dbr['saldosistem'] - $dbr['saldoreal'];
            $vaset                  = $dbr ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "sssoposting_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "sssoposting_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trsoposting_m->saving($kode, $va) ;
        echo(' bos.trsoposting.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trsoposting_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "sssoposting_faktur", $faktur) ;
            $rekkas[] = array("id"=>$data['rekkas'],"text"=>$data['rekkas']."-".$data['ketrekening']);


            echo('
            w2ui["bos-form-trsoposting_grid2"].clear();
            with(bos.trsoposting.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#rekkas").sval('.json_encode($rekkas).');
               find("#nominal").val("'.string_2s($data['nominal'],2).'") ;

            }
            bos.trsoposting.grid2_reloaddata();
            bos.trsoposting.settab(1) ;

         ') ;
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trsoposting_m->deleting($va['faktur']) ;
        echo('bos.trsoposting.grid1_reloaddata() ; ') ;

    }

    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->trsoposting_m->seekgudang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trsoposting_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $va 	= $this->input->post() ;
        $faktur  = $this->trsoposting_m->getfaktur(FALSE) ;

        echo('
        bos.trsoposting.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function showreport(){
        $va 	= $this->input->get() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trsoposting_m->getdatatotal($faktur) ;
        if(!empty($data)){
            $font = 10 ;
            $now  = date_2b(date("Y-m-d")) ;
            $kota = $this->bdb->getconfig("kota") . ", " . $now['d'] . ' ' . $now['m'] . ' ' . $now['y'];
            $vttd = array() ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=> $kota ,"5"=>"") ;
            //$vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"Dibuat,","3"=>"","4"=>"Mengetahui,","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"(.......................)","3"=>"","4"=>"(.......................)","5"=>"") ;

            $vDetail = array() ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Faktur","5"=>":","6"=>$faktur);
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Tgl","5"=>":","6"=>date_2d($data['tgl']));
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Gudang","5"=>":","6"=>$data['gudang'] ."-". $data['ketgudang']);

            $vTitle = array() ;
            $vTitle[] = array("capt"=>" Opname Stock ") ;


            //total
            $totqtysis = 0;
            $totqtyreal = 0;
            $totqtyselisih = 0;
            $nsistem = 0;
            $nreal = 0;
            $nselisih = 0;

            //detail
            $dbd = $this->trsoposting_m->getdatadetail($faktur) ;
            $n = 0 ;
            $array = array();

            while( $dbr = $this->trsoposting_m->getrow($dbd)){
                $n++;
                $selisihn = $dbr['nilaipersdsistem'] - $dbr['nilaipersdreal'];
                $selisihqty = $dbr['saldosistem'] - $dbr['saldoreal'];
                $array[] = array("No"=>$n,"Kode"=>$dbr['kode'],"Keterangan"=>$dbr['keterangan'],"Sat"=>$dbr['satuan'],
                                 "QtySis"=>string_2s($dbr['saldosistem']),
                                 "QtyReal"=>string_2s($dbr['saldoreal']),"QtySelisih"=>string_2s($selisihqty),
                                 "N.Sistem"=>string_2s($dbr['nilaipersdsistem']),
                                 "N.Real"=>string_2s($dbr['nilaipersdreal']),"N.Selisih"=>string_2s($selisihn));
                $totqtysis  += $dbr['saldosistem'];
                $totqtyreal += $dbr['saldoreal'];
                $totqtyselisih += $selisihqty;
                $nsistem += $dbr['nilaipersdsistem'];
                $nreal   += $dbr['nilaipersdreal'];
                $nselisih += $selisihn;
            }

            $arrtotal[0] = array("Keterangan"=>"<b>Total","QtySis"=>string_2s($totqtysis),
                                 "QtyReal"=>string_2s($totqtyreal),"QtySelisih"=>string_2s($totqtyselisih),
                                 "N.Sistem"=>string_2s($nsistem),"N.Real"=>string_2s($nreal),
                                 "N.Selisih"=>string_2s($nselisih)."</b>");

            $o    = array('paper'=>'A4', 'orientation'=>'l',
                          'opt'=>array('export_name'=>'Kartu Stock') ) ;
            $this->load->library('bospdf', $o) ;
            //$this->bospdf->ezSetMargins(1,1,20,20);
            //$this->bospdf->ezSetCmMargins(0, 1, 1, 1);
            //$this->bospdf->ezImage("./uploads/HeaderSJDO.jpg",true,'60','190','50');
            //$this->bospdf->ezHeader("<b>DELIVERY ORDER (DO)</b>",array("justification"=>"center")) ;
            //$this->bospdf->ezText("") ;

            //ketika width tidak di set maka akan menyesuaikan dengan lebar kertas

            $this->bospdf->ezTable($vDetail,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>10,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"left"),
                                             "3"=>array("justification"=>"left"),
                                             "4"=>array("width"=>10,"justification"=>"left"),
                                             "5"=>array("width"=>3,"justification"=>"left"),
                                             "6"=>array("width"=>25,"justification"=>"left","wrap"=>1),)
                                        )
                                  ) ;

            $this->bospdf->ezTable($vTitle,"","",
                                   array("fontSize"=>$font+3,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "capt"=>array("justification"=>"center"),)
                                        )
                                  ) ;

            $this->bospdf->ezText("") ;
            $font = 8 ;
            $this->bospdf->ezTable($array,"","",
                                   array("fontSize"=>$font,"showLines"=>1,
                                         "cols"=> array(
                                             "No"       =>array("width"=>5,"justification"=>"right"),
                                             "Kode"  	=>array("width"=>10,"justification"=>"center"),
                                             "Keterangan"  =>array("justification"=>"left"),
                                             "Sat"      =>array("width"=>5,"justification"=>"left"),
                                             "QtySis"      =>array("width"=>10,"justification"=>"right"),
                                             "QtyReal"     =>array("width"=>10,"justification"=>"right"),
                                             "QtySelisih"  =>array("width"=>10,"justification"=>"right"),
                                             "N.Sistem"    =>array("width"=>10,"justification"=>"right"),
                                             "N.Real"      =>array("width"=>10,"justification"=>"right"),
                                             "N.Selisih"   =>array("width"=>10,"justification"=>"right"),))
                                  ) ;
            $this->bospdf->ezTable($arrtotal,"","",
                                   array("fontSize"=>$font,"showLines"=>1,"showHeadings"=>0,
                                         "cols"=> array(
                                             "Keterangan"  =>array("justification"=>"center"),
                                             "QtySis"      =>array("width"=>10,"justification"=>"right"),
                                             "QtyReal"     =>array("width"=>10,"justification"=>"right"),
                                             "QtySelisih"  =>array("width"=>10,"justification"=>"right"),
                                             "N.Sistem"    =>array("width"=>10,"justification"=>"right"),
                                             "N.Real"      =>array("width"=>10,"justification"=>"right"),
                                             "N.Selisih"   =>array("width"=>10,"justification"=>"right"),))
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
            echo("data tidak ada !!!");
        }

    }

}
?>
