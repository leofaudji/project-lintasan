<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tmubg">
                        <button class="btn btn-tab tpel active" href="#tmubg_1" data-toggle="tab" >Daftar Mutasi BG</button>
                        <button class="btn btn-tab tpel" href="#tmubg_2" data-toggle="tab">Mutasi BG</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trmutasibg.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tmubg_1" style="padding-top:5px;">
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
                <div role="tabpanel" class="tab-pane fade full-height" id="tmubg_2">
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
                                        <td width="14%"><label for="jenis">Transaksi</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <div class="radio-inline">
                                                <label>
                                                    <input type="radio" name="jenis" class="jenis" value="GM" checked>
                                                    BG Masuk
                                                </label>
                                                &nbsp;&nbsp;
                                            </div>
                                            <div class="radio-inline">
                                                <label>
                                                    <input type="radio" name="jenis" class="jenis" value="GK">
                                                    BG Keluar
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="rekbg">Rek. Hut/Piut BG</label> </td>
                                        <td width="1%">:</td>
                                        <td> 
                                            <select name="rekbg" id="rekbg" class="form-control select rekselect" style="width:100%"
                                                    data-placeholder="Rekening BG" required></select>  
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
                                        <td width="14%"><label for="diberiterima">Dibayarkan / Diterima</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input type="text" id="diberiterima" name="diberiterima" class="form-control" placeholder="Dibayarkan / Diterima" required>
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
                                        <td><label for="bank">Bank</label> </td>
                                        <td><label for="bgcek">BG/Cek</label> </td>
                                        <td><label for="norekening">No Rekening</label> </td>
                                        <td><label for="nobgcek">No BG/Cek</label> </td>
                                        <td><label for="jthtmp">Jth Tempo</label> </td>
                                        <td><label for="nominal">Nominal</label> </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input maxlength="5" type="text" name="nomor" id="nomor" class="form-control number" value="0"></td>
                                        <td>
                                            <select name="bank" id="bank" class="form-control select" style="width:100%"
                                                    data-placeholder="Bank"></select>  
                                        </td>
                                        <td><input type="text" id="bgcek" name="bgcek" class="form-control" placeholder="BG/Cek"></td>
                                        <td><input type="text" id="norekening" name="norekening" class="form-control" placeholder="No Rekening"></td>
                                        <td><input type="text" id="nobgcek" name="nobgcek" class="form-control" placeholder="No BG / Cek"></td>
                                        <td >
                                            <input style="width:80px" type="text" class="form-control date" id="jthtmp" name="jthtmp" required value=<?=date("d-m-Y")?> <?=date_set()?>>
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
    bos.trmutasibg.grid1_data    = null ;
    bos.trmutasibg.grid1_loaddata= function(){

        var tglawal = bos.trmutasibg.obj.find("#tglawal").val();
        var tglakhir = bos.trmutasibg.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trmutasibg.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trmutasibg.base_url + "/loadgrid",
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
                { field: 'rekbg', caption: 'Rekening BG', size: '150px', sortable: false , style:"text-align:left"},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false , style:"text-align:left"},
                { field: 'diberiterima', caption: 'Diberi / Diterima', size: '100px', sortable: false , style:"text-align:left"},
                { field: 'kredit', caption: 'BG Masuk', size: '100px', sortable: false , render:'int'},
                { field: 'debet', caption: 'BG Keluar', size: '100px', sortable: false , render:'int'},
                { field: 'cmdcetak', caption: ' ', size: '80px', sortable: false },
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trmutasibg.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trmutasibg.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trmutasibg.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trmutasibg.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trmutasibg.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail
    bos.trmutasibg.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false},
                { field: 'bank', caption: 'Bank', size: '120px', sortable: false },
                { field: 'ketbank', caption: 'Ket. Bank', size: '120px', sortable: false },
                { field: 'bgcek', caption: 'BG/Cek', size: '100px', sortable: false },
                { field: 'norekening', caption: 'No Rekening', size: '100px', sortable: false },
                { field: 'nobgcek', caption: 'No BG/Cek', size: '100px', sortable: false },
                { field: 'jthtmp', caption: 'Jth Tmp', size: '100px', sortable: false },
                { field: 'nominal', caption: 'Nominal', size: '100px', sortable: false, render:'int'},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });


    }

    bos.trmutasibg.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trmutasibg.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trmutasibg.grid2_append    = function(no,bank,ketbank,bgcek,norekening,nobgcek,jthtmp,nominal){
        var datagrid  = w2ui[this.id + '_grid2'].records;
        var lnew      = true;
        var nQty      = 1;
        var recid     = "";
        if(no <= datagrid.length){
            recid = no;
            w2ui[this.id + '_grid2'].set(recid,{bank: bank,ketbank:ketbank,bgcek: bgcek,norekening:norekening,nobgcek:nobgcek,jthtmp:jthtmp,nominal: nominal});
        }else{
            recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trmutasibg.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,
                 no: no,
                 bank: bank,
                 ketbank:ketbank,
                 bgcek: bgcek,
                 norekening:norekening,
                 nobgcek:nobgcek,
                 jthtmp:jthtmp,
                 nominal: nominal,
                 cmddelete:Hapus}
            ]) ;
        }
        bos.trmutasibg.initdetail();
        bos.trmutasibg.hitungjumlah();
    }

    bos.trmutasibg.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail DO???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trmutasibg.grid2_urutkan();
        }
    }

    bos.trmutasibg.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        w2ui[this.id + '_grid2'].clear();
        for(i=0;i<datagrid.length;i++){
            var no = i+1;
            datagrid[i]["recid"] = no;
            var recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trmutasibg.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add({recid:recid,no: no, bank: datagrid[i]["bank"], ketbank: datagrid[i]["ketbank"],
                                          bgcek: datagrid[i]["bgcek"], norekening:datagrid[i]["norekening"],
                                          nobgcek:datagrid[i]["nobgcek"],jthtmp:datagrid[i]["jthtmp"],nominal:datagrid[i]["nominal"],
                                          cmddelete:Hapus});
        }
    }

    bos.trmutasibg.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trmutasibg.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trmutasibg.cmdcetak	= function(faktur,jenis,rekening){
        if(jenis == "GM"){
            bjs.ajax(this.url + '/printbuktigm', 'faktur='+faktur+'&rekening='+rekening);
        }else if(jenis == "GK"){
            bjs.ajax(this.url + '/printbuktigk', 'faktur='+faktur+'&rekening='+rekening);
        }
    }
    
    bos.trmutasibg.printbukti = function (contenthtml) {
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write(contenthtml);

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        mywindow.close();
    }

    bos.trmutasibg.hitungjumlah 			= function(){

        var nRows = w2ui[this.id + '_grid2'].records.length;
        var subtotal = 0 ;
        for(i=0;i< nRows;i++){
            var jumlah = w2ui[this.id + '_grid2'].getCellValue(i,7);
            subtotal += Number(jumlah);
        }
        this.obj.find("#jumlah").val($.number(subtotal,2));
    }


    bos.trmutasibg.setopt = function(nama,isi){
        this.obj.find('input:radio[name='+nama+'][value='+isi+']').prop('checked',true);
    }

    bos.trmutasibg.init 			= function(){

        this.obj.find("#rekbg").sval("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#diberiterima").val("") ;
        this.obj.find("#jumlah").val("0.00") ;
        bos.trmutasibg.setopt("jenis","GM");


        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();

        bos.trmutasibg.initdetail();
    }

    bos.trmutasibg.settab 		= function(n){
        this.obj.find("#tmubg button:eq("+n+")").tab("show") ;
    }

    bos.trmutasibg.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trmutasibg.grid1_render() ;
            bos.trmutasibg.init() ;
        }else{
            bos.trmutasibg.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }
    bos.trmutasibg.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#bank").sval("") ;
        this.obj.find("#bgcek").val("") ;
        this.obj.find("#norekening").val("") ;
        this.obj.find("#nobgcek").val("") ;
        this.obj.find("#jthtmp").val("<?php echo date('d-m-Y')?>") ;
        this.obj.find("#nominal").val("0") ;



    }

    bos.trmutasibg.initcomp		= function(){
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

    bos.trmutasibg.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trmutasibg.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trmutasibg.grid1_destroy() ;
            bos.trmutasibg.grid2_destroy() ;
        }) ;
    }

    bos.trmutasibg.objs = bos.trmutasibg.obj.find("#cmdsave") ;
    bos.trmutasibg.initfunc	   = function(){
        this.obj.find("#cmdok").on("click", function(e){

            var no          = bos.trmutasibg.obj.find("#nomor").val();
            var bank        = bos.trmutasibg.obj.find("#bank").val();
            var ketbank     = bos.trmutasibg.obj.find("#bank").text();
            var bgcek       = bos.trmutasibg.obj.find("#bgcek").val();
            var norekening  = bos.trmutasibg.obj.find("#norekening").val();
            var nobgcek     = bos.trmutasibg.obj.find("#nobgcek").val();
            var jthtmp      = bos.trmutasibg.obj.find("#jthtmp").val();
            var nominal     = bos.trmutasibg.obj.find("#nominal").val();
            bos.trmutasibg.grid2_append(no,bank,ketbank,bgcek,norekening,nobgcek,jthtmp,nominal);
        }) ;


        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trmutasibg.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trmutasibg_grid2'].records;
            if(no <= datagrid.length){
                bos.trmutasibg.obj.find("#bank").sval([{id:w2ui['bos-form-trmutasibg_grid2'].getCellValue(no-1,1),text:w2ui['bos-form-trmutasibg_grid2'].getCellValue(no-1,2)}]);
                bos.trmutasibg.obj.find("#bgcek").val(w2ui['bos-form-trmutasibg_grid2'].getCellValue(no-1,3));
                bos.trmutasibg.obj.find("#norekening").val(w2ui['bos-form-trmutasibg_grid2'].getCellValue(no-1,4));
                bos.trmutasibg.obj.find("#nobgcek").val(w2ui['bos-form-trmutasibg_grid2'].getCellValue(no-1,5));
                bos.trmutasibg.obj.find("#jthtmp").val(w2ui['bos-form-trmutasibg_grid2'].getCellValue(no-1,6));
                bos.trmutasibg.obj.find("#nominal").val(w2ui['bos-form-trmutasibg_grid2'].getCellValue(no-1,7));
            }else{
                bos.trmutasibg.obj.find("#nomor").val(datagrid.length + 1)
            }

        });

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trmutasibg_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trmutasibg.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trmutasibg.cmdsave) ;
            }

        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trmutasibg.grid1_reloaddata();
        });
    }

    $('.rekselect').select2({
        ajax: {
            url: bos.trmutasibg.base_url + '/seekrekening',
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
    
    $('#bank').select2({
        ajax: {
            url: bos.trmutasibg.base_url + '/seekbank',
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
        bos.trmutasibg.initcomp() ;
        bos.trmutasibg.initcallback() ;
        bos.trmutasibg.initfunc() ;
        bos.trmutasibg.initdetail();
    });
</script>