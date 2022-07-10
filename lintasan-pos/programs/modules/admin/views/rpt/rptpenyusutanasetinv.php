<style media="screen">
   #bos-form-rptjurnal-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptjurnal-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
<div class="bodyfix scrollme" style="height:100%"> 
   <table class="osxtable form" border="0">
		<tr>
			<td width="80px"><label for="tgl">Periode</label> </td>
			<td width="20px">:</td>
			<td width="80px"> 
				<input style="width:80px" type="text" class="form-control date" id="periode" name="periode" required value=<?=date("m-Y")?> <?=date_periodset(true)?>>
            </td>
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

	bos.rptpenyusutanasetinv.grid1_data 	 = null ;
	bos.rptpenyusutanasetinv.grid1_loaddata= function(){
		this.grid1_data 		= {
		    "periode"	   : this.obj.find("#periode").val()
		} ;
	}

	bos.rptpenyusutanasetinv.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 500 ,
			url 		: bos.rptpenyusutanasetinv.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: false,
				toolbarColumns  : false
			},
			multiSearch		: false, 
			columns: [
				{ field: 'no', caption: 'No', size: '40px', sortable: false},
				{ field: 'kode', caption: 'Kode', size: '50px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '150px', sortable: false},
                { field: 'cabang', caption: 'Cabang', size: '80px', sortable: false},
                { field: 'golongan', caption: 'Gol. Aset', size: '100px', sortable: false},
                { field: 'tglperolehan', caption: 'Tgl Perolehan', size: '80px', sortable: false},
                { field: 'lama', caption: 'Lama', size: '80px', sortable: false,style:'text-align:right'},
                { field: 'hargaperolehan', caption: 'Harga Perolehan', size: '100px', sortable: false,style:'text-align:right'},
                { field: 'unit', caption: 'Unit', size: '80px', sortable: false,style:'text-align:right'},
                { field: 'jenispenyusutan', caption: 'Jenis Penyusutan', size: '100px', sortable: false},
                { field: 'tarifpenyusutan', caption: 'Tarif Penyusutan', size: '100px', sortable: false,style:'text-align:right'},
                { field: 'penyawal', caption: 'Peny. Awal', size: '100px', sortable: false,style:'text-align:right'},
                { field: 'penyblnini', caption: 'Peny. Bln Ini', size: '100px', sortable: false,style:'text-align:right'},
                { field: 'penyakhir', caption: 'Peny. Akhir', size: '100px', sortable: false,style:'text-align:right'},
                { field: 'nilaibuku', caption: 'Nilai Buku', size: '100px', sortable: false,style:'text-align:right'}
			],
            records:[{
                recid:'ZZZZ',no: '', kode: '', keterangan: '', cabang: '', golongan: '', tglperolehan:'',lama:'',hargaperolehan:'',
                unit:'',jenispenyusutan:'',tarifpenyusutan:'',residu:'0.00',penyawal:'0.00',penyblnini:'0.00',penyakhir:'0.00',nilaibuku:'0.00',
                w2ui:{summary: true}
            }]
		});
   }

   bos.rptpenyusutanasetinv.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptpenyusutanasetinv.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptpenyusutanasetinv.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptpenyusutanasetinv.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptpenyusutanasetinv.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptpenyusutanasetinv.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}

	bos.rptpenyusutanasetinv.obj.find("#cmdrefresh").on("click", function(){ 
   		bos.rptpenyusutanasetinv.grid1_reloaddata() ;  
	}) ; 

	bos.rptpenyusutanasetinv.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptpenyusutanasetinv.url+ '/showreport' ) ;
	}) ;

	bos.rptpenyusutanasetinv.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select" 
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}  

	bos.rptpenyusutanasetinv.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptpenyusutanasetinv.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.rptpenyusutanasetinv.grid1_destroy() ;
		}) ;   	
      
	}

	bos.rptpenyusutanasetinv.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){ 
         e.preventDefault() ;
      	});
	}

	$(function(){
		bos.rptpenyusutanasetinv.initcomp() ;
		bos.rptpenyusutanasetinv.initcallback() ;
		bos.rptpenyusutanasetinv.initfunc() ;
	}) ;
</script>