<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tsj">
                        <button class="btn btn-tab tpel active" href="#tsj_1" data-toggle="tab" >Daftar Surat Jalan</button>
                        <button class="btn btn-tab tpel" href="#tsj_2" data-toggle="tab">Surat Jalan</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trsj.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tsj_1" style="padding-top:5px;">
                    <table width="100%">
                        <tr>
                            <td height="25px" width="100%">
                                <table class="osxtable form">
                                    <tr>
                                        <td width="85px">
                                            <input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>
                                        <td width="5px">sd</td>
                                        <td width="85px">
                                            <input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>
                                        <td width="85px">
                                            <button type="button" class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
                                        </td>
                                        <td></td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="400px">
                                <div id="grid1" class="full-height"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="tsj_2">
                    <table width="100%">
                        <tr>
                            <td width="100%" class="osxtable form">
                                <table>
                                    <tr>
                                        <td width="14%"><label for="faktur">Faktur</label> </td>
                                        <td width="1%">:</td>
                                        <td width="35%">
                                            <input type="text" id="faktur" name="faktur" class="form-control" placeholder="Faktur" required>
                                        </td>
                                        <td width="14%"><label for="customer">Customer</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <select name="customer" id="customer" class="form-control select" style="width:100%"
                                                data-placeholder="Customer" required></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="tgl">Tanggal</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>
                                        <td width="14%"><label for="fktpo">Faktur DO</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <div width = '100%' class="input-group">
                                                <input type="text" id="fktdo" name="fktdo" class="form-control" placeholder="Faktur DO">
                                                <span class="input-group-btn">
                                                    <button class="form-control btn btn-info" type="button" id="cmddo"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="petugaspengirim">Supir</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input type="text" id="petugaspengirim" name="petugaspengirim" class="form-control" placeholder="Supir">
                                        </td>
                                        <td width="14%"><label for="nopol">No Pol</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <select name="nopol" id="nopol" class="form-control select" style="width:100%"
                                                data-placeholder="Nopol"></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="kernet">Kernet</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input type="text" id="kernet" name="kernet" class="form-control" placeholder="Kernet">
                                        </td>
                                        <td width="14%"></td>
                                        <td width="1%"></td>
                                        <td>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td width='50px'><label for="nomor">No</label> </td>
                                        <td><label for="stock">Produk</label> </td>
                                        <td><label>Nama Produk</label> </td>
                                        <td><label for="qty">Qty</label> </td>
                                        <td><label>Satuan</label> </td>
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
                                        <td><input maxlength="10" type="text" name="qty" id="qty" class="form-control number" value="0"></td>
                                        <td><input type="text" id="satuan" readonly name="satuan" class="form-control" placeholder="Satuan"></td>
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
                    </table>
                </div>
            </div>
        </div>
        <div class="footer fix hidden" style="height:32px">
            <button class="btn btn-primary pull-right" id="cmdsave">Simpan</button>
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
<div class="modal fade" id="wrap-pencariando-d" role="dialog" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wm-title">Daftar Faktur DO</h4>
            </div>
            <div class="modal-body">
                <div id="grid4" style="height:250px"></div>
            </div>
            <div class="modal-footer">
                *Pilih Faktur DO
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?=cekbosjs();?>
    //grid daftar po
    bos.trsj.grid1_data    = null ;
    bos.trsj.grid1_loaddata= function(){

        var tglawal = bos.trsj.obj.find("#tglawal").val();
        var tglakhir = bos.trsj.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trsj.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trsj.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'do', caption: 'Faktur DO', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'customer', caption: 'Customer', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'petugaspengirim', caption: 'Supir', size: '150px', sortable: false , style:"text-align:center"},
                { field: 'kernet', caption: 'Kernet', size: '150px', sortable: false , style:"text-align:center"},
                { field: 'nopol', caption: 'No Pol', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trsj.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trsj.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trsj.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trsj.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trsj.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail pembelian
    bos.trsj.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false},
                { field: 'stock', caption: 'Kode / Barcode', size: '120px', sortable: false },
                { field: 'namastock', caption: 'Nama Stock', size: '150px', sortable: false },
                { field: 'qty', caption: 'Qty', size: '70px', sortable: false, style:'text-align:right'},
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.trsj.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trsj.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trsj.grid2_append    = function(no,kode,keterangan,qty,satuan){
        var datagrid  = w2ui[this.id + '_grid2'].records;
        var lnew      = true;
        var nQty      = 1;
        var recid     = "";
        if(no <= datagrid.length){
            recid = no;
            w2ui[this.id + '_grid2'].set(recid,{stock: kode, namastock: keterangan,  qty: qty, satuan:satuan});
        }else{
            recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trsj.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,
                 no: no,
                 stock: kode,
                 namastock: keterangan,
                 qty: qty,
                 satuan:satuan,
                 cmddelete:Hapus}
            ]) ;
        }
        bos.trsj.initdetail();
        bos.trsj.obj.find("#cmdstock").focus() ;
    }

    bos.trsj.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail SJ???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trsj.grid2_urutkan();
        }
    }

    bos.trsj.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        w2ui[this.id + '_grid2'].clear();
        for(i=0;i<datagrid.length;i++){
            var no = i+1;
            datagrid[i]["recid"] = no;
            var recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trsj.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add({recid:recid,no: no, stock: datagrid[i]["stock"], namastock: datagrid[i]["namastock"],
                                          qty: datagrid[i]["qty"], satuan:datagrid[i]["satuan"],cmddelete:Hapus});
        }
    }

    //grid3 daftarstock
    bos.trsj.grid3_data    = null ;
    bos.trsj.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trsj.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trsj.base_url + "/loadgrid3",
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

    bos.trsj.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trsj.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trsj.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trsj.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trsj.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }
    
    //grid4 daftardo
    bos.trsj.grid4_data    = null ;
    bos.trsj.grid4_loaddata= function(){
        this.grid4_data 		= {} ;
    }

    bos.trsj.grid4_load    = function(){
        this.obj.find("#grid4").w2grid({
            name	: this.id + '_grid4',
            limit 	: 100 ,
            url 	: bos.trsj.base_url + "/loadgrid4",
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

    bos.trsj.grid4_setdata	= function(){
        w2ui[this.id + '_grid4'].postData 	= this.grid4_data ;
    }
    bos.trsj.grid4_reload		= function(){
        w2ui[this.id + '_grid4'].reload() ;
    }
    bos.trsj.grid4_destroy 	= function(){
        if(w2ui[this.id + '_grid4'] !== undefined){
            w2ui[this.id + '_grid4'].destroy() ;
        }
    }

    bos.trsj.grid4_render 	= function(){
        this.obj.find("#grid4").w2render(this.id + '_grid4') ;
    }

    bos.trsj.grid4_reloaddata	= function(){
        this.grid4_loaddata() ;
        this.grid4_setdata() ;
        this.grid4_reload() ;
    }

    bos.trsj.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
    }
    
    bos.trsj.cmdpilihdo 		= function(fktdo){
        w2ui['bos-form-trsj_grid2'].clear();
        bjs.ajax(this.url + '/pilihdo', 'fktdo=' + fktdo);
    }

    bos.trsj.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trsj.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trsj.init 			= function(){

        this.obj.find("#gudang").sval("") ;
        this.obj.find("#customer").sval("") ;
        this.obj.find("#fktdo").val("") ;
        this.obj.find("#petugaspengirim").val("") ;
        this.obj.find("#kernet").val("") ;
        this.obj.find("#nopol").sval("") ;

        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();

        bos.trsj.initdetail();
    }

    bos.trsj.settab 		= function(n){
        this.obj.find("#tsj button:eq("+n+")").tab("show") ;
    }

    bos.trsj.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trsj.grid1_render() ;
            bos.trsj.init() ;
        }else{
            bos.trsj.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }
    bos.trsj.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#stock").val("") ;
        this.obj.find("#namastock").val("") ;
        this.obj.find("#qty").val("1") ;
        this.obj.find("#satuan").val("") ;



    }

    bos.trsj.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag

        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.grid2_load() ;

        this.grid3_load() ;
        this.grid4_load() ;
        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
    }

    bos.trsj.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trsj.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trsj.grid1_destroy() ;
            bos.trsj.grid2_destroy() ;
            bos.trsj.grid3_destroy() ;
            bos.trsj.grid4_destroy() ;
        }) ;
    }

    bos.trsj.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }
    
    bos.trsj.loadmodeldo      = function(l){
        this.obj.find("#wrap-pencariando-d").modal(l) ;
    }

    bos.trsj.getDataStock = function(cKodeStock){
        bjs.ajax(this.url + '/getDataStock', 'cKodeStock=' + cKodeStock);
    }

    bos.trsj.objs = bos.trsj.obj.find("#cmdsave") ;
    bos.trsj.initfunc	   = function(){
        this.obj.find("#cmdok").on("click", function(e){
            var no          = bos.trsj.obj.find("#nomor").val();
            var stock       = bos.trsj.obj.find("#stock").val();
            var keterangan  = bos.trsj.obj.find("#namastock").val();
            var qty         = bos.trsj.obj.find("#qty").val();
            var satuan      = bos.trsj.obj.find("#satuan").val();
            bos.trsj.grid2_append(no,stock,keterangan,qty,satuan);
        }) ;

        this.obj.find("#cmdstock").on("click", function(e){
            bos.trsj.loadmodelstock("show");
            bos.trsj.grid3_reloaddata() ;
        }) ;
        
        this.obj.find("#cmddo").on("click", function(e){
            bos.trsj.loadmodeldo("show");
            bos.trsj.grid4_reloaddata() ;
        }) ;

        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trsj.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trsj_grid2'].records;
            if(no <= datagrid.length){
                bos.trsj.obj.find("#stock").val(w2ui['bos-form-trsj_grid2'].getCellValue(no-1,1));
                bos.trsj.obj.find("#namastock").val(w2ui['bos-form-trsj_grid2'].getCellValue(no-1,2));
                bos.trsj.obj.find("#qty").val(w2ui['bos-form-trsj_grid2'].getCellValue(no-1,3));
                bos.trsj.obj.find("#satuan").val(w2ui['bos-form-trsj_grid2'].getCellValue(no-1,4));
            }else{
                bos.trsj.obj.find("#nomor").val(datagrid.length + 1)
            }

        });

        this.obj.find("#stock").on("blur", function(e){
            e.preventDefault ;
            var cKodeStock = bos.trsj.obj.find("#stock").val();
            bos.trsj.getDataStock(cKodeStock) ;
            $('#qty').focus();
        });

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trsj_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trsj.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trsj.cmdsave) ;
            }

        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trsj.grid1_reloaddata();
        });
    }

    $('#customer').select2({
        ajax: {
            url: bos.trsj.base_url + '/seekcustomer',
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
    
    $('#nopol').select2({
        ajax: {
            url: bos.trsj.base_url + '/seekarmada',
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

    $(function(){
        bos.trsj.initcomp() ;
        bos.trsj.initcallback() ;
        bos.trsj.initfunc() ;
        bos.trsj.initdetail();
    });
</script>