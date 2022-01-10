<div class="header active">  
	<table class="header-table">  
		<tr>  
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">  
				<div class="nav "> 
					<div class="btn-group" id="tpel">
						<button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Daftar Tarif</button>
						<button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Tarif</button>
					</div>
				</div> 
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.msttarif.close()">
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
							<input type="text" id="kode" name="kode" class="form-control" placeholder="Kode" required>
						</td>
						<td width="14%"><label for="tgl_daftar">Tgl</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
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
						<td width="14%"><label for="jumlah">Jumlah</label> </td>
						<td width="1%">:</td>
						<td colspan="4">
							<input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" required>
						</td>
					</tr>
					<tr>
						<td width="100px"><label for="rekening">Rekening</label> </td>
						<td width="10px">:</td>
						<td colspan="6"> 
			            	<select name="rekening" id="rekening" class="form-control select" style="width:100%"
			            	data-sf="load_rekening" data-placeholder="Rekening" required></select>
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

	bos.msttarif.grid1_data 	 = null ;
	bos.msttarif.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.msttarif.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.msttarif.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [
				{ field: 'kode', caption: 'Kode', size: '80px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '250px', sortable: false},
				{ field: 'tgl', caption: 'Tanggal',style:'text-align:center', size: '100px', sortable: false},
				{ field: 'jumlah', caption: 'Jumlah', style:'text-align:right',size: '100px', sortable: false},
				{ field: 'rekening', caption: 'Rekening', size: '100px', sortable: false},       
			     { field: 'cmdedit', caption: ' ', size: '80px', sortable: false }, 
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.msttarif.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.msttarif.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.msttarif.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.msttarif.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.msttarif.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.msttarif.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.msttarif.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.msttarif.init				= function(){
		this.obj.find("#kode").html("") ;
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#jumlah").val("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.msttarif.settab 		= function(n){
		this.obj.find("#tpel button:eq("+n+")").tab("show") ;
	}

	bos.msttarif.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.msttarif.grid1_render() ;
			bos.msttarif.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kode").focus() ;
		}
	}

	bos.msttarif.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select",
			clear : true
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.msttarif.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.msttarif.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.msttarif.grid1_destroy() ;
		}) ;
	}

	bos.msttarif.objs = bos.msttarif.obj.find("#cmdsave") ;
	bos.msttarif.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.msttarif.url + '/saving', bjs.getdataform(this) , bos.msttarif.objs) ;
         }
      });
	}

	$(function(){
		bos.msttarif.initcomp() ;
		bos.msttarif.initcallback() ;
		bos.msttarif.initfunc() ;
	}) ;
</script>
