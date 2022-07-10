<?php
class Trpenjualankasir extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('func/perhitungan_m') ;
        $this->load->model('func/func_m') ;
        $this->load->model('tr/trpenjualankasir_m') ;
        $this->load->model('config/config_m') ;
        $this->load->helper('bdate');
        $this->load->library('escpos');
        $this->bdb = $this->trpenjualankasir_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trpenjualankasir',$d) ;
    }

    public function init(){
        savesession($this, "sspenjualankasir_faktur", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $error = "";
        $jmlbayar = String_2n($va['bayar']) + String_2n($va['diskonnom']);
        if(String_2n($va['kembalian']) < 0 or $jmlbayar <= 0 or String_2n($va['totalpj']) < String_2n($va['diskonnom']))$error = "Pembyaran tidak valid!!!";
        $sessionfkt 	= getsession($this, "sspenjualankasir_faktur") ;
        if($error == ""){
            if($sessionfkt == ""){
                $faktur = $this->trpenjualankasir_m->getfaktur() ;
                $va['faktur'] = $faktur;
                savesession($this, "sspenjualankasir_faktur", $faktur) ;
                $va['tgl']        = date_2s($va['tgl']) ;
                $this->trpenjualankasir_m->saving($va) ;
                echo(' 
                    bos.trpenjualankasir.init() ;
                    bos.trpenjualankasir.loadmodelbyr("hide");
                    bos.trpenjualankasir.cetakstruk("'.$faktur.'");
                ') ;
            }
        }else{
            echo('
                alert("'.$error.'");
                bos.trpenjualankasir.obj.find("#bayar").focus() ;
            ');
        }
    }

    public function cetakstruk(){
        $va 	= $this->input->post() ;
        if(isset($va['fakturtransaksi']))$this->func_m->cetakstruk($va['fakturtransaksi']);
    }
    
    public function opencashdrawer(){
        $this->func_m->opencashdraweronly();
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trpenjualankasir_m->getdata($kode,1) ;
        if(!empty($data)){
            echo('
            with(bos.trpenjualankasir.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#barcode").val("'.$data['barcode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#diskon").val("'.string_2s($data['diskon']).'");
               find("#qty").focus() ;
               find("#satuan").val("'.$data['satuan'].'");
               bos.trpenjualankasir.loadmodelstock("hide");
               bos.trpenjualankasir.hitungjumlah();
            }

         ') ;
        }
    }

    public function seekstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        //print_r($va);
        $va['qty'] += $va['qtygrid'];
        $data = $this->trpenjualankasir_m->getdata($kode,$va['qty']) ;
        if(!empty($data)){
            echo('

            with(bos.trpenjualankasir.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#barcode").val("'.$data['barcode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#diskon").val("'.string_2s($data['diskon']).'");
               find("#satuan").val("'.$data['satuan'].'");
            }
            bos.trpenjualankasir.hitungjumlah();
            bos.trpenjualankasir.gotogrid();

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.trpenjualankasir.obj){
                    find("#stock").val("") ;
                    find("#stock").focus() ;
                }
            ');
        }
    }
    
    public function seekstock2(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        //print_r($va);
        $data = $this->trpenjualankasir_m->getdata($kode,$va['qty']) ;
        if(!empty($data)){
            echo('

            with(bos.trpenjualankasir.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#barcode").val("'.$data['barcode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#diskon").val("'.string_2s($data['diskon']).'");
               find("#cmdok")[0].focus() ;
               find("#satuan").val("'.$data['satuan'].'");
            }
            bos.trpenjualankasir.hitungjumlah();


         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.trpenjualankasir.obj){
                    find("#stock").val("") ;
                    find("#stock").focus() ;
                }
            ');
        }
    }

        //    bos.trpenjualankasir.obj.find("#cmdok")[0].click();

    
    public function seekkartu(){
        $va 	= $this->input->post() ;
        $nokartu = $va['nokartu'] ;
        $dbdata   = $this->trpenjualankasir_m->getdatakartu($nokartu) ;
        if($dbrow = $this->trpenjualankasir_m->getrow($dbdata)){
            echo('
            with(bos.trpenjualankasir.obj){
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
        $faktur  = $this->trpenjualankasir_m->getfaktur(FALSE) ;

       /* echo('
        bos.trpenjualankasir.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;*/
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trpenjualankasir_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trpenjualankasir_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trpenjualankasir.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function seekcustomer(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpenjualankasir_m->seekcustomer($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpenjualankasir_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function pilihsj(){
        $va 	= $this->input->post() ;
        $fktsj 	= $va['fktsj'] ;
        $data = $this->trpenjualankasir_m->getdatasj($fktsj) ;
        if(!empty($data)){
            $customer[]   = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            echo('
            with(bos.trpenjualankasir.obj){
               find("#fktsj").val("'.$data['faktur'].'") ;
               find("#customer").sval('.json_encode($customer).');
               bos.trpenjualankasir.loadmodelsj("hide");
            }

         ') ;
            //loadgrid detail PO
            $vare = array();
            $dbd = $this->trpenjualankasir_m->getdatadetailsj($fktsj) ;
            $n = 0 ;
            while( $dbr = $this->trpenjualankasir_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $dbr['stock'];
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trpenjualankasir.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trpenjualankasir_grid2"].add('.$vare.');
                bos.trpenjualankasir.initdetail();
                bos.trpenjualankasir.hitungsubtotal();
            ');
        }
    }

    public function loadgrid4(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trpenjualankasir_m->loadgrid4($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trpenjualankasir_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trpenjualankasir.cmdpilihsj(\''.$dbr['faktur'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
}
?>
