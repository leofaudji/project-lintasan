<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tsoposting">
                        <button class="btn btn-tab tpel active" href="#tsoposting_1" data-toggle="tab" >Daftar Posting Opname Stock</button>
                        <button class="btn btn-tab tpel" href="#tsoposting_2" data-toggle="tab">Opname Stock</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trsoposting.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tsoposting_1" style="padding-top:5px;">
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
                <div role="tabpanel" class="tab-pane fade full-height" id="tsoposting_2">
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
                            <td height = "330px" >
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
    bos.trsoposting.grid1_data    = null ;
    bos.trsoposting.grid1_loaddata= function(){

        var tglawal = bos.trsoposting.obj.find("#tglawal").val();
        var tglakhir = bos.trsoposting.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trsoposting.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trsoposting.base_url + "/loadgrid",
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
                { field: 'gudang', caption: 'Gudang', size: '150px', sortable: false , style:"text-align:left"},
                { field: 'cmdcetak', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trsoposting.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trsoposting.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trsoposting.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trsoposting.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trsoposting.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail
    bos.trsoposting.grid2_data    = null ;
    bos.trsoposting.grid2_loaddata= function(){
        var faktur = bos.trsoposting.obj.find("#faktur").val();
        var tgl = bos.trsoposting.obj.find("#tgl").val();
        var gudang = bos.trsoposting.obj.find("#gudang").val();
        this.grid2_data 		= {'faktur':faktur,'tgl':tgl,'gudang':gudang} ;
    }
    bos.trsoposting.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            limit 	: 100 ,
            url 	: bos.trsoposting.base_url + "/loadgrid2",
            postData: this.grid2_data ,
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false},
                { field: 'kode', caption: 'Kode', size: '80px', sortable: false },
                { field: 'keterangan', caption: 'Keterangan', size: '150px', sortable: false },
                { field: 'saldosistem', caption: 'Saldo Sistem', size: '100px', sortable: false,render:'float:2'},
                { field: 'saldoreal', caption: 'Saldo Real', size: '100px', sortable: false, render:'float:2'},
                { field: 'selisih', caption: 'Selisih', size: '100px', sortable: false, render:'float:2'},
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false },
            ]
        });


    }

    bos.trsoposting.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trsoposting.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    
    bos.trsoposting.grid2_setdata	= function(){
        w2ui[this.id + '_grid2'].postData 	= this.grid2_data ;
    }
    
    bos.trsoposting.grid2_reloaddata	= function(){
        this.grid2_loaddata() ;
        this.grid2_setdata() ;
        this.grid2_reload() ;
    }


    bos.trsoposting.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trsoposting.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trsoposting.cmdcetak	= function(faktur){
        bjs_os.form_report( this.base_url + '/showreport?faktur=' + faktur) ;
    }


    bos.trsoposting.init 			= function(){

        this.obj.find("#rekkas").sval("") ;
        this.obj.find("#nominal").val("0.00") ;


        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();


    }

    bos.trsoposting.settab 		= function(n){
        this.obj.find("#tsoposting button:eq("+n+")").tab("show") ;
    }

    bos.trsoposting.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trsoposting.grid1_render() ;
            bos.trsoposting.init() ;
        }else{
            bos.trsoposting.grid2_reloaddata() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }

    bos.trsoposting.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag

        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_loaddata() ;
        this.grid2_load() ;
        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
    }

    bos.trsoposting.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trsoposting.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trsoposting.grid1_destroy() ;
            bos.trsoposting.grid2_destroy() ;
        }) ;
    }

    bos.trsoposting.objs = bos.trsoposting.obj.find("#cmdsave") ;
    bos.trsoposting.initfunc	   = function(){

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trsoposting_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trsoposting.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trsoposting.cmdsave) ;
            }

        }) ;
        
        this.obj.find("#gudang").on("change", function(e){
            bos.trsoposting.grid2_reloaddata();
        });
        
        this.obj.find("#tgl").on("change", function(e){
            bos.trsoposting.grid2_reloaddata();
        });

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trsoposting.grid1_reloaddata();
        });
    }

    $('#gudang').select2({
        ajax: {
            url: bos.trsoposting.base_url + '/seekgudang',
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
        bos.trsoposting.initcomp() ;
        bos.trsoposting.initcallback() ;
        bos.trsoposting.initfunc() ;
    });
</script>