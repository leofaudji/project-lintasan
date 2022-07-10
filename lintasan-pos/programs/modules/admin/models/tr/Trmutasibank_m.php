<?php
class Trmutasibank_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,concat(t.bank,' - ',r.keterangan) as bankket,t.keterangan,t.debet,t.bank,
                    t.kredit,t.diberiterima";
        $join     = "left join bank r on r.Kode = t.bank";
        $dbd      = $this->select("bank_mutasi_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("bank_mutasi_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        $debet = string_2n($va['jumlah']);
        $kredit = 0;
        if($va['jenis'] == "BK"){
            $kredit = string_2n($va['jumlah']);
            $debet = 0;
        }
        $faktur         = getsession($this, "ssmutasibank_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "status"=>"1",
                                "bank"=>$va['bank'],
                                "keterangan"=>$va['keterangan'],
                                "diberiterima"=>$va['diberiterima'],
                                "debet"=>$debet,
                                "kredit"=>$kredit,
                                "cabang"=> getsession($this, "cabang"),
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("bank_mutasi_total", $data, $where, "") ;

        //insert detail
        $vaGrid = json_decode($va['grid2']);
        $this->delete("bank_mutasi_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){

            $kredit = $val->nominal;
            $debet = 0;
            if($va['jenis'] == "BK"){
                $debet = $val->nominal;
                $kredit = 0;

            }

            $vadetail = array("faktur"=>$va['faktur'],
                              "rekening"=>$val->kode,
                              "keterangan"=>$val->keterangan,
                              "debet"=>$debet,
                              "kredit"=>$kredit);
            $this->insert("bank_mutasi_detail",$vadetail);
        }
        $this->updtransaksi_m->updrekmutasibank($va['faktur']);
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.diberiterima,r.keterangan as ketbank,t.bank,t.keterangan,t.debet,t.kredit";
        $where = "t.faktur = '$faktur'";
        $join  = "left join bank r on r.kode = t.bank";
        $dbd   = $this->select("bank_mutasi_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.faktur,r.kode,concat(d.rekening,'-',r.keterangan) as ketrekening,(d.debet + d.kredit) as nominal,d.keterangan";
        $where = "d.faktur = '$faktur'";
        $join  = "left join keuangan_rekening r on r.kode = d.rekening";
        $dbd   = $this->select("bank_mutasi_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->edit("bank_mutasi_total",array("status"=>2),"faktur = " . $this->escape($faktur));
        $this->delete("keuangan_bukubesar","faktur = " . $this->escape($faktur));
    }

    public function seekrekening($search){
        $where = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%') and jenis = 'D'" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }
    
    public function seekbank($search){
        $where = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("bank", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "MB".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }

}
?>
