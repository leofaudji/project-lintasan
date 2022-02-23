<?php
class Trkreditpencairan_m extends Bismillah_Model{   
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
      $where 	 = array("t.id_kantor = '$id_kantor' and t.status_cair = '0'") ;    
      if($search !== "") $where[]	= "(t.kode_anggota LIKE '%{$search}%' OR m.nama LIKE '%{$search}%' OR m.alamat LIKE '%{$search}%' )" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "t.*,m.nama,m.alamat" ;     
      $dbd      = $this->select("kredit_rekening t", $f, $where, "left join mst_anggota m on m.kode = t.kode_anggota", "", "t.id DESC", $limit) ;
 
      $row      = 0 ;
      $dba      = $this->select("kredit_rekening t", "COUNT(t.id) id", $where, "left join mst_anggota m on m.kode = t.kode_anggota") ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      } 
      return array("db"=>$dbd, "rows"=> $row ) ;
   }

   public function saving($va, $id){       
      $f    = $va ; 
      $this->kredit_m->setpencairan($f['rekening']);   
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("*", $w, "kredit_rekening") ;
      return !empty($d) ? $d : false ; 
   }

}
?>
