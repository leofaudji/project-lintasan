<?php
class Trso extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trso_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trso_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trso',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trso_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trso_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trso.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trso.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdcetak']     = '<button type="button" onClick="bos.trso.cmdcetak(\''.$dbr['faktur'].'\')"
                                        class="btn btn-warning btn-grid">Cetak</button>' ;
            $vaset['cmdcetak']       = html_entity_decode($vaset['cmdcetak']) ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssso_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssso_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trso_m->saving($kode, $va) ;
        echo(' bos.trso.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trso_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssso_faktur", $faktur) ;
            $gudang[]   = array("id"=>$data['gudang'],"text"=>$data['ketgudang']);
            echo('
            w2ui["bos-form-trso_grid2"].clear();
            with(bos.trso.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#gudang").sval('.json_encode($gudang).');
            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trso_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trso_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trso.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trso_grid2"].add('.$vare.');
                bos.trso.initdetail();
                bos.trso.settab(1) ;
            ');
        }
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trso_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trso.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#satuan").val("'.$data['satuan'].'");
               bos.trso.loadmodelstock("hide");
            }

         ') ;
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trso_m->deleting($va['faktur']) ;
        echo('bos.trso.grid1_reloaddata() ; ') ;

    }

    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->trso_m->seekgudang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trso_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trso_m->getfaktur(FALSE) ;

        echo('
        bos.trso.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trso_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trso_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trso.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function getDataStock(){
      $va = $this->input->post();
      $cKode = $va['cKodeStock'];
      $dbData  = $this->trso_m->getDataStock($cKode) ;
      if($dbRow = $this->trso_m->getrow($dbData)){
        $cKeterangan = $dbRow['Keterangan'];
        $cSatuan     = $dbRow['Satuan'];
        $saldo = $this->perhitungan_m->GetSaldoAkhirStock($cKode,$va['tgl'],$va['gudang'],getsession($this, "cabang"));
        echo('
        alert("'.$saldo.'");
          bos.trso.obj.find("#satuan").val("'.$cSatuan.'") ;
          bos.trso.obj.find("#namastock").val("'.$cKeterangan.'") ;
          bos.trso.obj.find("#saldosistem").val("'.$saldo.'") ;
        ');
      }else {
        echo('
          bos.trso.obj.find("#stock").val("") ;
          bos.trso.obj.find("#saldosistem").val("0") ;
          bos.trso.obj.find("#nomor").focus() ;
          alert("Data Tidak Ditemukan!!");
        ');
      }
    }
    
    public function showreport(){
        $va 	= $this->input->get() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trso_m->getdatatotal($faktur) ;
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
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Gudang","5"=>":","6"=>$data['gudang']."-".$data['ketgudang']);
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Tgl","5"=>":","6"=>date_2d($data['tgl']));
            $vTitle = array() ;
            $vTitle[] = array("capt"=>" Stock Opname ") ;

            //detail
            $dbd = $this->trso_m->getdatadetail($faktur) ;
            $n = 0 ;
            $array = array();

            while( $dbr = $this->trso_m->getrow($dbd)){
                $n++;
                $array[] = array("No"=>$n,"Stock"=>$dbr['stock'],"Nama Stock"=>$dbr['namastock'],"Qty"=>string_2s($dbr['qty']),"Satuan"=>$dbr['satuan']);
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
                                             "No"           =>array("width"=>5,"justification"=>"right"),
                                             "Stock"  	    =>array("width"=>10,"justification"=>"center"),
                                             "Nama Stock"   =>array("justification"=>"left"),
                                             "Qty" =>array("width"=>15,"justification"=>"right"),
                                         "Satuan"  	    =>array("width"=>10,"justification"=>"left")))
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
