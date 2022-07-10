<?php

class Rptperintahproduksi_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit      = $va['offset'].",".$va['limit'] ;
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where      = array() ;
        if($search !== "") $where[] = "t.faktur LIKE '%{$search}%'" ;
        $where[]    = "t.tgl >= '{$va['tglAwal']}' and t.tgl <= '{$va['tglAkhir']}'";
        $where[]    = "t.status = '1'";
        $where      = implode(" AND ", $where) ;
        $field      = "t.faktur,t.tgl,t.hargapokok,t.bb,t.btkl,t.bop";
        $cJoin      = "";
        $dbd        = $this->select("produksi_total t", $field, $where, $cJoin ,"", "t.faktur ASC", $limit) ;
        $dba        = $this->select("produksi_total t", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetailPP($cFaktur){
        $cField = "s.kode,s.keterangan,s.satuan,b.qty,b.hp,b.jmlhp";
        $cJoin  = "LEFT JOIN stock s ON s.kode = b.stock " ;
        $cWhere = "b.faktur = '".$cFaktur."'" ;
        $dbData = $this->select("produksi_bb_standart b",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $cField = "t.faktur,t.tgl,t.hargapokok,t.bb,t.btkl,t.bop,p.stock,s.keterangan,t.perbaikan,
                    s.satuan,p.qty,p.bb,p.btkl,p.bop,p.hargapokok,p.jumlah,p.hargapokokperbaikan,p.jumlahperbaikan";
        $cWhere = "t.faktur = '".$faktur."'" ;
        $vaJoin = "left join produksi_produk p on p.fakturproduksi = t.faktur left join stock s on s.kode = p.stock" ;
        $dbData = $this->select("produksi_total t",$cField,$cWhere,$vaJoin) ;
        if($dbr = $this->getrow($dbData)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalPP($dTglAwal,$dTglAkhir){
        $cField = "t.faktur,  t.tgl, t.hargapokok,t.bb,t.btkl,t.bop" ;
        $cWhere = "tgl >= '".$dTglAwal."' AND tgl <= '".$dTglAkhir."'" ;
        $cJoin  = "" ;
        $dbData = $this->select("produksi_total t",$cField,$cWhere,$cJoin);
        return $dbData ;
    }

}
