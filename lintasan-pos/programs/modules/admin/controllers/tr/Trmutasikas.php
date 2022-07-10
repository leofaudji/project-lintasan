<?php
class Trmutasikas extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trmutasikas_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->helper('bdate');
		$this->load->model('func/func_m') ;
		$this->load->library('curl');
        $this->bdb = $this->trmutasikas_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trmutasikas',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trmutasikas_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trmutasikas_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $jenisfkt = "KM";
            if($dbr['kredit']>0)$jenisfkt= "KK";
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trmutasikas.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trmutasikas.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdcetak']    = '<button type="button" onClick="bos.trmutasikas.cmdcetak(\''.$dbr['faktur'].'\',\''.$jenisfkt.'\',\''.$dbr['rekening'].'\')"
                                         class="btn btn-warning btn-grid">Cetak</button>' ;
            $vaset['cmdcetak']    = html_entity_decode($vaset['cmdcetak']) ;
			$vaset['cmdcetakdm']    = '<button type="button" onClick="bos.trmutasikas.cmdcetakdm(\''.$dbr['faktur'].'\',\''.$jenisfkt.'\',\''.$dbr['rekening'].'\')"
                                         class="btn btn-primary btn-grid">Cetak DM</button>' ;
            $vaset['cmdcetakdm']    = html_entity_decode($vaset['cmdcetakdm']) ;
            $vaset['cmdedit']       = html_entity_decode($vaset['cmdedit']) ;
            $vaset['cmddelete']	    = html_entity_decode($vaset['cmddelete']) ;
            $vare[]                 = $vaset ;
        }
        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function init(){
        savesession($this, "ssmutasikas_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssmutasikas_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trmutasikas_m->saving($kode, $va) ;
        echo(' bos.trmutasikas.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trmutasikas_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssmutasikas_faktur", $faktur) ;
            $rekkas[] = array("id"=>$data['rekening'],"text"=>$data['rekening']."-".$data['ketrekening']);
            $jenis = "KM";
            $jumlah = $data['debet'];
            if($data['kredit'] > 0){
                $jenis = "KK";
                $jumlah = $data['kredit'];
            }

            echo('
            w2ui["bos-form-trmutasikas_grid2"].clear();
            with(bos.trmutasikas.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#rekkas").sval('.json_encode($rekkas).');
               find("#keterangan").val("'.$data['keterangan'].'") ;
               find("#diberiterima").val("'.$data['diberiterima'].'") ;
               find("#jumlah").val("'.string_2s($jumlah,2).'") ;

            }
            bos.trmutasikas.setopt("jenis","'.$jenis.'");


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trmutasikas_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trmutasikas_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trmutasikas.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trmutasikas_grid2"].add('.$vare.');
                bos.trmutasikas.initdetail();
                bos.trmutasikas.settab(1) ;
            ');
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trmutasikas_m->deleting($va['faktur']) ;
        echo('bos.trmutasikas.grid1_reloaddata() ; ') ;

    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasikas_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasikas_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $va 	= $this->input->post() ;
        $faktur  = $this->trmutasikas_m->getfaktur(FALSE) ;

        echo('
        bos.trmutasikas.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }
	
	public function printbuktidmkm(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;

        $this->func_m->cetakkm($faktur);
    }
	
	public function printbuktidmkk(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;

        $this->func_m->cetakkk($faktur);
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

            bos.trmutasikas.printbukti("'.$html.'");
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

            bos.trmutasikas.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }

}
?>
