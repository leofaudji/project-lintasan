<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tkdtr">
                        <button class="btn btn-tab tpel active" href="#tkdtr_1" data-toggle="tab" >Daftar Kode Transaksi</button>
                        <button class="btn btn-tab tpel" href="#tkdtr_2" data-toggle="tab">Kode Transaksi</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.mstkdtransaksi.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tkdtr_1" style="padding-top:5px;">
                    <div id="grid1" class="full-height"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="tkdtr_2">
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
                        <tr>
                            <td width="14%"><label for="dk">DK</label> </td>
                            <td width="1%">:</td>
                            <td width="50%">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="dk" class="dk" value="D" checked>
                                        Debet
                                    </label>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="dk" class="dk" value="K">
                                        Kredit
                                    </label>
                                </div>
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

    bos.mstkdtransaksi.grid1_data 	 = null ;
    bos.mstkdtransaksi.grid1_loaddata= function(){
        this.grid1_data 		= {} ;
    }

    bos.mstkdtransaksi.grid1_load    = function(){ 
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.mstkdtransaksi.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false},
                { field: 'rekening', caption: 'Rek. Akuntansi', size: '100px', sortable: false},
                { field: 'ketrekening', caption: 'Ket. Rek. Akuntansi', size: '150px', sortable: false},
                { field: 'dk', caption: 'DK', size: '50px', sortable: false},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.mstkdtransaksi.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.mstkdtransaksi.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.mstkdtransaksi.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.mstkdtransaksi.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.mstkdtransaksi.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.mstkdtransaksi.cmdedit		= function(id){
        bjs.ajax(this.url + '/editing', 'kode=' + id);
    }

    bos.mstkdtransaksi.cmddelete		= function(id){
        if(confirm("Hapus Data?")){
            bjs.ajax(this.url + '/deleting', 'kode=' + id);
        }
    }

    bos.mstkdtransaksi.init				= function(){
        this.obj.find("#kode").val("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#rekening").sval("") ;
        bos.mstkdtransaksi.setopt("dk","D");
        bjs.ajax(this.url + "/init") ;
    }
    
    bos.mstkdtransaksi.setopt = function(nama,isi){
        this.obj.find('input:radio[name='+nama+'][value='+isi+']').prop('checked',true);
    }

    bos.mstkdtransaksi.settab 		= function(n){
        this.obj.find("#tkdtr button:eq("+n+")").tab("show") ;
    }

    bos.mstkdtransaksi.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.mstkdtransaksi.grid1_render() ;
            bos.mstkdtransaksi.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#kode").focus() ;
        }
    }

    bos.mstkdtransaksi.initcomp	= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.mstkdtransaksi.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.mstkdtransaksi.tabsaction( e.i )  ;
        });

        this.obj.on("remove",function(){
            bos.mstkdtransaksi.grid1_destroy() ;
        }) ;
    }

    bos.mstkdtransaksi.objs = bos.mstkdtransaksi.obj.find("#cmdsave") ;
    bos.mstkdtransaksi.initfunc 		= function(){
        this.init() ;
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bjs.ajax( bos.mstkdtransaksi.url + '/saving', bjs.getdataform(this) , bos.mstkdtransaksi.objs) ;
            }
        });
    }

    $('#rekening').select2({
        ajax: {
            url: bos.mstkdtransaksi.base_url + '/seekrekening',
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
        bos.mstkdtransaksi.initcomp() ;
        bos.mstkdtransaksi.initcallback() ;
        bos.mstkdtransaksi.initfunc() ;
    }) ;
</script>
