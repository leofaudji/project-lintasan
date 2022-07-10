<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
    <div class="bodyfix scrollme" style="height:100%"> 
        <table class="osxtable form" border="0">
            <tr>
                <td width="80px"><label for="periode">Tgl</label> </td>
                <td width="20px">:</td>
                <td> 
                    <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
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
                <td>
                    <button class="btn btn-success pull-right" id="cmdrefresh">Refresh</button>
                </td>
                <td></td>
                <td>
                    <button class="btn btn-primary pull-right" id="cmdposting">Posting</button>
                </td>
            </tr>
            <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
        </table>
        <div class="row" style="height: calc(80%);"> 
            <div class="col-sm-12 full-height">
                <div id="grid2" class="full-height"></div>
            </div>  
        </div>
    </div>

    <div class="modal fade" style="position:absolute;"  width = "100%" id="wrap-preview-detailgol-d" role="dialog" data-backdrop="false" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="wm-title">Preview Detail HPP Per Gol Stock</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Golongan</label>
                                <input type="text" name="golongan" id="golongan" class="form-control" placeholder="Golongan" readonly = true>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="grid1" style="height:250px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" style="position:absolute;" id="wrap-preview-detail-d" role="dialog" data-backdrop="false" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="wm-title">Preview Detail HPP Per Stock</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode" readonly = true>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" readonly = true>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan" readonly = true>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="grid3" style="height:250px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    <?=cekbosjs();?>

    bos.utlpostinghpp.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            show 		: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'no', caption: 'No', size: '40px', sortable: false},
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '150px', sortable: false},
                { field: 'satuan', caption: 'Satuan', size: '50px', sortable: false},
                { field: 'qty', caption: 'Qty', size: '100px', sortable: false,render:'int'},
                { field: 'saldo', caption: 'Saldo', size: '100px', sortable: false,render:'int'},
                { field: 'cmddetail', caption: ' ', size: '100px', sortable: false }
            ]
        });
    }

    bos.utlpostinghpp.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.utlpostinghpp.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.utlpostinghpp.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.utlpostinghpp.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }
    
    bos.utlpostinghpp.grid1_reloaddata = function(){
        this.grid1_reload() ;
    }

    //grid sub total
    bos.utlpostinghpp.grid2_data 	 = null ;
    bos.utlpostinghpp.grid2_loaddata= function(){
        this.grid2_data 		= {
            "tgl"	   : this.obj.find("#tgl").val(),
            "cabang"	   : this.obj.find("#cabang").val()
        } ;
    }

    bos.utlpostinghpp.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name		: this.id + '_grid2',
            limit 	    : 100 ,
            url 		: bos.utlpostinghpp.base_url + "/loadgrid2",
            postData : this.grid2_data ,
            show 		: {
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'no', caption: 'No', size: '40px', sortable: false},
                { field: 'golongan', caption: 'Gol', size: '80px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '150px', sortable: false},
                { field: 'rekening', caption: 'Rek. Akt', size: '100px', sortable: false},
                { field: 'ketrek', caption: 'Ket. Rek', size: '150px', sortable: false},
                { field: 'saldoneraca', caption: 'Neraca', size: '100px', sortable: false,render:'int'},
                { field: 'saldostock', caption: 'Stock', size: '100px', sortable: false,render:'int'},
                { field: 'selisih', caption: 'Selisih', size: '100px', sortable: false,render:'int'},
                { field: 'cmddetail', caption: ' ', size: '100px', sortable: false }
            ]
        });
    }

    bos.utlpostinghpp.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.utlpostinghpp.grid2_setdata	= function(){
        w2ui[this.id + '_grid2'].postData 	= this.grid2_data ;
    }
    bos.utlpostinghpp.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.utlpostinghpp.grid2_render 	= function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }
    
    bos.utlpostinghpp.grid2_reloaddata	= function(){
        this.grid2_loaddata() ;
        this.grid2_setdata() ;
        this.grid2_reload() ;

    }

    bos.utlpostinghpp.grid3_data    = null ;
    bos.utlpostinghpp.grid3_loaddata= function(){
        this.grid3_data         = {} ;
    }


    bos.utlpostinghpp.grid3_load    = function(){
        this.obj.find("#grid3").w2grid({
            name    : this.id + '_grid3',
            show: {
                footer      : false,
                toolbar     : false,
                toolbarColumns  : false
            },
            multiSearch     : false,
            columns: [
                { field: 'no', caption: 'No', size: '30px', sortable: false, style:'text-align:center'},
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false ,style:'text-align:center'},
                { field: 'qty', caption: 'Qty', size: '100px', sortable: false,render:'int'},
                { field: 'hp', caption: 'HP', size: '100px', sortable: false,render:'int'},
                { field: 'jml', caption: 'Jumlah', size: '100px', sortable: false,render:'int'}
            ]
        });
    }

    bos.utlpostinghpp.grid3_reload     = function(){
        w2ui[this.id + '_grid3'].reload() ;
    }
    bos.utlpostinghpp.grid3_destroy    = function(){
        if(w2ui[this.id + '_grid3'] !== undefined){
            w2ui[this.id + '_grid3'].destroy() ;
        }
    }

    bos.utlpostinghpp.grid3_render     = function(){
        this.obj.find("#grid3").w2render(this.id + '_grid3') ;
    }

    bos.utlpostinghpp.grid3_reloaddata = function(){
        this.grid3_reload() ;
    }

    bos.utlpostinghpp.cmddetail	= function(kode,tgl,cabang){
        bjs.ajax(this.url + '/detailhpp', 'kode=' + kode +'&tgl=' + tgl +'&cabang=' + cabang);
    }
    
    bos.utlpostinghpp.cmddetailgol	= function(kode,tgl,cabang){
        bjs.ajax(this.url + '/detailhppgol', 'kode=' + kode +'&tgl=' + tgl +'&cabang=' + cabang);
    }

    bos.utlpostinghpp.loadmodalpreview      = function(l){
        this.obj.find("#wrap-preview-detail-d").modal(l) ;
    }

    bos.utlpostinghpp.loadmodalpreviewgol      = function(l){
        this.obj.find("#wrap-preview-detailgol-d").modal(l) ;
    }

    bos.utlpostinghpp.initcomp	= function(){

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }  

    bos.utlpostinghpp.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.utlpostinghpp.tabsaction( e.i )  ;
        });  

        this.obj.on("remove",function(){
            bos.utlpostinghpp.grid1_destroy() ;
            bos.utlpostinghpp.grid2_destroy() ;
            bos.utlpostinghpp.grid3_destroy() ;
        }) ;   	

    }

    bos.utlpostinghpp.objs = bos.utlpostinghpp.obj.find("#cmdposting") ;
    bos.utlpostinghpp.initfunc 		= function(){

        this.grid2_loaddata() ;
        this.grid2_load() ;
        
         this.grid1_load() ;
        this.grid3_load() ;

        this.obj.find("form").on("submit", function(e){ 
            e.preventDefault() ;
        });

        this.obj.find("#cmdposting").on("click", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                var datagrid2 =  w2ui['bos-form-utlpostinghpp_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                var tgl = bos.utlpostinghpp.obj.find("#tgl").val();
                var cab = bos.utlpostinghpp.obj.find("#cabang").val();
                bjs.ajax(bos.utlpostinghpp.base_url + '/posting', bjs.getdataform(this)+"&grid2="+datagrid2+"&tgl="+tgl+"&cabang="+cab, bos.utlpostinghpp.objs) ;
            }
        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.utlpostinghpp.grid2_reloaddata();
        }) ;
    }
    $('#cabang').select2({
        ajax: {
            url: bos.utlpostinghpp.base_url + '/seekcabang',
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
        bos.utlpostinghpp.initcomp() ;
        bos.utlpostinghpp.initcallback() ;
        bos.utlpostinghpp.initfunc() ;
    }) ;
</script>