<?php
class Mstdatastock extends Bismillah_Controller{
    private $bdb ;
    private $bdbgroupstock ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('mst/mstdatastock_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->mstdatastock_m ;
    }

    public function index(){
        $this->load->view('mst/mstdatastock') ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->mstdatastock_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $n = 0;
        while( $dbr = $this->mstdatastock_m->getrow($dbd) ){

            //$dbr['kode'] = $dbr['kode']."<br/>". $dbr['keterangan'];\
            $dbr['hj'] = $this->perhitungan_m->gethjterendah($dbr['kode']);
            $arrstock = $this->perhitungan_m->getdetailsaldostock($dbr['kode'],date("Y-m-d"));
            $dbr['hp'] = $arrstock['hp'];
            $dbr['hb'] = $this->perhitungan_m->gethbterakhir($dbr['kode'],date("Y-m-d"));
            $dbr['mrghp'] = $dbr['hj'] - $dbr['hp'];
            $dbr['mrghb'] = $dbr['hj'] - $dbr['hb'];
            $dbr['mrghppers'] = devide($dbr['mrghp'],$dbr['hp']) * 100;
            $dbr['mrghbpers'] = devide($dbr['mrghb'],$dbr['hb']) * 100;

            $vaset   = $dbr ;
            $vaset['cmdedit']    = '<button type="button" onClick="bos.mstdatastock.cmdedit(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']  = '<button type="button" onClick="bos.mstdatastock.cmddelete(\''.$dbr['kode'].'\')"
                           class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']	   = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

            $ltampil = false;
            if($va['jenis'] == "0"){
                $ltampil = true;
            }else if($va['jenis'] == "1"){
                if($dbr['mrghp'] <= 0 || $dbr['mrghb'] <= 0){
                    $ltampil = true;
                }
            }
            if($ltampil){
                $n++;
                $vare[]		= $vaset ;
            }
        }

        $vare 	= array("total"=>$n, "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssstock_kode", "") ;
    }

    public function getkode(){
        $n  = $this->bdb->getkode(FALSE) ;

        echo('
        bos.mstdatastock.obj.find("#kode").val("'.$n.'") ;
        ') ;
    }

    public function saving(){
        $va 	  = $this->input->post() ;
        $kode 	= getsession($this, "ssstock_kode") ;
        $this->mstdatastock_m->saving($kode, $va) ;
        echo(' bos.mstdatastock.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->mstdatastock_m->getdata($kode) ;
        if( $dbr = $this->mstdatastock_m->getrow($data) ){
            savesession($this, "ssstock_kode", $kode) ;
            $satuan[] = array("id"=>$dbr['satuan'],"text"=>$dbr['KetSatuan']);
            $group[]  = array("id"=>$dbr['stock_group'],"text"=>$dbr['KetStockGroup']);

            echo('
            w2ui["bos-form-mstdatastock_grid2"].clear();
            with(bos.mstdatastock.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#kode").val("'.$dbr['kode'].'") ;
               find("#barcode").val("'.$dbr['barcode'].'") ;
               find("#group").sval('.json_encode($group).') ;
               find("#satuan").sval('.json_encode($satuan).') ;
               find("#keterangan").val("'.$dbr['keterangan'].'").focus() ;

            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->mstdatastock_m->getdatahj($kode) ;
            $n = 0 ;
            while( $dbr = $this->mstdatastock_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.mstdatastock.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-mstdatastock_grid2"].add('.$vare.');
                bos.mstdatastock.settab(1) ;
                ');
        }
    }

    public function deleting(){
        $va 	= $this->input->post() ;
        $this->mstdatastock_m->deleting($va['kode']) ;
        echo(' bos.mstdatastock.grid1_reloaddata() ; ') ;
    }

    public function seeksatuan(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstdatastock_m->seeksatuan($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstdatastock_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seekgroup(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstdatastock_m->seekgroup($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstdatastock_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function cekdtockbybarcode(){
        $va 	= $this->input->post() ;
        $barcode = $va['barcode'];
        $data = $this->mstdatastock_m->getdatabybarcode($barcode,$va['kode']) ;
        if( $dbr = $this->mstdatastock_m->getrow($data)){
            if($dbr['kode'] <> $va['kode']){


                    $alert = "Data in sudah digunakan oleh stock lain dengan kode -> ".$dbr['kode'];
                echo('
                    bos.mstdatastock.alertbarcode("'.$alert.'");
                ');
            }
        }

    }
}
?>
