<div class="bodyfix" style="height:100% !important;">
	<div id="grid1" style="margin-top:10px; height:calc(100% - 10px)"></div>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.dafk.grid1_data 	 = null ;
	bos.dafk.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.dafk.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.dafk.base_url + "/loadgrid",
			dafkstData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,
			columns: [
				{ field: 'faktur', caption: 'Faktur', size: '90px', frozen: true},
				{ field: 'id_supplier', caption: 'Supplier', size: '200px'},
				{ field: 'tgl', caption: 'Tanggal', size: '80px', style: 'text-align:center'},
            { field: 'qty', caption: 'Awal', size: '80px', style: 'text-align:right', render: 'int'},
				{ field: 'qty_sisa', caption: 'Stok Akhir', size: '80px', style: 'text-align:right', render: 'int'},
				{ field: 'retur_bayar', caption: 'Total Bayar', size: '80px', style: 'text-align:right', render: 'int'},
			   { field: 'cmdretur', caption: '', size: '120px', sortable: false },
				{ field: 'retur_keterangan', caption: 'B. Ket', size: '250px', sortable: false },
				{ field: 'retur_tgl', caption: 'B. Tgl', size: '250px', sortable: false },
				{ field: 'retur_username', caption: 'B. User', size: '250px', sortable: false }
			]
		});
   }

   bos.dafk.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].dafkstData 	= this.grid1_data ;
	}
	bos.dafk.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.dafk.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.dafk.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.dafk.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.dafk.openretur 	= function () {
		setTimeout(function(){
         bjs_os.form({
            module    : "Toko",
            name      : "Pembayaran Konsiyasi Barang",
            md5       : "c13d86bcbf1b23e3d8b6c5fe20eb6d06",
            obj       : "dafk_retur",
            loc       : "admin/tr/dafk_retur",
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

	bos.dafk.cmdretur		= function(id){
		bjs.ajax(this.url + '/retur', 'id=' + id);
	}

	bos.dafk.initcomp	= function(){
	}

	bos.dafk.initcallback	= function(){
		this.obj.on("remove",function(){
			bos.dafk.grid1_destroy() ;
		}) ;
	}

	bos.dafk.initfunc 		= function(){
		this.grid1_loaddata() ;
		this.grid1_load() ;
	}

	$(function(){
		bos.dafk.initcomp() ;
		bos.dafk.initcallback() ;
		bos.dafk.initfunc() ;
	}) ;
</script>
