<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tph">
                        <button class="btn btn-tab tpel active" href="#tph_1" data-toggle="tab" >Daftar Pelunasan Hutang</button>
                        <button class="btn btn-tab tpel" href="#tph_2" data-toggle="tab">Pelunasan Hutang</button>
                    </div>
                </div>
            </td>
            <td class="button"> 
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trpelunasanhutang.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tph_1" style="padding-top:5px;">
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
                            <td height="500px">
                                <div id="grid1" class="full-height"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="tph_2">
                    <table width="100%">
                        <tr>
                            <td width="100%" class="osxtable form">
                                <table>
                                    <tr>
                                        <td width="14%"><label for="faktur">Faktur</label> </td>
                                        <td width="1%">:</td>
                                        <td width="35%">
                                            <input type="text" readonly id="faktur" name="faktur" class="form-control" placeholder="Faktur" required>
                                        </td>
                                        <td width="14%"><label for="supplier">Supplier</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <select name="supplier" id="supplier" class="form-control select" style="width:100%"
                                                data-placeholder="Supplier" required></select>
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
                                        <td>

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
                            <td height = "50px" class="osxtable form">
                                <table>
                                    <tr>
                                        <td><label>Pembelian</label> </td>
                                        <td><label>Retur</label> </td>
                                        <td><label>Subtotal</label> </td>
                                        <td><label for="prsekot">Persekot</label> </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="20" readonly type="text" name="pembelian" id="pembelian" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" readonly type="text" name="retur" id="retur" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" readonly type="text" name="subtotal" id="subtotal" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" type="text" name="persekot" id="persekot" class="form-control number" value="0"></td>
                                        <td>
                                            <select name="kdtrpskt" id="kdtrpskt" class="form-control select" style="width:100%"
                                                data-placeholder="Kode Transaksi Persekot"></select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="tfkas">Transfer / Kas</label> </td>
                                        <td></td>
                                        <td><label>Diskon</label> </td>
                                        <td><label>Pembulatan</label> </td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td><input maxlength="20" type="text" name="tfkas" id="tfkas" class="form-control number" value="0"></td>
                                        <td>
                                            <select name="bankkas" id="bankkas" class="form-control select" style="width:100%"
                                                data-placeholder="Bank Kas"></select>
                                        </td>
                                        <td><input maxlength="20" readonly type="text" name="diskon" id="diskon" class="form-control number" value="0"></td>
                                        <td><input maxlength="20" readonly type="text" name="pembulatan" id="pembulatan" class="form-control number" value="0"></td>
                                        <td></td>
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

<script type="text/javascript">
    <?=cekbosjs();?>
    
    bos.trpelunasanhutang.dktrpersekot    = "" ;
    //grid daftar pembelian
    bos.trpelunasanhutang.grid1_data    = null ;
    bos.trpelunasanhutang.grid1_loaddata= function(){

        var tglawal = bos.trpelunasanhutang.obj.find("#tglawal").val();
        var tglakhir = bos.trpelunasanhutang.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trpelunasanhutang.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trpelunasanhutang.base_url + "/loadgrid",
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
                { field: 'supplier', caption: 'Supplier', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'subtotal', caption: 'Subtotal', size: '100px',render:'int', sortable: false, style:"text-align:right" },
                { field: 'diskon', caption: 'Diskon', size: '100px', sortable: false,render:'int', style:"text-align:right"},
                { field: 'pembulatan', caption: 'Pembulatan', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'persekot', caption: 'Persekot', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'kasbank', caption: 'Kas/Bank', size: '100px', sortable: false, render:'int',style:"text-align:right"},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trpelunasanhutang.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trpelunasanhutang.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trpelunasanhutang.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trpelunasanhutang.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trpelunasanhutang.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail pembelian
    bos.trpelunasanhutang.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false},
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:'text-align:center'},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false, style:'text-align:center'},
                { field: 'total', caption: 'Total', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'sisaawal', caption: 'Sisa Awal', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'pelunasan', caption: 'Pelunasan', size: '120px', sortable: false, style:'text-align:right',
                    render: function(record){
                       if(record.no !== ""){
                            return '<div style = "text-align:center">'+
                                ' <input type="text" style="width:110px;text-align:right;" value='+$.number(record.pelunasan,"2",".",",")+
                                '  onBlur="var obj = w2ui[\''+this.name+'\'];obj.set(\''+record.recid+'\',{pelunasan:$.number(this.value)});bos.trpelunasanhutang.hitungsisapelunasan(\''+record.recid+'\')">'+
                                '</div>';
                       }
                    }
                },
                { field: 'sisa', caption: 'Sisa', size: '100px', sortable: false, style:'text-align:right'},
                { field: 'jenis', caption: 'Jenis', size: '100px', sortable: false},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.trpelunasanhutang.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trpelunasanhutang.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    
    bos.trpelunasanhutang.hitungsubtotal 			= function(){

        var nRows = w2ui[this.id + '_grid2'].records.length;
        var pembelian = 0 ;
        var retur = 0 ;
        for(i=0;i< nRows;i++){
            var pelunasan = w2ui[this.id + '_grid2'].getCellValue(i,5);
            if(w2ui[this.id + '_grid2'].getCellValue(i,7) == "Pembelian") pembelian += string_2n(pelunasan);
            if(w2ui[this.id + '_grid2'].getCellValue(i,7) == "Retur Pembelian") retur += string_2n(pelunasan);
        }
        this.obj.find("#pembelian").val($.number(pembelian,2));
        this.obj.find("#retur").val($.number(retur,2));
        bos.trpelunasanhutang.hitungtotal();

    }

    bos.trpelunasanhutang.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trpelunasanhutang.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trpelunasanhutang.hitungsisapelunasan 		= function(recid){
        var obj = w2ui['bos-form-trpelunasanhutang_grid2'];
        var sisa = string_2n(obj.getCellValue(recid,4)) - string_2n(obj.getCellValue(recid,5));
        //alert(sisa);
        obj.set(recid,{sisa:$.number(sisa,2)});
        bos.trpelunasanhutang.hitungsubtotal();
    }


    bos.trpelunasanhutang.init 			= function(){

        this.obj.find("#subtotal").val("0") ;
        this.obj.find("#diskon").val("0") ;
        this.obj.find("#pembulatan").val("0") ;
        this.obj.find("#tfkas").val("0") ;
        this.obj.find("#retur").val("0") ;
        this.obj.find("#tgl").val("<?=date('d-m-Y')?>") ;
        this.obj.find("#pembelian").val("0") ;
        this.obj.find("#bankkas").sval("") ;
        this.obj.find("#supplier").sval("") ;
        this.obj.find("#kdtrpskt").sval("") ;
        this.obj.find("#retur").val("0") ;
        this.obj.find("#persekot").val("0") ;

        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();

    }

    bos.trpelunasanhutang.settab 		= function(n){
        this.obj.find("#tph button:eq("+n+")").tab("show") ;
    }

    bos.trpelunasanhutang.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trpelunasanhutang.grid1_render() ;
            bos.trpelunasanhutang.init() ;
        }else{
            bos.trpelunasanhutang.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }
    bos.trpelunasanhutang.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag

        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.grid2_load() ;

        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
    }

    bos.trpelunasanhutang.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trpelunasanhutang.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trpelunasanhutang.grid1_destroy() ;
            bos.trpelunasanhutang.grid2_destroy() ;
            bos.trpelunasanhutang.grid3_destroy() ;
            bos.trpelunasanhutang.grid4_destroy() ;
        }) ;
    }

    bos.trpelunasanhutang.hitungtotal 			= function(){
        var subtotal = string_2n(this.obj.find("#pembelian").val()) - string_2n(this.obj.find("#retur").val());
        this.obj.find("#subtotal").val($.number(subtotal,2));
        this.obj.find("#tfkas").val($.number(subtotal,2));
        bos.trpelunasanhutang.hitungselisih();
    }

    bos.trpelunasanhutang.hitungselisih 			= function(){
        var subtotal = string_2n(this.obj.find("#pembelian").val()) - string_2n(this.obj.find("#retur").val());
        var tfkas = string_2n(this.obj.find("#tfkas").val());
        var persekot = string_2n(this.obj.find("#persekot").val());
        var txttrpersekot = bos.trpelunasanhutang.obj.find("#kdtrpskt option:selected").text();
        var jenispskt = txttrpersekot.substr(1,1);

        var selisih = subtotal - tfkas;
        if(jenispskt == 'K'){
            selisih -= persekot;
        }else if(jenispskt == 'D'){
            selisih += persekot;
        }

        var diskon = 0 ;
        var pembulatan = 0 ;

        if(selisih > 0) diskon = selisih;
        if(selisih < 0) pembulatan = -1 * selisih;
        this.obj.find("#diskon").val($.number(diskon,2));
        this.obj.find("#pembulatan").val($.number(pembulatan,2));
        this.obj.find("#tfkas").val($.number(tfkas,2));
        this.obj.find("#persekot").val($.number(persekot,2));

    }


    bos.trpelunasanhutang.objs = bos.trpelunasanhutang.obj.find("#cmdsave") ;
    bos.trpelunasanhutang.initfunc	   = function(){

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trpelunasanhutang_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trpelunasanhutang.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trpelunasanhutang.cmdsave) ;
            }

        }) ;

        this.obj.find("#supplier").on("change", function(e){
            var tgl = bos.trpelunasanhutang.obj.find("#tgl").val();
            var faktur = bos.trpelunasanhutang.obj.find("#faktur").val();
            w2ui['bos-form-trpelunasanhutang_grid2'].clear();
            //bos.trpelunasanhutang.grid2_reload() ;
            e.preventDefault() ;
            bjs.ajax( bos.trpelunasanhutang.base_url + '/loadgrid2', bjs.getdataform(this)+"&tgl="+tgl+"&faktur="+faktur) ;
        });
        
        this.obj.find("#kdtrpskt").on("change", function(e){
            bos.trpelunasanhutang.hitungselisih();
        });
        
        this.obj.find("#persekot").on("blur", function(e){
            bos.trpelunasanhutang.hitungselisih();
        });

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trpelunasanhutang.grid1_reloaddata();
        });

        this.obj.find("#tfkas").on("blur", function(e){
            bos.trpelunasanhutang.hitungselisih();
        });
    }

    $('#supplier').select2({
        ajax: {
            url: bos.trpelunasanhutang.base_url + '/seeksupplier',
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

    $('#bankkas').select2({
        ajax: {
            url: bos.trpelunasanhutang.base_url + '/seekbankkas',
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

    $('#kdtrpskt').select2({
        ajax: {
            url: bos.trpelunasanhutang.base_url + '/seekkodetransaksi',
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
        bos.trpelunasanhutang.initcomp() ;
        bos.trpelunasanhutang.initcallback() ;
        bos.trpelunasanhutang.initfunc() ;
    });
</script>