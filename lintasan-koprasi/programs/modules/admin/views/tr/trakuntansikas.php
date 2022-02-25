<style media="screen">
   #bos-form-trakuntansikas-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-trakuntansikas-wrapper .info{border-radius: 4px; margin-right: 20px}
</style>
<div class="body">  
	<form novalidate>
	<div class="bodyfix scrollme" style="height:100%">
		<div class="tab-content full-height">
			<div> 
				<table class="osxtable form">
			  		<tr>  
						<td width="14%"><label for="tgl">Tgl</label> </td>
						<td width="1%">:</td>
						<td>
							<input  type="text" style="width:80px" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
						</td> 
					</tr> 
					<tr>
						<td width="14%"><label for="jenis">Transaksi</label> </td>
						<td width="1%">:</td>
						<td width="50%">
							<div class="radio-inline">
								<label>
									<input type="radio" name="jenis" class="jenis" value="KM" checked>
									Penerimaan Kas
								</label>
								&nbsp;&nbsp;
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="jenis" class="jenis" value="KK">
									Pengeluaran Kas
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="jenis">Rekening</label> </td>
						<td width="1%">:</td>
						<td width="50%"> 
							<select name="rekening" id="rekening" class="form-control select" style="width:100%"
            					data-sf="load_rekening" data-placeholder="Rekening" required></select>  
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="keterangan">Keterangan</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required>
						</td>
					</tr>
					<tr>
						<td width="14%"><label for="jumlah">Jumlah</label> </td>
						<td width="1%">:</td>
						<td>
							<input type="text" name="jumlah" id="jumlah" class="form-control number" placeholder="0" required> 
						</td>
					</tr>

					
				</table>
			</div>
			<div class="footer fix" style="height:32px">
    		<button class="btn btn-primary btn-block" id="cmdsave">Simpan</button>
  		</div>			
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
	<?=cekbosjs();?>

	bos.trakuntansikas.cmdedit		= function(id){
		bjs.ajax(this.url + '/editing', 'id=' + id);
	}
 
	bos.trakuntansikas.cmddelete		= function(id){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.url + '/deleting', 'id=' + id);
		}
	}

	bos.trakuntansikas.init				= function(){
		this.obj.find("#keterangan").val("") ;
		this.obj.find("#jumlah").val("0") ;
		bjs.ajax(this.url + "/init") ;
	}



	bos.trakuntansikas.initcomp	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select"
		}) ;
		bjs.initdate("#" + this.id + " .date") ;
		bjs_os.inittab(this.obj, '.tpel') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.trakuntansikas.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.trakuntansikas.tabsaction( e.i )  ;
		});  

		this.obj.on("remove",function(){
			bos.trakuntansikas.grid1_destroy() ;
		}) ;  	
      
	}

	bos.trakuntansikas.objs = bos.trakuntansikas.obj.find("#cmdsave") ;
	bos.trakuntansikas.initfunc 		= function(){
		this.init() ;

		this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            if(confirm("Apakah Anda Yakin?")){ 
            	bjs.ajax( bos.trakuntansikas.url + '/saving', bjs.getdataform(this) , bos.trakuntansikas.objs) ;
            }
         }
      });
	}

	$(function(){
		bos.trakuntansikas.initcomp() ;
		bos.trakuntansikas.initcallback() ;
		bos.trakuntansikas.initfunc() ;
	}) ;
</script>
