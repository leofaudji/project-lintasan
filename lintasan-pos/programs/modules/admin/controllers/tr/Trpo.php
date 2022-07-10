<?php
class Trpo extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trpo_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trpo_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trpo',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trpo_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trpo_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trpo.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trpo.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "sspo_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "sspo_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trpo_m->saving($kode, $va) ;
        echo(' bos.trpo.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trpo_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "sspo_faktur", $faktur) ;
            $gudang[]   = array("id"=>$data['gudang'],"text"=>$data['ketgudang']);
            $supplier[] = array("id"=>$data['supplier'],"text"=>$data['namasupplier']);
            echo('
            w2ui["bos-form-trpo_grid2"].clear();
            with(bos.trpo.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#fktpr").val("'.$data['fktpr'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#gudang").sval('.json_encode($gudang).');
               find("#supplier").sval('.json_encode($supplier).');
               find("#subtotal").val("'.string_2s($data['total']).'") ;
               find("#total").val("'.string_2s($data['total']).'") ;
            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trpo_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trpo_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trpo.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trpo_grid2"].add('.$vare.');
                bos.trpo.initdetail();
                bos.trpo.settab(1) ;
            ');
        }
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trpo_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trpo.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#spesifikasi").focus() ;
               find("#satuan").val("'.$data['satuan'].'");
               bos.trpo.loadmodelstock("hide");
            }

         ') ;
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trpo_m->deleting($va['faktur']) ;
        echo('bos.trpo.grid1_reloaddata() ; ') ;

    }

    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpo_m->seekgudang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpo_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seeksupplier(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpo_m->seeksupplier($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpo_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trpo_m->getfaktur(FALSE) ;

        echo('
        bos.trpo.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trpo_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trpo_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trpo.cmdpilih(\''.$dbr['kode'].'\')"
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
      $dbData  = $this->trpo_m->getDataStock($cKode) ;
      if($dbRow = $this->trpo_m->getrow($dbData)){
        $cKeterangan = $dbRow['Keterangan'];
        $cSatuan     = $dbRow['Satuan'];
        echo('
          bos.trpo.obj.find("#satuan").val("'.$cSatuan.'") ;
          bos.trpo.obj.find("#namastock").val("'.$cKeterangan.'") ;
        ');
      }else {
        echo('
          bos.trpo.obj.find("#stock").val("") ;
          bos.trpo.obj.find("#nomor").focus() ;
          alert("Data Tidak Ditemukan!!");
        ');
      }
    }
    
    public function pilihpr(){
        $va 	= $this->input->post() ;
        $fktpr 	= $va['fktpr'] ;
        $data = $this->trpo_m->getdatapr($fktpr) ;
        if(!empty($data)){
            $gudang[]   = array("id"=>$data['gudang'],"text"=>$data['ketgudang']);
            echo('
            with(bos.trpo.obj){
               find("#fktpr").val("'.$data['faktur'].'") ;
               find("#gudang").sval('.json_encode($gudang).');
               bos.trpo.loadmodelpr("hide");
            }

         ') ;
            //loadgrid detail PR
            $vare = array();
            $dbd = $this->trpo_m->getdatadetailpr($fktpr) ;
            $n = 0 ;
            while( $dbr = $this->trpo_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trpo.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trpo_grid2"].add('.$vare.');
                bos.trpo.initdetail();
                bos.trpo.hitungsubtotal();
            ');
        }
    }
    
    public function loadgrid4(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trpo_m->loadgrid4($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trpo_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trpo.cmdpilihpr(\''.$dbr['faktur'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
}
?>
