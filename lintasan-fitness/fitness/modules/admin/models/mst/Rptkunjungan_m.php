<?php
class Rptkunjungan_m extends Bismillah_Model{
   
   public function loadgrid($va){  
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $va['tglawal'] = date_2s($va['tglawal']) ; 
      $va['tglakhir'] = date_2s($va['tglakhir']) ; 
      $where    = array("pb.tgl >= '".$va['tglawal']."' and pb.tgl <= '".$va['tglakhir']."' ") ;       
      if($search !== "") $where[]   = "(p.kode LIKE '{$search}%' OR p.nama LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
         
      $f        = "p.id no,p.kode,pb.faktur,pb.tgl,p.nama,pb.keterangan,pb.pendaftaran,pb.iuran,pb.sewagedung,pb.suplemen,pb.username" ;    
      $join     = "left join pelanggan p on p.kode = pb.pelanggan"  ; 
      $dbd      = $this->select("pelanggan_bayar pb", $f, $where, $join, "", "pb.id ASC", $limit) ;

      $row      = 0 ; 
      $dba      = $this->select("pelanggan_bayar pb", "COUNT(pb.id) id", $where,$join) ; 
      if($dbra  = $this->getrow($dba)){ 
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row ) ; 
   }  

   public function getmutasi($faktur){ 
      $va = array() ;
      $join = "left join pelanggan p on p.kode = pb.pelanggan" ;
      $dba      = $this->select("pelanggan_bayar pb", "pb.*,p.nama","pb.faktur = '$faktur'",$join) ;
      if($dbra  = $this->getrow($dba)){
         $va   = $dbra ; 
      } 
      return $va ;
   } 
 
}
?>
