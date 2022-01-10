<div class="header active">
	<table class="header-table">
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tbk">
						<button class="btn btn-tab tbk active" href="#tbk_1" data-toggle="tab" >Daftar Kategori</button>
						<button class="btn btn-tab tbk" href="#tbk_2" data-toggle="tab">Kategori</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.mstbk.close()">
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
			<div role="tabpanel" class="tab-pane active full-height" id="tbk_1" style="padding-top:5px;">
				<div id="grid1" class="full-height"></div>
			</div>
			<div role="tabpanel" class="tab-pane fade full-height" id="tbk_2">
				<div class="form-group">
					<label for="">Kategori</label>
					<input type="text" class="form-control" id="kategori" name="kategori" required>
				</div>
				<div class="form-group">
					<label for="">Keterangan</label>
					<input type="text" class="form-control" id="keterangan" name="keterangan">
				</div>
			</div>
		</div>
	</div>
	<div class="footer fix hidden" style="height:32px">
		<button class="btn btn-primary pull-right" id="cmdsave">Save</button>
	</div>
	</form>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.mstbk.grid1_data 	 = null ;
	bos.mstbk.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.mstbk.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.mstbk.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [
				{ field: 'kategori', caption: 'Kategori', size: '225px', sortable: false},
			   { field: 'cmdedit', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.mstbk.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.mstbk.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.mstbk.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.mstbk.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.mstbk.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.mstbk.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.mstbk.cmddelete		= function(cid){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.mstbk.init				= function(){
		this.obj.find("#kategori").val("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.mstbk.settab 		= function(n){
		this.obj.find("#tbk button:eq("+n+")").tab("show") ;
	}

	bos.mstbk.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.mstbk.grid1_render() ;
			bos.mstbk.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kategori").focus() ;
		}
	}

	bos.mstbk.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2",
			clear : true
		}) ;
		bjs_os.inittab(this.obj, '.tbk') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.mstbk.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.mstbk.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.mstbk.grid1_destroy() ;
		}) ;
	}

	bos.mstbk.objs = bos.mstbk.obj.find("#cmdsave") ;
	bos.mstbk.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.mstbk.url + '/saving', bjs.getdataform(this) , bos.mstbk.objs) ;
         }
      });
	}

	$(function(){
		bos.mstbk.initcomp() ;
		bos.mstbk.initcallback() ;
		bos.mstbk.initfunc() ;
	}) ;
</script>
