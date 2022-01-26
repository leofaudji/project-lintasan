<div class="header active">
	<table class="header-table"> 
		<tr> 
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tpel">
						<button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Data Golongan Tabungan</button>
						<button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Input Data</button> 
					</div>
				</div> 
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr> 
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.mstkreditgolongan.close()">
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
						<td width="18%"><label for="kode">Kode</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="kode" name="kode" class="form-control" placeholder="Kode" required>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="keterangan">Keterangan</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required>
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="rekening_pokok">Rekening Pokok</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="rekening_pokok" id="rekening_pokok" class="form-control select" 
            data-sf="load_rekening" data-placeholder="Rekening Pokok" required></select>
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="rekening_bunga">Rekening Bunga</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="rekening_bunga" id="rekening_bunga" class="form-control select" 
            data-sf="load_rekening" data-placeholder="Rekening Bunga" required></select>
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="rekening_administrasi">Rekening Administrasi</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="rekening_administrasi" id="rekening_administrasi" class="form-control select" 
            data-sf="load_rekening" data-placeholder="Rekening Administrasi" required></select>
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="rekening_materai">Rekening Materai</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="rekening_materai" id="rekening_materai" class="form-control select" 
            data-sf="load_rekening" data-placeholder="Rekening Materai" required></select>
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="rekening_denda">Rekening Denda</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="rekening_denda" id="rekening_denda" class="form-control select" 
            data-sf="load_rekening" data-placeholder="Rekening Denda" required></select>
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
<script type="text/javascript">
	<?=cekbosjs();?>
	bjs.initenter($("form")) ;
	bos.mstkreditgolongan.grid1_data 	 = null ;
	bos.mstkreditgolongan.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.mstkreditgolongan.grid1_load    = function(){ 
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.mstkreditgolongan.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false, 
			columns: [
				{ field: 'kode', caption: 'Kode', size: '50px',style:'text-align:center', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false},
  		  { field: 'rekening_pokok', caption: 'Rekening Pokok', size: '150px', sortable: false},
  		  { field: 'rekening_bunga', caption: 'Rekening Bunga', size: '150px', sortable: false},
  		  { field: 'rekening_administrasi', caption: 'Rekening Administrasi', size: '150px', sortable: false},
  		  { field: 'rekening_materai', caption: 'Rekening Materai', size: '150px', sortable: false},
  		  { field: 'rekening_denda', caption: 'Rekening Denda', size: '150px', sortable: false},
  		  { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.mstkreditgolongan.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.mstkreditgolongan.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.mstkreditgolongan.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.mstkreditgolongan.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.mstkreditgolongan.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.mstkreditgolongan.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.mstkreditgolongan.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.mstkreditgolongan.init				= function(){
		this.obj.find("#kode").val("") ;
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#rekening_pokok").sval("") ;
		this.obj.find("#rekening_bunga").sval("") ;
		this.obj.find("#rekening_administrasi").sval("") ;
		this.obj.find("#rekening_materai").sval("") ;
		this.obj.find("#rekening_denda").sval("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.mstkreditgolongan.settab 		= function(n){
		this.obj.find("#tpel button:eq("+n+")").tab("show") ;
	}

	bos.mstkreditgolongan.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.mstkreditgolongan.grid1_render() ;
			bos.mstkreditgolongan.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kode").focus() ;
		}
	}

	bos.mstkreditgolongan.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select",
			clear : true
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.mstkreditgolongan.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.mstkreditgolongan.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.mstkreditgolongan.grid1_destroy() ;
		}) ;
	}

	bos.mstkreditgolongan.objs = bos.mstkreditgolongan.obj.find("#cmdsave") ;
	bos.mstkreditgolongan.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.mstkreditgolongan.url + '/saving', bjs.getdataform(this) , bos.mstkreditgolongan.objs) ;
         }
      });
	}

	$(function(){
		bos.mstkreditgolongan.initcomp() ;
		bos.mstkreditgolongan.initcallback() ;
		bos.mstkreditgolongan.initfunc() ;
	}) ;
</script>
