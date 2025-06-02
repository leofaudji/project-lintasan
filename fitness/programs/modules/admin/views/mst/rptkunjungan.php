<style media="screen">
   #bos-form-rptkunjungan-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptkunjungan-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
<div class="bodyfix scrollme" style="height:100%"> 
   <table class="osxtable form" border="0">
		<tr>
			<td width="100px"><label for="tgl">Tgl</label> </td>
			<td width="20px">:</td>
			<td>
				<input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
				 
			</td>   
			<td>&nbsp;s/d&nbsp;</td>
			<td>  
				<input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td> 
			<td width="400px"></td>
			<td width="100px"> 
				<button class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
			</td>
			<td width="100px">	
				<button class="btn btn-primary pull-right" id="cmdview">Preview</button>
			</td>
		</tr>          
		<!--
		<tr>
			<td width="14%"><label for="jeniskelamin">Status Pelanggan</label> </td>
			<td width="1%">:</td>
			<td width="50%" colspan="4">
				<div class="radio-inline">
					<label>
						<input type="radio" name="statuspelanggan" class="statuspelanggan" value="IU" checked>
						Umum
					</label>
					&nbsp;&nbsp;
				</div>
				<div class="radio-inline">
					<label>
						<input type="radio" name="statuspelanggan" class="statuspelanggan" value="IH">
						Harian
					</label>
					&nbsp;&nbsp;
				</div>
				<div class="radio-inline">
					<label>
						<input type="radio" name="statuspelanggan" class="statuspelanggan" value="ID">
						Diskon
					</label>
					&nbsp;&nbsp;
				</div>
				<div class="radio-inline">
					<label>
						<input type="radio" name="statuspelanggan" class="statuspelanggan" value="IP">
						Pelajar
					</label>
					&nbsp;&nbsp;
				</div>
				<div class="radio-inline">
					<label>
						<input type="radio" name="statuspelanggan" class="statuspelanggan" value="SG">
						Sewa Gedung
					</label>
					&nbsp;&nbsp;
				</div>
				<div class="radio-inline">
					<label>
						<input type="radio" name="statuspelanggan" class="statuspelanggan" value="SP">
						Suplemen
					</label>
					&nbsp;&nbsp;
				</div> 

			</td>
	      	<td width="100px"> 
				<button class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
			</td>
			<td width="100px">	
				<button class="btn btn-primary pull-right" id="cmdpreview">Preview</button>
			</td>
		</tr>  
		-->
   </table> 
   <div class="row" style="height: calc(100% - 100px);"> 
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div> 
   </div>
</div>
</form>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.rptkunjungan.grid1_data 	 = null ;
	bos.rptkunjungan.grid1_loaddata= function(){
		this.grid1_data 		= { 
			"tglawal"	   : this.obj.find("#tglawal").val(),    
			"tglakhir"	   : this.obj.find("#tglakhir").val()
		} ;
	} 

	bos.rptkunjungan.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptkunjungan.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,   
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [ 
				{ field: 'no', caption: 'No', size: '40px', sortable: false},
				{ field: 'kode', caption: 'Kode', size: '80px', sortable: false},
				{ field: 'tgl', caption: 'Tgl',style:'text-align:center', size: '80px', sortable: false},
				{ field: 'nama', caption: 'Nama', size: '150px', sortable: false},
				{ field: 'pendaftaran', caption: 'Pendaftaran', size: '120px',style:'text-align:right', sortable: false},
				{ field: 'iuran', caption: 'Iuran', size: '110px',style:'text-align:right', sortable: false},
				{ field: 'sewagedung', caption: 'Sewa Gedung', size: '110px',style:'text-align:right', sortable: false},
				{ field: 'suplemen', caption: 'Suplemen', size: '110px',style:'text-align:right', sortable: false},
				{ field: 'username', caption: 'Username', size: '80px', sortable: false},
				{ field: 'cmdcetak', caption: ' ', size: '80px', sortable: false}
					
			]
		});
   }

   bos.rptkunjungan.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptkunjungan.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptkunjungan.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptkunjungan.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptkunjungan.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptkunjungan.cmdcetak		= function(faktur){    
		bjs_os.form_report(bos.rptkunjungan.url+ '/printreport?faktur=' + faktur ) ;
	}

	bos.rptkunjungan.obj.find("#cmdrefresh").on("click", function(){
   		bos.rptkunjungan.grid1_reloaddata() ; 
	}) ;

	bos.rptkunjungan.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptkunjungan.url+ '/showreport' ) ;
	}) ;


	bos.rptkunjungan.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}



	bos.rptkunjungan.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptkunjungan.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptkunjungan.tabsaction( e.i )  ;
		});  

		this.obj.find("#pelanggan").on("select2:select", function(e){ 
         	bjs.ajax(bos.rptkunjungan.url+"/seekpel", "pelanggan=" + $(this).val()) ;
      	}) ;

		this.obj.on("remove",function(){
			bos.rptkunjungan.grid1_destroy() ;
		}) ;   	
      
	}

	bos.rptkunjungan.objs = bos.rptkunjungan.obj.find("#cmdview") ;
	bos.rptkunjungan.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
        	e.preventDefault() ;
      	});
	}

	$(function(){
		bos.rptkunjungan.initcomp() ;
		bos.rptkunjungan.initcallback() ;
		bos.rptkunjungan.initfunc() ;
	}) ;
</script>
