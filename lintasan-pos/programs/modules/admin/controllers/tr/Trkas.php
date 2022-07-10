<?php
class Trkas extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("tr/trkas_m") ;
        $this->load->model("func/updtransaksi_m") ;
        $this->bdb 	= $this->trkas_m ; 
    }

    public function index(){
        $this->load->view("tr/trkas") ; 

    } 

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ; 
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $n = 0 ; 
        $vare[0] = array("no"=>"","tgl"=>"","faktur"=>"","keterangan"=>"Saldo Awal","debet"=>"","kredit"=>"","total"=> string_2s($vdb['saldoawal']),"username"=>"") ;
        $total = $vdb['saldoawal'] ;
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vs = $dbr;
            $vs['no'] = ++$n ;
            $vs['tgl'] = date_2d($vs['tgl']) ;  
            $c = $vdb['rekening'] ;
            if($c == "1" || $c == "5" || $c == "6" || $c == "8" || $c == "9"){
                $total += $vs['debet'] - $vs['kredit'] ;
            }else{
                $total += $vs['kredit'] - $vs['debet'];
            }
            $vs['debet'] = string_2s($vs['debet']);
            $vs['kredit'] = string_2s($vs['kredit']);
            $vs['total'] = $total ;
            $vs['total'] = string_2s($vs['total']);

            $vs['cmdprintbukti']    = "";
            $jenisfkt = substr($vs['faktur'],0,2);
            if($jenisfkt == "KM" || $jenisfkt == "KK"){
                $vs['cmdprintbukti']    = '<button type="button" onClick="bos.trkas.cmdprintbukti(\''.$vs['faktur'].'\',\''.$jenisfkt.'\',\''.$va['rekening'].'\')"
                                         class="btn btn-success btn-grid">Cetak</button>' ;
                $vs['cmdprintbukti']    = html_entity_decode($vs['cmdprintbukti']) ;
            }

            $vare[]		= $vs ;
        }
        $vare 	= array("total"=>$vdb['rows']+1, "records"=>$vare ) ;
        $varpt = $vare['records'] ;
        echo(json_encode($vare)) ; 
    }

    public function init(){
        savesession($this, "sstrkas_id", "") ; 
    }

    public function saving(){
        $va 	= $this->input->post() ;
        $id 	= getsession($this, "sstrkas_id") ;
        $this->bdb->saving($va, $id) ;  
        /*echo('
			bos.trkas.obj.find("#jumlah").val("") ;
			bos.trkas.obj.find("#keterangan").val("") ;
			alert("Transaksi Berhasil Disimpan...") ;
		');*/

        echo(' bos.trkas.settab(0) ;  ') ;
    }

    public function printbuktikm(){
        //gambar yg diambil di display none dulu di frame, kayaknya perlu untuk pancingan aja

        $va 	= $this->input->post() ;
        $dbd    = $this->bdb->loaddetail($va) ;
        if( $dbr = $this->bdb->getrow($dbd) ){

            $html   ="";
            $html   .="<table width = 100%>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr>";
            $html   .="             <td width=55%><img src =\ ./uploads/kas.png \ width=100%></td>";
            $html   .="             <td >&nbsp;</td>";
            $html   .="             <td width=40%>";
            $html   .="                 <table width=100%>";
            $html   .="                     <tr><td>Kudus ".date_2d($dbr['tgl'])."</td></tr>";
            $html   .="                     <tr><td>No KM ".$va['faktur']."</td></tr>";
            $html   .="                 </table>";
            $html   .="             </td>";
            $html   .="         </tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100% align=center><h2>BUKTI KAS MASUK</h2></td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td width = 150px valign=top>Diterima Dari</td><td valign=top width=5px>:</td><td></td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Sejumlah</td><td valign=top width=5px>:</td><td>".string_2n($dbr['debet'])."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Terbilang</td><td valign=top width=5px>:</td><td></td></tr>";
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

            bos.trkas.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }
    
    public function printbuktikk(){
        //gambar yg diambil di display none dulu di frame, kayaknya perlu untuk pancingan aja

        $va 	= $this->input->post() ;
        $dbd    = $this->bdb->loaddetail($va) ;
        if( $dbr = $this->bdb->getrow($dbd) ){

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
            $html   .="                     <tr><td>No KM ".$va['faktur']."</td></tr>";
            $html   .="                 </table>";
            $html   .="             </td>";
            $html   .="         </tr>";
            $html   .="     </table>";
            $html   .=" </td></tr>";
            $html   .=" <tr><td width = 100% align=center><h2>BUKTI KAS KELUAR</h2></td></tr>";
            $html   .=" <tr><td width = 100%>";
            $html   .="     <table width = 100%>";
            $html   .="         <tr><td width = 150px valign=top>Diterima Dari</td><td valign=top width=5px>:</td><td></td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Sejumlah</td><td valign=top width=5px>:</td><td>".string_2n($dbr['debet'])."</td></tr>";
            $html   .="         <tr><td width = 150px valign=top>Terbilang</td><td valign=top width=5px>:</td><td></td></tr>";
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

            bos.trkas.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }

}
?>
