<style media="screen">
   #bos-form-trkasir-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-trkasir-wrapper .info{border-radius: 4px; margin-right: 20px}
</style>
<form novalidate> 
<div class="bodyfix scrollme" style="height:100%">  
   <table class="osxtable form" border="0">
    <tr> 
      <td width="14%"><label for="tgl_daftar">Tgl</label> </td>
      <td width="1%">:</td>
      <td>
        <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
      </td>
      <td width="100px"><label for="faktur">Pelanggan</label> </td>
      <td width="10px">:</td>
      <td colspan="4">  
              <select name="pelanggan" id="pelanggan" class="form-control select" style="width:100%"
              data-sf="load_pelanggan" data-placeholder="Pelanggan" required></select>
              <input type="hidden" name="pelanggan2" id="pelanggan2">
      </td>
    </tr>
    <tr>
      <td width="80px"><label for="pendaftaran">Pendaftaran</label> </td>
      <td width="10px">:</td>
      <td width="200px">
        <input type="text" onBlur="bos.trkasir.sumnilai()" name="pendaftaran" id="pendaftaran"
            class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
      </td>
      <td width="80px"><label for="kode">Kode</label> </td>
      <td width="10px">:</td>
      <td> 
        <div id="kode"></div>  
      </td>
      <td width="220px" height="100px" rowspan="5" style="border:1px solid #ced5e0" id="foto" align="center" valign="top">foto
      </td>
    </tr>
    <tr>
      <td width="80px"><label for="iuran">Iuran</label> </td>
      <td width="10px">:</td>
      <td>
        <input type="text" onBlur="bos.trkasir.sumnilai()" name="iuran" id="iuran"
            class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
      </td>
      <td width="80px"><label for="nama">Nama</label> </td>
      <td width="10px">:</td>
      <td>
        <div id="nama"></div>
      </td>
    </tr>
    <tr>
      <td width="80px"><label for="sewa">Sewa Gedung</label> </td>
      <td width="10px">:</td>
      <td>
        <input type="text" onBlur="bos.trkasir.sumnilai()" name="sewagedung" id="sewagedung"
            class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
      </td>
      <td width="80px"><label for="alamat">Alamat</label> </td>
      <td width="10px">:</td>
      <td>
        <div id="alamat"></div>
      </td>
    </tr>
    <tr>
      <td width="80px"><label for="suplemen">By.Suplemen</label> </td>
      <td width="10px">:</td>
      <td>
        <input type="text" onBlur="bos.trkasir.sumnilai()" name="suplemen" id="suplemen"
            class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
      </td>
      <td width="80px"><label for="telepon">Telepon</label> </td>
      <td width="10px">:</td>
      <td>
        <div id="telepon"></div>
      </td>
    </tr>
    <tr>
      <td width="80px"><label for="lainnya">Lainnya</label> </td>
      <td width="10px">:</td>
      <td>
        <input type="text" onBlur="bos.trkasir.sumnilai()" name="lainnya" id="lainnya"
            class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
      </td>
      <td width="80px"><label for="status">Status</label> </td>
      <td width="10px">:</td>
      <td>
        <div id="status"></div>
      </td>
    </tr>
    <tr>
      <td width="80px"><label for="total">Total</label> </td>
      <td width="10px">:</td>
      <td>
        <input type="text" disabled name="total" id="total"
            class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
      </td>
      <td width="80px"><label for="keterangan">Keterangan</label> </td>
      <td width="10px">:</td>
      <td colspan="2">  
        <input type="text" name="keterangan" id="keterangan"
            class="form-control" style="font-size:12px; padding-right: 15px;" required>
      </td>
    </tr> 
    <tr>
      <td width="80px"><label for="bayar">Bayar</label> </td>
      <td width="10px">:</td>
      <td>
        <input type="text" onBlur="bos.trkasir.sumnilai()" name="bayar" id="bayar"
            class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
      </td>
      <td colspan="4" align="right">
        <button type="submit" name="cmdabsen" id="cmdabsen"
                class="btn btn-primary btn-block" style="height: 30px">Absen</button>
          </td>
    </tr>
    <tr>
      <td width="80px"><label for="sewa">Kembalian</label> </td>
      <td width="10px">:</td>
      <td>
        <input type="text" disabled name="kembalian" id="kembalian"
            class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
      </td>
      <td colspan="4" align="right">
        <button type="submit" name="cmdsave" id="cmdsave"
                class="btn btn-primary btn-block" style="height: 30px">Bayar</button>
          </td>
    </tr>

    <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
   </table>
   <div class="row" style="height: calc(100% - 330px);">
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div>
   </div>
</div>
</form>
<script type="text/javascript">
  <?=cekbosjs();?>

  bos.trkasir.grid1_data    = null ;
  bos.trkasir.grid1_loaddata= function(){
    this.grid1_data     = {
      "pelanggan":this.obj.find("#pelanggan").val(),
      "pelanggan2":this.obj.find("#pelanggan2").val()
    } ;
  }

  bos.trkasir.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
      name    : this.id + '_grid1',
      limit   : 100 ,
      url     : bos.trkasir.base_url + "/loadgrid",
      postData : this.grid1_data ,
      show     : {
        footer     : true,
        toolbar    : true,
        toolbarColumns  : false
      },
      multiSearch    : false,
      columns: [
        { field: 'no', caption: 'No', size: '30px', sortable: false},
        { field: 'pelanggan', caption: 'Kode', size: '80px', sortable: false},
        { field: 'faktur', caption: 'FKT', size: '100px', sortable: false},
        { field: 'datetime', caption: 'Datetime', size: '140px', sortable: false},
        { field: 'keterangan', caption: 'Keterangan', size: '220px', sortable: false},
        { field: 'jumlah', caption: 'Nominal',style:'text-align:right', size: '100px', sortable: false}, 
        { field: 'username', caption: 'Username', size: '80px', sortable: false}
      ]
    });
   }

   bos.trkasir.grid1_setdata  = function(){
    w2ui[this.id + '_grid1'].postData   = this.grid1_data ;
  }
  bos.trkasir.grid1_reload    = function(){
    w2ui[this.id + '_grid1'].reload() ;
  }
  bos.trkasir.grid1_destroy   = function(){
    if(w2ui[this.id + '_grid1'] !== undefined){
      w2ui[this.id + '_grid1'].destroy() ;
    }
  }

  bos.trkasir.grid1_render   = function(){
    this.obj.find("#grid1").w2render(this.id + '_grid1') ;
  }

  bos.trkasir.grid1_reloaddata  = function(){
    this.grid1_loaddata() ;
    this.grid1_setdata() ;
    this.grid1_reload() ;
  }

  bos.trkasir.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.trkasir.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  var nOnline = 0 ;
  bos.trkasir.init        = function(){ 
    this.obj.find("#keterangan").val("") ;
    this.obj.find("#pendaftaran").val("0") ;
    this.obj.find("#iuran").val("0") ;
    this.obj.find("#sewagedung").val("0") ;
    this.obj.find("#suplemen").val("0") ;
    this.obj.find("#total").val("0") ;
    bjs.ajax(this.url + "/init") ;    
  } 

  
  bos.trkasir.sumnilai = function() {
      var total = 0 ;
      var kembalian = 0 ;
      total += Number($("#pendaftaran").val()) ;
      total += Number($("#iuran").val()) ;
      total += Number($("#sewagedung").val()) ;
      total += Number($("#suplemen").val()) ;
      total += Number($("#lainnya").val()) ; 
      $("#total").val(total);
      
      kembalian = Number($("#bayar").val()) - total ; 
      $("#kembalian").val(kembalian); 
  }  

  bos.trkasir.initcomp  = function(){ 
    bjs.initselect({ 
      class : "#" + this.id + " .select"
    }) ;
    bjs.initdate("#" + this.id + " .date") ;
    bjs_os.inittab(this.obj, '.tpel') ;
    bjs_os._header(this.id) ; //drag header
    this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
  } 

  bos.trkasir.initcallback  = function(){
    this.obj.on("bos:tab", function(e){
      bos.trkasir.tabsaction( e.i )  ;   
    });  

    this.obj.on("remove",function(){
      bos.trkasir.grid1_destroy() ;
    }) ;

    this.obj.find("#pelanggan").on("select2:select", function(e){ 
           bjs.ajax(bos.trkasir.url+"/seekpel", "pelanggan=" + $(this).val()) ;
        }) ; 
      
  }

  bos.trkasir.objs = bos.trkasir.obj.find("#cmdsave") ;
  bos.trkasir.initfunc     = function(){
    this.init() ;
    this.grid1_loaddata() ;
    this.grid1_load() ;

    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            if(confirm("Apakah Anda yakin ?")){ 
              bjs.ajax( bos.trkasir.url + '/saving', bjs.getdataform(this) , bos.trkasir.objs) ;
            }
         }
      });
  
    bos.trkasir.obj.find("#cmdabsen").on("click", function(){
       if(confirm("Absen Masuk?")){ 
          bjs.ajax( bos.trkasir.url + '/absen', bjs.getdataform(this) , bos.trkasir.objs) ;
       }
    }) ;
  
  }
  
  
  $(function(){
    bos.trkasir.initcomp() ;
    bos.trkasir.initcallback() ;
    bos.trkasir.initfunc() ;
    UpdateTimes() ;

    var nOnline = 0 ;  
    function UpdateTimes(){  
      if(nOnline >= 5){  
          nOnline = 0 ;
             bjs.ajax(bos.trkasir.url+"/seekpelauto") ;
        }  
        nOnline ++ ; 
        setTimeout(UpdateTimes,1000) ;
    }
  }) ;


</script>
