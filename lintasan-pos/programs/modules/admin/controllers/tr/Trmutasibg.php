<?php
class Trmutasibg extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trmutasibg_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trmutasibg_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trmutasibg',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trmutasibg_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trmutasibg_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $jenisfkt = "GM";
            if($dbr['debet']>0)$jenisfkt= "GK";
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trmutasibg.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trmutasibg.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdcetak']    = '<button type="button" onClick="bos.trmutasibg.cmdcetak(\''.$dbr['faktur'].'\',\''.$jenisfkt.'\',\''.$dbr['rekening'].'\')"
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
        savesession($this, "ssmutasibg_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssmutasibg_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trmutasibg_m->saving($kode, $va) ;
        echo(' bos.trmutasibg.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trmutasibg_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssmutasibg_faktur", $faktur) ;
            $rekbg[] = array("id"=>$data['rekening'],"text"=>$data['rekening']."-".$data['ketrekening']);
            $jenis = "GM";
            $jumlah = $data['kredit'];
            if($data['debet'] > 0){
                $jenis = "GK";
                $jumlah = $data['debet'];
            }

            echo('
            w2ui["bos-form-trmutasibg_grid2"].clear();
            with(bos.trmutasibg.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#rekbg").sval('.json_encode($rekbg).');
               find("#keterangan").val("'.$data['keterangan'].'") ;
               find("#diberiterima").val("'.$data['diberiterima'].'") ;
               find("#jumlah").val("'.string_2s($jumlah,2).'") ;

            }
            bos.trmutasibg.setopt("jenis","'.$jenis.'");


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trmutasibg_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trmutasibg_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['jthtmp'] = date_2d($vaset['jthtmp']);
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trmutasibg.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trmutasibg_grid2"].add('.$vare.');
                bos.trmutasibg.initdetail();
                bos.trmutasibg.settab(1) ;
            ');
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trmutasibg_m->deleting($va['faktur']) ;
        echo('bos.trmutasibg.grid1_reloaddata() ; ') ;

    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasibg_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasibg_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }
    
    public function seekbank(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasibg_m->seekbank($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasibg_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $va 	= $this->input->post() ;
        $faktur  = $this->trmutasibg_m->getfaktur(FALSE) ;

        echo('
        bos.trmutasibg.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function printbuktigm(){
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
            $html   .="                     <tr><td>No GM ".$va['faktur']."</td></tr>";
            $html   .="                 </table>";
            $html   .="             </td>";
            $html   .="         </tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100% align=center><h2>BUKTI BG/CEK MASUK</h2></td></tr>";
            $html   .=" <tr><td width = 100% rules=all border=1>";
            $html   .="     <table width = 100% align=center>";
            $html   .="         <thead>";
            $html   .="         <tr><th>No</th><th>BG/Cek</th><th>No Rekening</th><th>No BG/Cek</th><th>Jatuh Tempo</th><th>Nominal</th></tr>";
            $html   .="         </thead>";

            //load detail
            $html   .="         <tbody>";
            $dbd = $this->trmutasibg_m->getdatadetail($va['faktur']) ;
            $n = 0 ;
            while( $dbr2 = $this->trmutasibg_m->getrow($dbd) ){
                $n++;
                $html   .="         <tr><td align=center>".$n."</td><td>".$dbr2['bgcek']."</td><td>".$dbr2['norekening']."</td><td>".$dbr2['nobgcek']."</td><td align=center>".date_2d($dbr2['jthtmp'])."</td><td align=center>".string_2s($dbr2['nominal'])."</td></tr>";
            }
            $html   .="         <tr><td colspan=5 align=center>Jumlah</td><td align=center>".string_2s($dbr['kredit'])."</td></tr>";
            $html   .="         </tbody>";

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

            bos.trmutasibg.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }

    public function printbuktigk(){
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
            $html   .=" <tr><td width = 100% align=center><h2>BUKTI BG/CEK KELUAR</h2></td></tr>";
            $html   .=" <tr><td width = 100% align=left>Dibayarkan kepada : ".$dbr['diberiterima']." </td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100% rules=rows border=1 align=center>";
            $html   .="         <thead>";
            $html   .="         <tr><th>No</th><th>BG/Cek</th><th>No Rekening</th><th>No BG/Cek</th><th>Jatuh Tempo</th><th>Nominal</th></tr>";
            $html   .="         </thead>";

            //load detail
            $html   .="         <tbody>";
            $dbd = $this->trmutasibg_m->getdatadetail($va['faktur']) ;
            $n = 0 ;
            while( $dbr2 = $this->trmutasibg_m->getrow($dbd) ){
                $n++;
                $html   .="         <tr align=center><td align=center>".$n."</td><td>".$dbr2['bgcek']."</td><td>".$dbr2['norekening']."</td><td>".$dbr2['nobgcek']."</td><td align=center>".date_2d($dbr2['jthtmp'])."</td><td align=center>".string_2s($dbr2['nominal'])."</td></tr>";
            }
            $html   .="         <tr><td colspan=5 align=right>Jumlah :</td><td align=center>Rp. ".string_2s($dbr['debet'])."</td></tr>";
            $html   .="         </tbody>";

            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100% align=left>Guna Pembayaran : ".$dbr['keterangan']." </td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td align = center>Yang Menerima</td><td></td><td align = center>Bagian Keuangan</td></tr>";
            $html   .="         <tr><td height=60px></td><td></td><td></td></tr>";
            $html   .="         <tr><td align = center>...............</td><td></td><td align = center>...............</td></tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .="</table>";
            echo('

            bos.trmutasibg.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }


    }

}
?>
