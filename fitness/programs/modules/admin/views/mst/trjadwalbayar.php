<style media="screen">
   #bos-form-trjadwalbayar-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-trjadwalbayar-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>          
<div class="bodyfix scrollme" style="height:100%"> 
   <table class="osxtable form" border="0">
		<tr>
			<td width="100px"><label for="tgl">Tgl</label> </td>
			<td width="20px">:</td>
			<td>
				<input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td>  
		</tr>         
  		<tr>  
			<td><label for="rekening">Pelanggan</label> </td>
			<td>:</td>
			<td> 
            <select name="pelanggan" id="pelanggan" class="form-control select" style="width:100%"
            data-sf="load_pelanggan" data-placeholder="Pelanggan" required></select>
			</td>			
		</tr> 
      <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
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

	bos.trjadwalbayar.grid1_data 	 = null ;
	bos.trjadwalbayar.grid1_loaddata= function(){
		this.grid1_data 		= {
			"pelanggan": this.obj.find("#pelanggan").val(),
			"tgl"	   : this.obj.find("#tgl").val()  
		} ;
	} 

	bos.trjadwalbayar.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.trjadwalbayar.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,   
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [
				{ field: 'no', caption: 'No', size: '40px', sortable: false},
				{ field: 'kode', caption: 'Kode', size: '100px', sortable: false},
				{ field: 'tgl', caption: 'Tgl', size: '80px', sortable: false},
				{ field: 'nama', caption: 'Nama', size: '150px', sortable: false},
				{ field: '1', caption: 'Jan', size: '80px',style:'text-align:left', sortable: false},
				{ field: '2', caption: 'Peb', size: '80px',style:'text-align:left', sortable: false},
				{ field: '3', caption: 'Mar', size: '80px',style:'text-align:left', sortable: false},
				{ field: '4', caption: 'Apr', size: '80px',style:'text-align:left', sortable: false},
				{ field: '5', caption: 'Mei', size: '80px',style:'text-align:left', sortable: false},
				{ field: '6', caption: 'Jun', size: '80px',style:'text-align:left', sortable: false},
				{ field: '7', caption: 'Jul', size: '80px',style:'text-align:left', sortable: false},
				{ field: '8', caption: 'Agu', size: '80px',style:'text-align:left', sortable: false},
				{ field: '9', caption: 'Sep', size: '80px',style:'text-align:left', sortable: false},
				{ field: '10', caption: 'Okt', size: '80px',style:'text-align:left', sortable: false},
				{ field: '11', caption: 'Nop', size: '80px',style:'text-align:left', sortable: false},
				{ field: '12', caption: 'Des', size: '80px',style:'text-align:left', sortable: false}
				
				
			]
		});
   }

   bos.trjadwalbayar.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.trjadwalbayar.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.trjadwalbayar.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.trjadwalbayar.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.trjadwalbayar.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.trjadwalbayar.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.trjadwalbayar.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}  

	bos.trjadwalbayar.init				= function(){
		this.obj.find("#pelanggan").val("") ;
		bjs.ajax(this.url + "/init") ;
	}



	bos.trjadwalbayar.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.trjadwalbayar.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.trjadwalbayar.tabsaction( e.i )  ;
		});  

		this.obj.find("#pelanggan").on("select2:select", function(e){ 
         	bjs.ajax(bos.trjadwalbayar.url+"/seekpel", "pelanggan=" + $(this).val()) ;
      	}) ;

		this.obj.on("remove",function(){
			bos.trjadwalbayar.grid1_destroy() ;
		}) ;   	
      
	}

	bos.trjadwalbayar.objs = bos.trjadwalbayar.obj.find("#cmdsave") ;
	bos.trjadwalbayar.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ; 
      });
	}

	$("#pelanggan").change(function() {
  		var coba = $("#pelanggan").val() ;
	});

	$(function(){
		bos.trjadwalbayar.initcomp() ;
		bos.trjadwalbayar.initcallback() ;
		bos.trjadwalbayar.initfunc() ;
	}) ;
</script>
