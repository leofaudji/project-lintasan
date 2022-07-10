<?php
class Trsoposting_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,g.keterangan as gudang";
        $join     = "left join gudang g on g.kode = t.gudang";
        $dbd      = $this->select("stock_opname_posting_total t", $field, $where, $join, "", "t.tgl,t. faktur ASC", $limit) ;
        $dba      = $this->select("stock_opname_posting_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
    
    public function loadgrid2($va){
      $where 	 = array() ; 
      $where 	 = implode(" AND ", $where) ;
      $join = "";
      $f        = "kode, keterangan,satuan" ; 
      $dbd      = $this->select("stock", $f, $where, $join, "", "kode ASC") ;

      $row      = 0 ;

      $dba      = $this->select("stock", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   } 
    
    public function saldorealopname($kode,$tgl,$gudang){
        $tgl = date_2s($tgl);
        $cabang = getsession($this, "cabang");
        $field = "ifnull(SUM(d.qty),0) as saldo" ;
        $saldo = 0 ;
        $where = "d.stock = '$kode' and t.tgl = '$tgl' and t.gudang = '$gudang' and t.cabang = '$cabang' and t.posting = '0' and t.status = '1'";
        $join = "left join stock_opname_total t on t.faktur = d.faktur";
        $dbData = $this->select("stock_opname_detail d",$field,$where,$join);
        if($dbr = $this->getrow($dbData)){
            $saldo = $dbr['saldo'];
        }
        return $saldo;

    }

    public function saving($faktur, $va){
        $faktur         = getsession($this, "sssoposting_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $va['tgl'] = date_2s($va['tgl']);
        $cabang = getsession($this, "cabang");
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "status"=>"1",
                                "gudang"=>$va['gudang'],
                                "cabang"=> $cabang,
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("stock_opname_posting_total", $data, $where, "") ;

        //insert detail
        $vaGrid = json_decode($va['grid2']);
        $this->delete("stock_opname_posting_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){
            $vadetail = array("faktur"=>$va['faktur'],
                              "kode"=>$val->kode,
                              "saldosistem"=>$val->saldosistem,
                             "saldoreal"=>$val->saldoreal);
            $this->insert("stock_opname_posting_detail",$vadetail);
        }

        $field = "faktur";
        $this->delete("stock_opname_posting_faktur", "faktur = '{$va['faktur']}'" ) ;
        $where = "tgl = '{$va['tgl']}' and gudang = '{$va['gudang']}' and cabang = '$cabang' and t.status = '1' and t.posting = '0'";
        $dbd   = $this->select("stock_opname_total t", $field, $where) ;
        while($dbr = $this->getrow($dbd)){
            $vadetail = array("faktur"=>$va['faktur'],
                              "fktopname"=>$dbr['faktur']);
            $this->insert("stock_opname_posting_faktur",$vadetail);
            $this->edit("stock_opname_total",array("posting"=>'1'),"faktur = '{$dbr['faktur']}'");
        }
        
        $this->updtransaksi_m->updkartustockopname($va['faktur']);
        $this->updtransaksi_m->updrekstockopname($va['faktur']);

    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.gudang,g.keterangan as ketgudang";
        $where = "t.faktur = '$faktur'";
        $join  = "left join gudang g on g.kode = t.gudang";
        $dbd   = $this->select("stock_opname_posting_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.kode,s.keterangan,s.satuan,d.saldosistem,d.saldoreal,d.nilaipersdsistem,d.nilaipersdreal";
        $where = "d.faktur = '$faktur'";
        $join  = "left join stock s on s.kode = d.kode";
        $dbd   = $this->select("stock_opname_posting_detail d", $field, $where, $join,"","s.stock_group asc,s.kode asc") ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->edit("stock_opname_posting_total",array("status"=>2),"faktur = " . $this->escape($faktur));
        $field = "fktopname";
        $where = "faktur = '$faktur'";
        $dbd   = $this->select("stock_opname_posting_faktur", $field, $where) ;
        while($dbr = $this->getrow($dbd)){
            $this->edit("stock_opname_total",array("posting"=>'0'),"faktur = '{$dbr['fktopname']}'");
        }
        
        $this->delete("stock_hp","faktur = " . $this->escape($faktur));
        $this->delete("stock_kartu","faktur = " . $this->escape($faktur));
        $this->delete("keuangan_bukubesar","faktur = " . $this->escape($faktur));
    }

    public function seekgudang($search){
        $where = "kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%'" ;
        $dbd      = $this->select("gudang", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "SP".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }
}
?>
