<style media="screen">
   #bos-form-trkasir-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-trkasir-wrapper .info{border-radius: 4px; margin-right: 20px}
</style>
<div class="bodyfix scrollme" style="height:100%">
   <table class="osxtable form" border="10">
  		<tr> 
			<td width="80px"><label for="faktur">Faktur</label> </td>
			<td width="10px">:</td>
			<td width="330px">
            <div id="faktur"></div>
			</td>
         	<td colspan="3">
            	<b class="text-danger pull-right" style="font-size: 18px;" id="kas">Saldo Kas: 0</b>
			</td>
		</tr>
      <tr>
			<td width="80px"><label for="id_pelangggan">Pelanggan</label> </td>
			<td width="10px">:</td>
			<td width="330px">
            <select name="id_pelanggan" id="id_pelanggan" class="form-control select" style="width:100%"
            data-sf="load_id_pelanggan" data-placeholder="Pelanggan" required></select>
			</td>			
		</tr>
      <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
   </table>
   <div class="row" style="height: calc(100% - 140px);">
      <div class="col-sm-8 full-height">
         <div id="grid1" class="full-height"></div>
      </div>
      <div class="col-sm-4 no-padding full-height">
         <form id="frmsave">
         <div class="info bg-success">
            <div class="panel-body">
               <label>Total Penjualan</label>
               <h3 class="no-padding no-margin" style="text-align:right" id="total">0</h3>
            </div>
         </div>
         <div class="info">
            <br />
            <label>Pembayaran (F2)</label>
            <input type="text" name="bayar" id="bayar"
            class="form-control number" style="font-size:24px; padding-right: 15px;" value="0" required>
         </div>
         <div class="info">
            <br />
            <label>Kembalian</label>
            <div style="font-size:24px; padding-right: 15px; text-align:right"  id="total_bali" class="text-number">0</div>
         </div>
         <div class="info" style="position:absolute; bottom: 0; right:0; left:0;">
            <button type="submit" name="cmdsave" id="cmdsave"
            class="btn btn-primary btn-block" style="height: 30px">Bayar</button>
         </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.trkasir.grid1_data 	 = null ;
	bos.trkasir.grid1_loaddata= function(){
		this.grid1_data 		= {} ;
	}

	bos.trkasir.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
			name		: this.id + '_grid1',
			limit 	: 100 , 
			url 		: bos.trkasir.base_url + "/loadgrid",
			postData : this.grid1_data ,
			header 	: "Daftar Tarif" ,
			show 		: {
				footer 		: true,
				header 		: true
			},
			columns: [
				{ field: 'nama', caption: 'Nama', size: '220px', sortable: false, frozen: true},
				{ field: 'harga', caption: 'Harga', size: '100px', sortable: false, style: "color:green; text-align: right", render:"number"},
				{ field: 'qty', caption: 'Qty', size: '50px', sortable: false, style: "color:green; text-align: right", render:"number"},
				{ field: 'total', caption: 'Total', size: '120px', sortable: false, style: "color:green; text-align: right", render:"number"},
            { field: 'cmddel', caption: '', size: '40px', sortable: false},
			]
		});
   }

   bos.trkasir.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}

   bos.trkasir.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}

	bos.trkasir.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}

	bos.trkasir.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.trkasir.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

   bos.trkasir.brg_harga  = 0 ;
   bos.trkasir.brg_stok   = 0 ;
   bos.trkasir.total      = 0 ;
   bos.trkasir.brgdone    = function(){
      bos.trkasir.grid1_reload() ;
      bos.trkasir.obj.find("#id_brg").sval("") ;
      bos.trkasir.obj.find("#qty").val("1") ;
      bos.trkasir.obj.find("#brg_stok").html("0") ;
      bos.trkasir.obj.find("#brg_harga").html("0") ;
      bos.trkasir.obj.find("#brg_total").html("0") ;
      bos.trkasir.obj.find("#id_brg").select2("open") ;
      bos.trkasir.brg_harga  = 0 ;

   }

   bos.trkasir.settotal    = function(total){
      this.total    = total ;
      this.obj.find("#total").html(total.numberformat()) ;
      this.obj.find("#bayar").val(0) ;
      this.obj.find("#total_bali").html(0) ;
   }

   bos.trkasir.cmddel     = function(id){
      bjs.ajax(this.url+"/cmdel", "id=" + id) ;
   }

   bos.trkasir.init       = function(){
      bjs.ajax(this.url+"/init") ;
      this.brgdone(0) ;
      this.settotal(0) ;
      this.grid1_reload()  ;
   }

   bos.trkasir.initcomp	= function(){
      bjs.initselect({
         class: "#" + bos.trkasir.id + " .select"
      }) ;
      bjs.initnumber("#" + bos.trkasir.id + " .number") ;
	}

   bos.trkasir.objadd        = bos.trkasir.obj.find("#cmdadd") ;
   bos.trkasir.objs          = bos.trkasir.obj.find("#cmdsave") ;
	bos.trkasir.initcallback	= function(){
      this.obj.find("#id_pelanggan").on("select2:select", function(e){
         bjs.ajax(bos.trkasir.url+"/savepel", "id=" + $(this).val()) ;
      }) ;

      this.obj.find("#id_brg").on("select2:select", function(e){
         bjs.ajax(bos.trkasir.url+"/setharga", "id=" + $(this).val()) ;
      }) ;

      this.obj.find("#qty").on("keyup", function(){
         //hitung
         if( bos.trkasir.brg_stok >= $(this).val() ){
            var total    = bos.trkasir.brg_harga * $(this).val() ;
            bos.trkasir.obj.find("#brg_total").html(total.numberformat()) ;
         }else{
            alert("Stok Kurang") ;
            $(this).val(bos.trkasir.brg_stok) ;
            var total    = bos.trkasir.brg_harga * bos.trkasir.brg_stok ;
            bos.trkasir.obj.find("#brg_total").html(total.numberformat()) ;
         }
      }) ;

      this.obj.find("form#frmadd").on("submit", function(e){
         e.preventDefault() ;
         bjs.ajax(bos.trkasir.url+"/addbarang", bjs.getdataform(this)) ;
      }) ;

      this.obj.find("#bayar").on("keyup", function(e){
         var kem    = $(this).val() - bos.trkasir.total  ;
         bos.trkasir.obj.find("#total_bali").html(kem.numberformat()) ;
      }) ;

      this.obj.find("form#frmsave").on("submit", function(e){
         e.preventDefault() ;
         if(bos.trkasir.obj.find("#bayar").val() >= bos.trkasir.total){
            if(confirm("Data sudah benar?")){
               bjs.ajax(bos.trkasir.url+"/saving", bjs.getdataform(this)) ;
            }
         }else{
            alert("Pembayaran Kurang") ;
            bos.trkasir.obj.find("#bayar").val(bos.trkasir.total) ;
         }
      }) ;

		this.obj.on("remove",function(){
			bos.trkasir.grid1_destroy() ;
         $('body').off("keydown") ;
		}) ;

      $('body').on("keydown", function(e){
         if(e.which == 113) {
            bos.trkasir.obj.find("#id_brg").select2("close") ;
            setTimeout(function(){bos.trkasir.obj.find("#bayar").focus() ;},1) ;
            return false;
         }
      }) ;
	}

	bos.trkasir.initfunc 		= function(){
		this.grid1_loaddata() ;
		this.grid1_load() ;
      this.init() ;
	}

	$(function(){
		bos.trkasir.initcomp() ;
		bos.trkasir.initcallback() ;
		bos.trkasir.initfunc() ;
	}) ;
</script>
