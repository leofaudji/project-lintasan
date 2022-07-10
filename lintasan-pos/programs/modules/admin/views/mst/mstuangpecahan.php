<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tup">
                        <button class="btn btn-tab tpel active" href="#tup_1" data-toggle="tab" >Daftar Uang Pecahan</button>
                        <button class="btn btn-tab tpel" href="#tup_2" data-toggle="tab">Uang Pecahan</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.mstuangpecahan.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tup_1" style="padding-top:5px;">
                    <div id="grid1" class="full-height"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="tup_2">
                    <table class="osxtable form">
                        <tr>
                            <td width="14%"><label for="kode">Kode</label> </td>
                            <td width="1%">:</td>
                            <td >
                                <input type="text" id="kode" name="kode" class="form-control" placeholder="kode" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="pecahan">Pecahan</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input type="text" id="pecahan" name="pecahan" class="form-control number" placeholder="keterangan" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="jenis">Jenis</label> </td>
                            <td width="1%">:</td>
                            <td width="50%">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" id="jenis" name="jenis"  value="K" checked>
                                        Kertas
                                    </label>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" id= "jenis" name="jenis"  value="L">
                                        Logam
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

    bos.mstuangpecahan.grid1_data 	 = null ;
    bos.mstuangpecahan.grid1_loaddata= function(){
        this.grid1_data 		= {} ;
    }

    bos.mstuangpecahan.grid1_load    = function(){ 
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.mstuangpecahan.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false},
                { field: 'pecahan',render:'float:2',  caption: 'Pecahan', size: '100px', sortable: false},
                { field: 'jenis',caption: 'Jenis', size: '50px', sortable: false},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.mstuangpecahan.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.mstuangpecahan.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.mstuangpecahan.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.mstuangpecahan.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.mstuangpecahan.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.mstuangpecahan.cmdedit		= function(id){
        bjs.ajax(this.url + '/editing', 'kode=' + id);
    }

    bos.mstuangpecahan.cmddelete		= function(id){
        if(confirm("Hapus Data?")){
            bjs.ajax(this.url + '/deleting', 'kode=' + id);
        }
    }

    bos.mstuangpecahan.init				= function(){
        this.obj.find("#kode").val("") ;
        this.obj.find("#pecahan").val("0") ;
        bos.mstuangpecahan.setopt("jenis","K");
        bjs.ajax(this.url + "/init") ;
    }
    
    bos.mstuangpecahan.setopt = function(nama,isi){
        this.obj.find('input:radio[name='+nama+'][value='+isi+']').prop('checked',true);
    }

    bos.mstuangpecahan.settab 		= function(n){
        this.obj.find("#tup button:eq("+n+")").tab("show") ;
    }

    bos.mstuangpecahan.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.mstuangpecahan.grid1_render() ;
            bos.mstuangpecahan.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#kode").focus() ;
        }
    }

    bos.mstuangpecahan.initcomp	= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.mstuangpecahan.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.mstuangpecahan.tabsaction( e.i )  ;
        });

        this.obj.on("remove",function(){
            bos.mstuangpecahan.grid1_destroy() ;
        }) ;
    }

    bos.mstuangpecahan.objs = bos.mstuangpecahan.obj.find("#cmdsave") ;
    bos.mstuangpecahan.initfunc 		= function(){
        this.init() ;
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bjs.ajax( bos.mstuangpecahan.url + '/saving', bjs.getdataform(this) , bos.mstuangpecahan.objs) ;
            }
        });
    }

    $(function(){
        bos.mstuangpecahan.initcomp() ;
        bos.mstuangpecahan.initcallback() ;
        bos.mstuangpecahan.initfunc() ;
    }) ;
</script>
