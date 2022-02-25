<style media="screen">
   #bos-form-trakuntansipb-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-trakuntansipb-wrapper .info{border-radius: 4px; margin-right: 20px}
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
				<input  type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required>
			</td>
		</tr> 
		<tr>
			<td><label for="debet">Debet</label> </td>
			<td>:</td>
			<td>
				<input  type="text" class="form-control number" id="debet" name="debet" placeholder="0">
			</td>
			<td><label for="kredit">Kredit</label> </td>
			<td>:</td>
			<td>
				<input  type="text" class="form-control number" id="kredit" name="kredit" placeholder="0">
			</td>
			<td>
				<button style="height:28px" class="btn btn-primary pull-right" name="cmdok" id="cmdok">OK</button>
			</td>
		</tr> 
   </table> 
   <div class="row" style="height: calc(100% - 200px);">
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div>  
   </div>

	 <div class="footer fix" style="height:32px">
    <button class="btn btn-primary btn-block" id="cmdsave">Simpan</button>
  	</div>
</div>
</form>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.trakuntansipb.grid1_data 	 = null ;
	bos.trakuntansipb.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.trakuntansipb.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.trakuntansipb.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,  
			columns: [
				{ field: 'tgl', caption: 'Tgl',style:'text-align:center', size: '90px', sortable: false},
				{ field: 'rekening', caption: 'Rekening', size: '100px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '250px', sortable: false},
				{ field: 'debet', caption: 'Debet',style:'text-align:right', size: '110px', sortable: false},
				{ field: 'kredit', caption: 'Kredit',style:'text-align:right', size: '110px', sortable: false},
				{ field: 'username', caption: 'Username', size: '90px', sortable: false},
				{ field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.trakuntansipb.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.trakuntansipb.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.trakuntansipb.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.trakuntansipb.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.trakuntansipb.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.trakuntansipb.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.trakuntansipb.init				= function(){
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#debet").val("0") ;
		this.obj.find("#kredit").val("0") ;
		bjs.ajax(this.url + "/init") ;
	} 

	bos.trakuntansipb.obj.find("#cmdok").on("click", function(){
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
			bjs.ajax( bos.trakuntansipb.url + '/saving', bjs.getdataform(bos.trakuntansipb.obj.find("#form1")) , bos.trakuntansipb.objs) ;
			bos.trakuntansipb.grid1_reloaddata() ;   
			bos.trakuntansipb.init() ;
		} 
		
	}) ;        

	bos.trakuntansipb.obj.find("#cmdsave").on("click", function(){
		if(confirm("Apakah Anda Yakin?")){
			bjs.ajax( bos.trakuntansipb.url + '/updbukubesar', bjs.getdataform(bos.trakuntansipb.obj.find("#form1")) , bos.trakuntansipb.objs) ;
		}
	}) ;

	bos.trakuntansipb.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.trakuntansipb.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.trakuntansipb.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.trakuntansipb.grid1_destroy() ;
		}) ;   	
      
	}
   
	bos.trakuntansipb.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ; 

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
      	});
	}

	$(function(){
		bos.trakuntansipb.initcomp() ;
		bos.trakuntansipb.initcallback() ;
		bos.trakuntansipb.initfunc() ;
	}) ;
</script>
