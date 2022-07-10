<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Pelunasan Piutang</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptpelunasanpiutang.close()">
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
                        <h4 class="modal-title" id="wm-title">Preview Detail Pelunasan Piutang</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Faktur</label>
                                    <input type="text" name="faktur" id="faktur" class="form-control" placeholder="faktur" readonly = true>
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
                                    <label>Penjualan</label>
                                    <input type="text" style = "text-align:right" name="penjualan" id="penjualan" class="form-control number" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Retur</label>
                                    <input type="text" style = "text-align:right" name="retur" id="retur" class="form-control number" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Subtotal</label>
                                    <input type="text" style = "text-align:right" name="subtotal" id="subtotal" class="form-control number" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Uang Muka</label>
                                    <input type="text" style = "text-align:right" name="uangmuka" id="uangmuka" class="form-control number" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Transfer / Kas</label>
                                    <input type="text" style = "text-align:right" name="tfkas" id="tfkas" class="form-control number" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rek. Bank /  Kas</label>
                                    <input type="text" name="bankkas" id="bankkas" readonly = true class="form-control">
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
                                    <label>Pembulatan</label>
                                    <input type="text" style = "text-align:right" name="pembulatan" id="pembulatan" class="form-control number" placeholder="0.00" readonly = true required>
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
    bos.rptpelunasanpiutang.grid1_data    = null ;
    bos.rptpelunasanpiutang.grid1_loaddata= function(){
        var tglawal = bos.rptpelunasanpiutang.obj.find("#tglawal").val();
        var tglakhir = bos.rptpelunasanpiutang.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.rptpelunasanpiutang.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptpelunasanpiutang.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'customer', caption: 'Customer', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'penjualan', caption: 'Penjualan', size: '100px', sortable: false,render:'float:2', style:"text-align:right"},
                { field: 'retur', caption: 'retur', size: '100px', sortable: false, render:'float:2',style:"text-align:right"},
                { field: 'subtotal', caption: 'Subtotal', size: '100px',render:'float:2', sortable: false, style:"text-align:right" },
                { field: 'diskon', caption: 'Diskon', size: '100px', sortable: false, render:'float:2',style:"text-align:right"},
                { field: 'pembulatan', caption: 'Pembulatan', size: '100px', sortable: false, render:'float:2',style:"text-align:right"},
                { field: 'uangmuka', caption: 'Uang Muka', size: '100px', sortable: false, render:'float:2',style:"text-align:right"},
                { field: 'kasbank', caption: 'Kas/Bank', size: '100px', sortable: false, render:'float:2',style:"text-align:right"},
                { field: 'ketrekkasbank', caption: 'Rek Kas/Bank', size: '100px', sortable: false},
                { field: 'cmdPreview', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.rptpelunasanpiutang.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptpelunasanpiutang.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptpelunasanpiutang.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptpelunasanpiutang.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptpelunasanpiutang.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }


    bos.rptpelunasanpiutang.cmdpreviewdetail	= function(faktur){
        //$("#modal-preview").html("");
        //alert("lasjdlasd");
        //bjs.ajax(bos.rptpembelianstock.url + '/PreviewDetailPembelianStock/'+ faktur);
        bjs.ajax(this.url + '/PreviewDetail', 'faktur=' + faktur);
    }

    bos.rptpelunasanpiutang.cmdrefresh          = bos.rptpelunasanpiutang.obj.find("#cmdrefresh") ;
    bos.rptpelunasanpiutang.cmdpreview     = bos.rptpelunasanpiutang.obj.find("#cmdpreview")
    bos.rptpelunasanpiutang.cmdCetakLaporanDetail     = bos.rptpelunasanpiutang.obj.find("#cmdCetakLaporanDetail") ;
    bos.rptpelunasanpiutang.initfunc    = function(){
        this.obj.find("#cmdpreview").on("click", function(e){
            e.preventDefault() ;
            bos.rptpelunasanpiutang.initreportTotal(0,0) ;
        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptpelunasanpiutang.grid1_reloadData() ;
        }) ;
        this.obj.find("#cmdCetakLaporanDetail").on("click",function(e){
            e.preventDefault() ;
            bos.rptpelunasanpiutang.initReportDetailPembelian(0,0) ;
        });
    }

    bos.rptpelunasanpiutang.initReportDetailPembelian  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpelunasanpiutang.loadmodalpreview      = function(l){
        this.obj.find("#wrap-preview-detail-d").modal(l) ;
    }

    bos.rptpelunasanpiutang.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.rptpelunasanpiutang.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptpelunasanpiutang.grid1_destroy() ;
            bos.rptpelunasanpiutang.grid2_destroy() ;
            bos.rptpelunasanpiutang.grid2_destroy() ;
        }) ;
    }

    bos.rptpelunasanpiutang.setPreview      = function(cFaktur){
        //e.preventDefault() ;
        //bos.rptpembelianstock.cmdview.button('loading') ;
        bos.rptpelunasanpiutang.initreport(0,0) ;
    }

    bos.rptpelunasanpiutang.initreport  = function(s,e){
        //bjs.initprogress(this.obj.find("#progress_1"),s,e) ;
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpelunasanpiutang.initreportTotal  = function(s,e){
        //bjs.initprogress(this.obj.find("#progress_1"),s,e) ;
        bjs.ajax(this.base_url+ '/initreportTotal', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpelunasanpiutang.openreport  = function(){
        // bos.rptkartustock.cmdview.button('reset') ;
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptpelunasanpiutang.openreporttotal  = function(){
        // bos.rptkartustock.cmdview.button('reset') ;
        bjs_os.form_report( this.base_url + '/showreporttotal' ) ;
    }

    bos.rptpelunasanpiutang.grid2_data    = null ;
    bos.rptpelunasanpiutang.grid2_loaddata= function(){
        this.grid2_data         = {} ;
    }


    bos.rptpelunasanpiutang.grid2_load    = function(){
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
                { field: 'fkt', caption: 'Faktur', size: '150px', sortable: false ,style:'text-align:center'},
                { field: 'jumlah', render: 'int', caption: 'Pelunasan', size: '100px', sortable: false, style:'text-align:right' },
                { field: 'jenis', caption: 'Jenis', size: '150px', sortable: false, style:'text-align:center'}
            ]
        });
    }

    bos.rptpelunasanpiutang.grid2_reload     = function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptpelunasanpiutang.grid2_destroy    = function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptpelunasanpiutang.grid2_render     = function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptpelunasanpiutang.grid2_reloaddata = function(){
        this.grid2_reload() ;
    }

    $(function(){
        bos.rptpelunasanpiutang.initcomp() ;
        bos.rptpelunasanpiutang.initcallback() ;
        bos.rptpelunasanpiutang.initfunc() ;
    });
</script>