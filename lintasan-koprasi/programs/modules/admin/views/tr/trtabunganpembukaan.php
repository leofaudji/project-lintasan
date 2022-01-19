<div class="header active"> 
  <table class="header-table"> 
    <tr> 
      <td class="icon" ><i class="fa fa-building"></i></td> 
      <td class="title">
        <div class="nav ">
          <div class="btn-group" id="tpel"> 
            <button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Rekening Baru</button>
            <button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Input Data</button>
          </div>
        </div>
      </td>
      <td class="button">
        <table class="header-button" align="right"> 
          <tr> 
            <td> 
              <div class="btn-circle btn-close transition" onclick="bos.trtabunganpembukaan.close()">
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
        <table class="osxtable form" border="0" width="100%">
          <tr>
            <td width="15%"><label for="tgl">Tgl</label> </td>
            <td width="1%">:</td>
            <td> 
              <input style="width: 100px;" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>> 
            </td>
          </tr>
          <tr>
            <td width="5%"><label for="sku">Kode Anggota</label> </td>
            <td>:</td>
            <td>
              <div style="width:30%" class="input-group">
                <input type="text" id="kode_anggota" name="kode_anggota" class="form-control" placeholder="Kode Anggota">
                <span class="input-group-btn">
                  <button class="form-control btn btn-info" type="button" id="cmdanggota"><i class="fa fa-search"></i></button>
                </span>
              </div>              
            </td>    
          </tr>
          <tr>
            <td><label for="nama">Nama</label> </td>
            <td width="1%">:</td>
            <td>
              <input disabled type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
            </td>
          </tr>
          <tr>
            <td><label for="alamat">Alamat</label> </td>
            <td width="1%">:</td>
            <td>
              <input disabled type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
            </td> 
          </tr>
          <tr>
            <td><label for="telepon">Telepon</label> </td>
            <td width="1%">:</td>
            <td>
              <input disabled style="width:30%" type="text" id="telepon" name="telepon" class="form-control" placeholder="Nomor Telepon" required>
            </td>
          </tr> 
          <tr>
						<td><label for="rekening">Golongan Tabungan</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="golongan_tabungan" id="golongan_tabungan" class="form-control select" style="width:20%" data-sf="load_tabungan_golongan" data-placeholder="Golongan Tabungan" required></select>
						</td>
					</tr> 
          <tr>
            <td><label for="nama">Tujuan Pembukaan</label> </td>
            <td width="1%">:</td>
            <td>
              <input type="text" id="tujuan_pembukaan" name="tujuan_pembukaan" class="form-control" placeholder="Tujuan Pembukaan" required>
            </td>
          </tr>
          <tr>
            <td><label for="nama">Ahli Waris</label> </td>
            <td width="1%">:</td>
            <td>
              <input type="text" id="ahli_waris" name="ahli_waris" class="form-control" placeholder="Ahli Waris" required>
            </td>
          </tr>

        </table>
      </div>
    </div> 
  </div>
  <div class="footer fix hidden" style="height:32px">
    <button class="btn btn-primary btn-block" id="cmdsave">Simpan</button>
  </div>
  </form>
</div>
  
<div class="modal fade" id="wrap-pencarian-d" role="dialog" data-backdrop="false" data-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="wm-title">Daftar Anggota</h4>
          </div>
          <div class="modal-body">
              <div id="grid3" style="height:250px"></div>
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
  bos.trtabunganpembukaan.grid1_data    = null ;
  bos.trtabunganpembukaan.grid1_loaddata= function(){ 
    this.grid1_data     = {} ;
  }

  bos.trtabunganpembukaan.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
      name    : this.id + '_grid1', 
      limit   : 100 ,
      url     : bos.trtabunganpembukaan.base_url + "/loadgrid",
      postData : this.grid1_data ,
      show     : {
        footer     : true,
        toolbar    : true,
        toolbarColumns  : false
      },
      multiSearch    : false, 
      columns: [
        { field: 'no', caption: 'No', size: '40px',style:'text-align:center', sortable: false},
        { field: 'datetime', caption: 'Datetime', size: '140px',style:'text-align:center', sortable: false},
        { field: 'rekening', caption: 'No.Rekening', size: '140px', sortable: false},
        { field: 'nama', caption: 'Nama', size: '200px', sortable: false}, 
        { field: 'alamat', caption: 'Alamat', size: '240px', sortable: false},
        { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
        { field: 'cmddelete', caption: ' ', size: '80px', sortable: false },
        { field: 'cmdcetak', caption: ' ', size: '80px', sortable: false }
      ]
    });
   }

   bos.trtabunganpembukaan.grid1_setdata  = function(){
    w2ui[this.id + '_grid1'].postData   = this.grid1_data ;
  }

  //grid3 daftarstock
  bos.trtabunganpembukaan.grid3_data    = null ;
    bos.trtabunganpembukaan.grid3_loaddata= function(){
        this.grid3_data     = {} ;
  }

  bos.trtabunganpembukaan.grid3_load    = function(){
      this.obj.find("#grid3").w2grid({
          name  : this.id + '_grid3',
          limit   : 100 ,
          url   : bos.trtabunganpembukaan.base_url + "/loadgrid3",
          postData: this.grid3_data ,
          show: {
              footer     : true,
              toolbar    : true,
              toolbarColumns  : false
          },
          multiSearch    : false,
          columns: [
              { field: 'kode', caption: 'Kode', size: '80px', sortable: false},
              { field: 'nama', caption: 'Nama', size: '150px', sortable: false },
              { field: 'alamat', caption: 'Alamat', size: '200px', sortable: false },
              { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
          ]
      });
  }

  bos.trtabunganpembukaan.grid3_setdata  = function(){
      w2ui[this.id + '_grid3'].postData   = this.grid3_data ;
  }
  bos.trtabunganpembukaan.grid3_reload    = function(){
      w2ui[this.id + '_grid3'].reload() ;
  }
  bos.trtabunganpembukaan.grid3_destroy   = function(){
      if(w2ui[this.id + '_grid3'] !== undefined){ 
          w2ui[this.id + '_grid3'].destroy() ;
      }
  }

  bos.trtabunganpembukaan.grid3_render   = function(){
      this.obj.find("#grid3").w2render(this.id + '_grid3') ;
  }

  bos.trtabunganpembukaan.grid3_reloaddata  = function(){
      this.grid3_loaddata() ;
      this.grid3_setdata() ;
      this.grid3_reload() ;
  }

  bos.trtabunganpembukaan.cmdpilih     = function(kode){
      bjs.ajax(this.url + '/pilihstock', 'kode=' + kode);
  }

  bos.trtabunganpembukaan.grid1_reload    = function(){
    w2ui[this.id + '_grid1'].reload() ; 
  }
  bos.trtabunganpembukaan.grid1_destroy   = function(){
    if(w2ui[this.id + '_grid1'] !== undefined){
      w2ui[this.id + '_grid1'].destroy() ;
    }
  }

  bos.trtabunganpembukaan.grid1_render   = function(){
    this.obj.find("#grid1").w2render(this.id + '_grid1') ;
  }

  bos.trtabunganpembukaan.grid1_reloaddata  = function(){
    this.grid1_loaddata() ;
    this.grid1_setdata() ;
    this.grid1_reload() ;
  }

  bos.trtabunganpembukaan.cmdpilih     = function(kode){
    bjs.ajax(this.url + '/pilih', 'kode=' + kode);
  }

  bos.trtabunganpembukaan.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.trtabunganpembukaan.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  bos.trtabunganpembukaan.cmdcetak    = function(id){
    bjs_os.form_report(bos.trtabunganpembukaan.url+ '/showreport?id=' + id ) ;
  }

  bos.trtabunganpembukaan.init        = function(){
    this.obj.find("#kode_anggota").val("") ;
    this.obj.find("#nama").val("") ;
    this.obj.find("#alamat").val("") ;
    this.obj.find("#telepon").val("") ;
    this.obj.find("#golongan_tabungan").html("") ; 
    this.obj.find("#tujuan_pembukaan").val("") ;
    this.obj.find("#ahli_waris").val("") ;
    this.obj.find("#image").val("") ;
    this.obj.find("#idlimage").html("") ;
    this.obj.find("#idimage").html("") ;
    bjs.ajax(this.url + "/init") ;
  }

  bos.trtabunganpembukaan.settab     = function(n){
    this.obj.find("#tpel button:eq("+n+")").tab("show") ;
  }

  bos.trtabunganpembukaan.tabsaction  = function(n){
    if(n == 0){
      this.obj.find(".bodyfix").css("height","100%") ;
      this.obj.find(".footer").addClass("hidden") ;
      bos.trtabunganpembukaan.grid1_render() ;
      bos.trtabunganpembukaan.init() ;
    }else{
      this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
      this.obj.find(".footer").removeClass("hidden") ;
      this.obj.find("#kode_anggota").focus() ;
    }
  }

  bos.trtabunganpembukaan.initcomp  = function(){
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

  bos.trtabunganpembukaan.initcallback  = function(){
    this.obj.on("bos:tab", function(e){
      bos.trtabunganpembukaan.tabsaction( e.i )  ;
    });

    this.obj.on("remove",function(){
      bos.trtabunganpembukaan.grid1_destroy() ;
      bos.trtabunganpembukaan.grid3_destroy() ;
    }) ;
  }


  bos.trtabunganpembukaan.loadmodelstock      = function(l){
    this.obj.find("#wrap-pencarian-d").modal(l) ; 
  }

  bos.trtabunganpembukaan.objs = bos.trtabunganpembukaan.obj.find("#cmdsave") ;
  bos.trtabunganpembukaan.initfunc     = function(){
    this.init() ;
    this.grid1_loaddata() ;
    this.grid1_load() ;

    this.obj.find("#image").on("change", function(e){
      e.preventDefault() ;

            bos.trtabunganpembukaan.cfile    = e.target.files ;
            bos.trtabunganpembukaan.gfile    = new FormData() ;
            $.each(bos.trtabunganpembukaan.cfile, function(cKey,cValue){
              bos.trtabunganpembukaan.gfile.append(cKey,cValue) ;
            }) ;

            bos.trtabunganpembukaan.obj.find("#idlimage").html("<i class='fa fa-spinner fa-pulse'></i>");
            bos.trtabunganpembukaan.obj.find("#idimage").html("") ;
      bos.trtabunganpembukaan.obj.find("#image").val("") ;
 
 
            bjs.ajaxfile(bos.trtabunganpembukaan.base_url + "/saving_image", bos.trtabunganpembukaan.gfile, this) ;

    })  
    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.trtabunganpembukaan.url + '/saving', bjs.getdataform(this) , bos.trtabunganpembukaan.objs) ;
         }
      }); 

    this.obj.find("#cmdanggota").on("click", function(e){
          bos.trtabunganpembukaan.loadmodelstock("show");
          bos.trtabunganpembukaan.grid3_reloaddata() ;
      }) ;
      
  }

  $(function(){
    bos.trtabunganpembukaan.initcomp() ;
    bos.trtabunganpembukaan.initcallback() ;
    bos.trtabunganpembukaan.initfunc() ;
  }) ;
</script>
