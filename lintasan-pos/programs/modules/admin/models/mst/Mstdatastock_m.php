<?php
class Mstdatastock_m extends Bismillah_Model{
   public function loadgrid($va){
      $limit    = $va['offset'].",".$va['limit'] ;
      $search	 = $va['search'];
      $search   = $this->escape_like_str($search) ;
      $where 	 = array() ;
      if($search !== "") $where[]	= "(s.kode LIKE '{$search}%' OR s.keterangan LIKE '%{$search}%' OR s.barcode LIKE '%{$search}%')" ;
      $where 	 = implode(" AND ", $where) ;
      $join     = "left join stock_group g on g.Kode = s.stock_group";
      $field    = "s.*,g.Keterangan as KetStockGroup";
      $dbd      = $this->select("stock s", $field, $where, $join, "", "s.kode ASC") ;
      $dba      = $this->select("stock s", "s.id", $where) ;

      return array("db"=>$dbd, "rows"=> $this->rows($dba) ) ;
   }


   public function saving($kode, $va){
      $kode = getsession($this, "ssstock_kode", "");
      $va['kode'] = $kode !== "" ? $va['kode'] : $this->getkode() ;
      // save data stock
      $data    = array("kode"=>$va['kode'],"barcode"=>$va['barcode'],"satuan"=>$va['satuan'],"stock_group"=>$va['group'], 
                       "jenis"=>"P","keterangan"=>$va['keterangan'], "username"=> getsession($this, "username")) ;
      $where   = "kode = " . $this->escape($va['kode'] ) ;
      $this->update("stock", $data, $where, "") ;
      
      //insert harga
      $vaGrid = json_decode($va['grid2']);
      $this->delete("stock_hj", "Kode = '{$va['kode']}'" ) ;
       foreach($vaGrid as $key => $val){
           $vadetail = array("kode"=>$va['kode'],
                             "qty"=>$val->qty,
                             "hj"=>$val->harga);
           $this->insert("stock_hj",$vadetail);
       }

   }
   public function getdata($kode){
      $data = array() ;
      $where 	 = "s.kode = " . $this->escape($kode);
      $join     = "left join stock_group g on g.Kode = s.stock_group left join satuan t on t.kode = s.satuan";
      $field    = "s.*,g.Keterangan as KetStockGroup,t.Keterangan as KetSatuan";
      $dbd      = $this->select("stock s", $field, $where, $join, "", "s.kode ASC","1") ;
	  return $dbd;
   }
   public function getdatabybarcode($barcode,$kode){
      $data = array() ;
      $where 	 = "s.barcode = " . $this->escape($barcode) . " and s.kode <> ".$this->escape($barcode);
      $join     = "left join stock_group g on g.Kode = s.stock_group left join satuan t on t.kode = s.satuan";
      $field    = "s.*,g.Keterangan as KetStockGroup,t.Keterangan as KetSatuan";
      $dbd      = $this->select("stock s", $field, $where, $join, "", "s.kode ASC","1") ;
	  return $dbd;
   }
    
   public function getdatahj($kode){
        $field = "hj harga,qty";
        $where = "kode = '$kode'";
        $join  = "";
        $dbd   = $this->select("stock_hj", $field, $where, $join,"","qty asc") ;
        return $dbd ;
    }

   public function deleting($kode){
      $this->delete("stock", "kode = " . $this->escape($kode)) ;
   }

   public function seeksatuan($search){
      $where = "kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%'" ;
      $dbd      = $this->select("satuan", "*", $where, "", "", "keterangan ASC", '50') ;
      return array("db"=>$dbd) ;
   }

   public function seekgroup($search){
      $where = "kode LIKE '%{$search}%' OR keterangan LIKE '%{$search}%'" ;
      $dbd      = $this->select("stock_group", "*", $where, "", "", "keterangan ASC", '50') ;
      return array("db"=>$dbd) ;
   }

   public function getkode($l=true){
      $y    = date("ym");
      $n    = $this->getincrement("stockkode" . $y, $l, 6);
      $n    = $y.$n ;
      return $n ;
   }
}
?>
