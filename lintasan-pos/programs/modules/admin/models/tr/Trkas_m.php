<?php
class Trkas_m extends Bismillah_Model{
    public function loadgrid($va){ 
        $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
        $search   = $this->escape_like_str($search) ; 
        $where    = array("b.tgl >= '".date_2s($va['tglawal'])."' and b.tgl <= '".date_2s($va['tglakhir'])."' and b.rekening = '".$va['rekening']."' ") ;    
        //if($search !== "") $where[]   = "(b.rekening LIKE '{$search}%' OR b.keterangan LIKE '%{$search}%' OR b.debet LIKE '%{$search}%' OR b.kredit LIKE '%{$search}%')" ;
        $where    = implode(" AND ", $where) ;   

        $f        = "b.id no,b.tgl,b.faktur,b.keterangan,b.debet,b.kredit,b.kredit total,b.username" ;     
        $join     = "left join keuangan_rekening r on r.kode = b.rekening"  ;
        $dbd      = $this->select("keuangan_bukubesar b", $f, $where, $join, "", "b.id ASC") ;

        $row      = 0 ; 
        $dba      = $this->select("keuangan_bukubesar b", "COUNT(id) id", $where) ;
        if($dbra  = $this->getrow($dba)){ 
            $row   = $dbra['id'] ;
        }

        $c = substr($va['rekening'],0,1) ;
        if($c == "1" || $c == "5" || $c == "6" || $c == "8" || $c == "9"){
            $f = "sum(b.debet-b.kredit) saldoawal" ;
        }else{
            $f = "sum(b.kredit-b.debet) saldoawal" ;
        }
        $saldoawal = 0 ;     
        $where = "b.tgl < '".date_2s($va['tglawal'])."' and b.rekening = '".$va['rekening']."'" ;
        $dba      = $this->select("keuangan_bukubesar b",$f, $where) ;
        if($dbra  = $this->getrow($dba)){ 
            $saldoawal   = $dbra['saldoawal'] ;
        } 

        return array("db"=>$dbd, "rows"=> $row,"saldoawal"=>$saldoawal,"rekening"=>$c) ;
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

    public function getfaktur($c="K",$tgl,$l=true){
        $cabang =  getsession($this,"cabang") ;
        $k       = $this->getlastfaktur($c,$cabang,$tgl,true,15);  
        return $k; 
    }


    public function saving($va, $id){
        //$f    = $va ; 
        //$f2   = $va ;
        $rekkas = getsession($this, "rekkas");

        if($va['jenis'] == "KM"){
            $c = "KM" ;
            $faktur = $this->getfaktur($c,$va['tgl'],true) ;   
            $f = array("faktur"=>$faktur,"rekening"=>$rekkas,"tgl"=>date_2s($va['tgl']),"debet"=>string_2n($va['jumlah']),"keterangan"=>$va['keterangan'],
                       "cabang"=>getsession($this, "cabang"),"username"=>getsession($this, "username"),"datetime"=>date("Y-m-d H:i:s"));
            $f2 = array("faktur"=>$faktur,"rekening"=>$va['rekening'],"tgl"=>date_2s($va['tgl']),"kredit"=>string_2n($va['jumlah']),"keterangan"=>$va['keterangan'],
                       "cabang"=>getsession($this, "cabang"),"username"=>getsession($this, "username"),"datetime"=>date("Y-m-d H:i:s"));

        }else{
            $c = "KK" ;
            $faktur = $this->getfaktur($c,$va['tgl'],true) ;   
            $f2 = array("faktur"=>$faktur,"rekening"=>$va['rekening'],"tgl"=>date_2s($va['tgl']),"debet"=>string_2n($va['jumlah']),"keterangan"=>$va['keterangan'],
                       "cabang"=>getsession($this, "cabang"),"username"=>getsession($this, "username"),"datetime"=>date("Y-m-d H:i:s"));
            $f = array("faktur"=>$faktur,"rekening"=>$rekkas,"tgl"=>date_2s($va['tgl']),"kredit"=>string_2n($va['jumlah']),"keterangan"=>$va['keterangan'],
                       "cabang"=>getsession($this, "cabang"),"username"=>getsession($this, "username"),"datetime"=>date("Y-m-d H:i:s"));

        }
        $this->insert("keuangan_jurnal", $f) ; 
        $this->insert("keuangan_jurnal", $f2) ; 
        $this->updtransaksi_m->updrekjurnal($faktur);
    }


}
?>
