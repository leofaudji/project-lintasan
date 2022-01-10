<div class="body">
  <form novalidate>
  <div class="bodyfix scrollme" style="height:100%">
    <table class="osxtable form" border="0">
      <tr>
        <td width="100px"><label for="tgl">Tgl</label> </td>
        <td width="20px">:</td>
        <td>
        <input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
          
        </td>   
        <td>&nbsp;s/d&nbsp;</td>
        <td>  
          <input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
        </td>  
        <td width="200px">
          <select name="pelanggan" id="pelanggan" class="form-control select" style="width:100%" data-sf="load_pelanggan" data-placeholder="Pelanggan" required></select>
        </td>
        <td width="100px"> 
          <button type="submit" class="btn btn-success pull-right" id="cmdabsen">Absen</button>
        </td>
        <td width="100px"> 
          <button type="button" class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
        </td>
        <td width="100px">  
          <button type="button" class="btn btn-primary pull-right" id="cmdview">Preview</button>
        </td>
      </tr>          
    </table> 
    <div class="row" style="height: calc(100% - 50px);"> 
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div> 
   </div>
  </div>
  <div class="footer fix hidden" style="height:32px">
    <button class="btn btn-primary pull-right" id="cmdsave">Simpan</button>
  </div>
  </form>
</div>
<script type="text/javascript">
  <?=cekbosjs();?>

  bos.rptabsensi.grid1_data    = null ;
  bos.rptabsensi.grid1_loaddata= function(){
    this.grid1_data     = { 
      "pelanggan"   : this.obj.find("#pelanggan").val(),
      "tglawal"     : this.obj.find("#tglawal").val(),    
      "tglakhir"    : this.obj.find("#tglakhir").val()
    } ;
  }

  bos.rptabsensi.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
      name    : this.id + '_grid1',
      limit   : 100 ,
      url     : bos.rptabsensi.base_url + "/loadgrid",
      postData : this.grid1_data ,
      show     : {
        footer     : true,
        toolbar    : true,
        toolbarColumns  : false
      },
      multiSearch    : false,
      columns: [ 
        { field: 'no',style:'text-align:right', caption: 'No', size: '40px', sortable: false},
        { field: 'datetime', caption: 'Datetime', size: '140px', sortable: false},
        { field: 'kode', caption: 'Kode', size: '60px', sortable: false},
        { field: 'nama', caption: 'Nama', size: '150px', sortable: false},
        { field: 'alamat', caption: 'Alamat', size: '150px', sortable: false},
        { field: 'telepon', caption: 'Telepon', size: '100px', sortable: false}, 
        { field: 'statuspelanggan', caption: 'Status', size: '50px', sortable: false},
        { field: 'keterangan', caption: 'Keterangan', size: '100px', sortable: false},
        { field: 'keterangan2', caption: 'Keterangan2', size: '200px', sortable: false},
         { field: 'cmdedit', caption: ' ', size: '80px', sortable: false }
      ]
    });
   }

   bos.rptabsensi.grid1_setdata  = function(){
    w2ui[this.id + '_grid1'].postData   = this.grid1_data ;
  }
  bos.rptabsensi.grid1_reload    = function(){
    w2ui[this.id + '_grid1'].reload() ;
  }
  bos.rptabsensi.grid1_destroy   = function(){
    if(w2ui[this.id + '_grid1'] !== undefined){
      w2ui[this.id + '_grid1'].destroy() ;
    }
  }

  bos.rptabsensi.grid1_render   = function(){
    this.obj.find("#grid1").w2render(this.id + '_grid1') ;
  }

  bos.rptabsensi.grid1_reloaddata  = function(){
    this.grid1_loaddata() ;
    this.grid1_setdata() ;
    this.grid1_reload() ;
  }

  bos.rptabsensi.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.rptabsensi.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  bos.rptabsensi.init        = function(){
    bjs.ajax(this.url + "/init") ;
  }

  bos.rptabsensi.initcomp  = function(){
    bjs.initselect({
      class : "#" + this.id + " .select"
    }) ;
    bjs.initdate("#" + this.id + " .date") ;
    bjs_os.inittab(this.obj, '.tpel') ;
    bjs_os._header(this.id) ; //drag header
    this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
  }

  bos.rptabsensi.initcallback  = function(){
    this.obj.on("remove",function(){
      bos.rptabsensi.grid1_destroy() ; 
    }) ;
    
  }
  
  bos.rptabsensi.obj.find("#cmdrefresh").on("click", function(){
       bos.rptabsensi.grid1_reloaddata() ; 
  }) ; 

  bos.rptabsensi.obj.find("#cmdview").on("click", function(){
    bjs_os.form_report(bos.rptabsensi.url+ '/showreport' ) ;
  }) ;
  
  bos.rptabsensi.objs = bos.rptabsensi.obj.find("#cmdsave") ;
  bos.rptabsensi.initfunc     = function(){
    this.init() ;
    this.grid1_loaddata() ;
    this.grid1_load() ;

    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            if(confirm("Apakah Anda yakin ?")){ 
              bjs.ajax( bos.rptabsensi.url + '/saving', bjs.getdataform(this) , bos.rptabsensi.objs) ;
            }
         }
      });
  }

  $(function(){
    bos.rptabsensi.initcomp() ;
    bos.rptabsensi.initcallback() ;
    bos.rptabsensi.initfunc() ;
  }) ;
</script>
