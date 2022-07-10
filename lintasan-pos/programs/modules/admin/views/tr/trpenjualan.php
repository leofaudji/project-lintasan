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
                            <div class="btn-circle btn-close transition" onclick="bos.trpenjualan.close()">
                                <img src="./uploads/titlebar/close.png">
                            </div>
                        </td>
                    </tr>
                </table>
            </td> 
        </tr>
    </table> 
</div><!-- end header -->
<div class="body">
    <form novalidate>
        <div class="bodyfix scrollme" style="height:100%">
            <div class="tab-content full-height">
                <div> 
                    <table width="100%">
                        <tr>
                            <td height="25px" width="100%">
                                <table class="osxtable form">
                                    <tr>  
                                        <td width="14%"><label for="faktur">Faktur</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input type="text" id="faktur" name="faktur" class="form-control" placeholder="Faktur" readonly required>
                                        </td> 
                                        <td width="14%"><label for="fktsj">Faktur SJ</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <div width = '100%' class="input-group">
                                                <input type="text" id="fktsj" name="fktsj" class="form-control" placeholder="Faktur SJ">
                                                <span class="input-group-btn">
                                                    <button class="form-control btn btn-info" type="button" id="cmdsj"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>

                                        </td>
                                    </tr> 
                                    <tr>  
                                        <td width="14%"><label for="tgl">Tgl</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input  type="text" style="width:80px" class="form-control date" id="tgl" name="tgl"  required value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td> 
                                        <td width="14%"><label for="supplier">Customer</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <select name="customer" id="customer" class="form-control select" style="width:100%"
                                                    data-placeholder="Customer" required></select>
                                        </td>
                                    </tr>
                                    <tr>  
                                        <td width="14%"><label for="persppn">PPN (%)</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input maxlength="20" width = "50px" type="text" name="persppn" id="persppn" class="form-control number" value="0.00">
                                        </td> 
                                        <td width="14%"></td>
                                        <td width="1%"></td>
                                        <td >

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td><label for="nomor">No</label> </td>
                                        <td><label for="stock">Produk</label> </td>
                                        <td><label>Nama Produk</label> </td>
                                        <td><label for="harga">Harga</label> </td>
                                        <td><label for="qty">Qty</label> </td>
                                        <td><label>Satuan</label> </td>
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
                                        <td><input maxlength="20" readonly type="text" name="jumlah" id="jumlah" class="form-control number" value="0"></td>
                                        <td><button type="button" class="btn btn-primary pull-right" id="cmdok">OK</button></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "230px" >
                                <div id="grid2" class="full-height"></div>
                            </td>
                        </tr>
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td><label>Sub Total</label> </td>
                                        <td><label>PPN</label></td>
                                        <td><label>Total</label></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="20" type="text" name="subtotal" id="subtotal" class="form-control number" value="0" readonly></td>
                                        <td><input maxlength="20" type="text" name="ppn" id="ppn" class="form-control number" value="0" readonly></td>
                                        <td><input maxlength="20" type="text" name="total" id="total" class="form-control number" value="0" readonly></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><label for="piutang">Piutang</label></td>
                                        <td><label for="bayar">Kas</label></td>
                                        <td><label>Kembalian</label> </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="20" type="text" name="piutang" id="piutang" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" type="text" name="bayar" id="bayar" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" type="text" name="kembalian" id="kembalian" class="form-control number" value="0" readonly></td>
                                        <td><button class="btn btn-primary" id="cmdsave">Simpan</button></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </form>
</div>
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
<div class="modal fade" id="wrap-pencariansj-d" role="dialog" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wm-title">Daftar Faktur SJ</h4>
            </div>
            <div class="modal-body">
                <div id="grid4" style="height:250px"></div>
            </div>
            <div class="modal-footer">
                *Pilih Faktur SJ
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>

    //grid detail penjualan
    bos.trpenjualan.grid2_load    = function(){
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
                { field: 'qty', caption: 'Qty', size: '70px', sortable: false, style:'text-align:right',
                 render: function(record){
                     if(record.recid !== "ZZZZ"){
                         return '<div style = "text-align:center">'+
                             ' <input type="number" style="width:60px" value='+record.qty+
                             '  onChange=bos.trpenjualan.grid2_hitungjumlah('+record.recid+',this.value,'+record.harga+')>'+
                             '</div>';

                     }
                 }
                },
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
                { field: 'jumlah', caption: 'Jumlah', size: '100px', sortable: false, style:'text-align:right',render:'int'},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.trpenjualan.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trpenjualan.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trpenjualan.grid2_append    = function(no,kode,keterangan,harga,qty,satuan,jumlah){
        var datagrid = w2ui[this.id + '_grid2'].records;
        var lnew = true;
        var nQty = 1;
        var nJumlah = nQty * harga;
        var recid = "";
        for(i=0;i<datagrid.length;i++){
            recid = datagrid[i]["recid"];
            if(kode == recid){
                lnew = false;
                harga = string_2n(harga);
                qty = string_2n(qty);
                jumlah = qty * harga;

                w2ui[this.id + '_grid2'].set(recid,{no:i+1,stock: kode, namastock: keterangan, harga: harga, qty: qty, satuan:satuan,jumlah:jumlah});
            }
        }
        if(lnew){
            recid = kode;
            harga = string_2n(harga);
            qty = string_2n(qty);
            jumlah = qty * harga;
            var Hapus = "<button type='button' onclick = 'bos.trpenjualan.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,no: datagrid.length + 1, stock: kode, namastock: keterangan, harga: harga, qty: qty, satuan:satuan,jumlah:jumlah,cmddelete:Hapus}
            ]) ;
        }
        bos.trpenjualan.initdetail();
        bos.trpenjualan.obj.find("#stock").focus() ;
        bos.trpenjualan.hitungsubtotal();
    }
    bos.trpenjualan.grid2_hitungjumlah = function(recid,qty,harga){
        //alert(recid+"eer"+qty+"eefef"+harga

        var nJumlah = qty * harga;
        w2ui[this.id + '_grid2'].set(recid,{qty:qty,jumlah:nJumlah});
        bos.trpenjualan.hitungsubtotal();
    }
    bos.trpenjualan.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail penjualan???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trpenjualan.grid2_urutkan();
            bos.trpenjualan.hitungsubtotal();
        }
    }

    bos.trpenjualan.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        for(i=0;i<datagrid.length;i++){
            w2ui[this.id + '_grid2'].set(datagrid[i]["recid"],{no : i+1});
        }
    }


    //grid3 daftarstock
    bos.trpenjualan.grid3_data    = null ;
    bos.trpenjualan.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trpenjualan.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trpenjualan.base_url + "/loadgrid3",
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

    bos.trpenjualan.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trpenjualan.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trpenjualan.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trpenjualan.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trpenjualan.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }

    //grid4 daftarsj
    bos.trpenjualan.grid4_data    = null ;
    bos.trpenjualan.grid4_loaddata= function(){
        this.grid4_data 		= {} ;
    }

    bos.trpenjualan.grid4_load    = function(){
        this.obj.find("#grid4").w2grid({
            name	: this.id + '_grid4',
            limit 	: 100 ,
            url 	: bos.trpenjualan.base_url + "/loadgrid4",
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

    bos.trpenjualan.grid4_setdata	= function(){
        w2ui[this.id + '_grid4'].postData 	= this.grid4_data ;
    }
    bos.trpenjualan.grid4_reload		= function(){
        w2ui[this.id + '_grid4'].reload() ;
    }
    bos.trpenjualan.grid4_destroy 	= function(){
        if(w2ui[this.id + '_grid4'] !== undefined){
            w2ui[this.id + '_grid4'].destroy() ;
        }
    }

    bos.trpenjualan.grid4_render 	= function(){
        this.obj.find("#grid4").w2render(this.id + '_grid4') ;
    }

    bos.trpenjualan.grid4_reloaddata	= function(){
        this.grid4_loaddata() ;
        this.grid4_setdata() ;
        this.grid4_reload() ;
    }

    bos.trpenjualan.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
    }

    bos.trpenjualan.cmdpilihsj 		= function(fktsj){
        w2ui['bos-form-trpenjualan_grid2'].clear();
        bjs.ajax(this.url + '/pilihsj', 'fktsj=' + fktsj);
    }

    bos.trpenjualan.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trpenjualan.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trpenjualan.init 			= function(){
        this.obj.find(".nav-tabs li:eq(0) a").tab("show") ;

        this.obj.find("#bayar").val("0") ;
        this.obj.find("#fktsj").val("") ;
        this.obj.find("#kembalian").val("0") ;
        this.obj.find("#subtotal").val("0") ;
        this.obj.find("#total").val("0") ;
        this.obj.find("#piutang").val("0") ;
        this.obj.find("#persppn").val("0") ;
        this.obj.find("#ppn").val("0") ;
        this.obj.find("#customer").sval("") ;

        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();
        bos.trpenjualan.initdetail();

    }

    bos.trpenjualan.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#stock").val("") ;
        this.obj.find("#namastock").val("") ;
        this.obj.find("#harga").val("") ;
        this.obj.find("#qty").val("1") ;
        this.obj.find("#satuan").val("") ;
        this.obj.find("#jumlah").val("") ;




    }
    bos.trpenjualan.initcomp		= function(){
        this.grid2_load() ;

        this.grid3_load() ;
        this.grid4_load() ;

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
    }

    bos.trpenjualan.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trkas.tabsaction( e.i )  ;
        });  

        this.obj.on('remove', function(){
            bos.trpenjualan.grid2_destroy() ;
            bos.trpenjualan.grid3_destroy() ;
            bos.trpenjualan.grid4_destroy() ;
        }) ;
    }

    bos.trpenjualan.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }

    bos.trpenjualan.loadmodelsj      = function(l){
        this.obj.find("#wrap-pencariansj-d").modal(l) ;
    }

    bos.trpenjualan.hitungjumlah 			= function(){
        var jml = string_2n(this.obj.find("#qty").val()) * string_2n(this.obj.find("#harga").val());
        this.obj.find("#jumlah").val($.number(jml,2));
    }



    bos.trpenjualan.hitungkembalian		= function(){
        var total = bos.trpenjualan.obj.find("#total").val() ;
        var piutang = bos.trpenjualan.obj.find("#piutang").val() ;
        var bayar = bos.trpenjualan.obj.find("#bayar").val() ;
        var totbayar = string_2n(piutang) + string_2n(bayar);// - string_2n(total);
        var kembalian = totbayar - string_2n(total);
        bos.trpenjualan.obj.find("#kembalian").val($.number(kembalian,2)) ;
        bos.trpenjualan.obj.find("#bayar").val($.number(bayar,2)) ;
        bos.trpenjualan.obj.find("#piutang").val($.number(piutang,2)) ;
    }

    bos.trpenjualan.hitungsubtotal 			= function(){
        var nRows = w2ui[this.id + '_grid2'].records.length;
        var subtotal = 0 ;
        for(i=0;i< nRows;i++){
            var jumlah = w2ui[this.id + '_grid2'].getCellValue(i,6);
            subtotal += jumlah;
        }
        var ppn = bos.trpenjualan.obj.find("#persppn").val();
        var pajak = subtotal * (string_2n(ppn) / 100);
        var total = pajak + subtotal;

        this.obj.find("#subtotal").val($.number(subtotal,2));
        this.obj.find("#ppn").val($.number(pajak,2));
        this.obj.find("#total").val($.number(total,2));
        bos.trpenjualan.hitungkembalian();
    }

    bos.trpenjualan.objs = bos.trpenjualan.obj.find("#cmdsave") ;
    bos.trpenjualan.initfunc	   = function(){

        this.obj.find("#cmdok").on("click", function(e){
            var no = bos.trpenjualan.obj.find("#nomorkartu").val();
            var stock = bos.trpenjualan.obj.find("#stock").val();
            var keterangan = bos.trpenjualan.obj.find("#namastock").val();
            var harga = bos.trpenjualan.obj.find("#harga").val();
            var qty = bos.trpenjualan.obj.find("#qty").val();
            var satuan = bos.trpenjualan.obj.find("#satuan").val();
            var jumlah = bos.trpenjualan.obj.find("#jumlah").val();
            bos.trpenjualan.grid2_append(no,stock,keterangan,harga,qty,satuan,jumlah);
        }) ;

        this.obj.find("#cmdstock").on("click", function(e){
            bos.trpenjualan.loadmodelstock("show");
            bos.trpenjualan.grid3_reloaddata() ;
        }) ;

        this.obj.find("#cmdsj").on("click", function(e){
            bos.trpenjualan.loadmodelsj("show");
            bos.trpenjualan.grid4_reloaddata() ;
        }) ;

        /* this.obj.find("#stock").on("blur", function(e){
            if(bos.trpenjualan.obj.find("#stock").val() !== ""){
                var stock = bos.trpenjualan.obj.find("#stock").val();
                if(stock.indexOf("*") > 0){
                    res            = stock.split("*");
                    bos.trpenjualan.obj.find("#qty").val(res[0]);
                    bos.trpenjualan.obj.find("#stock").val(res[1]);
                }
                bjs.ajax( bos.trpenjualan.base_url + '/seekstock', bjs.getdataform(this)) ;
            }
        });*/

        this.obj.find("#nokartu").on("blur", function(e){
            if(bos.trpenjualan.obj.find("#nokartu").val() !== ""){
                bjs.ajax( bos.trpenjualan.base_url + '/seekkartu', bjs.getdataform(this)) ;
            }
        });

        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trpenjualan.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trpenjualan_grid2'].records;
            if(no <= datagrid.length){
                bos.trpenjualan.obj.find("#stock").val(w2ui['bos-form-trpenjualan_grid2'].getCellValue(no-1,1));
                bos.trpenjualan.obj.find("#namastock").val(w2ui['bos-form-trpenjualan_grid2'].getCellValue(no-1,2));
                bos.trpenjualan.obj.find("#harga").val(w2ui['bos-form-trpenjualan_grid2'].getCellValue(no-1,3));
                bos.trpenjualan.obj.find("#qty").val(w2ui['bos-form-trpenjualan_grid2'].getCellValue(no-1,4));
                bos.trpenjualan.obj.find("#satuan").val(w2ui['bos-form-trpenjualan_grid2'].getCellValue(no-1,5));
                bos.trpenjualan.obj.find("#jumlah").val(w2ui['bos-form-trpenjualan_grid2'].getCellValue(no-1,6));
            }else{
                bos.trpenjualan.obj.find("#nomor").val(datagrid.length + 1)
            }

            //bos.trpembelian.obj.find("#stock").val(w2ui['bos-form-mstdatastock_grid2'].getCellValue(no-1,1));
        });

        this.obj.find("#bayar").on("blur", function(e){
            bos.trpenjualan.hitungkembalian();
        });

        this.obj.find("#piutang").on("blur", function(e){
            bos.trpenjualan.hitungkembalian();
        });

        /* w2ui['bos-form-mstdatastock_grid2'].on('click',function(event){
            console.log(event);
        });*/

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trpenjualan_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trpenjualan.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trpenjualan.objs) ;
            }

        }) ;

        this.obj.find("#harga").on("blur", function(e){
            bos.trpenjualan.hitungjumlah();
        });
        this.obj.find("#qty").on("blur", function(e){
            bos.trpenjualan.hitungjumlah();
        });
    }

    $('#customer').select2({
        ajax: {
            url: bos.trpenjualan.base_url + '/seekcustomer',
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

    /*w2ui['bos-form-mstdatastock_grid2'].on('click',function(event){
            alert("kcvgcxhv");
    });*/
    $(function(){
        bos.trpenjualan.initcomp() ;
        bos.trpenjualan.initcallback() ;
        bos.trpenjualan.initfunc() ;
        bos.trpenjualan.initdetail();
    });

</script>