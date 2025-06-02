<div class="header active">
	<table class="header-table">
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tbk">
						<button class="btn btn-tab tbk active" href="#tpo_1" data-toggle="tab">Daftar</button>
						<button class="btn btn-tab tbk" href="#tpo_2" data-toggle="tab">Opname</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.so.close()">
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
                  <td colspan="3">
                     <textarea type="text" class="form-control full-width" id="keterangan" name="keterangan" maxlength="200"
                     placeholder="Keterangan" rows="4" required></textarea>
                  </td>
               </tr>
            </table>
				<div id="grbarang" style="height: calc(100% - 120px)"></div>
			</div>
		</div>
	</div>
	<div class="footer fix hidden" style="height:32px">
		<button class="btn btn-primary pull-right" type="button" id="cmdsave_fill">Simpan</button>
	</div>
	</form>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.so.grid1_data 	 = null ;
	bos.so.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.so.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.so.base_url + "/loadgrid",
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
            { field: 'tgl', caption: 'Tgl', size: '80px', style: 'text-align:center'},
            { field: 'total', caption: 'Rugi/Untung', size: '100px', style: 'text-align:right', render: 'int'},
				{ field: 'keterangan', caption: 'Keterangan', size: '300px'}
			]
		});
   }

   bos.so.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.so.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.so.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.so.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.so.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

   bos.so.grbarang_data 	 = null ;
   bos.so.grbarang_loaddata= function(){
      this.grbarang_data 		= {} ;
   }

   bos.so.grbarang_load    = function(){
      this.obj.find("#grbarang").w2grid({
         name		: this.id + '_grbarang',
         limit 	: 100 ,
         url 		: bos.so.base_url + "/loadgrid_barang",
         postData : this.grbarang_data ,
         header   : "Daftar Opname Barang" ,
         show 		: {
            header      : true,
            toolbar		: true,
            toolbarSearch   : false,
            toolbarColumns  : false
         },
         toolbar: {
               items: [
                  { type: 'break' },
                  {
                  	type: 'html',
                  	id: 'htmladd',
                  	html: '<button class="btn btn-primary" type="button" id="cmdadd" onclick="bos.so.add()">Tambah Barang</button>'
                 	}
               ]
   		   },
         columns: [
            { field: 'barang', caption: 'Barang', size: '200px', frozen: true},
            { field: 'stok', caption: 'Stok', size: '80px', style: 'text-align:right', render: 'int'},
				{ field: 'stok_ac', caption: 'Stok Benar', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'qty', caption: 'Opname', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'total', caption: 'Rugi/Untung', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'cmdd', caption: '', size: '40px', sortable: false }
         ]
      });
   }

   bos.so.grbarang_setdata	= function(){
      w2ui[this.id + '_grbarang'].postData 	= this.grbarang_data ;
   }
   bos.so.grbarang_reload		= function(){
      w2ui[this.id + '_grbarang'].reload() ;
   }
   bos.so.grbarang_destroy 	= function(){
      if(w2ui[this.id + '_grbarang'] !== undefined){
         w2ui[this.id + '_grbarang'].destroy() ;
      }
   }

   bos.so.grbarang_render 	= function(){
      this.obj.find("#grbarang").w2render(this.id + '_grbarang') ;
   }

   bos.so.grbarang_reloaddata	= function(){
      this.grbarang_loaddata() ;
      this.grbarang_setdata() ;
      this.grbarang_reload() ;
   }

	bos.so.cmdbrg_del = function(id){
		bjs.ajax(this.url + '/brg_del', 'id=' + id);
	}

   bos.so.add        = function(){
      setTimeout(function(){
         bjs_os.form({
            module    : "Toko",
            name      : "Opname Barang",
            md5       : "cc5f8561e9f841fba4b7ab50a004db8a",
            obj       : "so_add",
            loc       : "admin/tr/so_add",
            icon      : "ion-android-add-circle",
            size      : {
               width  : 300,
               height : 250
            },
            opt      : {
               resize : false,
               modal  : true
            }
         }) ;
      },100) ;
   }

	bos.so.init				= function(){
		this.obj.find("#kategori").val("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.so.settab 		= function(n){
		this.obj.find("#tbk button:eq("+n+")").tab("show") ;
	}

	bos.so.tabsaction	= function(n){
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

	bos.so.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2"
		}) ;
		bjs_os.inittab(this.obj, '.tbk') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.so.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.so.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.so.grid1_destroy() ;
			bos.so.grbarang_destroy() ;
		}) ;

      this.obj.find("#jenis").on("change", function(){
         bjs.ajax( bos.so.url + '/setjenis', "jenis=" + $(this).val() ) ;
      }) ;
	}

	bos.so.objs = bos.so.obj.find("#cmdsave") ;
	bos.so.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;
      this.grbarang_loaddata() ;
		this.grbarang_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.so.url + '/saving', bjs.getdataform(this) , bos.so.objs) ;
         }
      });

		this.obj.find("#cmdsave_fill").on("click", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(bos.so.obj.find("form"))){
				if(confirm("Apakah data sudah benar? Data tidak dapat dirubah!")){
					bjs.ajax( bos.so.url + '/saving', bjs.getdataform(bos.so.obj.find("form")) + "&fill=1", this) ;
				}
         }
      });
	}

	$(function(){
		bos.so.initcomp() ;
		bos.so.initcallback() ;
		bos.so.initfunc() ;
	}) ;
</script>
