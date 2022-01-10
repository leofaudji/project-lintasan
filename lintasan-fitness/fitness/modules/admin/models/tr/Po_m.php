<?php
class Po_m extends Bismillah_Model{
   public function getcode($u=false){
      $k    = "B" . date("ymd") ;
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
      $f        = "id recid, faktur, jenis, tgl, tgl_aktif, id_supplier, total,
                  retur_faktur, retur_keterangan, retur_tgl, retur_username" ;
      $dbd      = $this->select("brg_beli_total", $f, $where, "", "", "id DESC", $limit) ;

      $row      = 0 ;
      $dba      = $this->select("brg_beli_total", "COUNT(id) id", $where) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }

      return array("db"=>$dbd, "rows"=> $row) ;
   }

   public function saving($va, $id, $faktur, $lfill=false){
      $tgl      = date("Y-m-d") ;
      if($faktur == ''){
         $faktur    = $this->getcode(true) ;
      }

      $all_tot  = 0 ;
      $all_qty  = 0 ;
      foreach ($va['ss'] as $key => $value) {
         $ssid  = $value['id'] ;
         $total = $value['qty'] * $value['harga'] ;
         $vu    = array("tgl"=>$tgl, "id_brg"=>$value['id_brg'], "qty"=>$value['qty'],
                        "harga"=>$value['harga'], "total_sub"=>$total, "total"=>$total,
                        "faktur"=>$faktur) ;
         $w     = "id = " . $this->escape($ssid) ;
         $this->update("brg_beli", $vu, $w) ;
         $all_tot    += $total ;
         $all_qty    += $value['qty'] ; 
      }

      $vu   = array("faktur"=>$faktur, "tgl"=>$tgl, "qty"=>$all_qty,
                     "id_supplier"=>$va['id_supplier'], "total_sub"=>$all_tot,
                     "total"=>$all_tot, "bayar"=>$all_tot, "username"=>getsession($this, "username")) ;
      if(isset($va['jenis'])) $vu['jenis'] = $va['jenis'] ;
      if($lfill) $vu['tgl_aktif'] = $tgl ;
      $w    = "id = " . $this->escape($id) ;
      $this->update("brg_beli_total", $vu, $w) ;

      return $faktur ;
   }

   public function editing($id=''){
      $r = $this->getval("id, jenis, faktur, tgl, id_supplier, keterangan", "id = " . $this->escape($id), "brg_beli_total");
      if(!empty($r)){
         $r['item'] = array() ;
         $db = $this->select("brg_beli", "*", "faktur = " . $this->escape($r['faktur'])) ;
         while($dbr = $this->getrow($db)){
            $r['item'][] = $dbr ;
         }
      }
      return $r ;
   }
}
?>
