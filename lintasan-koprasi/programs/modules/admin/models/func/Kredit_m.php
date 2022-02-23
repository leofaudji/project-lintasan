<?php
class Kredit_m extends Bismillah_Model{ 
   var $data_agunan = array() ;

   public function gettgltransaksi(){
      $tgl = date("Y-m-d") ;
      $tgl = date_2s($tgl) ;
      return $tgl ;  
   }

   public function getfaktur($f="AG",$l=true){
      $k       = $f . getsession($this,"kode_kantor") . date("ymd") ;           
      return $k . $this->getincrement($k, $l, 6) ;    
   } 

   function getfrekuensi($id_kantor,$kode_anggota,$golongan_kredit){
      $row      = 0 ;
      $w = "id_kantor = '$id_kantor' and kode_anggota = '$kode_anggota' and golongan_kredit = '$golongan_kredit'" ;
      $dba      = $this->select("kredit_rekening", "COUNT(id) id", $w,"") ;  
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      } 
      $row++ ; 
      return str_pad($row, 2, "0", STR_PAD_LEFT); ; 
   } 

   public function loadgrid_rekening($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where    = array("t.id_kantor = '$id_kantor' AND t.status_cair = '1' AND t.status_lunas = '0'") ;    
      //$where[]  = "jenis = 'P'" ;
      if($search !== "") $where[]  = "(t.rekening LIKE '{$search}%' OR m.kode LIKE '{$search}%' OR m.nama LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
      $join     = "left join mst_anggota m on t.id_kantor = m.id_kantor AND m.kode = t.kode_anggota" ;  
      //$limit    = "0,10" ;
      $dbd      = $this->select("kredit_rekening t", "m.kode,t.rekening,m.nama,m.alamat,m.telepon", $where, $join, "", "t.id DESC", $limit) ; 
      $dba      = $this->select("kredit_rekening t", "t.id", $where,$join) ;      

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }

   public function loadgrid_rekening_realisasi($va){   
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;  
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where    = array("t.id_kantor = '$id_kantor' AND t.status_cair = '0'") ;  
      //$where[]  = "jenis = 'P'" ;
      if($search !== "") $where[]  = "(t.rekening LIKE '{$search}%' OR m.kode LIKE '{$search}%' OR m.nama LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
      $join     = "left join mst_anggota m on t.id_kantor = m.id_kantor AND m.kode = t.kode_anggota" ; 
      $dbd      = $this->select("kredit_rekening t", "m.kode,t.rekening,m.nama,m.alamat,m.telepon", $where, $join, "", "t.id DESC", $limit) ; 
      $dba      = $this->select("kredit_rekening t", "t.id", $where,$join) ;     

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }

   public function getdata_rekening($rekening){
      $data = array() ;
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where = "id_kantor = '$id_kantor' AND rekening = " . $this->escape($rekening);
      if($d = $this->getval("*",$where, "kredit_rekening")){
          $data = $d; 
      }
      return $data ;
  }


   public function setmutasi($f){  
      $va   = array("id_kantor"=>$f['id_kantor'],"faktur"=>$f['faktur'],"tgl"=>$f['tgl'],
                    "rekening"=>$f['rekening'],"keterangan"=>$f['keterangan'],
                    "dpokok"=>string_2n($f['dpokok']),"kpokok"=>string_2n($f['kpokok']),"dbunga"=>string_2n($f['dbunga']),
                    "kbunga"=>string_2n($f['kbunga']),"kelebihan"=>string_2n($f['kelebihan']),"denda"=>string_2n($f['denda']),
                    "dtitipan"=>string_2n($f['dtitipan']),"ktitipan"=>string_2n($f['ktitipan']),  
                    "datetime"=>$f['datetime'],"username"=>$f['username']) ; 
      $this->insert("kredit_angsuran", $va) ;  
      $this->setmutasi_bukubesar($f['faktur']) ;
   }

   public function setmutasi_bukubesar($faktur){
      $id_kantor = getsession($this,"id_kantor") ;
      $customer  = getsession($this,"customer") ;  
      $f = "a.*,k.provisi,k.administrasi,k.materai,g.rekening_pokok,g.rekening_bunga,g.rekening_provisi,g.rekening_administrasi,rekening_materai,g.rekening_denda" ;    
      $w = "a.id_kantor = '$id_kantor' AND a.faktur = '$faktur'" ;  
      $join = "left join kredit_rekening k on k.id_kantor = a.id_kantor AND k.rekening = a.rekening
               left join kredit_golongan g on g.kode = k.golongan_kredit AND g.customer = '$customer'" ;   
      $db  = $this->select("kredit_angsuran a", $f, $w,$join) ;  
      if($row  = $this->getrow($db)){  
         $tgl  = $row['tgl']  ;      
         
         $angsuran      = $row['kpokok'] + $row['kbunga'] + $row['kelebihan'] + $row['denda'] + $row['ktitipan'] ;
         $rekeningkas   = getsession($this,"rekening_kas") ; 
         $keterangan    = $row['keterangan'] ;	
         $datetime      = date_now() ; 
         $username      = $row['username'] ;

         if(substr($row['faktur'],0,2) == "R0"){ // Jika Pencairan Realisasi   
            $this->setbukubesar($id_kantor,$faktur,$tgl,$row['rekening_pokok'],$keterangan,$row['dpokok'],0,$datetime,$username) ;
               $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeningkas,$keterangan,0,$row['dpokok'],$datetime,$username) ;
         
            $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeningkas,$keterangan,$row['provisi'],0,$datetime,$username) ;
               $this->setbukubesar($id_kantor,$faktur,$tgl,$row['rekening_provisi'],"By. Provisi " . $keterangan,0,$row['provisi'],$datetime,$username) ;

            $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeningkas,$keterangan,$row['administrasi'],0,$datetime,$username) ;
               $this->setbukubesar($id_kantor,$faktur,$tgl,$row['rekening_administrasi'],"By. Administrasi " . $keterangan,0,$row['administrasi'],$datetime,$username) ;

            $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeningkas,$keterangan,$row['materai'],0,$datetime,$username) ;
               $this->setbukubesar($id_kantor,$faktur,$tgl,$row['rekening_materai'],"By. Materai " . $keterangan,0,$row['materai'],$datetime,$username) ;

         }else{ // Jika Trx Angsuran 
            $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeningkas,$keterangan,$angsuran,0,$datetime,$username) ; 
            $this->setbukubesar($id_kantor,$faktur,$tgl,$row['rekening_pokok'],"Pokok " . $keterangan,0,$row['kpokok'],$datetime,$username) ;
            $this->setbukubesar($id_kantor,$faktur,$tgl,$row['rekening_bunga'],"Bunga " . $keterangan,0,$row['kbunga'],$datetime,$username) ;
               $this->setbukubesar($id_kantor,$faktur,$tgl,$row['rekening_denda'],"Denda " . $keterangan,0,$row['denda'],$datetime,$username) ;
         }
         
      }
   }

   public function setbukubesar($id_kantor,$faktur,$tgl,$rekening,$keterangan,$debet,$kredit,$datetime,$username){
      if(($debet <> 0 || $kredit <> 0) && trim($rekening) !== ""){
         $va   = array("id_kantor"=>$id_kantor,"faktur"=>$faktur,"tgl"=>$tgl,
                    "rekening"=>$rekening,"keterangan"=>$keterangan,
                    "debet"=>$debet,"kredit"=>$kredit,  
                    "datetime"=>$datetime,"username"=>$username) ; 
         $this->insert("keuangan_bukubesar", $va) ;  
      }
   }

   public function getke($tglrealisasi,$tgl,$lama){
      $tglrealisasi = date_2d($tglrealisasi); 
      $tgl = date_2d($tgl);
      //print($tglrealisasi . " - " . $tgl) ; 
      $ntglrealisasi = strtotime($tglrealisasi) ;
      $ntgl = strtotime($tgl) ; 
      $ke = 0 ;
      $x = 0 ;
      while($x <= $ntgl){
        $ke ++ ;
        $x = date_nextmonth($ntglrealisasi,$ke) ; 
      }
      //$ke -- ; 
      return min($ke,$lama) ; 
    }

   public function getangsuran($dTgl,$nLama,$nPlafond,$nSukuBunga,$cCaraPerhitungan){

      $vaArray[]  = array("Ke"=>0,"Pokok"=>0,"Bunga"=>0,"BakiDebet"=>0);
      $nPlafond   = $nPlafond; 
      $nBakiDebet = $nPlafond;
      $nBunga	  = 0;
      $nPokok	  = 0;
      
      
      $nPokok = $nPlafond/$nLama;
      $nBunga = $nPlafond * $nSukuBunga / 100 / 12;
      
      for($n=1;$n<=$nLama;$n++){
       if($cCaraPerhitungan == 1){ //flat
          $nBakiDebet -= $nPokok ;
       }else if($cCaraPerhitungan == 3){ //reguler / sliding
          $nPokok = 0 ;
          if($n == $nLama) $nPokok = $nPlafond;
          $nBakiDebet -= $nPokok ;
       }else if($cCaraPerhitungan == 3){ //flat menurun
          $nBunga      = (($nBakiDebet * $nSukuBunga)/100/12)/$nLama ;
          $nBakiDebet -= $nPokok ;
          $nPlafond   -= $nPokok;
       }
       $vaArray[$n] = array("pokok"=>$nPokok,"bunga"=>$nBunga,"ke"=>$n,"bakidebet"=>$nBakiDebet);
      }
      return $vaArray;
    }

   public function getbakidebet($tgl,$rekening){
      $saldo      = 0 ;
      $tgl        = date_2s($tgl) ;
      $id_kantor  = getsession($this,"id_kantor") ; 
      $where      = "id_kantor = '$id_kantor' AND tgl <= '$tgl' AND rekening = " . $this->escape($rekening);

      $db =  $this->select("kredit_angsuran", "sum(dpokok-kpokok) saldo", $where) ;
      if($dbr  = $this->getrow($db)){
         $saldo = $dbr['saldo'];  
      }
      return $saldo ;     
   }

   public function getdata_kredit($rekening){
      $data = array() ;
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where = "id_kantor = '$id_kantor' AND rekening = " . $this->escape($rekening);
      $tgl = $this->gettgltransaksi() ; 
      $db =  $this->select("kredit_rekening", "*", $where) ;
      if($dbr  = $this->getrow($db)){
         $dbr['tgl'] = date_2d($dbr['tgl']) ; 
         $dbr['jthtmp'] = date("d-m-Y",date_nextmonth(strtotime($dbr['tgl']),$dbr['lama'])) ;      
         $dbr['bakidebet'] = $this->getbakidebet($tgl,$rekening) ;
         $angsuran = $this->getangsuran($tgl,$dbr['lama'],$dbr['plafond'],$dbr['sukubunga'],$dbr['caraperhitungan']) ;
         $dbr['kpokok'] = $angsuran[1]['pokok'] ;
         $dbr['kbunga'] = $angsuran[1]['bunga'] ;        
         $data = $dbr;  
      }
      return $data ;       
  }

  public function simulasi_GetAngsuran($dTgl,$nLama,$nPlafond,$nSukuBunga,$cCaraPerhitungan){

   $vaArray[]  = array("Ke"=>0,"Pokok"=>0,"Bunga"=>0,"BakiDebet"=>0);
   $nPlafond   = $nPlafond;
   $nBakiDebet = $nPlafond;
   $nBunga	  = 0;
   $nPokok	  = 0;
   
   
   $nPokok = $nPlafond/$nLama;
   $nBunga = $nPlafond * $nSukuBunga / 100 / 12;
   
   for($n=1;$n<=$nLama;$n++){
    if($cCaraPerhitungan == 1){ //flat
       $nBakiDebet -= $nPokok ;
    }else if($cCaraPerhitungan == 3){ //reguler / sliding
       $nPokok = 0 ;
       if($n == $nLama) $nPokok = $nPlafond;
       $nBakiDebet -= $nPokok ;
    }else if($cCaraPerhitungan == 3){ //flat menurun
       $nBunga      = (($nBakiDebet * $nSukuBunga)/100/12)/$nLama ;
       $nBakiDebet -= $nPokok ;
       $nPlafond   -= $nPokok;
    }
    $vaArray[$n] = array("Pokok"=>$nPokok,"Bunga"=>$nBunga,"Ke"=>$n,"BakiDebet"=>$nBakiDebet);
   }
   return $vaArray;
 }

 public function setpencairan($rekening){
   $data = array() ;
   $id_kantor   = getsession($this,"id_kantor") ; 
   $where = "t.id_kantor = '$id_kantor' AND t.rekening = " . $this->escape($rekening);
   $join = "LEFT JOIN mst_anggota m on m.kode = t.kode_anggota AND m.id_kantor = t.id_kantor" ; 
   $db =  $this->select("kredit_rekening t", "t.*", $where,$join) ;  
   if($dbr  = $this->getrow($db)){
      $faktur = $this->getfaktur("R0") ; 

      // edit status_cair debitur
      $this->update("kredit_rekening",array("faktur"=>$faktur,"status_cair"=>"1"),"id_kantor = '$id_kantor' AND rekening = " . $this->escape($rekening));

      $dbunga = ($dbr['plafond'] * $dbr['sukubunga'] / 100 / 12) * $dbr['lama'] ; 

      // insert angsuran
      $f = array("id_kantor"=>$id_kantor,"faktur"=>$faktur,"tgl"=>$dbr['tgl'],"rekening"=>$rekening,"keterangan"=>"Realisasi Kredit",
               "dpokok"=>$dbr['plafond'],"kpokok"=>0,"dbunga"=>$dbunga,"kbunga"=>0,"kelebihan"=>0,"denda"=>0,"dtitipan"=>0,"ktitipan"=>0,  
               "datetime"=>date_now(),"username"=>getsession($this,"username")
            ) ; 
      $this->setmutasi($f) ;
   }
 } 

}
?>
