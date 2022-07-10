<?php
class Trjurnallainlain extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trjurnallainlain_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trjurnallainlain_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trjurnallainlain',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trjurnallainlain_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trjurnallainlain_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $jenisfkt = "KM";
            if($dbr['kredit']>0)$jenisfkt= "KK";
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trjurnallainlain.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trjurnallainlain.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssjurnallainlain_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssjurnallainlain_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trjurnallainlain_m->saving($kode, $va) ;
        echo(' bos.trjurnallainlain.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trjurnallainlain_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssjurnallainlain_faktur", $faktur) ;
            
            echo('
            w2ui["bos-form-trjurnallainlain_grid2"].clear();
            with(bos.trjurnallainlain.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");

            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trjurnallainlain_m->getdatadetail($faktur) ;
            $n = 0 ;
			$totdebet = 0 ;
			$totkredit = 0 ;
            while( $dbr = $this->trjurnallainlain_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
				$totdebet += $dbr['debet'] ;
				$totkredit += $dbr['kredit'] ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trjurnallainlain.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

                $vare[]             = $vaset ;
            }
			$vare[] = array("recid"=>'ZZZZ',"no"=> '', "kode"=> '', "rekening"=> '','ketrekening'=>'','keterangan'=>'TOTAL',
                        "debet"=>$totdebet,"kredit"=>$totkredit,"w2ui"=>array("summary"=> true));
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trjurnallainlain_grid2"].add('.$vare.');
                bos.trjurnallainlain.initdetail();
                bos.trjurnallainlain.settab(1) ;
            ');
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trjurnallainlain_m->deleting($va['faktur']) ;
        echo('bos.trjurnallainlain.grid1_reloaddata() ; ') ;

    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->trjurnallainlain_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trjurnallainlain_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $va 	= $this->input->post() ;
        $faktur  = $this->trjurnallainlain_m->getfaktur(FALSE) ;

        echo('
        bos.trjurnallainlain.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }
    
    public function printbuktikm(){
        //gambar yg diambil di display none dulu di frame, kayaknya perlu untuk pancingan aja

        $va 	= $this->input->post() ;
        $dbr    = $this->bdb->getdatatotal($va['faktur']) ;
        if(!empty($dbr)){

            $html   ="";
            $html   .="<table width = 100%>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr>";
            $html   .="             <td width=65%><img src =\ ./uploads/kas.png \ width=100%></td>";
            $html   .="             <td >&nbsp;</td>";
            $html   .="             <td width=30%>";
            $html   .="                 <table width=100%>";
            $html   .="                     <tr><td>Kudus, ".date_2d($dbr['tgl'])."</td></tr>";
            $html   .="                     <tr><td>No KM : ".$va['faktur']."</td></tr>";
            $html   .="                 </table>";
            $html   .="             </td>";
            $html   .="         </tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100% align=center><h2>BUKTI KAS MASUK</h2></td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td width = 150px valign=top>Diterima Dari</td><td valign=top width=5px>:</td><td>".$dbr['diberiterima']."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Sejumlah</td><td valign=top width=5px>:</td><td>Rp. ".string_2n($dbr['debet'])."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Terbilang</td><td valign=top width=5px>:</td><td>".terbilang($dbr['debet']) ."Rupiah</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Untuk Pembayaran</td><td valign=top width=5px>:</td><td>".$dbr['keterangan']."</td></tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td align = center>Yang Membayar</td><td></td><td align = center>Bagian Keuangan</td></tr>";
            $html   .="         <tr><td height=60px></td><td></td><td></td></tr>";
            $html   .="         <tr><td align = center>...............</td><td></td><td align = center>...............</td></tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .="</table>";
            echo('

            bos.trjurnallainlain.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }

    public function printbuktikk(){
        //gambar yg diambil di display none dulu di frame, kayaknya perlu untuk pancingan aja

        $va 	= $this->input->post() ;
        $dbr    = $this->bdb->getdatatotal($va['faktur']) ;
        if(!empty($dbr)){

            $html   ="";

            $html   .="<table width = 100%>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr>";
            $html   .="             <td width=65%><img src =\ ./uploads/kas.png \ width=100%></td>";
            $html   .="             <td >&nbsp;</td>";
            $html   .="             <td width=30% style=padding-left: 5px; padding-bottom: 3px; font-size:25px;>";
            $html   .="                 <table width=100%>";
            $html   .="                     <tr><td>Kudus, ".date_2d($dbr['tgl'])."</td></tr>";
            $html   .="                     <tr><td>No KK : ".$va['faktur']."</td></tr>";
            $html   .="                 </table>";
            $html   .="             </td>";
            $html   .="         </tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100% align=center><h2>BUKTI KAS KELUAR</h2></td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td width = 150px valign=top>Dibayar Ke</td><td valign=top width=5px>:</td><td>".$dbr['diberiterima']."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Sejumlah</td><td valign=top width=5px>:</td><td>Rp. ".string_2n($dbr['kredit'])."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Terbilang</td><td valign=top width=5px>:</td><td>".terbilang($dbr['kredit']) ."Rupiah</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Untuk Pembayaran</td><td valign=top width=5px>:</td><td>".$dbr['keterangan']."</td></tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td align = center>Yang Membayar</td><td></td><td align = center>Bagian Keuangan</td></tr>";
            $html   .="         <tr><td height=60px></td><td></td><td></td></tr>";
            $html   .="         <tr><td align = center>...............</td><td></td><td align = center>...............</td></tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .="</table>";
            echo('

            bos.trjurnallainlain.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }

}
?>
