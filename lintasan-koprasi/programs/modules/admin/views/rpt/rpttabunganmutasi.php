<style media="screen">
   #bos-form-rpttabunganmutasi-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rpttabunganmutasi-wrapper .info{border-radius: 4px; margin-right: 20px}
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

	bos.rpttabunganmutasi.grid1_data 	 = null ;
	bos.rpttabunganmutasi.grid1_loaddata= function(){
		this.grid1_data 		= { 
			"tglawal"	   : this.obj.find("#tglawal").val(),    
			"tglakhir"	   : this.obj.find("#tglakhir").val()
		} ;
	} 

	bos.rpttabunganmutasi.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rpttabunganmutasi.base_url + "/loadgrid",
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
				{ field: 'rekening', caption: 'No. Rekening',style:'text-align:center', size: '120px', sortable: false},
				{ field: 'nama', caption: 'Nama', size: '140px', sortable: false},
				{ field: 'kode_transaksi', caption: 'Kode Transaksi',style:'text-align:center', size: '100px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false},
				{ field: 'debet', caption: 'Debet',style:'text-align:right', size: '120px', sortable: false},
				{ field: 'kredit', caption: 'Kredit',style:'text-align:right', size: '120px', sortable: false},
				{ field: 'datetime', caption: 'Diproses pada', size: '250px', sortable: false},
				{ field: 'cmdcetak', caption: ' ', size: '80px', sortable: false}
					
			]
		});
   }

   bos.rpttabunganmutasi.grid1_setdata	= function(){ 
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rpttabunganmutasi.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rpttabunganmutasi.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rpttabunganmutasi.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rpttabunganmutasi.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rpttabunganmutasi.cmdcetak		= function(faktur){    
		bjs_os.form_report(bos.rpttabunganmutasi.url+ '/printreport?faktur=' + faktur ) ;
	}

	bos.rpttabunganmutasi.obj.find("#cmdrefresh").on("click", function(){
   		bos.rpttabunganmutasi.grid1_reloaddata() ; 
	}) ;

	bos.rpttabunganmutasi.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rpttabunganmutasi.url+ '/showreport' ) ;
	}) ;


	bos.rpttabunganmutasi.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}



	bos.rpttabunganmutasi.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rpttabunganmutasi.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rpttabunganmutasi.tabsaction( e.i )  ;
		});  

		this.obj.find("#pelanggan").on("select2:select", function(e){ 
         	bjs.ajax(bos.rpttabunganmutasi.url+"/seekpel", "pelanggan=" + $(this).val()) ;
      	}) ;

		this.obj.on("remove",function(){
			bos.rpttabunganmutasi.grid1_destroy() ;
		}) ;   	
      
	}

	bos.rpttabunganmutasi.objs = bos.rpttabunganmutasi.obj.find("#cmdview") ;
	bos.rpttabunganmutasi.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
        	e.preventDefault() ;
      	});
	}

	$(function(){
		bos.rpttabunganmutasi.initcomp() ;
		bos.rpttabunganmutasi.initcallback() ;
		bos.rpttabunganmutasi.initfunc() ;
	}) ;
</script>
