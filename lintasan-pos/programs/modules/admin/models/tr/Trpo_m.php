<?php
class Trpo_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as supplier,t.total,t.fktpr";
        $join     = "left join supplier s on s.Kode = t.supplier";
        $dbd      = $this->select("po_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("po_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        $faktur         = getsession($this, "sspo_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "fktpr"=>$va['fktpr'],
                                "tgl"=>$va['tgl'],
                                "total"=>string_2n($va['total']),
                                "status"=>"1",
                                "gudang"=>$va['gudang'],
                                "supplier"=>$va['supplier'],
                                "cabang"=> getsession($this, "cabang"),
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("po_total", $data, $where, "") ;

        //insert detail po
        $vaGrid = json_decode($va['grid2']);
        $this->delete("po_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){
            $cKdStockGrid = $val->stock;
            $dbKD = $this->getDataStock($cKdStockGrid) ;
            if($dbRKD = $this->getrow($dbKD)){
              $cKodeStock = $dbRKD['Kode'];
            }
            $vadetail = array("faktur"=>$va['faktur'],
                              "stock"=>$cKodeStock,
                              "spesifikasi"=>$val->spesifikasi,
                              "qty"=>$val->qty,
                              "harga"=>$val->harga,
                              "jumlah"=>$val->jumlah);
            $this->insert("po_detail",$vadetail);
        }
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.gudang,t.supplier,t.fktpr,g.keterangan as ketgudang,t.total,s.nama as namasupplier";
        $where = "t.faktur = '$faktur'";
        $join  = "left join gudang g on g.kode = t.gudang left join supplier s on s.kode = t.supplier";
        $dbd   = $this->select("po_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.stock,s.keterangan as namastock,d.spesifikasi,d.harga,d.qty,s.satuan,d.jumlah";
        $where = "d.faktur = '$faktur'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("po_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->edit("po_total",array("status"=>2),"faktur = " . $this->escape($faktur));
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
        $key  = "PO".$cabang.date("ymd");
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
    
   public function getdatapr($fktpr){
        $data = array() ;
        $where	= "p.faktur = '$fktpr'" ;
        $field = "p.faktur,p.tgl,p.gudang,g.keterangan as ketgudang";
        $join ="left join gudang g on g.kode = p.gudang";
        $dbd      = $this->select("pr_total p", $field, $where, $join, "", "p.faktur DESC") ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }
    
    public function getdatadetailpr($fktpo){
        $field = "d.stock,s.keterangan as namastock,d.qty,s.satuan";
        $where = "d.faktur = '$fktpo'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("pr_detail d", $field, $where, $join) ;
        return $dbd ;
    }
    
    public function loadgrid4($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "(p.faktur LIKE '{$search}%' OR s.gudang LIKE '%{$search}%')" ;
        $where[]	= "p.status = '1' and b.faktur is null" ;
        $where 	 = implode(" AND ", $where) ;
        $field = "p.faktur,p.tgl,s.keterangan as gudang";
        $join ="left join gudang s on s.kode = p.gudang left join po_total b on b.fktpr = p.faktur";
        $dbd      = $this->select("pr_total p", $field, $where, $join, "", "p.faktur asc", $limit) ;
        $dba      = $this->select("pr_total p", "p.id", $where, $join) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
}
?>
