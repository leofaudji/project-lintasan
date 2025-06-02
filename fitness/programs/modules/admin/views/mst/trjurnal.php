<style media="screen">
   #bos-form-trjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-trjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate id="form1">         
<div class="bodyfix scrollme" style="height:100%"> 
   <table class="osxtable form" border="0">
		<tr>
			<td><label for="tgl">Tgl</label> </td>
			<td>:</td>
			<td>
				<input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td>
		</tr> 
  		<tr>  
			<td><label for="rekening">Rekening</label> </td>
			<td>:</td>
			<td> 
            <select name="rekening" id="rekening" class="form-control select" style="width:100%"
            data-sf="load_rekening" data-placeholder="Rekening" required></select>
			</td>			
		</tr> 
		<tr>
			<td><label for="keterangan">Keterangan</label> </td>
			<td>:</td>
			<td colspan="4">
				<input  type="text" class="form-control" id="keterangan" name="keterangan" required>
			</td>
		</tr> 
		<tr>
			<td><label for="debet">Debet</label> </td>
			<td>:</td>
			<td>
				<input  type="text" class="form-control number" id="debet" name="debet" value="0">
			</td>
			<td><label for="kredit">Kredit</label> </td>
			<td>:</td>
			<td>
				<input  type="text" class="form-control number" id="kredit" name="kredit" value="0">
			</td>
			<td>
				<button style="height:28px" class="btn btn-primary pull-right" name="cmdok" id="cmdok">Ok</button>
			</td>
		</tr> 
   </table> 
   <div class="row" style="height: calc(100% - 200px);">
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div> 
      <div>
            <button class="btn btn-primary pull-right" name="cmdsave" id="cmdsave" 
            		style="margin-top:10px;margin-right:30px;height: 30px">Simpan</button>
       </div>
   </div>
</div>
</form>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.trjurnal.grid1_data 	 = null ;
	bos.trjurnal.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.trjurnal.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.trjurnal.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,  
			columns: [
				{ field: 'tgl', caption: 'Tgl',style:'text-align:center', size: '80px', sortable: false},
				{ field: 'rekening', caption: 'Rekening', size: '100px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '230px', sortable: false},
				{ field: 'debet', caption: 'Debet',style:'text-align:right', size: '110px', sortable: false},
				{ field: 'kredit', caption: 'Kredit',style:'text-align:right', size: '110px', sortable: false},
				{ field: 'username', caption: 'Username', size: '80px', sortable: false},
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.trjurnal.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.trjurnal.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.trjurnal.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.trjurnal.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.trjurnal.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.trjurnal.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.trjurnal.init				= function(){
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#debet").val("0") ;
		this.obj.find("#kredit").val("0") ;
		bjs.ajax(this.url + "/init") ;
	} 

	bos.trjurnal.obj.find("#cmdok").on("click", function(){
		var ltrue = 1 ;
		var error = "" ;
		if($("#debet").val() == 0 && $("#kredit").val() == 0){
			ltrue = 0 ;
			error += "Nominal Tidak Boleh Nol...\n" ;
		}
		if($("#rekening").val() == ""){
			ltrue = 0 ;
			error += "Rekening Harus Dipilih...\n" ; 
		}
		if($("#keterangan").val() == ""){
			ltrue = 0 ;
			error += "Keterangan Tidak Boleh Kosong...\n" ;
		} 

		if(!ltrue){
			alert(error) ;
		}else{   
			bjs.ajax( bos.trjurnal.url + '/saving', bjs.getdataform(bos.trjurnal.obj.find("#form1")) , bos.trjurnal.objs) ;
			bos.trjurnal.grid1_reloaddata() ;   
			bos.trjurnal.init() ;
		} 
		
	}) ;        

	bos.trjurnal.obj.find("#cmdsave").on("click", function(){
		if(confirm("Apakah Anda Yakin?")){
			bjs.ajax( bos.trjurnal.url + '/updbukubesar', bjs.getdataform(bos.trjurnal.obj.find("#form1")) , bos.trjurnal.objs) ;
		}
	}) ;

	bos.trjurnal.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.trjurnal.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.trjurnal.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.trjurnal.grid1_destroy() ;
		}) ;   	
      
	}
   
	bos.trjurnal.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ; 

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
      	});
	}

	$(function(){
		bos.trjurnal.initcomp() ;
		bos.trjurnal.initcallback() ;
		bos.trjurnal.initfunc() ;
	}) ;
</script>
