<?php
class Mstgroupstock extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
		parent::__construct() ;
      $this->load->model('mst/mstgroupstock_m') ;
      $this->load->helper('bdate') ;
	}

   public function index(){
      $this->load->view('mst/mstgroupstock') ;
   }

   public function loadgrid(){
      $va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $vdb    = $this->mstgroupstock_m->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->mstgroupstock_m->getrow($dbd) ){
         $vaset   = $dbr ;
         $vaset['cmdedit']    = '<button type="button" onClick="bos.mstgroupstock.cmdedit(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Edit</button>' ;
         $vaset['cmddelete']  = '<button type="button" onClick="bos.mstgroupstock.cmddelete(\''.$dbr['kode'].'\')"
                           class="btn btn-danger btn-grid">Delete</button>' ;
         $vaset['cmdedit']	   = html_entity_decode($vaset['cmdedit']) ;
         $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

         $vare[]		= $vaset ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
   }

   public function init(){
      savesession($this, "ssgroupstock_kode", "") ;
   }

   public function saving(){
      $va 	= $this->input->post() ;
      $kode 	= getsession($this, "ssgroupstock_kode") ;
      $this->mstgroupstock_m->saving($kode, $va) ;
      echo(' bos.mstgroupstock.init() ; 
             bos.mstgroupstock.settab(0) ; ') ;
   }

   public function editing(){
      $va 	= $this->input->post() ;
      $kode 	= $va['kode'] ;
      $data = $this->mstgroupstock_m->getdata($kode) ;
      if(!empty($data)){
         savesession($this, "ssgroupstock_kode", $kode) ;
         $rekpersd[] = array("id"=>$data['rekpersd'],"text"=>$data['rekpersd'] ." - ". $this->mstgroupstock_m->getval("keterangan", "kode = '{$data['rekpersd']}'", "keuangan_rekening"));
         $rekpj[] = array("id"=>$data['rekpj'],"text"=>$data['rekpj'] ." - ". $this->mstgroupstock_m->getval("keterangan", "kode = '{$data['rekpj']}'", "keuangan_rekening"));
         $rekhpp[] = array("id"=>$data['rekhpp'],"text"=>$data['rekhpp'] ." - ". $this->mstgroupstock_m->getval("keterangan", "kode = '{$data['rekhpp']}'", "keuangan_rekening"));
         echo('
            with(bos.mstgroupstock.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#kode").val("'.$data['kode'].'") ;
               find("#rekpersd").sval('.json_encode($rekpersd).') ;
               find("#rekhpp").sval('.json_encode($rekhpp).') ;
               find("#rekpj").sval('.json_encode($rekpj).') ;
               find("#keterangan").val("'.$data['keterangan'].'").focus() ;
            }
            bos.mstgroupstock.settab(1) ;
         ') ;
      }
   }

   public function deleting(){
      $va 	= $this->input->post() ;
      $this->mstgroupstock_m->deleting($va['kode']) ;
      echo(' bos.mstgroupstock.grid1_reloaddata() ; ') ;
   }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->mstgroupstock_m->seekrekbypeny($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->mstgroupstock_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ". $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

}
?>
