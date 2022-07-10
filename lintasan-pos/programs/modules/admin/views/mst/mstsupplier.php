<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tpel">
                        <button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Supplier</button>
                        <button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Supplier</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.mstsupplier.close()">
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
                                <input readonly type="text" id="kode" name="kode" class="form-control" placeholder="Kode" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="nama">Nama</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="notelepon">No Telp</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" id="notelepon" name="notelepon" class="form-control" placeholder="notelepon" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="email">Email</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" id="email" name="email" class="form-control" placeholder="email" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="alamat">Alamat</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="alamat" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="namabank">Nama Bank</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" id="namabank" name="namabank" class="form-control" placeholder="Nama Bank" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="rekening">Rekening</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" id="rekening" name="rekening" class="form-control" placeholder="Rekening" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="atasnamarekening">A.n Rekening</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" id="atasnamarekening" name="atasnamarekening" class="form-control" placeholder="Atas Nama Rekening" required>
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

    bos.mstsupplier.grid1_data 	 = null ;
    bos.mstsupplier.grid1_loaddata= function(){
        this.grid1_data 		= {} ;
    }

    bos.mstsupplier.grid1_load    = function(){ 
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.mstsupplier.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false},
                { field: 'nama', caption: 'Nama', size: '300px', sortable: false},
                { field: 'notelepon', caption: 'No Telp', size: '100px', sortable: false},
                { field: 'email', caption: 'Email', size: '100px', sortable: false},
                { field: 'alamat', caption: 'Alamat', size: '100px', sortable: false},
                { field: 'namabank', caption: 'Bank', size: '100px', sortable: false},
                { field: 'rekening', caption: 'Rekening', size: '100px', sortable: false},
                { field: 'atasnamarekening', caption: 'A.N Rekening', size: '100px', sortable: false},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.mstsupplier.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.mstsupplier.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.mstsupplier.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.mstsupplier.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.mstsupplier.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.mstsupplier.cmdedit		= function(id){
        bjs.ajax(this.url + '/editing', 'kode=' + id);
    }

    bos.mstsupplier.cmddelete		= function(id){
        if(confirm("Hapus Data?")){
            bjs.ajax(this.url + '/deleting', 'kode=' + id);
        }
    }

    bos.mstsupplier.init				= function(){
        this.obj.find("#kode").val("") ;
        this.obj.find("#nama").val("") ;
        this.obj.find("#notelepon").val("") ;
        this.obj.find("#email").val("") ;
        this.obj.find("#alamat").val("") ;
        this.obj.find("#namabank").val("") ;
        this.obj.find("#rekening").val("") ;
        this.obj.find("#atasnamarekening").val("") ;
        bjs.ajax(this.url + '/getkode') ;
        bjs.ajax(this.url + "/init") ;
    }

    bos.mstsupplier.settab 		= function(n){
        this.obj.find("#tpel button:eq("+n+")").tab("show") ;
    }

    bos.mstsupplier.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.mstsupplier.grid1_render() ;
            bos.mstsupplier.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#kode").focus() ;
        }
    }

    bos.mstsupplier.initcomp	= function(){
        /*bjs.initselect({
            class : "#" + this.id + " .select2",
            clear : true
        }) ;*/
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.mstsupplier.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.mstsupplier.tabsaction( e.i )  ;
        });

        this.obj.on("remove",function(){
            bos.mstsupplier.grid1_destroy() ;
        }) ;
    }

    bos.mstsupplier.objs = bos.mstsupplier.obj.find("#cmdsave") ;
    bos.mstsupplier.initfunc 		= function(){
        this.init() ;
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bjs.ajax( bos.mstsupplier.url + '/saving', bjs.getdataform(this) , bos.mstsupplier.objs) ;
            }
        });
    }

    $(function(){
        bos.mstsupplier.initcomp() ;
        bos.mstsupplier.initcallback() ;
        bos.mstsupplier.initfunc() ;
    }) ;
</script>
