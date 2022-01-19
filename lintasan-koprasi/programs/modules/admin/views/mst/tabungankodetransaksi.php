<div class="header active">
	<table class="header-table"> 
		<tr> 
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tpel">
						<button class="btn btn-tab tpel active" href="#tpel_1" data-toggle="tab" >Data Kode Transaksi</button>
						<button class="btn btn-tab tpel" href="#tpel_2" data-toggle="tab">Input Data</button>
					</div>
				</div> 
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr> 
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.tabungankodetransaksi.close()">
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
						<td width="14%"><label for="dk">D / K</label> </td>
						<td width="1%">:</td>
						<td width="50%">
							<div class="radio-inline">
								<label>
									<input type="radio" name="dk" class="dk" value="D" checked>
									Debet
								</label>
								&nbsp;&nbsp;
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="dk" class="dk" value="K">
									Kredit
								</label>
							</div>
						</td>
					</tr>  
					<tr>
						<td width="14%"><label for="rekening">Rekening</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="rekening" id="rekening" class="form-control select" 
            data-sf="load_rekening" data-placeholder="Rekening" required></select>
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
	bos.tabungankodetransaksi.grid1_data 	 = null ;
	bos.tabungankodetransaksi.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.tabungankodetransaksi.grid1_load    = function(){ 
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.tabungankodetransaksi.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false, 
			columns: [
				{ field: 'kode', caption: 'Kode', size: '80px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '150px', sortable: false},
  		  { field: 'dk', caption: 'DK', size: '100px', style:'text-align:center', sortable: false},
  		  { field: 'rekening', caption: 'Rekening', size: '100px', sortable: false},
  		  { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.tabungankodetransaksi.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.tabungankodetransaksi.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.tabungankodetransaksi.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.tabungankodetransaksi.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.tabungankodetransaksi.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.tabungankodetransaksi.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.tabungankodetransaksi.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.tabungankodetransaksi.init				= function(){
		this.obj.find("#kode").html("") ;
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#rekening").sval("") ;
		this.obj.find("#dk").sval("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.tabungankodetransaksi.settab 		= function(n){
		this.obj.find("#tpel button:eq("+n+")").tab("show") ;
	}

	bos.tabungankodetransaksi.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.tabungankodetransaksi.grid1_render() ;
			bos.tabungankodetransaksi.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kode").focus() ;
		}
	}

	bos.tabungankodetransaksi.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select",
			clear : true
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.tabungankodetransaksi.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.tabungankodetransaksi.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.tabungankodetransaksi.grid1_destroy() ;
		}) ;
	}

	bos.tabungankodetransaksi.objs = bos.tabungankodetransaksi.obj.find("#cmdsave") ;
	bos.tabungankodetransaksi.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.tabungankodetransaksi.url + '/saving', bjs.getdataform(this) , bos.tabungankodetransaksi.objs) ;
         }
      });
	}

	$(function(){
		bos.tabungankodetransaksi.initcomp() ;
		bos.tabungankodetransaksi.initcallback() ;
		bos.tabungankodetransaksi.initfunc() ;
	}) ;
</script>
