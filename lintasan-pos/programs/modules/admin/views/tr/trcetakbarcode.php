<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                Cetak Barcode Stock
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trcetakbarcode.close()">
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
                                        <td><label for="stock">Stock (F1)</label> </td>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" id="stock" name="stock" class="form-control" placeholder="Stock">
                                                <span class="input-group-btn">
                                                    <button class="form-control btn btn-info" type="button" id="cmdstock"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Nama Stock</label> </td>
                                        <td>:</td>
                                        <td><input type="text" id="namastock" readonly name="namastock" class="form-control" placeholder="Nama Stock"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="harga">Harga</label> </td>
                                        <td>:</td>
                                        <td>
                                            <input readonly maxlength="20" type="text" name="harga" id="harga" class="form-control number" value="0">
                                            <input type="checkbox" name="tampilharga" id="tampilharga"/> Tampilkan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Satuan</label> </td>
                                        <td>:</td>
                                        <td><input type="text" id="satuan" readonly name="satuan" class="form-control" placeholder="Satuan"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="barcode">Barcode</label> </td>
                                        <td>:</td>
                                        <td><input readonly type="text" id="barcode" name="barcode" class="form-control" placeholder="Barcode"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="cetak">Cetak (Lembar)</label> </td>
                                        <td>:</td>
                                        <td><input maxlength="20" type="text" name="cetak" id="cetak" class="form-control number" value="0"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td height = "20px" class="osxtable form">
                                <tr>
                                    <td>
                                        <table width = '100%'>
                                            <tr>
                                                <td align = 'left'> *) scan barcode barang, apabila barcode tidak ada bisa memasukkan no barcode kedalam kolom kode
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


    //grid3 daftarstock
    bos.trcetakbarcode.grid3_data    = null ;
    bos.trcetakbarcode.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trcetakbarcode.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trcetakbarcode.base_url + "/loadgrid3",
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

    bos.trcetakbarcode.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trcetakbarcode.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trcetakbarcode.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trcetakbarcode.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trcetakbarcode.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }



    bos.trcetakbarcode.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
    }

    bos.trcetakbarcode.init 			= function(){
        this.obj.find("#stock").focus();
        bos.trcetakbarcode.initdetail();

    }

    bos.trcetakbarcode.initdetail 			= function(){
        this.obj.find("#stock").val("") ;
        this.obj.find("#barcode").val("") ;
        this.obj.find("#namastock").val("") ;
        this.obj.find("#harga").val("0.00") ;
        this.obj.find("#cetak").val("1") ;
        this.obj.find("#satuan").val("") ;
        this.obj.find("#stock").focus();




    }
    bos.trcetakbarcode.initcomp		= function(){
        this.grid3_load() ;

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag

    }

    bos.trcetakbarcode.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trkas.tabsaction( e.i )  ;
        });  

        this.obj.on('remove', function(){

            bos.trcetakbarcode.grid3_destroy() ;
        }) ;
    }

    bos.trcetakbarcode.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }
    
    bos.trcetakbarcode.showReport = function(urlfile){
        bjs_os.form_report(urlfile) ;
    }

    bos.trcetakbarcode.initfunc	   = function(){



        this.obj.find("#cmdstock").on("click", function(e){
            bos.trcetakbarcode.loadmodelstock("show");
            bos.trcetakbarcode.grid3_reloaddata() ;
        }) ;

        this.obj.find("#stock").on("blur", function(e){
            if(bos.trcetakbarcode.obj.find("#stock").val() !== ""){
                var stock = bos.trcetakbarcode.obj.find("#stock").val();

                bjs.ajax( bos.trcetakbarcode.base_url + '/seekstock', bjs.getdataform(this)) ;
            }
        });
        
        this.obj.find("#cmdcetak").on("click", function(e){
            bjs.ajax( bos.trcetakbarcode.base_url + '/cetakbarcode', bjs.getdataform(bos.trcetakbarcode.obj.find("form"))) ;
        }) ;

    }

    $(function(){
        bjs.initenter($("form")) ;
        bos.trcetakbarcode.initcomp() ;
        bos.trcetakbarcode.initcallback() ;
        bos.trcetakbarcode.initfunc() ;
        bos.trcetakbarcode.initdetail();
        JsBarcode(".barcode").init();
    });

</script>