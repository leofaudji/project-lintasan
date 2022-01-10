<?php
   defined('BASEPATH') OR exit('No direct script access allowed') ;
   function date_2s($date, $ltime=false){
      $re     = $date ;
      $vdate  = explode(" ", $date) ;
      if($ltime){
           $vdate_d= explode("-", $vdate[0]) ;
           $re     = $vdate_d[2] . "-" . $vdate_d[1] . "-" . $vdate_d[0] . " " . $vdate[1] ;
      }else{
           $vdate_d= explode("-", $vdate[0]) ;
           $re     = $vdate_d[2] . "-" . $vdate_d[1] . "-" . $vdate_d[0] ;
      }
      return $re ;
   }

   function date_2d($date){
      $vdate_d= explode("-", $date) ; 
      $re     = $vdate_d[2] . "-" . $vdate_d[1] . "-" . $vdate_d[0] ;
      return $re ;
   }

   function date_eom($date){
      $nTgl = strtotime($date) ;
      $nMonth = date("m",$nTgl) ;
      $nYear = date("Y",$nTgl) ;

      return date('d-m-Y',mktime(0,0,0,$nMonth+1,0,$nYear));
   }

   function date_bom($date){
      $nTgl = strtotime($date) ;
      $nMonth = date("m",$nTgl) ;
      $nYear = date("Y",$nTgl) ;

      return date('d-m-Y',mktime(0,0,0,$nMonth,1,$nYear));
   }

   function date_nextmonth($nTime,$nNextMonth){
      $nDay = date("d",$nTime) ;
      $nMonth = date("m",$nTime) ;
      $nYear = date("Y",$nTime) ;
      
      $n1 = mktime(0,0,0,$nMonth + $nNextMonth,$nDay,$nYear) ;
      $n2 = mktime(0,0,0,$nMonth+$nNextMonth+1,0,$nYear) ;
      return min($n1,$n2) ;
   }
   
   function date_nextday($nTime,$nNextDay){
    $nDay = date("d",$nTime) ; 
    $nMonth = date("m",$nTime) ;
    $nYear = date("Y",$nTime) ;
  
    $n = mktime(0,0,0,$nMonth,$nDay+$nNextDay,$nYear) ;
    return $n ;
  }

   function date_set($lt=false){
      $cf  = 'DD-MM-YYYY' ;
      if($lt)
         $cf .= ' HH:mm:ss' ;
      return 'data-date-format="'.$cf.'"' ;
   }

   function date_day($v){
      $va  = array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu") ;
      return strtoupper($va[$v]) ;
   }

   function date_month($v){
      $va  = array("Januari","Februari","Maret","April","Mei","Juni","Juli",
                  "Agustus","September","Oktober","November","Desember") ;
      return strtoupper($va[$v]) ;
   }

   function date_2b($date=''){
      //date 2 bahasa
      $vad = getdate(strtotime($date)) ;
      $va  = array("d"=>$vad['mday'],"day"=> date_day($vad['wday']),
                  "m"=> date_month($vad['mon']-1),"y"=>$vad['year']) ;
      return $va ;
   }

   function date_now(){
      return date("Y-m-d H:i:s") ;
   }

   function string_2n($cString){
      return str_replace(",","",$cString) ;
   }

   function string_2s($nNumber,$nDecimals=2){
      $nNumber = floatval(string_2n($nNumber)) ;
      if($nNumber < 0){
         return "(" . number_format(abs($nNumber),$nDecimals,".",",") . ")" ;
      }else{
         return number_format($nNumber,$nDecimals,".",",") ;
      }
   }

   function Konfersi($nNilai){    
    $_1 = array("1"=>'SE',"2"=>'DUA ',"3"=>'TIGA ',"4"=>'EMPAT ',"5"=>'LIMA ',"6"=>'ENAM ',"7"=>'TUJUH ',"8"=>'DELAPAN ',"9"=>'SEMBILAN ');
    $_2 = array("1"=>'SE',"2"=>'DUA ',"3"=>'TIGA ',"4"=>'EMPAT ',"5"=>'LIMA ',"6"=>'ENAM ',"7"=>'TUJUH ',"8"=>'DELAPAN ',"9"=>'SEMBILAN ');
    $_3 = array("1"=>'SATU ',"2"=>'DUA ',"3"=>'TIGA ',"4"=>'EMPAT ',"5"=>'LIMA ',"6"=>'ENAM ',"7"=>'TUJUH ',"8"=>'DELAPAN ',"9"=>'SEMBILAN ');   
    $nLen = strlen($nNilai); 
    $nNilai = str_pad($nNilai,3,"0",STR_PAD_LEFT);
    $cKonfersi = "" ;
    for($i=1;$i<4;$i++){ 
      $nBilangan = intval(substr($nNilai,$i - 1,1)); 
      $vaArray   = "_" . $i;
      $jenis = "" ;
      foreach($$vaArray as $key=>$value){
        if($key == $nBilangan){          
          if($nBilangan !== 0 and $i == 1){
            $jenis = "RATUS";
          }else if($nBilangan !== 0 and $i == 2){
            if($nBilangan !== 1 and substr($nNilai,2,1) !== 1){
              $jenis = "PULUH ";
            }else{
              if(substr($nNilai,2,1) > 1){
                $jenis = "";
                $value = "" ;
              }else{
                if(substr($nNilai,2,1) == 0){
                  $jenis = "PULUH ";
                }else{
                  $jenis = "BELAS ";
                }                
              }            
            }           
         }else if($i == 3){ 
           if(substr($nNilai,2,1) > 1 and substr($nNilai,1,1) == 1){
            $jenis = "BELAS ";    
           }else{
            //$value = "";
           }
         }
          $cKonfersi .= " " . $value . $jenis ;  
        }
      }
    }
    return $cKonfersi ;
  }  

function terbilang($nNilai,$cRupiah=true){
  $nNilai1 = strval(intval($nNilai)); 
  $nNilai1 = str_pad($nNilai1,12,"0",STR_PAD_LEFT);  

  $cPecahan = Konfersi(substr($nNilai,-2));
  if($cPecahan == ""){
    $cPecahan = "";
  }
  $cSatuan = Konfersi(substr($nNilai1,9,3));
  if($cSatuan == ""){
    $cSatuan = "" ;  
  }  
  $cRibuan = Konfersi(substr($nNilai1,6,3));
  if($cRibuan == ""){
    $cRibuan = "" ;  
  }else{
    $cRibuan .= "RIBU ";
  }  
  $cJutaan = Konfersi(substr($nNilai1,3,3));
  if($cJutaan == ""){
    $cJutaan = "" ;  
  }else{
    $cJutaan .= "JUTA ";
  }  
  $cMilyar = Konfersi(substr($nNilai1,0,3));
  if($cMilyar == ""){
    $cMilyar = "" ;  
  }else{
    $cMilyar .= "MILYAR ";
  }  
  
  if($cRupiah){ 
    $cRetval = $cMilyar . $cJutaan . $cRibuan . $cSatuan . "RUPIAH"  ;
    if($cRetval == ""){
      $cRetval = "";
    }
  }else{
    $cRetval = $cMilyar . $cJutaan . $cRibuan . $cSatuan ;
    if($cPecahan !== ""){
      $cRetval = $cMilyar . $cJutaan . $cRibuan . $cSatuan . "KOMA " . $cPecahan;
      if($cMilyar == "" and $cRibuan == "" and $cSatuan == ""){
        $cRetval = "NOL " . "KOMA " . $cPecahan;
      }
      
    }    
  }  
  return $cRetval ;
} 

?>
