<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Purchase Order</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptpo.close()">
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
                        <input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                    </td>
                    <td width="40px">s/d</td>
                    <td width="100px">
                        <input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                    </td> 

                    <td width="100px">
                        <button class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
                    </td>
                    <td width="100px">	
                        <button class="btn btn-primary pull-right" id="cmdpreview">Preview</button>  
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
                        <h4 class="modal-title" id="wm-title">Preview Detail Purchase Order</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Faktur</label>
                                    <input type="text" name="cFaktur" id="faktur" class="form-control" placeholder="faktur" readonly = true>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <input type="text" name="supplier" id="supplier" readonly = true class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tgl</label>
                                    <input type="text" name="tgl" id="tgl" readonly = true class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Faktur PR</label>
                                    <input type="text" name="fktpr" id="fktpr" class="form-control" placeholder="faktur" readonly = true>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="grid2" style="height:250px"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sub Total</label>
                                    <input type="text" style = "text-align:right" name="subtotal" id="subtotal" class="form-control number" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" style = "text-align:right" name="total" id="total" class="form-control number" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br/>
                                    <button type = "button" class="btn btn-success" id="cmdCetakLaporanDetail">Print Report</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br/>
                                    <button type = "button" class="btn btn-primary" id="cmdcetakdm">Print Dot Matrix</button>
                                </div>
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
    bos.rptpo.grid1_data    = null ;
    bos.rptpo.grid1_loaddata= function(){
        var tglAwal = bos.rptpo.obj.find("#tglawal").val();
        var tglAkhir = bos.rptpo.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglAwal':tglAwal,'tglAkhir':tglAkhir} ;
    }

    bos.rptpo.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptpo.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'fktpr', caption: 'Fkt PR', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'supplier', caption: 'Supplier', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'total', render: 'int' ,caption: 'Total', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'cmdPreview', caption: ' ', size: '120px', sortable: false }
            ]
        });
    }

    bos.rptpo.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptpo.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptpo.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptpo.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptpo.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }


    bos.rptpo.cmdpreviewdetail	= function(faktur){
        bjs.ajax(this.url + '/PreviewDetail', 'faktur=' + faktur);
    }
	bos.rptpo.cmdcetakdm 	= function(){
        if(confirm("Cetak data?")){
            var faktur = bos.rptpo.obj.find("#faktur").val();
            bjs.ajax(this.url + '/cetakdm', 'faktur=' + faktur);
        }
    }

    bos.rptpo.cmdrefresh          = bos.rptpo.obj.find("#cmdrefresh") ;
    bos.rptpo.cmdpreview     = bos.rptpo.obj.find("#cmdpreview")
    bos.rptpo.cmdCetakLaporanDetail     = bos.rptpo.obj.find("#cmdCetakLaporanDetail") ;
    bos.rptpo.initfunc    = function(){
        this.obj.find("#cmdpreview").on("click", function(e){
            e.preventDefault() ;
            bos.rptpo.initreportTotal(0,0) ;
        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptpo.grid1_reloadData() ;
        }) ;
        this.obj.find("#cmdCetakLaporanDetail").on("click",function(e){
            e.preventDefault() ;
            bos.rptpo.initReportDetailPembelian(0,0) ;
		});
			
		this.obj.find("#cmdcetakdm").on("click", function(e){
            bos.rptpo.cmdcetakdm();
		});
    }

    bos.rptpo.initReportDetailPembelian  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpo.loadmodalpreview      = function(l){
        this.obj.find("#wrap-preview-detail-d").modal(l) ;
    }

    bos.rptpo.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drags
    }

    bos.rptpo.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptpo.grid1_destroy() ;
            bos.rptpo.grid2_destroy() ;
            bos.rptpo.grid2_destroy() ;
        }) ;
    }

    bos.rptpo.setPreview      = function(cFaktur){
        bos.rptpo.initreport(0,0) ;
    }

    bos.rptpo.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpo.initreportTotal  = function(s,e){
        bjs.ajax(this.base_url+ '/initreportTotal', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpo.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptpo.openreporttotal  = function(){
        bjs_os.form_report( this.base_url + '/showreporttotal' ) ;
    }
	
	

    bos.rptpo.grid2_data    = null ;
    bos.rptpo.grid2_loaddata= function(){
        this.grid2_data         = {} ;
    }


    bos.rptpo.grid2_load    = function(){
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
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false ,style:'text-align:center'},
                { field: 'keterangan', caption: 'Nama Stock', size: '150px', sortable: false },
                { field: 'spesifikasi', caption: 'Spesifikasi', size: '200px', sortable: false },
                { field: 'harga', render: 'int', caption: 'Harga Satuan', size: '100px', sortable: false, style:'text-align:right' },
                { field: 'qty', render: 'int', caption: 'Qty', size: '40px', sortable: false, style:'text-align:center'},
                { field: 'satuan', caption: 'Satuan', size: '80px', sortable: false, style:'text-align:center'},
                { field: 'jumlah', render: 'int' , caption: 'Total', size: '90px', sortable: false,style:'text-align:right'}
            ]
        });
    }

    bos.rptpo.grid2_reload     = function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptpo.grid2_destroy    = function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptpo.grid2_render     = function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptpo.grid2_reloaddata = function(){
        this.grid2_reload() ;
    }

    $(function(){
        bos.rptpo.initcomp() ;
        bos.rptpo.initcallback() ;
        bos.rptpo.initfunc() ;
    });
</script>