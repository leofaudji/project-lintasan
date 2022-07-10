<?php
class Trsj_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%' or s.nama = '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,s.nama as customer,t.do,t.petugaspengirim,t.nopol,t.kernet";
        $join     = "left join customer s on s.Kode = t.customer left join armada a on a.kode = t.nopol";
        $dbd      = $this->select("sj_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("sj_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        $faktur         = getsession($this, "sssj_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "do"=>$va['fktdo'],
                                "tgl"=>$va['tgl'],
                                "status"=>"1",
                                "customer"=>$va['customer'],
                                "petugaspengirim"=>$va['petugaspengirim'],
                                "kernet"=>$va['kernet'],
                                "nopol"=>$va['nopol'],
                                "cabang"=> getsession($this, "cabang"),
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("sj_total", $data, $where, "") ;

        //insert detail po
        $vaGrid = json_decode($va['grid2']);
        $this->delete("sj_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){
            $cKdStockGrid = $val->stock;
            $dbKD = $this->getDataStock($cKdStockGrid) ;
            if($dbRKD = $this->getrow($dbKD)){
              $cKodeStock = $dbRKD['Kode'];
            }
            $vadetail = array("faktur"=>$va['faktur'],
                              "stock"=>$cKodeStock,
                              "qty"=>$val->qty);
            $this->insert("sj_detail",$vadetail);
        }
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.customer,t.petugaspengirim,t.nopol,s.nama as namacustomer,t.do,t.kernet,a.keterangan as ketarmada";
        $where = "t.faktur = '$faktur'";
        $join  = "left join customer s on s.kode = t.customer left join armada a on a.kode = t.nopol";
        $dbd   = $this->select("sj_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.stock,s.keterangan as namastock,d.qty,s.satuan";
        $where = "d.faktur = '$faktur'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("sj_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->edit("sj_total",array("status"=>2,"do"=>""),"faktur = " . $this->escape($faktur));
    }

    public function seekcustomer($search){
        $where = "kode LIKE '{$search}%' OR nama LIKE '%{$search}%'" ;
        $dbd      = $this->select("customer", "*", $where, "", "", "nama ASC", '50') ;
        return array("db"=>$dbd) ;
    }
    
    public function seekarmada($search){
        $where = "kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%'" ;
        $dbd      = $this->select("armada", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function getDataStock($cKodeStock){
      $cWhere = "kode = '$cKodeStock' or barcode = '$cKodeStock'";
      $dbData = $this->select("stock","Kode,Keterangan,Satuan",$cWhere);
      return $dbData ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "SJ".$cabang.date("ymd");
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
    public function getdatadetaildo($fktdo){
        $field = "d.stock,s.keterangan as namastock,d.qty,s.satuan";
        $where = "d.faktur = '$fktdo'";
        $join  = "left join stock s on s.kode = d.stock";
        $dbd   = $this->select("do_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function loadgrid4($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "(p.faktur LIKE '{$search}%' OR s.nama LIKE '%{$search}%')" ;
        $where[]	= "p.status = '1' and b.faktur is null" ;
        $where 	 = implode(" AND ", $where) ;
        $field = "p.faktur,p.tgl,s.nama as customer";
        $join ="left join customer s on s.kode = p.customer left join sj_total b on b.do = p.faktur";
        $dbd      = $this->select("do_total p", $field, $where, $join, "", "p.faktur asc", $limit) ;
        $dba      = $this->select("do_total p", "p.id", $where, $join) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdatado($fktdo){
        $data = array() ;
        $where	= "p.faktur = '$fktdo'" ;
        $field = "p.faktur,p.tgl,p.customer,s.nama as namacustomer";
        $join ="left join customer s on s.kode = p.customer";
        $dbd      = $this->select("do_total p", $field, $where, $join, "", "p.faktur DESC") ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }
}
?>
