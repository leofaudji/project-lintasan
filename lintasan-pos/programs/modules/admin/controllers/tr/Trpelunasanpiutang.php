<?php
class Trpelunasanpiutang extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->model('tr/trpelunasanpiutang_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trpelunasanpiutang_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trpelunasanpiutang',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trpelunasanpiutang_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trpelunasanpiutang_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trpelunasanpiutang.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trpelunasanpiutang.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "sspelunasanpiutang_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "sspelunasanpiutang_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trpelunasanpiutang_m->saving($kode, $va) ;
        echo(' bos.trpelunasanpiutang.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trpelunasanpiutang_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "sspelunasanpiutang_faktur", $faktur) ;
            $customer[]   = array("id"=>$data['customer'],"text"=>$data['namacustomer']);
            $bankkas[] = array("id"=>$data['rekkasbank'],"text"=>$data['ketrekkasbank']);
            $kdtruangmuka[] = array("id"=>$data['kdtruangmuka'],"text"=>"[".$data['dktruangmuka']."] ".$data['ketuangmuka']);
            echo('
            w2ui["bos-form-trpelunasanpiutang_grid2"].clear();
            with(bos.trpelunasanpiutang.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#bankkas").sval('.json_encode($bankkas).');
               find("#customer").sval('.json_encode($customer).');
               find("#penjualan").val("'.string_2s($data['penjualan']).'") ;
               find("#retur").val("'.string_2s($data['retur']).'") ;
               find("#subtotal").val("'.string_2s($data['subtotal']).'") ;
               find("#tfkas").val("'.string_2s($data['kasbank']).'") ;
               find("#diskon").val("'.string_2s($data['diskon']).'") ;
               find("#pembulatan").val("'.string_2s($data['pembulatan']).'") ;
               find("#kdtruangmuka").sval('.json_encode($kdtruangmuka).');
               find("#uangmuka").val("'.string_2s($data['uangmuka']).'") ;

            }


         ') ;

            echo('

                bos.trpelunasanpiutang.settab(1) ;
            ');
        }
    }

    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trpelunasanpiutang_m->deleting($va['faktur']) ;
        echo('bos.trpelunasanpiutang.grid1_reloaddata() ; ') ;

    }

    public function seekgudang(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpelunasanpiutang_m->seeksupplier($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpelunasanpiutang_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seekcustomer(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpelunasanpiutang_m->seekcustomer($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpelunasanpiutang_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seekbankkas(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpelunasanpiutang_m->seekbankkas($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpelunasanpiutang_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function seekkodetransaksi(){
        $search     = $this->input->get('q');
        $vdb    = $this->trpelunasanpiutang_m->seekkodetransaksi($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trpelunasanpiutang_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>"[".$dbr['dk']."] ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $faktur  = $this->trpelunasanpiutang_m->getfaktur(FALSE) ;

        echo('
        bos.trpelunasanpiutang.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }
    public function loadgrid2(){
        $va 	= $this->input->post() ;
        $va['tgl']= date_2s($va['tgl']);
        $vdb    = $this->trpelunasanpiutang_m->loadpiutangpenjualan($va) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        $n = 0 ;
        $recid = 0 ;
        $vare[] 	= array("recid"=>$recid,"no"=>"","faktur"=>":: Penjualan","tgl"=>"","total"=>"","sisaawal"=>"",
                                "pelunasan"=>"","sisa"=>"") ;
        while( $dbr = $this->trpelunasanpiutang_m->getrow($dbd) ){
            $n++;
            $recid++;
            $sisa = $dbr['saldo'];
            $pelunasan = $dbr['pelunasan'];
            $sisaawal = $pelunasan + $sisa;
            $vare[] 	= array("recid"=>$recid,"no"=>$n,"faktur"=>$dbr['faktur'],"tgl"=>date_2d($dbr['tgl']),"total"=>string_2s($dbr['total']),
                                "sisaawal"=>string_2s($sisaawal),
                                "pelunasan"=>string_2s($pelunasan),"sisa"=>string_2s($sisa),"jenis"=>"Penjualan") ;
        }
        
        $vdb2    = $this->trpelunasanpiutang_m->loadpiutangreturpenjualan($va) ;
        $dbd2    = $vdb2['db'] ;
        $n = 0 ;
        $recid++;
        $vare[] 	= array("recid"=>$recid,"no"=>"","faktur"=>":: Retur Penjualan","tgl"=>"","total"=>"","sisaawal"=>"",
                                "pelunasan"=>"","sisa"=>"") ;
        while( $dbr = $this->trpelunasanpiutang_m->getrow($dbd2) ){
            $n++;
            $recid++;
            $sisa = $dbr['saldo'];
             $pelunasan = $dbr['pelunasan'];
            $sisaawal = $pelunasan + $sisa;
            $vare[] 	= array("recid"=>$recid,"no"=>$n,"faktur"=>$dbr['faktur'],"tgl"=>date_2d($dbr['tgl']),
                                "total"=>string_2s($dbr['total']),"sisaawal"=>string_2s($sisaawal),
                                "pelunasan"=>string_2s($pelunasan),"sisa"=>string_2s($sisa),"jenis"=>"Retur Penjualan") ;
        }

        $vare = json_encode($vare);

        echo('
                w2ui["bos-form-trpelunasanpiutang_grid2"].add('.$vare.');
              ');

    }
}
?>
