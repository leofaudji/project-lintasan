<style media="screen">
   #bos-form-rptkreditbakidebet-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptkreditbakidebet-wrapper .info{border-radius: 4px; margin-right: 20px} 
</style>  

<div class="header active"> 
  <table class="header-table"> 
    <tr> 
      <td class="icon" ><i class="fa fa-building"></i></td> 
      <td class="title">
        <div class="nav ">
          <div class="btn-group" id="tpel"> 
            <span> Laporan Saldo Tabungan </span>
          </div>
        </div>
      </td>
      <td class="button">
        <table class="header-button" align="right"> 
          <tr> 
            <td> 
              <div class="btn-circle btn-close transition" onclick="bos.rptkreditbakidebet.close()">
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
			<td width="80px"><label for="tgl">Sampai Tgl</label> </td>
			<td width="20px">:</td>
			<td>
				<input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
				 
			</td>   
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

	bos.rptkreditbakidebet.grid1_data 	 = null ;
	bos.rptkreditbakidebet.grid1_loaddata= function(){
		this.grid1_data 		= { 
			"tgl"	  : this.obj.find("#tgl").val(),     
			"rekening"	:this.obj.find("#rekening").val() 
		} ;
	} 

	bos.rptkreditbakidebet.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptkreditbakidebet.base_url + "/loadgrid",
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
				{ field: 'alamat', caption: 'Alamat',style:'text-align:left', size: '300px', sortable: false},
				{ field: 'telepon', caption: 'Telepon',style:'text-align:left', size: '120px', sortable: false}, 
				{ field: 'tgl', caption: 'Tgl Realisasi',style:'text-align:center', size: '90px', sortable: false},
				{ field: 'lama', caption: 'Lama',style:'text-align:right', size: '90px', sortable: false},
				{ field: 'jthtmp', caption: 'JthTmp',style:'text-align:center', size: '90px', sortable: false},
				{ field: 'saldoakhir', caption: 'Saldo Akhir',style:'text-align:right', size: '140px', sortable: false}
					
			]
		});
   }

   bos.rptkreditbakidebet.grid1_setdata	= function(){ 
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptkreditbakidebet.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptkreditbakidebet.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptkreditbakidebet.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptkreditbakidebet.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptkreditbakidebet.cmdpilih     = function(rekening){
    bjs.ajax(this.url + '/pilih', 'rekening=' + rekening);
  }

	bos.rptkreditbakidebet.cmdcetak		= function(faktur){    
		bjs_os.form_report(bos.rptkreditbakidebet.url+ '/printreport?faktur=' + faktur ) ;
	}

	bos.rptkreditbakidebet.obj.find("#cmdrefresh").on("click", function(){
   		bos.rptkreditbakidebet.grid1_reloaddata() ; 
	}) ;

	bos.rptkreditbakidebet.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptkreditbakidebet.url+ '/showreport' ) ;
	}) ;


	bos.rptkreditbakidebet.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}



	bos.rptkreditbakidebet.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;


		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptkreditbakidebet.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptkreditbakidebet.tabsaction( e.i )  ;
		});   

		this.obj.on("remove",function(){
			bos.rptkreditbakidebet.grid1_destroy() ;
		}) ;   	
      
	}

	bos.rptkreditbakidebet.loadmodelstock      = function(l){
    this.obj.find("#wrap-pencarian-d").modal(l) ; 
  }

	bos.rptkreditbakidebet.objs = bos.rptkreditbakidebet.obj.find("#cmdview") ;
	bos.rptkreditbakidebet.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
        	e.preventDefault() ;
      	});

		this.obj.find("#cmdrekening").on("click", function(e){ 
			bos.rptkreditbakidebet.loadmodelstock("show"); 
		}) ;		
	}

	$(function(){
		bos.rptkreditbakidebet.initcomp() ;
		bos.rptkreditbakidebet.initcallback() ;
		bos.rptkreditbakidebet.initfunc() ;
	}) ;
</script>
