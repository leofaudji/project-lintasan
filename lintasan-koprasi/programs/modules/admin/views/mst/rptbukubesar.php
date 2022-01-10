<style media="screen">
   #bos-form-rptbukubesar-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptbukubesar-wrapper .info{border-radius: 4px; margin-right: 20px}
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
			<td></td>
		</tr> 
		<tr> 
			<td><label for="rekening">Rekening</label> </td>
			<td>:</td>
			<td colspan="3"> 
            <select name="rekening" id="rekening" class="form-control select" style="width:100%"
            data-sf="load_rekening" data-placeholder="Rekening" required></select>
			</td>			
			<td></td>
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

	bos.rptbukubesar.grid1_data 	 = null ;
	bos.rptbukubesar.grid1_loaddata= function(){
		this.grid1_data 		= {
			"tglawal"	   : this.obj.find("#tglawal").val(),
			"tglakhir"	   : this.obj.find("#tglakhir").val(),
			"rekening"	   : this.obj.find("#rekening").val()
		} ;
	}

	bos.rptbukubesar.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptbukubesar.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false, 
			columns: [
				{ field: 'no', caption: 'No', size: '40px', sortable: false},
				{ field: 'tgl', caption: 'Tgl', size: '80px', sortable: false},
				{ field: 'faktur', caption: 'Faktur', size: '100px', sortable: false},
				{ field: 'keterangan', caption: 'keterangan', size: '160px', sortable: false},
				{ field: 'debet', caption: 'Debet', size: '90px',style:'text-align:right', sortable: false},
				{ field: 'kredit', caption: 'Kredit', size: '90px',style:'text-align:right', sortable: false},
				{ field: 'total', caption: 'Total', size: '110px',style:'text-align:right', sortable: false},
				{ field: 'username', caption: 'Username', size: '70px', sortable: false},
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.rptbukubesar.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptbukubesar.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptbukubesar.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptbukubesar.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptbukubesar.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptbukubesar.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.rptbukubesar.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.rptbukubesar.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}

	bos.rptbukubesar.obj.find("#cmdrefresh").on("click", function(){ 
   		bos.rptbukubesar.grid1_reloaddata() ; 
	}) ; 

	bos.rptbukubesar.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptbukubesar.url+ '/showreport' ) ;
	}) ;

	bos.rptbukubesar.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptbukubesar.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptbukubesar.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.rptbukubesar.grid1_destroy() ;
		}) ;   	

		this.obj.find("#rekening").on("select2:select", function(e){ 
         	bjs.ajax(bos.rptbukubesar.url+"/refresh", "rekening=" + $(this).val()) ; 
      	}) ; 
      
	}

	bos.rptbukubesar.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){ 
         e.preventDefault() ; 
      });
	}


	$(function(){
		bos.rptbukubesar.initcomp() ;
		bos.rptbukubesar.initcallback() ;
		bos.rptbukubesar.initfunc() ;
	}) ;
</script>
