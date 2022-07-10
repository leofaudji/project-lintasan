<?php
/**
	*
	*/
class Rptpenjualan_m extends Bismillah_Model
{


    public function loadgrid($va){
        $limit      = $va['offset'].",".$va['limit'] ;
        $search     = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search     = $this->escape_like_str($search) ;
        $where = array();
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%'" ;
        $where[] = "t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where[] = "t.status = '1'";
		$where 	 = implode(" AND ", $where) ;
        $join = "left join customer c on c.kode = t.customer left join penjualan_detail d on d.faktur = t.faktur";
        $field      = "t.faktur,t.tgl,t.subtotal,t.diskon as diskonnom,t.ppn,t.total,sum(d.hp * d.qty) as tothpp,
                        ' ' as customer";
        $dbd        = $this->select("penjualan_total t", $field, $where,$join,"t.id", "t.tgl,t.faktur ASC") ;
        $dba        = $this->select("penjualan_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdatadetail($faktur){
        $field = "d.stock,s.keterangan as namastock,d.harga,d.qty,s.satuan,d.totalitem as jumlah, (d.hp * d.qty) as hpp, d.diskonqty as diskon";
        $where = "d.faktur = '$faktur'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("penjualan_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function getdatatotal($dTglAwal,$dTglAkhir){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.subtotal,t.diskon,t.ppn,t.total,t.kas, t.komplimen,c.nama as namacustomer,t.piutang,t.sj";
        $join = "left join customer c on c.kode = t.customer ";
        $where = "t.tgl >= '$dTglAwal' and t.tgl <= '$dTglAkhir' and t.status = '1'";
        $dbd   = $this->select("penjualan_total t", $field, $where,$join) ;
        return $dbd ;
    }

    public function GetDataPerFaktur($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.subtotal,t.diskon,t.ppn,t.total,t.kas,t.komplimen,c.nama as namacustomer,t.piutang,t.sj";
        $where = array() ;
        $join = "left join customer c on c.kode = t.customer";
        $where = "t.faktur = '$faktur'" ;
        $dbd   = $this->select("penjualan_total t", $field, $where,$join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }
}
?>

