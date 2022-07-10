<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Delivery Order</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptdo.close()">
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
                        <h4 class="modal-title" id="wm-title">Preview Detail Delivery Order</h4>
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
                                    <label>Customer</label>
                                    <input type="text" name="customer" id="customer" readonly = true class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tgl</label>
                                    <input type="text" name="tgl" id="tgl" readonly = true class="form-control">
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
                                    <br/>
                                    <button type = "button" class="btn btn-success" id="cmdCetakLaporanDetail">Print Report</button>


                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br/>

                                    <button type = "button" class="btn btn-primary" id="cmdcetakdm">Cetak Dot Matrix</button>

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
    bos.rptdo.grid1_data    = null ;
    bos.rptdo.grid1_loaddata= function(){
        var tglAwal = bos.rptdo.obj.find("#tglawal").val();
        var tglAkhir = bos.rptdo.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglAwal':tglAwal,'tglAkhir':tglAkhir} ;
    }

    bos.rptdo.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptdo.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'customer', caption: 'Customer', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'cmdPreview', caption: ' ', size: '120px', sortable: false }
            ]
        });
    }

    bos.rptdo.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptdo.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptdo.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptdo.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptdo.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }


    bos.rptdo.cmdpreviewdetail	= function(faktur){
        bjs.ajax(this.url + '/PreviewDetail', 'faktur=' + faktur);
    }
    bos.rptdo.cmdcetakdm 	= function(){
        if(confirm("Cetak data?")){
            var faktur = bos.rptdo.obj.find("#faktur").val();
            bjs.ajax(this.url + '/cetakdm', 'faktur=' + faktur);
        }
    }

    bos.rptdo.cmdrefresh          = bos.rptdo.obj.find("#cmdrefresh") ;
    bos.rptdo.cmdpreview     = bos.rptdo.obj.find("#cmdpreview")
    bos.rptdo.cmdCetakLaporanDetail     = bos.rptdo.obj.find("#cmdCetakLaporanDetail") ;
    bos.rptdo.initfunc    = function(){
        this.obj.find("#cmdpreview").on("click", function(e){
            e.preventDefault() ;
            bos.rptdo.initreportTotal(0,0) ;
        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptdo.grid1_reloadData() ;
        }) ;
        this.obj.find("#cmdCetakLaporanDetail").on("click",function(e){
            e.preventDefault() ;
            bos.rptdo.initReportDetailPembelian(0,0) ;
        });
        
        this.obj.find("#cmdcetakdm").on("click", function(e){
            bos.rptdo.cmdcetakdm();
        }) ;
    }

    bos.rptdo.initReportDetailPembelian  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptdo.loadmodalpreview      = function(l){
        this.obj.find("#wrap-preview-detail-d").modal(l) ;
    }

    bos.rptdo.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
    }

    bos.rptdo.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptdo.grid1_destroy() ;
            bos.rptdo.grid2_destroy() ;
        }) ;
    }

    bos.rptdo.setPreview      = function(cFaktur){
        bos.rptdo.initreport(0,0) ;
    }

    bos.rptdo.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptdo.initreportTotal  = function(s,e){
        bjs.ajax(this.base_url+ '/initreportTotal', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptdo.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptdo.openreporttotal  = function(){
        bjs_os.form_report( this.base_url + '/showreporttotal' ) ;
    }

    bos.rptdo.grid2_data    = null ;
    bos.rptdo.grid2_loaddata= function(){
        this.grid2_data         = {} ;
    }


    bos.rptdo.grid2_load    = function(){
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
                { field: 'qty', render: 'int', caption: 'Qty', size: '40px', sortable: false, style:'text-align:center'},
                { field: 'satuan', caption: 'Satuan', size: '80px', sortable: false, style:'text-align:center'}
            ]
        });
    }

    bos.rptdo.grid2_reload     = function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptdo.grid2_destroy    = function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptdo.grid2_render     = function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptdo.grid2_reloaddata = function(){
        this.grid2_reload() ;
    }

    $(function(){
        bos.rptdo.initcomp() ;
        bos.rptdo.initcallback() ;
        bos.rptdo.initfunc() ;
    });
</script>