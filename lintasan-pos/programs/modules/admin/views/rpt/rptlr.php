<style media="screen">
    #bos-form-rptlra-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptlra-wrapper .info{border-radius: 4px; margin-right: 20px}
</style>

<form novalidate>          
    <div class="bodyfix scrollme" style="height:100%"> 
        <table class="osxtable form" border="0">
            <tr>
                <td width="80px"><label for="tgl">Tgl</label> </td> 
                <td width="20px">:</td>
                <td width="100px">
                    <input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                </td>
                <td width="20px">sd</td>
                <td width="100px">
                    <input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                </td>
                <td width="40px">Level&nbsp;: </td>
                <td width="50px">
                    <input type="text" id="level" name="level" value = "4" class="form-control" placeholder="level" required>
                </td>
                <td></td>
                <td width="100px">
                    <button class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
                </td>
                <td width="100px">
                    <select name="export" id="export" class="form-control select" style="width:100%"
                            data-sf="load_export" data-placeholder="PDF"></select>
                </td>
                <td width="100px">
                    <button class="btn btn-primary pull-right" id="cmdview">Export</button> 
                </td>
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


<script type="text/javascript">
    <?=cekbosjs();?>

    bos.rptlr.grid1_data 	 = null ;
    bos.rptlr.grid1_loaddata= function(){
        var tglawal = bos.rptlr.obj.find("#tglawal").val();
        var tglakhir = bos.rptlr.obj.find("#tglakhir").val();
        var level = bos.rptlr.obj.find("#level").val();
        this.grid1_data 		= {'tglawal': tglawal,'tglakhir':tglakhir,'level':level} ;
    }

    bos.rptlr.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.rptlr.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false,  
            columns: [
                { field: 'kode', caption: 'Rekening', size: '100px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '400px', sortable: false},
                { field: 'saldoakhirperiod', caption: 'Saldo Akhir', size: '140px',style:'text-align:right', sortable: false},
                { field: 'saldoakhirperiodinduk', caption: 'Saldo Akhir', size: '140px',style:'text-align:right', sortable: false}
            ]
        });
    }

    bos.rptlr.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.rptlr.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.rptlr.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptlr.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptlr.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.rptlr.initfunc    = function(){
        this.obj.find("form").on("submit", function(e){ 
            e.preventDefault() ;
        });

        this.obj.find("#cmdrefresh").on("click", function(e){
            e.preventDefault() ;
            bos.rptlr.grid1_reloaddata() ;
        }) ;
        this.obj.find("#cmdview").on("click",function(e){
            e.preventDefault() ;
            bos.rptlr.initreport(0,0);
        });
    }

    bos.rptlr.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    bos.rptlr.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptlr.initcomp	= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }

    bos.rptlr.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.rptlr.tabsaction( e.i )  ;
        });  

        this.obj.on("remove",function(){
            bos.rptlr.grid1_destroy() ;
        }) ;   	

    }


    $(function(){
        bos.rptlr.initcomp() ;
        bos.rptlr.initcallback() ;
        bos.rptlr.initfunc() ;
    }) ;
</script>