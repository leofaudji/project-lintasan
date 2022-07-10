<?php
class Trjurnallainlain_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%'" ;
        $where[] = "t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,t.rekening,r.keterangan as ketrekening,t.keterangan,t.debet,
                    t.kredit";
        $join     = "left join keuangan_rekening r on r.Kode = t.rekening";
        $dbd      = $this->select("keuangan_jurnal t", $field, $where, $join, "", "t.tgl,t. faktur ASC", $limit) ;
        $dba      = $this->select("keuangan_jurnal t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }

    public function saving($faktur, $va){
        
        $faktur         = getsession($this, "ssjurnallainlain_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        //insert jurnal
        $vaGrid = json_decode($va['grid2']);
        $this->delete("keuangan_jurnal", "faktur = '{$va['faktur']}'" ) ;
		$this->delete("keuangan_bukubesar", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){

            $debet = $val->debet;
            $kredit = $val->kredit;

            $vadetail = array("faktur"=>$va['faktur'],
                              "cabang"=>getsession($this,"cabang"),
                              "tgl"=>date_2s($va['tgl']),
                              "rekening"=>$val->rekening,
							  "keterangan"=>$val->keterangan,
							  "debet"=>$debet,
                              "kredit"=>$kredit,
							  "datetime"=>date("Y-m-d H:i:s"),
							  "username"=>getsession($this,"username"));
            $this->insert("keuangan_jurnal",$vadetail);
			$this->insert("keuangan_bukubesar",$vadetail);
        }
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl";
        $where = "t.faktur = '$faktur'";
        $join  = "left join keuangan_rekening r on r.kode = t.rekening";
        $dbd   = $this->select("keuangan_jurnal t", $field, $where, $join,"","","1") ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.rekening,r.keterangan as ketrekening,d.keterangan,d.debet,d.kredit";
        $where = "d.faktur = '$faktur'";
        $join  = "left join keuangan_rekening r on r.kode = d.rekening";
        $dbd   = $this->select("keuangan_jurnal d", $field, $where, $join) ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->delete("keuangan_bukubesar","faktur = " . $this->escape($faktur));
		$this->delete("keuangan_jurnal","faktur = " . $this->escape($faktur));
    }

    public function seekrekening($search){
        $where = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%') and jenis = 'D'" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "JR".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }

    public function getdata($kode){
        $data = array() ;
        if($d = $this->getval("*", "kode = " . $this->escape($kode), "stock")){
            $data = $d;
        }
        return $data ;
    }
    
    public function loaddetail($va){ 
        $where    = array("b.faktur = '".$va['faktur']."' and b.rekening = '".$va['rekening']."'") ;    
        //if($search !== "") $where[]   = "(b.rekening LIKE '{$search}%' OR b.keterangan LIKE '%{$search}%' OR b.debet LIKE '%{$search}%' OR b.kredit LIKE '%{$search}%')" ;
        $where    = implode(" AND ", $where) ;   

        $f        = "b.id no,b.tgl,b.faktur,b.keterangan,b.debet,b.kredit,b.kredit total,b.username" ;     
        $join     = "left join keuangan_rekening r on r.kode = b.rekening"  ;
        $dbd      = $this->select("keuangan_bukubesar b", $f, $where, $join, "", "b.id ASC") ;

        return $dbd;
    }
}
?>
