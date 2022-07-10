<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tbankkas">
                        <button class="btn btn-tab tpel active" href="#tbankkas_1" data-toggle="tab" >Daftar Bank & Kas</button>
                        <button class="btn btn-tab tpel" href="#tbankkas_2" data-toggle="tab">bank Kas</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.mstbankkas.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tbankkas_1" style="padding-top:5px;">
                    <div id="grid1" class="full-height"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="tbankkas_2">
                    <table class="osxtable form">
                        <tr>
                            <td width="14%"><label for="kode">Kode</label> </td>
                            <td width="1%">:</td>
                            <td >
                                <input type="text" id="kode" name="kode" class="form-control" placeholder="kode" required>
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
                            <td><label for="rekening">Rek. Akuntansi</label> </td>
                            <td>:</td>
                            <td>
                                <select name="rekening" id="rekening" class="form-control select" style="width:100%"
                                    data-placeholder="Rekening Akuntansi" required></select>
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

    bos.mstbankkas.grid1_data 	 = null ;
    bos.mstbankkas.grid1_loaddata= function(){
        this.grid1_data 		= {} ;
    }

    bos.mstbankkas.grid1_load    = function(){ 
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.mstbankkas.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '300px', sortable: false},
                { field: 'rekening', caption: 'Rek. Akuntansi', size: '100px', sortable: false},
                { field: 'ketrekening', caption: 'Ket. Rek. Akuntansi', size: '100px', sortable: false},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.mstbankkas.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.mstbankkas.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.mstbankkas.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.mstbankkas.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.mstbankkas.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.mstbankkas.cmdedit		= function(id){
        bjs.ajax(this.url + '/editing', 'kode=' + id);
    }

    bos.mstbankkas.cmddelete		= function(id){
        if(confirm("Hapus Data?")){
            bjs.ajax(this.url + '/deleting', 'kode=' + id);
        }
    }

    bos.mstbankkas.init				= function(){
        this.obj.find("#kode").val("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#rekening").sval("") ;
        bjs.ajax(this.url + "/init") ;
    }

    bos.mstbankkas.settab 		= function(n){
        this.obj.find("#tbankkas button:eq("+n+")").tab("show") ;
    }

    bos.mstbankkas.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.mstbankkas.grid1_render() ;
            bos.mstbankkas.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#kode").focus() ;
        }
    }

    bos.mstbankkas.initcomp	= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.mstbankkas.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.mstbankkas.tabsaction( e.i )  ;
        });

        this.obj.on("remove",function(){
            bos.mstbankkas.grid1_destroy() ;
        }) ;
    }

    bos.mstbankkas.objs = bos.mstbankkas.obj.find("#cmdsave") ;
    bos.mstbankkas.initfunc 		= function(){
        this.init() ;
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bjs.ajax( bos.mstbankkas.url + '/saving', bjs.getdataform(this) , bos.mstbankkas.objs) ;
            }
        });
    }
    
    $('#rekening').select2({
        ajax: {
            url: bos.mstbankkas.base_url + '/seekrekening',
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
        bos.mstbankkas.initcomp() ;
        bos.mstbankkas.initcallback() ;
        bos.mstbankkas.initfunc() ;
    }) ;
</script>
