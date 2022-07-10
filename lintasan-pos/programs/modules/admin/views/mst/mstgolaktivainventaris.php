<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="taktivagol">
                        <button class="btn btn-tab tpel active" href="#taktivagol_1" data-toggle="tab" >Daftar Gol. Aset</button>
                        <button class="btn btn-tab tpel" href="#taktivagol_2" data-toggle="tab">Gol. Aset</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.mstgolaktivainventaris.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="taktivagol_1" style="padding-top:5px;">
                    <div id="grid1" class="full-height"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="taktivagol_2">
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
                            <td><label for="rekening">Rek. Akm Peny</label> </td>
                            <td>:</td>
                            <td>
                                <select name="rekakmpeny" id="rekakmpeny" class="form-control select" style="width:100%"
                                    data-placeholder="Rekening Akumulasi Penyusutan" required></select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="rekening">Rek. By Peny</label> </td>
                            <td>:</td>
                            <td>
                                <select name="rekbypeny" id="rekbypeny" class="form-control select" style="width:100%"
                                    data-placeholder="Rekening Biaya Penyusutan" required></select>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="jenis">Jenis</label> </td>
                            <td width="1%">:</td>
                            <td width="50%">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" id="jenis" name="jenis" class="jenis" value="A" checked>
                                        Aset & Inventaris
                                    </label>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" id="jenis" name="jenis" class="jenis" value="B">
                                        BDD (Biaya Dibayar Dimuka)
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

    bos.mstgolaktivainventaris.grid1_data 	 = null ;
    bos.mstgolaktivainventaris.grid1_loaddata= function(){
        this.grid1_data 		= {} ;
    }

    bos.mstgolaktivainventaris.grid1_load    = function(){ 
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.mstgolaktivainventaris.base_url + "/loadgrid",
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
                { field: 'rekakmpeny', caption: 'Rek. Akm Peny', size: '100px', sortable: false},
                { field: 'rekbypeny', caption: 'Rek. By Peny', size: '100px', sortable: false},
                { field: 'jenis', caption: 'Jenis', size: '100px', sortable: false},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.mstgolaktivainventaris.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.mstgolaktivainventaris.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.mstgolaktivainventaris.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.mstgolaktivainventaris.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.mstgolaktivainventaris.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.mstgolaktivainventaris.cmdedit		= function(id){
        bjs.ajax(this.url + '/editing', 'kode=' + id);
    }

    bos.mstgolaktivainventaris.cmddelete		= function(id){
        if(confirm("Hapus Data?")){
            bjs.ajax(this.url + '/deleting', 'kode=' + id);
        }
    }

    bos.mstgolaktivainventaris.init				= function(){
        this.obj.find("#kode").val("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#rekakmpeny").sval("") ;
        this.obj.find("#rekbypeny").sval("") ;

        bjs.ajax(this.url + "/init") ;
        bos.mstgolaktivainventaris.setopt("jenis","A");
    }

    bos.mstgolaktivainventaris.settab 		= function(n){
        this.obj.find("#taktivagol button:eq("+n+")").tab("show") ;
    }

    bos.mstgolaktivainventaris.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.mstgolaktivainventaris.grid1_render() ;
            bos.mstgolaktivainventaris.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#kode").focus() ;
        }
    }
    
    bos.mstgolaktivainventaris.setopt = function(nama,isi){
        this.obj.find('input:radio[name='+nama+'][value='+isi+']').prop('checked',true);
    }

    bos.mstgolaktivainventaris.initcomp	= function(){
        /*bjs.initselect({
            class : "#" + this.id + " .select2",
            clear : true
        }) ;*/
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.mstgolaktivainventaris.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.mstgolaktivainventaris.tabsaction( e.i )  ;
        });

        this.obj.on("remove",function(){
            bos.mstgolaktivainventaris.grid1_destroy() ;
        }) ;
    }

    bos.mstgolaktivainventaris.objs = bos.mstgolaktivainventaris.obj.find("#cmdsave") ;

    bos.mstgolaktivainventaris.initfunc 		= function(){
        this.init() ;
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bjs.ajax( bos.mstgolaktivainventaris.url + '/saving', bjs.getdataform(this) , bos.mstgolaktivainventaris.objs) ;
            }
        });
    }
    
    $('#rekakmpeny').select2({
        ajax: {
            url: bos.mstgolaktivainventaris.base_url + '/seekrekakmpeny',
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
    
    $('#rekbypeny').select2({
        ajax: {
            url: bos.mstgolaktivainventaris.base_url + '/seekrekbypeny',
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
        bos.mstgolaktivainventaris.initcomp() ;
        bos.mstgolaktivainventaris.initcallback() ;
        bos.mstgolaktivainventaris.initfunc() ;
    }) ;
</script>
