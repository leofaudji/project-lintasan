<?php
class So_m extends Bismillah_Model{
   public function getcode($u=false){
      $k    = "O" . date("ymd") ;
      return $k . $this->getincrement($k, $u, 4) ;
   }

   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ;
      if($search !== ""){
         $sfield  = $va['search'][0]['field'] ;
         if($sfield == "tgl"){
            $vd   = explode("/", $search) ;
            $search = $vd[2] . "-" . $vd[0] . "-" . $vd[1] ;
         }
         $where[]	= "".$sfield." LIKE '{$search}%'" ;
      }
      $where 	 = implode(" AND ", $where) ;
      $f        = "*, id recid" ;
      $dbd      = $this->select("brg_opname_total", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("brg_opname_total", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row) ;
   }

   public function saving($va){
      $tgl   = date("Y-m-d") ;
      $f     = $this->getcode(true) ;
      $tot   = 0 ;
      foreach ($va['ss'] as $key => $v) {
         $tot   = $v['total'] ;
         $save  = array("faktur"=>$f, "tgl"=>$tgl,  "stok"=>$v['stok'], "stok_ac"=>$v['stok_ac'],
                        "qty"=>$v['qty'], "harga"=>$v['harga'], "total"=>$v['total'],
                        "keterangan"=>$va['keterangan'], "id_brg"=>$v['id_brg']) ;
         $this->insert("brg_opname", $save) ;
      }

      $save     = array("faktur"=>$f, "tgl"=>$tgl, "total"=>$tot, "keterangan"=>$va['keterangan'],
                        "username"=>getsession($this, "username")) ;
      $this->insert("brg_opname_total", $save) ;
      return $f ;
   }
}
?>
