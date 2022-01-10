   <?php
class Rptjdwlpel_m extends Bismillah_Model{ 

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where    = array("p.kode = '".$va['pelanggan']."'") ;
      if($search !== "") $where[]   = "(tarif LIKE '{$search}%' OR keterangan LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ;  
      $f        = "p.*,t.jumlah" ;   
      $join     = "left join tarif t on t.kode = p.statuspelanggan"  ;
      $dbd      = $this->select("pelanggan p ", $f, $where, $join, "", "p.id DESC", $limit) ;
      $data     = array() ;
      $n        = 0 ;
      if($dbr  = $this->getrow($dbd)){ 
         $nwajib = 0 ; 
         $nbayar = 0 ;
         $nn = time() ;
         $pas = 0 ;
         $nnn = time() ;
         //$nnn = strtotime(date("01-03-2019")) ;
         //echo $va['pelanggan'] . "-" . $dbr['tgl'] ;
         //if($dbr['kode'] == "001009") $dbr['tgl'] = $dbr['tglaktif'] ;
         for($i=date_nextmonth(strtotime($dbr['tgl']),0);$i<=$nnn;$i=date_nextmonth($i,1)){   
            $tglawal = date("d-m-Y",date_nextmonth($i,-1)) ; 
            $cperiode = date("d-m-Y",$i) ;
            if($this->isholiday($i)){ 
              $cperiode = date("d-m-Y",date_nextday($i,1)) ;  
            }
            
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            if($this->isholiday(strtotime($cperiode))){ 
              $cperiode = date("d-m-Y",date_nextday(strtotime($cperiode),1)) ;  
            }
            
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
              //$pas++ ;   
              if($databayar['row'] > 0 and !empty($tglbayar)) ++$pas ;
            }
            
            if(strtotime($dtoleransi) > strtotime($cperiode)){
              $pas = 0 ; 
            }
            
            $njumlah = string_2s($dbr['jumlah'],2) ;
            $databayar['iuran'] = string_2s($databayar['iuran'],2) ;
            //if($pas == 7){ 
            if($pas >= 6 and empty($databayar['tgl']) and $databayar['iuran'] == 0){ 
              $njumlah = " <font style='font-weight:bold' color=red>BONUS</font> " ; 
              $databayar['tgl'] = " <font style='font-weight:bold' color=red>BONUS</font> " ;
              $databayar['keterangan'] = " <font style='font-weight:bold' color=red>BONUS</font> " ; 
              $databayar['iuran'] = " <font style='font-weight:bold' color=red>BONUS</font> " ;  
              $pas = 0 ;
            } 
            if(strtotime($databayar['tgl']) > strtotime($cperiode)) $databayar['tgl'] = " <font style='font-weight:bold;font-style:italic' color=red>" . $databayar['tgl'] . "</font> " ;
            $data[$n++] = array("no"=>$n,"nama"=>$dbr['nama'] . "-" . $pas . "-" . $bom . "-" . $eom . "-" . $pas . "--" . $dtoleransi . "--" . $cperiode, 
                                "tgl"=>$cperiode,"keterangan"=>"Iuran Bulanan ","jumlah"=>$njumlah, 
                                "tglbayar"=>$databayar['tgl'],"keteranganbayar"=>$databayar['keterangan'],"jumlahbayar"=>$databayar['iuran'] ) ; 
            $nwajib += $dbr['jumlah'] ;     
            $dperiode  = date_2s($cperiode) ;               
            
         } 
         
         
      } 
      
      return array("data"=>$data, "rows"=>$n) ;
   }

   public function stpelanggan($va){
      $id = $va['pelanggan'] ;
      $n = 0 ;
      $tgl      = date("Y-m-d") ;
      $where    = "kode = '$id'" ; 
      $dba      = $this->select("pelanggan", "statuspelanggan", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $n   = $dbra['statuspelanggan'] ; 
      }

      return $n ;
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

   public function trpelanggan($va){
      $id = $va['pelanggan'] ;
      $tr = $va['tarif'] ;
      $n = 0 ;
      $tgl      = date("Y-m-d") ; 
      $where    = "kode = '$tr' and tgl <= '$tgl'" ;
      $dba      = $this->select("tarif", "jumlah", $where) ;
      if($dbra  = $this->getrow($dba)){ 
         $n   = $dbra['jumlah'] ;
      }

      $where    = "tgl <= '$tgl' and pelanggan = '$id' and tarif = '$tr'" ;
      $dba      = $this->select("pelanggan_tarif", "jumlah", $where, "", "", "id DESC","0,1") ;
      if($dbra  = $this->getrow($dba)){ 
         $n   = $dbra['jumlah'] ;
      } 

      return $n ;
   }
  
  public function isholiday($nTime){
    $vaTgl = getdate($nTime) ;
    $lRetval = false ;
    if($vaTgl ['wday'] == 0){
      //$lRetval = true ;
    }else{
      $cTgl = date("Y-m-d",$nTime) ;  
      $dbData = $this->select("harilibur","tgl","tgl = '$cTgl'") ;
      if($this->rows($dbData) > 0){
        $lRetval = true ; 
      }
    }
    return $lRetval ;
  }
   
}
?>