<style media="screen">
   #bos-form-rptkreditnominatif-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptkreditnominatif-wrapper .info{border-radius: 4px; margin-right: 20px} 
</style>  

<div class="header active"> 
  <table class="header-table">  
    <tr> 
      <td class="icon" ><i class="fa fa-building"></i></td> 
      <td class="title">
        <div class="nav ">
          <div class="btn-group" id="tpel"> 
            <span> Laporan Nominatif Kredit </span>
          </div>
        </div>
      </td>
      <td class="button">
        <table class="header-button" align="right"> 
          <tr> 
            <td> 
              <div class="btn-circle btn-close transition" onclick="bos.rptkreditnominatif.close()">
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

	bos.rptkreditnominatif.grid1_data 	 = null ;
	bos.rptkreditnominatif.grid1_loaddata= function(){
		this.grid1_data 		= { 
			"tgl"	  : this.obj.find("#tgl").val(),     
			"rekening"	:this.obj.find("#rekening").val() 
		} ;
	} 

	bos.rptkreditnominatif.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rptkreditnominatif.base_url + "/loadgrid",
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
				{ field: 'caraperhitungan', caption: 'CP',style:'text-align:center', size: '60px', sortable: false},
				{ field: 'no_spk', caption: 'No. SPK',style:'text-align:left', size: '160px', sortable: false},
				{ field: 'plafond', caption: 'Plafond',style:'text-align:right', size: '140px', sortable: false},
				{ field: 'saldoakhir', caption: 'Saldo Akhir',style:'text-align:right', size: '140px', sortable: false}
					
			]
		});
   }

   bos.rptkreditnominatif.grid1_setdata	= function(){ 
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rptkreditnominatif.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rptkreditnominatif.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rptkreditnominatif.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rptkreditnominatif.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.rptkreditnominatif.cmdpilih     = function(rekening){
    bjs.ajax(this.url + '/pilih', 'rekening=' + rekening);
  }

	bos.rptkreditnominatif.cmdcetak		= function(faktur){    
		bjs_os.form_report(bos.rptkreditnominatif.url+ '/printreport?faktur=' + faktur ) ;
	}

	bos.rptkreditnominatif.obj.find("#cmdrefresh").on("click", function(){
   		bos.rptkreditnominatif.grid1_reloaddata() ; 
	}) ;

	bos.rptkreditnominatif.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rptkreditnominatif.url+ '/showreport' ) ;
	}) ;


	bos.rptkreditnominatif.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}



	bos.rptkreditnominatif.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;


		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rptkreditnominatif.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rptkreditnominatif.tabsaction( e.i )  ;
		});   

		this.obj.on("remove",function(){
			bos.rptkreditnominatif.grid1_destroy() ;
		}) ;   	
       
	}

	bos.rptkreditnominatif.loadmodelstock      = function(l){
    this.obj.find("#wrap-pencarian-d").modal(l) ; 
  }

	bos.rptkreditnominatif.objs = bos.rptkreditnominatif.obj.find("#cmdview") ;
	bos.rptkreditnominatif.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
        	e.preventDefault() ;
      	});

		this.obj.find("#cmdrekening").on("click", function(e){ 
			bos.rptkreditnominatif.loadmodelstock("show"); 
		}) ;		
	}

	$(function(){
		bos.rptkreditnominatif.initcomp() ;
		bos.rptkreditnominatif.initcallback() ;
		bos.rptkreditnominatif.initfunc() ;
	}) ;
</script>
