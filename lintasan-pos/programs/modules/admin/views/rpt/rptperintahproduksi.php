<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Perintah Produksi</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptperintahproduksi.close()">
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
                        <h4 class="modal-title" id="wm-title">Preview Detail Perintah Produksi</h4>
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
                                    <label>Tgl</label>
                                    <input type="text" name="tgl" id="tgl" readonly = true class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Perbaikan</label>
                                    <input type="text" name="perbaikan" id="perbaikan" readonly = true class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="grid2" style="height:250px"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="text" name="stock" id="stock" class="form-control" placeholder="Kode Stock" readonly = true>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Stock</label>
                                <input type="text" name="namastock" id="namastock" class="form-control" placeholder="Nama Stock" readonly = true>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Qty</label>
                                <input maxlength="10" type="text" name="qty" id="qty" class="form-control number" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan" readonly = true>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>BB</label>
                                <input maxlength="10" type="text" name="bb" id="bb" class="form-control number" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>BTKL</label>
                                <input maxlength="10" type="text" name="btkl" id="btkl" class="form-control number" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>BOP</label>
                                <input maxlength="10" type="text" name="bop" id="bop" class="form-control number" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>HP. Pebaikan</label>
                                <input maxlength="10" type="text" name="hpperbaikan" id="hpperbaikan" class="form-control number" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jml. Perbaikan</label>
                                <input maxlength="10" type="text" name="jmlperbaikan" id="jmlperbaikan" class="form-control number" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>HP</label>
                                <input maxlength="10" type="text" name="hp" id="hp" class="form-control number" value="0" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input maxlength="10" type="text" name="jumlah" id="jumlah" class="form-control number" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br/>
                                    <button type = "button" class="btn btn-success" id="cmdCetakLaporanDetail">Print Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    <?=cekbosjs();?>


    //grid daftar pembelian
    bos.rptperintahproduksi.grid1_data    = null ;
    bos.rptperintahproduksi.grid1_loaddata= function(){
        var tglAwal = bos.rptperintahproduksi.obj.find("#tglawal").val();
        var tglAkhir = bos.rptperintahproduksi.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglAwal':tglAwal,'tglAkhir':tglAkhir} ;
    }

    bos.rptperintahproduksi.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptperintahproduksi.base_url + "/loadgrid",
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
                { field: 'bb', render: 'int' ,caption: 'BB', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'btkl', render: 'int' ,caption: 'BTKL', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'bop', render: 'int' ,caption: 'BOP', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'hargapokok', render: 'int' ,caption: 'Harga Pokok', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'cmdPreview', caption: ' ', size: '120px', sortable: false }
            ]
        });
    }

    bos.rptperintahproduksi.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptperintahproduksi.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptperintahproduksi.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptperintahproduksi.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptperintahproduksi.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }


    bos.rptperintahproduksi.cmdpreviewdetail	= function(faktur){
        bjs.ajax(this.url + '/PreviewDetail', 'faktur=' + faktur);
    }

    bos.rptperintahproduksi.cmdrefresh          = bos.rptperintahproduksi.obj.find("#cmdrefresh") ;
    bos.rptperintahproduksi.cmdpreview     = bos.rptperintahproduksi.obj.find("#cmdpreview")
    bos.rptperintahproduksi.cmdCetakLaporanDetail     = bos.rptperintahproduksi.obj.find("#cmdCetakLaporanDetail") ;
    bos.rptperintahproduksi.initfunc    = function(){
        this.obj.find("#cmdpreview").on("click", function(e){
            e.preventDefault() ;
            bos.rptperintahproduksi.initreportTotal(0,0) ;
        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptperintahproduksi.grid1_reloadData() ;
        }) ;
        this.obj.find("#cmdCetakLaporanDetail").on("click",function(e){
            e.preventDefault() ;
            bos.rptperintahproduksi.initReportDetailPP(0,0) ;
        });
    }

    bos.rptperintahproduksi.initReportDetailPP  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptperintahproduksi.loadmodalpreview      = function(l){
        this.obj.find("#wrap-preview-detail-d").modal(l) ;
    }

    bos.rptperintahproduksi.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
    }

    bos.rptperintahproduksi.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptperintahproduksi.grid1_destroy() ;
            bos.rptperintahproduksi.grid2_destroy() ;
            bos.rptperintahproduksi.grid2_destroy() ;
        }) ;
    }

    bos.rptperintahproduksi.setPreview      = function(cFaktur){
        bos.rptperintahproduksi.initreport(0,0) ;
    }

    bos.rptperintahproduksi.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptperintahproduksi.initreportTotal  = function(s,e){
        bjs.ajax(this.base_url+ '/initreportTotal', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptperintahproduksi.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptperintahproduksi.openreporttotal  = function(){
        bjs_os.form_report( this.base_url + '/showreporttotal' ) ;
    }

    bos.rptperintahproduksi.grid2_data    = null ;
    bos.rptperintahproduksi.grid2_loaddata= function(){
        this.grid2_data         = {} ;
    }


    bos.rptperintahproduksi.grid2_load    = function(){
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
                { field: 'qty', render: 'float:2', caption: 'Qty', size: '40px', sortable: false, style:'text-align:center'},
                { field: 'satuan', caption: 'Satuan', size: '80px', sortable: false, style:'text-align:left'},
                { field: 'hp', render: 'float:2', caption: 'HP', size: '100px', sortable: false, style:'text-align:right' },
                { field: 'jmlhp', render: 'float:2', caption: 'Jml HP', size: '100px', sortable: false, style:'text-align:right' },
                { field: 'totqty', render: 'float:2', caption: 'Tot Qty', size: '100px', sortable: false, style:'text-align:right'}
            ]
        });
    }

    bos.rptperintahproduksi.grid2_reload     = function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptperintahproduksi.grid2_destroy    = function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptperintahproduksi.grid2_render     = function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptperintahproduksi.grid2_reloaddata = function(){
        this.grid2_reload() ;
    }

    $(function(){
        bos.rptperintahproduksi.initcomp() ;
        bos.rptperintahproduksi.initcallback() ;
        bos.rptperintahproduksi.initfunc() ;
    });
</script>