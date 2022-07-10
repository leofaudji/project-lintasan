<?php
class Trreturpenjualan_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as customer,t.total";
        $join     = "left join customer s on s.Kode = t.customer";
        $dbd      = $this->select("penjualan_retur_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("penjualan_retur_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        $faktur         = getsession($this, "ssreturpenjualan_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "subtotal"=>string_2n($va['subtotal']),
                                "total"=>string_2n($va['total']),
                                "status"=>"1",
                                "gudang"=>$va['gudang'],
                                "customer"=>$va['customer'],
                                "cabang"=> getsession($this, "cabang"),
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("penjualan_retur_total", $data, $where, "") ;

        //insert detail po
        $vaGrid = json_decode($va['grid2']);
        $this->delete("penjualan_retur_detail", "faktur = '{$va['faktur']}'" ) ;
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
                              "jumlah"=>$val->jumlah);
            $this->insert("penjualan_retur_detail",$vadetail);
        }
        
        $this->updtransaksi_m->updkartupiutangreturpenjualan($va['faktur']);
        $this->updtransaksi_m->updkartustockreturpenjualan($va['faktur']);
        $this->updtransaksi_m->updrekreturpenjualan($va['faktur']);
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.gudang,t.customer,g.keterangan as ketgudang,t.total,s.nama as namacustomer,t.subtotal";
        $where = "t.faktur = '$faktur'";
        $join  = "left join gudang g on g.kode = t.gudang left join customer s on s.kode = t.customer";
        $dbd   = $this->select("penjualan_retur_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.stock,s.keterangan as namastock,d.harga,d.qty,s.satuan,d.jumlah";
        $where = "d.faktur = '$faktur'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("penjualan_retur_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->edit("penjualan_retur_total",array("status"=>2),"faktur = " . $this->escape($faktur));
    }

    public function seekgudang($search){
        $where = "kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%'" ;
        $dbd      = $this->select("gudang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function seekcustomer($search){
        $where = "kode LIKE '{$search}%' OR nama LIKE '%{$search}%'" ;
        $dbd      = $this->select("customer", "*", $where, "", "", "nama ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function getDataStock($cKodeStock){
      $cWhere = "kode = '$cKodeStock' or barcode = '$cKodeStock'";
      $dbData = $this->select("stock","Kode,Keterangan,Satuan",$cWhere);
      return $dbData ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "RJ".$cabang.date("ymd");
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
        $where[]	= "jenis = 'P'" ;
        $where 	 = implode(" AND ", $where) ;
        $dbd      = $this->select("stock", "kode,keterangan,satuan", $where, "", "", "kode ASC", $limit) ;
        $dba      = $this->select("stock", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdata($kode){
      $data = array() ;
		if($d = $this->getval("*", "kode = " . $this->escape($kode), "stock")){
         $data = $d;
		}
		return $data ;
   }
}
?>
