<?php
class Trcetakpricecard extends Bismillah_Controller{
    private $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model('func/perhitungan_m') ;
        $this->load->model('tr/trcetakpricecard_m') ;

        $this->load->helper('bdate');
        $this->bdb = $this->trcetakpricecard_m ;
    }

    public function index(){
        $d    = array("dnow"=>date("d-m-Y"), "setdate"=>date_set()) ;
        $this->load->view('tr/trcetakpricecard',$d) ;
    }


    public function pilihstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['kode'] ;
        $data = $this->trcetakpricecard_m->getdata($kode) ;
        if(!empty($data)){
            echo('
            with(bos.trcetakpricecard.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#barcode").val("'.$data['barcode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#satuan").val("'.$data['satuan'].'");
               bos.trcetakpricecard.loadmodelstock("hide");
            }

         ') ;
        }
    }

    public function seekstock(){
        $va 	= $this->input->post() ;
        $kode 	= $va['stock'] ;
        //print_r($va);
        $data = $this->trcetakpricecard_m->getdata($kode) ;
        if(!empty($data)){
            echo('

            with(bos.trcetakpricecard.obj){
               find("#stock").val("'.$data['kode'].'") ;
               find("#barcode").val("'.$data['barcode'].'") ;
               find("#namastock").val("'.$data['keterangan'].'");
               find("#harga").val("'.string_2s($data['hargajual']).'");
               find("#satuan").val("'.$data['satuan'].'");
            }
            bos.trcetakpricecard.gotogrid();

         ') ;
        }else{
            echo('
                alert("data tidak ditemukan !!!");
                with(bos.trcetakpricecard.obj){
                    find("#stock").val("") ;
                    find("#stock").focus() ;
                }
            ');
        }
    }

    public function loadgrid3(){
        $va     = json_decode($this->input->post('request'), true) ;
        $vare   = array() ;
        $vdb    = $this->trcetakpricecard_m->loadgrid3($va) ;
        $dbd    = $vdb['db'] ;
        while( $dbr = $this->trcetakpricecard_m->getrow($dbd) ){
            $vaset   = $dbr ;
            $vaset['cmdpilih']    = '<button type="button" onClick="bos.trcetakpricecard.cmdpilih(\''.$dbr['kode'].'\')"
                           class="btn btn-success btn-grid">Pilih</button>' ;
            $vaset['cmdpilih']	   = html_entity_decode($vaset['cmdpilih']) ;
            $vare[]		= $vaset ;
        }

        $vare 	= array("total"=>$vdb['rows'], "records"=>$vare ) ;
        echo(json_encode($vare)) ;
    }

    public function cetakpricecard(){
        $va         = $this->input->post();
        //print_r($va);
        $pdfFilePath = "./tmp/".md5("rptgondola-".date_now()).".pdf";
        $cDownloadPath = $pdfFilePath ;
        //load mPDF library
        $this->load->library('m_pdf');
        $vaGrid = json_decode($va['grid2']);
        $n = 0 ;
        $urut = 0 ;
        $arrstock = array(); 

        foreach($vaGrid as $key => $val){
            $n++;
            if($n == 1){
                $urut++;
                $arrstock[$urut] = array("1"=>"","2"=>"","3"=>"");
            }
            $arrstock[$urut][$n] = $val->{'stock'};
            if($n >= 3){
                $n = 0;
            }
        }
        $htmlHeader = "
                <table  height = '30px' style='width: 100%'>";
        foreach($arrstock as $key2 => $vaval){
            $htmlHeader .= "<tr>";
            foreach($vaval as $key3 => $val){
                if($val == ""){
                    $htmlHeader .= "<td style='border:1px solid #ffffff;max-width:250px;min-width:250px;' width='227px' height='140px' valign='top'>&nbsp;</td>";
                }else{
                    $data = $this->trcetakpricecard_m->getdata($val);
                    $htmlHeader .= "<td style='border:1px solid #aaaaaa;max-width:250px;min-width:250px;' width='227px' height='140px' valign='top'>";
                    $htmlHeader .=  "<table style='width: 100%'>
                                        <tr>
                                            <td align='left' style='width:150px;font-size:11px;font-weight:bold' bgcolor='#FFFFFF' height='15px' valign='bottom'>".$val."</td>
                                            <td style='width:30%;font-size:11px;background-color:red;text-align:center;color:white;'><b>Toko 69</b></td>
                                            <td style='font-size:10px;font-weight:bold' bgcolor='#FFFFFF' height='15px' align = 'right' valign='bottom'>".date("d-m-y")."</td>
                                        </tr>
                                        <tr>
                                            <td colspan='3' style='overflow: hidden;white-space: nowrap;font-size:16px;font-weight:bold' bgcolor='#FFFFFF' height='15px' valign='top'>".$data['keterangan']."</td>

                                        </tr>";
                    $arrhj = $this->perhitungan_m->gethjbertingkat($val);
                    $font_harga=16;
                    $height_barcode=0.75;
                    if(count($arrhj) == 2){
                        $font_harga=14;
                        $height_barcode=0.50;
                    }else if(count($arrhj) > 2){
                        $font_harga=12;
                        $height_barcode=0.25;
                    }

                    $font_satuan = $font_harga - 4;

                    foreach($arrhj as $keyhj => $valhj){
                        $hjcontent = string_2s($valhj['qtyawal'],0)." sd ". string_2s($valhj['qtyakhir'],0) ." Rp.". string_2s($valhj['hj'],0)." / <font size='".$font_satuan."'> ".$data['satuan']."</font>";
                        $htmlHeader .="<tr>
                                            <td colspan='3' style='text-align:center;overflow: hidden;white-space: nowrap;font-size:".$font_harga."px;font-weight:bold' bgcolor='#FFFFFF' height='15px' valign='top'>".$hjcontent."</td>
                                       </tr>";
                    }
                    
                    $max =4;
                    if((strlen($data['barcode']) == 12 || strlen($data['barcode']) == 13) && $data['barcode'] <> ""){
                        $htmlHeader .=  "<tr>
                                        <td colspan='3' style='text-align:center;'><barcode height='".$height_barcode."' code='".$data['barcode']."' text='".$data['barcode']."' class='barcode' /></td>
                                     </tr>";

                    }else{
                        $barcode = $data['barcode'];
                        if($data['barcode'] == "") $barcode = $data['kode'];
                        $htmlHeader .=  "<tr>
                                        <td colspan='3' style='text-align:center;'><barcode height='".$height_barcode."' type='C128A' code='".$barcode."' class='barcode' /><br/>".$barcode."</td>
                                     </tr>";
                    }

                    /*<barcode height='0.5' code='4974052841781' text='4974052841781' class='barcode' />".$val."*/
                    $htmlHeader .= "</table></td>";
                }
            }
            $htmlHeader .= "</tr>";
        }
        $htmlHeader .= "</table>


            ";
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
            bos.trcetakpricecard.showReport('".$pdfFilePath."');
        ");
    }
}
?>
