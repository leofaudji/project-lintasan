<?php
class Trkreditangsuran_m extends Bismillah_Model{   
   public function getkode($u=true){
      $k       = "AG" . getsession($this,"kode_kantor") . date("ymd") ;           
      return $k . $this->getincrement($k, $u, 4) ; 
   } 
  
   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $id_kantor = getsession($this,"id_kantor") ; 
      $where 	 = array("t.id_kantor = '$id_kantor' AND t.rekening = '{$va['rekening']}' ") ;     
      //print_r($where) ;
      if($search !== "") $where[]	= "(t.keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "t.*" ;     
      $dbd      = $this->select("kredit_angsuran t", $f, $where, "", "", "t.tgl ASC", $limit) ; 
 
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
      $d   = array("id_kantor"=>getsession($this,"id_kantor"),"faktur"=>$this->kredit_m->getfaktur("AG"),"tgl"=>$f['tgl'],
                    "rekening"=>$f['rekening'],"keterangan"=>$f['keterangan'],
                    "dpokok"=>0,"kpokok"=>$f['kpokok'],"dbunga"=>0,
                    "kbunga"=>$f['kbunga'],"kelebihan"=>$f['kelebihan'],"denda"=>$f['denda'],
                    "dtitipan"=>$f['dtitipan'],"ktitipan"=>$f['ktitipan'],  
                    "datetime"=>date_now(),"username"=>getsession($this,"username") 
      ) ;
      $this->kredit_m->setmutasi($d) ;            
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ;  
      $d    = $this->getval("*", $w, "kredit_rekening") ;
      return !empty($d) ? $d : false ;
   }
}
?>
