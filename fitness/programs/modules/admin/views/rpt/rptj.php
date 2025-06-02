<form>
<div class="bodyfix" style="height: calc(100% - 34px) ;overflow-y:auto;">
	<table class="osxtable form" style="margin:0;">
		<tr>
			<td width="15%" style="padding:0"><label for="tgl">Tanggal</label> </td>
			<td width="1%">:</td>
			<td colspan="2">
				<input type="text" name="tgl" id="tgl" class="form-control date"
				style="width:100px;display: inline-block;" placeholder="Tanggal" <?=$setdate?> value="<?=date("d-m-Y")?>">
			</td>
		</tr>
		<tr>
			<td width="15%" style="padding:0"><label for="retur_faktur">Retur</label> </td>
			<td width="1%">:</td>
			<td colspan="2">
				<div class="radio-inline">
					<label>
						<input type="radio" name="retur_faktur" value="1" > Ya
					</label>
				</div>
				<div class="radio-inline">
					<label>
						<input type="radio" name="retur_faktur" value="0" checked> Tidak
					</label>
				</div>
			</td>
		</tr>
	</table>
</div>
<div class="footer fix" style="height:34px">
	<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="80%">
				<div class="progress progress-striped active" style="margin-bottom:0px;">
				  <div class="progress-bar progress-bar-info active" id="progress_1"
				  	role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" >
				    0%
				  </div>
				</div>
			</td>
			<td width="20%" align="right">
				<button class="btn btn-primary" id="cmdview">Lihat</button>
			</td>
		</tr>
	</table>
</div>
</form>
<script type="text/javascript">
   <?=cekbosjs();?>
   bos.rptj.initreport  = function(s,e){
      bjs.initprogress(this.obj.find("#progress_1"),s,e) ;
      bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form")) + '&s=' + s + '&e=' + e) ;
   }

   bos.rptj.openreport  = function(){
      bos.rptj.cmdview.button('reset') ;
      bjs.initprogress(this.obj.find("#progress_1"),100,100) ;
      bjs_os.form_report( this.base_url + '/showreport' ) ;
   }

	bos.rptj.initcomp    = function(){
      bjs.initdate("#" + this.id + " .date") ;
   }

   bos.rptj.cmdview     = bos.rptj.obj.find("#cmdview")
   bos.rptj.initfunc    = function(){
      this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         bos.rptj.cmdview.button('loading') ;
         bos.rptj.initreport(0,0) ;
      }) ;
   }

   $(function(){
		bos.rptj.initcomp() ;
      bos.rptj.initfunc() ;
   }) ;
</script>
