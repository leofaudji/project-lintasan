<style media="screen">
   #bos-form-rptjdwlpel-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptjdwlpel-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
<div class="bodyfix scrollme" style="height:100%"> 
   <table class="osxtable form" border="0">
      <tr>
      <td width="80px"><label for="faktur">Pelanggan</label> </td>
      <td width="10px">:</td>
      <td> 
            <select name="pelanggan" id="pelanggan" class="form-control select" style="width:100%"
            data-sf="load_pelanggan" data-placeholder="Pelanggan"></select> 
      </td>
      <td><label id="statuspem"></label></td>
    </tr> 
    <tr>   
      <td width="200px"></td> 
    </tr>
      <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
   </table> 
   <div class="row" style="height: calc(100% - 70px);">
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div>
   </div>
</div>
</form>
<script type="text/javascript">
  <?=cekbosjs();?>

  bos.rptjdwlpel.grid1_data    = null ;
  bos.rptjdwlpel.grid1_loaddata= function(){
    this.grid1_data     = {
      "pelanggan":this.obj.find("#pelanggan").val()
    } ;
  }

  bos.rptjdwlpel.grid1_load    = function(){
    this.obj.find("#grid1").w2grid({
      name    : this.id + '_grid1',
      limit   : 100 ,
      url     : bos.rptjdwlpel.base_url + "/loadgrid",
      postData : this.grid1_data ,
      show     : {
        footer     : true,
        toolbar    : true,
        toolbarColumns  : false
      },
      multiSearch    : false,
      columns: [
        { field: 'no', caption: 'No.',style:'text-align:right', size: '40px', sortable: false},
        { field: 'nama', caption: 'Nama', size: '130px', sortable: false},
        { field: 'tgl', caption: 'Periode',style:'text-align:center', size: '90px', sortable: false},
        { field: 'keterangan', caption: 'Keterangan', size: '100px', sortable: false},
        { field: 'jumlah', caption: 'Jumlah',style:'text-align:right', size: '90px', sortable: false},
        { field: 'tglbayar', caption: 'Tgl',style:'text-align:center;wrap:1', size: '90px', sortable: false},
        { field: 'keteranganbayar', caption: 'Keterangan', size: '100px', sortable: false},
        { field: 'jumlahbayar', caption: 'Jumlah',style:'text-align:right', size: '90px', sortable: false}
        
      ]
    });
   }

   bos.rptjdwlpel.grid1_setdata  = function(){
    w2ui[this.id + '_grid1'].postData   = this.grid1_data ;
  }
  bos.rptjdwlpel.grid1_reload    = function(){
    w2ui[this.id + '_grid1'].reload() ;
  }
  bos.rptjdwlpel.grid1_destroy   = function(){
    if(w2ui[this.id + '_grid1'] !== undefined){
      w2ui[this.id + '_grid1'].destroy() ;
    }
  }

  bos.rptjdwlpel.grid1_render   = function(){
    this.obj.find("#grid1").w2render(this.id + '_grid1') ;
  } 

  bos.rptjdwlpel.grid1_reloaddata  = function(){
    this.grid1_loaddata() ;
    this.grid1_setdata() ;
    this.grid1_reload() ;
  }

  bos.rptjdwlpel.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.rptjdwlpel.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  bos.rptjdwlpel.init        = function(){
    this.obj.find("#kode").html("") ;
    this.obj.find("#keterangan").val("") ;
    this.obj.find("#jumlah").val("") ;
    bjs.ajax(this.url + "/init") ;
  }


  bos.rptjdwlpel.initcomp  = function(){
    bjs.initselect({
      class : "#" + this.id + " .select"
    }) ;
    bjs.initdate("#" + this.id + " .date") ;
    bjs_os.inittab(this.obj, '.tpel') ;
    bjs_os._header(this.id) ; //drag header
    this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
  }

  bos.rptjdwlpel.initcallback  = function(){
    this.obj.on("bos:tab", function(e){
      bos.rptjdwlpel.tabsaction( e.i )  ;
    });  

    this.obj.on("remove",function(){
      bos.rptjdwlpel.grid1_destroy() ;
    }) ;

    this.obj.find("#pelanggan").on("select2:select", function(e){ 
           bjs.ajax(bos.rptjdwlpel.url+"/seekpel", "pelanggan=" + $(this).val()) ;
        }) ;        
      
  }

  bos.rptjdwlpel.objs = bos.rptjdwlpel.obj.find("#cmdsave") ;
  bos.rptjdwlpel.initfunc     = function(){
    this.init() ;
    this.grid1_loaddata() ;
    this.grid1_load() ;

    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ; 
      });
  }

  $(function(){
    bos.rptjdwlpel.initcomp() ;
    bos.rptjdwlpel.initcallback() ;
    bos.rptjdwlpel.initfunc() ;
  }) ;

  $("#jumlah").change(function() {
      var cTotal = $("#total").val();
      var cJumlah = $("#jumlah").val();
      var cGtot = cJumlah - cTotal ;
      if(cGtot < 0){
        $("#total_bali").toggleClass("text-number bg-danger");
      }else{
        $("#total_bali").toggleClass("text-number bg-success");
      }
      $("#total_bali").text(cGtot);
  });
</script>
