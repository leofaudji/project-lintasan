<?php
class Mstaktivainventaris_m extends Bismillah_Model{

    public function loadgrid($va){
        $limit    = $va['offset'].",".$va['limit'] ;
        $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ;
        $where 	 = array() ; 
        if($search !== "") $where[]	= "(keterangan LIKE '%{$search}%')" ;
        $where 	 = implode(" AND ", $where) ;
        $f        = "id,kode,keterangan,golongan,cabang,tglperolehan,lama,hargaperolehan,unit,jenispenyusutan,tarifpenyusutan,residu" ; 
        $dbd      = $this->select("aset", $f, $where, "", "", "kode ASC", $limit) ;

        $row      = 0 ;
        $dba      = $this->select("aset", "COUNT(id) id", $where) ;
        if($dbra  = $this->getrow($dba)){
            $row   = $dbra['id'] ;
        }
        return array("db"=>$dbd, "rows"=> $row ) ;
    } 

    public function saving($va, $id){ 
        $kode = getsession($this, "ssmstaktivainventaris_id", "");
        $va['kode'] = $kode !== "" ? $kode : $this->getkode() ;
        $data    = array("kode"=>$va['kode'],"keterangan"=>$va['keterangan'],"golongan"=>$va['golaset'],"cabang"=>$va['cabang'],"lama"=>$va['lama'],
                         "tglperolehan"=>date_2s($va['tglperolehan']),"unit"=>string_2n($va['unit']),"hargaperolehan"=>string_2n($va['hp']),
                         "jenispenyusutan"=>$va['jenis'],"tarifpenyusutan"=>string_2n($va['tarifpeny']),"residu"=>string_2n($va['residu'])) ;
        $where   = "kode = " . $this->escape($va['kode']) ;
        $this->update("aset", $data, $where, "") ;
    }

    public function getdata($kode=''){
        $where 	 = "a.kode = " . $this->escape($kode);
        $join     = "left join aset_golongan g on g.kode = a.golongan left join cabang c on c.kode = a.cabang";
        $field    = "a.kode,a.keterangan,a.golongan,g.keterangan as ketgolongan,a.cabang, c.keterangan as ketcabang,a.lama,a.tglperolehan,a.hargaperolehan,a.unit,
                    a.jenispenyusutan,a.tarifpenyusutan,a.residu";
        $dbd      = $this->select("aset a", $field, $where, $join, "", "a.kode ASC","1") ;
        return $dbd;
    }

    public function seekgolaset($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("aset_golongan", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }

    public function seekcabang($search){
        $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%')" ;
        $dbd      = $this->select("cabang", "*", $where, "", "", "keterangan ASC", '50') ;
        return array("db"=>$dbd) ;
    }
    
    public function getkode($l=true){
      $y    = date("ym");
      $n    = $this->getincrement("aktivakode" . $y, $l, 6);
      $n    = $y.$n ;
      return $n ;
   }

}
?>
