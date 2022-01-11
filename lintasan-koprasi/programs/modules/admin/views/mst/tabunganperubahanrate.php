<div class="header active">
	<table class="header-table"> 
		<tr> 
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tpel">
						<button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Data Perubahan Sukubunga</button>
						<button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Input Data</button>
					</div>
				</div> 
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr> 
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.tabunganperubahanrate.close()">
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
						<td><label for="tgl">Tgl</label> </td>
						<td>:</td>
						<td>
							<input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="rekening">Golongan Tabungan</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="golongan_tabungan" id="golongan_tabungan" class="form-control select" style="width:30%"
            data-sf="load_tabungan_golongan" data-placeholder="Golongan Tabungan" required></select>
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="keterangan">Keterangan</label> </td>
						<td width="1%">:</td>
						<td>
							<input style="width:60%" type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required>
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="sukubunga">Suku Bunga</label> </td>
						<td width="1%">:</td>
						<td> 
							<input type="text" name="sukubunga" id="sukubunga" class="form-control number" style="font-size:12px; padding-right: 15px;width:30%;" value="0">
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
	bjs.initenter($("form")) ;
	bos.tabunganperubahanrate.grid1_data 	 = null ;
	bos.tabunganperubahanrate.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.tabunganperubahanrate.grid1_load    = function(){ 
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.tabunganperubahanrate.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false, 
			columns: [
				{ field: 'tgl', caption: 'Tgl', size: '80px', style:'text-align:center', sortable: false},
				{ field: 'golongan_tabungan', caption: 'Golongan Tabungan', size: '150px', sortable: false},
  		  { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false},
  		  { field: 'sukubunga', caption: 'Sukubunga', style:'text-align:right', size: '80px', sortable: false},
  		  { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.tabunganperubahanrate.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.tabunganperubahanrate.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.tabunganperubahanrate.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.tabunganperubahanrate.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.tabunganperubahanrate.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.tabunganperubahanrate.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.tabunganperubahanrate.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.tabunganperubahanrate.init				= function(){
		this.obj.find("#golongan_tabungan").sval("") ;
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#sukubunga").val("0") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.tabunganperubahanrate.settab 		= function(n){
		this.obj.find("#tpel button:eq("+n+")").tab("show") ;
	}

	bos.tabunganperubahanrate.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.tabunganperubahanrate.grid1_render() ;
			bos.tabunganperubahanrate.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kode").focus() ;
		}
	}

	bos.tabunganperubahanrate.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select",
			clear : true
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.tabunganperubahanrate.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.tabunganperubahanrate.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.tabunganperubahanrate.grid1_destroy() ;
		}) ;
	}

	bos.tabunganperubahanrate.objs = bos.tabunganperubahanrate.obj.find("#cmdsave") ;
	bos.tabunganperubahanrate.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.tabunganperubahanrate.url + '/saving', bjs.getdataform(this) , bos.tabunganperubahanrate.objs) ;
         }
      });
	}

	$(function(){
		bos.tabunganperubahanrate.initcomp() ;
		bos.tabunganperubahanrate.initcallback() ;
		bos.tabunganperubahanrate.initfunc() ;
	}) ;
</script>
