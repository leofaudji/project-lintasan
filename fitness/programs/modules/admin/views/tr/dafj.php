<div class="bodyfix" style="height:100% !important;">
	<div id="grid1" style="margin-top:10px; height:calc(100% - 10px)"></div>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.dafj.grid1_data 	 = null ;
	bos.dafj.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.dafj.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 ,
			url 		: bos.dafj.base_url + "/loadgrid",
			dafjstData : this.grid1_data ,
			show 		: {
				footer 		: true,
				toolbar		: true,
				toolbarColumns  : false
			},
			multiSearch		: false,
         searches: [
	        	{ field: 'faktur', caption: 'Faktur',type:'text'},
	        	{ field: 'tgl', caption: 'Tgl',type:'date'}
	      ],
			columns: [
				{ field: 'faktur', caption: 'Faktur', size: '100px', frozen: true},
            { field: 'tgl', caption: 'Tgl', size: '80px', style: 'text-align:center'},
            { field: 'id_pelanggan', caption: 'Pembeli', size: '200px'},
            { field: 'total', caption: 'Total', size: '80px', style: 'text-align:right', render: 'int'},
				{ field: 'bayar', caption: 'Bayar', size: '80px', style: 'text-align:right', render: 'int'},
			   { field: 'cmdretur', caption: '', size: '100px', sortable: false }
			]
		});
   }

   bos.dafj.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].dafjstData 	= this.grid1_data ;
	}
	bos.dafj.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.dafj.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.dafj.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.dafj.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.dafj.openretur 	= function () {
		setTimeout(function(){
         bjs_os.form({
            module    : "Toko",
            name      : "Retur Penjualan Barang",
            md5       : "c13d86bcbf1b23e3d8b6c5fe20eb6d06",
            obj       : "dafj_retur",
            loc       : "admin/tr/dafj_retur",
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

	bos.dafj.cmdretur		= function(id){
		bjs.ajax(this.url + '/retur', 'id=' + id);
	}

	bos.dafj.initcomp	= function(){
	}

	bos.dafj.initcallback	= function(){
		this.obj.on("remove",function(){
			bos.dafj.grid1_destroy() ;
		}) ;
	}

	bos.dafj.initfunc 		= function(){
		this.grid1_loaddata() ;
		this.grid1_load() ;
	}

	$(function(){
		bos.dafj.initcomp() ;
		bos.dafj.initcallback() ;
		bos.dafj.initfunc() ;
	}) ;
</script>
