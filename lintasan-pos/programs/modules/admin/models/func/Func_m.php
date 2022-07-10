<?php
class Func_m extends Bismillah_Model{
	//session_start();
    public function postCURL($_url, $_param){
        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v) 
        { 
          $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

        $output=curl_exec($ch);

        curl_close($ch);

        return $output;
    }

    public function GetKeterangan($cKode,$cFieldKeterangan,$cTable){
        if(empty($cFieldKeterangan)){
            $cFieldKeterangan = "keterangan" ;
        }
        $dbData = $this->select($cTable,$cFieldKeterangan,"Kode = '$cKode'");
        return $this->getrow($dbData) ;
    }
    
    public function GetDataCabang($cabang){
        $va = array("kode"=>"","nama"=>"","alamat"=>"","telp"=>"");
        $dbData = $this->select("cabang","*","Kode = '$cabang'");
        if($dbr = $this->getrow($dbData)){
            $va['kode'] = $dbr['kode'];
            $va['nama'] = $dbr['keterangan'];
            $va['alamat'] = $dbr['alamat'];
            $va['telp'] = $dbr['telp'];
        }
        return $va;
    }

    public function devide($a,$b){
        $return = 0;
        if($a > 0 and $b > 0){
            $return = $a / $b;
        }
        return $return ;
    }

	public function opencashdraweronly(){
        $ipconnection = $this->config_m->getconfig("cfgipconnectionprinter");
        $ostoprinter = $this->config_m->getconfig("cfgospctoprinter");
        if($ipconnection <> ""){
            $this->escpos->connect($ipconnection,$ostoprinter);//"smb://User:Guest@192.168.0.11/POS-80C"
            //$this->escpos->check_connection();
            $this->escpos->opencashdraweronly();
        }
    }
	public function cetakstruk($faktur){
        $ipconnection = $this->config_m->getconfig("cfgipconnectionprinter");
        $ostoprinter = $this->config_m->getconfig("cfgospctoprinter");
        if($ipconnection <> ""){
            $this->escpos->connect($ipconnection,$ostoprinter);//"smb://User:Guest@192.168.0.11/POS-80C"
            //$this->escpos->check_connection();
            $cpl = $this->config_m->getconfig("cfgkasirprintcpl");
            if($cpl == ""){
                $cpl = 48 ;
            }
            $this->escpos->setlebarkertas($cpl);
            //set content print
            //header
            $vaprint = array();
            if(!empty($this->config_m->getconfig("cfgkasirprinth1")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprinth1"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprinth2")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprinth2"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprinth3")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprinth3"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprinth4")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprinth4"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprinth5")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprinth5"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprinth6")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprinth6"),$cpl," ",STR_PAD_BOTH));

            $this->escpos->posisiteks("center");
            $this->escpos->teks("Faktur : ".$faktur);
            $this->escpos->teks(str_pad("",$cpl,"=",STR_PAD_BOTH));
            $this->escpos->posisiteks("left");


            //select item
            $cplket = 33;
            $cpljml = 15;
            $vare = array();
            $field = "d.stock,s.keterangan as namastock,d.harga,d.qty,s.satuan,d.totalitem as jumlah,d.diskonqty";
            $where = "d.faktur = '$faktur'";
            $join  = "left join stock s on s.kode = d.stock";
            $dbd   = $this->select("penjualan_detail d", $field, $where, $join) ;
            $n = 0 ;
            while( $dbr = $this->getrow($dbd) ){
                $this->escpos->teks($dbr['namastock']);
                $ketharga = str_pad($dbr['qty'] . " x " . number_format($dbr['harga'],2) ,$cplket," ",STR_PAD_RIGHT);
                $hargaasli = $dbr['qty'] * $dbr['harga'];
                $harga =  str_pad(number_format($hargaasli,2),$cpljml," ",STR_PAD_LEFT);
                $this->escpos->teks($ketharga.$harga);
                if($dbr['diskonqty'] > 0){
                    $jmldiskonqty = $dbr['diskonqty'] * $dbr['qty'];
                    $this->escpos->teks(str_pad("Diskon" ,$cplket," ",STR_PAD_RIGHT) . str_pad("-".number_format($jmldiskonqty,2),$cpljml," ",STR_PAD_LEFT));
                }
            }

            //end select item
            $this->escpos->teks(str_pad("",$cpl,"-",STR_PAD_BOTH));

            $data  = array() ;
            $cplketf = 25;
            $cplnomf = 3;
            $cplsprf = 20;
            $field = "t.faktur,t.tgl,t.subtotal,t.ppn,t.total,t.diskon,t.kas,t.datetime_insert";
            $where = "t.faktur = '$faktur'";
            $join  = "";
            $dbd   = $this->select("penjualan_total t", $field, $where, $join) ;
            if($data = $this->getrow($dbd)){
                $kembalian = $data['kas']  - $data['total'];
                $bayar = $data['kas'];
                $this->escpos->teks(str_pad("Subtotal" ,$cplketf," ",STR_PAD_RIGHT) . str_pad(":" ,$cplnomf," ",STR_PAD_BOTH) . str_pad(number_format($data['subtotal'],2),$cplsprf," ",STR_PAD_LEFT));
                if($data['diskon'] > 0)$this->escpos->teks(str_pad("Diskon" ,$cplketf," ",STR_PAD_RIGHT) . str_pad(":" ,$cplnomf," ",STR_PAD_BOTH) . str_pad("-".number_format($data['diskon'],2),$cplsprf," ",STR_PAD_LEFT));
                if($data['kas'] > 0)$this->escpos->teks(str_pad("Bayar" ,$cplketf," ",STR_PAD_RIGHT) . str_pad(":" ,$cplnomf," ",STR_PAD_BOTH) . str_pad(number_format($bayar,2),$cplsprf," ",STR_PAD_LEFT));
                $this->escpos->teks(str_pad("Kembalian" ,$cplketf," ",STR_PAD_RIGHT) . str_pad(":" ,$cplnomf," ",STR_PAD_BOTH) . str_pad(number_format($kembalian,2),$cplsprf," ",STR_PAD_LEFT));
                $this->escpos->teks(str_pad("Tgl Jam" ,$cplketf," ",STR_PAD_RIGHT) . str_pad(":" ,$cplnomf," ",STR_PAD_BOTH) . str_pad($data['datetime_insert'],$cplsprf," ",STR_PAD_LEFT));
            }


            $this->escpos->teks(str_pad("",$cpl,"=",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprintf1")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprintf1"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprintf2")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprintf2"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprintf3")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprintf3"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprintf4")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprintf4"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprintf5")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprintf5"),$cpl," ",STR_PAD_BOTH));
            if(!empty($this->config_m->getconfig("cfgkasirprintf6")))$this->escpos->teks(str_pad($this->config_m->getconfig("cfgkasirprintf6"),$cpl," ",STR_PAD_BOTH));

            

            $this->escpos->cetak(true);
        }
    }
}
?>