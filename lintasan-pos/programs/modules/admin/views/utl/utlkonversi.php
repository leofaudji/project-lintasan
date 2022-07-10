<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
    <div class="bodyfix scrollme" style="height:100%"> 
        <table class="osxtable form" border="0">
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button class="btn btn-primary pull-right" id="cmdposting">Posting</button>
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

    bos.utlkonversi.grid1_data 	 = null ;
    bos.utlkonversi.grid1_loaddata= function(){
        this.grid1_data 		= {} ;
    }

    bos.utlkonversi.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.utlkonversi.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'ck', caption: '', size: '30px', sortable: false,
                 render: function(record){
                     return '<div style = "text-align:center">'+
                         ' <input type="checkbox"'+(record.ck ? 'checked' : '')+
                         '  onclick="var obj = w2ui[\''+this.name+'\'];obj.set(\''+record.recid+'\',{ck:this.checked});(this.checked) ? obj.set(\''+record.recid+'\',{qty:1}) : obj.set(\''+record.recid+'\',{qty:0});">'+
                         '</div>';
                 }
                },
                { field: 'no', caption: 'No', size: '40px', sortable: false},
                { field: 'kode', caption: 'Kode', size: '50px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '250px', sortable: false}
            ]
        });
    }

    bos.utlkonversi.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.utlkonversi.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.utlkonversi.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.utlkonversi.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.utlkonversi.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }


    bos.utlkonversi.initcomp	= function(){

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }  

    bos.utlkonversi.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.utlkonversi.tabsaction( e.i )  ;
        });  

        this.obj.on("remove",function(){
            bos.utlkonversi.grid1_destroy() ;
        }) ;   	

    }

    bos.utlkonversi.objs = bos.utlkonversi.obj.find("#cmdposting") ;
    bos.utlkonversi.initfunc 		= function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.obj.find("form").on("submit", function(e){ 
            e.preventDefault() ;
        });

        this.obj.find("#cmdposting").on("click", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                var datagrid1 =  w2ui['bos-form-utlkonversi_grid1'].records;
                datagrid1 = JSON.stringify(datagrid1);
                var period = bos.utlkonversi.obj.find("#periode").val();
                var cab = bos.utlkonversi.obj.find("#cabang").val();
                bjs.ajax(bos.utlkonversi.base_url + '/posting', bjs.getdataform(this)+"&grid1="+datagrid1+"&periode="+period+"&cabang="+cab, bos.utlkonversi.objs) ;
            }
        }) ;
    }
    $(function(){
        bos.utlkonversi.initcomp() ;
        bos.utlkonversi.initcallback() ;
        bos.utlkonversi.initfunc() ;
    }) ;
</script>