
<?php
class Rpttriwulan extends Bismillah_Controller{
    protected $bdb ;
    public function __construct(){
        parent::__construct() ;
        $this->load->model("rpt/rpttriwulan_m") ;
        $this->load->model("func/perhitungan_m") ;
        $this->bdb 	= $this->rpttriwulan_m ;
        $this->ss  = "ssrpttriwulan_" ;
    }  

    public function index(){ 

        $data['rekarkpjawal']= $this->bdb->getconfig("rekarkpjawal") ;
        $data['ketrekarkpjawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpjawal']}'", "keuangan_rekening");
        $data['rekarkpjakhir']= $this->bdb->getconfig("rekarkpjakhir") ;
        $data['ketrekarkpjakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpjakhir']}'", "keuangan_rekening");
        $data['rekarkkbawal']= $this->bdb->getconfig("rekarkkbawal") ;
        $data['ketrekarkkbawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkkbawal']}'", "keuangan_rekening");
        $data['rekarkkbakhir']= $this->bdb->getconfig("rekarkkbakhir") ;
        $data['ketrekarkkbakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkkbakhir']}'", "keuangan_rekening");
        $data['rekarkpiutangawal']= $this->bdb->getconfig("rekarkpiutangawal") ;
        $data['ketrekarkpiutangawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpiutangawal']}'", "keuangan_rekening");
        $data['rekarkpiutangakhir']= $this->bdb->getconfig("rekarkpiutangakhir") ;
        $data['ketrekarkpiutangakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpiutangakhir']}'", "keuangan_rekening");
        $data['rekarkpsdawal']= $this->bdb->getconfig("rekarkpsdawal") ;
        $data['ketrekarkpsdawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpsdawal']}'", "keuangan_rekening");
        $data['rekarkpsdakhir']= $this->bdb->getconfig("rekarkpsdakhir") ;
        $data['ketrekarkpsdakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpsdakhir']}'", "keuangan_rekening");
        $data['rekarkpsktawal']= $this->bdb->getconfig("rekarkpsktawal") ;
        $data['ketrekarkpsktawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpsktawal']}'", "keuangan_rekening");
        $data['rekarkpsktakhir']= $this->bdb->getconfig("rekarkpsktakhir") ;
        $data['ketrekarkpsdktakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkpsktakhir']}'", "keuangan_rekening");
        $data['rekarkatawal']= $this->bdb->getconfig("rekarkatawal") ;
        $data['ketrekarkatawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkatawal']}'", "keuangan_rekening");
        $data['rekarkatakhir']= $this->bdb->getconfig("rekarkatakhir") ;
        $data['ketrekarkatakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkatakhir']}'", "keuangan_rekening");
        $data['rekarkatwawal']= $this->bdb->getconfig("rekarkatwawal") ;
        $data['ketrekarkatwawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkatwawal']}'", "keuangan_rekening");
        $data['rekarkatwakhir']= $this->bdb->getconfig("rekarkatwakhir") ;
        $data['ketrekarkatwakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkatwakhir']}'", "keuangan_rekening");
        $data['rekarkallawal']= $this->bdb->getconfig("rekarkallawal") ;
        $data['ketrekarkallawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkallawal']}'", "keuangan_rekening");
        $data['rekarkallakhir']= $this->bdb->getconfig("rekarkallakhir") ;
        $data['ketrekarkallakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkallakhir']}'", "keuangan_rekening");
        $data['rekarkhdawal']= $this->bdb->getconfig("rekarkhdawal") ;
        $data['ketrekarkhdawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkhdawal']}'", "keuangan_rekening");
        $data['rekarkhdakhir']= $this->bdb->getconfig("rekarkhdakhir") ;
        $data['ketrekarkhdakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkhdakhir']}'", "keuangan_rekening");
        $data['rekarkhbawal']= $this->bdb->getconfig("rekarkhbawal") ;
        $data['ketrekarkhbawal'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkhbawal']}'", "keuangan_rekening");
        $data['rekarkhbakhir']= $this->bdb->getconfig("rekarkhbakhir") ;
        $data['ketrekarkhbakhir'] = $this->bdb->getval("keterangan", "kode = '{$data['rekarkhbakhir']}'", "keuangan_rekening");


        $this->load->view("rpt/rpttriwulan",$data) ; 

    }

    public function saving(){
        $va 	= $this->input->post() ;
        $this->bdb->saveconfig("rekarkpjawal", $va['rekarkpjawal']) ;
        $this->bdb->saveconfig("rekarkpjakhir", $va['rekarkpjakhir']) ;
        $this->bdb->saveconfig("rekarkkbawal", $va['rekarkkbawal']) ;
        $this->bdb->saveconfig("rekarkkbakhir", $va['rekarkkbakhir']) ;
        $this->bdb->saveconfig("rekarkpiutangawal", $va['rekarkpiutangawal']) ;
        $this->bdb->saveconfig("rekarkpiutangakhir", $va['rekarkpiutangakhir']) ;
        $this->bdb->saveconfig("rekarkpsdawal", $va['rekarkpsdawal']) ;
        $this->bdb->saveconfig("rekarkpsdakhir", $va['rekarkpsdakhir']) ;
        $this->bdb->saveconfig("rekarkpsktawal", $va['rekarkpsktawal']) ;
        $this->bdb->saveconfig("rekarkpsktakhir", $va['rekarkpsktakhir']) ;
        $this->bdb->saveconfig("rekarkatawal", $va['rekarkatawal']) ;
        $this->bdb->saveconfig("rekarkatakhir", $va['rekarkatakhir']) ;
        $this->bdb->saveconfig("rekarkatwawal", $va['rekarkatwawal']) ;
        $this->bdb->saveconfig("rekarkatwakhir", $va['rekarkatwakhir']) ;
        $this->bdb->saveconfig("rekarkallawal", $va['rekarkallawal']) ;
        $this->bdb->saveconfig("rekarkallakhir", $va['rekarkallakhir']) ;
        $this->bdb->saveconfig("rekarkhdawal", $va['rekarkhdawal']) ;
        $this->bdb->saveconfig("rekarkhdakhir", $va['rekarkhdakhir']) ;
        $this->bdb->saveconfig("rekarkhbawal", $va['rekarkhbawal']) ;
        $this->bdb->saveconfig("rekarkhbakhir", $va['rekarkhbakhir']) ;

        echo('bos.rpttriwulan.settab(0) ') ;
    }

    public function seekrekening(){
        $search     = $this->input->get('q');
        $vdb    = $this->bdb->seekrekening($search) ;
        $dbd    = $vdb['db'] ;
        $vare   = array();
        while( $dbr = $this->bdb->getrow($dbd) ){
            $vare[] 	= array("id"=>$dbr['kode'], "text"=>$dbr['kode'] ." - ".$dbr['keterangan']) ;
        }
        $Result = json_encode($vare);
        echo($Result) ;
    }

    public function loadgrid(){ 

        $va     = json_decode($this->input->post('request'), true) ; 
        $arrtw = array("I","II","III","IV");
        $vare   = array() ;
        $arrdata = array();
        $arrperiod = explode("-",$va['periode']);
        for($i=1;$i>=0;$i--){
            $bulan = $arrperiod[0]-($i*3);
            $thn = $arrperiod[1];
            if($bulan < 1){
                $blnthn = (($bulan * -1) / 12) + 1;
                $blnthn = floor($blnthn);
                $thn = $thn - $blnthn;
                $bulan = 12 + $bulan; // ditambahkan karena $bulan isinya minus
                //$arrperiod[0] = 12;
            }
            $frtriwulan = devide($bulan,3);
            $frtriwulan = ceil($frtriwulan) ;

            $bln = $frtriwulan*3;
            $time = mktime(0,0,0,$bln+1,0,$thn);//"01-".$val['bln']."-".$thn;
            $tglakhir = date("d-m-Y",$time);

            $time2 = mktime(0,0,0,$bln-2,1,$thn);//"01-".$val['bln']."-".$thn;
            $tglawal = date("d-m-Y",$time2);

            $arrdata[] = array("frtriwulan"=>$frtriwulan,"bln"=>$bln,"thn"=>$thn,"tglawal"=>$tglawal,"tglakhir"=>$tglakhir);
        }
        //print_r($arrdata);

        $n = 0 ;

        $arrd = array();
        //laba usaha
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Laba Usaha";
        $arrtwlr = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $arrlr = $this->perhitungan_m->getlr($val['tglawal'],$val['tglakhir']);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] =string_2s($arrlr['lrstlhpjk']['saldoakhirperiod']);
            $arrtwlr[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $arrlr['lrstlhpjk']['saldoakhirperiod'];

            $i++;
            if($i == 1){
                $t1 = $arrlr['lrstlhpjk']['saldoakhirperiod'];
            }else{
                $t2 = $arrlr['lrstlhpjk']['saldoakhirperiod'];
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;
        //print_r($arrd);

        //penjualan
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Penjualan";
        $arrpj = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkpjawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkpjakhir") ;
            $debet = $this->perhitungan_m->getdebet($val['tglawal'],$val['tglakhir'],$rekening,'',$rekening2);
            $kredit = $this->perhitungan_m->getkredit($val['tglawal'],$val['tglakhir'],$rekening,'',$rekening2);
            $jumlah = $kredit - $debet;
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrpj[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;

            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //aktiva
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Aktiva";
        $arraktiva = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = "1";
            $rekening2 = "1.9999";
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            //$kredit = $this->perhitungan_m->getkredit($val['tglawal'],$val['tglakhir'],$rekening,'',$rekening2);
            //$jumlah = $debet - $kredit;
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arraktiva[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //space
        $arrd['no'] = "";
        $arrd['keterangan'] = "";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        //saldo
        $arrd['no'] = "";
        $arrd['keterangan'] = "<b>Saldo</b>";
        foreach($arrdata as $key =>$val){

            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "<b>".$val['tglakhir']."</b>";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        //kas dan bank
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Kas dan Bank";
        $arrkb = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkkbawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkkbakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrkb[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;


        //piutang
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Piutang";
        $arrpiut = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkpiutangawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkpiutangakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrpiut[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //persediaan
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Persediaan";
        $arrpersd= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkpsdawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkpsdakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrpersd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //porskot
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Porskot";
        $arrpskt= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkpsktawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkpsktakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrpskt[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //Jml aktiva lancar
        $arrd['no'] = "";
        $arrd['keterangan'] = "<b><i>Jumlah Aktiva Lancar</i></b>";
        $arrjmlaktivalcr= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = $arrkb[$key2] + $arrpiut[$key2]  + $arrpersd[$key2] + $arrpskt[$key2];
            $arrd[$key2] = "<b>".string_2s($jumlah)."</b>";
            $arrjmlaktivalcr[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare[] = $arrd;

        //space
        $arrd['no'] = "";
        $arrd['keterangan'] = "";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        //Aktiva Tetap
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Aktiva Tetap";
        $arrat= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkatawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkatakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrat[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //Aktiva Tidak Berwujud
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Aktiva Tidak Berwujud";
        $arratw= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkatwawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkatwakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arratw[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //Aktiva Lain-Lain
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Aktiva Lain-Lain";
        $arrall= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkallawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkallakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrall[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //Jml aktiva tetap
        $arrd['no'] = "";
        $arrd['keterangan'] = "<b><i>Jumlah Aktiva Tetap</i></b>";
        $arrjmlaktivat= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = $arrat[$key2] + $arratw[$key2]  + $arrall[$key2];
            $arrd[$key2] = "<b>".string_2s($jumlah)."</b>";
            $arrjmlaktivat[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare[] = $arrd;

        $arrd['no'] = "";
        $arrd['keterangan'] = "<b><i>Total Aktiva</i></b>";
        $arrtotaktiva= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = $arrjmlaktivalcr[$key2] + $arrjmlaktivat[$key2];
            $arrd[$key2] = "<b>".string_2s($jumlah)."</b>";
            $arrtotaktiva[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare[] = $arrd;

        //space
        $arrd['no'] = "";
        $arrd['keterangan'] = "";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Hutang Dagang";
        $arrhd= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkhdawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkhdakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrhd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Hutang Bank/ Jangka Panjang";
        $arrhb= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkhbawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkhbakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrhb[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //JML HUTANG
        $arrd['no'] = "";
        $arrd['keterangan'] = "<b><i>Jumlah Hutang</i></b>";
        $arrjmlhut= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = $arrhd[$key2] + $arrhb[$key2];
            $arrd[$key2] = "<b>".string_2s($jumlah)."</b>";
            $arrjmlhut[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare[] = $arrd;


        //space
        $arrd['no'] = "";
        $arrd['keterangan'] = "";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        //ark
        $arrd['no'] = "";
        $arrd['keterangan'] = "<b>ANALISA RATIO KEUANGAN</b>";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        //profit margin
        $arrd['no'] = "1";
        $arrd['keterangan'] = "<b>Profit Margin</b>";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        //profit margin
        $arrd['no'] = "";
        $arrd['keterangan'] = "Ratio laba dibanduingkan dengan penjualan";
        $arrratio1= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = devide($arrtwlr[$key2],$arrpj[$key2]) * 100;
            $arrd[$key2] = string_2s($jumlah)."%";
            $arrratio1[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $arrd['pers'] = devide($t1,$t2) * 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare[] = $arrd;


        //ROA
        $arrd['no'] = "2";
        $arrd['keterangan'] = "<b>Return on Assets</b>";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        //roa
        $arrd['no'] = "";
        $arrd['keterangan'] = "Ratio laba dibanduingkan dengan aktiva";
        $arrratio2= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = devide($arrtwlr[$key2],$arraktiva[$key2]) * 100;
            $arrd[$key2] = string_2s($jumlah)."%";
            $arrratio2[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $arrd['pers'] = devide($t1,$t2) * 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare[] = $arrd;

        //curr ratio
        $arrd['no'] = "3";
        $arrd['keterangan'] = "<b>Current Ratio</b>";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare[] = $arrd;

        //curr ratio
        $arrd['no'] = "";
        $arrd['keterangan'] = "Aktiva lancar dibanding dengan hutang";
        $arrratio3= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = devide($arrjmlaktivalcr[$key2],$arrhd[$key2]) * 100;
            $arrd[$key2] = string_2s($jumlah)."%";
            $arrratio3[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $arrd['pers'] = devide($t1,$t2) * 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare[] = $arrd;

        $vare 	= array("total"=>count($vare), "records"=>$vare ) ; 
        echo(json_encode($vare)) ; 
    }

    public function initreport(){
        $n=0;
        $va     = $this->input->post() ;
        savesession($this, $this->ss . "va", json_encode($va) ) ;
        echo(' bos.rpttriwulan.openreport() ; ') ;
    }

    public function showreport(){
        $va   = json_decode(getsession($this, $this->ss . "va", "{}"), true) ;
        $arrkolom = array();
        $arrkolom2 = array();
        $arrkolom3 = array();
        $arrkolom['no'] = array("caption"=>"No","width"=>5,"justification"=>"right");
        $arrkolom['keterangan'] = array("caption"=>"Keterangan","wrap"=>1);
        $arrkolom2['keterangan'] = array("caption"=>"Keterangan","wrap"=>1);
        $arrkolom3['no'] = array("caption"=>"No","width"=>5,"justification"=>"right");
        $arrkolom3['keterangan'] = array("caption"=>"Keterangan","wrap"=>1);
        $arrkolom4['no'] = array("caption"=>"No","width"=>5,"justification"=>"right");
        $arrkolom4['keterangan'] = array("caption"=>"Keterangan","wrap"=>1);

        $arrtw = array("I","II","III","IV");
        $vare   = array() ;
        $arrdata = array();
        $arrperiod = explode("-",$va['periode']);
        for($i=1;$i>=0;$i--){
            $bulan = $arrperiod[0]-($i*3);
            $thn = $arrperiod[1];
            if($bulan < 1){
                $blnthn = (($bulan * -1) / 12) + 1;
                $blnthn = floor($blnthn);
                $thn = $thn - $blnthn;
                $bulan = 12 + $bulan; // ditambahkan karena $bulan isinya minus
            }
            $frtriwulan = devide($bulan,3);
            $frtriwulan = ceil($frtriwulan) ;

            $bln = $frtriwulan*3;
            $time = mktime(0,0,0,$bln+1,0,$thn);//"01-".$val['bln']."-".$thn;
            $tglakhir = date("d-m-Y",$time);

            $time2 = mktime(0,0,0,$bln-2,1,$thn);//"01-".$val['bln']."-".$thn;
            $tglawal = date("d-m-Y",$time2);

            $arrkolom[$arrtw[$frtriwulan - 1]."-".$thn] = array("caption"=>"Triwulan ".$arrtw[$frtriwulan - 1]." ".$thn,"width"=>20,"justification"=>"right");
            $arrkolom2[$arrtw[$frtriwulan - 1]."-".$thn] = array("caption"=>$tglakhir,"width"=>20,"justification"=>"right");
            $arrkolom3[$arrtw[$frtriwulan - 1]."-".$thn] = array("caption"=>$tglakhir,"width"=>20,"justification"=>"right");
            $arrkolom4[$arrtw[$frtriwulan - 1]."-".$thn] = array("caption"=>$tglakhir,"width"=>20,"justification"=>"right");
            $arrdata[] = array("frtriwulan"=>$frtriwulan,"bln"=>$bln,"thn"=>$thn,"tglawal"=>$tglawal,"tglakhir"=>$tglakhir);
        }

        $n = 0 ;

        $arrd = array();
        //laba usaha
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Laba Usaha";
        $arrtwlr = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $arrlr = $this->perhitungan_m->getlr($val['tglawal'],$val['tglakhir']);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($arrlr['lrstlhpjk']['saldoakhirperiod']);
            $arrtwlr[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $arrlr['lrstlhpjk']['saldoakhirperiod'];

            $i++;
            if($i == 1){
                $t1 = $arrlr['lrstlhpjk']['saldoakhirperiod'];
            }else{
                $t2 = $arrlr['lrstlhpjk']['saldoakhirperiod'];
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //penjualan
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Penjualan";
        $arrpj = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkpjawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkpjakhir") ;
            $debet = $this->perhitungan_m->getdebet($val['tglawal'],$val['tglakhir'],$rekening,'',$rekening2);
            $kredit = $this->perhitungan_m->getkredit($val['tglawal'],$val['tglakhir'],$rekening,'',$rekening2);
            $jumlah = $kredit - $debet;
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrpj[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;

            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        //aktiva
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Aktiva";
        $arraktiva = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = "1";
            $rekening2 = "1.9999";
            /*$debet = $this->perhitungan_m->getdebet($val['tglawal'],$val['tglakhir'],$rekening,'',$rekening2);
            $kredit = $this->perhitungan_m->getkredit($val['tglawal'],$val['tglakhir'],$rekening,'',$rekening2);
            $jumlah = $debet - $kredit;*/
             $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arraktiva[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare[] = $arrd;

        $vare2 = array();
        $arrd = array();
        $arrd['keterangan'] = "<b>Saldo";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $val['tglakhir'];
        }
        $arrd['pers'] = "</b>";
        $vare2[]=$arrd;

        //kas dan bank
        $n++;
        $arrd = array();
        $vare3 = array();
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Kas dan Bank";
        $arrkb = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkkbawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkkbakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrkb[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;


        //piutang
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Piutang";
        $arrpiut = array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkpiutangawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkpiutangakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrpiut[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;

        //persediaan
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Persediaan";
        $arrpersd= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkpsdawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkpsdakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrpersd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;

        //porskot
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Porskot";
        $arrpskt= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkpsktawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkpsktakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrpskt[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;

        //Jml aktiva lancar
        $arrd['no'] = "";
        $arrd['keterangan'] = "<b>Jumlah Aktiva Lancar";
        $arrjmlaktivalcr= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = $arrkb[$key2] + $arrpiut[$key2]  + $arrpersd[$key2] + $arrpskt[$key2];
            $arrd[$key2] = string_2s($jumlah);
            $arrjmlaktivalcr[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] =string_2s($arrd['pers'])."%</b>";
        $vare3[] = $arrd;

        //space
        $arrd['no'] = "";
        $arrd['keterangan'] = "";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare3[] = $arrd;

        //Aktiva Tetap
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Aktiva Tetap";
        $arrat= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkatawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkatakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrat[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;

        //Aktiva Tidak Berwujud
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Aktiva Tidak Berwujud";
        $arratw= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkatwawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkatwakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arratw[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;

        //Aktiva Lain-Lain
        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Aktiva Lain-Lain";
        $arrall= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkallawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkallakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrall[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;

        //Jml aktiva tetap
        $arrd['no'] = "";
        $arrd['keterangan'] = "<b>Jumlah Aktiva Tetap";
        $arrjmlaktivat= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = $arrat[$key2] + $arratw[$key2]  + $arrall[$key2];
            $arrd[$key2] = string_2s($jumlah);
            $arrjmlaktivat[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] =string_2s($arrd['pers'])."%</b>";
        $vare3[] = $arrd;

        $arrd['no'] = "";
        $arrd['keterangan'] = "<b>Total Aktiva";
        $arrtotaktiva= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = $arrjmlaktivalcr[$key2] + $arrjmlaktivat[$key2];
            $arrd[$key2] = string_2s($jumlah);
            $arrtotaktiva[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] =string_2s($arrd['pers'])."%</b>";
        $vare3[] = $arrd;

        //space
        $arrd['no'] = "";
        $arrd['keterangan'] = "";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare3[] = $arrd;

        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Hutang Dagang";
        $arrhd= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkhdawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkhdakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrhd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;

        $n++;
        $arrd['no'] = $n;
        $arrd['keterangan'] = "Hutang Bank/ Jangka Panjang";
        $arrhb= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $rekening = $this->bdb->getconfig("rekarkhbawal") ;
            $rekening2 = $this->bdb->getconfig("rekarkhbakhir") ;
            $jumlah = $this->perhitungan_m->getsaldo($val['tglakhir'],$rekening,$rekening2);
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = string_2s($jumlah);
            $arrhb[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1) * 100;
        $arrd['pers'] = string_2s($arrd['pers'])."%";
        $vare3[] = $arrd;

        //JML HUTANG
        $arrd['no'] = "";
        $arrd['keterangan'] = "<b>Jumlah Hutang";
        $arrjmlhut= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = $arrhd[$key2] + $arrhb[$key2];
            $arrd[$key2] = string_2s($jumlah);
            $arrjmlhut[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $selisih = $t2 - $t1;
        $arrd['pers'] = devide($selisih,$t1)* 100;
        $arrd['pers'] =string_2s($arrd['pers'])."%</b>";
        $vare3[] = $arrd;

        //ark
        $vare4 = array();
        $arrd = array();


        //profit margin
        $arrd['no'] = "1";
        $arrd['keterangan'] = "<b>Profit Margin</b>";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare4[] = $arrd;

        //profit margin
        $arrd['no'] = "";
        $arrd['keterangan'] = "Ratio laba dibandingkan dengan penjualan";
        $arrratio1= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = devide($arrtwlr[$key2],$arrpj[$key2]) * 100;
            $arrd[$key2] = string_2s($jumlah)."%";
            $arrratio1[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $arrd['pers'] = devide($t1,$t2) * 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare4[] = $arrd;


        //ROA
        $arrd['no'] = "2";
        $arrd['keterangan'] = "<b>Return on Assets</b>";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare4[] = $arrd;

        //roa
        $arrd['no'] = "";
        $arrd['keterangan'] = "Ratio laba dibanduingkan dengan aktiva";
        $arrratio2= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = devide($arrtwlr[$key2],$arraktiva[$key2]) * 100;
            $arrd[$key2] = string_2s($jumlah)."%";
            $arrratio2[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $arrd['pers'] = devide($t1,$t2) * 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare4[] = $arrd;

        //curr ratio
        $arrd['no'] = "3";
        $arrd['keterangan'] = "<b>Current Ratio</b>";
        foreach($arrdata as $key =>$val){
            $arrd[$arrtw[$val['frtriwulan'] - 1]."-".$val['thn']] = "";
        }
        $arrd['pers'] = "";
        $vare4[] = $arrd;

        //curr ratio
        $arrd['no'] = "";
        $arrd['keterangan'] = "Aktiva lancar dibanding dengan hutang";
        $arrratio3= array();
        $t2 = 0 ;
        $t1 = 0 ;
        $i =0;
        foreach($arrdata as $key =>$val){
            $key2 = $arrtw[$val['frtriwulan'] - 1]."-".$val['thn'];
            $jumlah = devide($arrjmlaktivalcr[$key2],$arrhd[$key2]) * 100;
            $arrd[$key2] = string_2s($jumlah)."%";
            $arrratio3[$key2] = $jumlah;
            $i++;
            if($i == 1){
                $t1 = $jumlah;
            }else{
                $t2 = $jumlah;
            }
        }
        $arrd['pers'] = devide($t1,$t2) * 100;
        $arrd['pers'] ="<b>".string_2s($arrd['pers'])."%</b>";
        $vare4[] = $arrd;

        $arrkolom['pers'] = array("caption"=>"%","width"=>12,"justification"=>"right");
        $arrkolom2['pers'] = array("caption"=>"%","width"=>12,"justification"=>"right");
        $arrkolom3['pers'] = array("caption"=>"%","width"=>12,"justification"=>"right");
        $arrkolom4['pers'] = array("caption"=>"%","width"=>12,"justification"=>"right");

        if(!empty($vare)){ 
            $font = 10 ;
            $o    = array('paper'=>'A4', 'orientation'=>'portrait', 'export'=>"",
                          'opt'=>array('export_name'=>'DaftarNeraca_' . getsession($this, "username") ) ) ;
            $this->load->library('bospdf', $o) ;   
            $this->bospdf->ezText("<b>ANALISA RATIO KEUANGAN TRIWULAN</b>",$font+4,array("justification"=>"center")) ;
            $this->bospdf->ezText("") ; 
            $this->bospdf->ezTable($vare,"","",  
                                   array("showHeadings"=>1,"showLines"=>2,"fontSize"=>$font,"cols"=>$arrkolom)) ;   
            //print_r($data) ;
            $this->bospdf->ezText("") ;
            $this->bospdf->ezTable($vare2,"","",  
                                   array("showHeadings"=>0,"showLines"=>0,"fontSize"=>$font,"cols"=>$arrkolom2)) ;   
            $this->bospdf->ezTable($vare3,"","",  
                                   array("showHeadings"=>0,"showLines"=>2,"fontSize"=>$font,"cols"=>$arrkolom3)) ;   
            
            $this->bospdf->ezText("") ;
            $this->bospdf->ezText("<b>ANALISA RATIO KEUANGAN </b>") ;
            $this->bospdf->ezTable($vare4,"","",  
                                   array("showHeadings"=>0,"showLines"=>0,"fontSize"=>$font,"cols"=>$arrkolom4)) ;   
            $this->bospdf->ezStream() ; 
        }else{
            echo('data kosong') ;
        }
    }
}
?>
