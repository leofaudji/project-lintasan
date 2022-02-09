<?php
class Trkreditangsuran_m extends Bismillah_Model{   
   public function getkode($u=true){
      $k       = "AG" . getsession($this,"kode_kantor") . date("ymd") ;           
      return $k . $this->getincrement($k, $u, 4) ; 
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
  
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ; 
      $where 	 = array("t.id_kantor = '$id_kantor' AND t.rekening = '01.71.000004.01' ") ;     
      if($search !== "") $where[]	= "(t.keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "t.*" ;     
      $dbd      = $this->select("kredit_angsuran t", $f, $where, "", "", "t.id ASC", $limit) ; 
 
      $row      = 0 ;
      $dba      = $this->select("kredit_angsuran t", "COUNT(t.id) id", $where, "") ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      } 
      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function saving($va, $id){       
      $f    = $va ; 
      $f['tgl']  = date_2s($f['tgl']) ; 

      $id_kantor = getsession($this,"id_kantor")  ;

      if($id == ""){       
         $f['id_kantor']   = $id_kantor ;     
         //$f['faktur']      = $this->getkode() ;    
         $freq             = $this->getfrekuensi($f['id_kantor'],$f['kode_anggota'],$f['golongan_kredit']) ;    
         $f['rekening']    = implode(".",array(getsession($this,"kode_kantor"),$f['golongan_kredit'],$f['kode_anggota'],$freq)) ; 
         $f['datetime']    = date_now() ; 
         $f['username']    = getsession($this, "username") ;  
      } 
      
      // untuk data kredit
      $data_kredit = $f ;
      unset($data_kredit['jenis_agunan']);
      unset($data_kredit['nilai_agunan']);
      unset($data_kredit['data_agunan']); 

      $w    = "id = " . $this->escape($id) ; 
      $this->update("kredit_rekening", $data_kredit, $w) ; 
  
      
      $n = 0 ;
      $where = "id_kantor = '$id_kantor' and kode_anggota = '{$f['kode_anggota']}'" ;
      $dba      = $this->select("kredit_agunan_tmp", "*", $where) ; 
      while($dbra  = $this->getrow($dba)){
         $data_agunan = array(
            "id_kantor"    => $dbra['id_kantor'],
            "kode_anggota" => $f['kode_anggota'],
            "no_agunan"    => ++$n,      
            "jenis_agunan" => $dbra['jenis_agunan'],
            "nilai_agunan" => $dbra['nilai_agunan'],
            "rekening"     => $f['rekening'],
            "data_agunan"  => $dbra['data_agunan'],   
            "username"     => $dbra['username'],
            "datetime"     => $dbra['datetime'] 
         ) ;   
 
         $w    = "id = " . $this->escape($id) ; 
         $this->update("kredit_agunan", $data_agunan, $w) ;  
         $this->removeagunan($dbra['id_key']) ;  
      } 
      
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("*", $w, "kredit_rekening") ;
      return !empty($d) ? $d : false ;
   }
}
?>
