<?php
class Trreturpenjualan extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('tr/trreturpenjualan_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trreturpenjualan_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trreturpenjualan',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trreturpenjualan_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trreturpenjualan_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trreturpenjualan.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trreturpenjualan.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssreturpenjualan_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssreturpenjualan_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trreturpenjualan_m->saving($kode, $va) ;
        echo(' bos.trreturpenjualan.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trreturpenjualan_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssreturpenjualan_faktur", $faktur) ;
            $gudang[]   = array("id"=>$data['gudang'],"text"=>$data['ketgudang']);
            $customer[] = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            echo('
            w2ui["bos-form-trreturpenjualan_grid2"].clear();
            with(bos.trreturpenjualan.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#gudang").sval('.json_encode($gudang).');
               find("#customer").sval('.json_encode($customer).');
               find("#subtotal").val("'.string_2s($data['subtotal']).'") ;
               find("#total").val("'.string_2s($data['total']).'") ;
            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trreturpenjualan_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trreturpenjualan_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trreturpenjualan.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trreturpenjualan_grid2"].add('.$vare.');
                bos.trreturpenjualan.initdetail();
                bos.trreturpenjualan.settab(1) ;
            ');
        }
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trreturpenjualan_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trreturpenjualan.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").focus() ;
               find("#satuan").val("'.$data['satuan'].'");
               bos.trreturpenjualan.loadmodelstock("hide");
            }

         ') ;
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trreturpenjualan_m->deleting($va['faktur']) ;
        echo('bos.trreturpenjualan.grid1_reloaddata() ; ') ;

    }

    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->trreturpenjualan_m->seekgudang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trreturpenjualan_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seekcustomer(){
        $search     = $this->input->get('q');
        $vdb    = $this->trreturpenjualan_m->seekcustomer($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trreturpenjualan_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trreturpenjualan_m->getfaktur(FALSE) ;

        echo('
        bos.trreturpenjualan.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trreturpenjualan_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trreturpenjualan_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trreturpenjualan.cmdpilih(\''.$dbr['kode'].'\')"
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
      $dbData  = $this->trreturpenjualan_m->getDataStock($cKode) ;
      if($dbRow = $this->trreturpenjualan_m->getrow($dbData)){
        $cKeterangan = $dbRow['Keterangan'];
        $cSatuan     = $dbRow['Satuan'];
        echo('
          bos.trreturpenjualan.obj.find("#satuan").val("'.$cSatuan.'") ;
          bos.trreturpenjualan.obj.find("#namastock").val("'.$cKeterangan.'") ;
        ');
      }else {
        echo('
          bos.trreturpenjualan.obj.find("#stock").val("") ;
          bos.trreturpenjualan.obj.find("#nomor").focus() ;
          alert("Data Tidak Ditemukan!!");
        ');
      }
    }
}
?>
