<?php
class Rptaruskas_m extends Bismillah_Model{
    public function seekrekening($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%') and jenis = 'D'" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function loadrekeningstt($stt,$jenis=""){
        $where = "aruskas ='$stt'" ;
        if($jenis <> "") $where .= " and jenis = '$jenis'";
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC") ;
        return $dbd ;
    }

    public function loadfakturtrkas($tglawal,$tglakhir){
        $tglawal = date_2s($tglawal);
        $tglakhir = date_2s($tglakhir);

        $arrreturn = array();


        $arrwhere = array();
        $where = "r.aruskas ='k' and b.tgl >= '$tglawal' and b.tgl <= '$tglakhir'" ;
        $join = "left join keuangan_rekening r on r.kode = b.rekening";
        $dbd      = $this->select("keuangan_bukubesar b", "b.faktur", $where, $join, "b.faktur", "b.faktur ASC") ;
        while($dbr = $this->getrow($dbd)){
            $arrwhere[] = "b.faktur = '{$dbr['faktur']}'";
        }


        $wherefkt = implode(" or ",$arrwhere);
        $dbd2      = $this->select("keuangan_rekening", "kode") ;
        while($dbr2 = $this->getrow($dbd2)){
            $arrreturn[$dbr2['kode']] = array("sumberdana"=>0,"penggunaan"=>0);
            if($wherefkt <> ""){
                $rekening = $dbr2['kode'];
                $where3 = "r.aruskas <> 'k' and b.rekening like '$rekening%' and (".$wherefkt.")" ;


                $join3 = "left join keuangan_rekening r on r.kode = b.rekening";
                $dbd3      = $this->select("keuangan_bukubesar b", "b.rekening,sum(b.debet) as debet,sum(b.kredit) as kredit", $where3, $join3, "", "") ;
                if($dbr3 = $this->getrow($dbd3)){
                    $arrreturn[$dbr2['kode']]['sumberdana'] += $dbr3['kredit'];
                    $arrreturn[$dbr2['kode']]['penggunaan'] += $dbr3['debet'];
                }
            }

        }
        /* $faktur = $dbr['faktur'];
            $join3 = "left join keuangan_rekening r on r.kode = b.rekening";
            $where3 = "r.aruskas <> 'k'";
            $dbd3      = $this->select("keuangan_bukubesar b", "b.rekening,b.debet,b.kredit", $where3, $join3, "b.faktur", "b.faktur ASC") ;
            while($dbr3 = $this->getrow($dbd3) ){
                $arrreturn[$dbr3['rekening']]['sumberdana'] += $dbr3['kredit'];
                $arrreturn[$dbr3['rekening']]['penggunaan'] += $dbr3['debet'];
            }*/
        return $arrreturn ;
    }
}
?>
