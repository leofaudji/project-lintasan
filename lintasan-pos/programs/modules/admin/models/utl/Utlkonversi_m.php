<?php
class  Utlkonversi_m extends Bismillah_Model{
    public function getfaktur($l=true){
        $cabang = getsession($this, "cabang") ;
        $key  = "KV".$cabang.date("ymd");
        $n    = $this->getincrement($key, $l,5);
        $faktur    = $key.$n ;
        return $faktur ;
    }

    public function saldostock($tgl){
        $this->delete("stock_kartu","");
        $this->delete("stock","");
        $this->delete("stock_hj","");
        $this->delete("pembelian_detail","");
        $this->delete("pembelian_total","");
        $username = getsession($this, "username");
        $datetime = date("Y-m-d H:i:s");
        $y    = date("ym");
        
        //getfaktur
        $key  = "PB".date("ymd");
        $n    = $this->getincrement($key, true,5);
        $faktur    = $key.$n ;

        $total = 0;
        $dbd      = $this->select("mytable","ifnull(Barcode,'') as Barcode,Stok,Satuan,Harga_Beli,Harga_Jual,Saldo") ;
        while($dbr = $this->getrow($dbd)){
            $n    = $this->getincrement("stockkode" . $y, true, 6);
            $kode    = $y.$n ;
            $dbr['Harga_Beli'] = str_replace(",",".",$dbr['Harga_Beli']);

            $arr = array("kode"=>$kode,"barcode"=>$dbr['Barcode'],"keterangan"=>$dbr['Stok'],"jenis"=>"p",
                        "satuan"=>$dbr['Satuan'],"stock_group"=>"001");
            $this->insert("stock",$arr) ;

            $arrsatuan = array("kode"=>$dbr['Satuan'],"keterangan"=>$dbr['Satuan']);
            $this->update("satuan",$arrsatuan,"kode = '{$dbr['Satuan']}'") ;

            $arrhj = array("kode"=>$kode,"qty"=>"999999","hj"=>string_2n($dbr['Harga_Jual']));
            $this->insert("stock_hj",$arrhj) ;
            $jumlah = string_2n($dbr['Harga_Beli']) * string_2n($dbr['Saldo']);
            $total += $jumlah;

            //insert stock 
            $vadetail = array("faktur"=>$faktur,
                              "stock"=>$kode,
                              "qty"=>string_2n($dbr['Saldo']),
                              "harga"=>string_2n($dbr['Harga_Beli']),
                              "jumlah"=>$jumlah,
                              "totalitem"=>$jumlah,
                              "username"=> getsession($this, "username"));
            $this->insert("pembelian_detail",$vadetail);
        }


        
        $data           = array("faktur"=>$faktur,
                                "tgl"=>'2019-06-24',
                                "fktpo"=>"",
                                "subtotal"=>$total,
                                "diskon"=>'0.00',
                                "pembulatan"=>'0.00',
                                "persppn"=>'0.00',
                                "ppn"=>'0.00',
                                "total"=>$total,
                                "hutang"=>$total,
                                "status"=>"1",
                                "gudang"=>'01',
                                "supplier"=>'00001',
                                "username"=> getsession($this, "username")) ;
        $where          = "faktur = " . $this->escape($faktur) ;
        $this->update("pembelian_total", $data, $where, "") ;
        
        //update kartu stock
        $this->updtransaksi_m->updkartustockpembelian($faktur);
        $this->updtransaksi_m->updkartuhutangpembelian($faktur);
    }
}
?>