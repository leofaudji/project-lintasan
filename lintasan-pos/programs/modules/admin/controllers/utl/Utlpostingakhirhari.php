<?php
class Utlpostingakhirhari extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("func/updtransaksi_m") ;
        $this->load->model("utl/utlpostingakhirhari_m") ;
        $this->bdb 	= $this->utlpostingakhirhari_m ;
    } 

    public function index(){
        $this->load->view("utl/utlpostingakhirhari") ; 

    }

    public function seekcabang(){
        $search     = $this->input->get('q');
        $vdb    = $this->utlpostingakhirhari_m->seekcabang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->utlpostingakhirhari_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function posting(){
        $va 	= $this->input->post() ;
        $tglawal = $va['tgl'];
        $tglakhir = $va['tgl'];
        if(date_2s($va['tgl']) >= '2018-10-01'){
            $this->updtransaksi_m->postingharian($tglawal,$tglakhir,$va['cabang']);
            echo('alert("Data Sudah diposting...");') ;
        }else{
            echo('alert("Posting gagal, tgl harus diatas tgl 30-09-2018 ...");') ;

        }
    }
}
?>

