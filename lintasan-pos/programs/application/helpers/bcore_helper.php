<?php
   defined('BASEPATH') OR exit('No direct script access allowed') ;
   date_default_timezone_set('Asia/Jakarta') ;

   function devide($a,$b){
        $nRetval = 0 ;
        if(empty($a) || empty($b) || $a == 0 || $b == 0){
            $nRetval = 0 ;
        }else{
            $nRetval = $a / $b ;
        }
        return $nRetval ;
    }

    function nextmonth($nTime,$nNextMonth){
        $nDay = date("d",$nTime) ;
        $nMonth = date("m",$nTime) ;
        $nYear = date("Y",$nTime) ;

        $n1 = mktime(0,0,0,$nMonth + $nNextMonth,$nDay,$nYear) ;
        $n2 = mktime(0,0,0,$nMonth+$nNextMonth+1,0,$nYear) ;
        return min($n1,$n2) ;
    }

	function pass_crypt($pass){
		return sha1((md5($pass.md5($pass)) . ord('b') . ord('b') . "bismillah") ) ;
	}

   function tgltransaksi($o){
      return getsession($this, "tgl_transaksi", date("Y-m-d")) ;
   }

	function isjson($string){
    	json_decode($string) ;
    	return (json_last_error() == JSON_ERROR_NONE);
   }

   function bostext($text){
      return trim(preg_replace('/\s\s+/','',($text))) ;
   }

   function savesession($o ,$name, $val){
      $name 	= md5($name . $o->input->user_agent() . $o->config->item('encryption_key') ) ;
      if($val !== ""){
         $o->session->set_userdata($name, $val) ;
      }else{
         $o->session->unset_userdata($name) ;
      }
   }

   function getsession($o, $name, $def=''){
      $name 	= md5( $name . $o->input->user_agent() . $o->config->item('encryption_key') ) ;
      $re     = $o->session->userdata($name) ;
      if($re == "") $re = $def ;
    	return $re ;
   }

   function savecookie($o ,$name, $val){

   }

   function getcookie($o, $name){

   }

   function cekbosjs(){
      return 'if(typeof bos === "undefined") window.location.href = "'.base_url().'" ;' ;
   }

   function setfile($o, $t, $l, $va=array()){
      /*
         o    = object
         t    = type folder
         l    = location file
         va   = data
      */
      $dir    = $o->config->item('sess_save_path') . "/" . $t . "/" ;
      @mkdir($dir,0777,true) ;
      $file   = $dir . md5($l . json_encode($va) ) . ".bismillah" ;
      @unlink($file) ;
      return $file ;
   }

   function setnotif($t, $m, $i, $md5=''){
      $id = md5($t.$m.$i.$md5) ;
		echo('
            var notif_'.$id.' = new PNotify({
                title: "'.$t.'", text: "'.$m.'", icon: "'.$i.'",
                animation : "slide" ,addclass: "bnotif",
                nonblock: {nonblock: true},
                before_open: function(PNotify){
                    $("#wrap-audio-notif")[0].play();
                },buttons: {
                    closer: false
                }
            });
        ') ;
   }

?>
