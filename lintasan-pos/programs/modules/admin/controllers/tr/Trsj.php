<?php
class Trsj extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trsj_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trsj_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trsj',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trsj_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trsj_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trsj.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trsj.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "sssj_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssdo_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;
		if(!isset($va['nopol']))$va['nopol'] = "";

        $this->trsj_m->saving($kode, $va) ;
        echo(' bos.trsj.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trsj_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "sssj_faktur", $faktur) ;
            $customer[] = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            $nopol[] = array("id"=>$data['nopol'],"text"=>$data['nopol'] . " - " .$data['ketarmada']);
            echo('
            w2ui["bos-form-trsj_grid2"].clear();
            with(bos.trsj.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#fktdo").val("'.$data['do'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#customer").sval('.json_encode($customer).');
               find("#petugaspengirim").val("'.$data['petugaspengirim'].'") ;
               find("#nopol").sval('.json_encode($nopol).');
            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trsj_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trsj_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trsj.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trsj_grid2"].add('.$vare.');
                bos.trsj.initdetail();
                bos.trsj.settab(1) ;
            ');
        }
    }

    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trsj_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trsj.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#satuan").val("'.$data['satuan'].'");
               bos.trsj.loadmodelstock("hide");
            }

         ') ;
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trsj_m->deleting($va['faktur']) ;
        echo('bos.trsj.grid1_reloaddata() ; ') ;

    }

    public function seekcustomer(){
        $search     = $this->input->get('q');
        $vdb    = $this->trsj_m->seekcustomer($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trsj_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function seekarmada(){
        $search     = $this->input->get('q');
        $vdb    = $this->trsj_m->seekarmada($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trsj_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . "-" .$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trsj_m->getfaktur(FALSE) ;

        echo('
        bos.trsj.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trsj_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trsj_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trsj.cmdpilih(\''.$dbr['kode'].'\')"
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
      $dbData  = $this->trsj_m->getDataStock($cKode) ;
      if($dbRow = $this->trsj_m->getrow($dbData)){
        $cKeterangan = $dbRow['Keterangan'];
        $cSatuan     = $dbRow['Satuan'];
        echo('
          bos.trsj.obj.find("#satuan").val("'.$cSatuan.'") ;
          bos.trsj.obj.find("#namastock").val("'.$cKeterangan.'") ;
        ');
      }else {
        echo('
          bos.trsj.obj.find("#stock").val("") ;
          bos.trsj.obj.find("#nomor").focus() ;
          alert("Data Tidak Ditemukan!!");
        ');
      }
    }
    
    public function pilihdo(){
        $va 	= $this->input->post() ;
        $fktdo 	= $va['fktdo'] ;
        $data = $this->trsj_m->getdatado($fktdo) ;
        if(!empty($data)){
            $customer[]   = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            echo('
            with(bos.trsj.obj){
               find("#fktdo").val("'.$data['faktur'].'") ;
               find("#customer").sval('.json_encode($customer).');
               bos.trsj.loadmodeldo("hide");
            }

         ') ;
            //loadgrid detail PO
            $vare = array();
            $dbd = $this->trsj_m->getdatadetaildo($fktdo) ;
            $n = 0 ;
            while( $dbr = $this->trsj_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trsj.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;
                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trsj_grid2"].add('.$vare.');
                bos.trsj.initdetail();
                bos.trsj.hitungsubtotal();
            ');
        }
    }
    
    public function loadgrid4(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trsj_m->loadgrid4($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trsj_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trsj.cmdpilihdo(\''.$dbr['faktur'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

}
?>
