<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Saldo Stock</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptsaldostock.close()">
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
            <table class="osxtable form" border="0">

                <tr>
                    <td width="80px"><label for="tgl">Tgl</label> </td>
                    <td width="20px">:</td>
                    <td width="100px"> 
                        <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                    </td>
                    <td><label for="cabang">Cabang</label> </td>
                <td>:</td>
                <td>
                    <select name="cabang" id="cabang" class="form-control select" style="width:100%"
                            data-placeholder="Cabang / Kantor" required></select>

                </td>

                    <td width="100px">
                        <button class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
                    </td>
                    <td width="100px">	
						<button type= "button" class="btn btn-primary pull-right" id="cmdview">Preview</button>
					</td>
                    <td></td>
                </tr>
                <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
            </table> 
            <div class="row" style="height: calc(100% - 50px);"> 
                <div class="col-sm-12 full-height">
                    <div id="grid1" class="full-height"></div>
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
                            <div id="grid2" style="height:250px"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>


    //grid daftar pembelian
    bos.rptsaldostock.grid1_data    = null ;
    bos.rptsaldostock.grid1_loaddata= function(){
        var tgl = bos.rptsaldostock.obj.find("#tgl").val();
        this.grid1_data 		= {'tgl':tgl,
                                  "cabang"	   : this.obj.find("#cabang").val()
                                  } ;
    }

    bos.rptsaldostock.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptsaldostock.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false, style:"text-align:right"},
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false, style:"text-align:center"},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false , style:"text-align:left"},
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false , style:"text-align:left"},
                { field: 'qty', render: 'float:2' ,caption: 'Qty', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'persd', render: 'float:2' ,caption: 'N. Persd', size: '100px', sortable: false,style:"text-align:right"},
                { field: 'cmddetail',caption: '', size: '100px', sortable: false,style:"text-align:center"}
            ]
        });
    }

    bos.rptsaldostock.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptsaldostock.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptsaldostock.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptsaldostock.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptsaldostock.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }
    
    bos.rptsaldostock.grid2_data    = null ;
    bos.rptsaldostock.grid2_loaddata= function(){
        this.grid2_data         = {} ;
    }


    bos.rptsaldostock.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name    : this.id + '_grid2',
            show: {
                footer      : false,
                toolbar     : false,
                toolbarColumns  : false
            },
            multiSearch     : false,
            columns: [
                { field: 'no', caption: 'No', size: '30px', sortable: false, style:'text-align:center'},
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false ,style:'text-align:center'},
                { field: 'qty', caption: 'Qty', size: '100px', sortable: false,render:'float:2'},
                { field: 'hp', caption: 'HP', size: '100px', sortable: false,render:'float:2'},
                { field: 'jml', caption: 'Jumlah', size: '100px', sortable: false,render:'float:2'}
            ]
        });
    }

    bos.rptsaldostock.grid2_reload     = function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptsaldostock.grid2_destroy    = function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptsaldostock.grid2_render     = function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptsaldostock.grid2_reloaddata = function(){
        this.grid2_reload() ;
    }

    bos.rptsaldostock.cmddetail	= function(kode,tgl,cabang){
        bjs.ajax(this.url + '/detailhpp', 'kode=' + kode +'&tgl=' + tgl +'&cabang=' + cabang);
    }

    bos.rptsaldostock.loadmodalpreview      = function(l){
        this.obj.find("#wrap-preview-detail-d").modal(l) ;
    }

    bos.rptsaldostock.cmdrefresh          = bos.rptsaldostock.obj.find("#cmdrefresh") ;
    bos.rptsaldostock.initfunc    = function(){
        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptsaldostock.grid1_reloadData() ;
        }) ;


    }
    
    bos.rptsaldostock.obj.find("#cmdview").on("click", function(){
		bos.rptsaldostock.initreport();
	}) ; 

    bos.rptsaldostock.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    bos.rptsaldostock.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptsaldostock.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.grid2_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.rptsaldostock.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptsaldostock.grid1_destroy() ;
            bos.rptsaldostock.grid2_destroy() ;

        }) ;
    }
    
    $('#cabang').select2({
        ajax: {
            url: bos.rptsaldostock.base_url + '/seekcabang',
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
        bos.rptsaldostock.initcomp() ;
        bos.rptsaldostock.initcallback() ;
        bos.rptsaldostock.initfunc() ;
    });
</script>