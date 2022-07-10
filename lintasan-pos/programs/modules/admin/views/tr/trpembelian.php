<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tpb">
                        <button class="btn btn-tab tpel active" href="#tpb_1" data-toggle="tab" >Daftar Pembelian</button>
                        <button class="btn btn-tab tpel" href="#tpb_2" data-toggle="tab">Pembelian</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trpembelian.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tpb_1" style="padding-top:5px;">
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
                <div role="tabpanel" class="tab-pane fade full-height" id="tpb_2">
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
                                        <td width="14%"><label for="fktpo">Faktur PO</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <div width = '100%' class="input-group">
                                                <input type="text" id="fktpo" name="fktpo" class="form-control" placeholder="Faktur PO">
                                                <span class="input-group-btn">
                                                    <button class="form-control btn btn-info" type="button" id="cmdpo"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>

                                        </td>
                                        <td width="14%">PPn (%)</td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input maxlength="6" width="7" type="text" name="persppn" id="persppn" class="form-control number" value="0">
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
                                        <td>
                                            <input type="hidden" name="barcode" id="barcode" value="">
                                            <button type="button" class="btn btn-primary pull-right" id="cmdok">OK</button>
                                        </td>
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
                                        <td><label>Subtotal</label> </td>
                                        <td><label for="diskontotal">Diskon</label> </td>
                                        <td><label for="pembulatantotal">Pembulatan</label> </td>
                                        <td><label for="ppntotal">Ppn</label> </td>
                                        <td><label>Total</label> </td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="20" readonly type="text" name="subtotal" id="subtotal" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" type="text" name="diskontotal" id="diskontotal" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" type="text" name="pembulatantotal" id="pembulatantotal" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" readonly type="text" name="ppntotal" id="ppntotal" class="form-control number" value="0"></td>
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
<div class="modal fade" id="wrap-pencarianpo-d" role="dialog" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wm-title">Daftar Faktur PO</h4>
            </div>
            <div class="modal-body">
                <div id="grid4" style="height:250px"></div>
            </div>
            <div class="modal-footer">
                *Pilih Faktur PO
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?=cekbosjs();?>
    //grid daftar pembelian
    bos.trpembelian.grid1_data    = null ;
    bos.trpembelian.grid1_loaddata= function(){

        var tglawal = bos.trpembelian.obj.find("#tglawal").val();
        var tglakhir = bos.trpembelian.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trpembelian.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trpembelian.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'fktpo', caption: 'Faktur', size: '122px', sortable: false, style:"text-align:center"},
                { field: 'supplier', caption: 'Supplier', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'subtotal', caption: 'Subtotal', size: '100px',render:'int', sortable: false, style:"text-align:right" },
                { field: 'diskon', caption: 'Diskon', size: '100px', sortable: false,render:'int', style:"text-align:right"},
                { field: 'pembulatan', caption: 'Pembulatan', size: '100px', sortable: false,render:'int', style:"text-align:right"},
                { field: 'ppn', caption: 'PPn', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'total', caption: 'Total', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trpembelian.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trpembelian.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trpembelian.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trpembelian.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trpembelian.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail pembelian
    bos.trpembelian.grid2_load    = function(){
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
                { field: 'harga',render:'float:2', caption: 'Harga', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'qty',render:'float:2', caption: 'Qty', size: '70px', sortable: false, style:'text-align:right'},
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
                { field: 'jumlah',render:'float:2', caption: 'Jumlah', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false },
                { field: 'barcode', caption: 'Barcode', size: '100px', sortable: false }
            ]
        });


    }

    bos.trpembelian.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trpembelian.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trpembelian.grid2_append    = function(no,kode,keterangan,harga,qty,satuan,jumlah,barcode){
        var datagrid  = w2ui[this.id + '_grid2'].records;
        var lnew      = true;
        var nQty      = 1;
        var nJumlah   = nQty * harga;
        var recid     = "";
        if(no <= datagrid.length){
            recid = no;
            w2ui[this.id + '_grid2'].set(recid,{stock: kode, namastock: keterangan, harga: harga, qty: qty, satuan:satuan,jumlah:jumlah,barcode:barcode});
        }else{
            recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trpembelian.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,
                 no: no,
                 stock: kode,
                 namastock: keterangan,
                 harga: harga,
                 qty: qty,
                 satuan:satuan,
                 jumlah:jumlah,
                 cmddelete:Hapus,
                 barcode:barcode}
            ]) ;
        }
        var jmldata = datagrid.length;
        w2ui[this.id + '_grid2'].scrollIntoView(jmldata);
        bos.trpembelian.initdetail();
        bos.trpembelian.obj.find("#stock").focus() ;
        bos.trpembelian.hitungsubtotal();
    }

    bos.trpembelian.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail pembelian???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trpembelian.grid2_urutkan();
            bos.trpembelian.hitungsubtotal();
        }
    }

    bos.trpembelian.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        w2ui[this.id + '_grid2'].clear();
        for(i=0;i<datagrid.length;i++){
            var no = i+1;
            datagrid[i]["recid"] = no;
            var recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trpembelian.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add({recid:recid,no: no, stock: datagrid[i]["stock"], namastock: datagrid[i]["namastock"],
                                          harga: datagrid[i]["harga"], qty: datagrid[i]["qty"], satuan:datagrid[i]["satuan"],
                                          jumlah:datagrid[i]["jumlah"],cmddelete:Hapus,barcode: datagrid[i]["barcode"]});
        }
    }

    //grid3 daftarstock
    bos.trpembelian.grid3_data    = null ;
    bos.trpembelian.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trpembelian.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trpembelian.base_url + "/loadgrid3",
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

    bos.trpembelian.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trpembelian.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trpembelian.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trpembelian.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trpembelian.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }

    //grid4 daftarpo
    bos.trpembelian.grid4_data    = null ;
    bos.trpembelian.grid4_loaddata= function(){
        this.grid4_data 		= {} ;
    }

    bos.trpembelian.grid4_load    = function(){
        this.obj.find("#grid4").w2grid({
            name	: this.id + '_grid4',
            limit 	: 100 ,
            url 	: bos.trpembelian.base_url + "/loadgrid4",
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
                { field: 'supplier', caption: 'Supplier', size: '200px', sortable: false },
                { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trpembelian.grid4_setdata	= function(){
        w2ui[this.id + '_grid4'].postData 	= this.grid4_data ;
    }
    bos.trpembelian.grid4_reload		= function(){
        w2ui[this.id + '_grid4'].reload() ;
    }
    bos.trpembelian.grid4_destroy 	= function(){
        if(w2ui[this.id + '_grid4'] !== undefined){
            w2ui[this.id + '_grid4'].destroy() ;
        }
    }

    bos.trpembelian.grid4_render 	= function(){
        this.obj.find("#grid4").w2render(this.id + '_grid4') ;
    }

    bos.trpembelian.grid4_reloaddata	= function(){
        this.grid4_loaddata() ;
        this.grid4_setdata() ;
        this.grid4_reload() ;
    }

    bos.trpembelian.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
    }

    bos.trpembelian.cmdpilihpo 		= function(fktpo){
        w2ui['bos-form-trpembelian_grid2'].clear();
        bjs.ajax(this.url + '/pilihpo', 'fktpo=' + fktpo);
    }

    bos.trpembelian.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trpembelian.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trpembelian.init 			= function(){

        this.obj.find("#subtotal").val("0") ;
        this.obj.find("#diskontotal").val("0") ;
        this.obj.find("#pembulatantotal").val("0") ;
        this.obj.find("#ppntotal").val("0") ;
        this.obj.find("#persppn").val("0") ;
        this.obj.find("#fktpo").val("") ;
        this.obj.find("#total").val("0") ;
        this.obj.find("#gudang").sval("") ;
        this.obj.find("#supplier").sval("") ;

        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();

        bos.trpembelian.initdetail();
    }

    bos.trpembelian.settab 		= function(n){
        this.obj.find("#tpb button:eq("+n+")").tab("show") ;
    }

    bos.trpembelian.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trpembelian.grid1_render() ;
            bos.trpembelian.init() ;
        }else{
            bos.trpembelian.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }
    bos.trpembelian.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#stock").val("") ;
        this.obj.find("#namastock").val("") ;
        this.obj.find("#harga").val("") ;
        this.obj.find("#qty").val("1") ;
        this.obj.find("#satuan").val("") ;
        this.obj.find("#barcode").val("") ;
        this.obj.find("#jumlah").val("0") ;



    }

    bos.trpembelian.initcomp		= function(){
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

    bos.trpembelian.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trpembelian.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trpembelian.grid1_destroy() ;
            bos.trpembelian.grid2_destroy() ;
            bos.trpembelian.grid3_destroy() ;
            bos.trpembelian.grid4_destroy() ;
        }) ;
    }

    bos.trpembelian.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }

    bos.trpembelian.loadmodelpo      = function(l){
        this.obj.find("#wrap-pencarianpo-d").modal(l) ;
    }

    bos.trpembelian.hitungjumlah 			= function(){
        var qty = string_2n(this.obj.find("#qty").val());
        var harga = string_2n(this.obj.find("#harga").val());
        var jml = qty * harga;
        this.obj.find("#jumlah").val($.number(jml,2));
        this.obj.find("#qty").val($.number(qty,2));
        this.obj.find("#harga").val($.number(harga,2));
    }

    bos.trpembelian.hitungsubtotal 			= function(){

        var nRows = w2ui[this.id + '_grid2'].records.length;
        var subtotal = 0 ;
        for(i=0;i< nRows;i++){
            var jumlah = w2ui[this.id + '_grid2'].getCellValue(i,6);
            subtotal += Number(jumlah);
        }
        this.obj.find("#subtotal").val($.number(subtotal,2));
        bos.trpembelian.hitungtotal();
    }

    bos.trpembelian.hitungtotal 			= function(){
        var persppn = string_2n(this.obj.find("#persppn").val());
        var subtotal = string_2n(this.obj.find("#subtotal").val());
        var diskontotal = string_2n(this.obj.find("#diskontotal").val());
        var pembulatantotal = string_2n(this.obj.find("#pembulatantotal").val());
        var ppntotal = persppn * subtotal / 100;
        var total = subtotal - diskontotal + pembulatantotal + ppntotal;
        this.obj.find("#ppntotal").val($.number(ppntotal,2));
        this.obj.find("#total").val($.number(total,2));
        this.obj.find("#diskontotal").val($.number(diskontotal,2));
        this.obj.find("#pembulatantotal").val($.number(pembulatantotal,2));
    }

    bos.trpembelian.getDataStock = function(cKodeStock){ 
        bjs.ajax(this.url + '/getDataStock', 'cKodeStock=' + cKodeStock);
    }

    bos.trpembelian.objs = bos.trpembelian.obj.find("#cmdsave") ;
    bos.trpembelian.initfunc	   = function(){
        this.obj.find("#cmdok").on("click", function(e){
            var no          = bos.trpembelian.obj.find("#nomor").val();
            var stock       = bos.trpembelian.obj.find("#stock").val();
            var keterangan  = bos.trpembelian.obj.find("#namastock").val();
            var harga       = string_2n(bos.trpembelian.obj.find("#harga").val());
            var qty         = string_2n(bos.trpembelian.obj.find("#qty").val());
            var satuan      = bos.trpembelian.obj.find("#satuan").val();
            var jumlah      = string_2n(bos.trpembelian.obj.find("#jumlah").val());
            var barcode      = bos.trpembelian.obj.find("#barcode").val();
            bos.trpembelian.grid2_append(no,stock,keterangan,harga,qty,satuan,jumlah,barcode);
        }) ;

        this.obj.find("#cmdstock").on("click", function(e){
            bos.trpembelian.loadmodelstock("show");
            bos.trpembelian.grid3_reloaddata() ;
        }) ;
        
        this.obj.find("#stock").on("blur", function(e){
            if(bos.trpembelian.obj.find("#stock").val() !== ""){
                var stock = bos.trpembelian.obj.find("#stock").val();
                var qty  = bos.trpembelian.obj.find("#qty").val();
                if(stock.indexOf("*") > 0){
                    res            = stock.split("*");
                    qty  = res[0];
                    stock  = res[1];
                    bos.trpembelian.obj.find("#qty").val(res[0]);
                    bos.trpembelian.obj.find("#stock").val(res[1]);
                }

                bjs.ajax( bos.trpembelian.base_url + '/seekstock', bjs.getdataform(this)) ;
            }
        });


        this.obj.find("#cmdpo").on("click", function(e){
            bos.trpembelian.loadmodelpo("show");
            bos.trpembelian.grid4_reloaddata() ;
        }) ;

        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trpembelian.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trpembelian_grid2'].records;
            if(no <= datagrid.length){
                bos.trpembelian.obj.find("#stock").val(w2ui['bos-form-trpembelian_grid2'].getCellValue(no-1,1));
                bos.trpembelian.obj.find("#namastock").val(w2ui['bos-form-trpembelian_grid2'].getCellValue(no-1,2));
                bos.trpembelian.obj.find("#harga").val($.number(w2ui['bos-form-trpembelian_grid2'].getCellValue(no-1,3),2));
                bos.trpembelian.obj.find("#qty").val($.number(w2ui['bos-form-trpembelian_grid2'].getCellValue(no-1,4),2));
                bos.trpembelian.obj.find("#satuan").val(w2ui['bos-form-trpembelian_grid2'].getCellValue(no-1,5));
                bos.trpembelian.obj.find("#jumlah").val($.number(w2ui['bos-form-trpembelian_grid2'].getCellValue(no-1,6),2));
                bos.trpembelian.obj.find("#barcode").val(w2ui['bos-form-trpembelian_grid2'].getCellValue(no-1,8));
            }else{
                bos.trpembelian.obj.find("#nomor").val(datagrid.length + 1)
            }

            //bos.trpembelian.obj.find("#stock").val(w2ui['bos-form-mstdatastock_grid2'].getCellValue(no-1,1));
        });

        this.obj.find("#stock").on("blur", function(e){
            e.preventDefault ;
            var cKodeStock = bos.trpembelian.obj.find("#stock").val();
            bos.trpembelian.getDataStock(cKodeStock) ;
            $('#harga').focus();
        });

        this.obj.find("#diskontotal").on("blur", function(e){
            bos.trpembelian.hitungtotal();
        });
        
        this.obj.find("#pembulatantotal").on("blur", function(e){
            bos.trpembelian.hitungtotal();
        });

        this.obj.find("#persppn").on("blur", function(e){
            bos.trpembelian.hitungtotal();
        });
        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trpembelian_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trpembelian.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trpembelian.cmdsave) ;
            }

        }) ;

        this.obj.find("#harga").on("blur", function(e){
            bos.trpembelian.hitungjumlah();
        });
        this.obj.find("#qty").on("blur", function(e){
            bos.trpembelian.hitungjumlah();
        });

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trpembelian.grid1_reloaddata();
        });
    }

    $('#gudang').select2({

        ajax: {
            url: bos.trpembelian.base_url + '/seekgudang',
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
            url: bos.trpembelian.base_url + '/seeksupplier',
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
        bos.trpembelian.initcomp() ;
        bos.trpembelian.initcallback() ;
        bos.trpembelian.initfunc() ;
        bos.trpembelian.initdetail();
    });
</script>