<?php
class Trmutasipersekot extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('tr/trmutasipersekot_m') ;
        $this->load->model('func/updtransaksi_m') ;
        $this->load->helper('bdate');
        $this->bdb = $this->trmutasipersekot_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trmutasipersekot',$d) ;
    }

    public function loadgrid(){
        $va                 = json_decode($this->input->post('request'), true) ;
        $vare               = array() ;
        $va['tglawal']      = date_2s($va['tglawal']);
        $va['tglakhir']     = date_2s($va['tglakhir']);
        $vdb                = $this->trmutasipersekot_m->loadgrid($va) ;
        $dbd                = $vdb['db'] ;
        while( $dbr = $this->trmutasipersekot_m->getrow($dbd) ){
            $vaset                  = $dbr ;
            $vaset['tgl']           = date_2d($vaset['tgl']);
            $vaset['cmdedit']       = '<button type="button" onClick="bos.trmutasipersekot.cmdedit(\''.$dbr['faktur'].'\')"
                                        class="btn btn-success btn-grid">Edit</button>' ;
            $vaset['cmddelete']     = '<button type="button" onClick="bos.trmutasipersekot.cmddelete(\''.$dbr['faktur'].'\')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
            $vaset['cmdcetak']    = '<button type="button" onClick="bos.trmutasipersekot.cmdcetak(\''.$dbr['faktur'].'\')"
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
        savesession($this, "ssmutasipersekot_faktur", "") ;
    }

    public function saving(){
        $va 	     = $this->input->post() ;
        $kode 	     = getsession($this, "ssmutasipersekot_faktur") ;
        $va['tgl']   = date_2s($va['tgl']) ;

        $this->trmutasipersekot_m->saving($kode, $va) ;
        echo(' bos.trmutasipersekot.settab(0) ;  ') ;
    }

    public function editing(){
        $va 	= $this->input->post() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trmutasipersekot_m->getdatatotal($faktur) ;
        if(!empty($data)){
            savesession($this, "ssmutasipersekot_faktur", $faktur) ;
            $kodetransaksi[] = array("id"=>$data['kodetransaksi'],"text"=>$data['kodetransaksi']."-".$data['ketkdtr']);
            $supplier[] = array("id"=>$data['supplier'],"text"=>$data['supplier']."-".$data['namasupplier']);

            echo('
            w2ui["bos-form-trmutasipersekot_grid2"].clear();
            with(bos.trmutasipersekot.obj){
               find(".nav-tabs li:eq(1) a").tab("show") ;
               find("#faktur").val("'.$data['faktur'].'") ;
               find("#tgl").val("'.date_2d($data['tgl']).'");
               find("#kodetransaksi").sval('.json_encode($kodetransaksi).');
               find("#supplier").sval('.json_encode($supplier).');
               find("#jumlah").val("'.string_2s($data['jumlah'],2).'") ;

            }


         ') ;

            //loadgrid detail
            $vare = array();
            $dbd = $this->trmutasipersekot_m->getdatadetail($faktur) ;
            $n = 0 ;
            while( $dbr = $this->trmutasipersekot_m->getrow($dbd) ){
                $n++;
                $vaset   = $dbr ;
                $vaset['recid'] = $n;
                $vaset['no'] = $n;
                $vaset['cmddelete'] = '<button type="button" onClick="bos.trmutasipersekot.grid2_deleterow('.$n.')"
                                        class="btn btn-danger btn-grid">Delete</button>' ;
                $vaset['cmddelete']	= html_entity_decode($vaset['cmddelete']) ;

                $vare[]             = $vaset ;
            }
            $vare = json_encode($vare);
            echo('
                w2ui["bos-form-trmutasipersekot_grid2"].add('.$vare.');
                bos.trmutasipersekot.initdetail();
                bos.trmutasipersekot.settab(1) ;
            ');
        }
    }
    public function deleting(){
        $va 	= $this->input->post() ;
        $this->trmutasipersekot_m->deleting($va['faktur']) ;
        echo('bos.trmutasipersekot.grid1_reloaddata() ; ') ;

    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasipersekot_m->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasipersekot_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seeksupplier(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasipersekot_m->seeksupplier($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasipersekot_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['nama']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function seekkodetransaksi(){
        $search     = $this->input->get('q');
        $vdb    = $this->trmutasipersekot_m->seekkodetransaksi($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->trmutasipersekot_m->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] . " - " . $dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function getfaktur(){
        $va 	= $this->input->post() ;
        $faktur  = $this->trmutasipersekot_m->getfaktur(FALSE) ;

        echo('
        bos.trmutasipersekot.obj.find("#faktur").val("'.$faktur.'") ;
        ') ;
    }

    public function showreport(){
        $va 	= $this->input->get() ;
        $faktur = $va['faktur'] ;
        $data   = $this->trmutasipersekot_m->getdatatotal($faktur) ;
        if(!empty($data)){
            $font = 10 ;
            $now  = date_2b(date("Y-m-d")) ;
            $kota = $this->bdb->getconfig("kota") . ", " . $now['d'] . ' ' . $now['m'] . ' ' . $now['y'];
            $vttd = array() ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=> $kota ,"5"=>"") ;
            //$vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"Dibuat,","3"=>"","4"=>"Mengetahui,","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"","3"=>"","4"=>"","5"=>"") ;
            $vttd[] = array("1"=>"","2"=>"(.......................)","3"=>"","4"=>"(.......................)","5"=>"") ;

            $vDetail = array() ;
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Faktur","5"=>":","6"=>$faktur);
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Supplier","5"=>":","6"=>$data['namasupplier']);
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Kd Transaksi","5"=>":","6"=>$data['ketkdtr']);
            $vDetail[] = array("1"=>"","2"=>"","3"=>"","4"=>"Tgl","5"=>":","6"=>date_2d($data['tgl']));
            $vTitle = array() ;
            $vTitle[] = array("capt"=>" Mutasi Persekot ") ;

            //detail
            $dbd = $this->trmutasipersekot_m->getdatadetail($faktur) ;
            $n = 0 ;
            $array = array();

            while( $dbr = $this->trmutasipersekot_m->getrow($dbd)){
                $n++;
                $array[] = array("No"=>$n,"Rekening"=>$dbr['rekening'],"Ket Rekening"=>$dbr['ketrek'],"Jumlah"=>string_2s($dbr['nominal']));
            }


            $o    = array('paper'=>'A4', 'orientation'=>'p', 'export'=>(isset($va['export']) ? $va['export'] : 0 ),
                          'opt'=>array('export_name'=>'Kartu Stock','mtop'=>1) ) ;
            $this->load->library('bospdf', $o) ;
            //$this->bospdf->ezSetMargins(1,1,20,20);
            //$this->bospdf->ezSetCmMargins(0, 1, 1, 1);
            //$this->bospdf->ezImage("./uploads/HeaderSJDO.jpg",true,'60','190','50');
            $this->bospdf->ezLogoHeaderPage(base_url()."uploads/HeaderSJDO.jpg",'0','65','150','50');
            //$this->bospdf->ezHeader("<b>DELIVERY ORDER (DO)</b>",array("justification"=>"center")) ;
            //$this->bospdf->ezText("") ;

            //ketika width tidak di set maka akan menyesuaikan dengan lebar kertas

            $this->bospdf->ezTable($vDetail,"","",
                                   array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "1"=>array("width"=>10,"justification"=>"left"),
                                             "2"=>array("width"=>3,"justification"=>"left"),
                                             "3"=>array("justification"=>"left"),
                                             "4"=>array("width"=>10,"justification"=>"left"),
                                             "5"=>array("width"=>3,"justification"=>"left"),
                                             "6"=>array("width"=>25,"justification"=>"left","wrap"=>1),)
                                        )
                                  ) ;

            $this->bospdf->ezTable($vTitle,"","",
                                   array("fontSize"=>$font+3,"showHeadings"=>0,"showLines"=>0,
                                         "cols"=> array(
                                             "capt"=>array("justification"=>"center"),)
                                        )
                                  ) ;

            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($array,"","",
                                   array("fontSize"=>$font,"showLines"=>1,
                                         "cols"=> array(
                                             "No"            =>array("width"=>5,"justification"=>"right"),
                                             "Rekening"  	=>array("width"=>15,"justification"=>"left"),
                                             "Ket Rekening"   =>array("wrap"=>1),
                                             "Jumlah"          =>array("width"=>12,"justification"=>"right")))
                                  ) ;

         $this->bospdf->ezText("") ;
         $this->bospdf->ezText("") ;
         $this->bospdf->ezTable($vttd,"","",
                                 array("fontSize"=>$font,"showHeadings"=>0,"showLines"=>0,
                                       "cols"=> array(
                                          "1"=>array("justification"=>"right"),
                                          "2"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "3"=>array("width"=>40,"wrap"=>1),
                                          "4"=>array("width"=>25,"wrap"=>1,"justification"=>"center"),
                                          "5"=>array("wrap"=>1,"justification"=>"center"))
                                 )
                              ) ;


            $this->bospdf->ezStream() ;
        }else{
            echo("data tidak ada !!!");
        }

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

            bos.trmutasipersekot.printbukti("'.$html.'");
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

            bos.trmutasipersekot.printbukti("'.$html.'");
            ');
        }else{
            echo('alert("Data tidak ada !!!");');
        }

    }

}
?>
