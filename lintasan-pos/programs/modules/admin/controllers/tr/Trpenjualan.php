<?php
class Trpenjualan extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('tr/trpenjualan_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trpenjualan_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trpenjualan',$d) ;
    }

    public function init(){
        savesession($this, "sspenjualan_faktur", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $kode 	= getsession($this, "sspenjualan_faktur") ;
        $va['tgl']        = date_2s($va['tgl']) ;
        $this->trpenjualan_m->saving($kode, $va) ;
        echo(' bos.trpenjualan.init() ; 
            alert("Data telah disimpan,,!!");
        ') ;
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trpenjualan_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trpenjualan.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#qty").focus() ;
               find("#satuan").val("'.$data['satuan'].'");
               bos.trpenjualan.loadmodelstock("hide");
               bos.trpenjualan.hitungjumlah();
            }

         ') ;
        }
    }
    
    public function seekstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        $data = $this->trpenjualan_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trpenjualan.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.$data['hargajual'].'");
               find("#qty").focus() ;
               find("#satuan").val("'.$data['satuan'].'");
            }
            bos.trpenjualan.hitungjumlah();
            bos.trpenjualan.obj.find("#cmdok")[0].click();

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.trpenjualan.obj){
                    find("#stock").val("") ;
                    find("#stock").focus() ;
                }
            ');
        }
    }
    
    public function seekkartu(){
        $va 	= $this->input->post() ;
        $nokartu = $va['nokartu'] ;
        $dbdata   = $this->trpenjualan_m->getdatakartu($nokartu) ;
        if($dbrow = $this->trpenjualan_m->getrow($dbdata)){
            echo('
            with(bos.trpenjualan.obj){
               find("#nokartu").val("'.$dbrow['nokartu'].'") ;
               find("#tglexpkartu").val("'.s_2date($dbrow['tglexp']).'");
               find("#operatorkartu").val("'.$dbrow['ketoperator'].'") ;
               find("#isipulsakartu").val("'.$dbrow['isipulsa'].'") ;
               find("#hargakartu").val("'.$dbrow['hargajual'].'") ;
            }

         ') ;
        }else{
            echo('
                alert("nokartu tidak ditemukan !!!");
            ');
        }
    }

    public function getfaktur(){
        $faktur  = $this->trpenjualan_m->getfaktur(FALSE) ;

        echo('
        bos.trpenjualan.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trpenjualan_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trpenjualan_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trpenjualan.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function seekcustomer(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpenjualan_m->seekcustomer($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpenjualan_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function pilihsj(){
        $va 	= $this->input->post() ;
        $fktsj 	= $va['fktsj'] ;
        $data = $this->trpenjualan_m->getdatasj($fktsj) ;
        if(!empty($data)){
            $customer[]   = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            echo('
            with(bos.trpenjualan.obj){
               find("#fktsj").val("'.$data['faktur'].'") ;
               find("#customer").sval('.json_encode($customer).');
               bos.trpenjualan.loadmodelsj("hide");
            }

         ') ;
            //loadgrid detail PO
            $vare = array();
            $dbd = $this->trpenjualan_m->getdatadetailsj($fktsj) ;
            $n = 0 ;
            while( $dbr = $this->trpenjualan_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $dbr['stock'];
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trpenjualan.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trpenjualan_grid2"].add('.$vare.');
                bos.trpenjualan.initdetail();
                bos.trpenjualan.hitungsubtotal();
            ');
        }
    }

    public function loadgrid4(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trpenjualan_m->loadgrid4($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trpenjualan_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trpenjualan.cmdpilihsj(\''.$dbr['faktur'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
}
?>
