<div class="bodyfix scrollme" style="height:100%">
   <div id="grid1" style="height: calc(100% - 10px); margin-top: 10px"></div>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.harga.grid1_data 	 = null ;
	bos.harga.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.harga.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.harga.base_url + "/loadgrid",
			postData : this.grid1_data ,
			header 	: "Daftar Harga Barang, Klik 2x Pada Bagian Harga Jual dan HPP Untuk Merubahnya" ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false,
				header 		: true
			},
			multiSearch		: false,
			columns: [
				{ field: 'sku', caption: 'SKU', size: '120px', sortable: false, frozen: true},
				{ field: 'nama', caption: 'Nama', size: '225px', sortable: false, frozen: true},
				{ field: 'kategori', caption: 'Kategori', size: '150px', sortable: false},
				{ field: 'satuan', caption: 'Satuan', size: '100px', sortable: false},
				{ field: 'jenis', caption: 'Jenis', size: '100px', sortable: false},
            { field: 'stok', caption: 'Stok', size: '40px', sortable: false, render: 'number'},
            { field: 'tgl_ex', caption: 'Tgl Kadaluarsa', size: '90px', sortable: false,
               editable: { type: 'date' }, style: 'text-align: center; color: red', render: 'date'
            },
            { field: 'harga', caption: 'Harga Jual', size: '90px', sortable: false,
               editable: { type: 'number:2' }, style: 'text-align: right; color: green', render: 'number:2'
            },
            { field: 'hp', caption: 'HPP', size: '90px',
               editable: { type: 'number:2' }, style: 'text-align: right; color: red', render: 'number:2'
            },
            { field: 'laba', caption: 'Laba', size: '90px',
               style: 'text-align: right; color: green', render: 'number:2'
            }
			],
         onChange: function(e) {
            bjs.ajax(bos.harga.url+"/saving", "id=" + e.recid + "&n=" + e.value_new + "&col=" + e.column) ;
         }
		});
   }

   bos.harga.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}

   bos.harga.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}

	bos.harga.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.harga.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.harga.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

   bos.harga.grid1_frow	= function(id, col, n){
      bos.harga.grid1_get = w2ui[this.id + '_grid1'].get(id) ;
      if(col == 7){
         bos.harga.grid1_get.harga = n;
      }else if(col == 8){
         bos.harga.grid1_get.hp    = n;
      }else if(col == 6){
         bos.harga.grid1_get.tgl_ex= n;
      }
      bos.harga.grid1_get.laba     = bos.harga.grid1_get.harga - bos.harga.grid1_get.hp ;
      w2ui[this.id + '_grid1'].refreshRow(id);
   }

   bos.harga.initcomp	= function(){

	}

	bos.harga.initcallback	= function(){
		this.obj.on("remove",function(){
			bos.harga.grid1_destroy() ;
		}) ;
	}

	bos.harga.initfunc 		= function(){
		this.grid1_loaddata() ;
		this.grid1_load() ;
	}

	$(function(){
		bos.harga.initcomp() ;
		bos.harga.initcallback() ;
		bos.harga.initfunc() ;
	}) ;
</script>
