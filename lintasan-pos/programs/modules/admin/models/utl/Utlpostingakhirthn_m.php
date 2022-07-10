<?php
class  Utlpostingakhirthn_m extends Bismillah_Model{

    public function seekcabang($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("cabang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }


    public function postingakhirthn($periode,$cabang){
        $tgl = date('Y-m-d',mktime(0,0,0,12,31,$periode));
        $fakturlike = "TH".$periode.$cabang;
        $faktur = "TH".$periode.$cabang."0000001";
        $this->delete("keuangan_jurnal","faktur like '$fakturlike%'");
        $this->delete("keuangan_bukubesar","faktur like '$fakturlike%'");
        $datetime = date("Y-m-d H:i:s");
        $username = getsession($this,"username") ;
        $keterangan = "Posting Akhir Tahun";
        $rekthnjln = $this->getconfig("reklrthberjalan");
        $where    = "(kode >= '4' or kode = '$rekthnjln') and jenis = 'D'";
        $join     = "";
        $field    = "kode,keterangan";
        $dbd      = $this->select("keuangan_rekening", $field, $where, $join, "", "kode asc") ;
        $totdebet = 0;
        $totkredit = 0;
        while( $dbr = $this->getrow($dbd)){
            $saldo = $this->perhitungan_m->getsaldo($tgl,$dbr['kode'],$dbr['kode']);
            $c = substr($dbr['kode'],0,1) ;
            $debet = 0 ;
            $kredit = 0 ;
            if($c == "1" || $c == "5" || $c == "6" || $c == "8" || $c == "9"){
                if($saldo>0){
                    $kredit = $saldo ;
                }else{
                    $debet = $saldo * -1;
                }
            }else{
                if($saldo>0){
                    $debet = $saldo ;
                }else{
                    $kredit = $saldo * -1;
                }
            }
            $totdebet += $debet;
            $totkredit += $kredit;
            $this->updtransaksi_m->updjurnal($faktur,$cabang,$tgl,$dbr['kode'],$keterangan,$debet,$kredit,$datetime,$username);
        }
        $lrthnlalu = $totdebet - $totkredit;
        if($lrthnlalu <> 0){
            $debet = 0 ;
            $kredit = 0 ;
            if($lrthnlalu > 0){
                $kredit = $lrthnlalu;
            }else{
                $debet = $lrthnlalu;
            }
            $rekthnlalu = $this->getconfig("reklrthlalu");
            $this->updtransaksi_m->updjurnal($faktur,$cabang,$tgl,$rekthnlalu,$keterangan,$debet,$kredit,$datetime,$username);
        }
        $this->updtransaksi_m->updrekjurnal($faktur);
    }
}
?>