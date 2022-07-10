<?php
class Trmutasibank extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trmutasibank_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trmutasibank_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trmutasibank',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trmutasibank_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trmutasibank_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $jenisfkt = "BM";
            if($dbr['kredit']>0)$jenisfkt= "BK";
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trmutasibank.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trmutasibank.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdcetak']    = '<button type="button" onClick="bos.trmutasibank.cmdcetak(\''.$dbr['faktur'].'\',\''.$jenisfkt.'\',\''.$dbr['bank'].'\')"
                                         class="btn btn-warning btn-grid">Cetak</button>' ;
            $vaset['cmdcetak']    = html_entity_decode($vaset['cmdcetak']) ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssmutasibank_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssmutasibank_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trmutasibank_m->saving($kode, $va) ;
        echo(' bos.trmutasibank.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trmutasibank_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssmutasibank_faktur", $faktur) ;
            $bank[] = array("id"=>$data['bank'],"text"=>$data['bank']."-".$data['ketbank']);
            $jenis = "BM";
            $jumlah = $data['debet'];
            if($data['kredit'] > 0){
                $jenis = "BK";
                $jumlah = $data['kredit'];
            }

            echo('
            w2ui["bos-form-trmutasibank_grid2"].clear();
            with(bos.trmutasibank.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#bank").sval('.json_encode($bank).');
               find("#keterangan").val("'.$data['keterangan'].'") ;
               find("#diberiterima").val("'.$data['diberiterima'].'") ;
               find("#jumlah").val("'.string_2s($jumlah,2).'") ;

            }
            bos.trmutasibank.setopt("jenis","'.$jenis.'");


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trmutasibank_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trmutasibank_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trmutasibank.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trmutasibank_grid2"].add('.$vare.');
                bos.trmutasibank.initdetail();
                bos.trmutasibank.settab(1) ;
            ');
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trmutasibank_m->deleting($va['faktur']) ;
        echo('bos.trmutasibank.grid1_reloaddata() ; ') ;

    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasibank_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasibank_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function seekbank(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasibank_m->seekbank($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasibank_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $va 	= $this->input->post() ;
        $faktur  = $this->trmutasibank_m->getfaktur(FALSE) ;

        echo('
        bos.trmutasibank.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }
    
    public function printbuktibm(){
        //gambar yg diambil di display none dulu di frame, kayaknya perlu untuk pancingan aja

        $va 	= $this->input->post() ;
        $dbr    = $this->bdb->getdatatotal($va['faktur']) ;
        if(!empty($dbr)){

            $html   ="";
            $html   .="<table width = 100%>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr>";
            $html   .="             <td width=65%><img src =\ ./uploads/header.jpg \ width=100%></td>";
            $html   .="             <td >&nbsp;</td>";
            $html   .="             <td width=30%>";
            $html   .="                 <table width=100%>";
            $html   .="                     <tr><td>Kudus ".date_2d($dbr['tgl'])."</td></tr>";
            $html   .="                     <tr><td>No BM ".$va['faktur']."</td></tr>";
            $html   .="                 </table>";
            $html   .="             </td>";
            $html   .="         </tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100% align=center><h2>BUKTI BANK MASUK</h2></td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td width = 150px valign=top>Diterima Dari</td><td valign=top width=5px>:</td><td>".$dbr['diberiterima']."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Sejumlah</td><td valign=top width=5px>:</td><td>".string_2n($dbr['debet'])."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Terbilang</td><td valign=top width=5px>:</td><td>".terbilang($dbr['debet']) ."&nbsp;rupiah</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Untuk Pembayaran</td><td valign=top width=5px>:</td><td>".$dbr['keterangan']."</td></tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td align = center>Yang Menerima</td><td></td><td align = center>Bagian Keuangan</td></tr>";
            $html   .="         <tr><td height=60px></td><td></td><td></td></tr>";
            $html   .="         <tr><td align = center>...............</td><td></td><td align = center>...............</td></tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .="</table>";
            echo('

            bos.trmutasibank.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }

    public function printbuktibk(){
        //gambar yg diambil di display none dulu di frame, kayaknya perlu untuk pancingan aja

        $va 	= $this->input->post() ;
        $dbr    = $this->bdb->getdatatotal($va['faktur']) ;
        if(!empty($dbr)){

            $html   ="";
            $html   .="<table width = 100%>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr>";
            $html   .="             <td width=65%><img src =\ ./uploads/header.jpg \ width=100%></td>";
            $html   .="             <td >&nbsp;</td>";
            $html   .="             <td width=30%>";
            $html   .="                 <table width=100%>";
            $html   .="                     <tr><td>Kudus ".date_2d($dbr['tgl'])."</td></tr>";
            $html   .="                     <tr><td>No BK ".$va['faktur']."</td></tr>";
            $html   .="                 </table>";
            $html   .="             </td>";
            $html   .="         </tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100% align=center><h3>BUKTI BANK KELUAR</h3></td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td width = 150px valign=top>Dibayar Ke</td><td valign=top width=5px>:</td><td>".$dbr['diberiterima']."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Sejumlah</td><td valign=top width=5px>:</td><td>".string_2n($dbr['kredit'])."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Terbilang</td><td valign=top width=5px>:</td><td>".terbilang($dbr['kredit']) ."&nbsp;rupiah</td></tr>";
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

            bos.trmutasibank.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }

}
?>
