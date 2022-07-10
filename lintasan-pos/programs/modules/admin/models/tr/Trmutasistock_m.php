<?php
class Trmutasistock_m extends Bismillah_Model{
    
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,t.gudangfrom,t.stockfrom,t.qtyfrom,t.hpfrom,t.gudangto,t.stockto,t.qtyto,t.hpto";
        $join     = "";
        $dbd      = $this->select("mutasi_stock t", $field, $where, $join, "", "t.tgl,t. faktur ASC", $limit) ;
        $dba      = $this->select("mutasi_stock t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }


    public function loadgrid3($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        //$where[]	= "jenis = 'P'" ;
        if($search !== "") $where[]	= "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $where 	 = implode(" AND ", $where) ;
        $dbd      = $this->select("stock", "kode,keterangan,satuan", $where, "", "", "kode ASC", $limit) ;
        $dba      = $this->select("stock", "id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function getdata($kode){
        $data = array() ;
        if($d = $this->getval("*", "kode = " . $this->escape($kode) ." or barcode = ". $this->escape($kode), "stock")){
            $arrhj = $this->perhitungan_m->gethjstock($d['kode'],1);
            $d['hargajual'] = $arrhj['hargajual'];

            $data = $d;
        }
        return $data ;
    }

    public function getdatamutasi($faktur){
        $return = array() ;
        $field = "m.faktur,m.tgl,m.gudangfrom,g1.keterangan ketgudangfrom,m.stockfrom,s1.keterangan namastockfrom, s1.satuan satuanfrom,
                  s1.barcode as barcodefrom,m.qtyfrom,m.gudangto,g2.keterangan ketgudangto,m.stockto,s2.keterangan namastockto,
                  s2.satuan satuanto,s2.barcode as barcodeto,m.qtyto";
        $where = "m.faktur = '$faktur'";
        $join = "left join gudang g1 on g1.kode = m.gudangfrom left join gudang g2 on g2.kode = m.gudangto
                 left join stock s1 on s1.kode = m.stockfrom left join stock s2 on s2.kode = m.stockto";
        $data = $this->select("mutasi_stock m", $field, $where, $join);
        if($dbr = $this->getrow($data)){
            $return = $dbr;
        }
        return $return ;
    }

    public function seekgudang($search){
        $where = "kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%'" ;
        $dbd      = $this->select("gudang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }
    
    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "SM".date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }
    
    public function saving($faktur, $va){
        $faktur         = getsession($this, "ssmutasistock_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "gudangfrom"=>$va['gudangfrom'],
                                "stockfrom"=>$va['stockfrom'],
                                "qtyfrom"=>string_2n($va['mutasifrom']),
                                "gudangto"=>$va['gudangto'],
                                "stockto"=>$va['stockto'],
                                "qtyto"=>string_2n($va['mutasito']),
                                "status"=>"1",
                                "username"=> getsession($this, "username"),
                                "datetime"=>date_now()) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("mutasi_stock", $data, $where, "") ;
        
        //update kartu stock
        $this->updtransaksi_m->updkartustockmutasistock($va['faktur']);
        $this->updtransaksi_m->updrekmutasistock($va['faktur']);
    }
    
    public function deleting($faktur){
        $this->delete("keuangan_bukubesar", "faktur = " . $this->escape($faktur)) ;
        $this->delete("stock_kartu", "faktur = " . $this->escape($faktur)) ;
        $this->edit("mutasi_stock",array("status"=>2),"faktur = " . $this->escape($faktur));
    }
}
?>
