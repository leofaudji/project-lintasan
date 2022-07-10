<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Penjualan</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptpenjualan.close()">
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
                        <button type = "button" class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
                    </td>
                    <td width="100px">	
                        <button type = "button" class="btn btn-primary pull-right" id="cmdpreview">Preview</button>  
                    </td>
                    <td></td>
                </tr>  
                <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
            </table> 
            <div class="row" style="height: calc(100% - 50px);"> 
                <div id="gridpenjualankasir" class="col-sm-12 full-height">

                </div>  
            </div> 
        </div>
        <div class="modal fade" id="wrap-detailpenjualankasir-d" style="position:absolute;" role="dialog" data-backdrop="false" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="wm-title">Detail Penjualan</h4>
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
                                    <label>Tgl</label>
                                    <input type="text" name="tgl" id="tgl" readonly = true class="form-control date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fkt. SJ</label>
                                    <input type="text" name="sj" id="sj" readonly = true class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <input type="text" name="customer" id="customer" readonly = true class="form-control date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Penjualan Barang</label>
                                    <div id="grid2" style="height:250px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Subtotal</label>
                                    <input type="text" style = "text-align:right" name="total" id="total" class="form-control" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Diskon</label>
                                    <input type="text" style = "text-align:right" name="diskonnom" id="diskonnom" class="form-control" placeholder="0.00" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bayar</label>
                                    <input type="text" style = "text-align:right" name="bayar" id="bayar" class="form-control" placeholder="0.00" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kembalian</label>
                                    <input type="text" style = "text-align:right" name="kembalian" id="kembalian" class="form-control" placeholder="0.00" readonly = true required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br/>
                                    <button type = "button" class="btn btn-success" id="cmdCetakLaporanDetail">Cetak Detail</button>
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
    bos.rptpenjualan.gridpenjualankasir_data    = null ;
    bos.rptpenjualan.gridpenjualankasir_loaddata= function(){
      var tglawal = bos.rptpenjualan.obj.find("#tglawal").val();
      var tglakhir = bos.rptpenjualan.obj.find("#tglakhir").val();
      this.gridpenjualankasir_data         = {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.rptpenjualan.gridpenjualankasir_load    = function(){
        this.obj.find("#gridpenjualankasir").w2grid({
            name    : this.id + '_gridpenjualankasir',
            limit   : 100 ,
            url     : bos.rptpenjualan.base_url + "/loadgrid",
            postData: this.gridpenjualankasir_data ,
            show: {
                footer      : false,
                toolbar     : true,
                toolbarColumns  : false
            },
            multiSearch     : false,
            columns: [
                { field: 'no', caption: 'No.', size: '50px', sortable: false, style:"text-align:center"},
                { field: 'faktur', caption: 'Faktur', size: '100px', sortable: false, style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'customer', caption: 'Customer', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'subtotal', caption: 'Sub Total', render: 'int', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'diskonnom', caption: 'Diskon', render: 'int', size: '100px', sortable: false },
                { field: 'total', caption: 'Total', render: 'int', size: '100px', sortable: false },
                { field: 'tothpp', caption: 'HPP', render: 'int', size: '100px', sortable: false },
                { field: 'totlaba', caption: 'Laba', render: 'int', size: '100px', sortable: false },
                { field: 'perslaba', caption: '%Laba', render: 'int', size: '70px', sortable: false },
                { field: 'cmdPreviewDetail', caption: ' ', size: '120px', sortable: false }
            ]
        });
    }


    bos.rptpenjualan.gridpenjualankasir_setdata = function(){
        w2ui[this.id + '_gridpenjualankasir'].postData   = this.gridpenjualankasir_data ;
    }

    bos.rptpenjualan.gridpenjualankasir_reload      = function(){
        w2ui[this.id + '_gridpenjualankasir'].reload() ;
    }

    bos.rptpenjualan.gridpenjualankasir_destroy     = function(){
        if(w2ui[this.id + '_gridpenjualankasir'] !== undefined){
            w2ui[this.id + '_gridpenjualankasir'].destroy() ;
        }
    }

    bos.rptpenjualan.gridpenjualankasir_render  = function(){
        this.obj.find("#gridpenjualankasir").w2render(this.id + '_gridpenjualankasir') ;
    }

    bos.rptpenjualan.gridpenjualankasir_reloadData  = function(){
        this.gridpenjualankasir_loaddata() ;
        this.gridpenjualankasir_setdata() ;
        this.gridpenjualankasir_reload() ;
    }

    bos.rptpenjualan.initcomp      = function(){
        this.gridpenjualankasir_loaddata() ;
        this.gridpenjualankasir_load() ;
        this.grid2_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
    }

    bos.rptpenjualan.cmdPreview                        = bos.rptpenjualan.obj.find("#cmdpreview");
    bos.rptpenjualan.cmdRefresh                        = bos.rptpenjualan.obj.find("#cmdrefresh") ;
    bos.rptpenjualan.cmdCetakLaporanDetail             = bos.rptpenjualan.obj.find("#cmdCetakLaporanDetail") ;
    bos.rptpenjualan.initfunc    = function(){
        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptpenjualan.gridpenjualankasir_reloadData() ;
        }) ;

        this.obj.find("#cmdpreview").on("click",function(e){
          e.preventDefault() ;
          bos.rptpenjualan.initReportTotal(0,0) ;
        });

        this.obj.find("#cmdCetakLaporanDetail").on("click",function(e){
            e.preventDefault() ;
            bos.rptpenjualan.initReportDetailPenjualan(0,0) ;
        });
		
		this.obj.find("#cmdcetakdm").on("click", function(e){
            bos.rptpenjualan.cmdcetakdm();
        }) ;

        this.obj.find("#cmdCetakLaporanDetailPerdana").on("click",function(e){
            e.preventDefault() ;
            bos.rptpenjualan.initReportDetailPenjualanPerdana(0,0) ;
        });
    }

    bos.rptpenjualan.initReportTotal  = function(s,e){
        bjs.ajax(this.base_url+ '/initReportTotal', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpenjualan.initReportDetailPenjualan  = function(s,e){
        bjs.ajax(this.base_url+ '/initReportDetailPenjualan', bjs.getdataform(this.obj.find("form"))) ;
    }

    bos.rptpenjualan.cmdPreviewDetail = function(faktur){
        bjs.ajax(this.url + '/detailpenjualan', 'faktur=' + faktur);
    }
	
	//cetak dot matrix
	bos.rptpenjualan.cmdcetakdm 	= function(){
        if(confirm("Cetak data?")){
            var faktur = bos.rptpenjualan.obj.find("#faktur").val();
            bjs.ajax(this.url + '/cetakdm', 'faktur=' + faktur);
		}
	}

    bos.rptpenjualan.loadmodeldetail     = function(l){
      this.obj.find("#wrap-detailpenjualankasir-d").modal(l) ;
    }
/*********************************************************************************************************************************/
    bos.rptpenjualan.grid2_data    = null ;
    bos.rptpenjualan.grid2_loaddata= function(){
        this.grid2_data         = {} ;
    }


    bos.rptpenjualan.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name    : this.id + '_grid2',
            show: {
                footer      : false,
                toolbar     : false,
                toolbarColumns  : false
            },
            multiSearch     : false,
            columns: [
                { field: 'no', caption: 'No', size: '30px', sortable: false},
                { field: 'stock', caption: 'Stock', size: '100px', sortable: false },
                { field: 'namastock', caption: 'Nama Stock', size: '200px', sortable: false },
                { field: 'harga', render: 'int',caption: 'Harga', size: '70px', sortable: false,style:'text-align:right'},
                { field: 'diskon', render: 'int',caption: 'Diskon', size: '70px', sortable: false,style:'text-align:right'},
                { field: 'qty', render: 'int' , caption: 'Qty', size: '45px', sortable: false,style:'text-align:right'},
                { field: 'satuan', caption: 'Satuan', size: '70px', sortable: false},
                { field: 'jumlah', render: 'int' ,caption: 'Jumlah', size: '70px', sortable: false,style:'text-align:right'},
                { field: 'hpp', render: 'int' ,caption: 'HPP', size: '70px', sortable: false,style:'text-align:right'},
                { field: 'laba', render: 'int' ,caption: 'Laba', size: '70px', sortable: false,style:'text-align:right'},
                { field: 'perslaba', render: 'int' ,caption: '%Laba', size: '70px', sortable: false,style:'text-align:right'}
            ],
            records:[{
                recid:'ZZZZ',no: '', stock: '', namastock: '', harga: '', qty: '', satuan:'',jumlah:'0.00',w2ui:{summary: true}
            }]
        });
    }

    bos.rptpenjualan.grid2_reload     = function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptpenjualan.grid2_destroy    = function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptpenjualan.grid2_render     = function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptpenjualan.grid2_reloaddata = function(){
        this.grid2_reload() ;
    }

    bos.rptpenjualan.grid2_sumtotal = function(){
        var nRows = w2ui[this.id + '_grid2'].records.length;
        var TotJumlah = 0 ;
        var tothpp = 0 ;
        for(i=0;i< nRows;i++){
            var jumlah = w2ui[this.id + '_grid2'].getCellValue(i,7);
            var hpp = w2ui[this.id + '_grid2'].getCellValue(i,8);
            TotJumlah += Number(jumlah);
            tothpp += Number(hpp);
        }
        var totlaba = TotJumlah - tothpp;
        var perslaba = totlaba / TotJumlah * 100;
        w2ui[this.id + '_grid2'].set('ZZZZ',{jumlah:TotJumlah,hpp:tothpp,laba:totlaba,perslaba:perslaba});
    }

   bos.rptpenjualan.initcallback = function(){
        this.obj.on('remove', function(){
            bos.rptpenjualan.gridpenjualankasir_destroy() ;
            bos.rptpenjualan.grid2_destroy() ;
        }) ;
    }

    bos.rptpenjualan.OpenReportDetail = function(){
      bjs_os.form_report( this.base_url + '/ShowReportDetail' ) ;
    }

    bos.rptpenjualan.OpenReportTotal = function(){
      bjs_os.form_report( this.base_url + '/ShowReportTotal' ) ;
    }

    $(function(){
        bos.rptpenjualan.initcomp() ;
        bos.rptpenjualan.initcallback() ;
        bos.rptpenjualan.initfunc() ;
    })

</script>