<div class="bodyfix scrollme" style="height:100%">
   <form>
      <div class="form-group">
         <label for="">Barang</label>
         <select name="id_brg" id="id_brg" class="form-control select2"
         data-sf="load_id_brg" data-placeholder="Barang" required></select>
      </div>
      <div class="form-group">
         <label for="">Stok</label>
         <div id="text_stok" style="text-align:right; margin-right:8px;font-size:24px;font-weight:bold">0</div>
      </div>
      <div class="form-group">
         <label for="">Stok Sebenarnya</label>
         <input type="text" name="stok_ac" id="stok_ac" class="form-control number" style="font-size:24px;font-weight:bold">
      </div>
      <button class="btn btn-primary btn-block" id="cmdopname">Opname</button>
   </form>
</div>
<script type="text/javascript">
   bos.so_add.initcomp	= function(){
      bjs.initselect({
         class : "#" + this.id + " .select2"
      }) ;
      bjs.initnumber("#" + this.id + " .number") ;
   }

   bos.so_add.initcallback	= function(){
      this.obj.find("#id_brg").on("change", function(){
         bjs.ajax( bos.so_add.url + '/getstok', 'id=' + $(this).val() ) ;
      }) ;

      this.obj.find("#harga").on("keyup", function(){
         bos.so_add.total    = parseInt(bos.so_add.obj.find("#qty").val()) * parseInt($(this).val()) ;
         bos.so_add.obj.find("#text_total").html(bos.so_add.total.numberformat()) ;
      }) ;

      this.obj.on("remove",function(){
			bos.so.grbarang_reload() ;
		}) ;
   }

   bos.so_add.objs = bos.so_add.obj.find("#cmdopname") ;
   bos.so_add.initfunc 		= function(){
      this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.so_add.url + '/opname', bjs.getdataform(this) , bos.so_add.objs) ;
         }
      });
   }

   $(function(){
      bos.so_add.initcomp() ;
      bos.so_add.initcallback() ;
      bos.so_add.initfunc() ;
   }) ;
</script>
