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
				<input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td>
            <td width="20px">sd</td>
            <td width="100px">
				<input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td>
            <td width="40px">Level&nbsp;: </td>
			<td width="50px">
                 <input type="text" id="level" name="level" value = "4" class="form-control" placeholder="level" required>
            </td>
            <td></td>
			<td width="100px">
				<button class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
			</td>
            <td width="100px">
                <select name="export" id="export" class="form-control select" style="width:100%"
                    data-sf="load_export" data-placeholder="PDF" required></select>
            </td>
			<td width="100px">
				<button class="btn btn-primary pull-right" id="cmdview">Export</button> 
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

	bos.rptneraca2.grid1_data 	 = null ;
	bos.rptneraca2.grid1_loaddata= function(){
		this.grid1_data 		= {
			"tglawal"	   : this.obj.find("#tglawal").val(),
            "tglakhir"	   : this.obj.find("#tglakhir").val(),
            "level"	   : this.obj.find("#level").val()
		} ;
	}

	bos.rptneraca2.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			url 		: bos.rptneraca2.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: false,
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [
				{ field: 'kode1', caption: 'Rekening', size: '100px', sortable: false},
				{ field: 'keterangan1', caption: 'Keterangan', size: '330px', sortable: false},
				{ field: 'saldoakhir1',render:'float:2', caption: 'Saldo akhir', size: '120px',style:'text-align:right', sortable: false},
                { field: 'saldoakhir1induk',render:'float:2', caption: 'Saldo akhir', size: '120px',style:'text-align:right', sortable: false},
				{ field: 'batas', caption: '', size: '10px',style:'text-align:center', sortable: false},
                { field: 'kode2', caption: 'Rekening', size: '100px', sortable: false},
				{ field: 'keterangan2', caption: 'Keterangan', size: '330px', sortable: false},
				{ field: 'saldoakhir2',render:'float:2', caption: 'Saldo akhir', size: '120px',style:'text-align:right', sortable: false},
                { field: 'saldoakhir2induk',render:'float:2', caption: 'Saldo akhir', size: '120px',style:'text-align:right', sortable: false}
			]
		});
   }

   bos.rptneraca2.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptneraca2.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptneraca2.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptneraca2.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptneraca2.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptneraca2.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.rptneraca2.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.rptneraca2.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}

	bos.rptneraca2.obj.find("#cmdrefresh").on("click", function(){ 
   		bos.rptneraca2.grid1_reloaddata() ; 
	}) ;

	bos.rptneraca2.obj.find("#cmdview").on("click", function(){
        bos.rptneraca2.initreport();
	}) ;

    bos.rptneraca2.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    bos.rptneraca2.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }


	bos.rptneraca2.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptneraca2.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptneraca2.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.rptneraca2.grid1_destroy() ;
		}) ;   	

	}

	bos.rptneraca2.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){ 
         e.preventDefault() ;
      	});
	}


	$(function(){
		bos.rptneraca2.initcomp() ;
		bos.rptneraca2.initcallback() ;
		bos.rptneraca2.initfunc() ;
	}) ;
</script>