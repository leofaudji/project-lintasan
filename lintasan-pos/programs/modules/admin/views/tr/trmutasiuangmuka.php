<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tmum">
                        <button class="btn btn-tab tpel active" href="#tmum_1" data-toggle="tab" >Daftar Mutasi Uang Muka</button>
                        <button class="btn btn-tab tpel" href="#tmum_2" data-toggle="tab">Mutasi Uang Muka</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trmutasiuangmuka.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tmum_1" style="padding-top:5px;">
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
                <div role="tabpanel" class="tab-pane fade full-height" id="tmum_2">
                    <table width="100%">
                        <tr>
                            <td width="100%" class="osxtable form">
                                <table>
                                    <tr>
                                        <td width="14%"><label for="faktur">Faktur</label> </td>
                                        <td width="1%">:</td>
                                        <td width="35%">
                                            <input readonly type="text" id="faktur" name="faktur" class="form-control" placeholder="Faktur" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="tgl">Tanggal</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>
                                        <td width="14%"><label for=""></label> </td>
                                        <td width="1%"></td>
                                        <td >

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="kodetransaksi">Kode Transaksi</label> </td>
                                        <td width="1%">:</td>
                                        <td> 
                                            <select name="kodetransaksi" id="kodetransaksi" class="form-control select" style="width:100%"
                                                    data-placeholder="Kode Transaksi" required></select>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="customer">customer</label> </td>
                                        <td width="1%">:</td>
                                        <td> 
                                            <select name="customer" id="customer" class="form-control select" style="width:100%"
                                                    data-placeholder="customer" required></select>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="jumlah">Jumlah</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input type="text" name="jumlah" id="jumlah" 
                                                   class="form-control number" value="0" required readonly> 
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
                                        <td><label for="rekening">Rekening</label> </td>
                                        <td><label for="nominal">Nominal</label> </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="5" type="text" name="nomor" id="nomor" class="form-control number" value="0"></td>
                                        <td>
                                            <select name="rekening" id="rekening" class="form-control select rekselect" style="width:100%"
                                                    data-placeholder="Rekening"></select>  
                                        </td>
                                        <td><input maxlength="20" type="text" name="nominal" id="nominal" class="form-control number" value="0"></td>
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
<script type="text/javascript">
    <?=cekbosjs();?>
    //grid daftar po
    bos.trmutasiuangmuka.grid1_data    = null ;
    bos.trmutasiuangmuka.grid1_loaddata= function(){

        var tglawal = bos.trmutasiuangmuka.obj.find("#tglawal").val();
        var tglakhir = bos.trmutasiuangmuka.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trmutasiuangmuka.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trmutasiuangmuka.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'kodetransaksi', caption: 'Kode Transaksi', size: '150px', sortable: false , style:"text-align:left"},
                { field: 'customer', caption: 'customer', size: '150px', sortable: false , style:"text-align:left"},
                { field: 'jumlah', caption: 'Jumlah', size: '100px', sortable: false , render:'float:2'},
                { field: 'cmdcetak', caption: ' ', size: '80px', sortable: false },
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trmutasiuangmuka.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trmutasiuangmuka.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trmutasiuangmuka.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trmutasiuangmuka.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trmutasiuangmuka.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail
    bos.trmutasiuangmuka.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false},
                { field: 'kode', caption: 'Kode', size: '120px', sortable: false },
                { field: 'ketrekening', caption: 'Ket. Rekening', size: '120px', sortable: false },
                { field: 'nominal', caption: 'Nominal', size: '100px', sortable: false, render:'int'},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.trmutasiuangmuka.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trmutasiuangmuka.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trmutasiuangmuka.grid2_append    = function(no,kode,ketrekening,nominal){
        var datagrid  = w2ui[this.id + '_grid2'].records;
        var lnew      = true;
        var nQty      = 1;
        var recid     = "";
        if(no <= datagrid.length){
            recid = no;
            w2ui[this.id + '_grid2'].set(recid,{kode: kode,ketrekening:ketrekening, nominal: nominal});
        }else{
            recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trmutasiuangmuka.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,
                 no: no,
                 kode: kode,
                 ketrekening: ketrekening,
                 nominal:nominal,
                 cmddelete:Hapus}
            ]) ;
        }
        bos.trmutasiuangmuka.initdetail();
        bos.trmutasiuangmuka.hitungjumlah();
    }

    bos.trmutasiuangmuka.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trmutasiuangmuka.grid2_urutkan();
        }
    }

    bos.trmutasiuangmuka.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        w2ui[this.id + '_grid2'].clear();
        for(i=0;i<datagrid.length;i++){
            var no = i+1;
            datagrid[i]["recid"] = no;
            var recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trmutasiuangmuka.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add({recid:recid,no: no, kode: datagrid[i]["kode"], ketrekening: datagrid[i]["ketrekening"],
                                          nominal:datagrid[i]["nominal"],cmddelete:Hapus});
        }
    }

    bos.trmutasiuangmuka.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trmutasiuangmuka.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trmutasiuangmuka.cmdcetak	= function(faktur){
        bjs_os.form_report( this.base_url + '/showreport?faktur=' + faktur) ;
    }

    bos.trmutasiuangmuka.printbukti = function (contenthtml) {
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write(contenthtml);

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        mywindow.close();
    }

    bos.trmutasiuangmuka.hitungjumlah 			= function(){

        var nRows = w2ui[this.id + '_grid2'].records.length;
        var subtotal = 0 ;
        for(i=0;i< nRows;i++){
            var jumlah = w2ui[this.id + '_grid2'].getCellValue(i,3);
            subtotal += Number(jumlah);
        }
        this.obj.find("#jumlah").val($.number(subtotal,2));
    }


    bos.trmutasiuangmuka.setopt = function(nama,isi){
        this.obj.find('input:radio[name='+nama+'][value='+isi+']').prop('checked',true);
    }

    bos.trmutasiuangmuka.init 			= function(){

        this.obj.find("#kodetransaksi").sval("") ;
        this.obj.find("#customer").sval("") ;
        this.obj.find("#jumlah").val("0.00") ;
        bos.trmutasiuangmuka.setopt("jenis","KM");


        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();

        bos.trmutasiuangmuka.initdetail();
    }

    bos.trmutasiuangmuka.settab 		= function(n){
        this.obj.find("#tmum button:eq("+n+")").tab("show") ;
    }

    bos.trmutasiuangmuka.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trmutasiuangmuka.grid1_render() ;
            bos.trmutasiuangmuka.init() ;
        }else{
            bos.trmutasiuangmuka.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }
    bos.trmutasiuangmuka.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#rekening").sval("") ;
        this.obj.find("#nominal").val("0") ;



    }

    bos.trmutasiuangmuka.initcomp		= function(){
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

    bos.trmutasiuangmuka.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trmutasiuangmuka.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trmutasiuangmuka.grid1_destroy() ;
            bos.trmutasiuangmuka.grid2_destroy() ;
        }) ;
    }

    bos.trmutasiuangmuka.objs = bos.trmutasiuangmuka.obj.find("#cmdsave") ;
    bos.trmutasiuangmuka.initfunc	   = function(){
        this.obj.find("#cmdok").on("click", function(e){

            var no          = bos.trmutasiuangmuka.obj.find("#nomor").val();
            var kode       = bos.trmutasiuangmuka.obj.find("#rekening").val();
            var ketrekening       = bos.trmutasiuangmuka.obj.find("#rekening").text();
            var nominal         = string_2n(bos.trmutasiuangmuka.obj.find("#nominal").val());
            bos.trmutasiuangmuka.grid2_append(no,kode,ketrekening,nominal);
        }) ;


        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trmutasiuangmuka.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trmutasiuangmuka_grid2'].records;
            if(no <= datagrid.length){
                bos.trmutasiuangmuka.obj.find("#rekening").sval([{id:w2ui['bos-form-trmutasiuangmuka_grid2'].getCellValue(no-1,1),text:w2ui['bos-form-trmutasiuangmuka_grid2'].getCellValue(no-1,2)}]);
                bos.trmutasiuangmuka.obj.find("#nominal").val(w2ui['bos-form-trmutasiuangmuka_grid2'].getCellValue(no-1,3));
            }else{
                bos.trmutasiuangmuka.obj.find("#nomor").val(datagrid.length + 1)
            }

        });

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trmutasiuangmuka_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trmutasiuangmuka.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trmutasiuangmuka.cmdsave) ;
            }

        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trmutasiuangmuka.grid1_reloaddata();
        });
    }

    $('.rekselect').select2({
        ajax: {
            url: bos.trmutasiuangmuka.base_url + '/seekrekening',
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

    $('#customer').select2({
        ajax: {
            url: bos.trmutasiuangmuka.base_url + '/seekcustomer',
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
    
    $('#kodetransaksi').select2({
        ajax: {
            url: bos.trmutasiuangmuka.base_url + '/seekkodetransaksi',
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
        bos.trmutasiuangmuka.initcomp() ;
        bos.trmutasiuangmuka.initcallback() ;
        bos.trmutasiuangmuka.initfunc() ;
        bos.trmutasiuangmuka.initdetail();
    });
</script>