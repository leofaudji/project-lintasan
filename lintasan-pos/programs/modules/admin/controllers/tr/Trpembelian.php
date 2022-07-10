<?php
class Trpembelian extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('tr/trpembelian_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trpembelian_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trpembelian',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trpembelian_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trpembelian_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trpembelian.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trpembelian.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "sspembelian_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "sspembelian_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trpembelian_m->saving($kode, $va) ;
        echo(' bos.trpembelian.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trpembelian_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "sspembelian_faktur", $faktur) ;
            $gudang[]   = array("id"=>$data['gudang'],"text"=>$data['ketgudang']);
            $supplier[] = array("id"=>$data['supplier'],"text"=>$data['namasupplier']);
            echo('
            w2ui["bos-form-trpembelian_grid2"].clear();
            with(bos.trpembelian.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#fktpo").val("'.$data['fktpo'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#gudang").sval('.json_encode($gudang).');
               find("#supplier").sval('.json_encode($supplier).');
               find("#persppn").val("'.string_2s($data['persppn']).'") ;
               find("#subtotal").val("'.string_2s($data['subtotal']).'") ;
               find("#diskontotal").val("'.string_2s($data['diskon']).'") ;
               find("#pembulatantotal").val("'.string_2s($data['pembulatan']).'") ;
               find("#ppntotal").val("'.string_2s($data['ppn']).'") ;
               find("#total").val("'.string_2s($data['total']).'") ;
            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trpembelian_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trpembelian_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trpembelian.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trpembelian_grid2"].add('.$vare.');
                bos.trpembelian.initdetail();
                bos.trpembelian.settab(1) ;
            ');
        }
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trpembelian_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trpembelian.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").focus() ;
               find("#satuan").val("'.$data['satuan'].'");
               find("#barcode").val("'.$data['barcode'].'");
               bos.trpembelian.loadmodelstock("hide");
            }

         ') ;
        }
    }
    
    public function seekstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        $data = $this->trpembelian_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trpembelian.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").focus() ;
               find("#satuan").val("'.$data['satuan'].'");
               find("#barcode").val("'.$data['barcode'].'");
            }

         ') ;
        }
    }
    
    public function pilihpo(){
        $va 	= $this->input->post() ;
        $fktpo 	= $va['fktpo'] ;
        $data = $this->trpembelian_m->getdatapo($fktpo) ;
        if(!empty($data)){
            $gudang[]   = array("id"=>$data['gudang'],"text"=>$data['ketgudang']);
            $supplier[]   = array("id"=>$data['supplier'],"text"=>$data['namasupplier']);
            echo('
            with(bos.trpembelian.obj){
               find("#fktpo").val("'.$data['faktur'].'") ;
               find("#gudang").sval('.json_encode($gudang).');
               find("#supplier").sval('.json_encode($supplier).');
               bos.trpembelian.loadmodelpo("hide");
            }

         ') ;
            //loadgrid detail PO
            $vare = array();
            $dbd = $this->trpembelian_m->getdatadetailpo($fktpo) ;
            $n = 0 ;
            while( $dbr = $this->trpembelian_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trpembelian.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trpembelian_grid2"].add('.$vare.');
                bos.trpembelian.initdetail();
                bos.trpembelian.hitungsubtotal();
            ');
        }
    }

    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trpembelian_m->deleting($va['faktur']) ;
        echo('bos.trpembelian.grid1_reloaddata() ; ') ;

    }

    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpembelian_m->seekgudang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpembelian_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seeksupplier(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpembelian_m->seeksupplier($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpembelian_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trpembelian_m->getfaktur(FALSE) ;

        echo('
        bos.trpembelian.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trpembelian_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trpembelian_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trpembelian.cmdpilih(\''.$dbr['kode'].'\')"
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
      $dbData  = $this->trpembelian_m->getDataStock($cKode) ;
      if($dbRow = $this->trpembelian_m->getrow($dbData)){
        $cKeterangan = $dbRow['Keterangan'];
        $cSatuan     = $dbRow['Satuan'];
        echo('
          bos.trpembelian.obj.find("#satuan").val("'.$cSatuan.'") ;
          bos.trpembelian.obj.find("#namastock").val("'.$cKeterangan.'") ;
        ');
      }else {
        echo('
          bos.trpembelian.obj.find("#stock").val("") ;
          bos.trpembelian.obj.find("#nomor").focus() ;
          alert("Data Tidak Ditemukan!!");
        ');
      }
    }

    public function loadgrid4(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trpembelian_m->loadgrid4($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trpembelian_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trpembelian.cmdpilihpo(\''.$dbr['faktur'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
}
?>
