<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                Cetak Pricard Gondola
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trcetakpricecard.close()">
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
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td><label for="nomor">No</label> </td>
                                        <td><label for="stock">Stock (F1)</label> </td>
                                        <td><label>Nama Stock</label> </td>
                                        <td><label for="harga">Harga</label> </td>
                                        <td><label>Satuan</label> </td>
                                        <td><label for="barcode">Barcode</label> </td>
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
                                        <td><input type="text" id="satuan" readonly name="satuan" class="form-control" placeholder="Satuan"></td>
                                        <td><input type="text" id="barcode" name="barcode" class="form-control" placeholder="Barcode"></td>
                                        <td><button type="button" class="btn btn-primary pull-right" id="cmdok">OK</button></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "450px" >
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
                                                <td align = 'right'><button type="button" class="btn btn-primary pull-right" id="cmdcetak">Cetak</button></td>
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
    bos.trcetakpricecard.grid2_load    = function(){
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
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
                { field: 'barcode', caption: 'Barcode', size: '100px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.trcetakpricecard.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trcetakpricecard.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trcetakpricecard.grid2_append    = function(no,kode,keterangan,harga,satuan,barcode){
        var datagrid = w2ui[this.id + '_grid2'].records;
        var lnew = true;
        var recid = "";

        for(i=0;i<datagrid.length;i++){
            recid = datagrid[i]["recid"];
            if(recid == kode){
                w2ui[this.id + '_grid2'].set(recid,{no:i+1,stock: kode, namastock: keterangan, harga: harga, satuan:satuan,barcode:barcode});
                lnew = false;
            }
        }
        if(lnew){
            recid = kode;
            harga = string_2n(harga);
            var Hapus = "<button type='button' onclick = 'bos.trcetakpricecard.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,no: datagrid.length + 1, stock: kode, namastock: keterangan, harga: harga, satuan:satuan,cmddelete:Hapus,barcode:barcode}
            ]) ;
        }
        var jmldata = datagrid.length;
        w2ui[this.id + '_grid2'].scrollIntoView(jmldata);
        bos.trcetakpricecard.initdetail();
        bos.trcetakpricecard.obj.find("#stock").focus() ;
    }

    bos.trcetakpricecard.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail penjualan???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trcetakpricecard.grid2_urutkan();
        }
    }

    bos.trcetakpricecard.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        for(i=0;i<datagrid.length;i++){
            w2ui[this.id + '_grid2'].set(datagrid[i]["recid"],{no : i+1});
        }
    }


    //grid3 daftarstock
    bos.trcetakpricecard.grid3_data    = null ;
    bos.trcetakpricecard.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trcetakpricecard.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trcetakpricecard.base_url + "/loadgrid3",
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

    bos.trcetakpricecard.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trcetakpricecard.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trcetakpricecard.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trcetakpricecard.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trcetakpricecard.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }



    bos.trcetakpricecard.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
    }

    bos.trcetakpricecard.init 			= function(){
        this.obj.find("#stock").focus();

        w2ui[this.id + '_grid2'].clear();
        bos.trcetakpricecard.initdetail();

    }

    bos.trcetakpricecard.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#stock").val("") ;
        this.obj.find("#barcode").val("") ;
        this.obj.find("#namastock").val("") ;
        this.obj.find("#harga").val("0.00") ;
        this.obj.find("#satuan").val("") ;
        this.obj.find("#stock").focus();




    }
    bos.trcetakpricecard.initcomp		= function(){
        this.grid2_load() ;

        this.grid3_load() ;

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag

    }

    bos.trcetakpricecard.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trkas.tabsaction( e.i )  ;
        });  

        this.obj.on('remove', function(){
            bos.trcetakpricecard.grid2_destroy() ;
            bos.trcetakpricecard.grid3_destroy() ;
        }) ;
    }

    bos.trcetakpricecard.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }

    bos.trcetakpricecard.gotogrid 			= function(){
        var no = bos.trcetakpricecard.obj.find("#nomor").val();
        var stock = bos.trcetakpricecard.obj.find("#stock").val();
        var barcode = bos.trcetakpricecard.obj.find("#barcode").val();
        var keterangan = bos.trcetakpricecard.obj.find("#namastock").val();
        var harga = bos.trcetakpricecard.obj.find("#harga").val();
        harga = string_2n(harga);
        var satuan = bos.trcetakpricecard.obj.find("#satuan").val();
        if(stock == "" || harga == ""){
            alert("Data tidak valid !!!");
            bos.trcetakpricecard.obj.find("#cmdstock").focus();
        }else{
            bos.trcetakpricecard.grid2_append(no,stock,keterangan,harga,satuan,barcode);
        }

    }
    bos.trcetakpricecard.showReport = function(urlfile){
        bjs_os.form_report(urlfile) ;
    }

    bos.trcetakpricecard.objs = bos.trcetakpricecard.obj.find("#cmdsave") ;
    bos.trcetakpricecard.initfunc	   = function(){

        this.obj.find("#cmdok").on("click", function(e){
            bos.trcetakpricecard.gotogrid();
        }) ;

        this.obj.find("#cmdstock").on("click", function(e){
            bos.trcetakpricecard.loadmodelstock("show");
            bos.trcetakpricecard.grid3_reloaddata() ;
        }) ;

        this.obj.find("#stock").on("blur", function(e){
            if(bos.trcetakpricecard.obj.find("#stock").val() !== ""){
                var stock = bos.trcetakpricecard.obj.find("#stock").val();

                bjs.ajax( bos.trcetakpricecard.base_url + '/seekstock', bjs.getdataform(this)) ;
            }
        });
        
        this.obj.find("#cmdcetak").on("click", function(e){
            var datagrid2 =  w2ui['bos-form-trcetakpricecard_grid2'].records;
            datagrid2 = JSON.stringify(datagrid2);
            bjs.ajax( bos.trcetakpricecard.base_url + '/cetakpricecard', bjs.getdataform(this)+"&grid2="+datagrid2) ;
        }) ;

    }

    $(function(){
        bjs.initenter($("form")) ;
        bos.trcetakpricecard.initcomp() ;
        bos.trcetakpricecard.initcallback() ;
        bos.trcetakpricecard.initfunc() ;
        bos.trcetakpricecard.initdetail();
    });

</script>