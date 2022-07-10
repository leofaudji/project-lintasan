<?php
class Tropnamekas extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/tropnamekas_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->tropnamekas_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/tropnamekas',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->tropnamekas_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->tropnamekas_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.tropnamekas.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.tropnamekas.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdcetak']    = '<button type="button" onClick="bos.tropnamekas.cmdcetak(\''.$dbr['faktur'].'\')"
                                         class="btn btn-warning btn-grid">Cetak</button>' ;
            $vaset['cmdcetak']    = html_entity_decode($vaset['cmdcetak']) ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function loadgrid2(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $vdb                = $this->tropnamekas_m->loadgrid2($va) ;
        $dbd                = $vdb['db'] ;
        $n = 0 ;
        while( $dbr = $this->tropnamekas_m->getrow($dbd) ){
            $n++;
            $dbr['no'] = $n;
            $dbr['recid'] = $n;
            $vaset                  = $dbr ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssopnamekas_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssopnamekas_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->tropnamekas_m->saving($kode, $va) ;
        echo(' bos.tropnamekas.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->tropnamekas_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssopnamekas_faktur", $faktur) ;
            $rekkas[] = array("id"=>$data['rekkas'],"text"=>$data['rekkas']."-".$data['ketrekening']);


            echo('
            w2ui["bos-form-tropnamekas_grid2"].clear();
            with(bos.tropnamekas.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#rekkas").sval('.json_encode($rekkas).');
               find("#nominal").val("'.string_2s($data['nominal'],2).'") ;

            }
            bos.tropnamekas.grid2_reloaddata();
            bos.tropnamekas.settab(1) ;

         ') ;
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->tropnamekas_m->deleting($va['faktur']) ;
        echo('bos.tropnamekas.grid1_reloaddata() ; ') ;

    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->tropnamekas_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->tropnamekas_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $va 	= $this->input->post() ;
        $faktur  = $this->tropnamekas_m->getfaktur(FALSE) ;

        echo('
        bos.tropnamekas.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }
    
    public function showreport(){
        $va 	= $this->input->get() ;
        $faktur = $va['faktur'] ;
        $data   = $this->tropnamekas_m->getdatatotal($faktur) ;
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
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Rek Kas","5"=>":","6"=>$data['rekkas']."-".$data['ketrekening']);
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Tgl","5"=>":","6"=>date_2d($data['tgl']));
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Nominal","5"=>":","6"=>string_2s($data['nominal']));
            $vTitle = array() ;
            $vTitle[] = array("capt"=>" Kas Opname ") ;

            //detail
            $dbd = $this->tropnamekas_m->getdatadetail($faktur) ;
            $n = 0 ;
            $array = array();

            while( $dbr = $this->tropnamekas_m->getrow($dbd)){
                $n++;
                $array[] = array("No"=>$n,"Kode"=>$dbr['kode'],"Pecahan"=>string_2s($dbr['pecahan']),"Qty"=>string_2s($dbr['qty']),"Nominal"=>string_2s($dbr['nominal']));
            }


            $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock','mtop'=>1) ) ;
            $this->load->library('bospdf', $o) ;
            //$this->bospdf->ezSetMargins(1,1,20,20);
            //$this->bospdf->ezSetCmMargins(0, 1, 1, 1);
            //$this->bospdf->ezImage("./uploads/HeaderSJDO.jpg",true,'60','190','50');
            $this->bospdf->ezLogoHeaderPage(base_url()."uploads/HeaderSJDO.jpg",'0','65','150','50');
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
            $this->bospdf->ezTable($array,"","",
                                   array("fontSize"=>$font,"showLines"=>1,
                                         "cols"=> array(
                                             "No"            =>array("width"=>5,"justification"=>"right"),
                                             "Kode"  	=>array("width"=>8,"justification"=>"center"),
                                             "Pecahan"   =>array("width"=>15,"justification"=>"right"),
                                             "Qty"   =>array("width"=>12,"justification"=>"right"),
                                             "Nominal"   =>array("width"=>15,"justification"=>"right")))
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
