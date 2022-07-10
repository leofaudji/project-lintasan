<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tmststock">
                        <button class="btn btn-tab tpel active" href="#tmststock_1" data-toggle="tab" >Daftar Stock / Barang</button>
                        <button class="btn btn-tab tpel" href="#tmststock_2" data-toggle="tab">Stock / Barang</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.mstdatastock.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tmststock_1" style="padding-top:5px;">
                    <table width="100%">
                        <tr>
                            <td height="25px" width="100%">
                                <table class="osxtable form">
                                    <tr>
                                        <td width = '250px'>
                                            <div class="radio-inline">
                                                <label><input type="radio" name="jenis" value="0" checked>Semua</label>&nbsp;&nbsp;
                                            </div>
                                            <div class="radio-inline">
                                                <label><input type="radio" name="jenis" value="1">HP atau HB. Akhir >= HJ</label>&nbsp;&nbsp;
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" id="search" name="search" class="form-control" placeholder="Pencarian">
                                        </td>
                                        <td width="85px">
                                            <button type="button" class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = '400px'>
                                <div id="grid1" class="full-height"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="tmststock_2">

                    <table width='100%'>
                        <tr>
                            <td>
                                <table class="osxtable form">
                                    <tr>
                                        <td width="14%"><label for="kode">Kode</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input type="text" id="kode" name="kode" class="form-control" placeholder="kode" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="barcode">Barcode</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input type="text" id="barcode" name="barcode" class="form-control" placeholder="Barcode">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="keterangan">Keterangan</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="keterangan" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="group">Golongan</label> </td>
                                        <td>:</td>
                                        <td>
                                            <select name="group" id="group" class="form-control select" style="width:100%"
                                                    data-placeholder="Golongan Stock" required></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="satuan">Satuan</label> </td>
                                        <td>:</td>
                                        <td>
                                            <select name="satuan" id="satuan" class="form-control select" style="width:100%"
                                                    data-placeholder="Satuan Stock" required></select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td><label>Harga</label> </td>
                                        <td><label>Max Qty</label> </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="20" type="text" name="harga" id="harga" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" type="text" name="qty" id="qty" class="form-control number" value="0"></td>
                                        <td><button type="button" class="btn btn-primary pull-right" id="cmdok">OK</button></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "150px" >
                                <div id="grid2" class="full-height"></div>
                            </td>
                        </tr>
                    </table>

                    <div class="footer fix hidden" style="height:32px">
                        <button class="btn btn-primary pull-right" id="cmdsave">Simpan</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>

    bos.mstdatastock.grid1_data    = null ;
    bos.mstdatastock.grid1_loaddata= function(){
        var jenis = bos.mstdatastock.obj.find("input:radio[name='jenis']:checked").val();
        var search = bos.mstdatastock.obj.find("#search").val();
        this.grid1_data 		= {'jenis':jenis,'search':search} ;
    }

    bos.mstdatastock.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.mstdatastock.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'kode', caption: 'Kode', size: '150px', sortable: false, style:"text-align:center;"},
                { field: 'barcode', caption: 'Barcode', size: '150px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false },
                { field: 'KetStockGroup', caption: 'Stock Group', size: '150px', sortable: false },
                { field: 'satuan', caption: 'Satuan', size: '150px', sortable: false ,style:"text-align:center;"},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false },
                { field: 'hj', caption: 'Hrg. Jual', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'hp', caption: 'Hrg. Pokok', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'hb', caption: 'Hrg. Beli', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'mrghp', caption: 'Mrg. By HP', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'mrghppers', caption: 'Mrg. By HP %', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'mrghb', caption: 'Mrg. By HB', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'mrghbpers', caption: 'Mrg. By HB %', size: '100px', sortable: false, render:'int',style:"text-align:right"}
            ]
        });
    }

    bos.mstdatastock.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.mstdatastock.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.mstdatastock.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }
    bos.mstdatastock.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }
    bos.mstdatastock.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid hargajual
    bos.mstdatastock.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false},
                { field: 'harga',render:'float:2', caption: 'Harga', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'qty',render:'float:2', caption: 'Max Qty', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.mstdatastock.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.mstdatastock.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.mstdatastock.grid2_append    = function(harga,qty){
        var datagrid  = w2ui[this.id + '_grid2'].records;
        var lnew      = true;
        qty      = qty;
        harga      = harga;
        w2ui[this.id + '_grid2'].clear();
        var lmasuk = false;
        var recid = 0 ;
        for(i=0;i<datagrid.length;i++){

            recid++;
            var no = recid;
            if(datagrid[i]["qty"] == qty && !lmasuk){
                var Hapus = "<button type='button' onclick = 'bos.mstdatastock.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
                w2ui[this.id + '_grid2'].add([
                    { recid:recid,
                     no: no,
                     harga: harga,
                     qty: qty,
                     cmddelete:Hapus}
                ]) ;
                lmasuk = true;
            }else {
                if(datagrid[i]["qty"] > qty && !lmasuk){
                    var Hapus = "<button type='button' onclick = 'bos.mstdatastock.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
                    w2ui[this.id + '_grid2'].add([
                        { recid:recid,
                         no: no,
                         harga: harga,
                         qty: qty,
                         cmddelete:Hapus}
                    ]) ;
                    recid++;
                    no++;
                    lmasuk = true;
                }

                var Hapus = "<button type='button' onclick = 'bos.mstdatastock.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
                w2ui[this.id + '_grid2'].add([
                    { recid:recid,
                     no: no,
                     harga: datagrid[i]["harga"],
                     qty: datagrid[i]["qty"],
                     cmddelete:Hapus}
                ]) ;
            }
        }

        if(!lmasuk){
            recid++;
            no++;
            var Hapus = "<button type='button' onclick = 'bos.mstdatastock.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,
                 no: no,
                 harga: harga,
                 qty: qty,
                 cmddelete:Hapus}
            ]) ;


        }
        bos.mstdatastock.grid2_urutkan ();

        bos.mstdatastock.initdetail();
        bos.mstdatastock.obj.find("#harga").focus() ;
    }

    bos.mstdatastock.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail harga???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.mstdatastock.grid2_urutkan();
        }
    }

    bos.mstdatastock.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        w2ui[this.id + '_grid2'].clear();
        for(i=0;i<datagrid.length;i++){
            var no = i+1;
            datagrid[i]["recid"] = no;
            var recid = no;
            var Hapus = "<button type='button' onclick = 'bos.mstdatastock.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add({recid:recid,no: no,harga: datagrid[i]["harga"], qty: datagrid[i]["qty"],cmddelete:Hapus});
        }
    }

    bos.mstdatastock.initdetail 			= function(){
        this.obj.find("#harga").val("0") ;
        this.obj.find("#qty").val("0") ;
    }



    bos.mstdatastock.cmdedit 		= function(kode){
        bjs.ajax(this.url + '/editing', 'kode=' + kode);
    }

    bos.mstdatastock.cmddelete 	= function(kode){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'kode=' + kode);
        }
    }

    bos.mstdatastock.init 			= function(){
        this.obj.find("#kode").val("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#barcode").val("") ;
        this.obj.find("#group").sval("") ;
        this.obj.find("#satuan").sval("") ;
        bjs.ajax(this.url + '/getkode') ;
        bjs.ajax(this.url + '/init') ;
        w2ui[this.id + '_grid2'].clear();
        this.obj.find("#ckpilihsemua").checked = false;

    }

    bos.mstdatastock.settab 		= function(n){
        this.obj.find("#tmststock button:eq("+n+")").tab("show") ;
    }

    bos.mstdatastock.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.mstdatastock.grid1_render() ;
            bos.mstdatastock.init() ;
        }else{
            bos.mstdatastock.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#kode").focus() ;

        }
    }

    bos.mstdatastock.initcomp		= function(){

        bjs.ajax(this.url + '/getkode') ;
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag

    }

    bos.mstdatastock.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.mstdatastock.tabsaction( e.i )  ;
        });

        this.obj.on("remove",function(){
            bos.mstdatastock.grid1_destroy() ;
            bos.mstdatastock.grid2_destroy() ;
        }) ;
    }


    bos.mstdatastock.setopt = function(nama,isi){
        this.obj.find('input:radio[name='+nama+'][value='+isi+']').prop('checked',true);
    }

    bos.mstdatastock.loadmodelpaket      = function(l){
        this.obj.find("#wrap-paket-d").modal(l) ;
    }
    
    bos.mstdatastock.alertbarcode = function(pesan){
        alert(pesan);
        with(bos.mstdatastock.obj){
            find("#barcode").val("") ;
            find("#barcode").focus();
        }
    }
    bos.mstdatastock.objs = bos.mstdatastock.obj.find("#cmdsave") ;
    bos.mstdatastock.initfunc	   = function(){

        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.grid2_load() ;
        this.init() ;
        this.obj.find("#cmdok").on("click", function(e){
            var harga       = string_2n(bos.mstdatastock.obj.find("#harga").val());
            var qty         = string_2n(bos.mstdatastock.obj.find("#qty").val());

            bos.mstdatastock.grid2_append(harga,qty);
        }) ;
        
        this.obj.find("#barcode").on("blur",function(e){
            var kode = bos.mstdatastock.obj.find("#kode").val();
            var barcode = bos.mstdatastock.obj.find("#barcode").val();
            if(barcode !== ""){
                bjs.ajax(bos.mstdatastock.url + '/cekdtockbybarcode',bjs.getdataform(this)+"&kode="+kode) ;
            }
        });

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                var datagrid2 =  w2ui['bos-form-mstdatastock_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.mstdatastock.url + '/saving',bjs.getdataform(this)+"&grid2="+datagrid2 , bos.mstdatastock.objs) ;
            }
        });
        
        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.mstdatastock.grid1_reloaddata();
        });


    }

    $('#satuan').select2({
        ajax: {
            url: bos.mstdatastock.base_url + '/seeksatuan',
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

    $('#group').select2({
        ajax: {
            url: bos.mstdatastock.base_url + '/seekgroup',
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
        bjs.initenter($("form")) ;
        bos.mstdatastock.initcomp() ;
        bos.mstdatastock.initcallback() ;
        bos.mstdatastock.initfunc() ;

    })

</script>
