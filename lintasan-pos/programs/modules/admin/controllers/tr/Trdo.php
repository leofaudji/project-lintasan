<?php
class Trdo extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trdo_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trdo_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trdo',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trdo_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trdo_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trdo.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trdo.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssdo_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssdo_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trdo_m->saving($kode, $va) ;
        echo(' bos.trdo.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trdo_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssdo_faktur", $faktur) ;
            $customer[] = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            echo('
            w2ui["bos-form-trdo_grid2"].clear();
            with(bos.trdo.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#customer").sval('.json_encode($customer).');
            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trdo_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trdo_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trdo.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trdo_grid2"].add('.$vare.');
                bos.trdo.initdetail();
                bos.trdo.settab(1) ;
            ');
        }
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trdo_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trdo.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#satuan").val("'.$data['satuan'].'");
               bos.trdo.loadmodelstock("hide");
            }

         ') ;
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trdo_m->deleting($va['faktur']) ;
        echo('bos.trdo.grid1_reloaddata() ; ') ;

    }

    public function seekcustomer(){
        $search     = $this->input->get('q');
        $vdb    = $this->trdo_m->seekcustomer($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trdo_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trdo_m->getfaktur(FALSE) ;

        echo('
        bos.trdo.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trdo_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trdo_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trdo.cmdpilih(\''.$dbr['kode'].'\')"
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
      $dbData  = $this->trdo_m->getDataStock($cKode) ;
      if($dbRow = $this->trdo_m->getrow($dbData)){
        $cKeterangan = $dbRow['Keterangan'];
        $cSatuan     = $dbRow['Satuan'];
        echo('
          bos.trdo.obj.find("#satuan").val("'.$cSatuan.'") ;
          bos.trdo.obj.find("#namastock").val("'.$cKeterangan.'") ;
        ');
      }else {
        echo('
          bos.trdo.obj.find("#stock").val("") ;
          bos.trdo.obj.find("#nomor").focus() ;
          alert("Data Tidak Ditemukan!!");
        ');
      }
    }
}
?>
