
<?php
class Rptpenyusutanasetinv extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("rpt/rptpenyusutanasetinv_m") ;
        $this->load->model("func/perhitungan_m") ;
        $this->bdb 	= $this->rptpenyusutanasetinv_m ;
    } 

    public function index(){
        $this->load->view("rpt/rptpenyusutanasetinv") ; 

    }   

    public function loadgrid(){
        $va     = json_decode($this->input->post('request'), true) ; 
        $vare   = array() ;
        $vdb    = $this->bdb->loadgrid($va) ;
        $dbd    = $vdb['db'] ;
        $arrtgl = explode("-",$va['periode']);
        $tgl = date('d-m-Y',mktime(0,0,0,$arrtgl[0]+1,0,$arrtgl[1]));
        $n = 0 ;
        $tothp = 0 ;
        $totresidu = 0 ;
        $totpenyawal = 0 ;
        $totpenyblnini = 0 ;
        $totpenyakhir = 0 ;
        $totnilaibuku = 0 ;
        
        $subtothp = 0 ;
        $subtotresidu = 0 ;
        $subtotpenyawal = 0 ;
        $subtotpenyblnini = 0 ;
        $subtotpenyakhir = 0 ;
        $subtotnilaibuku = 0 ;

        $cGol = "";
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vs = $dbr;
            $arrpeny = $this->perhitungan_m->getpenyusutan($dbr['kode'],$tgl);

            $vs['penyawal'] = $arrpeny['awal'];
            $vs['penyblnini'] = $arrpeny['bulan ini'];
            $vs['penyakhir'] = $arrpeny['akhir'];
            $vs['nilaibuku'] = $vs['hargaperolehan'] - $vs['penyakhir'];


            $tothp += $vs['hargaperolehan'];
            $totresidu += $vs['residu'];
            $totpenyawal += $vs['penyawal'];
            $totpenyblnini += $vs['penyblnini'];
            $totpenyakhir += $vs['penyakhir'];
            $totnilaibuku += $vs['nilaibuku'];
            
            if($cGol <> $vs['golongan']){
                if($n > 0){
                    $vare[] = array("no" => '', "kode"=> '', "keterangan"=> 'Subtotal',
                                    "cabang"=> '', "golongan"=> '',
                                    "tglperolehan"=> '',"lama"=> '',"hargaperolehan"=> string_2s($subtothp), "unit"=> '',"jenispenyusutan"=> '',
                                    "tarifpenyusutan"=> '',"residu"=>string_2s($subtotresidu),"penyawal"=>string_2s($subtotpenyawal),
                                    "penyblnini"=>string_2s($subtotpenyblnini),"penyakhir"=>string_2s($subtotpenyakhir),
                                    "nilaibuku"=>string_2s($subtotnilaibuku));
                    $vare[] = array("no" => '', "kode"=> '', "keterangan"=> '',
                                "cabang"=> '', "golongan"=> '',"tglperolehan"=> '',"lama"=> '',"hargaperolehan"=> "", "unit"=> '',"jenispenyusutan"=> '',
                                "tarifpenyusutan"=> '',"residu"=>'',"penyawal"=>'',"penyblnini"=>'',
                                "penyakhir"=>'',"nilaibuku"=>'');
                }
                $vare[] = array("no" => '', "kode"=> '', "keterangan"=> '::['.$vs['golongan'].']-'.$vs['ketgolongan'],
                                "cabang"=> '', "golongan"=> '',"tglperolehan"=> '',"lama"=> '',"hargaperolehan"=> "", "unit"=> '',"jenispenyusutan"=> '',
                                "tarifpenyusutan"=> '',"residu"=>'',"penyawal"=>'',"penyblnini"=>'',
                                "penyakhir"=>'',"nilaibuku"=>'');
                $n = 0;
                $subtothp = 0 ;
                $subtotresidu = 0 ;
                $subtotpenyawal = 0 ;
                $subtotpenyblnini = 0 ;
                $subtotpenyakhir = 0 ;
                $subtotnilaibuku = 0 ;
            }
            
            $subtothp += $vs['hargaperolehan'];
            $subtotresidu += $vs['residu'];
            $subtotpenyawal += $vs['penyawal'];
            $subtotpenyblnini += $vs['penyblnini'];
            $subtotpenyakhir += $vs['penyakhir'];
            $subtotnilaibuku += $vs['nilaibuku'];

            $vs['no'] = ++$n ;
            $cGol = $vs['golongan'];                        
            
            $vs['hargaperolehan'] = string_2s($vs['hargaperolehan']);
            $vs['residu'] = string_2s($vs['residu']);
            $vs['penyawal'] = string_2s($vs['penyawal']);
            $vs['penyblnini'] = string_2s($vs['penyblnini']);
            $vs['penyakhir'] = string_2s($vs['penyakhir']);
            $vs['nilaibuku'] = string_2s($vs['nilaibuku']);
            $vare[]		= $vs ;

        }
        if($n > 0){
            $vare[] = array("no" => '', "kode"=> '', "keterangan"=> 'Subtotal',
                            "cabang"=> '', "golongan"=> '',
                            "tglperolehan"=> '',"lama"=> '',"hargaperolehan"=> string_2s($subtothp), "unit"=> '',"jenispenyusutan"=> '',
                            "tarifpenyusutan"=> '',"residu"=>string_2s($subtotresidu),"penyawal"=>string_2s($subtotpenyawal),
                            "penyblnini"=>string_2s($subtotpenyblnini),"penyakhir"=>string_2s($subtotpenyakhir),
                            "nilaibuku"=>string_2s($subtotnilaibuku));
        }
        $vare[] = array("no" => '', "kode"=> '', "keterangan"=> 'TOTAL', "cabang"=> '', "golongan"=> '',
                        "tglperolehan"=> '',"lama"=> '',"hargaperolehan"=> string_2s($tothp), "unit"=> '',"jenispenyusutan"=> '',
                        "tarifpenyusutan"=> '',"residu"=>string_2s($totresidu),"penyawal"=>string_2s($totpenyawal),
                        "penyblnini"=>string_2s($totpenyblnini),"penyakhir"=>string_2s($totpenyakhir),
                        "nilaibuku"=>string_2s($totnilaibuku),"w2ui"=>array("summary"=>true));
        $vare 	= array("total"=>count($vare) - 1, "records"=>$vare ) ;
        $varpt = $vare['records'] ;
        echo(json_encode($vare)) ; 
        savesession($this, "rptpenyusutanasetinv_rpt", json_encode($varpt)) ; 
    }

    public function init(){
        savesession($this, "ssrptpenyusutanasetinv_id", "") ;    
    }


    public function showreport(){
        $data = getsession($this,"rptpenyusutanasetinv_rpt") ;      
        $data = json_decode($data,true) ;      
        if(!empty($data)){  
            $font = 8 ;
            $o    = array('paper'=>'A4', 'orientation'=>'landscape', 'export'=>"",
                          'opt'=>array('export_name'=>'DaftarJurnal_' . getsession($this, "username") ) ) ;
            $this->load->library('bospdf', $o) ;   
            $this->bospdf->ezText("<b>LAPORAN DAFTAR ASET & PENYUSUTAN</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ; 
            $this->bospdf->ezTable($data,"","",  
                                   array("fontSize"=>$font,"cols"=> array( 
                                       "no"=>array("caption"=>"No","width"=>3,"justification"=>"right"),
                                       "kode"=>array("caption"=>"Kode","width"=>5,"justification"=>"center"),
                                       "keterangan"=>array("caption"=>"Keterangan","wrap"=>1),
                                       "cabang"=>array("caption"=>"Cabang","width"=>3),
                                       "golongan"=>array("caption"=>"Golongan","width"=>3),
                                       "tglperolehan"=>array("caption"=>"Tgl Perolehan","width"=>8,"justification"=>"center"),
                                       "lama"=>array("caption"=>"Golongan","width"=>3,"justification"=>"right"),
                                       "hargaperolehan"=>array("caption"=>"Harga Perolehan","width"=>8,"justification"=>"right"),
                                       "unit"=>array("caption"=>"Unit","width"=>3,"justification"=>"right"),
                                       "jenispenyusutan"=>array("caption"=>"Jenis Peny.","width"=>3,"justification"=>"left"),
                                       "tarifpenyusutan"=>array("caption"=>"Tarif Peny.","width"=>3,"justification"=>"right"),
                                       "residu"=>array("caption"=>"N. Residu","width"=>8,"justification"=>"right"),
                                       "penyawal"=>array("caption"=>"Peny. Awal","width"=>8,"justification"=>"right"),
                                       "penyblnini"=>array("caption"=>"Peny. Bln Ini","width"=>8,"justification"=>"right"),
                                       "penyakhir"=>array("caption"=>"Peny. Akhir","width"=>8,"justification"=>"right"),
                                       "nilaibuku"=>array("caption"=>"N. Buku","width"=>8,"justification"=>"right")))) ;   
            //print_r($data) ;    
            $this->bospdf->ezStream() ; 
        }else{
            echo('data kosong') ;
        }
    }


}
?>
