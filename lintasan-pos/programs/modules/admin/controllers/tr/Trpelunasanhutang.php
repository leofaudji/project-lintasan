<?php
class Trpelunasanhutang extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('tr/trpelunasanhutang_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trpelunasanhutang_m ;
    }
 
    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trpelunasanhutang',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trpelunasanhutang_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trpelunasanhutang_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trpelunasanhutang.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trpelunasanhutang.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "sspelunasanhutang_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "sspelunasanhutang_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trpelunasanhutang_m->saving($kode, $va) ;
        echo(' bos.trpelunasanhutang.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trpelunasanhutang_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "sspelunasanhutang_faktur", $faktur) ;
            $supplier[]   = array("id"=>$data['supplier'],"text"=>$data['namasupplier']);
            $bankkas[] = array("id"=>$data['rekkasbank'],"text"=>$data['ketrekkasbank']);
            $kdtrpersekot[] = array("id"=>$data['kdtrpersekot'],"text"=>"[".$data['dktrpersekot']."] ".$data['ketpersekot']);
            echo('
            w2ui["bos-form-trpelunasanhutang_grid2"].clear();
            with(bos.trpelunasanhutang.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#bankkas").sval('.json_encode($bankkas).');
               find("#supplier").sval('.json_encode($supplier).');
               find("#kdtrpskt").sval('.json_encode($kdtrpersekot).');
               find("#pembelian").val("'.string_2s($data['pembelian']).'") ;
               find("#retur").val("'.string_2s($data['retur']).'") ;
               find("#subtotal").val("'.string_2s($data['subtotal']).'") ;
               find("#tfkas").val("'.string_2s($data['kasbank']).'") ;
               find("#diskon").val("'.string_2s($data['diskon']).'") ;
               find("#pembulatan").val("'.string_2s($data['pembulatan']).'") ;
               find("#persekot").val("'.string_2s($data['persekot']).'") ;

            }


         ') ;

          /*  //loadgrid detail
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
            w2ui["bos-form-trpembelian_grid2"].add('.$vare.');
                bos.trpembelian.initdetail();*/

            echo('

                bos.trpelunasanhutang.settab(1) ;
            ');
        }
    }

    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trpelunasanhutang_m->deleting($va['faktur']) ;
        echo('bos.trpelunasanhutang.grid1_reloaddata() ; ') ;

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
        $vdb    = $this->trpelunasanhutang_m->seeksupplier($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpelunasanhutang_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seekbankkas(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpelunasanhutang_m->seekbankkas($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpelunasanhutang_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function seekkodetransaksi(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpelunasanhutang_m->seekkodetransaksi($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpelunasanhutang_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>"[".$dbr['dk']."] ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trpelunasanhutang_m->getfaktur(FALSE) ;

        echo('
        bos.trpelunasanhutang.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
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

    public function loadgrid2(){
        $va 	= $this->input->post() ;
        $va['tgl']= date_2s($va['tgl']);
        $vdb    = $this->trpelunasanhutang_m->loadhutpembelian($va) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        $n = 0 ;
        $recid = 0 ;
        $vare[] 	= array("recid"=>$recid,"no"=>"","faktur"=>":: Pembelian","tgl"=>"","total"=>"","sisaawal"=>"",
                                "pelunasan"=>"","sisa"=>"") ;
        while( $dbr = $this->trpelunasanhutang_m->getrow($dbd) ){
            $n++;
            $recid++;
            $sisa = $dbr['saldo'];
            $pelunasan = $dbr['pelunasan'];
            $sisaawal = $pelunasan + $sisa;
            $vare[] 	= array("recid"=>$recid,"no"=>$n,"faktur"=>$dbr['faktur'],"tgl"=>date_2d($dbr['tgl']),"total"=>string_2s($dbr['total']),
                                "sisaawal"=>string_2s($sisaawal),
                                "pelunasan"=>string_2s($pelunasan),"sisa"=>string_2s($sisa),"jenis"=>"Pembelian") ;
        }
        
        $vdb2    = $this->trpelunasanhutang_m->loadhutreturpembelian($va) ;
        $dbd2    = $vdb2['db'] ;
        $n = 0 ;
        $recid++;
        $vare[] 	= array("recid"=>$recid,"no"=>"","faktur"=>":: Retur Pembelian","tgl"=>"","total"=>"","sisaawal"=>"",
                                "pelunasan"=>"","sisa"=>"") ;
        while( $dbr = $this->trpelunasanhutang_m->getrow($dbd2) ){
            $n++;
            $recid++;
            $sisa = $dbr['saldo'];
             $pelunasan = $dbr['pelunasan'];
            $sisaawal = $pelunasan + $sisa;
            $vare[] 	= array("recid"=>$recid,"no"=>$n,"faktur"=>$dbr['faktur'],"tgl"=>date_2d($dbr['tgl']),
                                "total"=>string_2s($dbr['total']),"sisaawal"=>string_2s($sisaawal),
                                "pelunasan"=>string_2s($pelunasan),"sisa"=>string_2s($sisa),"jenis"=>"Retur Pembelian") ;
        }

        $vare = json_encode($vare);

        echo('
                w2ui["bos-form-trpelunasanhutang_grid2"].add('.$vare.');
              ');

    }
}
?>
