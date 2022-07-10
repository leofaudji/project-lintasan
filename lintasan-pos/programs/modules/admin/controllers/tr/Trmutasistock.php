<?php
class Trmutasistock extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/perhitungan_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('tr/trmutasistock_m') ;

        $this->load->helper('bdate');
        $this->bdb = $this->trmutasistock_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trmutasistock',$d) ;
    }
    
    public function init(){
        savesession($this, "ssmutasistock_faktur", "") ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trmutasistock_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trmutasistock_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trmutasistock.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trmutasistock.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }


    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trmutasistock_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trmutasistock.obj){
               find("#stockfrom").val("'.$data['kode'].'") ;
               find("#barcodefrom").val("'.$data['barcode'].'") ;
               find("#namastockfrom").val("'.$data['keterangan'].'");
               find("#satuanfrom").val("'.$data['satuan'].'");
               bos.trmutasistock.loadmodelstock("hide");
            }

         ') ;
        }
    }

    public function pilihstockto(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trmutasistock_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trmutasistock.obj){
               find("#stockto").val("'.$data['kode'].'") ;
               find("#barcodeto").val("'.$data['barcode'].'") ;
               find("#namastockto").val("'.$data['keterangan'].'");
               find("#satuanto").val("'.$data['satuan'].'");
               bos.trmutasistock.loadmodelstockto("hide");
            }

         ') ;
        }
    }

    public function seekstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        //print_r($va);
        $data = $this->trmutasistock_m->getdata($kode) ;
        if(!empty($data)){
            echo('

            with(bos.trmutasistock.obj){
               find("#stockfrom").val("'.$data['kode'].'") ;
               find("#barcodefrom").val("'.$data['barcode'].'") ;
               find("#namastockfrom").val("'.$data['keterangan'].'");
               find("#satuanfrom").val("'.$data['satuan'].'");
            }

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.trmutasistock.obj){
                    find("#stockfrom").val("") ;
                    find("#stockfrom").focus() ;
                }
            ');
        }
    }

    public function seekstockto(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        //print_r($va);
        $data = $this->trmutasistock_m->getdata($kode) ;
        if(!empty($data)){
            echo('

            with(bos.trmutasistock.obj){
               find("#stockto").val("'.$data['kode'].'") ;
               find("#barcodeto").val("'.$data['barcode'].'") ;
               find("#namastockto").val("'.$data['keterangan'].'");
               find("#satuanto").val("'.$data['satuan'].'");
            }

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.trmutasistock.obj){
                    find("#stockto").val("") ;
                    find("#stockto").focus() ;
                }
            ');
        }
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trmutasistock_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trmutasistock_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trmutasistock.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function loadgrid4(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trmutasistock_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trmutasistock_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trmutasistock.cmdpilihto(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasistock_m->seekgudang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasistock_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trmutasistock_m->getfaktur(FALSE) ;

        echo('
        bos.trmutasistock.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }
    
    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssmutasistock_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trmutasistock_m->saving($kode, $va) ;
        echo(' bos.trmutasistock.settab(0) ;  ') ;
    }
    
    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trmutasistock_m->getdatamutasi($faktur) ;
        if(!empty($data)){
            savesession($this, "ssmutasistock_faktur", $faktur) ;
            $gudangfrom[]   = array("id"=>$data['gudangfrom'],"text"=>$data['ketgudangfrom']);
            $gudangto[]   = array("id"=>$data['gudangto'],"text"=>$data['ketgudangto']);
            echo('
            with(bos.trmutasistock.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#gudangfrom").sval('.json_encode($gudangfrom).');
               find("#stockfrom").val("'.$data['stockfrom'].'") ;
               find("#namastockfrom").val("'.$data['namastockfrom'].'") ;
               find("#satuanfrom").val("'.$data['satuanfrom'].'") ;
               find("#barcodefrom").val("'.$data['barcodefrom'].'") ;
               find("#mutasifrom").val("'.$data['qtyfrom'].'") ;
               find("#gudangto").sval('.json_encode($gudangto).');
               find("#stockto").val("'.$data['stockto'].'") ;
               find("#namastockto").val("'.$data['namastockto'].'") ;
               find("#satuanto").val("'.$data['satuanto'].'") ;
               find("#barcodeto").val("'.$data['barcodeto'].'") ;
               find("#mutasito").val("'.$data['qtyto'].'") ;

            }


                bos.trmutasistock.settab(1) ;
            ');
        }
    }
    
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trmutasistock_m->deleting($va['faktur']) ;
        echo('bos.trmutasistock.grid1_reloaddata() ; ') ;

    }
}
?>
