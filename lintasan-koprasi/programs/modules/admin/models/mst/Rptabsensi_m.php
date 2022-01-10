<?php
class Rptabsensi_m extends Bismillah_Model{
   public function getkode($u=true){
      $k       = "PEL" ;
      return $k . $this->getincrement($k, $u, 4) ;
   } 

   public function loadgrid($va){ 
      $limit    = $va['offset'].",".$va['limit'] ;
      $search   = isset($va['search'][0]['value']) ? $va['search'][0]['value'] : "" ;
      $search   = $this->escape_like_str($search) ;
      $va['tglawal'] = date_2s($va['tglawal']) ; 
      $va['tglakhir'] = date_2s($va['tglakhir']) ;  
      $where    = array("a.tgl >= '".$va['tglawal']."' and a.tgl <= '".$va['tglakhir']."' ") ;       
      if($search !== "") $where[]  = "(p.kode LIKE '%{$search}%' OR p.nama LIKE '%{$search}%')" ;
      $where    = implode(" AND ", $where) ; 
      $f        = "a.*,p.nama,p.alamat,p.telepon,p.statuspelanggan,p.tgl tglbuka" ; 
      $join     = "left join pelanggan p on p.kode = a.pelanggan" ;
      $dbd      = $this->select("absensi a", $f, $where,$join, "", "a.id DESC", $limit) ;

      $row      = 0 ; 
      $dba      = $this->select("absensi a", "COUNT(a.id) id", $where,$join) ;
      if($dbra  = $this->getrow($dba)){
         $row   = $dbra['id'] ;
      }
      return array("db"=>$dbd, "rows"=> $row ) ;
   } 
   
   public function databayar($tglbuka,$id,$tglawal,$tglakhir,$status){
      $n = 0 ;
      /*$ntgl = date("d",strtotime($tglbuka)) ;    
      $nbln = date("m",strtotime($tglawal)) ;
      $nthn = date("Y",strtotime($tglawal)) ;  
      $tglawal = join("-",array($ntgl,$nbln,$nthn)) ;         
      $tglawal = date("d-m-Y",date_nextmonth(strtotime($tglawal),-1)) ;
      $tglakhir = date("d-m-Y",date_nextmonth(strtotime($tglawal),1)) ;
      */
       
      //$tglawal = date_bom(date("d-m-Y",strtotime($tglawal))) ;       
      //$tglawal = date("d-m-Y",date_nextmonth(strtotime($tglawal),-1)) ;
      //$tglakhir = date("d-m-Y",strtotime($tglakhir)) ;
      
      $w = 0 ;
      $nbatass = time() ; //"26-12-2019" ;
      for($i=date_nextmonth(strtotime($tglbuka),0);$i<=$nbatass;$i=date_nextmonth($i,1)){
        $w++ ;
      }
      $w = $w - 1 ; 
      
      if(strtolower($status) != "mh"){ 
        $tglawal = date_bom(date("d-m-Y",strtotime($tglawal))) ;       
        $tglakhir = date_eom(date("d-m-Y",strtotime($tglawal))) ;        
      }
            
      $tglawal = date_2s($tglawal) ;          
      $tglakhir = date_2s($tglakhir) ;
            
      $dTgl     = "";
      $nIuran   = 0;  
      $ww       = 0 ;
      $cKeterangan = "<font style='color:red;font-weight:bold;'>Non Aktif / Bonus</font>";
      //$cKeterangan = "Tidak Aktif";   
      $where    = "pb.pelanggan = '$id' and pb.tgl >= '$tglawal' and pb.tgl <= '$tglakhir'" ;    
      //$where    = "pb.pelanggan = '$id' and pb.iuran > 0" ;    
      $dba      = $this->select("pelanggan_bayar pb", "pb.tgl,pb.keterangan,pb.iuran", $where,"","pb.tgl DESC") ;
      $va       = array("tgl"=>"","keterangan"=>"","iuran"=>0) ; 
      while($dbra  = $this->getrow($dba)){  
        $ww++ ;
        $nIuran += $dbra['iuran']; 
      } 
      //$cKeterangan = $tglawal . "-" . $tglakhir;
      //if($w <= $ww) $cKeterangan = "Aktif" ;    
      if($ww > 0)  $cKeterangan = "Aktif" ;    
      
      //if($id == "001576") $cKeterangan = $where ;
      return $cKeterangan ;
   }

   public function editing($id=''){
      $w    = "id = " . $this->escape($id) ; 
      $d    = $this->getval("*", $w, "pelanggan") ;
      return !empty($d) ? $d : false ;
   }
   
   public function saving($va, $id){
      $f    = $va ; 
      $cTgl = date("Y-m-d") ;
      $cJam = date("H:i:s") ;
      $keterangan = "Absensi Manual " . $f['pelanggan'] ; 
      $datetime = date("Y-m-d H:i:s") ;
      $vabsensi = array("pelanggan"=>$f['pelanggan'],"tgl"=>$cTgl,"jam"=>$cJam,"tglabsen"=>$cTgl,
                     "status"=>"0001","keterangan"=>$keterangan,"mode"=>"0","pin"=>"manual",
                     "cabang"=>"00","datetime"=>$datetime) ; 
      $this->insert("absensi", $vabsensi) ;
   } 
}
?>