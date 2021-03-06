<style media="screen">
   #bos-form-rptakuntansikas-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptakuntansikas-wrapper .info{border-radius: 4px; margin-right: 20px}
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

	bos.rptakuntansikas.grid1_data 	 = null ;
	bos.rptakuntansikas.grid1_loaddata= function(){
		this.grid1_data 		= {
			"tglawal"	   : this.obj.find("#tglawal").val(),
			"tglakhir"	   : this.obj.find("#tglakhir").val()
		} ;
	}

	bos.rptakuntansikas.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptakuntansikas.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false 
			},
			multiSearch		: false, 
			columns: [
				{ field: 'no', caption: 'No',style:'text-align:center', size: '40px', sortable: false},
				{ field: 'tgl', caption: 'Tgl',style:'text-align:center', size: '90px', sortable: false},
				{ field: 'faktur', caption: 'Faktur', style:'text-align:center',size: '130px', sortable: false},
				{ field: 'rekening', caption: 'Rekening', size: '110px', sortable: false},
				{ field: 'keterangan', caption: 'keterangan', size: '300px', sortable: false},
				{ field: 'jumlah', caption: 'Jumlah', size: '140px',style:'text-align:right', sortable: false},
				{ field: 'total', caption: 'Total', size: '140px',style:'text-align:right', sortable: false},
				{ field: 'username', caption: 'Username', size: '110px', sortable: false}
			]
		});
   }

   bos.rptakuntansikas.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptakuntansikas.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptakuntansikas.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptakuntansikas.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptakuntansikas.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptakuntansikas.obj.find("#cmdrefresh").on("click", function(){
   		bos.rptakuntansikas.grid1_reloaddata() ; 
	}) ;

	bos.rptakuntansikas.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptakuntansikas.url+ '/showreport' ) ;
	}) ;

	bos.rptakuntansikas.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.rptakuntansikas.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.rptakuntansikas.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}



	bos.rptakuntansikas.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptakuntansikas.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptakuntansikas.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.rptakuntansikas.grid1_destroy() ;
		}) ;   	
      
	} 

	bos.rptakuntansikas.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
        	e.preventDefault() ;
      	});

	}


	$(function(){
		bos.rptakuntansikas.initcomp() ;
		bos.rptakuntansikas.initcallback() ;
		bos.rptakuntansikas.initfunc() ;
	}) ;
</script>
