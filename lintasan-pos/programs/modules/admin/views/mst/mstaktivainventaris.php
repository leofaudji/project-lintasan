<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tpel">
                        <button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Aset & Inventaris</button>
                        <button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Aset & Inventaris</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.mstaktivainventaris.close()">
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
                                <input type="text" maxlength="8" id="kode" name="kode" class="form-control" placeholder="kode" required>
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
                            <td><label for="cabang">Cabang</label> </td>
                            <td>:</td>
                            <td>
                                <select name="cabang" id="cabang" class="form-control select" style="width:100%"
                                        data-placeholder="Cabang / Kantor" required></select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="golaset">Gol. Aset</label> </td>
                            <td>:</td>
                            <td>
                                <select name="golaset" id="golaset" class="form-control select" style="width:100%"
                                        data-placeholder="Golongan Aset" required></select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="tglperolehan">Tgl. Perolehan</label> </td>
                            <td>:</td>
                            <td>
                                <input style="width:80px" type="text" class="form-control date" id="tglperolehan" name="tglperolehan" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                            </td>
                        </tr> 
                        <tr>
                            <td width="14%"><label for="lama">Lama (Tahun)</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input  style="width:50px" maxlength="5" type="text" name="lama" id="lama" class="form-control number" value="0">

                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="hp">Harga Perolehan</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input  style="width:200px" maxlength="20" type="text" name="hp" id="hp" class="form-control number" value="0">

                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="unit">Unit</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input  style="width:50px" maxlength="7" type="text" name="unit" id="unit" class="form-control number" value="0" required>

                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="jenis">Jenis Peny</label> </td>
                            <td width="1%">:</td>
                            <td width="50%">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="jenis" class="jenis" value="1" checked>
                                        Garis Lurus
                                    </label>
                                    &nbsp;&nbsp;
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="jenis" class="jenis" value="2">
                                        Saldo Menurun
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="tarifpeny">Tarif Peny (%)</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input  style="width:50px" maxlength="7" type="text" name="tarifpeny" id="tarifpeny" class="form-control number" value="0">

                            </td>
                        </tr>
                        <tr>
                            <td width="14%"><label for="residu">Nilai Residu</label> </td>
                            <td width="1%">:</td>
                            <td>
                                <input  style="width:200px" maxlength="20" type="text" name="residu" id="residu" class="form-control number" value="0">

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

    bos.mstaktivainventaris.grid1_data 	 = null ;
    bos.mstaktivainventaris.grid1_loaddata= function(){
        this.grid1_data 		= {} ;
    }

    bos.mstaktivainventaris.grid1_load    = function(){ 
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.mstaktivainventaris.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'kode', caption: 'Kode', size: '120px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '150px', sortable: false},
                { field: 'cabang', caption: 'Cabang', size: '80px', sortable: false},
                { field: 'golongan', caption: 'Gol. Aset', size: '100px', sortable: false},
                { field: 'tglperolehan', caption: 'Tgl Perolehan', size: '80px', sortable: false},
                { field: 'lama', caption: 'Lama', size: '80px', sortable: false},
                { field: 'hargaperolehan', caption: 'Harga Perolehan', size: '100px', sortable: false},
                { field: 'unit', caption: 'Unit', size: '80px', sortable: false},
                { field: 'jenispenyusutan', caption: 'Jenis Penyusutan', size: '100px', sortable: false},
                { field: 'tarifpenyusutan', caption: 'Tarif Penyusutan', size: '100px', sortable: false},
                { field: 'residu', caption: 'Nilai Residu', size: '100px', sortable: false},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.mstaktivainventaris.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.mstaktivainventaris.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.mstaktivainventaris.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.mstaktivainventaris.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.mstaktivainventaris.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.mstaktivainventaris.cmdedit		= function(id){
        bjs.ajax(this.url + '/editing', 'kode=' + id);
    }

    bos.mstaktivainventaris.cmddelete		= function(id){
        if(confirm("Hapus Data?")){
            bjs.ajax(this.url + '/deleting', 'kode=' + id);
        }
    }

    bos.mstaktivainventaris.init				= function(){
        this.obj.find("#kode").val("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#cabang").sval("") ;
        this.obj.find("#golaset").sval("") ;
        this.obj.find("#tglperolehan").val("<?=date("d-m-Y")?>");
        this.obj.find("#lama").val("0") ;
        this.obj.find("#hp").val("0") ;
        this.obj.find("#unit").val("1") ;
        //this.obj.find("#jenis").val("1") ;
        this.obj.find("#tarifpeny").val("0") ;
        this.obj.find("#residu").val("0") ;
        bjs.ajax(this.url + "/init") ;
        bjs.ajax(this.url + '/getkode') ;
        bos.mstaktivainventaris.setopt("jenis","1");

    }

    bos.mstaktivainventaris.settab 		= function(n){
        this.obj.find("#tpel button:eq("+n+")").tab("show") ;
    }

    bos.mstaktivainventaris.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.mstaktivainventaris.grid1_render() ;
            bos.mstaktivainventaris.init() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#kode").focus() ;
        }
    }

    bos.mstaktivainventaris.initcomp	= function(){
        /*bjs.initselect({
            class : "#" + this.id + " .select2",
            clear : true
        }) ;*/
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.mstaktivainventaris.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.mstaktivainventaris.tabsaction( e.i )  ;
        });

        this.obj.on("remove",function(){
            bos.mstaktivainventaris.grid1_destroy() ;
        }) ;
    }
    bos.mstaktivainventaris.setopt = function(nama,isi){
        this.obj.find('input:radio[name='+nama+'][value='+isi+']').prop('checked',true);
    }
    bos.mstaktivainventaris.objs = bos.mstaktivainventaris.obj.find("#cmdsave") ;
    bos.mstaktivainventaris.initfunc 		= function(){
        this.init() ;
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.obj.find("form").on("submit", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bjs.ajax( bos.mstaktivainventaris.url + '/saving', bjs.getdataform(this) , bos.mstaktivainventaris.objs) ;
            }
        });
    }

    $('#golaset').select2({
        ajax: {
            url: bos.mstaktivainventaris.base_url + '/seekgolaset',
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

    $('#cabang').select2({
        ajax: {
            url: bos.mstaktivainventaris.base_url + '/seekcabang',
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
        bos.mstaktivainventaris.initcomp() ;
        bos.mstaktivainventaris.initcallback() ;
        bos.mstaktivainventaris.initfunc() ;
    }) ;
    

</script>
