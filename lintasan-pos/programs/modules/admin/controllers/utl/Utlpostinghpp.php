<?php
class Utlpostinghpp extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("func/perhitungan_m") ;
        $this->load->model("func/updtransaksi_m") ;
        $this->load->model("utl/utlpostinghpp_m") ;
        $this->bdb 	= $this->utlpostinghpp_m ;
    } 

    public function index(){
        $this->load->view("utl/utlpostinghpp") ; 

    }

    public function loadgrid2(){
        $va     = json_decode($this->input->post('request'), true) ;
        $cfghpp = $this->perhitungan_m->getcfghpp($va['tgl']);
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $n = 0;
        $arr = array();
        $arrgol = array();
        while( $dbr = $this->bdb->getrow($dbd)){
            $n++;
            $vs = $dbr;
            //$vs['no'] = $n;
            //$vare[]		= $vs ; 
            $arr[$dbr['stock_group']][$dbr['kode']] = array("kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],
                                                            "satuan"=>$dbr['satuan']);

        }
        $ngol = 0 ;
        foreach($arr as $key => $arr2){
            $group = $this->utlpostinghpp_m->getval("keterangan,rekpersd", "kode = '$key'","stock_group");
            $ketrekpersd = $this->utlpostinghpp_m->getval("keterangan", "kode = '{$group['rekpersd']}'","keuangan_rekening");

            $n = 0 ;
            $jmlqty = 0 ;
            $jmlsaldo = 0 ;
            foreach($arr2 as $key2 => $arr3){
                $n++;

                //$saldostock = 
                $qty= $this->perhitungan_m->GetSaldoAkhirStock($arr3['kode'],$va['tgl'],'',$va['cabang']);
                $arrhp= $this->perhitungan_m->gethpstock($arr3['kode'],$va['tgl'],$va['tgl'],$qty,$qty,$va['cabang'],
                                                         $cfghpp['caraperhitungan'],$cfghpp['periode']);
                $jmlqty += $qty;
                $jmlsaldo += $arrhp['hptot'];
            }

            //array golongan
            $ngol++;
            $saldoneraca = $this->perhitungan_m->getsaldo($va['tgl'],$group['rekpersd']);
            $selisih = $saldoneraca - $jmlsaldo;
            $detail    = '<button type="button" onClick="bos.utlpostinghpp.cmddetailgol(\''.$key.'\',\''.$va['tgl'].'\',\''.$va['cabang'].'\')"
                                     class="btn btn-success btn-grid">Detail</button>' ;
            $detail    = html_entity_decode($detail) ;
            $arrgol[] = array("no"=>$ngol,"golongan"=>$key,"keterangan"=>$group['keterangan'],"rekening"=>$group['rekpersd'],"ketrek"=>$ketrekpersd,"saldoneraca"=>$saldoneraca,
                              "saldostock"=>$jmlsaldo,"selisih"=>$selisih,"cmddetail"=>$detail);
        }

        $arrgol 	= array("total"=>count($arrgol), "records"=>$arrgol ) ;
        echo(json_encode($arrgol)) ;
    }

    public function seekcabang(){
        $search     = $this->input->get('q');
        $vdb    = $this->utlpostinghpp_m->seekcabang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->utlpostinghpp_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function posting(){
        $va 	= $this->input->post() ;

        $this->utlpostinghpp_m->postinghpp($va);

        echo('alert("Data Sudah diposting...");') ;
    }

    public function detailhppgol(){
        $va    = $this->input->post() ;
        $vare = array();
        echo('w2ui["bos-form-utlpostinghpp_grid1"].clear();');
        $data = $this->utlpostinghpp_m->getval("keterangan,kode", "kode = '{$va['kode']}'","stock_group");
        if(!empty($data)){
            echo('
                  with(bos.utlpostinghpp.obj){
                     find("#golongan").val("'.$va['kode'].' - '.$data['keterangan'].'") ;
                  }

              ') ;

            $vdb    = $this->bdb->loadgridgol($va) ;
            $dbd    = $vdb['db'] ;
            $n = 0;
            $arr = array();
            $arrgol = array();
            $totsaldohp = 0 ;
            while( $dbr = $this->bdb->getrow($dbd)){
                $n++;
                $detail    = '<button type="button" onClick="bos.utlpostinghpp.cmddetail(\''.$dbr['kode'].'\',\''.$va['tgl'].'\',\''.$va['cabang'].'\')"
                                     class="btn btn-success btn-grid">Detail</button>' ;
                $detail    = html_entity_decode($detail) ;
                $arrhp = $this->perhitungan_m->getdetailsaldostock($dbr['kode'],$va['tgl'],$va['cabang']);
                $arr[] = array("recid"=>$n,"no"=>$n,"kode"=>$dbr['kode'],"keterangan"=>$dbr['keterangan'],
                                                            "satuan"=>$dbr['satuan'],"qty"=>$arrhp['qtytot'],"saldo"=>$arrhp['hptot'],"cmddetail"=>$detail);
                $totsaldohp += $arrhp['hptot'];

            }
            $arr[] = array("recid"=>"ZZZZ","no" => '', "kode"=> '',"keterangan"=> 'Jumlah',"qty"=> "","saldo"=>$totsaldohp,"w2ui"=>array("summary"=>true));
            $arr = json_encode($arr);
         echo('
            bos.utlpostinghpp.loadmodalpreviewgol("show") ;
            bos.utlpostinghpp.grid1_reloaddata();
            w2ui["bos-form-utlpostinghpp_grid1"].add('.$arr.');
         ');
        }


    }

    public function detailhpp(){
        $va    = $this->input->post() ;
        echo('w2ui["bos-form-utlpostinghpp_grid3"].clear();');
        $data = $this->utlpostinghpp_m->getval("keterangan,satuan", "kode = '{$va['kode']}'","stock");
        if(!empty($data)){
            echo('
                  with(bos.utlpostinghpp.obj){
                     find("#kode").val("'.$va['kode'].'") ;
                     find("#keterangan").val("'.$data['keterangan'].'") ;
                     find("#satuan").val("'.$data['satuan'].'") ;
                  }

              ') ;

            $vare = array();

            $arrhp = $this->perhitungan_m->getdetailsaldostock($va['kode'],$va['tgl'],$va['cabang']);
            $n = 0 ;
            $totqty = 0 ;
            $totjml = 0 ;
            foreach($arrhp['detailhp'] as $key => $val){
                $n++;
                $jml = $val['qty'] * $val['hp'];
                $arr = array("recid"=>$n,"no"=>$n,"faktur"=>$val['faktur'],"qty"=>$val['qty'],"hp"=>$val['hp'],"jml"=>$jml);
                $vare[] = $arr ;
                $totqty += $val['qty'];
                $totjml += $jml;
            }
            $vare[] = array("recid"=>"ZZZZ","no" => '', "faktur"=> 'Jumlah',"qty"=> $totqty,"hp"=>"", "jml"=> $totjml,"w2ui"=>array("summary"=>true));

            $vare = json_encode($vare);
            echo('
            bos.utlpostinghpp.loadmodalpreview("show") ;
            bos.utlpostinghpp.grid3_reloaddata();
            w2ui["bos-form-utlpostinghpp_grid3"].add('.$vare.');
         ');
        }
    }
}
?>

