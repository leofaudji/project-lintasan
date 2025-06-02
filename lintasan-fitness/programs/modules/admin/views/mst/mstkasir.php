<div class="header active">
	<table class="header-table"> 
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title"> 
				<div class="nav "> 
					<div class="btn-group" id="tpel"> 
						<button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Pelanggan</button>
						<button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Bayar</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">  
					<tr> 
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.mstkasir.close()">
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
				<table class="osxtable form">
			  		<tr>
						<td width="14%"><label for="sku">Kode</label> </td>
						<td width="1%">:</td>
						<td width="50%">
							<div id="kode"></div>
						</td>
						<td width="14%"><label for="tgl">Tgl Daftar</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" class="form-control date" id="tgl" name="tgl" required
							value=<?=date("d-m-Y")?> <?=date_set()?>>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="kodefinger">Kode Finger</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="kodefinger" name="kodefinger" class="form-control" placeholder="Kode Finger" required>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="nama">Nama</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="alamat">Alamat</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="telepon">Telp</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="telepon" name="telepon" class="form-control" placeholder="Nomor Telp">
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="email">Email</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="email" name="email" class="form-control" placeholder="Email">
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="tempatlahir">Tempat Lahir</label> </td>
						<td width="1%">:</td>
						<td width="50%">
							<input type="text" id="tempatlahir" name="tempatlahir" class="form-control" placeholder="Tempat Lahir">
						</td>
						<td width="14%"><label for="tgllahir">Tgl Lahir</label> </td>
						<td width="1%">:</td>
						<td> 
							<input type="text" class="form-control date" id="tgllahir" name="tgllahir" required
							value=<?=date("d-m-Y")?> <?=date_set()?>>
						</td>
					</tr>

					<tr>
						<td width="14%"><label for="jeniskelamin">Jenis Kelamin</label> </td>
						<td width="1%">:</td>
						<td width="50%">
							<div class="radio-inline">
								<label>
									<input type="radio" name="jeniskelamin" class="jeniskelamin" value="L" checked>
									Laki-laki
								</label>
								&nbsp;&nbsp;
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="jeniskelamin" class="jeniskelamin" value="P">
									Perempuan
								</label>
							</div>
						</td>
					</tr>  
					<tr>
						<td width="14%"><label for="statuspelanggan">Status</label> </td>
						<td width="1%">:</td>
						<td width="50%">
							<div class="radio-inline">
								<label>
									<input type="radio" name="statuspelanggan" class="statuspelanggan" value="U" checked>
									Umum
								</label>
								&nbsp;&nbsp;
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="statuspelanggan" class="statuspelanggan" value="D">
									Khusus Diskon
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="statuspelanggan" class="statuspelanggan" value="P">
									Pelajar
								</label>
							</div>
						</td>
					</tr>  
				</table>
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

	bos.mstkasir.grid1_data 	 = null ;
	bos.mstkasir.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.mstkasir.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.mstkasir.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [
				{ field: 'kode', caption: 'Kode', size: '100px', sortable: false},
				{ field: 'nama', caption: 'Nama', size: '200px', sortable: false},
				{ field: 'alamat', caption: 'Alamat', size: '200px', sortable: false},
				{ field: 'statuspelanggan', caption: 'Status', size: '100px', sortable: false},
				{ field: 'jam', caption: 'Jam', size: '60px', sortable: false},
			   { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.mstkasir.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.mstkasir.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.mstkasir.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.mstkasir.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.mstkasir.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.mstkasir.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.mstkasir.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.mstkasir.init				= function(){
		this.obj.find("#kodefinger").html("") ;
		this.obj.find("#nama").val("") ;
		this.obj.find("#alamat").val("") ;
		this.obj.find("#telepon").val("") ;
		this.obj.find("#email").val("") ;
		this.obj.find("#tempatlahir").val("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.mstkasir.settab 		= function(n){
		this.obj.find("#tpel button:eq("+n+")").tab("show") ;
	}

	bos.mstkasir.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.mstkasir.grid1_render() ;
			bos.mstkasir.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kodefinger").focus() ;
		}
	}

	bos.mstkasir.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2",
			clear : true
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.mstkasir.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.mstkasir.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.mstkasir.grid1_destroy() ;
		}) ;
	}

	bos.mstkasir.objs = bos.mstkasir.obj.find("#cmdsave") ;
	bos.mstkasir.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.mstkasir.url + '/saving', bjs.getdataform(this) , bos.mstkasir.objs) ;
         }
      });
	} 

	$(function(){
		bos.mstkasir.initcomp() ;
		bos.mstkasir.initcallback() ;
		bos.mstkasir.initfunc() ;
	}) ;
</script>
