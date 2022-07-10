<?php
defined('BASEPATH') OR exit('No direct script access allowed') ;
function date_2s($date){
    $retval = substr($date,0,10) ;
    $va = explode("-",$date) ;
    // Jika Array 1 Bukan Tahun maka akan berisi 2 Digit
    if(strlen($va [0]) == 2){
        $retval = $va [2] . "-" . $va [1] . "-" . $va[0] ;
    }
    return $retval ;
}

function date_2d($date){
    $retval = substr($date,0,10) ;
    $va = explode("-",$date) ;
    // Jika Array 1 Tahun maka akan berisi 4 Digit
    if(strlen($va [0]) == 4){
        $retval = $va [2] . "-" . $va [1] . "-" . $va[0] ;
    }
    return $retval ;
}

function date_2t($date){
    if(empty($date)){
        return 0 ;
    }
    $date = date_2d($date) ;  
    $va = explode("-",$date) ;
    return mktime(0,0,0,$va [1],$va[0],$va[2]) ;
}
function date_eom($dTgl){
    $day = date_2d($dTgl) ;
    $dBulan = substr($day,3,2) ;
    $dTahun = substr($day,6,4) ;
    $d = date('d-m-Y',mktime(0,0,0,$dBulan+1,0,$dTahun));
    return $d ;
}

function date_bom($dTgl){
    $day = date_2d($dTgl) ;
    $dBulan = substr($day,3,2) ;
    $dTahun = substr($day,6,4) ;
    $d = date('d-m-Y',mktime(0,0,0,$dBulan,1,$dTahun));
    return $d ;
}

function date_set($lt=false){
    $cf	= 'DD-MM-YYYY' ;
    if($lt)
        $cf .= ' HH:mm:ss' ;
    return 'data-date-format="'.$cf.'"' ;
}

function date_periodset($month=false){
    $cf	= 'YYYY' ;
    if($month)
        $cf = 'MM-YYYY' ;
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

function string_2nz($cString){
    $srting =  str_replace(",","",$cString) ;
    if($srting == 0) $srting = "";
    return $srting;
}

function string_2s($nNumber,$nDecimals=2){
    $nNumber = floatval(string_2n($nNumber)) ;
    if($nNumber < 0){
        return "(" . number_format(abs($nNumber),$nDecimals,".",",") . ")" ;
    }else{
        return number_format($nNumber,$nDecimals,".",",") ;
    }
}

function string_2sz($nNumber,$nDecimals=2){
    $nNumber = floatval(string_2n($nNumber)) ;
    if($nNumber < 0){
       $string =  "(" . number_format(abs($nNumber),$nDecimals,".",",") . ")" ;
    }else{
       $string = number_format($nNumber,$nDecimals,".",",") ;
    }
    if($nNumber == 0)$string = "";
    return $string;
}


function sql_2sql($cChar){
  $cChar = str_replace("\\","\\\\",$cChar) ;
  $cChar = str_replace("'","\'",$cChar) ;
  $cChar = str_replace('"','\"',$cChar) ;
  return $cChar ;
}
function sql_2str($cChar){
  $cChar = str_replace("\\\\","\\",$cChar) ;
  $cChar = str_replace("\'","'",$cChar) ;
  $cChar = str_replace('\"','"',$cChar) ;
  return $cChar ;
}

function terbilang($x) {
  $angka = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
  if ($x < 12)
    return  " " . $angka[$x];
  elseif ($x < 20)
    return  terbilang($x - 10) . " Belas";
  elseif ($x < 100)
    return  terbilang($x / 10) . " Puluh" . terbilang($x % 10);
  elseif ($x < 200)
    return  "seratus" . terbilang($x - 100);
  elseif ($x < 1000)
    return  terbilang($x / 100) . " Ratus" . terbilang($x % 100);
  elseif ($x < 2000)
    return  "seribu" . terbilang($x - 1000);
  elseif ($x < 1000000)
    return  terbilang($x / 1000) . " Ribu" . terbilang($x % 1000);
  elseif ($x < 1000000000)
    return  terbilang($x / 1000000) . " Juta" . terbilang($x % 1000000);
  elseif ($x < 1000000000000)
    return  terbilang($x / 1000000000) . " Milyar" . terbilang($x % 1000000000);

}
?>
