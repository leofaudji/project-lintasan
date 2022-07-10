<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Surat Jalan</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr>
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptsj.close()">
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
                        <h4 class="modal-title" id="wm-title">Preview Detail Surat Jalan</h4>
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
                                    <label>Faktur DO</label>
                                    <input type="text" name="fakturdo" id="fakturdo" class="form-control" placeholder="faktur" readonly = true>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Supir</label>
                                    <input type="text" name="petugaspengirim" id="petugaspengirim" class="form-control" placeholder="Supir" readonly = true>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kernet</label>
                                    <input type="text" name="kernet" id="kernet" class="form-control" placeholder="Kernet" readonly = true>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No Pol</label>
                                    <input type="text" name="nopol" id="nopol" class="form-control" placeholder="No Pol" readonly = true>
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
                                    <button type = "button" class="btn btn-success" id="cmdCetakLaporanDetail">Print Reports</button>
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


    //grid daftar sj
    bos.rptsj.grid1_data    = null ;
    bos.rptsj.grid1_loaddata= function(){
        var tglAwal = bos.rptsj.obj.find("#tglawal").val();
        var tglAkhir = bos.rptsj.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglAwal':tglAwal,'tglAkhir':tglAkhir} ;
    }

    bos.rptsj.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptsj.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'do', caption: 'Faktur DO', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'customer', caption: 'Customer', size: '100px', sortable: false , style:"text-align:left"},
                { field: 'petugaspengirim', caption: 'Supir', size: '100px', sortable: false , style:"text-align:left"},
                { field: 'kernet', caption: 'Kernet', size: '100px', sortable: false , style:"text-align:left"},
                { field: 'nopol', caption: 'No Pol', size: '100px', sortable: false , style:"text-align:left"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'cmdPreview', caption: ' ', size: '120px', sortable: false }
            ]
        });
    }

    bos.rptsj.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptsj.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptsj.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptsj.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptsj.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }


    bos.rptsj.cmdpreviewdetail	= function(faktur){
        bjs.ajax(this.url + '/PreviewDetail', 'faktur=' + faktur);
    }
	
	//cetak dot matrix
	bos.rptsj.cmdcetakdm 	= function(){
        if(confirm("Cetak data?")){
            var faktur = bos.rptsj.obj.find("#faktur").val();
            bjs.ajax(this.url + '/cetakdm', 'faktur=' + faktur);
        }
    }

    bos.rptsj.cmdrefresh          = bos.rptsj.obj.find("#cmdrefresh") ;
    bos.rptsj.cmdpreview     = bos.rptsj.obj.find("#cmdpreview")
    bos.rptsj.cmdCetakLaporanDetail     = bos.rptsj.obj.find("#cmdCetakLaporanDetail") ;
    bos.rptsj.initfunc    = function(){
        this.obj.find("#cmdpreview").on("click", function(e){
            e.preventDefault() ;
            bos.rptsj.initreportTotal(0,0) ;
        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptsj.grid1_reloadData() ;
        }) ;
        this.obj.find("#cmdCetakLaporanDetail").on("click",function(e){
            e.preventDefault() ;
            bos.rptsj.initReportDetailPembelian(0,0) ;
        });
		
		this.obj.find("#cmdcetakdm").on("click", function(e){
            bos.rptsj.cmdcetakdm();
        }) ;
    }

    bos.rptsj.initReportDetailPembelian  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptsj.loadmodalpreview      = function(l){
        this.obj.find("#wrap-preview-detail-d").modal(l) ;
    }

    bos.rptsj.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
    }

    bos.rptsj.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptsj.grid1_destroy() ;
            bos.rptsj.grid2_destroy() ;
        }) ;
    }

    bos.rptsj.setPreview      = function(cFaktur){
        bos.rptsj.initreport(0,0) ;
    }

    bos.rptsj.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptsj.initreportTotal  = function(s,e){
        bjs.ajax(this.base_url+ '/initreportTotal', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptsj.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptsj.openreporttotal  = function(){
        bjs_os.form_report( this.base_url + '/showreporttotal' ) ;
    }

    bos.rptsj.grid2_data    = null ;
    bos.rptsj.grid2_loaddata= function(){
        this.grid2_data         = {} ;
    }


    bos.rptsj.grid2_load    = function(){
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

    bos.rptsj.grid2_reload     = function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptsj.grid2_destroy    = function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptsj.grid2_render     = function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptsj.grid2_reloaddata = function(){
        this.grid2_reload() ;
    }

    $(function(){
        bos.rptsj.initcomp() ;
        bos.rptsj.initcallback() ;
        bos.rptsj.initfunc() ;
    });
</script>