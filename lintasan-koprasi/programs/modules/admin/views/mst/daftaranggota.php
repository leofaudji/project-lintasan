<div class="header active"> 
  <table class="header-table"> 
    <tr> 
      <td class="icon" ><i class="fa fa-building"></i></td>
      <td class="title">
        <div class="nav ">
          <div class="btn-group" id="tpel">
            <button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Anggota</button>
            <button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Input Data</button>
          </div>
        </div>
      </td>
      <td class="button">
        <table class="header-button" align="right">
          <tr> 
            <td> 
              <div class="btn-circle btn-close transition" onclick="bos.daftaranggota.close()">
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
            <td width="5%"><label for="sku">Kode</label> </td>
            <td>:</td>
            <td>
              <div id="kode"></div>               
            </td>    
          </tr>
          <tr>
            <td><label for="tgl">Tgl</label> </td>
            <td width="1%">:</td>
            <td>
              <input style="width: 100px;" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>> 
            </td>
          </tr>
          <tr>
            <td><label for="nama">Nama</label> </td>
            <td width="1%">:</td>
            <td>
              <input style="width:70%" type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
            </td>
          </tr>
          <tr>
						<td><label for="rekening">Provinsi</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="provinsi" id="provinsi" class="form-control select" style="width:20%" data-sf="load_provinsi" data-placeholder="Provinsi" required></select>
						<label for="kota">Kota : </label> 
            <select name="kota" id="kota" class="form-control select" style="width:20%" data-sf="load_kota" data-placeholder="Kota" required></select>
						<label for="kecamatan">Kecamatan : </label> 
            <select name="kecamatan" id="kecamatan" class="form-control select" style="width:20%" data-sf="load_kecamatan" data-placeholder="Kecamatan" required></select>
						</td>
					</tr> 
          <tr>
            <td><label for="alamat">Alamat</label> </td>
            <td width="1%">:</td>
            <td>
              <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
            </td> 
          </tr>
          <tr>
            <td><label for="telepon">Telepon</label> </td>
            <td width="1%">:</td>
            <td>
              <input style="width:30%" type="text" id="telepon" name="telepon" class="form-control" placeholder="Nomor Telepon" required>
            </td>
          </tr>
          <tr>
            <td><label for="email">Email</label> </td>
            <td width="1%">:</td>
            <td>
              <input style="width:40%" type="text" id="email" name="email" class="form-control" placeholder="Email" required>
            </td>
          </tr>

          <tr>
            <td><label for="tempat_lahir">Tempat Lahir</label> </td>
            <td width="1%">:</td>
            <td>  
              <input style="width:150px;" type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
            </td>
          </tr> 

          <tr>
            <td><label for="tgl_lahir">Tgl Lahir</label> </td>
            <td width="1%">:</td>
            <td> 
              <input style="width: 100px;" type="text" class="form-control date" id="tgl_lahir" name="tgl_lahir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
            </td>
          </tr> 

          <tr>
            <td><label for="jenis_kelamin">Jenis Kelamin</label> </td>
            <td width="1%">:</td>
            <td>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="jenis_kelamin" class="jenis_kelamin" value="L" checked>
                  Laki-laki
                </label>
                &nbsp;&nbsp;
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="jenis_kelamin" class="jenis_kelamin" value="P">
                  Perempuan
                </label>
              </div>
            </td>
          </tr>  
          <tr>
						<td><label for="rekening">Agama</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="agama" id="agama" class="form-control select" style="width:20%" data-sf="load_agama" data-placeholder="Agama" required></select>
						</td>
					</tr> 
          <tr>
            <td><label for="statuspelanggan">Foto</label> </td>
            <td width="1%">:</td>  
            <td width="50%">
              <label for="image">Foto <span id="idlimage"></span></label>
              <input type="file" name="image" id="image" accept="image/*">
            </td>
          </tr>
          <tr>
            <td></td>
            <td width="1%"></td>
            <td width="50%">
            <div class="col-sm-6 col-sm-offset-3" id="idimage"></div> 
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td width="200px" style="border:1px solid #ced5e0" id="foto" align="center" valign="top">foto</td>
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
<script type="text/javascript">
  <?=cekbosjs();?>
  bjs.initenter($("form")) ;
  bos.daftaranggota.grid1_data    = null ;
  bos.daftaranggota.grid1_loaddata= function(){ 
    this.grid1_data     = {} ;
  }

  bos.daftaranggota.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
      name    : this.id + '_grid1',
      limit   : 100 ,
      url     : bos.daftaranggota.base_url + "/loadgrid",
      postData : this.grid1_data ,
      show     : {
        footer     : true,
        toolbar    : true,
        toolbarColumns  : false
      },
      multiSearch    : false, 
      columns: [
        { field: 'kode', caption: 'Kode', size: '80px', sortable: false},
        { field: 'tgl', caption: 'Tgl Daftar', size: '80px', sortable: false},
        { field: 'nama', caption: 'Nama', size: '180px', sortable: false},
        { field: 'alamat', caption: 'Alamat', size: '200px', sortable: false},
        { field: 'telepon', caption: 'Telepon', size: '120px', sortable: false},
        { field: 'email', caption: 'Email', size: '80px', sortable: false},
        { field: 'tempat_lahir', caption: 'Tempat Lahir', size: '120px', sortable: false},
        { field: 'jenis_kelamin', caption: 'JK', size: '40px', sortable: false},
        { field: 'agama', caption: 'Agama', size: '100px', sortable: false},
        { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
        { field: 'cmddelete', caption: ' ', size: '80px', sortable: false },
        { field: 'cmdcetak', caption: ' ', size: '80px', sortable: false }
      ]
    });
   }

   bos.daftaranggota.grid1_setdata  = function(){
    w2ui[this.id + '_grid1'].postData   = this.grid1_data ;
  }
  bos.daftaranggota.grid1_reload    = function(){
    w2ui[this.id + '_grid1'].reload() ; 
  }
  bos.daftaranggota.grid1_destroy   = function(){
    if(w2ui[this.id + '_grid1'] !== undefined){
      w2ui[this.id + '_grid1'].destroy() ;
    }
  }

  bos.daftaranggota.grid1_render   = function(){
    this.obj.find("#grid1").w2render(this.id + '_grid1') ;
  }

  bos.daftaranggota.grid1_reloaddata  = function(){
    this.grid1_loaddata() ;
    this.grid1_setdata() ;
    this.grid1_reload() ;
  }

  bos.daftaranggota.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.daftaranggota.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  bos.daftaranggota.cmdcetak    = function(id){
    bjs_os.form_report(bos.daftaranggota.url+ '/showreport?id=' + id ) ;
  }

  bos.daftaranggota.init        = function(){
    this.obj.find("#kodefinger").html("") ;
    this.obj.find("#nama").val("") ;
    this.obj.find("#alamat").val("") ;
    this.obj.find("#telepon").val("") ;
    this.obj.find("#email").val("") ;
    this.obj.find("#tempatlahir").val("") ;
    this.obj.find("#image").val("") ;
    this.obj.find("#idlimage").html("") ;
    this.obj.find("#idimage").html("") ;
    bjs.ajax(this.url + "/init") ;
  }

  bos.daftaranggota.settab     = function(n){
    this.obj.find("#tpel button:eq("+n+")").tab("show") ;
  }

  bos.daftaranggota.tabsaction  = function(n){
    if(n == 0){
      this.obj.find(".bodyfix").css("height","100%") ;
      this.obj.find(".footer").addClass("hidden") ;
      bos.daftaranggota.grid1_render() ;
      bos.daftaranggota.init() ;
    }else{
      this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
      this.obj.find(".footer").removeClass("hidden") ;
      this.obj.find("#kodefinger").focus() ;
    }
  }

  bos.daftaranggota.initcomp  = function(){
    bjs.initselect({
      class : "#" + this.id + " .select",
      clear : true
    }) ;
    bjs.initdate("#" + this.id + " .date") ;
    bjs_os.inittab(this.obj, '.tpel') ;
    bjs_os._header(this.id) ; //drag header
    this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
  } 

  bos.daftaranggota.initcallback  = function(){
    this.obj.on("bos:tab", function(e){
      bos.daftaranggota.tabsaction( e.i )  ;
    });

    this.obj.on("remove",function(){
      bos.daftaranggota.grid1_destroy() ;
    }) ;
  }

  bos.daftaranggota.objs = bos.daftaranggota.obj.find("#cmdsave") ;
  bos.daftaranggota.initfunc     = function(){
    this.init() ;
    this.grid1_loaddata() ;
    this.grid1_load() ;

    this.obj.find("#image").on("change", function(e){
      e.preventDefault() ;

            bos.daftaranggota.cfile    = e.target.files ;
            bos.daftaranggota.gfile    = new FormData() ;
            $.each(bos.daftaranggota.cfile, function(cKey,cValue){
              bos.daftaranggota.gfile.append(cKey,cValue) ;
            }) ;

            bos.daftaranggota.obj.find("#idlimage").html("<i class='fa fa-spinner fa-pulse'></i>");
            bos.daftaranggota.obj.find("#idimage").html("") ;
      bos.daftaranggota.obj.find("#image").val("") ;


            bjs.ajaxfile(bos.daftaranggota.base_url + "/saving_image", bos.daftaranggota.gfile, this) ;

    })  
    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.daftaranggota.url + '/saving', bjs.getdataform(this) , bos.daftaranggota.objs) ;
         }
      });
  }

  $(function(){
    bos.daftaranggota.initcomp() ;
    bos.daftaranggota.initcallback() ;
    bos.daftaranggota.initfunc() ;
  }) ;
</script>
