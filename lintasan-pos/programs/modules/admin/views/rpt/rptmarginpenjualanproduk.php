<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Margin Penjualan Produk</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptmarginpenjualanproduk.close()">
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
                    <td width="80px"><label for="tgl">Antara Tgl</label> </td>
                    <td width="20px">:</td>
                    <td width="100px"> 
                        <input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                    </td>
                    <td width="50px"><label for="tgl">sd</label> </td>
                    <td width="100px"> 
                        <input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                    </td>
                    <td width="100px">
                        <button class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
                    </td>
					<td width="100px">
                        <button type="button" class="btn btn-primary pull-right" id="cmdpreview">Preview</button>
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
    </form>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>


    //grid daftar pembelian
    bos.rptmarginpenjualanproduk.grid1_data    = null ;
    bos.rptmarginpenjualanproduk.grid1_loaddata= function(){
        var tglawal = bos.rptmarginpenjualanproduk.obj.find("#tglawal").val();
		var tglakhir = bos.rptmarginpenjualanproduk.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,
									'tglakhir':tglakhir
                                  } ;
    }

    bos.rptmarginpenjualanproduk.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptmarginpenjualanproduk.base_url + "/loadgrid",
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
                { field: 'satuan', caption: 'Satuan', size: '70px', sortable: false , style:"text-align:left"},
                { field: 'penjualan', render: 'float:2' ,caption: 'Penjualan', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'hpp', render: 'float:2' ,caption: 'HPP', size: '100px', sortable: false,style:"text-align:right"},
				{ field: 'margin', render: 'float:2' ,caption: 'Margin', size: '100px', sortable: false,style:"text-align:right"},
				{ field: 'persmargin', render: 'float:2' ,caption: '% Mrg', size: '50px', sortable: false,style:"text-align:right"}
            ]
        });
    }

    bos.rptmarginpenjualanproduk.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptmarginpenjualanproduk.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptmarginpenjualanproduk.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptmarginpenjualanproduk.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptmarginpenjualanproduk.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }
    bos.rptmarginpenjualanproduk.obj.find("#cmdpreview").on("click", function(){
		bos.rptmarginpenjualanproduk.initreport();
	}) ;
	bos.rptmarginpenjualanproduk.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
	bos.rptmarginpenjualanproduk.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }
    bos.rptmarginpenjualanproduk.cmdrefresh          = bos.rptmarginpenjualanproduk.obj.find("#cmdrefresh") ;
    bos.rptmarginpenjualanproduk.initfunc    = function(){
        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptmarginpenjualanproduk.grid1_reloadData() ;
        }) ;
    }

    bos.rptmarginpenjualanproduk.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.rptmarginpenjualanproduk.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptmarginpenjualanproduk.grid1_destroy() ;

        }) ;
    }
	

    $(function(){
        bos.rptmarginpenjualanproduk.initcomp() ;
        bos.rptmarginpenjualanproduk.initcallback() ;
        bos.rptmarginpenjualanproduk.initfunc() ;
    });
</script>