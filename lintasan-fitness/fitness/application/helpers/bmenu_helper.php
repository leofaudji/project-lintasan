<?php
   defined('BASEPATH') OR exit('No direct script access allowed') ;
   function menu_get_data($vamenu, $md5, $lchild=false){
      $arr    = array() ;
      foreach ($vamenu as $key => $value) {
           if(empty($arr)){
               if(isset($value["children"])){
                   $arr     = menu_get_data($value["children"],$md5) ;
               }
               if( $key == $md5 ){
                   if($lchild && isset($value['children'])){
                       $arr     = $value['children'] ;
                   }else{
                       $arr     = $value ;
                   }
                   break ;
               }
           }
      }
      return $arr ;
   }

   function menu_get($o, $path, $ssmenu="bmenu", $cmodule_name=''){
      $vamenu    = json_decode(getsession($o, $ssmenu, "{}"), true) ;
      if(empty($vamenu)){
           if(is_file($path)){
               $vafile     = file($path) ;
               $vakey_pos  = array() ;
               foreach ($vafile as $ckeyfile => $menu) {
                   $ci     = strpos($menu, "#") ;
                   $lphp   = strpos($menu, "<?php") ;
                   if($ci === false && trim($menu) !== "" && $lphp === false){
                       $np         = strpos($menu,"[") ;
                       $armenu     = menu_to_array($o, $menu, $cmodule_name) ;
                       if($np == 0) $vakey_pos  = array() ;

                       $key      = $armenu['md5'] ;
                       $vakey_pos[$np] = $key ;

                       menu_set_array($vamenu,$vakey_pos,$np,$key,$armenu) ;
                   }
               }
               savesession($o, $ssmenu, json_encode($vamenu)) ;
           }
      }
      return $vamenu ;
   }

   function menu_set_array(&$vamenu, $vakey_pos, $np, $key, $armenu){
      if($np > 0){
           $lv     = true ;
           $va_var     = "" ;
           ksort($vakey_pos) ;
           foreach ($vakey_pos as $key_pos => $value_pos) {
               if($lv && $key_pos == $np ) $lv   = false ;
               if($lv){
                   if(isset($vamenu[$value_pos])){
                       $va_var .= '["'.$value_pos.'"]' ;
                   }else{
                       $va_var .= '["children"]["'.$value_pos.'"]' ;
                   }
               }
           }
           eval('
               $vamenu'.$va_var.'["children"]["'.$key.'"] = $armenu ;
           ') ;

      }else{
           $vamenu[$key] = $armenu ;
      }
   }

   function menu_to_array($o, $menu, $module_name=''){
      eval('$menu = array' . str_replace("[","(", str_replace("]",")",$menu)) . ';' ) ;
      if( $o->config->item('bcore_menu_version') == "1"){
           $md5    = isset($menu[2]) ? ( $menu[2] !== "" ? $menu[2] : $menu[1]) : $menu[1] ;
           $varr   = array("module"=>$module_name,
                           "name"=>$menu[0],
                           "md5"=>md5($md5),
                           "obj"=>$menu[1],
                           "loc"=>isset($menu[2]) ? $menu[2] : "",
                           "icon"=>isset($menu[3]) ? $menu[3] : "ion-filing") ;
         if(isset($menu[4])) $varr['nocontent'] = $menu[4] ;
         if(isset($menu[5])) $varr['attr'] = $menu[5] ;
      }else{ //desktop
         $varr = menu_dekstop($menu, $module_name) ;
      }

      return $varr ;
   }

   function menu_dekstop($menu, $module_name){
      $md5    = isset($menu[2]) ? ( $menu[2] !== "" ? $menu[2] : $menu[1]) : $menu[1] ;
      $varr   = array("module"=>$module_name,
                      "name"=>$menu[0],
                      "md5"=>md5($md5),
                      "obj"=>$menu[1],
                      "loc"=>isset($menu[2]) ? $menu[2] : "",
                      "icon"=>isset($menu[3]) ? ($menu[3] !== "") ? $menu[3] : "ion-filing" : "ion-filing") ;
      if( isset($menu[4]) || isset($menu[5]) ){ //width dan height
         if( isset($menu[4]) ){
            if($menu[4] > 0){
               if(!isset($varr['size'])) $varr['size']    = array() ;
               $varr['size']['width']  = $menu[4] ;
            }
         }
         if( isset($menu[5]) ){
            if($menu[5] > 0){
               if(!isset($varr['size'])) $varr['size']    = array() ;
               $varr['size']['height'] = $menu[5] ;
            }
         }
      }
      if( isset($menu[6]) ){ //titlebar
         if( !isset($varr['opt']) ) $varr['opt'] = array() ;
         $varr['opt']['title'] = boolval($menu[6]) ;
      }
      if( isset($menu[7]) ){ //resize
         if( !isset($varr['opt']) ) $varr['opt'] = array() ;
         $varr['opt']['resize'] = boolval($menu[7]) ;
      }
      if( isset($menu[8]) ){ //modal
         if( !isset($varr['opt']) ) $varr['opt'] = array() ;
         $varr['opt']['modal'] = boolval($menu[8]) ;
      }
      if( isset($menu[9]) ){ //frame
            if( !isset($varr['opt']) ) $varr['opt'] = array() ;
            $varr['opt']['frame'] = boolval($menu[9]) ;
      }
      if( isset($menu[10]) ){ //dock
         if( !isset($varr['opt']) ) $varr['opt'] = array() ;
         $varr['opt']['dock'] = boolval($menu[10]) ;
      }
      if( isset($menu[11]) ){ //help
         if( !isset($varr['opt']) ) $varr['opt'] = array() ;
         $varr['opt']['help'] = boolval($menu[11]) ;
      }
      if( isset($menu[12]) ){ //body class
         if( trim($menu[12]) !== "" ){
            if( !isset($varr['class']) ) $varr['class'] = array() ;
            $varr['class']['body'] = $menu[12] ;
         }
      }
      if( isset($menu[13]) ){ //header class
         if( trim($menu[13]) !== "" ){
            if( !isset($varr['class']) ) $varr['class'] = array() ;
            $varr['class']['header'] = $menu[13] ;
         }
      }

      return $varr ;
   }
?>
