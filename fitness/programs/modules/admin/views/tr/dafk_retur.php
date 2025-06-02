<form>
<div class="bodyfix scrollme">
   <table class="osxtable form">
      <tr>
         <td width="96px"><label for="faktur">Faktur</label> </td>
         <td width="10px">:</td>
         <td>
            <div id="faktur"><?=$faktur?></div>
         </td>
      </tr>
      <tr>
         <td width="96px"><label for="id_supplier">Supplier</label> </td>
         <td width="10px">:</td>
         <td>
            <div id="id_supplier"><?=$sup['kode'] . " - " . $sup['nama']?></div>
         </td>
      </tr>
      <tr>
         <td width="96px"><label for="jenis">Keterangan</label> </td>
         <td width="10px">:</td>
         <td>
            <div id="keterangan"><?=$keterangan?></div>
         </td>
      </tr>
      <tr>
         <td colspan="3">
            <label for="">Keterangan Pelunasan</label>
            <input type="text" name="retur_keterangan" id="retur_keterangan" class="form-control" maxlength="200" required>
         </td>
      </tr>
   </table>
   <div id="grbarang" style="height: calc(100% - 150px)"></div>
</div>
<div class="footer fix" style="height:32px">
   <button class="btn btn-danger pull-right" id="cmdsave">Lunasi Sekarang</button>
</div>
</form>
<script type="text/javascript">
   <?=cekbosjs();?>

   bos.dafk_retur.grid1_data 	 = null ;
   bos.dafk_retur.grid1_loaddata= function(){
      this.grid1_data 		= {} ;
   }

   bos.dafk_retur.grid1_load    = function(){
      this.obj.find("#grbarang").w2grid({
         name		: this.id + '_grbarang',
         limit 	: 100 ,
         url 		: bos.dafk_retur.base_url + "/loadgrid",
         postData : this.grid1_data ,
         columns: [
            { field: 'barang', caption: 'Barang', size: '200px', frozen: true},
            { field: 'qty', caption: 'Jumlah', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'qty_sisa', caption: 'Stok Akhir', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'harga', caption: 'Harga Beli', size: '80px', style: 'text-align:right', render: 'int'},
            { field: 'retur_bayar', caption: 'Total Bayar', size: '80px', style: 'text-align:right', render: 'int'}
         ]
      });
   }

   bos.dafk_retur.grid1_setdata	= function(){
      w2ui[this.id + '_grbarang'].postData 	= this.grid1_data ;
   }
   bos.dafk_retur.grid1_reload		= function(){
      w2ui[this.id + '_grbarang'].reload() ;
   }
   bos.dafk_retur.grid1_destroy 	= function(){
      if(w2ui[this.id + '_grbarang'] !== undefined){
         w2ui[this.id + '_grbarang'].destroy() ;
      }
   }

   bos.dafk_retur.grid1_render 	= function(){
      this.obj.find("#grbarang").w2render(this.id + '_grbarang') ;
   }

   bos.dafk_retur.grid1_reloaddata	= function(){
      this.grid1_loaddata() ;
      this.grid1_setdata() ;
      this.grid1_reload() ;
   }

   bos.dafk_retur.initcallback	= function(){
      this.obj.find("#retur_keterangan").focus() ;
      this.obj.on("remove",function(){
         bos.dafk_retur.grid1_destroy() ;
         bos.dafk.grid1_reload() ;
      }) ;
   }

   bos.dafk_retur.objs = bos.dafk_retur.obj.find("#cmdsave") ;
   bos.dafk_retur.initfunc 		= function(){
      this.grid1_loaddata() ;
      this.grid1_load() ;

      this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            if(confirm("Apakah anda yakin? Data yang sudah dibayar tidak dapat dirubah!")){
               bjs.ajax( bos.dafk_retur.url + '/saving', bjs.getdataform(this) , bos.dafk_retur.objs) ;
            }
         }
      });
   }

   $(function(){
      bos.dafk_retur.initcallback() ;
      bos.dafk_retur.initfunc() ;
   }) ;
</script>
