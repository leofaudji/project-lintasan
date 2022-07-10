<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                Cetak Struk Penjualan
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trcetakstrukpenjualan.close()">
                                <img src="./uploads/titlebar/close.png">
                            </div>
                        </td>
                    </tr>
                </table>
            </td> 
        </tr>
    </table> 
</div><!-- end header -->
<form novalidate>
<div class="body">

        <div class="bodyfix scrollme" style="height:100%">
            <div class="tab-content full-height">
                <div> 
                    <table width="100%">
                        <tr>
                            <td height="25px" width="100%">
                                <table class="osxtable form">
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
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height='300px'>
                                <div id="grid1" class="full-height"></div>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

</div>
<div class="modal fade" id="wrap-detailpenjualankasir-d" role="dialog" data-backdrop="false" data-keyboard="false">
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
                          <input type="text" name="faktur" id="faktur" class="form-control" placeholder="faktur" readonly = true>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Tgl</label>
                          <input type="text" name="tgl" id="tgl" readonly = true class="form-control date">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div id="grid2" style="height:150px"></div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Total</label>
                          <input type="text" style = "text-align:right" name="total" id="total" class="form-control" placeholder="0.00" readonly = true required>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Diskon</label>
                          <input type="text" style = "text-align:right" name="diskonnom" id="diskonnom" class="form-control" placeholder="0.00" required>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Bayar</label>
                          <input type="text" style = "text-align:right" name="bayar" id="bayar" class="form-control" placeholder="0.00" required>
                      </div>
                  </div>
                  <div class="col-md-4">
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
                          <button type = "button" class="btn btn-primary" id="cmdcetak">Cetak</button>
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
<script type="text/javascript">
    <?=cekbosjs();?>

    //grid daftar penjualankasir
    bos.trcetakstrukpenjualan.grid1_data    = null ;
    bos.trcetakstrukpenjualan.grid1_loaddata= function(){
        var tglawal = bos.trcetakstrukpenjualan.obj.find("#tglawal").val();
        var tglakhir = bos.trcetakstrukpenjualan.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trcetakstrukpenjualan.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trcetakstrukpenjualan.base_url + "/loadgrid",
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
                { field: 'subtotal', render:'int', caption: 'Subtotal', size: '100px', sortable: false, style:"text-align:right" },
                { field: 'total', render:'int', caption: 'Total', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'diskon', render:'int', caption: 'Diskon', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'bayar', render:'int', caption: 'Bayar', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'piutang', render:'int', caption: 'Piutang', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'kembalian',render:'int', caption: 'Kembalian', size: '100px', sortable: false, style:"text-align:right"},
                { field: 'cmddetail', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trcetakstrukpenjualan.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trcetakstrukpenjualan.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trcetakstrukpenjualan.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trcetakstrukpenjualan.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trcetakstrukpenjualan.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid daftar detail penjualankasir
    bos.trcetakstrukpenjualan.grid2_data    = null ;
    bos.trcetakstrukpenjualan.grid2_loaddata= function(){
        this.grid2_data 		= {} ;
    }


    bos.trcetakstrukpenjualan.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            show: {
                footer 		: false,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'no', caption: 'No', size: '30px', sortable: false},
	            { field: 'stock', caption: 'Stock', size: '100px', sortable: false },
                { field: 'namastock', caption: 'Nama Stock', size: '200px', sortable: false },
                { field: 'harga', caption: 'Harga', size: '70px', sortable: false,render:'int',style:'text-align:right'},
                { field: 'qty', caption: 'Qty', size: '45px', sortable: false,render:'int',style:'text-align:right'},
                { field: 'diskon', caption: 'diskon', size: '70px', sortable: false,render:'int',style:'text-align:right'},
                { field: 'satuan', caption: 'Satuan', size: '70px', sortable: false},
                { field: 'jumlah', caption: 'Jumlah', size: '70px', sortable: false,render:'int',style:'text-align:right'}
	        ],
            records:[{
                recid:'ZZZZ',no: '', stock: '', namastock: '', harga: '', qty: '', satuan:'',jumlah:'0.00',w2ui:{summary: true}
            }]
        });
    }

    bos.trcetakstrukpenjualan.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.trcetakstrukpenjualan.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trcetakstrukpenjualan.grid2_render 	= function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.trcetakstrukpenjualan.grid2_reloaddata	= function(){
        this.grid2_reload() ;
    }

    bos.trcetakstrukpenjualan.grid2_sumtotal = function(){
        var nRows = w2ui[this.id + '_grid2'].records.length;
        var TotJumlah = 0 ;
        for(i=0;i< nRows;i++){
            var jumlah = w2ui[this.id + '_grid2'].getCellValue(i,7);
            TotJumlah += Number(jumlah);
        }
        w2ui[this.id + '_grid2'].set('ZZZZ',{jumlah:TotJumlah});
    }


    bos.trcetakstrukpenjualan.initfunc	   = function(){

    }

    bos.trcetakstrukpenjualan.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.grid2_load() ;
        bjs.initdate("#" + this.id + " .date") ;
        bjs.initenter(this.obj.find("form")) ;
    }

    bos.trcetakstrukpenjualan.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.trcetakstrukpenjualan.grid1_destroy() ;
            bos.trcetakstrukpenjualan.grid2_destroy() ;
        }) ;
    }

    bos.trcetakstrukpenjualan.loadmodeldetail     = function(l){
      this.obj.find("#wrap-detailpenjualankasir-d").modal(l) ;
    }
    bos.trcetakstrukpenjualan.cmddetail = function(faktur){
         bjs.ajax(this.url + '/detailpenjualan', 'faktur=' + faktur);
    }
    bos.trcetakstrukpenjualan.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }

    }
    bos.trcetakstrukpenjualan.initfunc = function(){
         this.obj.find("#cmdrefresh").on("click", function(e){
             bos.trcetakstrukpenjualan.grid1_reloaddata();
         });

        this.obj.find("#cmdcetak").on("click", function(e){
             bjs.ajax( bos.trcetakstrukpenjualan.base_url + '/cetakstruk', bjs.getdataform(bos.trcetakstrukpenjualan.obj.find("form"))) ;
         });
    }
    $(function(){
        bos.trcetakstrukpenjualan.initcomp() ;
        bos.trcetakstrukpenjualan.initcallback() ;
        bos.trcetakstrukpenjualan.initfunc() ;
    });

</script>