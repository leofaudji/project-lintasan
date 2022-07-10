<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tso">
                        <button class="btn btn-tab tpel active" href="#tso_1" data-toggle="tab" >Daftar Stock Opname</button>
                        <button class="btn btn-tab tpel" href="#tso_2" data-toggle="tab">Stock Opname</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trso.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tso_1" style="padding-top:5px;">
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
                <div role="tabpanel" class="tab-pane fade full-height" id="tso_2">
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
                                        <td width="14%"></td>
                                        <td width="1%"></td>
                                        <td ></td>
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
                                        <td><input maxlength="20" type="text" name="qty" id="qty" class="form-control number" value="0"></td>
                                        <td><input type="text" id="satuan" readonly name="satuan" class="form-control" placeholder="Satuan"></td>
                                        <td><button type="button" class="btn btn-primary pull-right" id="cmdok">OK</button></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "300px" >
                                <div id="grid2" class="full-height"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer fix hidden" style="height:62px">
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
<script type="text/javascript">
    <?=cekbosjs();?>
    //grid daftar po
    bos.trso.grid1_data    = null ;
    bos.trso.grid1_loaddata= function(){

        var tglawal = bos.trso.obj.find("#tglawal").val();
        var tglakhir = bos.trso.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trso.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trso.base_url + "/loadgrid",
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
                { field: 'gudang', caption: 'Gudang', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'cmdcetak', caption: ' ', size: '80px', sortable: false },
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trso.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trso.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trso.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trso.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trso.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail so
    bos.trso.grid2_load    = function(){
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
                { field: 'qty', caption: 'Qty', size: '100px', sortable: false, style:'text-align:right',render:'float:2'},
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.trso.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trso.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trso.grid2_append    = function(no,kode,keterangan,qty,satuan){
        var datagrid  = w2ui[this.id + '_grid2'].records;
        var lnew      = true;
        var nQty      = 1;
        var recid     = "";
        if(no <= datagrid.length){
            recid = no;
            w2ui[this.id + '_grid2'].set(recid,{stock: kode, namastock: keterangan,  qty:qty, satuan:satuan});
        }else{
            recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trso.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
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
        bos.trso.initdetail();
        bos.trso.obj.find("#cmdstock").focus() ;
    }

    bos.trso.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail pembelian???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trso.grid2_urutkan();
            bos.trso.hitungsubtotal();
        }
    }

    bos.trso.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        w2ui[this.id + '_grid2'].clear();
        for(i=0;i<datagrid.length;i++){
            var no = i+1;
            datagrid[i]["recid"] = no;
            var recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trso.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add({recid:recid,no: no, stock: datagrid[i]["stock"], namastock: datagrid[i]["namastock"],
                                          qty:datagrid[i]["qty"],satuan:datagrid[i]["satuan"],
                                          cmddelete:Hapus});
        }
    }

    //grid3 daftarstock
    bos.trso.grid3_data    = null ;
    bos.trso.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trso.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trso.base_url + "/loadgrid3",
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

    bos.trso.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trso.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trso.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trso.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trso.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }

    bos.trso.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', bjs.getdataform(this.obj.find('form'))+'&kode=' + kode);
    }

    bos.trso.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trso.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trso.cmdcetak	= function(faktur){
        bjs_os.form_report( this.base_url + '/showreport?faktur=' + faktur) ;
    }

    bos.trso.init 			= function(){

        this.obj.find("#gudang").sval("") ;

        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();

        bos.trso.initdetail();
    }

    bos.trso.settab 		= function(n){
        this.obj.find("#tso button:eq("+n+")").tab("show") ;
    }

    bos.trso.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trso.grid1_render() ;
            bos.trso.init() ;
        }else{
            bos.trso.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }
    bos.trso.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#stock").val("") ;
        this.obj.find("#namastock").val("") ;
        this.obj.find("#qty").val("0") ;
        this.obj.find("#satuan").val("") ;
    }

    bos.trso.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag

        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.grid2_load() ;

        this.grid3_load() ;
        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
    }

    bos.trso.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trso.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trso.grid1_destroy() ;
            bos.trso.grid2_destroy() ;
            bos.trso.grid3_destroy() ;
        }) ;
    }

    bos.trso.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }

    bos.trso.getDataStock = function(cKodeStock){
        bjs.ajax(this.url + '/getDataStock', 'cKodeStock=' + cKodeStock);
    }

    bos.trso.objs = bos.trso.obj.find("#cmdsave") ;
    bos.trso.initfunc	   = function(){
        this.obj.find("#cmdok").on("click", function(e){
            var no          = bos.trso.obj.find("#nomor").val();
            var stock       = bos.trso.obj.find("#stock").val();
            var keterangan  = bos.trso.obj.find("#namastock").val();
            var qty   = string_2n(bos.trso.obj.find("#qty").val());
            var satuan      = bos.trso.obj.find("#satuan").val();
            bos.trso.grid2_append(no,stock,keterangan,qty,satuan);
        }) ;

        this.obj.find("#cmdstock").on("click", function(e){
            bos.trso.loadmodelstock("show");
            bos.trso.grid3_reloaddata() ;
        }) ;

        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trso.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trso_grid2'].records;
            if(no <= datagrid.length){
                bos.trso.obj.find("#stock").val(w2ui['bos-form-trso_grid2'].getCellValue(no-1,1));
                bos.trso.obj.find("#namastock").val(w2ui['bos-form-trso_grid2'].getCellValue(no-1,2));
                bos.trso.obj.find("#qty").val(w2ui['bos-form-trso_grid2'].getCellValue(no-1,3));
                bos.trso.obj.find("#satuan").val(w2ui['bos-form-trso_grid2'].getCellValue(no-1,4));
            }else{
                bos.trso.obj.find("#nomor").val(datagrid.length + 1)
            }

        });

        this.obj.find("#stock").on("blur", function(e){
            e.soeventDefault ;
            var cKodeStock = bos.trso.obj.find("#stock").val();
            bos.trso.getDataStock(cKodeStock) ;
            $('#harga').focus();
        });

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trso_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trso.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trso.cmdsave) ;
            }

        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trso.grid1_reloaddata();
        });
    }

    $('#gudang').select2({

        ajax: {
            url: bos.trso.base_url + '/seekgudang',
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
        bos.trso.initcomp() ;
        bos.trso.initcallback() ;
        bos.trso.initfunc() ;
        bos.trso.initdetail();
    });
</script>