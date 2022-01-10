<form>
<div class="bodyfix scrollme" style="height:100%">
	<table class="osxtable form">
  		<tr>
			<td width="14%"><label for="sku">SKU</label> </td>
			<td width="1%">:</td>
			<td width="50%">
				<input name="sku" id="sku" class="form-control" data-placeholder="SKU" required />
			</td>
			<td width="14%"><label for="min">Min. Stok</label> </td>
			<td width="1%">:</td>
			<td>
				<input type="number" class="form-control number" id="min" name="min" value="0" maxlength="3">
			</td>
		</tr>
		<tr>
			<td width="14%"><label for="nama">Nama</label> </td>
			<td width="1%">:</td>
			<td width="50%">
				<input name="nama" id="nama" class="form-control" data-placeholder="Nama" required />
			</td>
			<td width="14%"><label for="harga">Harga</label> </td>
			<td width="1%">:</td>
			<td>
				<input type="text" id="harga" name="harga" class="form-control number">
			</td>
		</tr>
		<tr>
			<td width="14%"><label for="id_kat">Kategori</label> </td>
			<td width="1%">:</td>
			<td width="50%">
				<select name="id_kat" id="id_kat" class="form-control select2"
				data-sf="load_brg_kat" data-placeholder="Kategori"></select>
			</td>
			<td width="14%"><label for="satuan">Satuan</label> </td>
			<td width="1%">:</td>
			<td>
				<select name="satuan" id="satuan" class="form-control select2"
				data-sf="load_brg_sat" data-placeholder="Satuan"></select>
			</td>
		</tr>
		<tr>
			<td width="14%"><label for="jenis">Jenis</label> </td>
			<td width="1%">:</td>
			<td width="50%">
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
			<td colspan="3">
				<button class="btn btn-primary pull-right btn-block" id="cmdsave">Simpan</button>
			</td>
		</tr>
	</table>
	<div id="grid1" style="height: calc(100% - 150px)"></div>
</div>
</form>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.mstb.grid1_data 	 = null ;
	bos.mstb.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.mstb.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.mstb.base_url + "/loadgrid",
			postData : this.grid1_data ,
			header 	: "Daftar Master Barang" ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false,
				header 		: true
			},
			multiSearch		: false,
			columns: [
				{ field: 'sku', caption: 'SKU', size: '120px', sortable: false, frozen: true},
				{ field: 'nama', caption: 'Nama', size: '225px', sortable: false},
				{ field: 'kategori', caption: 'Kategori', size: '150px', sortable: false},
				{ field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
				{ field: 'jenis', caption: 'Jenis', size: '100px', sortable: false},
			   { field: 'cmdedit', caption: ' ', size: '80px', sortable: false }
			]
		});
   }

   bos.mstb.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.mstb.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.mstb.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.mstb.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.mstb.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.mstb.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}

	bos.mstb.cmddelete		= function(cid){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.mstb.init				= function(){
		this.obj.find("#sku").val("").focus() ;
		this.obj.find("#min").val("0") ;
		this.obj.find("#harga").val("0") ;
		bjs.setopt(this.obj, 'jenis', '0') ;
		this.obj.find("#nama").val("") ;
		this.obj.find("#id_kat").sval("") ;
		this.obj.find("#satuan").sval("") ;
		bjs.ajax(this.url + "/init") ;
	}

	bos.mstb.initcomp	= function(){
		bjs.initnumber("#" + this.id + " .number") ;
		bjs.initselect({
			class : "#" + this.id + " .select2"
		}) ;
	}

	bos.mstb.initcallback	= function(){
		this.obj.find("#sku").on("blur", function(e){
			bjs.ajax(bos.mstb.url + "/looksku", "sku=" + $(this).val() ) ;
		}) ;

		this.obj.on("bos:tab", function(e){
			bos.mstb.tabsaction( e.i )  ;
		});

		this.obj.on("remove",function(){
			bos.mstb.grid1_destroy() ;
		}) ;
	}

	bos.mstb.objs = bos.mstb.obj.find("#cmdsave") ;
	bos.mstb.initfunc 		= function(){
		this.init() ;
		this.grid1_loaddata() ;
		this.grid1_load() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.mstb.url + '/saving', bjs.getdataform(this) , bos.mstb.objs) ;
         }
      });
	}

	$(function(){
		bos.mstb.initcomp() ;
		bos.mstb.initcallback() ;
		bos.mstb.initfunc() ;
	}) ;
</script>
