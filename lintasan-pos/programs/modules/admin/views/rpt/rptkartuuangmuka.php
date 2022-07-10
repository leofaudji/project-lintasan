<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Kartu Piutang</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptkartuuangmuka.close()">
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
                    <td width="80px"><label for="customer">Custome</label> </td>
                    <td width="20px">:</td>
                    <td colspan='2'> 
                        <div class="input-group">
                            <input type="text" id="customer" name="customer" class="form-control" placeholder="Customer">
                            <span class="input-group-btn">
                                <button class="form-control btn btn-info" type="button" id="cmdcustomer"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </td>
                    <td >Nama : </td>
                    <td colspan='2'>
                        <input type="text" id="namacustomer" readonly name="namacustomer" class="form-control" placeholder="Nama Customer">
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
<div class="modal fade" id="wrap-pencariancustomer-d" role="dialog" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="wm-title">Daftar Customer</h4>
            </div>
            <div class="modal-body">
                <div id="grid2" style="height:250px"></div>
            </div>
            <div class="modal-footer">
                *Pilih Customer
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>


    //grid kartu
    bos.rptkartuuangmuka.grid1_data    = null ;
    bos.rptkartuuangmuka.grid1_loaddata= function(){
        var tglAwal = bos.rptkartuuangmuka.obj.find("#tglawal").val();
        var tglAkhir = bos.rptkartuuangmuka.obj.find("#tglakhir").val();
        var customer = bos.rptkartuuangmuka.obj.find("#customer").val();
        this.grid1_data 		= {'tglAwal':tglAwal,'tglAkhir':tglAkhir,'customer':customer} ;
    }

    bos.rptkartuuangmuka.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptkartuuangmuka.base_url + "/loadgrid",
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
                { field: 'saldo', render: 'float:2' ,caption: 'Saldo', size: '100px', sortable: false, style:"text-align:right"}
            ]
        });
    }

    bos.rptkartuuangmuka.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptkartuuangmuka.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptkartuuangmuka.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptkartuuangmuka.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptkartuuangmuka.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid2 daftarstock
    bos.rptkartuuangmuka.grid2_data    = null ;
    bos.rptkartuuangmuka.grid2_loaddata= function(){
        this.grid2_data 		= {} ;
    }

    bos.rptkartuuangmuka.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            limit 	: 100 ,
            url 	: bos.rptkartuuangmuka.base_url + "/loadgrid2",
            postData: this.grid3_data ,
            show: {
                footer 		: true,
                toolbar		: true,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'kode', caption: 'Kode', size: '100px', sortable: false},
                { field: 'nama', caption: 'Nama', size: '200px', sortable: false },
                { field: 'alamat', caption: 'Alamat', size: '200px', sortable: false },
                { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.rptkartuuangmuka.grid2_setdata	= function(){
        w2ui[this.id + '_grid2'].postData 	= this.grid2_data ;
    }
    bos.rptkartuuangmuka.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }
    bos.rptkartuuangmuka.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.rptkartuuangmuka.grid2_render 	= function(){
        this.obj.find("#grid2").w2render(this.id + '_grid2') ;
    }

    bos.rptkartuuangmuka.grid2_reloaddata	= function(){
        this.grid2_loaddata() ;
        this.grid2_setdata() ;
        this.grid2_reload() ;
    }

    bos.rptkartuuangmuka.cmdpilih 		= function(kode){
        bjs.ajax(this.url + '/pilihcustomer', 'kode=' + kode);
    }
	
	bos.rptkartuuangmuka.obj.find("#cmdview").on("click", function(){
		bos.rptkartuuangmuka.initreport();
	}) ;

    bos.rptkartuuangmuka.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    bos.rptkartuuangmuka.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }
	
    bos.rptkartuuangmuka.cmdrefresh          = bos.rptkartuuangmuka.obj.find("#cmdrefresh") ;
    bos.rptkartuuangmuka.initfunc    = function(){
        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptkartuuangmuka.grid1_reloadData() ;
        }) ;

        this.obj.find("#cmdcustomer").on("click", function(e){
            bos.rptkartuuangmuka.loadmodelcustomer("show");
            bos.rptkartuuangmuka.grid2_reloaddata() ;
        }) ;

        this.obj.find("#customer").on("blur", function(e){
            if(bos.rptkartuuangmuka.obj.find("#customer").val() !== ""){
                var customer = bos.rptkartuuangmuka.obj.find("#customer").val();
                bjs.ajax( bos.rptkartuuangmuka.base_url + '/seekcustomr', bjs.getdataform(this)) ;
            }
        });


    }
    bos.rptkartuuangmuka.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.grid2_load() ;
        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.rptkartuuangmuka.loadmodelcustomer      = function(l){
        this.obj.find("#wrap-pencariancustomer-d").modal(l) ;
    }
    bos.rptkartuuangmuka.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptkartuuangmuka.grid1_destroy() ;
            bos.rptkartuuangmuka.grid2_destroy() ;
        }) ;
    }

    $(function(){
        bos.rptkartuuangmuka.initcomp() ;
        bos.rptkartuuangmuka.initcallback() ;
        bos.rptkartuuangmuka.initfunc() ;
    });
</script>