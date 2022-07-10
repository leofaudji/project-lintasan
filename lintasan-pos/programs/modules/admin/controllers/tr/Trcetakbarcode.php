<?php
class Trcetakbarcode extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/perhitungan_m') ;
        $this->load->model('tr/trcetakbarcode_m') ;

        $this->load->helper('bdate');
        $this->bdb = $this->trcetakbarcode_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trcetakbarcode',$d) ;
    }


    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trcetakbarcode_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trcetakbarcode.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#barcode").val("'.$data['barcode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#satuan").val("'.$data['satuan'].'");
               bos.trcetakbarcode.loadmodelstock("hide");
            }

         ') ;
        }
    }

    public function seekstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        //print_r($va);
        $data = $this->trcetakbarcode_m->getdata($kode) ;
        if(!empty($data)){
            echo('

            with(bos.trcetakbarcode.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#barcode").val("'.$data['barcode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#satuan").val("'.$data['satuan'].'");
            }

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.trcetakbarcode.obj){
                    find("#stock").val("") ;
                    find("#stock").focus() ;
                }
            ');
        }
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trcetakbarcode_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trcetakbarcode_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trcetakbarcode.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }
    
    public function cetakbarcode(){
        $va         = $this->input->post();
        //print_r($va);
        $pdfFilePath = "./tmp/".md5("cetakbarcode-".date_now()).".pdf";
        $cDownloadPath = $pdfFilePath ;
        //load mPDF library
        $this->load->library('m_pdf');
        $n = 0 ;
        $urut = 0 ;
        $arrstock = array(); 
        

        $max =4;
        if((strlen($va['barcode']) == 12 || strlen($va['barcode']) == 13) && $va['barcode'] <> "")$max = 5;
        for($i=1;$i<=$va['cetak'];$i++){
            $n++;
            if($n == 1){
                $urut++;
                $arrstock[$urut] = array();
                for($a = 1 ;$a <= $max;$a++){
                    $arrstock[$urut][$a] = "";
                }
            }
            $arrstock[$urut][$n] = $va['stock'];
            if($n >= $max){
                $n = 0;
            }
        }
        echo $max;
        $htmlHeader = "
                <table  height = '30px' style='width: 100%'>";
        foreach($arrstock as $key2 => $vaval){
            $htmlHeader .= "<tr>";
            foreach($vaval as $key3 => $val){
                if($val == ""){
                    $htmlHeader .= "<td style='border:1px solid #ffffff;' valign='top'>&nbsp;</td>";
                }else{
                    $data = $this->trcetakbarcode_m->getdata($val);
                    $harga = "";
                    if(isset($va['tampilharga'])){
                        $harga = "Rp." . string_2s($data['hargajual']);
                    }
                    $htmlHeader .= "<td style='border:1px solid #aaaaaa;' valign='top'>";
                    $htmlHeader .=  "<table style='width: 100%'>
                                        <tr>
                                            <td style='overflow: hidden;font-size:9px;' bgcolor='#FFFFFF' height='15px' valign='top'>".$data['keterangan']." ".$data['satuan']." ".$harga."</td>

                                        </tr>";
                    $font_harga=11;
                    $height_barcode=0.25;




                    if($max == 5){
                        $htmlHeader .=  "<tr>
                                        <td style='text-align:center;'><barcode size='1' height='".$height_barcode."' code='".$data['barcode']."' text='".$data['barcode']."' class='barcode' /></td>
                                     </tr>";


                    }else{
                        $barcode = $data['barcode'];
                        if($data['barcode'] == "") $barcode = $data['kode'];
                        $height_barcode += 0.50;
                       /* $htmlHeader .= "<tr>
                                            <td style='width:150px;font-size:14px;text-align:center;' bgcolor='#FFFFFF' height='15px' valign='bottom'>".$val."</td>
                                        </tr>";*/
                        $htmlHeader .= "<tr>
                                            <td style='text-align:center;'><barcode code='".$barcode."' type='C128A' size = '1' height='".$height_barcode."'/>". $barcode."</td>
                                        </tr>";


                    }

                    $htmlHeader .= "</table>";

                    /*<barcode height='0.5' code='4974052841781' text='4974052841781' class='barcode' />".$val."*/
                    $htmlHeader .= "</td>";
                }
            }
            $htmlHeader .= "</tr>";
        }
        $htmlHeader .= "</table>


            ";
       // $htmlHeader = "<barcode  code='1810000001' type = 'CODE11' size = '1.5' height = '2.0'/>";
        //$htmlHeader = "<barcode code='1810000070' type='C39' size = '1' height = '0.25'/>";
        //$this->m_pdf->pdf->SetDisplayMode('fullpage');
        //$this->m_pdf->pdf->SetMargins(0, 0, 0, 0);
        $this->m_pdf->pdf->AddPageByArray([
            'margin-left' => 5,
            'margin-right' => 5,
            'margin-top' => 14,
            'margin-bottom' => 0,
        ]);

        $this->m_pdf->pdf->WriteHTML($htmlHeader);
        $this->m_pdf->pdf->Output(FCPATH.$pdfFilePath,'F');

        echo("
            bos.trcetakbarcode.showReport('".$pdfFilePath."');
        ");
    }
}
?>
