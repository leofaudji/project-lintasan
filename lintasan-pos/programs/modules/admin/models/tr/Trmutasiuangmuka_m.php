<?php
class Trmutasiuangmuka_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,concat(t.kodetransaksi,' - ',k.keterangan) as kodetransaksi,s.nama as customer,t.jumlah";
        $join     = "left join kodetransaksi k on k.Kode = t.kodetransaksi";
        $join     .= " left join customer s on s.Kode = t.customer";
        $dbd      = $this->select("uangmuka_mutasi_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("uangmuka_mutasi_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        $jumlah = string_2n($va['jumlah']);
        $faktur         = getsession($this, "ssmutasiuangmuka_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "status"=>"1",
                                "kodetransaksi"=>$va['kodetransaksi'],
                                "customer"=>$va['customer'],
                                "jumlah"=>$jumlah,
                                "cabang"=> getsession($this, "cabang"),
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("uangmuka_mutasi_total", $data, $where, "") ;

        //insert detail
        $vaGrid = json_decode($va['grid2']);
        $this->delete("uangmuka_mutasi_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){

            $vadetail = array("faktur"=>$va['faktur'],
                              "rekening"=>$val->kode,
                              "jumlah"=>$val->nominal);
            $this->insert("uangmuka_mutasi_detail",$vadetail);
        }
        $this->updtransaksi_m->updkartuhutanguangmuka($va['faktur']);
        $this->updtransaksi_m->updrekmutasiuangmuka($va['faktur']);
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,k.keterangan as ketkdtr,t.kodetransaksi,t.jumlah,t.customer,s.nama as namacustomer";
        $where = "t.faktur = '$faktur'";
        $join  = "left join kodetransaksi k on k.kode = t.kodetransaksi";
        $join  .= " left join customer s on s.kode = t.customer";
        $dbd   = $this->select("uangmuka_mutasi_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.faktur,r.kode,concat(d.rekening,'-',r.keterangan) as ketrekening,d.jumlah as nominal,d.rekening,
                r.keterangan as ketrek";
        $where = "d.faktur = '$faktur'";
        $join  = "left join keuangan_rekening r on r.kode = d.rekening";
        $dbd   = $this->select("uangmuka_mutasi_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->edit("uangmuka_mutasi_total",array("status"=>2),"faktur = " . $this->escape($faktur));
        $this->delete("keuangan_bukubesar","faktur = " . $this->escape($faktur));
        $this->delete("piutang_kartu","faktur = " . $this->escape($faktur));
    }

    public function seekrekening($search){
        $where = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%') and jenis = 'D'" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC", '100') ;
        return array("db"=>$dbd) ;
    }
    
    public function seekkodetransaksi($search){
        $where = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("kodetransaksi", "*", $where, "", "", "kode ASC", '100') ;
        return array("db"=>$dbd) ;
    }
    
    public function seekcustomer($search){
        $where = "(kode LIKE '{$search}%' OR nama LIKE '%{$search}%')" ;
        $dbd      = $this->select("customer", "*", $where, "", "", "kode ASC", '100') ;
        return array("db"=>$dbd) ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "MU".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }

}
?>
