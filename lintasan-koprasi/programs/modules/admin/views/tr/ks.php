<div class="header active">
	<table class="header-table">
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tbk">
						<button class="btn btn-tab tbk active" href="#tbk_1" data-toggle="tab">Daftar Konversi</button>
						<button class="btn btn-tab tbk" href="#tbk_2" data-toggle="tab">Konversi Barang</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.ks.close()">
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
	<form>
	<div class="bodyfix scrollme" style="height:100%">
		<div class="tab-content full-height">
			<div role="tabpanel" class="tab-pane active full-height" id="tbk_1" style="padding-top:5px;">
				<div id="grid1" class="full-height"></div>
			</div>
			<div role="tabpanel" class="tab-pane fade full-height" id="tbk_2">
            <table class="osxtable form">
               <tr>
                  <td width="20%"><label for="faktur">Faktur</label> </td>
                  <td width="1%">:</td>
                  <td colspan="4">
                     <div id="faktur"></div>
                  </td>
               </tr>
           		<tr>
         			<td width="20%"><label for="id_brg">Barang Konversi</label> </td>
         			<td width="1%">:</td>
         			<td width="40%">
                     <select name="id_brg" id="id_brg" class="form-control select2"
                     data-sf="load_id_brg" data-placeholder="Barang" required></select>
         			</td>
         			<td width="14%"><label for="stok">Stok</label> </td>
         			<td width="1%">:</td>
         			<td>
         				<div id="stok" class="text-right"></div>
         			</td>
         		</tr>
               <tr>
         			<td width="20%"><label for="id_brg">Satuan</label> </td>
         			<td width="1%">:</td>
         			<td width="40%">
                     <div id="satuan"></div>
         			</td>
         			<td width="14%"><label for="min">Qty Konversi</label> </td>
         			<td width="1%">:</td>
         			<td>
         				<input type="text" name="qty" id="qty" class="form-control number" value="1">
         			</td>
         		</tr>
               <tr><td colspan="6"><hr class="no-margin no-padding"/></td></tr>
               <tr>
         			<td width="20%"><label for="id_brg">Barang Tujuan</label> </td>
         			<td width="1%">:</td>
         			<td width="40%">
                     <select name="id_brg_tujuan" id="id_brg_tujuan" class="form-control select2"
                     data-sf="load_id_brg" data-placeholder="Barang Tujuan" required></select>
         			</td>
         			<td width="20%"><label for="stok">Stok</label> </td>
         			<td width="1%">:</td>
         			<td>
         				<div id="stok_tujuan" class="text-right"></div>
         			</td>
         		</tr>
               <tr>
         			<td width="20%"><label for="id_brg">Satuan</label> </td>
         			<td width="1%">:</td>
         			<td width="40%">
                     <div id="satuan_tujuan"></div>
         			</td>
         			<td width="14%"><label for="min">Qty Tujuan</label> </td>
         			<td width="1%">:</td>
         			<td>
         				<input type="text" name="qty_tujuan" id="qty_tujuan" class="form-control number" value="1">
         			</td>
         		</tr>
               <tr>
                  <td colspan="3">
                     Harga Pokok mengambil dari HPP Barang Konversi / Qty Tujuan
         			</td>
                  <td width="14%"><label for="min">Harga Pokok</label> </td>
         			<td width="1%">:</td>
         			<td>
                     <input type="text" name="harga" id="harga" class="form-control number" value="0">
         			</td>
         		</tr>
            </table>
            <div class="form-group">
               <label>Keterangan</label>
               <textarea name="keterangan" id="keterangan" rows="5" class="form-control"></textarea>
            </div>
			</div>
		</div>
	</div>
	<div class="footer fix hidden" style="height:32px">
		<button class="btn btn-primary pull-right" id="cmdsave">Save</button>
	</div>
	</form>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.ks.grid1_data 	 = null ;
	bos.ks.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.ks.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.ks.base_url + "/loadgrid",
			postData : this.grid1_data ,
         header 	: "Daftar Konversi Stok" ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false,
				header 		: true
			},
			multiSearch		: false,
			columns: [
				{ field: 'faktur', caption: 'Faktur', size: '100px', sortable: false, frozen: true},
				{ field: 'tgl', caption: 'Tgl', size: '80px', sortable: false},
				{ field: 'nama_brg', caption: 'Barang Konversi', size: '225px', sortable: false},
            { field: 'qty', caption: 'Qty Konversi', size: '60px', sortable: false, render: 'number'},
				{ field: 'nama_brg_tujuan', caption: 'Barang Tujuan', size: '225px', sortable: false},
            { field: 'qty_tujuan', caption: 'Qty Tujuan', size: '60px', sortable: false, render: 'number'},
			   { field: 'keterangan', caption: 'Ket', size: '200px', sortable: false }
			]
		});
   }

   bos.ks.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.ks.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.ks.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.ks.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.ks.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.ks.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.ks.cmddelete		= function(cid){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.ks.init				= function(){
		this.obj.find("#id_brg").sval("") ;
      this.obj.find("#qty").val("1") ;
      this.obj.find("#stok").html("0") ;
      this.obj.find("#satuan").html("") ;
      this.obj.find("#id_brg_tujuan").sval("") ;
      this.obj.find("#qty_tujuan").val("1") ;
      this.obj.find("#satuan_tujuan").html("") ;
      this.obj.find("#stok_tujuan").html("0") ;
		bos.ks.harga 	= 0 ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.ks.settab 		= function(n){
		this.obj.find("#tbk button:eq("+n+")").tab("show") ;
	}

	bos.ks.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.ks.grid1_render() ;
			bos.ks.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#kategori").focus() ;
		}
	}

	bos.ks.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2"
		}) ;
      bjs.initnumber("#" + this.id + " .number") ;
		bjs_os.inittab(this.obj, '.tbk') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.ks.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.ks.tabsaction( e.i )  ;
		});

      this.obj.find("#id_brg").on("select2:select", function(e){
			if($(this).val() !== ""){
				bjs.ajax(bos.ks.url + "/getstok", "id=" + $(this).val()) ;
			}
      });

      this.obj.find("#id_brg_tujuan").on("select2:select", function(e){
         if($(this).val() !== ""){
				bjs.ajax(bos.ks.url + "/getstok", "id=" + $(this).val() + "&tujuan=_tujuan") ;
			}
      });

      this.obj.find("#qty_tujuan").on("keyup", function(e){
         bos.ks.obj.find("#harga").val(bos.ks.harga / Math.max($(this).val(),1) ) ;
      })

		this.obj.on("remove",function(){
			bos.ks.grid1_destroy() ;
		}) ;
	}

	bos.ks.objs = bos.ks.obj.find("#cmdsave") ;
	bos.ks.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
				if(confirm("Apakah data sudah benar? Data Konversi yang telah disimpan tidak dapat dirubah ataupun dihapus!"))
            bjs.ajax( bos.ks.url + '/saving', bjs.getdataform(this) , bos.ks.objs) ;
         }
      });
	}

	$(function(){
		bos.ks.initcomp() ;
		bos.ks.initcallback() ;
		bos.ks.initfunc() ;
	}) ;
</script>
