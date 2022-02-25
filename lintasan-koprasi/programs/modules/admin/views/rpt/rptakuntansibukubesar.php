<style media="screen">
   #bos-form-rptakuntansibukubesar-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptakuntansibukubesar-wrapper .info{border-radius: 4px; margin-right: 20px}
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
			<td width="100px" align="right">Rekening : </td>
			<td><select name="rekening" id="rekening" class="form-control select" style="width:100%"
            data-sf="load_rekening" data-placeholder="Rekening" required></select></td>
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

	bos.rptakuntansibukubesar.grid1_data 	 = null ;
	bos.rptakuntansibukubesar.grid1_loaddata= function(){
		this.grid1_data 		= {
			"tglawal"	   : this.obj.find("#tglawal").val(),
			"tglakhir"	   : this.obj.find("#tglakhir").val(),
			"rekening"	   : this.obj.find("#rekening").val()
		} ;
	}

	bos.rptakuntansibukubesar.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptakuntansibukubesar.base_url + "/loadgrid",
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
				{ field: 'debet', caption: 'Debet', size: '110px',style:'text-align:right', sortable: false},
				{ field: 'kredit', caption: 'Kredit', size: '110px',style:'text-align:right', sortable: false},
				{ field: 'total', caption: 'Total', size: '140px',style:'text-align:right', sortable: false},
				{ field: 'username', caption: 'Username', size: '110px', sortable: false},
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.rptakuntansibukubesar.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptakuntansibukubesar.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptakuntansibukubesar.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptakuntansibukubesar.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptakuntansibukubesar.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptakuntansibukubesar.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.rptakuntansibukubesar.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.rptakuntansibukubesar.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}

	bos.rptakuntansibukubesar.obj.find("#cmdrefresh").on("click", function(){ 
   		bos.rptakuntansibukubesar.grid1_reloaddata() ; 
	}) ; 

	bos.rptakuntansibukubesar.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptakuntansibukubesar.url+ '/showreport' ) ;
	}) ;

	bos.rptakuntansibukubesar.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptakuntansibukubesar.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptakuntansibukubesar.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.rptakuntansibukubesar.grid1_destroy() ;
		}) ;   	

		this.obj.find("#rekening").on("select2:select", function(e){ 
         	bjs.ajax(bos.rptakuntansibukubesar.url+"/refresh", "rekening=" + $(this).val()) ; 
      	}) ; 
      
	}

	bos.rptakuntansibukubesar.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){ 
         e.preventDefault() ; 
      });
	}


	$(function(){
		bos.rptakuntansibukubesar.initcomp() ;
		bos.rptakuntansibukubesar.initcallback() ;
		bos.rptakuntansibukubesar.initfunc() ;
	}) ;
</script>
