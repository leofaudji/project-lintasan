<style media="screen">
   #bos-form-rptakuntansijurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptakuntansijurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
<div class="bodyfix scrollme" style="height:100%"> 
   <table class="osxtable form" border="0">
		<tr>
			<td width="80px"><label for="tgl">Tgl</label> </td>
			<td width="20px">:</td>
			<td width="100px"> 
				<input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td>
			<td width="40px">s/d</td>
			<td width="100px">
				<input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td> 
			<td></td>
			<td width="100px">
				<button class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
			</td>
			<td width="100px">	
				<button class="btn btn-primary pull-right" id="cmdview">Preview</button>  
			</td>
		</tr>  
      <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
   </table> 
   <div class="row" style="height: calc(100% - 50px);"> 
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div>  
   </div> 
</div>
</form>
<script type="text/javascript"> 
	<?=cekbosjs();?>

	bos.rptakuntansijurnal.grid1_data 	 = null ;
	bos.rptakuntansijurnal.grid1_loaddata= function(){
		this.grid1_data 		= {
			"tglawal"	   : this.obj.find("#tglawal").val(),
			"tglakhir"	   : this.obj.find("#tglakhir").val()
		} ;
	}

	bos.rptakuntansijurnal.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptakuntansijurnal.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true, 
				toolbarColumns  : false
			},
			multiSearch		: false, 
			columns: [
				{ field: 'no', caption: 'No',style:'text-align:center', size: '40px', sortable: false},
				{ field: 'faktur', caption: 'Faktur',style:'text-align:center', size: '140px', sortable: false},
				{ field: 'rekening', caption: 'Rekening', size: '100px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '300px', sortable: false},
				{ field: 'debet', caption: 'Debet', size: '120px',style:'text-align:right', sortable: false},
				{ field: 'kredit', caption: 'Kredit', size: '120px',style:'text-align:right', sortable: false},
				{ field: 'username', caption: 'Username', size: '100px', sortable: false}
			]
		});
   }

   bos.rptakuntansijurnal.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptakuntansijurnal.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptakuntansijurnal.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptakuntansijurnal.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptakuntansijurnal.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptakuntansijurnal.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}

	bos.rptakuntansijurnal.obj.find("#cmdrefresh").on("click", function(){ 
   		bos.rptakuntansijurnal.grid1_reloaddata() ;  
	}) ; 

	bos.rptakuntansijurnal.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptakuntansijurnal.url+ '/showreport' ) ;
	}) ;

	bos.rptakuntansijurnal.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select" 
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}  

	bos.rptakuntansijurnal.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptakuntansijurnal.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.rptakuntansijurnal.grid1_destroy() ;
		}) ;   	
      
	}

	bos.rptakuntansijurnal.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){ 
         e.preventDefault() ;
      	});
	}


	$(function(){
		bos.rptakuntansijurnal.initcomp() ;
		bos.rptakuntansijurnal.initcallback() ;
		bos.rptakuntansijurnal.initfunc() ;
	}) ;
</script>