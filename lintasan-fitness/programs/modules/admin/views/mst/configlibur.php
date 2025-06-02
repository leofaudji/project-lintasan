<style media="screen">
   #bos-form-configlibur-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-configlibur-wrapper .info{border-radius: 4px; margin-right: 20px}
   .cal-head {border:1px solid #a9a9ff;border-left:0px;font-size:10px;text-align:center;font-weight:bold;padding:2px 0px 2px 0px;cursor:default;height:20px}
   .cal-body {border:1px solid #a9a9ff;border-left:0px;border-top:0px;font-size:11px;text-align:center;padding:2px 0px 2px 0px;cursor:default;height:20px}
   .cal-body-holiday {border:1px solid #a9a9ff;font-weight:bold;border-left:0px;border-top:0px;font-size:11px;text-align:center;padding:2px 0px 2px 0px;color:#f90000;cursor:default;height:20px}
   .cell_oddrow {FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px; background-color: #E6E6FF}
</style> 

<form novalidate>
<div class="bodyfix scrollme" style="height:100%">
 <table class="osxtable form"  width="100%" height="100%" border="0" cellspacing="0" cellpadding="1">
  <tr><td colspan="3">
  <table width="100%" height="100%" border="0" cellspacing="3" cellpadding="0">
  <?php

function createCalendar($nMonth,$nYear,$bdb){
  $html = '
    <table width="100%"  border="0" cellspacing="0" cellpadding="1" style="border-left:1px solid #a9a9ff">
      <tr class="cell_oddrow">    
        <td class="cal-head" align="center" colspan="7" style="border-bottom:0px;padding-top:4px;padding-bottom:4px">' . 
        GetMonth($nMonth) . ' ' . $nYear . '
        </td>
      </tr>
      <tr class="cell_oddrow">
        <td class="cal-head" width="14.28%" style="color:#f90000">Min</td>
        <td class="cal-head" width="14.28%">Sen</td>
        <td class="cal-head" width="14.28%">Sel</td>
        <td class="cal-head" width="14.28%">Rab</td>
        <td class="cal-head" width="14.28%">Kam</td>
        <td class="cal-head" width="14.28%">Jum</td>
        <td class="cal-head" width="14.28%">Sab</td>
      </tr>' ;
      
    $vaAwal = getdate(mktime(0,0,0,$nMonth,1,$nYear)) ;
    $nStart = 1 - $vaAwal['wday'] ;
    $nHariAkhir = $nStart + 41 ;
    $x = 0 ;
    for($n=$nStart;$n<=$nHariAkhir;$n++){
      $nTgl = mktime(0,0,0,$nMonth,$n,$nYear) ;
      $va = getdate($nTgl) ;
      if($va ['wday'] == 0 || $n == $nStart) $x ++ ;
      $c = $va['mday'] ;
      $nDay = $va ['wday'] ;
      $vaCal[$x][$nDay][0] = $c ;
      $vaCal[$x][$nDay][3] = $va['mday'] . " " . GetMonth($va['mon']) . " " . $va['year'] ;
      $vaCal[$x][$nDay][4] = $nTgl ;
      if(isHoliday($nTgl,$bdb)){
        $vaCal[$x][$nDay][1] = '-holiday' ;
      }
      if(date("d-m-Y",$nTgl) == date("d-m-Y")){
        $vaCal[$x][$nDay][2] = 'style="background-color:#3168d5;color:#ffffff" ' ;
      }
      if(date("m",$nTgl) <> $nMonth){
        $vaCal[$x][$nDay][2] = 'style="color:#cccccc" ' ;
      }
    }
    
    foreach($vaCal as $key1=>$value1){
      $html .= '<tr>' ;
      foreach($value1 as $key=>$value){
        if(!isset($value [2])) $value [2] = "" ;
        if(!isset($value [1])) $value [1] = "" ;
        $cOnClick = "" ;
        if(date("m",$value[4]) == $nMonth) $cOnClick = 'libur(this,' . $value[4] . ')' ;
        $html .= '<td onClick="' . $cOnClick . '" title="' . $value[3] . '" class="cal-body' . $value[1] . '"' . $value[2] . '>' . $value[0] . '</td>' ;
      }
      $html .= '</tr>' ;
    }
  $html .= '</table>' ;
  return $html ;
}

function GetTahunOption($cKey){
  $nYear = date("Y",now())+5 ;
  for($n=2011;$n<=$nYear;$n++){
    $cSelected = "" ;
    if($cKey == $n){
      $cSelected = " selected " ;
    }
    echo('<option value="' . $n . '"' . $cSelected . '>' . $n . '</option>') ;    
  }
}

function now(){
  return time() ; 
}

function SNow(){
  return date("Y-m-d H:i:s",now()) ;
}

function GetMonth($nBulan){
  $n = min(max(strval($nBulan) - 1,0),11) ; 
  $vaMonth = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember") ;
  return $vaMonth[$n] ;
}

function isHoliday($nTime,$bdb){
  $vaTgl = getdate($nTime) ;
  $lRetval = false ;
  if($vaTgl ['wday'] == 0){
    //$lRetval = true ;
  }else{
    $cTgl = date("Y-m-d",$nTime) ;  
    $dbData = $bdb->select("harilibur","tgl","tgl = '$cTgl'") ;
    if($bdb->rows($dbData) > 0){
      $lRetval = true ; 
    }
  }
  return $lRetval ;
}

if(empty($nYear)){
    $nYear = date("Y") ;
  } 
  
  
    $nBulan = 0 ;
    for($n=1;$n<=3;$n++){    
      echo('
        <tr>
          <td>' . createCalendar(++$nBulan,$nYear,$bdb) . '</td>
          <td>' . createCalendar(++$nBulan,$nYear,$bdb) . '</td>
          <td>' . createCalendar(++$nBulan,$nYear,$bdb) . '</td>
          <td>' . createCalendar(++$nBulan,$nYear,$bdb) . '</td>
        </tr>') ;
    }
  ?>
  </table>
  </td></tr>
</table>       
  <div class="row" style="height: calc(100% - 70px);">
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div>
   </div>
</div>
</form>
<script type="text/javascript">
  <?=cekbosjs();?>

  bos.configlibur.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.configlibur.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  bos.configlibur.init        = function(){
    bjs.ajax(this.url + "/init") ;
  }


  bos.configlibur.initcomp  = function(){
    bjs.initselect({
      class : "#" + this.id + " .select"
    }) ;
    bjs.initdate("#" + this.id + " .date") ;
    bjs_os.inittab(this.obj, '.tpel') ;
    bjs_os._header(this.id) ; //drag header
    this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
  }

  bos.configlibur.initcallback  = function(){
    this.obj.on("bos:tab", function(e){
      bos.configlibur.tabsaction( e.i )  ;
    });  

    this.obj.on("remove",function(){
      bos.configlibur.grid1_destroy() ;
    }) ;
  
      
  }

  bos.configlibur.objs = bos.configlibur.obj.find("#cmdsave") ;
  bos.configlibur.initfunc     = function(){
    this.init() ;
 
    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ; 
      });
  }
  
  var oCell = null ;
  function libur(field,nTgl){    
    oCell = field ;
    var cLibur = 'T' ;  
    var ketlibur = prompt("Keterangan hari libur ?", "libur");   
    if (ketlibur != null) {    
      if(confirm('Hari Libur ?')){       
        cLibur = 'Y' ;
      }else{
        cLibur = 'T' ;
      }
      bjs.ajax(bos.configlibur.url + '/libur', 'tgl=' + nTgl + '&clibur=' + cLibur + '&harilibur=' + ketlibur); 
    }      
  }

  function UpdCell(cStatus){
    if(oCell !== null){
      if(cStatus == "Y"){
        oCell.className = "cal-body-holiday" ;
      }else{
        oCell.className = "cal-body" ;
      }
    }
  }

  $(function(){
    bos.configlibur.initcomp() ;
    bos.configlibur.initcallback() ;
    bos.configlibur.initfunc() ;
  }) ;
</script>
