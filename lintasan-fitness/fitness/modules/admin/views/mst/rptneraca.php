<style media="screen">
   #bos-form-rptneraca-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptneraca-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>          
<div class="bodyfix scrollme" style="height:100%"> 
   <table class="osxtable form" border="0">
		<tr>
			<td width="80px"><label for="tgl">Tgl</label> </td> 
			<td width="20px">:</td>
			<td width="100px">
				<input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
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

	bos.rptneraca.grid1_data 	 = null ;
	bos.rptneraca.grid1_loaddata= function(){
		this.grid1_data 		= {
			"tgl"	   : this.obj.find("#tgl").val()
		} ;
	}

	bos.rptneraca.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptneraca.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false, 
			columns: [
				{ field: 'kode', caption: 'Rekening', size: '100px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false},
				{ field: 'saldoawal', caption: 'Saldo Awal', size: '120px',style:'text-align:right', sortable: false},
				{ field: 'debet', caption: 'Debet', size: '100px',style:'text-align:right', sortable: false},
				{ field: 'kredit', caption: 'Kredit', size: '100px',style:'text-align:right', sortable: false},
				{ field: 'saldoakhir', caption: 'Saldo Akhir', size: '120px',style:'text-align:right', sortable: false}
			]
		});
   }

   bos.rptneraca.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptneraca.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptneraca.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptneraca.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptneraca.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptneraca.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.rptneraca.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.rptneraca.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}

	bos.rptneraca.obj.find("#cmdrefresh").on("click", function(){ 
   		bos.rptneraca.grid1_reloaddata() ; 
	}) ;

	bos.rptneraca.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptneraca.url+ '/showreport' ) ;
	}) ;

	bos.rptneraca.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptneraca.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptneraca.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.rptneraca.grid1_destroy() ;
		}) ;   	
      
	}

	bos.rptneraca.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){ 
         e.preventDefault() ;
      	});
	}


	$(function(){
		bos.rptneraca.initcomp() ;
		bos.rptneraca.initcallback() ;
		bos.rptneraca.initfunc() ;
	}) ;
</script>