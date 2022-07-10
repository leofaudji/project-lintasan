 <?php
class Trpembelian_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as supplier,t.subtotal,t.diskon,t.pembulatan,t.ppn,t.total,t.fktpo";
        $join     = "left join supplier s on s.Kode = t.supplier";
        $dbd      = $this->select("pembelian_total t", $field, $where, $join, "", "t.tgl,t. faktur ASC", $limit) ;
        $dba      = $this->select("pembelian_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        $faktur         = getsession($this, "sspembelian_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "fktpo"=>$va['fktpo'],
                                "subtotal"=>string_2n($va['subtotal']),
                                "diskon"=>string_2n($va['diskontotal']),
                                "pembulatan"=>string_2n($va['pembulatantotal']),
                                "persppn"=>string_2n($va['persppn']),
                                "ppn"=>string_2n($va['ppntotal']),
                                "total"=>string_2n($va['total']),
                                "hutang"=>string_2n($va['total']),
                                "status"=>"1",
                                "gudang"=>$va['gudang'],
                                "supplier"=>$va['supplier'],
                                "cabang"=> getsession($this, "cabang"),
                                "username"=> getsession($this, "username")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("pembelian_total", $data, $where, "") ;

        //insert detail pembelian
        $vaGrid = json_decode($va['grid2']);
        $this->delete("pembelian_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){
            $cKdStockGrid = $val->stock;
            $dbKD = $this->getDataStock($cKdStockGrid) ;
            if($dbRKD = $this->getrow($dbKD)){
                $cKodeStock = $dbRKD['Kode'];
            }
            $vadetail = array("faktur"=>$va['faktur'],
                              "stock"=>$cKodeStock,
                              "qty"=>$val->qty,
                              "harga"=>$val->harga,
                              "jumlah"=>$val->jumlah,
                              "totalitem"=>$val->jumlah,
                              "username"=> getsession($this, "username"));
            $this->insert("pembelian_detail",$vadetail);
        }
        //update kartu stock
        $this->updtransaksi_m->updkartustockpembelian($va['faktur']);
        $this->updtransaksi_m->updkartuhutangpembelian($va['faktur']);
        $this->updtransaksi_m->updrekpembelian($va['faktur']);
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.gudang,t.supplier,g.keterangan as ketgudang,t.subtotal,t.diskon,t.ppn,t.pembulatan,
                  t.total,s.nama as namasupplier,t.fktpo,t.persppn";
        $where = "t.faktur = '$faktur'";
        $join  = "left join gudang g on g.kode = t.gudang left join supplier s on s.kode = t.supplier";
        $dbd   = $this->select("pembelian_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.stock,s.keterangan as namastock,d.harga,d.qty,s.satuan,d.totalitem as jumlah,s.barcode";
        $where = "d.faktur = '$faktur'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("pembelian_detail d", $field, $where, $join) ;
        return $dbd ;
    }
    
    public function getdatadetailpo($fktpo){
        $field = "d.stock,s.keterangan as namastock,d.harga,d.qty,s.satuan,d.jumlah";
        $where = "d.faktur = '$fktpo'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("po_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->delete("keuangan_bukubesar", "faktur = " . $this->escape($faktur)) ;
        $this->delete("stock_kartu", "faktur = " . $this->escape($faktur)) ;
        $this->delete("hutang_kartu", "faktur = " . $this->escape($faktur)) ;
        $this->edit("pembelian_total",array("status"=>2,"fktpo"=>""),"faktur = " . $this->escape($faktur));
    }

    public function seekgudang($search){
        $where = "kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%'" ;
        $dbd      = $this->select("gudang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function seeksupplier($search){
        $where = "kode LIKE '{$search}%' OR nama LIKE '%{$search}%'" ;
        $dbd      = $this->select("supplier", "*", $where, "", "", "nama ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function getDataStock($cKodeStock){
        $cWhere = "kode = '$cKodeStock' or barcode = '$cKodeStock'";
        $dbData = $this->select("stock","Kode,Keterangan,Satuan",$cWhere);
        return $dbData ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "PB".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }

    public function loadgrid3($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
        
        $where 	 = implode(" AND ", $where) ;
        $dbd      = $this->select("stock", "kode,keterangan,satuan", $where, "", "", "kode ASC", $limit) ;
        $dba      = $this->select("stock", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function loadgrid4($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "(p.faktur LIKE '{$search}%' OR s.nama LIKE '%{$search}%')" ;
        $where[]	= "p.status = '1' and b.faktur is null" ;
        $where 	 = implode(" AND ", $where) ;
        $field = "p.faktur,p.tgl,s.nama as supplier";
        $join ="left join supplier s on s.kode = p.supplier left join pembelian_total b on b.fktpo = p.faktur";
        $dbd      = $this->select("po_total p", $field, $where, $join, "", "p.faktur asc", $limit) ;
        $dba      = $this->select("po_total p", "p.id", $where, $join) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdata($kode){
        $data = array() ;
        $where = "kode = " . $this->escape($kode). " or barcode = " . $this->escape($kode);
        if($d = $this->getval("*",$where, "stock")){
            $data = $d;
        }
        return $data ;
    }
    public function getdatapo($fktpo){
        $data = array() ;
        $where	= "p.faktur = '$fktpo'" ;
        $field = "p.faktur,p.tgl,p.supplier,s.nama as namasupplier,p.gudang,g.keterangan as ketgudang";
        $join ="left join supplier s on s.kode = p.supplier left join gudang g on g.kode = p.gudang";
        $dbd      = $this->select("po_total p", $field, $where, $join, "", "p.faktur DESC") ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }
}
?>
