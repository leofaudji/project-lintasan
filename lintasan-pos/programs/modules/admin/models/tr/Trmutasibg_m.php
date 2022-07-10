<?php
class Trmutasibg_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,concat(t.rekening,' - ',r.keterangan) as rekbg,t.keterangan,t.debet,t.rekening,
                    t.kredit,t.diberiterima";
        $join     = "left join keuangan_rekening r on r.Kode = t.rekening";
        $dbd      = $this->select("bg_mutasi_total t", $field, $where, $join, "", "t. faktur ASC", $limit) ;
        $dba      = $this->select("bg_mutasi_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        $debet = string_2n($va['jumlah']);
        $kredit = 0;
        if($va['jenis'] == "GM"){
            $kredit = string_2n($va['jumlah']);
            $debet = 0;
        }
        $faktur         = getsession($this, "ssmutasibg_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "status"=>"1",
                                "rekening"=>$va['rekbg'],
                                "keterangan"=>$va['keterangan'],
                                "diberiterima"=>$va['diberiterima'],
                                "debet"=>$debet,
                                "kredit"=>$kredit,
                                "cabang"=> getsession($this, "cabang"),
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("bg_mutasi_total", $data, $where, "") ;

        //insert detail
        $vaGrid = json_decode($va['grid2']);
        $this->delete("bg_mutasi_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){

            $kredit = $val->nominal;
            $debet = 0;
            if($va['jenis'] == "GM"){
                $debet = $val->nominal;
                $kredit = 0;

            }

            $vadetail = array("faktur"=>$va['faktur'],
                              "bank"=>$val->bank,
                              "bgcek"=>$val->bgcek,
                              "norekening"=>$val->norekening,
                              "nobgcek"=>$val->nobgcek,
                              "tgljthtmp"=>date_2s($val->jthtmp),
                              "debet"=>$debet,
                              "kredit"=>$kredit);
            $this->insert("bg_mutasi_detail",$vadetail);
        }
        //$this->updtransaksi_m->updrekmutasibg($va['faktur']);
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,t.diberiterima,r.keterangan as ketrekening,t.rekening,t.keterangan,t.debet,t.kredit";
        $where = "t.faktur = '$faktur'";
        $join  = "left join keuangan_rekening r on r.kode = t.rekening";
        $dbd   = $this->select("bg_mutasi_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.faktur,r.kode,concat(d.bank,'-',b.keterangan) as ketbank,(d.debet + d.kredit) as nominal,d.bgcek,d.norekening,
                  d.nobgcek,d.tgljthtmp as jthtmp,d.bank";
        $where = "d.faktur = '$faktur'";
        $join  = "left join bank b on b.kode = d.bank left join keuangan_rekening r on r.kode = b.rekening";
        $dbd   = $this->select("bg_mutasi_detail d", $field, $where, $join) ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->edit("bg_mutasi_total",array("status"=>2),"faktur = " . $this->escape($faktur));
        $this->delete("keuangan_bukubesar","faktur = " . $this->escape($faktur));
    }

    public function seekrekening($search){
        $where = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%') and jenis = 'D'" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC", '') ;
        return array("db"=>$dbd) ;
    }
    
    public function seekbank($search){
        $where = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("bank", "*", $where, "", "", "kode ASC", '') ;
        return array("db"=>$dbd) ;
    }


    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "MG".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }
}
?>
