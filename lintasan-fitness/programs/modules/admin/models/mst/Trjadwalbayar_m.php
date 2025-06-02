<?php
class Trjadwalbayar_m extends Bismillah_Model{
   public function getfaktur($l=true){
      $k       = "JR" . date("ymd") ; 
      return $k . $this->getincrement($k, $l, 4) ; 
   }
  
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where    = array("p.kode like '%".$va['pelanggan']."%' and p.statuspelanggan = 'MB'") ;     
      if($search !== "") $where[]   = "(p.kode LIKE '%{$search}%' OR p.nama LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
        
      $f        = "p.*,t.jumlah" ;    
      $join     = "left join tarif t on t.kode = p.statuspelanggan"  ;     
      $dbd      = $this->select("pelanggan p", $f, $where, $join, "", "p.kode ASC", $limit) ;
      
      // disini rumus perhitungannya
      
      $row      = 0 ;
      $dba      = $this->select("pelanggan p", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ;
   } 
 
   public function getbayar($id,$bulan){
      $va = array("tgl"=>"","jumlah"=>"","date"=>"","qty"=>0) ;
      $where = "tgl like '$bulan%' and pelanggan = '$id' and iuran > 0" ;    
      $dba      = $this->select("pelanggan_bayar", "tgl,sum(iuran) jumlah,count(id) qty", $where,"","tgl") ;  
      if($dbra  = $this->getrow($dba)){  
         $va   = array("tgl"=>date("d M",strtotime($dbra['tgl'])),"date"=>$dbra['tgl'],
                       "jumlah"=>$dbra['jumlah'],"qty"=>$dbra['qty']) ; 
      }
      return $va ;  
   }
   
   public function coba($id){
    $va1 = array("keterangan"=>"hehe") ;
    return $va1 ;
   }
   
   public function getbonus($id,$bulan){
      $where    = array("p.kode = '".$id."'") ;
      $where    = implode(" AND ", $where) ;  
      $f        = "p.*,t.jumlah" ;    
      $join     = "left join tarif t on t.kode = p.statuspelanggan"  ;
      $dbd      = $this->select("pelanggan p ", $f, $where, $join, "", "p.id DESC") ;
      $data     = array() ;
      $n        = 0 ;
      $databayar = array("keterangan"=>"hehe") ; 
      if($dbr  = $this->getrow($dbd)){ 
        $nwajib = 0 ; 
        $nbayar = 0 ;
        $nn = time() ;
        $pas = 0 ;
        $nnn = time() ;
        //$nnn = strtotime(date("01-03-2019")) ;
        //echo $va['pelanggan'] . "-" . $dbr['tgl'] ;
        for($i=date_nextmonth(strtotime($dbr['tgl']),0);$i<=$nnn;$i=date_nextmonth($i,1)){   
            $databayar = array("keterangan"=>"hehehe") ;
            $tglawal = date("d-m-Y",date_nextmonth($i,-1)) ; 
            $cperiode = date("d-m-Y",$i) ;
            $bom = date_bom($cperiode) ;
            $eom = date_eom($cperiode) ;
            $bom1 = $cperiode ;
            $eom1 = date("d-m-Y",date_nextmonth(strtotime($cperiode),1)) ;
            $pel = $va['pelanggan'] ; 
            $databayar = $this->databayar($pel,$bom,$eom) ; 
            $tglbayar = $databayar['tgl'] ; 
            $dtoleransi = date("d-m-Y",strtotime($databayar['tgl'])-(24*3600)) ; 
            $dtoleransi2 = date("w",strtotime($dtoleransi)) ;
            if($dtoleransi2 == 0) $dtoleransi = date("d-m-Y",strtotime($dtoleransi)-(24*3600)) ; 
            if(strtotime($dtoleransi) <= strtotime($cperiode) and !empty($tglbayar)){// && strtotime($dtoleransi) > 111600){
              $pas++ ;   
              if($databayar['row'] > 1 and !empty($tglbayar)) $pas++ ;
            }else{
              //$pas = 1 ; 
            } 
            
            $njumlah = string_2s($dbr['jumlah'],2) ;
            $databayar['iuran'] = string_2s($databayar['iuran'],2) ;
            //if($pas == 7){ 
            if($pas == 6 and empty($databayar['tgl']) and $databayar['iuran'] == 0){ 
              $njumlah = " <font color=red>BONUS</font> " ; 
              $databayar['tgl'] = " <font color=red>BONUS</font> " ;
              $databayar['keterangan'] = " <font color=red>BONUS</font> " ;
              $databayar['iuran'] = " <font color=red>BONUS</font> " ; 
              $pas = 0 ;
            }  
        }
      }    
        return $databayar ;
   }
   
   public function databayar($id,$tglawal,$tglakhir){
      $n = 0 ;
      $tglawal  = date_2s($tglawal) ; 
      $tglakhir = date_2s($tglakhir) ;     

      $dTgl     = "";
      $nIuran   = 0;
      $cKeterangan = "";
      $nRow     = 0;
      $where    = "pelanggan = '$id' and tgl >= '$tglawal' and tgl <= '$tglakhir'" ;     
      $dba      = $this->select("pelanggan_bayar", "tgl,keterangan,iuran", $where,"","tgl DESC") ;
      $va       = array("tgl"=>"","keterangan"=>"","iuran"=>0) ; 
      while($dbra  = $this->getrow($dba)){  
         $nRow ++;    
         $dTgl   = date_2d($dbra['tgl']);
         $nIuran += $dbra['iuran']; 
         $cKeterangan = $dbra['keterangan'];
      } 
      $va   = array("tgl"=>$dTgl,"keterangan"=>$cKeterangan,"iuran"=>$nIuran,"row"=>$nRow) ; 
      return $va ;
   }
 
}
?>
