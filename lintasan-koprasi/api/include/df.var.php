<?php
    //define("BASENAME_API","/html/koprasi/api") ;
    define("BASENAME_API","/koprasi/api") ;

    define("HTTP_USER_AGENT",array(
        "APP_WEB"=>"lintasan_koprasi_app_web_2021",
        "POSTMAN"=>"PostmanRuntime"
    )) ;

    define("TABLE_MASTER",array(
        "agama"=>"mst_agama",
        "cek"=>"mst_cek",
        "dati2"=>"mst_dati2",
        "login"=>"sys_username")
    ) ;
    
    define("API_TABUNGAN",array("register"=>"TABUNGAN_REGISTER","transaksi"=>"TABUNGAN_TRANSAKSI")) ;
    define("API_DEPOSITO",array("register"=>"DEPOSITO_REGISTER","transaksi"=>"DEPOSITO_TRANSAKSI")) ;
    define("API_KREDIT",array("register","KREDIT_REGISTER","transaksi","KREDIT_TRANSAKSI")) ; 
?>
