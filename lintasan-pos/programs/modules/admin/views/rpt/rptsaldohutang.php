<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon"  align="left" ><i class="fa fa-building"></i></td>
            <td class="title">Laporan Saldo Hutang</td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptsaldohutang.close()">
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
                        <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
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
<script type="text/javascript">
    <?=cekbosjs();?>


    //grid daftar hutang
    bos.rptsaldohutang.grid1_data    = null ;
    bos.rptsaldohutang.grid1_loaddata= function(){
        var tgl = bos.rptsaldohutang.obj.find("#tgl").val();
        this.grid1_data 		= {'tgl':tgl} ;
    }

    bos.rptsaldohutang.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.rptsaldohutang.base_url + "/loadgrid",
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
                { field: 'nama', caption: 'Nama', size: '200px', sortable: false , style:"text-align:left"},
                { field: 'alamat', caption: 'Alamat', size: '200px', sortable: false , style:"text-align:left"},
                { field: 'saldo', render: 'float:2' ,caption: 'Saldo', size: '100px', sortable: false, style:"text-align:right"}
            ]
        });
    }

    bos.rptsaldohutang.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }

    bos.rptsaldohutang.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }

    bos.rptsaldohutang.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptsaldohutang.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptsaldohutang.grid1_reloadData	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }
	
	bos.rptsaldohutang.obj.find("#cmdview").on("click", function(){
		bos.rptsaldohutang.initreport();
	}) ;

    bos.rptsaldohutang.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    bos.rptsaldohutang.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptsaldohutang.cmdrefresh          = bos.rptsaldohutang.obj.find("#cmdrefresh") ;
    bos.rptsaldohutang.initfunc    = function(){
        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptsaldohutang.grid1_reloadData() ;
        }) ;


    }

    bos.rptsaldohutang.initcomp		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;

        bjs.initenter(this.obj.find("form")) ;
        bjs.initdate("#" + this.id + " .date") ;
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.rptsaldohutang.initcallback	= function(){
        this.obj.on('remove', function(){
            bos.rptsaldohutang.grid1_destroy() ;

        }) ;
    }

    $(function(){
        bos.rptsaldohutang.initcomp() ;
        bos.rptsaldohutang.initcallback() ;
        bos.rptsaldohutang.initfunc() ;
    });
</script>