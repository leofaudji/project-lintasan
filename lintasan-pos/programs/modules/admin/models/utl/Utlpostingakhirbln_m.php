<?php
class  Utlpostingakhirbln_m extends Bismillah_Model{

    public function seekcabang($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("cabang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }


    public function postingpenyaset($periode,$cabang){
        $arrtgl = explode("-",$periode);
        $tgl = date('Y-m-d',mktime(0,0,0,$arrtgl[0]+1,0,$arrtgl[1]));

        $fakturlike = "PA".$cabang.date("ym",date_2t($tgl));

        $this->delete("keuangan_jurnal","faktur like '$fakturlike%'");
        $this->delete("keuangan_bukubesar","faktur like '$fakturlike%'");

        $faktur = $this->getlastfaktur("PA",$cabang,$tgl,true,15);
        
        $arrdata = array();

        $where    = "a.cabang = '$cabang' and a.tglperolehan <= '$tgl'";
        $join     = "left join aset_golongan g on g.kode = a.golongan left join cabang c on c.kode = a.cabang";
        $field    = "a.kode,a.keterangan,a.golongan,g.keterangan as ketgolongan,a.cabang, c.keterangan as ketcabang,a.lama,a.tglperolehan,a.hargaperolehan,a.unit,
                    a.jenispenyusutan,a.tarifpenyusutan,a.residu,g.rekakmpeny,g.rekbypeny";
        $dbd      = $this->select("aset a", $field, $where, $join, "", "a.golongan asc,a.kode ASC") ;
        while( $dbr = $this->getrow($dbd) ){
            if(!isset($arrdata[$dbr['golongan']]))$arrdata[$dbr['golongan']] = array("keterangan"=>$dbr['ketgolongan'],"penyusutan"=>0,"rekdebet"=>$dbr['rekbypeny'],"rekkredit"=>$dbr['rekakmpeny']);
            $arrpeny = $this->perhitungan_m->getpenyusutan($dbr['kode'],$tgl);
            $arrdata[$dbr['golongan']]['penyusutan'] += $arrpeny['bulan ini'];
        }
        
        $datetime = date("Y-m-d H:i:s");
        $username = getsession($this,"username") ;
        foreach($arrdata as $key => $val){
            $keterangan = "Penyusutan ".$val['keterangan']." [".$periode."]";

            $this->updtransaksi_m->updjurnal($faktur,$cabang,$tgl,$val['rekdebet'],$keterangan,$val['penyusutan'],0,$datetime,$username);
            $this->updtransaksi_m->updjurnal($faktur,$cabang,$tgl,$val['rekkredit'],$keterangan,0,$val['penyusutan'],$datetime,$username);
        }
        $this->updtransaksi_m->updrekjurnal($faktur);
    }
}
?>