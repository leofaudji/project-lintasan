<?php
class Tabungan_m extends Bismillah_Model{

   public function getfaktur($l=true){
      $k       = "TB" . getsession($this,"kode_kantor") . date("ymd") ;          
      return $k . $this->getincrement($k, $l, 6) ;    
   } 

   public function loadgrid_rekening($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where    = array("t.id_kantor = '$id_kantor'") ;  
      //$where[]  = "jenis = 'P'" ;
      if($search !== "") $where[]  = "(t.rekening LIKE '{$search}%' OR m.kode LIKE '{$search}%' OR m.nama LIKE '%{$search}%'  OR m.alamat LIKE '%{$search}%'  OR m.telepon LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
      $join     = "left join mst_anggota m on t.id_kantor = m.id_kantor AND m.kode = t.kode_anggota" ; 
      $dbd      = $this->select("tabungan_rekening t", "m.kode,t.rekening,m.nama,m.alamat,m.telepon", $where, $join, "", "t.id DESC", $limit) ; 
      $dba      = $this->select("tabungan_rekening t", "t.id", $where,$join) ;    

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }

   public function getdata_rekening($rekening){
      $data = array() ;
      $id_kantor   = getsession($this,"id_kantor") ; 
      $where = "id_kantor = '$id_kantor' AND rekening = " . $this->escape($rekening);
      if($d = $this->getval("*",$where, "tabungan_rekening")){
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
      $join = "left join tabungan_rekening tr on tr.id_kantor = tm.id_kantor AND tr.rekening = tm.rekening
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

}
?>
