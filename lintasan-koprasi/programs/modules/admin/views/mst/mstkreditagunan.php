<div class="header active">
	<table class="header-table"> 
		<tr> 
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tpel">
						<button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Agama</button>
						<button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Jenis Agunan</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr> 
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.mstkreditagunan.close()">
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
						<td width="14%"><label for="kode">Kode</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="kode" name="kode" class="form-control" placeholder="Kode" required>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="keterangan">Keterangan</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required>
						</td>
					</tr> 
					<tr>
						<td width="14%" valign="top"><label for="data_kategori">Data Kategori</label> </td>
						<td width="1%" valign="top">:</td>  
						<td colspan="4">
							<textarea id="data_kategori" name="data_kategori" class="form-control" placeholder="Data Kategori" rows="18" required></textarea>
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
	bos.mstkreditagunan.grid1_data 	 = null ;
	bos.mstkreditagunan.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.mstkreditagunan.grid1_load    = function(){ 
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.mstkreditagunan.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false, 
			columns: [
				{ field: 'kode', caption: 'Kode', size: '60px',style:'text-align:center', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '400px', sortable: false},
			  { field: 'data_kategori', caption: 'Data Kategori', size: '200px', sortable: false},
			  { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.mstkreditagunan.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.mstkreditagunan.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.mstkreditagunan.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.mstkreditagunan.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.mstkreditagunan.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.mstkreditagunan.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.mstkreditagunan.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id); 
		}
	}

	bos.mstkreditagunan.init				= function(){
		this.obj.find("#kode").val("") ;
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#data_kategori").val("") ; 
		bjs.ajax(this.url + "/init") ;
	}

	bos.mstkreditagunan.settab 		= function(n){
		this.obj.find("#tpel button:eq("+n+")").tab("show") ;
	}

	bos.mstkreditagunan.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.mstkreditagunan.grid1_render() ;
			bos.mstkreditagunan.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kode").focus() ;
		}
	}

	bos.mstkreditagunan.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2",
			clear : true
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.mstkreditagunan.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.mstkreditagunan.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.mstkreditagunan.grid1_destroy() ;
		}) ;
	}

	bos.mstkreditagunan.objs = bos.mstkreditagunan.obj.find("#cmdsave") ;
	bos.mstkreditagunan.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.mstkreditagunan.url + '/saving', bjs.getdataform(this) , bos.mstkreditagunan.objs) ;
         }
      });
	}

	$(function(){
		bos.mstkreditagunan.initcomp() ;
		bos.mstkreditagunan.initcallback() ;
		bos.mstkreditagunan.initfunc() ;
	}) ;
</script>
