<div class="header active">
	<table class="header-table">
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tbk">
						<button class="btn btn-tab tbk active" href="#tpo_1" data-toggle="tab">Daftar</button>
						<button class="btn btn-tab tbk" href="#tpo_2" data-toggle="tab">Pembelian</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.po.close()">
								<img src="./uploads/titlebar/close.png">
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div><!-- end header -->
<div class="body">
	<form novalidate>
	<div class="bodyfix scrollme" style="height:100%">
		<div class="tab-content full-height">
			<div role="tabpanel" class="tab-pane active full-height" id="tpo_1" style="padding-top:5px;">
				<div id="grid1" class="full-height"></div>
			</div>
			<div role="tabpanel" class="tab-pane fade full-height" id="tpo_2">
				<table class="osxtable form">
               <tr>
                  <td width="96px"><label for="faktur">Faktur</label> </td>
                  <td width="10px">:</td>
                  <td>
                     <div id="faktur"></div>
                  </td>
               </tr>
               <tr>
                  <td width="96px"><label for="id_supplier">Supplier</label> </td>
                  <td width="10px">:</td>
                  <td>
                     <select name="id_supplier" id="id_supplier" class="form-control select2"
                     data-sf="load_id_supplier" data-placeholder="Supplier" required></select>
                  </td>
               </tr>
               <tr>
                  <td width="96px"><label for="jenis">Jenis</label> </td>
                  <td width="10px">:</td>
                  <td>
							<div class="radio-inline">
								<label>
									<input type="radio" name="jenis" class="jenis" value="0" checked>
									Biasa
								</label>
								&nbsp;&nbsp;
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="jenis" class="jenis" value="1">
									Konsiyasi
								</label>
							</div>
                  </td>
               </tr>
               <tr>
                  <td colspan="3">
                     <textarea type="text" class="form-control full-width" id="keterangan" name="keterangan" maxlength="200"
                     placeholder="Keterangan" rows="4"></textarea>
                  </td>
               </tr>
            </table>
				<div id="grbarang" style="height: calc(100% - 180px)"></div>
			</div>
		</div>
	</div>
	<div class="footer fix hidden" style="height:32px">
      <button class="btn btn-success" id="cmdsave">Simpan (Barang Belum Diterima)</button>
		<button class="btn btn-primary pull-right" type="button" id="cmdsave_fill">Simpan dan Barang Diterima</button>
	</div>
	</form>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.po.grid1_data 	 = null ;
	bos.po.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.po.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.po.base_url + "/loadgrid",
			postData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,
         searches: [
	        	{ field: 'faktur', caption: 'Faktur',type:'text'},
	        	{ field: 'tgl', caption: 'Tgl',type:'date'},
            { field: 'tgl_aktif', caption: 'Tgl.Terima',type:'date'}
	      ],
			columns: [
				{ field: 'faktur', caption: 'Faktur', size: '100px', frozen: true},
            { field: 'jenis', caption: 'Jenis', size: '80px'},
            { field: 'tgl', caption: 'Tgl', size: '80px', style: 'text-align:center'},
            { field: 'tgl_aktif', caption: 'Tgl.Terima', size: '80px', style: 'text-align:center'},
            { field: 'id_supplier', caption: 'Supplier', size: '200px'},
            { field: 'total', caption: 'Total', size: '80px', style: 'text-align:right', render: 'int'},
			   { field: 'cmdedit', caption: '', size: '80px', sortable: false },
            { field: 'cmdretur', caption: '', size: '100px', sortable: false },
				{ field: 'retur_tgl', caption: 'R. Tgl', size: '80px', sortable: false, style: 'text-align:center' },
				{ field: 'retur_keterangan', caption: 'R. Ket', size: '80px', sortable: false },
				{ field: 'retur_username', caption: 'R. User', size: '80px', sortable: false},
			]
		});
   }

   bos.po.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.po.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.po.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.po.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.po.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

   bos.po.grbarang_data 	 = null ;
   bos.po.grbarang_loaddata= function(){
      this.grbarang_data 		= {} ;
   }

   bos.po.grbarang_load    = function(){
      this.obj.find("#grbarang").w2grid({
         name		: this.id + '_grbarang',
         limit 	: 100 ,
         url 		: bos.po.base_url + "/loadgrid_barang",
         postData : this.grbarang_data ,
         header   : "Daftar Pembelian Barang" ,
         show 		: {
            header      : true,
            footer 		: true,
            toolbar		: true,
            toolbarColumns  : false,
            toolbarSearch   : false
         },
         multiSearch		: false,
         toolbar: {
               items: [
                  { type: 'break' },
                  {
                  	type: 'html',
                  	id: 'htmladd',
                  	html: '<button class="btn btn-primary" type="button" id="cmdadd" onclick="bos.po.add()">Tambah Barang</button>'
                 	}
               ]
   		   },
         columns: [
            { field: 'barang', caption: 'Barang', size: '200px', frozen: true},
            { field: 'stok', caption: 'Stok', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'qty', caption: 'Jumlah', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'harga', caption: 'Harga Beli', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'total', caption: 'Total', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'cmdd', caption: ' ', size: '40px', sortable: false }
         ]
      });
   }

   bos.po.grbarang_setdata	= function(){
      w2ui[this.id + '_grbarang'].postData 	= this.grbarang_data ;
   }
   bos.po.grbarang_reload		= function(){
      w2ui[this.id + '_grbarang'].reload() ;
   }
   bos.po.grbarang_destroy 	= function(){
      if(w2ui[this.id + '_grbarang'] !== undefined){
         w2ui[this.id + '_grbarang'].destroy() ;
      }
   }

   bos.po.grbarang_render 	= function(){
      this.obj.find("#grbarang").w2render(this.id + '_grbarang') ;
   }

   bos.po.grbarang_reloaddata	= function(){
      this.grbarang_loaddata() ;
      this.grbarang_setdata() ;
      this.grbarang_reload() ;
   }

	bos.po.cmdbrg_del = function(id){
		bjs.ajax(this.url + '/brg_del', 'id=' + id);
	}

   bos.po.add        = function(){
      setTimeout(function(){
         bjs_os.form({
            module    : "Toko",
            name      : "Pembelian Barang",
            md5       : "9e71d9b5c032d6014c2a084e3d22d35c",
            obj       : "po_add",
            loc       : "admin/tr/po_add",
            icon      : "ion-android-add-circle",
            size      : {
               width  : 300,
               height : 300
            },
            opt      : {
               resize : false,
               modal  : true
            }
         }) ;
      },100) ;
   }

	bos.po.openretur 	= function () {
		setTimeout(function(){
         bjs_os.form({
            module    : "Toko",
            name      : "Retur Pembelian Barang",
            md5       : "28723c029552d218233819d838039db9",
            obj       : "po_retur",
            loc       : "admin/tr/po_retur",
            icon      : "ion-ios-minus",
            size      : {
               width  : 550,
               height : 500
            },
            opt      : {
               resize : false,
               modal  : true
            }
         }) ;
      },100) ;
	}

	bos.po.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.po.cmdretur		= function(id){
		bjs.ajax(this.url + '/retur', 'id=' + id);
	}

	bos.po.init				= function(){
		this.obj.find("#kategori").val("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.po.settab 		= function(n){
		this.obj.find("#tbk button:eq("+n+")").tab("show") ;
	}

	bos.po.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			this.obj.find(".jenis").prop("disabled", false) ;
			this.grid1_render() ;
			this.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
         this.grbarang_render() ;
		}
	}

	bos.po.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2"
		}) ;
		bjs_os.inittab(this.obj, '.tbk') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.po.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.po.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.po.grid1_destroy() ;
			bos.po.grbarang_destroy() ;
		}) ;

      this.obj.find(".jenis").on("change", function(){
         bjs.ajax( bos.po.url + '/setjenis', "jenis=" + $(this).val() ) ;
      }) ;
	}

	bos.po.objs = bos.po.obj.find("#cmdsave") ;
	bos.po.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;
      this.grbarang_loaddata() ;
		this.grbarang_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.po.url + '/saving', bjs.getdataform(this) , bos.po.objs) ;
         }
      });

		this.obj.find("#cmdsave_fill").on("click", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(bos.po.obj.find("form"))){
				if(confirm("Apakah data sudah benar? Data tidak dapat dirubah!")){
					bjs.ajax( bos.po.url + '/saving', bjs.getdataform(bos.po.obj.find("form")) + "&fill=1", this) ;
				}
         }
      });
	}

	$(function(){
		bos.po.initcomp() ;
		bos.po.initcallback() ;
		bos.po.initfunc() ;
	}) ;
</script>
