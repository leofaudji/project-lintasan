<?php
class Trreturpembelian_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as supplier,t.subtotal,t.total";
        $join     = "left join supplier s on s.Kode = t.supplier";
        $dbd      = $this->select("pembelian_retur_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("pembelian_retur_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        $faktur = getsession($this, "ssreturpembelian_faktur", "");
        $va['faktur'] = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data    = array("faktur"=>$va['faktur'],"tgl"=>$va['tgl'],"subtotal"=>$va['subtotal'], "total"=>$va['total'],"status"=>"1",
                         "gudang"=>$va['gudang'],"supplier"=>$va['supplier'],"cabang"=> getsession($this, "cabang"),
                         "username"=> getsession($this, "username"),"datetime"=>date("Y-m-d H:i:s")) ;
        $where   = "faktur = " . $this->escape($faktur) ;
        $this->update("pembelian_retur_total", $data, $where, "") ;

        //insert detail pembelian
        $vaGrid = json_decode($va['grid2']);
        $this->delete("pembelian_retur_detail", "faktur = '{$va['faktur']}'" ) ;
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
                              "totalitem"=>$val->jumlah);
          $this->insert("pembelian_retur_detail",$vadetail);
        }

        //update kartu stock
        $this->updtransaksi_m->updkartustockreturpembelian($va['faktur']);
        $this->updtransaksi_m->updkartuhutangreturpembelian($va['faktur']);
        $this->updtransaksi_m->updrekreturpembelian($va['faktur']);
    }

    public function getdatatotal($faktur){
      $data  = array() ;
      $field = "t.faktur,t.tgl,t.gudang,t.supplier,g.keterangan as ketgudang,t.subtotal,t.total,s.nama as namasupplier";
      $where = "t.faktur = '$faktur'";
      $join  = "left join gudang g on g.kode = t.gudang left join supplier s on s.kode = t.supplier";
      $dbd   = $this->select("pembelian_retur_total t", $field, $where, $join) ;
      if($dbr = $this->getrow($dbd)){
        $data = $dbr;
      }
      return $data ;
    }

    public function getdatadetail($faktur){
      $field = "d.stock,s.keterangan as namastock,d.harga,d.qty,s.satuan,d.totalitem as jumlah,s.barcode";
      $where = "d.faktur = '$faktur'";
      $join  = "left join stock s on s.kode = d.stock";
      $dbd   = $this->select("pembelian_retur_detail d", $field, $where, $join) ;
      return $dbd ;
    }

    public function deleting($faktur){
      $this->delete("stock_kartu", "faktur = " . $this->escape($faktur)) ;
      $this->delete("hutang_kartu", "faktur = " . $this->escape($faktur)) ;
      $this->delete("keuangan_bukubesar", "faktur = " . $this->escape($faktur)) ;
      $this->edit("pembelian_retur_total",array("status"=>2),"faktur = " . $this->escape($faktur));
    }

    public function seekgudang($search){
      $where = "kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%'" ;
      $dbd      = $this->select("gudang", "*", $where, "", "", "keterangan ASC", '50') ;
      return array("db"=>$dbd) ;
    }

    public function seeksupplier($search){
      $where  = "kode LIKE '{$search}%' OR nama LIKE '%{$search}%'" ;
      $dbd    = $this->select("supplier", "*", $where, "", "", "nama ASC", '50') ;
      return array("db"=>$dbd) ;
    }

    public function getfaktur($l=true){
      $cabang = getsession($this, "cabang") ;
      $key  = "RB".$cabang.date("ymd");
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

    public function getdata($kode){
      $data = array() ;
		  if($d = $this->getval("*", "kode = " . $this->escape($kode), "stock")){
        $data = $d;
		  }
		  return $data ;
    }

    public function getDataStock($cKodeStock){
      $cWhere = "kode = '$cKodeStock' or barcode = '$cKodeStock'";
      $dbData = $this->select("stock","Kode,Keterangan,Satuan,barcode",$cWhere);
      return $dbData ;
    }
}
?>
