<div class="header active">
	<table class="header-table">
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tbs">
						<button class="btn btn-tab tbs active" href="#tbs_1" data-toggle="tab" >Daftar Satuan</button>
						<button class="btn btn-tab tbs" href="#tbs_2" data-toggle="tab">Satuan</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.mstbs.close()">
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
			<div role="tabpanel" class="tab-pane active full-height" id="tbs_1" style="padding-top:5px;">
				<div id="grid1" class="full-height"></div>
			</div>
			<div role="tabpanel" class="tab-pane fade full-height" id="tbs_2">
				<div class="form-group">
					<label for="">Satuan</label>
					<input type="text" class="form-control" id="satuan" name="satuan" required>
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

	bos.mstbs.grid1_data 	 = null ;
	bos.mstbs.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.mstbs.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.mstbs.base_url + "/loadgrid",
			postData : this.grid1_data ,
			columns: [
				{ field: 'satuan', caption: 'Satuan', size: '225px', sortable: false},
			   { field: 'cmdedit', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.mstbs.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.mstbs.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.mstbs.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.mstbs.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.mstbs.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.mstbs.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.mstbs.cmddelete		= function(cid){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.mstbs.init				= function(){
		this.obj.find("#satuan").val("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.mstbs.settab 		= function(n){
		this.obj.find("#tbs button:eq("+n+")").tab("show") ;
	}

	bos.mstbs.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.mstbs.grid1_render() ;
			bos.mstbs.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#satuan").focus() ;
		}
	}

	bos.mstbs.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2",
			clear : true
		}) ;
		bjs_os.inittab(this.obj, '.tbs') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.mstbs.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.mstbs.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.mstbs.grid1_destroy() ;
		}) ;
	}

	bos.mstbs.objs = bos.mstbs.obj.find("#cmdsave") ;
	bos.mstbs.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.mstbs.url + '/saving', bjs.getdataform(this) , bos.mstbs.objs) ;
         }
      });
	}

	$(function(){
		bos.mstbs.initcomp() ;
		bos.mstbs.initcallback() ;
		bos.mstbs.initfunc() ;
	}) ;
</script>
