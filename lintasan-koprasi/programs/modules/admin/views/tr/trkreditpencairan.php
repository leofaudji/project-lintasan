<div class="header active"> 
  <table class="header-table"> 
    <tr> 
      <td class="icon" ><i class="fa fa-building"></i></td> 
      <td class="title">
        <div class="nav ">
          <div class="btn-group" id="tpel"> 
            <button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Realisasi</button>
            <button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Data Kredit</button> 
          </div> 
        </div> 
      </td>
      <td class="button">
        <table class="header-button" align="right"> 
          <tr>  
            <td> 
              <div class="btn-circle btn-close transition" onclick="bos.trkreditpencairan.close()">
                <img src="./uploads/titlebar/close.png">
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div><!-- end header -->
<div class="body">
  <form novalidate>
  <div class="bodyfix scrollme" style="height:100%"> 
    <div class="tab-content full-height">
      <div role="tabpanel" class="tab-pane active full-height" id="tpel_1" style="padding-top:5px;">
        <div id="grid1" class="full-height"></div> 
      </div>

      <div role="tabpanel" class="tab-pane fade full-height" id="tpel_2"> 
        <?php require_once "trkreditpencairan.datakredit.php" ; ?>
      </div>

    </div> 
  </div>
  <div class="footer fix hidden" style="height:32px">
    <button class="btn btn-primary btn-block" id="cmdsave">Simpan</button>
  </div>
  </form> 
</div>
  
<div class="modal fade" id="wrap-pencarian-d" role="dialog" data-backdrop="false" data-keyboard="false">
  <div class="modal-dialog" style="width:800px;">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="wm-title">Daftar Rekening Realisasi</h4>
          </div>
          <div class="modal-body">
              <div id="grid3" style="height:400px"></div>
          </div>
          <div class="modal-footer">
              *Pilih Anggota
          </div>
      </div>
  </div>
</div> 


<script type="text/javascript">
  <?=cekbosjs();?>
  bjs.initenter($("form")) ;
  bos.trkreditpencairan.grid1_data    = null ; 
  bos.trkreditpencairan.grid1_loaddata= function(){ 
    this.grid1_data     = {} ; 
  }

  bos.trkreditpencairan.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
      name    : this.id + '_grid1', 
      limit   : 100 ,
      url     : bos.trkreditpencairan.base_url + "/loadgrid", 
      postData : this.grid1_data ,
      show     : {
        footer     : true,
        toolbar    : true,
        toolbarColumns  : false
      },
      multiSearch    : false, 
      columns: [
        { field: 'no', caption: 'No', size: '40px',style:'text-align:center', sortable: false},
        { field: 'datetime', caption: 'Datetime', size: '130px',style:'text-align:center', sortable: false},
        { field: 'rekening', caption: 'No.Rekening',style:'text-align:center', size: '130px', sortable: false},
        { field: 'nama', caption: 'Nama', size: '200px', sortable: false}, 
        { field: 'alamat', caption: 'Alamat', size: '350px', sortable: false},
        { field: 'plafond', caption: 'Plafond', size: '130px',style:'text-align:right', sortable: false},
        { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
        { field: 'cmddelete', caption: ' ', size: '80px', sortable: false },
        { field: 'cmdcetak', caption: ' ', size: '80px', sortable: false }
      ]
    });
   }

   bos.trkreditpencairan.grid1_setdata  = function(){
    w2ui[this.id + '_grid1'].postData   = this.grid1_data ;
  }

  bos.trkreditpencairan.grid1_reload    = function(){
    w2ui[this.id + '_grid1'].reload() ; 
  }
  bos.trkreditpencairan.grid1_destroy   = function(){
    if(w2ui[this.id + '_grid1'] !== undefined){
      w2ui[this.id + '_grid1'].destroy() ;
    }
  }

  bos.trkreditpencairan.grid1_render   = function(){
    this.obj.find("#grid1").w2render(this.id + '_grid1') ;
  }

  bos.trkreditpencairan.grid1_reloaddata  = function(){
    this.grid1_loaddata() ;
    this.grid1_setdata() ;
    this.grid1_reload() ;
  }

  //grid3 daftarstock
  bos.trkreditpencairan.grid3_data    = null ;
    bos.trkreditpencairan.grid3_loaddata= function(){
        this.grid3_data     = {} ;
  }

  bos.trkreditpencairan.grid3_load    = function(){
      this.obj.find("#grid3").w2grid({
          name  : this.id + '_grid3',
          limit   : 100 ,
          url   : bos.trkreditpencairan.base_url + "/loadgrid3",
          postData: this.grid3_data ,
          show: {
              footer     : true,
              toolbar    : true,
              toolbarColumns  : false
          },
          multiSearch    : false,
          columns: [
              { field: 'rekening', caption: 'Rekening',style:'text-align:center', size: '130px', sortable: false},
              { field: 'nama', caption: 'Nama', size: '180px', sortable: false },
              { field: 'alamat', caption: 'Alamat', size: '340px', sortable: false },
              { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
          ]
      });
  }

  bos.trkreditpencairan.grid3_setdata  = function(){
      w2ui[this.id + '_grid3'].postData   = this.grid3_data ;
  }
  bos.trkreditpencairan.grid3_reload    = function(){
      w2ui[this.id + '_grid3'].reload() ;
  }
  bos.trkreditpencairan.grid3_destroy   = function(){
      if(w2ui[this.id + '_grid3'] !== undefined){ 
          w2ui[this.id + '_grid3'].destroy() ;
      }
  }

  bos.trkreditpencairan.grid3_render   = function(){
      this.obj.find("#grid3").w2render(this.id + '_grid3') ;
  }

  bos.trkreditpencairan.grid3_reloaddata  = function(){
      this.grid3_loaddata() ;
      this.grid3_setdata() ;
      this.grid3_reload() ;
  }
 
  bos.trkreditpencairan.cmdpilih     = function(kode){
    bjs.ajax(this.url + '/pilih', 'kode=' + kode);
  }

  bos.trkreditpencairan.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.trkreditpencairan.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  bos.trkreditpencairan.cmdcetak    = function(id){
    bjs_os.form_report(bos.trkreditpencairan.url+ '/showreport?id=' + id ) ;
  }


  bos.trkreditpencairan.init        = function(){
    this.obj.find("#rekening").val("") ;
    this.obj.find("#nama").val("") ;
    this.obj.find("#alamat").val("") ;
    this.obj.find("#telepon").val("") ;
    this.obj.find("#no_spk").val("") ;
    this.obj.find("#golongan_tabungan").html("") ; 
    this.obj.find("#plafond").val("") ;
    this.obj.find("#sukubunga").val("") ;
    this.obj.find("#lama").val("") ;
    this.obj.find("#administrasi").val("") ;
    this.obj.find("#provisi").val("") ;
    this.obj.find("#materai").val("") ;
    this.obj.find("#ao").html("") ;
    this.obj.find("#caraperhitungan").html("") ;
    this.obj.find("#tujuan_pembukaan").val("") ;
    this.obj.find("#ahli_waris").val("") ;
    this.obj.find("#jenis_agunan").html("") ;
    this.obj.find("#nilai_agunan").val("") ;
    this.obj.find("#data_agunan").val("") ;
    this.obj.find("#image").val("") ;
    this.obj.find("#idlimage").html("") ;
    this.obj.find("#idimage").html("") ;
    bjs.ajax(this.url + "/init") ;
  }

  bos.trkreditpencairan.settab     = function(n){
    this.obj.find("#tpel button:eq("+n+")").tab("show") ;
  }

  bos.trkreditpencairan.tabsaction  = function(n){
    if(n == 0){
      this.obj.find(".bodyfix").css("height","100%") ;
      this.obj.find(".footer").addClass("hidden") ;
      bos.trkreditpencairan.grid1_render() ;
      //bos.trkreditpencairan.init() ; 
    }else{
      this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
      this.obj.find(".footer").removeClass("hidden") ;
      this.obj.find("#rekening").focus() ;
    }
  }

  bos.trkreditpencairan.initcomp  = function(){
    bjs.initselect({
      class : "#" + this.id + " .select",
      clear : true
    }) ;
    bjs.initdate("#" + this.id + " .date") ;
    bjs_os.inittab(this.obj, '.tpel') ;

    this.grid3_load() ; 

    bjs_os._header(this.id) ; //drag header
    this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
  } 

  bos.trkreditpencairan.initcallback  = function(){
    this.obj.on("bos:tab", function(e){
      bos.trkreditpencairan.tabsaction( e.i )  ;
    });

    this.obj.on("remove",function(){
      bos.trkreditpencairan.grid1_destroy() ; 
      bos.trkreditpencairan.grid3_destroy() ;
    }) ;

    this.obj.find("#jenis_agunan").on("select2:select", function(e){ 
      bjs.ajax(bos.trkreditpencairan.url+"/seekjenisagunan", "jenis_agunan=" + $(this).val()) ;
    }) ; 
  }


  bos.trkreditpencairan.loadmodelstock      = function(l){
    this.obj.find("#wrap-pencarian-d").modal(l) ; 
  }

  bos.trkreditpencairan.objs = bos.trkreditpencairan.obj.find("#cmdsave") ;
  bos.trkreditpencairan.initfunc     = function(){
    this.init() ;
    this.grid1_loaddata() ;
    this.grid1_load() ;

    this.obj.find("#image").on("change", function(e){
      e.preventDefault() ; 

      bos.trkreditpencairan.cfile    = e.target.files ;
      bos.trkreditpencairan.gfile    = new FormData() ;
      $.each(bos.trkreditpencairan.cfile, function(cKey,cValue){
        bos.trkreditpencairan.gfile.append(cKey,cValue) ;
      }) ;

      bos.trkreditpencairan.obj.find("#idlimage").html("<i class='fa fa-spinner fa-pulse'></i>");
      bos.trkreditpencairan.obj.find("#idimage").html("") ;
      bos.trkreditpencairan.obj.find("#image").val("") ;


      bjs.ajaxfile(bos.trkreditpencairan.base_url + "/saving_image", bos.trkreditpencairan.gfile, this) ;

    })  
    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.trkreditpencairan.url + '/saving', bjs.getdataform(this) , bos.trkreditpencairan.objs) ;
         }
      }); 

    this.obj.find("#cmdanggota").on("click", function(e){
          bos.trkreditpencairan.loadmodelstock("show");
          bos.trkreditpencairan.grid3_reloaddata() ; 
      }) ;
      
  }

  $(function(){
    bos.trkreditpencairan.initcomp() ;
    bos.trkreditpencairan.initcallback() ;
    bos.trkreditpencairan.initfunc() ;
  }) ;
</script>
