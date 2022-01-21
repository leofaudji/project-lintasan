<style media="screen">
   #bos-form-rpttabunganbuku-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rpttabunganbuku-wrapper .info{border-radius: 4px; margin-right: 20px} 
</style> 

<div class="header active"> 
  <table class="header-table"> 
    <tr> 
      <td class="icon" ><i class="fa fa-building"></i></td> 
      <td class="title">
        <div class="nav ">
          <div class="btn-group" id="tpel"> 
            <span> Laporan Buku Tabungan </span>
          </div>
        </div>
      </td>
      <td class="button">
        <table class="header-button" align="right"> 
          <tr> 
            <td> 
              <div class="btn-circle btn-close transition" onclick="bos.rpttabunganbuku.close()">
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
			<td width="100px"><label for="tgl">Tgl</label> </td>
			<td width="20px">:</td>
			<td>
				<input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
				 
			</td>   
			<td>&nbsp;s/d&nbsp;</td>
			<td>  
				<input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td> 
			<td width="400px">
				<div style="width:50%" class="input-group"> 
					<input type="text" id="rekening" name="rekening" class="form-control" placeholder="No. Rekening">
					<span class="input-group-btn">
						<button class="form-control btn btn-info" type="button" id="cmdrekening"><i class="fa fa-search"></i></button>
					</span>
				</div> 
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

<div class="modal fade" id="wrap-pencarian-d" role="dialog" data-backdrop="false" data-keyboard="false">
  <div class="modal-dialog">  
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="wm-title">Daftar Rekening</h4>
          </div>
          <div class="modal-body">
              <div id="grid3" style="height:250px"></div>
          </div> 
          <div class="modal-footer">
              *Pilih Rekening
          </div>
      </div>
  </div> 
</div> 

<script type="text/javascript">
	<?=cekbosjs();?>

	bos.rpttabunganbuku.grid1_data 	 = null ;
	bos.rpttabunganbuku.grid1_loaddata= function(){
		this.grid1_data 		= { 
			"tglawal"	  : this.obj.find("#tglawal").val(),    
			"tglakhir"	: this.obj.find("#tglakhir").val(), 
			"rekening"	:this.obj.find("#rekening").val() 
		} ;
	} 

	bos.rpttabunganbuku.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.rpttabunganbuku.base_url + "/loadgrid",
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
				{ field: 'kode_transaksi', caption: 'Kode',style:'text-align:center', size: '50px', sortable: false},
				{ field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false},
				{ field: 'debet', caption: 'Debet',style:'text-align:right', size: '100px', sortable: false},
				{ field: 'kredit', caption: 'Kredit',style:'text-align:right', size: '100px', sortable: false},
				{ field: 'saldoakhir', caption: 'Saldo Akhir',style:'text-align:right', size: '120px', sortable: false},
				{ field: 'datetime', caption: 'Diproses pada', size: '250px', sortable: false}
					
			]
		});
   }

   bos.rpttabunganbuku.grid1_setdata	= function(){ 
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.rpttabunganbuku.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.rpttabunganbuku.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.rpttabunganbuku.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.rpttabunganbuku.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	//grid3 daftarrekening
  bos.rpttabunganbuku.grid3_data    = null ;
    bos.rpttabunganbuku.grid3_loaddata= function(){
        this.grid3_data     = {} ;
  }

  bos.rpttabunganbuku.grid3_load    = function(){
      this.obj.find("#grid3").w2grid({
          name  : this.id + '_grid3',
          limit   : 100 ,
          url   : bos.rpttabunganbuku.base_url + "/loadgrid3",
          postData: this.grid3_data ,
          show: {
              footer     : true,
              toolbar    : true,
              toolbarColumns  : false
          },
          multiSearch    : false,
          columns: [
              { field: 'rekening', caption: 'No. Rekening', size: '120px', sortable: false},
              { field: 'nama', caption: 'Nama', size: '150px', sortable: false },
              { field: 'alamat', caption: 'Alamat', size: '200px', sortable: false },
              { field: 'cmdpilih', caption: ' ', size: '80px', sortable: false }
          ]
      });
  }

  bos.rpttabunganbuku.grid3_setdata  = function(){
      w2ui[this.id + '_grid3'].postData   = this.grid3_data ;
  }
  bos.rpttabunganbuku.grid3_reload    = function(){
      w2ui[this.id + '_grid3'].reload() ;
  }
  bos.rpttabunganbuku.grid3_destroy   = function(){
      if(w2ui[this.id + '_grid3'] !== undefined){ 
          w2ui[this.id + '_grid3'].destroy() ;
      }
  }

  bos.rpttabunganbuku.grid3_render   = function(){
      this.obj.find("#grid3").w2render(this.id + '_grid3') ;
  }

  bos.rpttabunganbuku.grid3_reloaddata  = function(){
      this.grid3_loaddata() ;
      this.grid3_setdata() ;
      this.grid3_reload() ;
  }

	bos.rpttabunganbuku.cmdpilih     = function(rekening){
    bjs.ajax(this.url + '/pilih', 'rekening=' + rekening);
  }

	bos.rpttabunganbuku.cmdcetak		= function(faktur){    
		bjs_os.form_report(bos.rpttabunganbuku.url+ '/printreport?faktur=' + faktur ) ;
	}

	bos.rpttabunganbuku.obj.find("#cmdrefresh").on("click", function(){
   		bos.rpttabunganbuku.grid1_reloaddata() ; 
	}) ;

	bos.rpttabunganbuku.obj.find("#cmdview").on("click", function(){
		bjs_os.form_report(bos.rpttabunganbuku.url+ '/showreport' ) ;
	}) ;


	bos.rpttabunganbuku.init				= function(){
		bjs.ajax(this.url + "/init") ;
	}



	bos.rpttabunganbuku.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;

		this.grid3_load() ; 

		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.rpttabunganbuku.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.rpttabunganbuku.tabsaction( e.i )  ;
		});  

		this.obj.find("#pelanggan").on("select2:select", function(e){ 
         	bjs.ajax(bos.rpttabunganbuku.url+"/seekpel", "pelanggan=" + $(this).val()) ;
      	}) ; 

		this.obj.on("remove",function(){
			bos.rpttabunganbuku.grid1_destroy() ;
			bos.rpttabunganbuku.grid3_destroy() ;
		}) ;   	
      
	}

	bos.rpttabunganbuku.loadmodelstock      = function(l){
    this.obj.find("#wrap-pencarian-d").modal(l) ; 
  }

	bos.rpttabunganbuku.objs = bos.rpttabunganbuku.obj.find("#cmdview") ;
	bos.rpttabunganbuku.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
        	e.preventDefault() ;
      	});

		this.obj.find("#cmdrekening").on("click", function(e){
			bos.rpttabunganbuku.loadmodelstock("show"); 
			bos.rpttabunganbuku.grid3_reloaddata() ;
		}) ;		
	}

	$(function(){
		bos.rpttabunganbuku.initcomp() ;
		bos.rpttabunganbuku.initcallback() ;
		bos.rpttabunganbuku.initfunc() ;
	}) ;
</script>
