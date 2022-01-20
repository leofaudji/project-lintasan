<div class="header active"> 
  <table class="header-table"> 
    <tr> 
      <td class="icon" ><i class="fa fa-building"></i></td> 
      <td class="title">
        <div class="nav ">
          <div class="btn-group" id="tpel"> 
            <span> Transaksi Tabungan </span>
          </div>
        </div>
      </td>
      <td class="button">
        <table class="header-button" align="right"> 
          <tr> 
            <td> 
              <div class="btn-circle btn-close transition" onclick="bos.trtabungantransaksi.close()">
                <img src="./uploads/titlebar/close.png">
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>

<div class="body">
	<form novalidate> 
		<div class="bodyfix scrollme" style="height:100%">  
			<div class="tab-content full-height"> 
				<div>
					<table class="osxtable form" border="0">
						<tr>
							<td width="15%"><label for="tgl">Tgl</label> </td>
							<td width="1%">:</td> 
							<td> 
								<input style="width: 90px;" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>> 
							</td>
						</tr>
						<tr>
							<td width="5%"><label for="rekening">No. Rekening</label> </td>
							<td>:</td>
							<td>
								<div style="width:40%" class="input-group">
									<input type="text" id="rekening" name="rekening" class="form-control" placeholder="No. Rekening">
									<span class="input-group-btn">
										<button class="form-control btn btn-info" type="button" id="cmdrekening"><i class="fa fa-search"></i></button>
									</span>
								</div>              
							</td>    
						</tr>
						<tr>
							<td><label for="nama">Nama</label> </td>
							<td width="1%">:</td>
							<td>
								<input disabled type="text" id="nama" name="nama" class="form-control" placeholder="Nama">
							</td>
						</tr>
						<tr>
							<td><label for="alamat">Alamat</label> </td>
							<td width="1%">:</td>
							<td>
								<input disabled type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat">
							</td> 
						</tr>
						<tr>
							<td><label for="telepon">Telepon</label> </td>
							<td width="1%">:</td>
							<td>
								<input disabled style="width:40%" type="text" id="telepon" name="telepon" class="form-control" placeholder="Nomor Telepon">
							</td>
						</tr> 
						<tr>
							<td><label for="kode_transaksi">Kode Transaksi</label> </td>
							<td width="1%">:</td>
							<td>
							<select name="kode_transaksi" id="kode_transaksi" class="form-control select" style="width:40%" data-sf="load_kode_transaksi" data-placeholder="Kode Transaksi" required></select>
							</td>
						</tr> 
						<tr>
							<td><label for="kode_transaksi">Jumlah</label> </td>
							<td width="1%">:</td>
							<td> 
							<input type="text" onBlur="bos.trtabungantransaksi.sumnilai()" name="jumlah" id="jumlah"
										class="form-control number" style="font-size:12px; padding-right: 15px;width:40%" value="0" required>
							</td>
						</tr>
						<tr>
							<td width="80px"><label for="keterangan">Keterangan</label> </td>
							<td width="10px">:</td>
							<td>
								<input type="text" onBlur="bos.trtabungantransaksi.sumnilai()" name="keterangan" id="keterangan"
										class="form-control" style="font-size:12px; padding-right: 15px;" value="0" required>
							</td>
						</tr> 
					</table>
				</div>

				<div class="footer fix " style="height:32px">
					<button class="btn btn-primary btn-block" id="cmdsave">Simpan</button>
				</div>
				
				<div class="row" style="height: calc(100% - 330px);">
					<div class="col-sm-12 full-height">
						<div id="grid1" class="full-height"></div>
					</div>
				</div>

			</div>
		</div>
	</form> 
</div>    
 
<div class="modal fade" id="wrap-pencarian-d" role="dialog" data-backdrop="false" data-keyboard="false">
  <div class="modal-dialog">  
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="wm-title">Daftar Rekening</h4>
          </div>
          <div class="modal-body">
              <div id="grid3" style="height:250px"></div>
          </div> 
          <div class="modal-footer">
              *Pilih Rekening
          </div>
      </div>
  </div> 
</div> 

<script type="text/javascript">
  <?=cekbosjs();?>
	bjs.initenter($("form")) ;
  bos.trtabungantransaksi.grid1_data    = null ;
  bos.trtabungantransaksi.grid1_loaddata= function(){
    this.grid1_data     = {
      "rekening":this.obj.find("#rekening").val()          
    } ;
  }

  bos.trtabungantransaksi.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
      name    : this.id + '_grid1',
      limit   : 100 ,
      url     : bos.trtabungantransaksi.base_url + "/loadgrid",
      postData : this.grid1_data ,
      show     : {
        footer     : true,
        toolbar    : true,
        toolbarColumns  : false
      },
      multiSearch    : false,
      columns: [
        { field: 'no', caption: 'No', size: '40px',style:'text-align:center', sortable: false},
        { field: 'faktur', caption: 'Faktur', size: '120px',style:'text-align:center', sortable: false},
        { field: 'datetime', caption: 'Diproses pada', size: '180px', sortable: false},
        { field: 'kode_transaksi', caption: 'Kode',style:'text-align:center', size: '60px', sortable: false},
        { field: 'keterangan', caption: 'Keterangan', size: '220px', sortable: false},
        { field: 'debet', caption: 'Debet',style:'text-align:right', size: '100px', sortable: false}, 
        { field: 'kredit', caption: 'Kredit',style:'text-align:right', size: '100px', sortable: false}, 
        { field: 'saldoakhir', caption: 'Saldo Akhir',style:'text-align:right', size: '120px', sortable: false}
      ]
    });
   }

   bos.trtabungantransaksi.grid1_setdata  = function(){
    w2ui[this.id + '_grid1'].postData   = this.grid1_data ;
  }
  bos.trtabungantransaksi.grid1_reload    = function(){
    w2ui[this.id + '_grid1'].reload() ;
  }
  bos.trtabungantransaksi.grid1_destroy   = function(){
    if(w2ui[this.id + '_grid1'] !== undefined){
      w2ui[this.id + '_grid1'].destroy() ;
    }
  }

  bos.trtabungantransaksi.grid1_render   = function(){
    this.obj.find("#grid1").w2render(this.id + '_grid1') ;
  }

  bos.trtabungantransaksi.grid1_reloaddata  = function(){
    this.grid1_loaddata() ;
    this.grid1_setdata() ;
    this.grid1_reload() ;
  } 

	//grid3 daftarrekening
  bos.trtabungantransaksi.grid3_data    = null ;
    bos.trtabungantransaksi.grid3_loaddata= function(){
        this.grid3_data     = {} ;
  }

  bos.trtabungantransaksi.grid3_load    = function(){
      this.obj.find("#grid3").w2grid({
          name  : this.id + '_grid3',
          limit   : 100 ,
          url   : bos.trtabungantransaksi.base_url + "/loadgrid3",
          postData: this.grid3_data ,
          show: {
              footer     : true,
              toolbar    : true,
              toolbarColumns  : false
          },
          multiSearch    : false,
          columns: [
              { field: 'rekening', caption: 'No. Rekening', size: '120px', sortable: false},
              { field: 'nama', caption: 'Nama', size: '150px', sortable: false },
              { field: 'alamat', caption: 'Alamat', size: '200px', sortable: false },
              { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
          ]
      });
  }

  bos.trtabungantransaksi.grid3_setdata  = function(){
      w2ui[this.id + '_grid3'].postData   = this.grid3_data ;
  }
  bos.trtabungantransaksi.grid3_reload    = function(){
      w2ui[this.id + '_grid3'].reload() ;
  }
  bos.trtabungantransaksi.grid3_destroy   = function(){
      if(w2ui[this.id + '_grid3'] !== undefined){ 
          w2ui[this.id + '_grid3'].destroy() ;
      }
  }

  bos.trtabungantransaksi.grid3_render   = function(){
      this.obj.find("#grid3").w2render(this.id + '_grid3') ;
  }

  bos.trtabungantransaksi.grid3_reloaddata  = function(){
      this.grid3_loaddata() ;
      this.grid3_setdata() ;
      this.grid3_reload() ;
  }

	bos.trtabungantransaksi.cmdpilih     = function(rekening){
    bjs.ajax(this.url + '/pilih', 'rekening=' + rekening);
  }

  bos.trtabungantransaksi.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.trtabungantransaksi.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  var nOnline = 0 ;
  bos.trtabungantransaksi.init        = function(){ 
    this.obj.find("#kode_transaksi").html("") ;
    this.obj.find("#jumlah").val("0") ;
    this.obj.find("#keterangan").val("") ;
    bjs.ajax(this.url + "/init") ;    
  } 

  
  bos.trtabungantransaksi.sumnilai = function() {
      var total = 0 ;
      var kembalian = 0 ;
       
  }  

  bos.trtabungantransaksi.initcomp  = function(){ 
    bjs.initselect({ 
      class : "#" + this.id + " .select"
    }) ;
    bjs.initdate("#" + this.id + " .date") ;
    bjs_os.inittab(this.obj, '.tpel') ;

		this.grid3_load() ;  

    bjs_os._header(this.id) ; //drag header
    this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
  } 

  bos.trtabungantransaksi.initcallback  = function(){
    this.obj.on("bos:tab", function(e){
      bos.trtabungantransaksi.tabsaction( e.i )  ;   
    });  

    this.obj.on("remove",function(){
      bos.trtabungantransaksi.grid1_destroy() ;
			bos.trtabungantransaksi.grid3_destroy() ; 
    }) ;

    this.obj.find("#rekening").on("select2:select", function(e){ 
      bjs.ajax(bos.trtabungantransaksi.url+"/seekrekening", "rekening=" + $(this).val()) ;
    }) ; 

    this.obj.find("#kode_transaksi").on("select2:select", function(e){ 
      bjs.ajax(bos.trtabungantransaksi.url+"/seekketerangan", "kode_transaksi=" + $(this).val()) ;
    }) ; 
      
  }

	bos.trtabungantransaksi.loadmodelstock      = function(l){
    this.obj.find("#wrap-pencarian-d").modal(l) ; 
  }

  bos.trtabungantransaksi.objs = bos.trtabungantransaksi.obj.find("#cmdsave") ;
  bos.trtabungantransaksi.initfunc     = function(){
    this.init() ;
    this.grid1_loaddata() ;
    this.grid1_load() ;

    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            if(confirm("Apakah Anda yakin ?")){ 
              bjs.ajax( bos.trtabungantransaksi.url + '/saving', bjs.getdataform(this) , bos.trtabungantransaksi.objs) ;
            }
         }
      });
  
      
		this.obj.find("#cmdrekening").on("click", function(e){
          bos.trtabungantransaksi.loadmodelstock("show"); 
          bos.trtabungantransaksi.grid3_reloaddata() ;
      }) ;
  
  }
  
  
  $(function(){
    bos.trtabungantransaksi.initcomp() ;
    bos.trtabungantransaksi.initcallback() ;
    bos.trtabungantransaksi.initfunc() ;
    UpdateTimes() ;

    var nOnline = 0 ;  
    function UpdateTimes(){  
      if(nOnline >= 30){  
          nOnline = 0 ;
             //bjs.ajax(bos.trtabungantransaksi.url+"/seekpelauto") ; 
        }  
        nOnline ++ ; 
        setTimeout(UpdateTimes,1000) ;
    }
  }) ;


</script>
