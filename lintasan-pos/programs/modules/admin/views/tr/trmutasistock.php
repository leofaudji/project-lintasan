<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tmutasistock">
                        <button class="btn btn-tab tpel active" href="#tmutasistock_1" data-toggle="tab" >Daftar Mutasi Stock</button>
                        <button class="btn btn-tab tpel" href="#tmutasistock_2" data-toggle="tab">Mutasi Stock</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trmutasistock.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tmutasistock_1" style="padding-top:5px;">
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
                            <td height="300px">
                                <div id="grid1" class="full-height"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="tmutasistock_2">
                    <table width="100%">
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td width="14%"><label for="faktur">Faktur</label> </td>
                                        <td width="1%">:</td>
                                        <td width="35%">
                                            <input width= '20' type="text" id="faktur" name="faktur" class="form-control" placeholder="Faktur" required>
                                        </td>
                                        <td width="14%"><label for="tgl">Tanggal</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>
                                    </tr>
                                </table>
                                <hr/>
                            </td>
                        </tr>
                        <tr>
                            <td height = "20px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td><label for="gudangfrom">Gudang From</label></td>
                                                    <td>:</td>
                                                    <td>
                                                        <select name="gudangfrom" id="gudangfrom" class="form-control select" style="width:100%"
                                                                data-placeholder="Gudang" required></select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="stockfrom">Stock From</label> </td>
                                                    <td>:</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" id="stockfrom" name="stockfrom" class="form-control" placeholder="Stock From" required>
                                                            <span class="input-group-btn">
                                                                <button class="form-control btn btn-info" type="button" id="cmdstockfrom"><i class="fa fa-search"></i></button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Nama Stock</label> </td>
                                                    <td>:</td>
                                                    <td><input type="text" id="namastockfrom" readonly name="namastockfrom" class="form-control" placeholder="Nama Stock"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Satuan</label> </td>
                                                    <td>:</td>
                                                    <td><input type="text" id="satuanfrom" readonly name="satuanfrom" class="form-control" placeholder="Satuan"></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="barcode">Barcode</label> </td>
                                                    <td>:</td>
                                                    <td><input readonly type="text" id="barcodefrom" name="barcodefrom" class="form-control" placeholder="Barcode"></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="mutasifrom">Mutasi From</label> </td>
                                                    <td>:</td>
                                                    <td><input maxlength="20" type="text" name="mutasifrom" id="mutasifrom" class="form-control number" value="0" required></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <i class="fa fa-arrow-right  fa-5x"></i>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td><label for="gudangto">Gudang To</label></td>
                                                    <td>:</td>
                                                    <td>
                                                        <select name="gudangto" id="gudangto" class="form-control select" style="width:100%"
                                                                data-placeholder="Gudang" required></select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="stockto">Stock To</label> </td>
                                                    <td>:</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" id="stockto" name="stockto" class="form-control" placeholder="Stock To" required>
                                                            <span class="input-group-btn">
                                                                <button class="form-control btn btn-info" type="button" id="cmdstockto"><i class="fa fa-search"></i></button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Nama Stock</label> </td>
                                                    <td>:</td>
                                                    <td><input type="text" id="namastockto" readonly name="namastockto" class="form-control" placeholder="Nama Stock"></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Satuan</label> </td>
                                                    <td>:</td>
                                                    <td><input type="text" id="satuanto" readonly name="satuanto" class="form-control" placeholder="Satuan"></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="barcodeto">Barcode</label> </td>
                                                    <td>:</td>
                                                    <td><input readonly type="text" id="barcodeto" name="barcodeto" class="form-control" placeholder="Barcode"></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="mutasito">Mutasi To</label> </td>
                                                    <td>:</td>
                                                    <td><input maxlength="20" type="text" name="mutasito" id="mutasito" class="form-control number" value="0" required></td>
                                                </tr>
                                            </table>
                                        </td>
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
<div class="modal fade" id="wrap-pencarianstockto-d" role="dialog" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wm-title">Daftar Stock</h4>
            </div>
            <div class="modal-body">
                <div id="grid4" style="height:250px"></div>
            </div>
            <div class="modal-footer">
                *Pilih Stock
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?=cekbosjs();?>
    //grid daftar pembelian
    bos.trmutasistock.grid1_data    = null ;
    bos.trmutasistock.grid1_loaddata= function(){

        var tglawal = bos.trmutasistock.obj.find("#tglawal").val();
        var tglakhir = bos.trmutasistock.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trmutasistock.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trmutasistock.base_url + "/loadgrid",
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
                { field: 'gudangfrom', caption: 'Gudang From', size: '100px', sortable: false, style:"text-align:center"},
                { field: 'stockfrom', caption: 'Stock From', size: '100px', sortable: false, style:"text-align:center"},
                { field: 'qtyfrom', caption: 'Qty From', size: '100px',render:'int', sortable: false, style:"text-align:right" },
                { field: 'hpfrom', caption: 'HP From', size: '100px',render:'int', sortable: false, style:"text-align:right" },
                { field: 'gudangto', caption: 'Gudang To', size: '100px', sortable: false, style:"text-align:center"},
                { field: 'stockto', caption: 'Stock To', size: '100px', sortable: false, style:"text-align:center"},
                { field: 'qtyto', caption: 'Qty To', size: '100px',render:'int', sortable: false, style:"text-align:right" },
                { field: 'hpto', caption: 'HP To', size: '100px',render:'int', sortable: false, style:"text-align:right" },
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trmutasistock.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trmutasistock.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trmutasistock.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trmutasistock.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trmutasistock.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }


    //grid3 daftarstock
    bos.trmutasistock.grid3_data    = null ;
    bos.trmutasistock.grid3_loaddata= function(){
        this.grid3_data 		= {} ;
    }

    bos.trmutasistock.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name	: this.id + '_grid3',
            limit 	: 100 ,
            url 	: bos.trmutasistock.base_url + "/loadgrid3",
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

    bos.trmutasistock.grid3_setdata	= function(){
        w2ui[this.id + '_grid3'].postData 	= this.grid3_data ;
    }
    bos.trmutasistock.grid3_reload		= function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.trmutasistock.grid3_destroy 	= function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.trmutasistock.grid3_render 	= function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.trmutasistock.grid3_reloaddata	= function(){
        this.grid3_loaddata() ;
        this.grid3_setdata() ;
        this.grid3_reload() ;
    }

    //grid4 daftarstock
    bos.trmutasistock.grid4_data    = null ;
    bos.trmutasistock.grid4_loaddata= function(){
        this.grid4_data 		= {} ;
    }

    bos.trmutasistock.grid4_load    = function(){
        this.obj.find("#grid4").w2grid({
            name	: this.id + '_grid4',
            limit 	: 100 ,
            url 	: bos.trmutasistock.base_url + "/loadgrid4",
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

    bos.trmutasistock.grid4_setdata	= function(){
        w2ui[this.id + '_grid4'].postData 	= this.grid4_data ;
    }
    bos.trmutasistock.grid4_reload		= function(){
        w2ui[this.id + '_grid4'].reload() ;
    }
    bos.trmutasistock.grid4_destroy 	= function(){
        if(w2ui[this.id + '_grid4'] !== undefined){
            w2ui[this.id + '_grid4'].destroy() ;
        }
    }

    bos.trmutasistock.grid4_render 	= function(){
        this.obj.find("#grid4").w2render(this.id + '_grid4') ;
    }

    bos.trmutasistock.grid4_reloaddata	= function(){
        this.grid4_loaddata() ;
        this.grid4_setdata() ;
        this.grid4_reload() ;
    }



    bos.trmutasistock.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock',  bjs.getdataform(bos.trmutasistock.obj.find("form"))+'&kode=' + kode);
    }
    
    bos.trmutasistock.cmdpilihto 		= function(kode){
        bjs.ajax(this.url + '/pilihstockto', bjs.getdataform(bos.trmutasistock.obj.find("form"))+'&kode=' + kode);
    }

    bos.trmutasistock.init 			= function(){
        this.obj.find("#faktur").focus();
        this.obj.find("#faktur").val("") ;
        this.obj.find("#gudangfrom").sval("") ;
        this.obj.find("#stockfrom").val("") ;
        this.obj.find("#namastockfrom").val("") ;
        this.obj.find("#satuanfrom").val("") ;
        this.obj.find("#barcodefrom").val("") ;
        this.obj.find("#mutasifrom").val("0") ;
        this.obj.find("#gudangto").sval("") ;
        this.obj.find("#stockto").val("") ;
        this.obj.find("#namastockto").val("") ;
        this.obj.find("#satuanto").val("") ;
        this.obj.find("#barcodeto").val("") ;
        this.obj.find("#mutasito").val("0") ;


        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
    }


    bos.trmutasistock.initcomp		= function(){
        this.grid3_load() ;
        this.grid4_load() ;

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag


        this.grid1_loaddata() ;
        this.grid1_load() ;


        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
    }

    bos.trmutasistock.settab 		= function(n){
        this.obj.find("#tmutasistock button:eq("+n+")").tab("show") ;
    }

    bos.trmutasistock.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trmutasistock.grid1_render() ;
            bos.trmutasistock.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }

    bos.trmutasistock.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trmutasistock.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trmutasistock.grid1_destroy() ;
            bos.trmutasistock.grid3_destroy() ;
            bos.trmutasistock.grid4_destroy() ;
        }) ;
    }


    bos.trmutasistock.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }
    
    bos.trmutasistock.loadmodelstockto      = function(l){
        this.obj.find("#wrap-pencarianstockto-d").modal(l) ;
    }
    
    bos.trmutasistock.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }
    
    bos.trmutasistock.cmddelete 		= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trmutasistock.objs = bos.trmutasistock.obj.find("#cmdsave") ;
    bos.trmutasistock.initfunc	   = function(){



        this.obj.find("#cmdstockfrom").on("click", function(e){
            bos.trmutasistock.loadmodelstock("show");
            bos.trmutasistock.grid3_reloaddata() ;
        }) ;

        this.obj.find("#cmdstockto").on("click", function(e){
            bos.trmutasistock.loadmodelstockto("show");
            bos.trmutasistock.grid4_reloaddata() ;
        }) ;

        this.obj.find("#stockfrom").on("blur", function(e){
            if(bos.trmutasistock.obj.find("#stockfrom").val() !== ""){
                var stock = bos.trmutasistock.obj.find("#stockfrom").val();

                bjs.ajax( bos.trmutasistock.base_url + '/seekstock', bjs.getdataform(this)) ;
            }
        });
        
        this.obj.find("#stockto").on("blur", function(e){
            if(bos.trmutasistock.obj.find("#stockto").val() !== ""){
                var stock = bos.trmutasistock.obj.find("#stockto").val();

                bjs.ajax( bos.trmutasistock.base_url + '/seekstockto', bjs.getdataform(this)) ;
            }
        });

        this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(bos.trmutasistock.obj.find("form")) ){
                bjs.ajax( bos.trmutasistock.base_url + '/saving', bjs.getdataform(bos.trmutasistock.obj.find("form")),bos.trmutasistock.objs) ;
            }
        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trmutasistock.grid1_reloaddata();
        });

    }


    $(function(){
        $('#gudangfrom').select2({

            ajax: {
                url: bos.trmutasistock.base_url + '/seekgudang',
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

        $('#gudangto').select2({

            ajax: {
                url: bos.trmutasistock.base_url + '/seekgudang',
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

        bjs.initenter($("form")) ;
        bos.trmutasistock.initcomp() ;
        bos.trmutasistock.initcallback() ;
        bos.trmutasistock.initfunc() ;
        JsBarcode(".barcode").init();
    });

</script>