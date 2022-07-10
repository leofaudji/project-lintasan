<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tpo">
                        <button class="btn btn-tab tpel active" href="#tpo_1" data-toggle="tab" >Daftar Purchase Order</button>
                        <button class="btn btn-tab tpel" href="#tpo_2" data-toggle="tab">Purchase Order</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trpo.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tpo_1" style="padding-top:5px;">
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
                <div role="tabpanel" class="tab-pane fade full-height" id="tpo_2">
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
                                        <td width="14%"><label for="gudang">Gudang</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <select name="gudang" id="gudang" class="form-control select" style="width:100%"
                                                    data-placeholder="Gudang" required></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="tgl">Tanggal</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>
                                        <td width="14%"><label for="supplier">Supplier</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <select name="supplier" id="supplier" class="form-control select" style="width:100%"
                                                    data-placeholder="Supplier" required></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"></td>
                                        <td width="1%"></td>
                                        <td ></td>
                                        <td width="14%"><label for="fktpr">Faktur SPP</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <div width = '100%' class="input-group">
                                                <input type="text" id="fktpr" name="fktpr" class="form-control" placeholder="Faktur SPP">
                                                <span class="input-group-btn">
                                                    <button class="form-control btn btn-info" type="button" id="cmdpr"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
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
                                        <td><label for="stock">Stock</label> </td>
                                        <td><label>Nama Stock</label> </td>
                                        <td><label>Spesifikasi</label> </td>
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
                                        <td><input type="text" id="spesifikasi" name="spesifikasi" class="form-control" placeholder="Spesifikasi"></td>
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
                            <td height = "210px" >
                                <div id="grid2" class="full-height"></div>
                            </td>
                        </tr>
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td><label>Subtotal</label> </td>
                                        <td><label>Total</label> </td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="20" readonly type="text" name="subtotal" id="subtotal" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" readonly type="text" name="total" id="total" class="form-control number" value="0"></td>
                                    </tr>
                                </table>
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
<div class="modal fade" id="wrap-pencarianpr-d" role="dialog" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wm-title">Daftar Faktur SPP</h4>
            </div>
            <div class="modal-body">
                <div id="grid4" style="height:250px"></div>
            </div>
            <div class="modal-footer">
                *Pilih Faktur SPP
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>
    //grid daftar po
    bos.trpo.grid1_data    = null ;
    bos.trpo.grid1_loaddata= function(){

        var tglawal = bos.trpo.obj.find("#tglawal").val();
        var tglakhir = bos.trpo.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trpo.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trpo.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'fktpr', caption: 'Fkt PR', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'supplier', caption: 'Supplier', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'total', caption: 'Total', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trpo.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trpo.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trpo.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trpo.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trpo.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail pr
    bos.trpo.grid2_load    = function(){
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
                { field: 'spesifikasi', caption: 'Spesifikasi', size: '300px', sortable: false },
                { field: 'harga',render:'float:2', caption: 'Harga', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'qty',render:'float:2', caption: 'Qty', size: '70px', sortable: false, style:'text-align:right'},
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
                { field: 'jumlah',render:'float:2', caption: 'Jumlah', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.trpo.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trpo.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trpo.grid2_append    = function(no,kode,keterangan,spesifikasi,harga,qty,satuan,jumlah){
        var datagrid  = w2ui[this.id + '_grid2'].records;
        var lnew      = true;
        var nQty      = 1;
        var nJumlah   = nQty * harga;
        var recid     = "";
        if(no <= datagrid.length){
            recid = no;
            w2ui[this.id + '_grid2'].set(recid,{stock: kode, namastock: keterangan, spesifikasi: spesifikasi, harga: harga, qty: qty, satuan:satuan,jumlah:jumlah});
        }else{
            recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trpo.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,
                 no: no,
                 stock: kode,
                 namastock: keterangan,
                 spesifikasi: spesifikasi,
                 harga: harga,
                 qty: qty,
                 satuan:satuan,
                 jumlah:jumlah,
                 cmddelete:Hapus}
            ]) ;
        }
        bos.trpo.initdetail();
        bos.trpo.obj.find("#cmdstock").focus() ;
        bos.trpo.hitungsubtotal();
    }

    bos.trpo.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail po???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trpo.grid2_urutkan();
            bos.trpo.hitungsubtotal();
        }
    }

    bos.trpo.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        w2ui[this.id + '_grid2'].clear();
        for(i=0;i<datagrid.length;i++){
            var no = i+1;
            datagrid[i]["recid"] = no;
            var recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trpo.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add({recid:recid,no: no, stock: datagrid[i]["stock"], namastock: datagrid[i]["namastock"],
                                          spesifikasi: datagrid[i]["spesifikasi"],
                                          harga: datagrid[i]["harga"], qty: datagrid[i]["qty"], satuan:datagrid[i]["satuan"],
                                          jumlah:datagrid[i]["jumlah"],cmddelete:Hapus});
        }
    }

    //grid3 daftarstock
    bos.trpo.grid3_data    = null ;
    bos.trpo.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trpo.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trpo.base_url + "/loadgrid3",
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

    bos.trpo.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trpo.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trpo.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trpo.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trpo.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }

    //grid4 daftarpr
    bos.trpo.grid4_data    = null ;
    bos.trpo.grid4_loaddata= function(){
        this.grid4_data 		= {} ;
    }

    bos.trpo.grid4_load    = function(){
        this.obj.find("#grid4").w2grid({
            name	: this.id + '_grid4',
            limit 	: 100 ,
            url 	: bos.trpo.base_url + "/loadgrid4",
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
                { field: 'gudang', caption: 'Gudang', size: '200px', sortable: false },
                { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trpo.grid4_setdata	= function(){
        w2ui[this.id + '_grid4'].postData 	= this.grid4_data ;
    }
    bos.trpo.grid4_reload		= function(){
        w2ui[this.id + '_grid4'].reload() ;
    }
    bos.trpo.grid4_destroy 	= function(){
        if(w2ui[this.id + '_grid4'] !== undefined){
            w2ui[this.id + '_grid4'].destroy() ;
        }
    }

    bos.trpo.grid4_render 	= function(){
        this.obj.find("#grid4").w2render(this.id + '_grid4') ;
    }

    bos.trpo.grid4_reloaddata	= function(){
        this.grid4_loaddata() ;
        this.grid4_setdata() ;
        this.grid4_reload() ;
    }

    bos.trpo.cmdpilihpr 		= function(fktpr){
        w2ui['bos-form-trpo_grid2'].clear();
        bjs.ajax(this.url + '/pilihpr', 'fktpr=' + fktpr);
    }

    bos.trpo.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
    }

    bos.trpo.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trpo.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trpo.init 			= function(){

        this.obj.find("#subtotal").val("") ;
        this.obj.find("#total").val("") ;
        this.obj.find("#gudang").sval("") ;
        this.obj.find("#supplier").sval("") ;
        this.obj.find("#fktpr").val("") ;

        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();

        bos.trpo.initdetail();
    }

    bos.trpo.settab 		= function(n){
        this.obj.find("#tpo button:eq("+n+")").tab("show") ;
    }

    bos.trpo.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trpo.grid1_render() ;
            bos.trpo.init() ;
        }else{
            bos.trpo.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }
    bos.trpo.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#stock").val("") ;
        this.obj.find("#namastock").val("") ;
        this.obj.find("#spesifikasi").val("") ;
        this.obj.find("#harga").val("") ;
        this.obj.find("#qty").val("1") ;
        this.obj.find("#satuan").val("") ;
        this.obj.find("#jumlah").val("") ;



    }

    bos.trpo.initcomp		= function(){
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

    bos.trpo.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trpo.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trpo.grid1_destroy() ;
            bos.trpo.grid2_destroy() ;
            bos.trpo.grid3_destroy() ;
            bos.trpo.grid4_destroy() ;
        }) ;
    }

    bos.trpo.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }

    bos.trpo.loadmodelpr      = function(l){
        this.obj.find("#wrap-pencarianpr-d").modal(l) ;
    }

    bos.trpo.hitungjumlah 			= function(){
        var qty = string_2n(this.obj.find("#qty").val());
        var harga = string_2n(this.obj.find("#harga").val());
        var jml = qty * harga;
        this.obj.find("#jumlah").val($.number(jml,2));
        this.obj.find("#qty").val($.number(qty,2));
        this.obj.find("#harga").val($.number(harga,2));
    }

    bos.trpo.hitungsubtotal 			= function(){

        var nRows = w2ui[this.id + '_grid2'].records.length;
        var subtotal = 0 ;
        for(i=0;i< nRows;i++){
            var jumlah = w2ui[this.id + '_grid2'].getCellValue(i,7);
            subtotal += Number(jumlah);
        }
        this.obj.find("#subtotal").val($.number(subtotal,2));
        bos.trpo.hitungtotal();
    }

    bos.trpo.hitungtotal 			= function(){
        var total = string_2n(this.obj.find("#subtotal").val());
        this.obj.find("#total").val($.number(total,2));
    }

    bos.trpo.getDataStock = function(cKodeStock){
        bjs.ajax(this.url + '/getDataStock', 'cKodeStock=' + cKodeStock);
    }

    bos.trpo.objs = bos.trpo.obj.find("#cmdsave") ;
    bos.trpo.initfunc	   = function(){
        this.obj.find("#cmdok").on("click", function(e){
            var no          = bos.trpo.obj.find("#nomor").val();
            var stock       = bos.trpo.obj.find("#stock").val();
            var keterangan  = bos.trpo.obj.find("#namastock").val();
            var spesifikasi  = bos.trpo.obj.find("#spesifikasi").val();
            var harga       = string_2n(bos.trpo.obj.find("#harga").val());
            var qty         = string_2n(bos.trpo.obj.find("#qty").val());
            var satuan      = bos.trpo.obj.find("#satuan").val();
            var jumlah      = string_2n(bos.trpo.obj.find("#jumlah").val());
            bos.trpo.grid2_append(no,stock,keterangan,spesifikasi,harga,qty,satuan,jumlah);
        }) ;

        this.obj.find("#cmdstock").on("click", function(e){
            bos.trpo.loadmodelstock("show");
            bos.trpo.grid3_reloaddata() ;
        }) ;

        this.obj.find("#cmdpr").on("click", function(e){
            bos.trpo.loadmodelpr("show");
            bos.trpo.grid4_reloaddata() ;
        }) ;

        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trpo.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trpo_grid2'].records;
            if(no <= datagrid.length){
                bos.trpo.obj.find("#stock").val(w2ui['bos-form-trpo_grid2'].getCellValue(no-1,1));
                bos.trpo.obj.find("#namastock").val(w2ui['bos-form-trpo_grid2'].getCellValue(no-1,2));
                bos.trpo.obj.find("#spesifikasi").val(w2ui['bos-form-trpo_grid2'].getCellValue(no-1,3));
                bos.trpo.obj.find("#harga").val($.number(w2ui['bos-form-trpo_grid2'].getCellValue(no-1,4),2));
                bos.trpo.obj.find("#qty").val($.number(w2ui['bos-form-trpo_grid2'].getCellValue(no-1,5),2));
                bos.trpo.obj.find("#satuan").val(w2ui['bos-form-trpo_grid2'].getCellValue(no-1,6));
                bos.trpo.obj.find("#jumlah").val($.number(w2ui['bos-form-trpo_grid2'].getCellValue(no-1,7),2));
            }else{
                bos.trpo.obj.find("#nomor").val(datagrid.length + 1)
            }

        });

        this.obj.find("#stock").on("blur", function(e){
            e.preventDefault ;
            var cKodeStock = bos.trpo.obj.find("#stock").val();
            bos.trpo.getDataStock(cKodeStock) ;
            $('#harga').focus();
        });

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trpo_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                //alert("dsfsdf");
                bjs.ajax(bos.trpo.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trpo.cmdsave) ;
            }
            //});
        }) ;

        this.obj.find("#harga").on("blur", function(e){
            bos.trpo.hitungjumlah();
        });
        this.obj.find("#qty").on("blur", function(e){
            bos.trpo.hitungjumlah();
        });

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trpo.grid1_reloaddata();
        });
    }

    $('#gudang').select2({

        ajax: {
            url: bos.trpo.base_url + '/seekgudang',
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

    $('#supplier').select2({
        ajax: {
            url: bos.trpo.base_url + '/seeksupplier',
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
        bos.trpo.initcomp() ;
        bos.trpo.initcallback() ;
        bos.trpo.initfunc() ;
        bos.trpo.initdetail();
    });
</script>