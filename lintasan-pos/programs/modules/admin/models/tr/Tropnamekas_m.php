<?php
class Tropnamekas_m extends Bismillah_Model{
    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ;
        if($search !== "") $where[]	= "t.faktur LIKE '%{$search}%'" ;
        $where[] = "t.status = '1' and t.tgl >= '{$va['tglawal']}' and t.tgl <= '{$va['tglakhir']}'";
        $where 	 = implode(" AND ", $where) ;
        $field    = "t.faktur,t.tgl,concat(t.rekkas,' - ',r.keterangan) as rekkas,t.nominal";
        $join     = "left join keuangan_rekening r on r.Kode = t.rekkas";
        $dbd      = $this->select("kas_opname_total t", $field, $where, $join, "", "t.tgl,t. faktur ASC", $limit) ;
        $dba      = $this->select("kas_opname_total t", "t.id", $where) ;

        return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
    }
    
    public function loadgrid2($va){
      $where 	 = array() ; 
      $where 	 = implode(" AND ", $where) ;
      $join = "left join kas_opname_detail d on d.faktur = '{$va['faktur']}' and d.kode = u.kode";
      $f        = "u.kode,u.pecahan, IFNULL(d.qty,0) as qty,IFNULL((d.qty*u.pecahan),0) as nominal" ; 
      $dbd      = $this->select("uang_pecahan u", $f, $where, $join, "", "u.jenis,u.pecahan ASC") ;

      $row      = 0 ;

      $dba      = $this->select("uang_pecahan u", "COUNT(u.id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   } 

    public function saving($faktur, $va){
        $faktur         = getsession($this, "ssopnamekas_faktur", "");
        $va['faktur']   = $faktur !== "" ? $faktur : $this->getfaktur() ;
        $data           = array("faktur"=>$va['faktur'],
                                "tgl"=>$va['tgl'],
                                "status"=>"1",
                                "rekkas"=>$va['rekkas'],
                                "nominal"=>string_2n($va['nominal']),
                                "cabang"=> getsession($this, "cabang"),
                                "username"=> getsession($this, "username"),
                                "datetime"=>date("Y-m-d H:i:s")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("kas_opname_total", $data, $where, "") ;

        //insert detail
        $vaGrid = json_decode($va['grid2']);
        $this->delete("kas_opname_detail", "faktur = '{$va['faktur']}'" ) ;
        foreach($vaGrid as $key => $val){
            $vadetail = array("faktur"=>$va['faktur'],
                              "kode"=>$val->kode,
                              "qty"=>$val->qty);
            $this->insert("kas_opname_detail",$vadetail);
        }
    }

    public function getdatatotal($faktur){
        $data  = array() ;
        $field = "t.faktur,t.tgl,r.keterangan as ketrekening,t.rekkas,t.nominal";
        $where = "t.faktur = '$faktur'";
        $join  = "left join keuangan_rekening r on r.kode = t.rekkas";
        $dbd   = $this->select("kas_opname_total t", $field, $where, $join) ;
        if($dbr = $this->getrow($dbd)){
            $data = $dbr;
        }
        return $data ;
    }

    public function getdatadetail($faktur){
        $field = "d.faktur,d.kode,r.pecahan,d.qty,(d.qty * r.pecahan) as nominal";
        $where = "d.faktur = '$faktur'";
        $join  = "left join uang_pecahan r on r.kode = d.kode";
        $dbd   = $this->select("kas_opname_detail d", $field, $where, $join,"","r.jenis,r.pecahan ASC") ;
        return $dbd ;
    }

    public function deleting($faktur){
        $this->edit("kas_opname_total",array("status"=>2),"faktur = " . $this->escape($faktur));
    }

    public function seekrekening($search){
        $where = "(kode LIKE '{$search}%' OR keterangan LIKE '%{$search}%') and jenis = 'D'" ;
        $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "kode ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "ZZ".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }
}
?>
