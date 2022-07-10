<?php
class Mstgolaktivainventaris_m extends Bismillah_Model{

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ; 
      if($search !== "") $where[]	= "(keterangan LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $f        = "id,kode,keterangan,rekakmpeny,rekbypeny,jenis" ; 
      $dbd      = $this->select("aset_golongan", $f, $where, "", "", "kode ASC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("aset_golongan", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   } 

   public function saving($va, $id){ 
       
      $data    = array("kode"=>$va['kode'],"keterangan"=>$va['keterangan'],"rekakmpeny"=>$va['rekakmpeny'],
                       "rekbypeny"=>$va['rekbypeny'],"jenis"=>$va['jenis']) ;
      $where   = "kode = " . $this->escape($va['kode']) ;
      $this->update("aset_golongan", $data, $where, "") ;
   }

   public function getdata($kode=''){

      /*$w    = "kode = " . $this->escape($kode) ;  
      $d    = $this->getval("id,kode,keterangan", $w, "aset_golongan") ;
      return !empty($d) ? $d : false ;*/
      $where 	 = "a.kode = " . $this->escape($kode);
      $join     = "left join keuangan_rekening r1 on r1.kode = a.rekakmpeny left join keuangan_rekening r2 on r2.kode = a.rekbypeny";
      $field    = "a.kode,a.keterangan,a.rekakmpeny,a.rekbypeny,r1.keterangan as ketrekakmpeny,
                   r2.keterangan as ketrekbypeny,a.jenis";
      $dbd      = $this->select("aset_golongan a", $field, $where, $join, "", "a.kode ASC","1") ;
	  return $dbd;
   }

   public function seekrekakmpeny($search){
      $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%') and Jenis = 'D'" ;
      $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "keterangan ASC", '50') ;
      return array("db"=>$dbd) ;
   }

   public function seekrekbypeny($search){
      $where = "(kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%') and Jenis = 'D'" ;
      $dbd      = $this->select("keuangan_rekening", "*", $where, "", "", "keterangan ASC", '50') ;
      return array("db"=>$dbd) ;
   }
    


}
?>
