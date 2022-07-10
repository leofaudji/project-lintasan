<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
    <div class="bodyfix scrollme" style="height:100%"> 
        <table class="osxtable form" border="0">
            <tr>
                <td><input type="file" id="app_updprogram" accept="zip/*" class="fupload"></td>
                <td>
                    <button class="btn btn-primary pull-right" id="cmdupdate">Update</button>
                </td>
            </tr>
            <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
        </table>
    </div>
</form>
<script type="text/javascript">
    <?=cekbosjs();?>

    bos.utlupdateprogram.initcomp	= function(){

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }  

    bos.utlupdateprogram.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.utlupdateprogram.tabsaction( e.i )  ;
        });  


    }

    bos.utlupdateprogram.objs = bos.utlupdateprogram.obj.find("#cmdupdate") ;
    bos.utlupdateprogram.initfunc 		= function(){
        this.obj.find("form").on("submit", function(e){ 
            e.preventDefault() ;
        });

        this.obj.find("#cmdupdate").on("click", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bos.utlupdateprogram.uname	= $(this).attr("id") ;
                e.preventDefault() ;

                bos.utlupdateprogram.fal    = bos.utlupdateprogram.obj.find(".fupload").target.files ;
                bos.utlupdateprogram.gfal   = new FormData() ;
                alert(bos.utlupdateprogram.fal);

                /*$.each(bos.utlupdateprogram.fal, function(key,val){
                    bos.utlupdateprogram.gfal.append(key,val) ;
                }) ;

                bos.utlupdateprogram.obj.find("#id" + bos.utlupdateprogram.uname).html("") ;

                bjs.ajax(bos.utlupdateprogram.base_url + '/updateprogram' + bos.utlupdateprogram.uname , bos.utlupdateprogram.gfal, this) ;
                */
            }
        }) ;
    }
    $(function(){
        bos.utlupdateprogram.initcomp() ;
        bos.utlupdateprogram.initcallback() ;
        bos.utlupdateprogram.initfunc() ;
    }) ;
</script>