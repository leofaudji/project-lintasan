<?php
class Trcetakstrukpenjualan extends Bismillah_Controller{
   private $bdb ;
   public function __construct(){
	  parent::__construct() ;
      $this->load->model('tr/trcetakstrukpenjualan_m') ;
       $this->load->model('func/func_m') ;
       $this->load->model('func/perhitungan_m') ;
      $this->load->helper('bdate');
        $this->load->model('config/config_m') ;
        $this->load->library('escpos');
      //$this->load->helper('print');
      $this->bdb = $this->trcetakstrukpenjualan_m ;
	}

   public function index(){
      $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
      $this->load->view('tr/trcetakstrukpenjualan',$d) ;
     // PrintUDFESCPOS();
   }
    
   public function cetakstruk(){
        $va 	= $this->input->post() ;
        $this->func_m->cetakstruk($va['faktur']);
    }

   public function loadgrid(){
      $va     = json_decode($this->input->post('request'), true) ;
      $vare   = array() ;
      $va['tglawal'] = date_2s($va['tglawal']);
      $va['tglakhir'] = date_2s($va['tglakhir']);
      $vdb    = $this->trcetakstrukpenjualan_m->loadgrid($va) ;
      $dbd    = $vdb['db'] ;
      while( $dbr = $this->trcetakstrukpenjualan_m->getrow($dbd) ){
         $vaset   = $dbr ;
         $vaset['kembalian'] = $vaset['kas'] + $vaset['diskon'] + $vaset['piutang'] - $vaset['total'];
         $vaset['bayar']    =$vaset['kas'];
         $vaset['tgl'] = date_2d($vaset['tgl']);
         $vaset['cmddetail']    = '<button type="button" onClick="bos.trcetakstrukpenjualan.cmddetail(\''.$dbr['faktur'].'\')"
                           class="btn btn-success btn-grid">Detail</button>' ;
          if(getsession($this, "level_code") == "0000"){
              $vaset['cmddelete']  = '<button type="button" onClick="bos.trcetakstrukpenjualan.cmddelete(\''.$dbr['faktur'].'\')"
                           class="btn btn-danger btn-grid">Delete</button>' ;
          }else{
              $vaset['cmddelete'] = "";
          }

         $vaset['cmddetail']	   = html_entity_decode($vaset['cmddetail']) ;
         $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

         $vare[]		= $vaset ;
      }

      $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
      echo(json_encode($vare)) ;
   }

   public function detailpenjualan(){
      $va 	= $this->input->post() ;
      $faktur = $va['faktur'] ;
      echo('
        w2ui["bos-form-trcetakstrukpenjualan_grid2"].clear();
      ');
      $data = $this->trcetakstrukpenjualan_m->getdatatotal($faktur) ;
       if(!empty($data)){
           $kembalian = $data['kas'] + $data['diskon']- $data['total'];
           echo('
            with(bos.trcetakstrukpenjualan.obj){
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#total").val("'.string_2s($data['subtotal']).'") ;
               find("#bayar").val("'.string_2s($data['kas']).'") ;
               find("#diskonnom").val("'.string_2s($data['diskon']).'") ;
               find("#kembalian").val("'.string_2s($kembalian).'") ;
            }

         ') ; 

           //loadgrid detail
           $vare = array();
           $dbd = $this->trcetakstrukpenjualan_m->getdatadetail($faktur) ;
           $n = 0 ;
           while( $dbr = $this->trcetakstrukpenjualan_m->getrow($dbd) ){
               $n++;
               $vaset   = $dbr ;
               $vaset['recid'] = $n;
               $vaset['no'] = $n;
               $vare[] = $vaset ;
           }
           $vare[] = array("recid"=>"ZZZZ","no" => '', "stock"=> '', "namastock"=> '', "harga"=> '', "qty"=> '',"diskon"=> '', "satuan"=>'',"jumlah"=>'0.00',"w2ui"=>array("summary"=>true));
           $vare = json_encode($vare);
           



           echo('
            bos.trcetakstrukpenjualan.loadmodeldetail("show") ;
            bos.trcetakstrukpenjualan.grid2_reloaddata();
            w2ui["bos-form-trcetakstrukpenjualan_grid2"].add('.$vare.');
            bos.trcetakstrukpenjualan.grid2_sumtotal();
          ');
           
       }
   }
    
   public function deleting(){
      $va 	= $this->input->post() ;
      $this->trcetakstrukpenjualan_m->deleting($va['faktur']) ;
      echo('bos.trcetakstrukpenjualan.grid1_reloaddata() ; ') ;
   }
}
?>
