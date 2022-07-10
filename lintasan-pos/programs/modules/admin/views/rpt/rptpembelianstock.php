<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Pembelian</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptpembelianstock.close()">
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
                        <h4 class="modal-title" id="wm-title">Preview Detail Pembelian</h4>
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
                                    <label>Fkt PO</label>
                                    <input type="text" name="fktpo" id="fktpo" class="form-control" placeholder="faktur PO" readonly = true>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>%PPn</label>
                                    <input type="text" style = "text-align:right" name="persppn" id="persppn" class="form-control number" placeholder="0.00" readonly = true required>
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
                                    <label>Diskon</label>
                                    <input type="text" style = "text-align:right" name="diskon" id="diskon" class="form-control number" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>PPn</label>
                                    <input type="text" style = "text-align:right" name="ppn" id="ppn" class="form-control number" placeholder="0.00" readonly = true required>
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
    bos.rptpembelianstock.grid1_data    = null ;
    bos.rptpembelianstock.grid1_loaddata= function(){
        var tglAwal = bos.rptpembelianstock.obj.find("#tglawal").val();
        var tglAkhir = bos.rptpembelianstock.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglAwal':tglAwal,'tglAkhir':tglAkhir} ;
    }

    bos.rptpembelianstock.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptpembelianstock.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'supplier', caption: 'Supplier', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'subtotal', render: 'int' ,caption: 'Subtotal', size: '100px', sortable: false, style:"text-align:right" },
                { field: 'diskon', render: 'int' ,caption: 'Diskon', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'ppn', render: 'int' ,caption: 'PPn', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'total', render: 'int' ,caption: 'Total', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'cmdPreview', caption: ' ', size: '120px', sortable: false }
            ]
        });
    }

    bos.rptpembelianstock.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptpembelianstock.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptpembelianstock.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptpembelianstock.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptpembelianstock.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }


    bos.rptpembelianstock.cmdpreviewdetail	= function(faktur){
        //$("#modal-preview").html("");
        //alert("lasjdlasd");
        //bjs.ajax(bos.rptpembelianstock.url + '/PreviewDetailPembelianStock/'+ faktur);
        bjs.ajax(this.url + '/PreviewDetailPembelianStock', 'faktur=' + faktur);
    }

    bos.rptpembelianstock.cmdrefresh          = bos.rptpembelianstock.obj.find("#cmdrefresh") ;
    bos.rptpembelianstock.cmdpreview     = bos.rptpembelianstock.obj.find("#cmdpreview")
    bos.rptpembelianstock.cmdCetakLaporanDetail     = bos.rptpembelianstock.obj.find("#cmdCetakLaporanDetail") ;
    bos.rptpembelianstock.initfunc    = function(){
        this.obj.find("#cmdpreview").on("click", function(e){
            e.preventDefault() ;
            bos.rptpembelianstock.initreportTotal(0,0) ;
        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptpembelianstock.grid1_reloadData() ;
        }) ;
        this.obj.find("#cmdCetakLaporanDetail").on("click",function(e){
            e.preventDefault() ;
            bos.rptpembelianstock.initReportDetailPembelian(0,0) ;
        });
    }

    bos.rptpembelianstock.initReportDetailPembelian  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpembelianstock.loadmodalpreview      = function(l){
        this.obj.find("#wrap-preview-detail-d").modal(l) ;
    }

    bos.rptpembelianstock.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.rptpembelianstock.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptpembelianstock.grid1_destroy() ;
            bos.rptpembelianstock.grid2_destroy() ;
            bos.rptpembelianstock.grid2_destroy() ;
        }) ;
    }

    bos.rptpembelianstock.setPreview      = function(cFaktur){
        //e.preventDefault() ;
        //bos.rptpembelianstock.cmdview.button('loading') ;
        bos.rptpembelianstock.initreport(0,0) ;
    }

    bos.rptpembelianstock.initreport  = function(s,e){
        //bjs.initprogress(this.obj.find("#progress_1"),s,e) ;
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpembelianstock.initreportTotal  = function(s,e){
        //bjs.initprogress(this.obj.find("#progress_1"),s,e) ;
        bjs.ajax(this.base_url+ '/initreportTotal', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpembelianstock.openreport  = function(){
        // bos.rptkartustock.cmdview.button('reset') ;
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptpembelianstock.openreporttotal  = function(){
        // bos.rptkartustock.cmdview.button('reset') ;
        bjs_os.form_report( this.base_url + '/showreporttotal' ) ;
    }

    bos.rptpembelianstock.grid2_data    = null ;
    bos.rptpembelianstock.grid2_loaddata= function(){
        this.grid2_data         = {} ;
    }


    bos.rptpembelianstock.grid2_load    = function(){
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
                { field: 'keterangan', caption: 'Nama Stock', size: '150px', sortable: false },
                { field: 'HargaSatuan', render: 'int', caption: 'Harga Satuan', size: '100px', sortable: false, style:'text-align:right' },
                { field: 'qty', render: 'int', caption: 'Qty', size: '40px', sortable: false, style:'text-align:center'},
                { field: 'satuan', caption: 'Satuan', size: '80px', sortable: false, style:'text-align:center'},
                { field: 'pembelian', render: 'int', caption: 'Pembelian', size: '100px', sortable: false },
                { field: 'hargadiskon', render: 'int',caption: 'Harga Diskon', size: '100px', sortable: false,style:'text-align:right'},
                { field: 'total', render: 'int' , caption: 'Total', size: '90px', sortable: false,style:'text-align:right'}
            ]
        });
    }

    bos.rptpembelianstock.grid2_reload     = function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptpembelianstock.grid2_destroy    = function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptpembelianstock.grid2_render     = function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptpembelianstock.grid2_reloaddata = function(){
        this.grid2_reload() ;
    }

    $(function(){
        bos.rptpembelianstock.initcomp() ;
        bos.rptpembelianstock.initcallback() ;
        bos.rptpembelianstock.initfunc() ;
    });
</script>