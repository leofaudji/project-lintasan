<?php

class Rpthasilproduksi_m extends Bismillah_Model{

    public function loadgrid($va){
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where      = array() ;
        if($search !== "") $where[] = "(h.faktur LIKE '%{$search}%'or h.fakturproduksi LIKE '%{$search}%')" ;
        $where[]    = "h.tgl >= '{$va['tglAwal']}' and h.tgl <= '{$va['tglAkhir']}'";
        $where[]    = "h.status = '1'";
        $where      = implode(" AND ", $where) ;
        $field      = "h.faktur,h.tgl,h.fakturproduksi,h.qty as qtyaktual,(h.qty * h.hp) as aktual,t.hargapokok as std,sum(p.qty) as qtystd";
        $cJoin      = "left join produksi_total t on t.faktur = h.fakturproduksi left join produksi_produk p on p.fakturproduksi = t.faktur";
        $dbd        = $this->select("produksi_hasil h", $field, $where, $cJoin ,"h.faktur", "h.faktur ASC") ;
        $dba        = $this->select("produksi_hasil h", "h.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getDetailPH($cFaktur){
        $cField = "s.kode,s.keterangan,s.satuan,b.qty,b.hp,(b.qty * b.hp) as jmlhp";
        $cJoin  = "LEFT JOIN stock s ON s.kode = b.stock " ;
        $cWhere = "b.fakturproduksi = '".$cFaktur."' and b.status = '1'" ;
        $dbData = $this->select("produksi_bb b",$cField,$cWhere,$cJoin) ;
        return $dbData ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $cField = "h.faktur,h.tgl,h.hp as hargapokok,(h.hp * h.qty) as jumlah,t.btkl,t.bop,h.stock,s.keterangan,t.perbaikan,
                    s.satuan,h.qty,h.fakturproduksi,(sum(b.hp * b.qty)/h.qty) bb,p.bop,p.btkl,p.hargapokokperbaikan,p.jumlahperbaikan";
        $cWhere = "h.faktur = '".$faktur."' and h.status = '1'" ;
        $vaJoin = "left join produksi_total t on t.faktur = h.fakturproduksi left join produksi_produk p on p.fakturproduksi = t.faktur ";
        $vaJoin .= "left join stock s on s.kode = h.stock left join produksi_bb b on b.fakturproduksi = t.faktur and b.status = '1'" ;
        $dbData = $this->select("produksi_hasil h",$cField,$cWhere,$vaJoin,"h.faktur") ;
        if($dbr = $this->getrow($dbData)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getTotalPP($dTglAwal,$dTglAkhir){
        $field      = "h.faktur,h.tgl,h.fakturproduksi,h.qty as qtyaktual,(h.qty * h.hp) as aktual,t.hargapokok as std,sum(p.qty) as qtystd";
        $cJoin      = "left join produksi_total t on t.faktur = h.fakturproduksi left join produksi_produk p on p.fakturproduksi = t.faktur";
        $cWhere     = "h.tgl >= '".$dTglAwal."' AND h.tgl <= '".$dTglAkhir."' and h.status = '1'" ;
        $dbData     = $this->select("produksi_hasil h",$field,$cWhere,$cJoin,"h.Faktur","h.Faktur asc");
        return $dbData ;
    }

}
