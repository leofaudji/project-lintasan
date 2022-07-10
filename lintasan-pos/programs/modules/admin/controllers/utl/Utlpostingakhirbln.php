<?php
class Utlpostingakhirbln extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("func/perhitungan_m") ;
        $this->load->model("func/updtransaksi_m") ;
        $this->load->model("utl/utlpostingakhirbln_m") ;
        $this->bdb 	= $this->utlpostingakhirbln_m ;
    } 

    public function index(){
        $this->load->view("utl/utlpostingakhirbln") ; 

    }   

    public function loadgrid(){
        $vare = array();
        $n = 0 ;
        $vare[] = array("ck"=>1,"no"=>++$n,"kode"=>'A',"keterangan"=>"Penyusutan Aset Inventaris");
        $vare 	= array("total"=>count($vare), "records"=>$vare ) ;
        echo(json_encode($vare)) ; 
    }
    
    public function seekcabang(){
        $search     = $this->input->get('q');
        $vdb    = $this->utlpostingakhirbln_m->seekcabang($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->utlpostingakhirbln_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function posting(){
        $va 	= $this->input->post() ;
        $vaGrid = json_decode($va['grid1']);

        // $this->utlpostingakhirbln_m->postingpenyaset($va['periode'],$va['cabang']);

        foreach($vaGrid as $key => $val){
            if($val->ck){
                if($val->kode == "A")$this->utlpostingakhirbln_m->postingpenyaset($va['periode'],$va['cabang']);
            }
        }
        //$this->bdb->posting($va) ;
        echo('alert("Data Sudah diposting...");') ;
    }
}
?>

