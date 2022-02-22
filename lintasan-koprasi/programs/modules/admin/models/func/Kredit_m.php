<?php
class Kredit_m extends Bismillah_Model{ 
   var $data_agunan = array() ;

   public function gettgltransaksi(){
      $tgl = date("Y-m-d") ;
      $tgl = date_2s($tgl) ;
      return $tgl ; 
   }

   public function getfaktur($l=true){
      $k       = "TB" . getsession($this,"kode_kantor") . date("ymd") ;          
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
      $customer = getsession($this,"customer") ;
      $debet = $f['jumlah'] ;
      $kredit = 0 ;
      $dk = "D" ;

      $w = "customer = '$customer' AND kode = '{$f['kode_transaksi']}'" ;
      $db  = $this->select("tabungan_kodetransaksi", "dk", $w) ; 
      if($dbr  = $this->getrow($db)){ 
         $dk   = $dbr['dk'] ;     
      }
      
      if($dk == "K"){
         $debet = 0 ;
         $kredit = $f['jumlah'] ; 
      }

      $va   = array("id_kantor"=>$f['id_kantor'],"faktur"=>$f['faktur'],"tgl"=>$f['tgl'],
                    "rekening"=>$f['rekening'],"kode_transaksi"=>$f['kode_transaksi'],
                    "keterangan"=>$f['keterangan'],"debet"=>$debet,"kredit"=>$kredit, 
                    "datetime"=>$f['datetime'],"username"=>$f['username']) ; 
      $this->insert("tabungan_mutasi", $va) ;  
      $this->setmutasi_bukubesar($f['faktur']) ;
   }

   public function setmutasi_bukubesar($faktur){
      $id_kantor = getsession($this,"id_kantor") ;
      $customer  = getsession($this,"customer") ;  
      $f = "tm.*,tg.rekening rekeninggolongan,tk.rekening rekeningkodetransaksi,tk.dk" ;    
      $w = "tm.id_kantor = '$id_kantor' AND tm.faktur = '$faktur'" ;  
      $join = "left join kredit_rekening tr on tr.id_kantor = tm.id_kantor AND tr.rekening = tm.rekening
               left join tabungan_golongan tg on tg.kode = tr.golongan_tabungan AND tg.customer = '$customer'
               left join tabungan_kodetransaksi tk on tk.kode = tm.kode_transaksi AND tk.customer = '$customer'" ;  
      $db  = $this->select("tabungan_mutasi tm", $f, $w,$join) ;  
      if($row  = $this->getrow($db)){  
         $tgl  = $row['tgl']  ;      
         $dk   = $row['dk'] ;
         $rekening   = $row['rekening'] ;
         $debet      = $row['debet'] ;
         $kredit     = $row['kredit'] ;
         $keterangan = $row['keterangan']  ;
         $datetime   = date_now() ; 
         $username   = $row['username'] ;
         
         $rekeningkas = getsession($this,"rekening_kas") ; 
         $rekeninggol = $row['rekeninggolongan'] ;
         $rekeningkt  = $row['rekeningkodetransaksi'] ;

         if($dk == "K"){
            $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeningkas,$keterangan,$kredit,0,$datetime,$username) ;
               $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeninggol,$keterangan,0,$kredit,$datetime,$username) ;
         }else{ 
            $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeninggol,$keterangan,$debet,0,$datetime,$username) ;
               $this->setbukubesar($id_kantor,$faktur,$tgl,$rekeningkas,$keterangan,0,$debet,$datetime,$username) ;
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

   public function getangsuran($cp,$plafond,$sukubunga,$lama,$musiman=1){
      $va = array("pokok" => 0,"bunga" => 0) ;
      if($plafond > 0 AND $lama > 0 AND $sukubunga > 0){ 
         if($cp == "1"){ //flat
            $va['pokok'] = $plafond / $lama ;
            $va['bunga'] = ($plafond * $sukubunga / 100) / $lama ;
         }else if($cp == "3"){ //flat
            $va['pokok'] = $plafond / $lama ;
            $va['bunga'] = ($plafond * $sukubunga / 100) / $lama ;
         }else if($cp == "10"){ //flat
            $va['pokok'] = $plafond / $lama ;
            $va['bunga'] = ($plafond * $sukubunga / 100) / $lama ;
         }     
      }

      return $va ; 
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
         $angsuran = $this->getangsuran($dbr['caraperhitungan'],$dbr['plafond'],$dbr['sukubunga'],$dbr['lama'],1) ;    
         $dbr['kpokok'] = $angsuran['pokok'] ;
         $dbr['kbunga'] = $angsuran['bunga'] ;        
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

}
?>
