<?php
class Trcetakstrukpenjualan_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ; 
        if($search !== "") $where[]	= "faktur LIKE '%{$search}%'" ;
        $where[] = "status = '1' and tgl >= '{$va['tglawal']}' and tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "faktur,tgl,subtotal,total,kas,komplimen,piutang,diskon";
        $dbd      = $this->select("penjualan_total", $field, $where, "", "", "faktur ASC", $limit) ;
        $dba      = $this->select("penjualan_total", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
    
    public function getdatadetail($faktur){
        $field = "d.stock,s.keterangan as namastock,d.diskonqty as diskon,d.harga,d.qty,s.satuan,
                d.totalitem as jumlah";
        $where = "d.faktur = '$faktur'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("penjualan_detail d", $field, $where, $join) ;
        return $dbd ;
    }


    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.subtotal,t.diskon,t.ppn,t.total,t.kas,t.komplimen,t.piutang,t.diskon";
        $where = "t.faktur = '$faktur'";
        $join  = "";
        $dbd   = $this->select("penjualan_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }
    
    public function deleting($faktur){
        $this->delete("stock_kartu", "faktur = " . $this->escape($faktur)) ;
        $this->edit("penjualan_total",array("status"=>'2'),"faktur = " . $this->escape($faktur));
        $this->delete("keuangan_bukubesar", "faktur = " . $this->escape($faktur)) ;
        $this->delete("piutang_kartu", "faktur = " . $this->escape($faktur)) ;

    }
}
?>
