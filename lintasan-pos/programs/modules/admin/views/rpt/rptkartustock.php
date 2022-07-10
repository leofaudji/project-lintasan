<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Kartu Stock</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptkartustock.close()">
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
                    <td width="80px"><label for="stock">stock</label> </td>
                    <td width="20px">:</td>
                    <td colspan='2'> 
                        <div class="input-group">
                            <input type="text" id="stock" name="stock" class="form-control" placeholder="Produk">
                            <span class="input-group-btn">
                                <button class="form-control btn btn-info" type="button" id="cmdstock"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </td>
                    <td >Nama : </td>
                    <td colspan='3'>
                        <input type="text" id="namastock" readonly name="namastock" class="form-control" placeholder="Nama Stock">
                    </td>
                </tr>
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
    </form>
</div>
<div class="modal fade" id="wrap-pencarianstock-d" role="dialog" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wm-title">Daftar Produk</h4>
            </div>
            <div class="modal-body">
                <div id="grid2" style="height:250px"></div>
            </div>
            <div class="modal-footer">
                *Pilih Stock
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>


    //grid daftar pembelian
    bos.rptkartustock.grid1_data    = null ;
    bos.rptkartustock.grid1_loaddata= function(){
        var tglAwal = bos.rptkartustock.obj.find("#tglawal").val();
        var tglAkhir = bos.rptkartustock.obj.find("#tglakhir").val();
        var stock = bos.rptkartustock.obj.find("#stock").val();
        this.grid1_data 		= {'tglAwal':tglAwal,'tglAkhir':tglAkhir,'stock':stock} ;
    }

    bos.rptkartustock.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptkartustock.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false, style:"text-align:right"},
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false , style:"text-align:left"},
                { field: 'debet', render: 'float:2' ,caption: 'Debet', size: '100px', sortable: false, style:"text-align:right" },
                { field: 'kredit', render: 'float:2' ,caption: 'Kredit', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'saldo', render: 'float:2' ,caption: 'Saldo', size: '100px', sortable: false, style:"text-align:right"},
				{ field: 'hp', render: 'float:2' ,caption: 'HP', size: '100px', sortable: false, style:"text-align:right"}
            ]
        });
    }

    bos.rptkartustock.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptkartustock.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptkartustock.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptkartustock.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptkartustock.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }
    
    //grid2 daftarstock
    bos.rptkartustock.grid2_data    = null ;
    bos.rptkartustock.grid2_loaddata= function(){
        this.grid2_data 		= {} ;
    }

    bos.rptkartustock.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            limit 	: 100 ,
            url 	: bos.rptkartustock.base_url + "/loadgrid2",
            postData: this.grid3_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false },
                { field: 'satuan', caption: 'Satuan', size: '100px', sortable: false },
                { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.rptkartustock.grid2_setdata	= function(){
        w2ui[this.id + '_grid2'].postData 	= this.grid2_data ;
    }
    bos.rptkartustock.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptkartustock.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptkartustock.grid2_render 	= function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptkartustock.grid2_reloaddata	= function(){
        this.grid2_loaddata() ;
        this.grid2_setdata() ;
        this.grid2_reload() ;
    }
    
    bos.rptkartustock.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
    }
    
    bos.rptkartustock.obj.find("#cmdview").on("click", function(){
		bos.rptkartustock.initreport();
	}) ; 

    bos.rptkartustock.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    bos.rptkartustock.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptkartustock.cmdrefresh          = bos.rptkartustock.obj.find("#cmdrefresh") ;
    bos.rptkartustock.initfunc    = function(){
        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptkartustock.grid1_reloadData() ;
        }) ;
        
        this.obj.find("#cmdstock").on("click", function(e){
            bos.rptkartustock.loadmodelstock("show");
            bos.rptkartustock.grid2_reloaddata() ;
        }) ;
        
        this.obj.find("#stock").on("blur", function(e){
            if(bos.rptkartustock.obj.find("#stock").val() !== ""){
                var stock = bos.rptkartustock.obj.find("#stock").val();
                bjs.ajax( bos.rptkartustock.base_url + '/seekstock', bjs.getdataform(this)) ;
            }
        });

    }

    bos.rptkartustock.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_load() ;
        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
    }

    bos.rptkartustock.loadmodelstock      = function(l){
        this.obj.find("#wrap-pencarianstock-d").modal(l) ;
    }
    bos.rptkartustock.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptkartustock.grid1_destroy() ;
            bos.rptkartustock.grid2_destroy() ;
        }) ;
    }

    $(function(){
        bos.rptkartustock.initcomp() ;
        bos.rptkartustock.initcallback() ;
        bos.rptkartustock.initfunc() ;
    });
</script>