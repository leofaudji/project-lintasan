<style media="screen">
    #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
    #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
    <div class="bodyfix scrollme" style="height:100%"> 
        <table class="osxtable form" border="0">
            <tr>
                <td><a id="linkdownlaodbackup" href=""></a></td>
                <td>
                    <button class="btn btn-primary pull-right" id="cmdbackup">Backup</button>
                </td>
            </tr>
            <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
        </table>
    </div>
</form>
<script type="text/javascript">
    <?=cekbosjs();?>

    bos.utlbackupdb.initcomp	= function(){

        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
    }  

    bos.utlbackupdb.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.utlbackupdb.tabsaction( e.i )  ;
        });  


    }

    bos.utlbackupdb.objs = bos.utlbackupdb.obj.find("#cmdbackup") ;
    bos.utlbackupdb.initfunc 		= function(){
        this.obj.find("form").on("submit", function(e){ 
            e.preventDefault() ;
        });

        this.obj.find("#cmdbackup").on("click", function(e){
            e.preventDefault() ;
            if(bjs.isvalidform(this)){
                bjs.ajax(bos.utlbackupdb.base_url + '/backup', bjs.getdataform(this), bos.utlbackupdb.objs) ;
            }
        }) ;
    }
    $(function(){
        bos.utlbackupdb.initcomp() ;
        bos.utlbackupdb.initcallback() ;
        bos.utlbackupdb.initfunc() ;
    }) ;
</script>