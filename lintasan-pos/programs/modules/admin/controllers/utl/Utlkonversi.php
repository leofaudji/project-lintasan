<?php
class Utlkonversi extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("func/perhitungan_m") ;
        $this->load->model("func/updtransaksi_m") ;
        $this->load->model("utl/utlkonversi_m") ;
        $this->bdb 	= $this->utlkonversi_m ;
    } 

    public function index(){
        $this->load->view("utl/utlkonversi") ; 

    }   

    public function loadgrid(){
        $vare = array();
        $n = 0 ;
        $vare[] = array("ck"=>1,"no"=>++$n,"kode"=>'0',"keterangan"=>"Saldo Stock");
        $vare 	= array("total"=>count($vare), "records"=>$vare ) ;
        echo(json_encode($vare)) ; 
    }

    public function posting(){
        $va 	= $this->input->post() ;
        $vaGrid = json_decode($va['grid1']);
        $tgl = '2018-09-30';
        foreach($vaGrid as $key => $val){
            if($val->ck){
                if($val->kode == "0")$this->utlkonversi_m->saldostock($tgl);
            }
        }
        //$this->bdb->posting($va) ;
        echo('alert("Data Sudah diposting...");') ;
    }
}
?>

