<?php
class Treditpenjualan extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('tr/treditpenjualan_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->treditpenjualan_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/treditpenjualan',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->treditpenjualan_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->treditpenjualan_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.treditpenjualan.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            /*$vaset['cmddelete']     = '<button type="button" onClick="bos.treditpenjualan.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;*/
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            //$vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "sseditpenjualan_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "sseditpenjualan_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->treditpenjualan_m->saving($kode, $va) ;
        echo(' bos.treditpenjualan.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->treditpenjualan_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "sseditpenjualan_faktur", $faktur) ;
            $customer[] = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            echo('
            w2ui["bos-form-treditpenjualan_grid2"].clear();
            with(bos.treditpenjualan.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#customer").sval('.json_encode($customer).');
               find("#subtotal").val("'.string_2s($data['subtotal']).'") ;
               find("#total").val("'.string_2s($data['total']).'") ;
               find("#diskonnom").val("'.string_2s($data['diskon']).'") ;
               find("#persppn").val("'.string_2s($data['persppn']).'") ;
               find("#ppn").val("'.string_2s($data['ppn']).'") ;
               find("#bayar").val("'.string_2s($data['kas']).'") ;
               find("#fktsj").val("'.$data['sj'].'");
            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->treditpenjualan_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->treditpenjualan_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $dbr['stock'];
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.treditpenjualan.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-treditpenjualan_grid2"].add('.$vare.');
                bos.treditpenjualan.initdetail();
                bos.treditpenjualan.settab(1) ;
                bos.treditpenjualan.hitungkembalian() ;
            ');
        }
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->treditpenjualan_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.treditpenjualan.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#qty").focus() ;
               find("#diskon").val("'.string_2s($data['diskon']).'");
               find("#satuan").val("'.$data['satuan'].'");
               bos.treditpenjualan.loadmodelstock("hide");
               bos.treditpenjualan.hitungjumlah();
            }

         ') ;
        }
    }
    
    public function seekstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        $data = $this->treditpenjualan_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.treditpenjualan.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.$data['hargajual'].'");
               find("#qty").focus() ;
               find("#diskon").val("0");
               find("#satuan").val("'.$data['satuan'].'");
            }
            bos.treditpenjualan.hitungjumlah();
            bos.treditpenjualan.obj.find("#cmdok")[0].click();

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.treditpenjualan.obj){
                    find("#stock").val("") ;
                    find("#stock").focus() ;
                }
            ');
        }
    }

    public function deleting(){
        $va 	= $this->input->post() ;
        $this->treditpenjualan_m->deleting($va['faktur']) ;
        echo('bos.treditpenjualan.grid1_reloaddata() ; ') ;

    }



    public function getfaktur(){
        $faktur  = $this->treditpenjualan_m->getfaktur(FALSE) ;

        echo('
        bos.treditpenjualan.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->treditpenjualan_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->treditpenjualan_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.treditpenjualan.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function seekcustomer(){
        $search     = $this->input->get('q');
        $vdb    = $this->treditpenjualan_m->seekcustomer($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->treditpenjualan_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function pilihsj(){
        $va 	= $this->input->post() ;
        $fktsj 	= $va['fktsj'] ;
        $data = $this->treditpenjualan_m->getdatasj($fktsj) ;
        if(!empty($data)){
            $customer[]   = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            echo('
            with(bos.treditpenjualan.obj){
               find("#fktsj").val("'.$data['faktur'].'") ;
               find("#customer").sval('.json_encode($customer).');
               bos.treditpenjualan.loadmodelsj("hide");
            }

         ') ;
            //loadgrid detail PO
            $vare = array();
            $dbd = $this->treditpenjualan_m->getdatadetailsj($fktsj) ;
            $n = 0 ;
            while( $dbr = $this->treditpenjualan_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $dbr['stock'];
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.treditpenjualan.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-treditpenjualan_grid2"].add('.$vare.');
                bos.treditpenjualan.initdetail();
                bos.treditpenjualan.hitungsubtotal();
            ');
        }
    }

    public function loadgrid4(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->treditpenjualan_m->loadgrid4($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->treditpenjualan_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.treditpenjualan.cmdpilihsj(\''.$dbr['faktur'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
}
?>
