<div class="header active">
	<table class="header-table">
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tpel">
						<button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Pelanggan</button>
						<button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Pelanggan</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.mstpel.close()">
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
	<form>
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
						<td width="14%"><label for="tgl_daftar">Tgl Daftar</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" class="form-control date" id="tgl_daftar" name="tgl_daftar" required
							value=<?=date("d-m-Y")?> <?=date_set()?>>
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
						<td width="14%"><label for="nama">Alamat</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="hp">Telp</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="hp" name="hp" class="form-control" placeholder="Nomor Telp">
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
						<td width="14%"><label for="tempat_lahir">Tempat Lahir</label> </td>
						<td width="1%">:</td>
						<td width="50%">
							<input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
						</td>
						<td width="14%"><label for="tgl_lahir">Tgl Lahir</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" class="form-control date" id="tgl_lahir" name="tgl_lahir" required
							value=<?=date("d-m-Y")?> <?=date_set()?>>
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

	bos.mstpel.grid1_data 	 = null ;
	bos.mstpel.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.mstpel.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.mstpel.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [
				{ field: 'kode', caption: 'Kode', size: '120px', sortable: false},
				{ field: 'tgl_daftar', caption: 'Daftar', size: '100px', sortable: false},
				{ field: 'nama', caption: 'Nama', size: '250px', sortable: false},
				{ field: 'hp', caption: 'Hp', size: '100px', sortable: false},
			   { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.mstpel.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.mstpel.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.mstpel.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.mstpel.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.mstpel.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.mstpel.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.mstpel.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.mstpel.init				= function(){
		this.obj.find("#kode").html("") ;
		this.obj.find("#nama").val("") ;
		this.obj.find("#alamat").val("") ;
		this.obj.find("#hp").val("") ;
		this.obj.find("#email").val("") ;
		this.obj.find("#tempat_lahir").val("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.mstpel.settab 		= function(n){
		this.obj.find("#tpel button:eq("+n+")").tab("show") ;
	}

	bos.mstpel.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.mstpel.grid1_render() ;
			bos.mstpel.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#nama").focus() ;
		}
	}

	bos.mstpel.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2",
			clear : true
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.mstpel.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.mstpel.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.mstpel.grid1_destroy() ;
		}) ;
	}

	bos.mstpel.objs = bos.mstpel.obj.find("#cmdsave") ;
	bos.mstpel.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.mstpel.url + '/saving', bjs.getdataform(this) , bos.mstpel.objs) ;
         }
      });
	}

	$(function(){
		bos.mstpel.initcomp() ;
		bos.mstpel.initcallback() ;
		bos.mstpel.initfunc() ;
	}) ;
</script>
