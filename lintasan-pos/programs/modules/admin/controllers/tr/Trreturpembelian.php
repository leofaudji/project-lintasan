<?php
class Trreturpembelian extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('tr/trreturpembelian_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trreturpembelian_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trreturpembelian',$d) ;
    }

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $va['tglawal'] = date_2s($va['tglawal']);
        $va['tglakhir'] = date_2s($va['tglakhir']);
        $vdb    = $this->trreturpembelian_m->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trreturpembelian_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['tgl'] = date_2d($vaset['tgl']);
            $vaset['cmdedit']    = '<button type="button" onClick="bos.trreturpembelian.cmdedit(\''.$dbr['faktur'].'\')"
                           class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']  = '<button type="button" onClick="bos.trreturpembelian.cmddelete(\''.$dbr['faktur'].'\')"
                           class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']	   = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssreturpembelian_faktur", "") ;
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $kode 	= getsession($this, "ssreturpembelian_faktur") ;
        $va['tgl']        = date_2s($va['tgl']) ;
        $this->trreturpembelian_m->saving($kode, $va) ;
        echo(' bos.trreturpembelian.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data = $this->trreturpembelian_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssreturpembelian_faktur", $faktur) ;
            $gudang[] = array("id"=>$data['gudang'],"text"=>$data['ketgudang']);
            $supplier[] = array("id"=>$data['supplier'],"text"=>$data['namasupplier']);
            echo('
            w2ui["bos-form-trreturpembelian_grid2"].clear();
            with(bos.trreturpembelian.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#gudang").sval('.json_encode($gudang).');
               find("#supplier").sval('.json_encode($supplier).');
               find("#subtotal").val("'.$data['subtotal'].'") ;
               find("#total").val("'.$data['total'].'") ;
            }

         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trreturpembelian_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trreturpembelian_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete']  = '<button type="button" onClick="bos.trreturpembelian.grid2_deleterow('.$n.')"
                           class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

                $vare[]		= $vaset ;
            }
            $vare = json_encode($vare);
            echo('
            w2ui["bos-form-trreturpembelian_grid2"].add('.$vare.');
             bos.trreturpembelian.initdetail();
             bos.trreturpembelian.settab(1) ;
          ');
        }
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trreturpembelian_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trreturpembelian.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").focus() ;
               find("#satuan").val("'.$data['satuan'].'");
               bos.trreturpembelian.loadmodelstock("hide");
            }

         ') ;
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trreturpembelian_m->deleting($va['faktur']) ;
        echo('bos.trreturpembelian.grid1_reloaddata() ; ') ;
    }

    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->trreturpembelian_m->seekgudang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trreturpembelian_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seeksupplier(){
        $search     = $this->input->get('q');
        $vdb    = $this->trreturpembelian_m->seeksupplier($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trreturpembelian_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trreturpembelian_m->getfaktur(FALSE) ;

        echo('
        bos.trreturpembelian.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trreturpembelian_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trreturpembelian_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trreturpembelian.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function getDataStock(){
      $va       = $this->input->post();
      $cKode    = $va['cKodeStock'];
      $dbData   = $this->trreturpembelian_m->getDataStock($cKode) ;
      if($dbRow = $this->trreturpembelian_m->getrow($dbData)){
        $cKeterangan = $dbRow['Keterangan'];
        $cSatuan     = $dbRow['Satuan'];
        echo('
          bos.trreturpembelian.obj.find("#satuan").val("'.$cSatuan.'") ;
          bos.trreturpembelian.obj.find("#namastock").val("'.$cKeterangan.'") ;
          bos.trreturpembelian.obj.find("#barcode").val("'.$dbRow['barcode'].'") ;
        ');
      }else {
        echo('
          bos.trreturpembelian.obj.find("#stock").val("") ;
          bos.trreturpembelian.obj.find("#barcode").val("") ;
          bos.trreturpembelian.obj.find("#namastock").val("") ;
          bos.trreturpembelian.obj.find("#nomor").focus() ;
          alert("Data Tidak Ditemukan!!");
        ');
      }
    }
}
?>
