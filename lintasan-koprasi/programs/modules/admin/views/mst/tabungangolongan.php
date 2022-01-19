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
							<div class="btn-circle btn-close transition" onclick="bos.tabungangolongan.close()">
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
						<td width="14%"><label for="rekening">Rekening</label> </td>
						<td width="1%">:</td>
						<td>
						<select name="rekening" id="rekening" class="form-control select" 
            data-sf="load_rekening" data-placeholder="Rekening" required></select>
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
						<td width="14%"><label for="saldo_minimum">Saldo Minimum</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" name="saldo_minimum" id="saldo_minimum" class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="saldo_minimum_bunga">Saldo Minimum Dapat Bunga</label> </td>
						<td width="1%">:</td>
						<td>
						<input type="text" name="saldo_minimum_bunga" id="saldo_minimum_bunga" class="form-control number" style="font-size:12px; padding-right: 15px;" value="0">
						</td>
					</tr> 
					<tr>
						<td width="14%"><label for="rate">Rate</label> </td>
						<td width="1%">:</td>
						<td> 
						<select name="rate" id="rate" class="form-control select" data-sf="load_rate" data-placeholder="Rate Suku Bunga" required></select>
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
	bos.tabungangolongan.grid1_data 	 = null ;
	bos.tabungangolongan.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.tabungangolongan.grid1_load    = function(){ 
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.tabungangolongan.base_url + "/loadgrid",
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
  		  { field: 'rekening', caption: 'Rekening', size: '100px', sortable: false},
  		  { field: 'rekening_bunga', caption: 'Rekening Bunga', size: '100px', sortable: false},
  		  { field: 'saldo_minimum', caption: 'Saldo Min', style:'text-align:right', size: '100px', sortable: false},
  		  { field: 'saldo_minimum_bunga', caption: 'Saldo Min Dapat Bunga', style:'text-align:right', size: '100px', sortable: false},
  		  { field: 'rate', caption: 'Rate', size: '100px', style:'text-align:right', sortable: false},
  		  { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.tabungangolongan.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.tabungangolongan.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.tabungangolongan.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.tabungangolongan.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.tabungangolongan.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.tabungangolongan.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.tabungangolongan.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.tabungangolongan.init				= function(){
		this.obj.find("#kode").html("") ;
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#rekening").sval("") ;
		this.obj.find("#rekening_bunga").sval("") ;
		this.obj.find("#saldo_minimum").val("0") ;
		this.obj.find("#saldo_minimum_bunga").val("0") ;
		this.obj.find("#rate").sval("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.tabungangolongan.settab 		= function(n){
		this.obj.find("#tpel button:eq("+n+")").tab("show") ;
	}

	bos.tabungangolongan.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.tabungangolongan.grid1_render() ;
			bos.tabungangolongan.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kode").focus() ;
		}
	}

	bos.tabungangolongan.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select",
			clear : true
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.tabungangolongan.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.tabungangolongan.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.tabungangolongan.grid1_destroy() ;
		}) ;
	}

	bos.tabungangolongan.objs = bos.tabungangolongan.obj.find("#cmdsave") ;
	bos.tabungangolongan.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.tabungangolongan.url + '/saving', bjs.getdataform(this) , bos.tabungangolongan.objs) ;
         }
      });
	}

	$(function(){
		bos.tabungangolongan.initcomp() ;
		bos.tabungangolongan.initcallback() ;
		bos.tabungangolongan.initfunc() ;
	}) ;
</script>
