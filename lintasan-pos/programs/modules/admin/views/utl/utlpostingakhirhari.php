<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
    <div class="bodyfix scrollme" style="height:100%"> 
        <table class="osxtable form" border="0">
            <tr>
                <td width="80px"><label for="periode">Tgl</label> </td>
                <td width="20px">:</td>
                <td> 
                    <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                </td>
            </tr>  
            <tr>
                <td><label for="cabang">Cabang</label> </td>
                <td>:</td>
                <td>
                    <select name="cabang" id="cabang" class="form-control select" style="width:100%"
                            data-placeholder="Cabang / Kantor" required></select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button class="btn btn-primary pull-right" id="cmdposting">Posting</button>
                </td>
            </tr>
            <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
        </table>
    </div>
</form>
<script type="text/javascript">
    <?=cekbosjs();?>

    bos.utlpostingakhirhari.initcomp	= function(){

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }  

    bos.utlpostingakhirhari.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.utlpostingakhirhari.tabsaction( e.i )  ;
        });  

        this.obj.on("remove",function(){
            bos.utlpostingakhirhari.grid1_destroy() ;
        }) ;   	

    }

    bos.utlpostingakhirhari.objs = bos.utlpostingakhirhari.obj.find("#cmdposting") ;
    bos.utlpostingakhirhari.initfunc 		= function(){
        this.obj.find("form").on("submit", function(e){ 
            e.preventDefault() ;
        });

        this.obj.find("#cmdposting").on("click", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                var tgl = bos.utlpostingakhirhari.obj.find("#tgl").val();
                var cab = bos.utlpostingakhirhari.obj.find("#cabang").val();
                bjs.ajax(bos.utlpostingakhirhari.base_url + '/posting', bjs.getdataform(this)+"&tgl="+tgl+"&cabang="+cab, bos.utlpostingakhirhari.objs) ;
            }
        }) ;
    }
    $('#cabang').select2({
        ajax: {
            url: bos.utlpostingakhirhari.base_url + '/seekcabang',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $(function(){
        bos.utlpostingakhirhari.initcomp() ;
        bos.utlpostingakhirhari.initcallback() ;
        bos.utlpostingakhirhari.initfunc() ;
    }) ;
</script>