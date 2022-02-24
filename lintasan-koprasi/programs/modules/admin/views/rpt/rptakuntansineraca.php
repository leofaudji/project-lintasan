<style media="screen">
   #bos-form-rptakuntansineraca-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptakuntansineraca-wrapper .info{border-radius: 4px; margin-right: 20px} 
</style>  

<div class="header active"> 
  <table class="header-table"> 
    <tr> 
      <td class="icon" ><i class="fa fa-building"></i></td>  
      <td class="title">
        <div class="nav ">
          <div class="btn-group" id="tpel"> 
            <span> Laporan Mutasi Kredit </span>
          </div>
        </div>
      </td>
      <td class="button">
        <table class="header-button" align="right">  
          <tr> 
            <td> 
              <div class="btn-circle btn-close transition" onclick="bos.rptakuntansineraca.close()">
                <img src="./uploads/titlebar/close.png">
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>

<form novalidate>         
<div class="bodyfix scrollme" style="height:100%">  
   <table class="osxtable form" border="0">
		<tr> 
			<td width="80px"><label for="tgl">Antara Tgl</label> </td>
			<td width="20px">:</td>
			<td width="100px">
				<input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td>   
			<td width="20px">s/d</td>
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

	bos.rptakuntansineraca.grid1_data 	 = null ;
	bos.rptakuntansineraca.grid1_loaddata= function(){
		this.grid1_data 		= { 
			"tglawal"	  : this.obj.find("#tglawal").val(),     
			"tglakhir"  : this.obj.find("#tglakhir").val(),     
			"rekening"	:this.obj.find("#rekening").val() 
		} ;
	} 

	bos.rptakuntansineraca.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptakuntansineraca.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,    
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [ 
				{ field: 'no', caption: 'No',style:'text-align:center', size: '40px', sortable: false},
				{ field: 'rekening', caption: 'No. Rekening',style:'text-align:center', size: '120px', sortable: false},
				{ field: 'nama', caption: 'Nama', size: '220px', sortable: false},
				{ field: 'tgl', caption: 'Tgl',style:'text-align:center', size: '90px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '300px', sortable: false},
				{ field: 'dpokok', caption: 'DPokok',style:'text-align:right', size: '120px', sortable: false},
				{ field: 'kpokok', caption: 'KPokok',style:'text-align:right', size: '110px', sortable: false},
				{ field: 'kbunga', caption: 'KBunga',style:'text-align:right', size: '110px', sortable: false},
				{ field: 'denda', caption: 'Denda',style:'text-align:right', size: '100px', sortable: false},
				{ field: 'dtitipan', caption: 'DTitipan',style:'text-align:right', size: '110px', sortable: false},
				{ field: 'ktitipan', caption: 'KTitipan',style:'text-align:right', size: '110px', sortable: false}
			]
		});
   }

   bos.rptakuntansineraca.grid1_setdata	= function(){ 
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptakuntansineraca.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptakuntansineraca.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptakuntansineraca.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptakuntansineraca.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptakuntansineraca.cmdpilih     = function(rekening){
    bjs.ajax(this.url + '/pilih', 'rekening=' + rekening);
  }

	bos.rptakuntansineraca.cmdcetak		= function(faktur){    
		bjs_os.form_report(bos.rptakuntansineraca.url+ '/printreport?faktur=' + faktur ) ;
	}

	bos.rptakuntansineraca.obj.find("#cmdrefresh").on("click", function(){
   		bos.rptakuntansineraca.grid1_reloaddata() ; 
	}) ;

	bos.rptakuntansineraca.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptakuntansineraca.url+ '/showreport' ) ;
	}) ;


	bos.rptakuntansineraca.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}



	bos.rptakuntansineraca.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;


		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptakuntansineraca.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptakuntansineraca.tabsaction( e.i )  ;
		});   

		this.obj.on("remove",function(){
			bos.rptakuntansineraca.grid1_destroy() ;
		}) ;   	
      
	}

	bos.rptakuntansineraca.loadmodelstock      = function(l){
    this.obj.find("#wrap-pencarian-d").modal(l) ; 
  }

	bos.rptakuntansineraca.objs = bos.rptakuntansineraca.obj.find("#cmdview") ;
	bos.rptakuntansineraca.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
        	e.preventDefault() ;
      	});

		this.obj.find("#cmdrekening").on("click", function(e){ 
			bos.rptakuntansineraca.loadmodelstock("show"); 
		}) ;		
	}

	$(function(){
		bos.rptakuntansineraca.initcomp() ;
		bos.rptakuntansineraca.initcallback() ;
		bos.rptakuntansineraca.initfunc() ;
	}) ;
</script>
