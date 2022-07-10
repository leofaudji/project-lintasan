<style media="screen">
    #bos-form-trkas-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-trkas-wrapper .info{border-radius: 4px; margin-right: 20px}
</style>
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tkas">
                        <button class="btn btn-tab tpel active" href="#tkas_1" data-toggle="tab" >Daftar Transaksi</button>
                        <button class="btn btn-tab tpel" href="#tkas_2" data-toggle="tab">Transaksi Kas</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trkas.close()">
                                <img src="./uploads/titlebar/close.png">
                            </div>
                        </td>
                    </tr>
                </table>
            </td> 
        </tr>
    </table> 
</div>
<div class="body">  
    <form novalidate>
        <div class="bodyfix scrollme" style="height:100%">
            <div class="tab-content full-height">
                <div role="tabpanel" class="tab-pane active full-height" id="tkas_1" style="padding-top:5px;">
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
                                        <td > 
                                            <select name="rekeningbrows" id="rekeningbrows" class="form-control select" style="width:100%"
                                                    data-sf="load_rekening" data-placeholder="Rekening Kas"></select>
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
                <div role="tabpanel" class="tab-pane fade full-height" id="tkas_2">
                    <table  width="100%" class="osxtable form">
                        <tr>  
                            <td width="14%"><label for="tgl">Tgl</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input  type="text" style="width:80px" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                            </td> 
                        </tr> 
                        <tr>
                            <td width="14%"><label for="jenis">Transaksi</label> </td>
                            <td width="1%">:</td>
                            <td width="50%">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="jenis" class="jenis" value="KM" checked>
                                        Penerimaan Kas
                                    </label>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="jenis" class="jenis" value="KK">
                                        Pengeluaran Kas
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="jenis">Rekening</label> </td>
                            <td width="1%">:</td>
                            <td width="50%"> 
                                <select name="rekening" id="rekening" class="form-control select" style="width:100%"
                                        data-sf="load_rekening" data-placeholder="Rekening" required></select>  
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
                            <td width="14%"><label for="jumlah">Jumlah</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" name="jumlah" id="jumlah" 
                                       class="form-control number" value="0" required> 
                            </td>
                        </tr>
                    </table>

                    <button class="btn btn-primary pull-right" id="cmdsave">Simpan</button>
                </div>			
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>

    //grid daftar pembelian
    bos.trkas.grid1_data 	 = null ;
    bos.trkas.grid1_loaddata= function(){
        this.grid1_data 		= {
            "tglawal"	   : this.obj.find("#tglawal").val(),
            "tglakhir"	   : this.obj.find("#tglakhir").val(),
            "rekening"	   : this.obj.find("#rekeningbrows").val()
        } ;
    }

    bos.trkas.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.trkas.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'no', caption: 'No', size: '40px', sortable: false},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false},
                { field: 'faktur', caption: 'Faktur', size: '150px', sortable: false},
                { field: 'keterangan', caption: 'keterangan', size: '200px', sortable: false},
                { field: 'debet', caption: 'Debet', size: '100px',style:'text-align:right', sortable: false},
                { field: 'kredit', caption: 'Kredit', size: '100px',style:'text-align:right', sortable: false},
                { field: 'total', caption: 'Total', size: '120px',style:'text-align:right', sortable: false},
                { field: 'username', caption: 'Username', size: '100px', sortable: false},
                { field: 'cmdprintbukti', caption: '', size: '100px', sortable: false}
            ]
        });
    }

    bos.trkas.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trkas.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trkas.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trkas.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trkas.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

     bos.trkas.settab 		= function(n){
        this.obj.find("#tkas button:eq("+n+")").tab("show") ;
    }

    bos.trkas.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trkas.grid1_render() ;
            bos.trkas.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }

    bos.trkas.cmdedit		= function(id){
        bjs.ajax(this.url + '/editing', 'id=' + id);
    }

    bos.trkas.cmddelete		= function(id){
        if(confirm("Hapus Data?")){
            bjs.ajax(this.url + '/deleting', 'id=' + id);
        }
    }

    bos.trkas.init				= function(){
        this.obj.find("#rekening").sval("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#jumlah").val("0") ;
        bjs.ajax(this.url + "/init") ;
    }
    
    bos.trkas.obj.find("#cmdrefresh").on("click", function(){ 
   		bos.trkas.grid1_reloaddata() ; 
	}) ;

    
    bos.trkas.cmdprintbukti	= function(faktur,jenis,rekening){
        if(jenis == "KM"){
            bjs.ajax(this.url + '/printbuktikm', 'faktur='+faktur+'&rekening='+rekening);
        }else if(jenis == "KK"){
            bjs.ajax(this.url + '/printbuktikk', 'faktur='+faktur+'&rekening='+rekening);
        }
    }
    bos.trkas.printbukti = function (contenthtml) {
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write(contenthtml);

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        mywindow.close();
    }

    bos.trkas.initcomp	= function(){


        bjs.initselect({
            class : "#" + this.id + " .select"
        }) ;
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
        this.grid1_loaddata() ;
        this.grid1_load() ;

    }

    bos.trkas.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trkas.tabsaction( e.i )  ;
        });
        this.obj.on("remove",function(){
            bos.trkas.grid1_destroy() ;
        }) ;  	

    }

    bos.trkas.objs = bos.trkas.obj.find("#cmdsave") ;
    bos.trkas.initfunc 		= function(){
        this.init() ;

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                if(confirm("Apakah Anda Yakin?")){ 
                    bjs.ajax( bos.trkas.url + '/saving', bjs.getdataform(this) , bos.trkas.objs) ;
                }
            }
        });
    }

    $(function(){
        bos.trkas.initcomp() ;
        bos.trkas.initcallback() ;
        bos.trkas.initfunc() ;
    }) ;
</script>
