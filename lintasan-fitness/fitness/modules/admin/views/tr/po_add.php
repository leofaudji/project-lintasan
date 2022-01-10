<div class="bodyfix scrollme" style="height:100%">
   <form>
      <div class="form-group">
         <label for="">Barang</label>
         <select name="id_brg" id="id_brg" class="form-control select2"
         data-sf="load_id_brg_po" data-placeholder="Barang" required></select>
      </div>
      <div class="form-group">
         <label for="">Stok</label>
         <div id="text_stok" style="text-align:right; margin-right:8px">0</div>
      </div>
      <div class="form-group">
         <label for="">Order (QTY)</label>
         <input type="text" name="qty" id="qty" class="form-control number">
      </div>
      <div class="form-group">
         <label for="">Harga</label>
         <input type="text" name="harga" id="harga" class="form-control number">
      </div>
      <div class="form-group">
         <label for="">Total</label>
         <div id="text_total" style="text-align:right; margin-right:8px; font-size:18px; color:red">0</div>
      </div>
      <button class="btn btn-primary btn-block" id="cmdtambah">Tambah</button>
   </form>
</div>
<script type="text/javascript">
   bos.po_add.initcomp	= function(){
      bjs.initselect({
         class : "#" + this.id + " .select2"
      }) ;
      bjs.initnumber("#" + this.id + " .number") ;
   }

   bos.po_add.initcallback	= function(){
      this.obj.find("#id_brg").on("change", function(){
         bjs.ajax( bos.po_add.url + '/getstok', 'id=' + $(this).val() ) ;
      }) ;

      this.obj.find("#harga").on("keyup", function(){
         bos.po_add.total    = parseInt(bos.po_add.obj.find("#qty").val()) * parseInt($(this).val()) ;
         bos.po_add.obj.find("#text_total").html(bos.po_add.total.numberformat()) ;
      }) ;

      this.obj.on("remove",function(){
			bos.po.grbarang_reload() ;
		}) ;
   }

   bos.po_add.objs = bos.po_add.obj.find("#cmdtambah") ;
   bos.po_add.initfunc 		= function(){
      this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            bjs.ajax( bos.po_add.url + '/tambah', bjs.getdataform(this) , bos.po_add.objs) ;
         }
      });
   }

   $(function(){
      bos.po_add.initcomp() ;
      bos.po_add.initcallback() ;
      bos.po_add.initfunc() ;
   }) ;
</script>
