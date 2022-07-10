<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                Penjualan
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trpenjualankasir.close()">
                                <img src="./uploads/titlebar/close.png">
                            </div>
                        </td>
                    </tr>
                </table>
            </td> 
        </tr>
    </table> 
</div><!-- end header -->
<form novalidate>
    <div class="body">

        <div class="bodyfix scrollme" style="height:100%">
            <div class="tab-content full-height">
                <div> 
                    <table width="100%">
                        <tr>
                            <td height="25px" width="100%">
                                <table>
                                    <tr>
                                        <td width = '100px' style='font-size:40px;'>
                                            Rp. 
                                        </td>
                                        <td>
                                            <input readonly style='font-size:40px;width:100%;' maxlength="22" type="text" name="total" id="total" class="form-control number" value="0">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = '5px' width="100%">
                                <hr/>
                            </td>
                        </tr>
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td><label for="nomor">No</label> </td>
                                        <td><label for="stock">Stock (F1)</label> </td>
                                        <td><label>Nama Stock</label> </td>
                                        <td><label for="harga">Harga</label> </td>
                                        <td><label for="qty">Qty</label> </td>
                                        <td><label>Satuan</label> </td>
                                        <td><label for="diskon">Diskon</label> </td>
                                        <td><label>Jumlah</label></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="5" type="text" name="nomor" id="nomor" class="form-control number" value="0"></td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" id="stock" name="stock" class="form-control" placeholder="Stock">
                                                <span class="input-group-btn">
                                                    <button class="form-control btn btn-info" type="button" id="cmdstock"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </td>
                                        <td><input type="text" id="namastock" readonly name="namastock" class="form-control" placeholder="Nama Stock"></td>
                                        <td><input maxlength="20" type="text" name="harga" id="harga" class="form-control number" value="0"></td>
                                        <td><input maxlength="10" type="text" name="qty" id="qty" class="form-control number" value="0"></td>
                                        <td><input type="text" id="satuan" readonly name="satuan" class="form-control" placeholder="Satuan"></td>
                                        <td><input readonly maxlength="20" type="text" name="diskon" id="diskon" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" readonly type="text" name="jumlah" id="jumlah" class="form-control number" value="0"></td>
                                        <td>
                                            <input type="hidden" name="barcode" id="barcode" value="">
                                            <button type="button" class="btn btn-primary pull-right" id="cmdok">OK</button>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "350px" >
                                <div id="grid2" class="full-height"></div>
                            </td>
                        </tr>
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <tr>
                                    <td>
                                        <table width = '100%'>
                                            <tr>
                                                <td align = 'left'> *) scan semua barcode barang, apabila barcode tidak ada bisa memasukkan no barcode kedalam kolom kode
                                                </td>
                                                <td align = 'right'><button type="button" class="btn btn-primary pull-right" id="cmdbayar">Bayar (F2)</button></td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <div class="modal fade" id="wrap-bayar-d" role="dialog" data-backdrop="false" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="wm-title">Pembayaran</h4>
                </div>
                <div class="modal-body">
                    <table class="osxtable form">
                        <tr>
                            <td width="14%"><label for="tgl">Tanggal</label> </td>
                            <td width="1%">:</td>
                            <td >
                                <input readonly style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%" style = "font-size:20px;"><label for="totalpj">Total</label> </td>
                            <td width="1%">:</td>
                            <td >
                                <input style = "font-size:20px;" maxlength="20" readonly type="text" name="totalpj" id="totalpj" class="form-control number" value="0">
                            </td>
                        </tr>
                        <tr>
                            <td width="14%" style = "font-size:20px;"><label for="diskonnom">Diskon Nom.</label> </td>
                            <td width="1%">:</td>
                            <td >
                                <input style = "font-size:20px;" maxlength="20" type="text" name="diskonnom" id="diskonnom" class="form-control number" value="0">
                            </td>
                        </tr>
                        <tr>
                            <td width="14%" style = "font-size:20px;"><label for="bayar">Bayar</label> </td>
                            <td width="1%">:</td>
                            <td >
                                <input onfocus="this.select();" style = "font-size:20px;" maxlength="20" type="text" name="bayar" id="bayar" class="form-control number" value="">
                            </td>
                        </tr>
                        <tr>
                            <td width="14%" style = "font-size:20px;"><label for="kembalian">Kembalian</label> </td>
                            <td width="1%">:</td>
                            <td >
                                <input style = "font-size:20px;" maxlength="20" readonly type="text" name="kembalian" id="kembalian" class="form-control number" value="0">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <table width = '100%'>
                        <tr>
                            <td align = 'left'>
                            </td>
                            <td width='100px' align = 'right'><button type="button" class="btn btn-primary pull-right" id="cmdsave">Simpan (F4)</button></td>
                            <td width='100px' align = 'right'><button type="button" class="btn btn-warning pull-right" id="cmdcancelbyr">Batal (F3)</button></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="wrap-pencarianstock-d" role="dialog" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wm-title">Daftar Stock</h4>
            </div>
            <div class="modal-body">
                <div id="grid3" style="height:250px"></div>
            </div>
            <div class="modal-footer">
                *Pilih Stock
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?=cekbosjs();?>

    //grid detail penjualan
    bos.trpenjualankasir.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false},
                { field: 'stock', caption: 'Stock', size: '100px', sortable: false },
                { field: 'namastock', caption: 'Nama Stock', size: '150px', sortable: false },
                { field: 'harga', caption: 'Harga', size: '100px', sortable: false, style:'text-align:right',render:'int'},
                { field: 'qty', caption: 'Qty', size: '70px', sortable: false, style:'text-align:right',render: 'int'},
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
                { field: 'diskon', caption: 'Diskon', size: '100px', sortable: false, style:'text-align:right',render:'int'},
                { field: 'jumlah', caption: 'Jumlah', size: '100px', sortable: false, style:'text-align:right',render:'int'},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false },
                { field: 'barcode', caption: 'Barcode', size: '100px', sortable: false }
            ]
        });


    }

    bos.trpenjualankasir.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trpenjualankasir.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trpenjualankasir.grid2_append    = function(no,kode,keterangan,harga,qty,satuan,diskon,jumlah,barcode){
        var datagrid = w2ui[this.id + '_grid2'].records;
        var lnew = true;
        var nQty = 1;
        var nJumlah = nQty * harga;
        var recid = "";

        for(i=0;i<datagrid.length;i++){
            recid = datagrid[i]["recid"];
            var qtyawal = 0;
            if(no > datagrid.length)qtyawal = datagrid[i]["qty"];
            if(kode == recid){
                lnew = false;
                harga = string_2n(harga);
                diskon = string_2n(diskon);
                qty = string_2n(qty) + qtyawal;
                jumlah = qty * (harga - diskon);
                var nomor = i+1;
                var edit = "<button type='button' onclick = 'bos.trpenjualankasir.editdata("+nomor+")' class='btn btn-success btn-grid'>Edit</button>";
                //bjs.ajax( bos.trpenjualankasir.base_url + '/setitem', bjs.getdataform(this)+"&qty="+qty) ;
                w2ui[this.id + '_grid2'].set(recid,{no:nomor,stock: kode, namastock: keterangan, harga: harga, qty: qty, satuan:satuan,diskon: diskon,jumlah:jumlah,cmdedit:edit,barcode:barcode});
            }
        }
        if(lnew){
            recid = kode;
            harga = string_2n(harga);
            diskon = string_2n(diskon);
            qty = string_2n(qty);
            jumlah = qty * (harga - diskon);
            var nomor = datagrid.length + 1
            var Hapus = "<button type='button' onclick = 'bos.trpenjualankasir.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            var edit = "<button type='button' onclick = 'bos.trpenjualankasir.editdata("+nomor+")' class='btn btn-success btn-grid'>Edit</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,no:nomor , stock: kode, namastock: keterangan, harga: harga, qty: qty, satuan:satuan,diskon: diskon,jumlah:jumlah,cmdedit:edit,cmddelete:Hapus,barcode:barcode}
            ]) ;
        }
        var jmldata = datagrid.length;
        w2ui[this.id + '_grid2'].scrollIntoView(jmldata);
        bos.trpenjualankasir.initdetail();
        bos.trpenjualankasir.obj.find("#stock").focus() ;
        bos.trpenjualankasir.hitungsubtotal();
    }
    bos.trpenjualankasir.grid2_hitungjumlah = function(recid,qty,harga){
        //alert(recid+"eer"+qty+"eefef"+harga

        var nJumlah = qty * harga;
        w2ui[this.id + '_grid2'].set(recid,{qty:qty,jumlah:nJumlah});
        bos.trpenjualankasir.hitungsubtotal();
    }
    bos.trpenjualankasir.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail penjualan???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trpenjualankasir.grid2_urutkan();
            bos.trpenjualankasir.hitungsubtotal();
        }
    }

    bos.trpenjualankasir.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        for(i=0;i<datagrid.length;i++){
            var nomor = i+1;
            var edit = "<button type='button' onclick = 'bos.trpenjualankasir.editdata("+nomor+")' class='btn btn-success btn-grid'>Edit</button>";
            w2ui[this.id + '_grid2'].set(datagrid[i]["recid"],{no : nomor,cmdedit:edit});
        }
    }


    //grid3 daftarstock
    bos.trpenjualankasir.grid3_data    = null ;
    bos.trpenjualankasir.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trpenjualankasir.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trpenjualankasir.base_url + "/loadgrid3",
            postData: this.grid3_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false },
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false },
                { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trpenjualankasir.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trpenjualankasir.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trpenjualankasir.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trpenjualankasir.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trpenjualankasir.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }

    //grid4 daftarsj
    bos.trpenjualankasir.grid4_data    = null ;
    bos.trpenjualankasir.grid4_loaddata= function(){
        this.grid4_data 		= {} ;
    }

    bos.trpenjualankasir.grid4_load    = function(){
        this.obj.find("#grid4").w2grid({
            name	: this.id + '_grid4',
            limit 	: 100 ,
            url 	: bos.trpenjualankasir.base_url + "/loadgrid4",
            postData: this.grid4_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '100px', sortable: false},
                { field: 'tgl', caption: 'Tanggal', size: '100px', sortable: false},
                { field: 'customer', caption: 'Customer', size: '200px', sortable: false },
                { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trpenjualankasir.grid4_setdata	= function(){
        w2ui[this.id + '_grid4'].postData 	= this.grid4_data ;
    }
    bos.trpenjualankasir.grid4_reload		= function(){
        w2ui[this.id + '_grid4'].reload() ;
    }
    bos.trpenjualankasir.grid4_destroy 	= function(){
        if(w2ui[this.id + '_grid4'] !== undefined){
            w2ui[this.id + '_grid4'].destroy() ;
        }
    }

    bos.trpenjualankasir.grid4_render 	= function(){
        this.obj.find("#grid4").w2render(this.id + '_grid4') ;
    }

    bos.trpenjualankasir.grid4_reloaddata	= function(){
        this.grid4_loaddata() ;
        this.grid4_setdata() ;
        this.grid4_reload() ;
    }

    bos.trpenjualankasir.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
    }

    bos.trpenjualankasir.cmdpilihsj 		= function(fktsj){
        w2ui['bos-form-trpenjualankasir_grid2'].clear();
        bjs.ajax(this.url + '/pilihsj', 'fktsj=' + fktsj);
    }

    bos.trpenjualankasir.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trpenjualankasir.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trpenjualankasir.init 			= function(){

        this.obj.find("#bayar").val("0") ;
        this.obj.find("#kembalian").val("0") ;
        this.obj.find("#totalpj").val("0") ;
        this.obj.find("#diskonnom").val("0") ;
        this.obj.find("#total").val("0") ;

        this.obj.find("#stock").focus();
        bjs.ajax(this.url + '/init') ;
        w2ui[this.id + '_grid2'].clear();
        bos.trpenjualankasir.initdetail();

    }

    bos.trpenjualankasir.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#stock").val("") ;
        this.obj.find("#barcode").val("") ;
        this.obj.find("#namastock").val("") ;
        this.obj.find("#harga").val("0.00") ;
        this.obj.find("#qty").val("1") ;
        this.obj.find("#satuan").val("") ;
        this.obj.find("#diskon").val("0.00") ;
        this.obj.find("#jumlah").val("") ;
        this.obj.find("#stock").focus();




    }
    bos.trpenjualankasir.initcomp		= function(){
        this.grid2_load() ;

        this.grid3_load() ;
        this.grid4_load() ;

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
        bjs.ajax(this.url + '/init') ;
    }

    bos.trpenjualankasir.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trkas.tabsaction( e.i )  ;
        });  

        this.obj.on('remove', function(){
            bos.trpenjualankasir.grid2_destroy() ;
            bos.trpenjualankasir.grid3_destroy() ;
            bos.trpenjualankasir.grid4_destroy() ;
        }) ;
    }

    bos.trpenjualankasir.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }

    bos.trpenjualankasir.loadmodelbyr      = function(l){
        this.obj.find("#wrap-bayar-d").modal(l) ;
        this.obj.find("#diskonnom").focus();
    }

    bos.trpenjualankasir.hitungjumlah 			= function(){
        var jml = string_2n(this.obj.find("#qty").val()) * (string_2n(this.obj.find("#harga").val()) - string_2n(this.obj.find("#diskon").val()));
        this.obj.find("#jumlah").val($.number(jml,2));
    }



    bos.trpenjualankasir.hitungkembalian		= function(){
        var totalpj = bos.trpenjualankasir.obj.find("#totalpj").val() ;
        var bayar = bos.trpenjualankasir.obj.find("#bayar").val() ;
        var diskonnom = bos.trpenjualankasir.obj.find("#diskonnom").val() ;
        var totbayar = string_2n(bayar);// - string_2n(total);
        var kembalian = totbayar + string_2n(diskonnom) - string_2n(totalpj);
        bos.trpenjualankasir.obj.find("#kembalian").val($.number(kembalian,0)) ;
        bos.trpenjualankasir.obj.find("#bayar").val($.number(bayar,0)) ;
        bos.trpenjualankasir.obj.find("#diskonnom").val($.number(diskonnom,0)) ;
    }

    bos.trpenjualankasir.hitungsubtotal 			= function(){

        var nRows = w2ui[this.id + '_grid2'].records.length;

        var subtotal = 0 ;
        for(i=0;i< nRows;i++){
            var jumlah = w2ui[this.id + '_grid2'].getCellValue(i,7);

            subtotal += jumlah;
        }
        //var ppn = 0;
        //var pajak = subtotal * (string_2n(ppn) / 100);
        var total = subtotal;
        //alert(total);
        this.obj.find("#total").val($.number(total,0));
        this.obj.find("#totalpj").val($.number(total,0));
        bos.trpenjualankasir.hitungkembalian();
    }

    bos.trpenjualankasir.gotogrid 			= function(){
        var no = bos.trpenjualankasir.obj.find("#nomor").val();
        var stock = bos.trpenjualankasir.obj.find("#stock").val();
        var barcode = bos.trpenjualankasir.obj.find("#barcode").val();
        var keterangan = bos.trpenjualankasir.obj.find("#namastock").val();
        var harga = bos.trpenjualankasir.obj.find("#harga").val();
        var diskon = bos.trpenjualankasir.obj.find("#diskon").val();
        var qty = bos.trpenjualankasir.obj.find("#qty").val();
            var satuan = bos.trpenjualankasir.obj.find("#satuan").val();
            var jumlah = bos.trpenjualankasir.obj.find("#jumlah").val();
            bos.trpenjualankasir.grid2_append(no,stock,keterangan,harga,qty,satuan,diskon,jumlah,barcode);
    }

    bos.trpenjualankasir.cetakstruk 		= function(fakturtransaksi){
        var a = confirm("Data telah disimpan,,Apakah struk dicetak??");
        if(a){
            bjs.ajax(this.url + '/cetakstruk', '&fakturtransaksi=' + fakturtransaksi);
        }else{
            bjs.ajax(this.url + '/opencashdrawer');
        }
    }
    bos.trpenjualankasir.editdata = function(nomorurut){
        bos.trpenjualankasir.obj.find("#nomor").val(nomorurut);
        bos.trpenjualankasir.obj.find("#nomor").blur();
    }

    bos.trpenjualankasir.objs = bos.trpenjualankasir.obj.find("#cmdsave") ;
    bos.trpenjualankasir.initfunc	   = function(){

        this.obj.find("#cmdok").on("click", function(e){
            bos.trpenjualankasir.obj.find("#stock").blur();
        }) ;

        this.obj.find("#cmdstock").on("click", function(e){
            bos.trpenjualankasir.loadmodelstock("show");
            bos.trpenjualankasir.grid3_reloaddata() ;
        }) ;

        this.obj.find("#cmdbayar").on("click", function(e){
            bos.trpenjualankasir.loadmodelbyr("show");
        }) ;

        this.obj.find("#cmdcancelbyr").on("click", function(e){
            bos.trpenjualankasir.loadmodelbyr("hide");
        }) ;

        this.obj.find("#stock").on("blur", function(e){
            var datagrid = w2ui['bos-form-trpenjualankasir_grid2'].records;
            var no = bos.trpenjualankasir.obj.find("#nomor").val();

            if(bos.trpenjualankasir.obj.find("#stock").val() !== ""){
                var stock = bos.trpenjualankasir.obj.find("#stock").val();
                var qty  = bos.trpenjualankasir.obj.find("#qty").val();
                if(stock.indexOf("*") > 0){
                    res            = stock.split("*");
                    qty  = res[0];
                    stock  = res[1];
                    bos.trpenjualankasir.obj.find("#qty").val(res[0]);
                    bos.trpenjualankasir.obj.find("#stock").val(res[1]);
                }

                //cek data di grid dulu 


                var qtygrid = 0;


                if(no > datagrid.length){
                    for(var i=0;i<datagrid.length;i++){
                        var recid = datagrid[i]["recid"];
                        if(stock == recid){
                            qtygrid = datagrid[i]["qty"];
                        }
                    }
                }


                bjs.ajax( bos.trpenjualankasir.base_url + '/seekstock', bjs.getdataform(this)+"&qty="+qty+"&qtygrid="+qtygrid) ;
            }
        });

        this.obj.find("#nokartu").on("blur", function(e){
            if(bos.trpenjualankasir.obj.find("#nokartu").val() !== ""){
                bjs.ajax( bos.trpenjualankasir.base_url + '/seekkartu', bjs.getdataform(this)) ;
            }
        });

        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trpenjualankasir.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trpenjualankasir_grid2'].records;
            if(no <= datagrid.length){
                bos.trpenjualankasir.obj.find("#stock").val(w2ui['bos-form-trpenjualankasir_grid2'].getCellValue(no-1,1));
                bos.trpenjualankasir.obj.find("#namastock").val(w2ui['bos-form-trpenjualankasir_grid2'].getCellValue(no-1,2));
                bos.trpenjualankasir.obj.find("#harga").val(w2ui['bos-form-trpenjualankasir_grid2'].getCellValue(no-1,3));
                bos.trpenjualankasir.obj.find("#qty").val(w2ui['bos-form-trpenjualankasir_grid2'].getCellValue(no-1,4));
                bos.trpenjualankasir.obj.find("#satuan").val(w2ui['bos-form-trpenjualankasir_grid2'].getCellValue(no-1,5));
                bos.trpenjualankasir.obj.find("#diskon").val(w2ui['bos-form-trpenjualankasir_grid2'].getCellValue(no-1,6));
                bos.trpenjualankasir.obj.find("#jumlah").val(w2ui['bos-form-trpenjualankasir_grid2'].getCellValue(no-1,7));
                bos.trpenjualankasir.obj.find("#barcode").val(w2ui['bos-form-trpenjualankasir_grid2'].getCellValue(no-1,9));
                bos.trpenjualankasir.obj.find("#qty").focus();
            }else{
                bos.trpenjualankasir.obj.find("#nomor").val(datagrid.length + 1)
            }

            //bos.trpembelian.obj.find("#stock").val(w2ui['bos-form-mstdatastock_grid2'].getCellValue(no-1,1));
        });

        this.obj.find("#bayar").on("keyup", function(e){
            bos.trpenjualankasir.hitungkembalian();
        });
        
        this.obj.find("#diskonnom").on("keyup", function(e){
            bos.trpenjualankasir.hitungkembalian();
        });



        //this.obj.find('form').on("submit", function(e){
        this.obj.find("#cmdsave").on("click", function(e){
            //e.preventDefault() ;
            var a = confirm("Data akan disimpan??, pastikan data sudah benar");
            if(a){
                if(bjs.isvalidform(bos.trpenjualankasir.obj.find("form"))){
                    var datagrid2 =  w2ui['bos-form-trpenjualankasir_grid2'].records;
                    datagrid2 = JSON.stringify(datagrid2);
                    bjs.ajax( bos.trpenjualankasir.base_url + '/saving', bjs.getdataform(bos.trpenjualankasir.obj.find("form"))+"&grid2="+datagrid2) ;
                }
            }

        }) ;

        this.obj.find("#harga").on("blur", function(e){
            bos.trpenjualankasir.hitungjumlah();
        });
        this.obj.find("#qty").on("blur", function(e){
            var stock =  bos.trpenjualankasir.obj.find("#stock").val();
            if(stock !== "")bjs.ajax( bos.trpenjualankasir.base_url + '/seekstock2', bjs.getdataform(this)+"&stock="+stock) ;
        });
    }

    $('#customer').select2({
        ajax: {
            url: bos.trpenjualankasir.base_url + '/seekcustomer',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    shortcut.add("F1", function() {bos.trpenjualankasir.loadmodelstock("show");bos.trpenjualankasir.grid3_reloaddata() ;} );  
    shortcut.add("F2", function() {bos.trpenjualankasir.loadmodelbyr("show");} );
    shortcut.add("F3", function() {bos.trpenjualankasir.loadmodelbyr("hide");} );
    shortcut.add("F4", function() {bos.trpenjualankasir.obj.find("#cmdsave").click();} );
    $(function(){
        bjs.initenter($("form")) ;
        bos.trpenjualankasir.initcomp() ;
        bos.trpenjualankasir.initcallback() ;
        bos.trpenjualankasir.initfunc() ;
        bos.trpenjualankasir.initdetail();
    });

</script>