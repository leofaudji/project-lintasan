<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tpel">
                        <button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Gol. Stock</button>
                        <button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Gol. Stock</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.mstgroupstock.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tpel_1" style="padding-top:5px;">
                    <div id="grid1" class="full-height"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="tpel_2">
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
                            <td><label for="rekpersd">Rek. Persediaan</label> </td>
                            <td>:</td>
                            <td>
                                <select name="rekpersd" id="rekpersd" class="form-control select" style="width:100%"
                                    data-placeholder="Rekening Persediaan"></select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="rekpenj">Rek. Penjualan</label> </td>
                            <td>:</td>
                            <td>
                                <select name="rekpj" id="rekpj" class="form-control select" style="width:100%"
                                    data-placeholder="Rekening Penjualan"></select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="rekhpp">Rek. HPP</label> </td>
                            <td>:</td>
                            <td>
                                <select name="rekhpp" id="rekhpp" class="form-control select" style="width:100%"
                                    data-placeholder="Rekening HPP"></select>
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

    bos.mstgroupstock.grid1_data 	 = null ;
    bos.mstgroupstock.grid1_loaddata= function(){
        this.grid1_data 		= {} ;
    }

    bos.mstgroupstock.grid1_load    = function(){ 
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.mstgroupstock.base_url + "/loadgrid",
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
                { field: 'rekpersd', caption: 'Rek. Persediaan', size: '100px', sortable: false},
                { field: 'rekpj', caption: 'Rek. Penjualan', size: '100px', sortable: false},
                { field: 'rekhpp', caption: 'Rek. HPP', size: '100px', sortable: false},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.mstgroupstock.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.mstgroupstock.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.mstgroupstock.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.mstgroupstock.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.mstgroupstock.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.mstgroupstock.cmdedit		= function(id){
        bjs.ajax(this.url + '/editing', 'kode=' + id);
    }

    bos.mstgroupstock.cmddelete		= function(id){
        if(confirm("Hapus Data?")){
            bjs.ajax(this.url + '/deleting', 'kode=' + id);
        }
    }

    bos.mstgroupstock.init				= function(){
        this.obj.find("#kode").val("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#rekpersd").sval("") ;
        this.obj.find("#rekpj").sval("") ;
        this.obj.find("#rekhpp").sval("") ;
        bjs.ajax(this.url + "/init") ;
    }

    bos.mstgroupstock.settab 		= function(n){
        this.obj.find("#tpel button:eq("+n+")").tab("show") ;
    }

    bos.mstgroupstock.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.mstgroupstock.grid1_render() ;
            bos.mstgroupstock.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#kode").focus() ;
        }
    }

    bos.mstgroupstock.initcomp	= function(){
        /*bjs.initselect({
            class : "#" + this.id + " .select2",
            clear : true
        }) ;*/
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.mstgroupstock.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.mstgroupstock.tabsaction( e.i )  ;
        });

        this.obj.on("remove",function(){
            bos.mstgroupstock.grid1_destroy() ;
        }) ;
    }

    bos.mstgroupstock.objs = bos.mstgroupstock.obj.find("#cmdsave") ;
    bos.mstgroupstock.initfunc 		= function(){
        this.init() ;
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bjs.ajax( bos.mstgroupstock.url + '/saving', bjs.getdataform(this) , bos.mstgroupstock.objs) ;
            }
        });
    }
    
    $('#rekpersd').select2({
        ajax: {
            url: bos.mstgroupstock.base_url + '/seekrekening',
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
    
    $('#rekpj').select2({
        ajax: {
            url: bos.mstgroupstock.base_url + '/seekrekening',
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
    
    $('#rekhpp').select2({
        ajax: {
            url: bos.mstgroupstock.base_url + '/seekrekening',
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
        bos.mstgroupstock.initcomp() ;
        bos.mstgroupstock.initcallback() ;
        bos.mstgroupstock.initfunc() ;
    }) ;
</script>
