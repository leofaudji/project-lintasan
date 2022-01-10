<form>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tgeneral" data-toggle="tab">GENERAL</a></li>
			<li><a href="#tttd" data-toggle="tab">TANDA TANGAN</a></li>
			<li class="pull-right">
				<button class="btn btn-primary" id="cmdsave">Save</button>
			</li>
		</ul>
		<div class="tab-content">

			<div class="tab-pane active" id="tgeneral">
				<?php require_once 'config.general.php' ?>
		    </div>


			<div class="tab-pane" id="tttd">
				<?php require_once 'config.ttd.php' ?>
		    </div>

		</div> 
	</div>
</form>

<script type="text/javascript">
	if(typeof bos === "undefined") window.location.href = "<?=base_url()?>";

	bos.config.initcomp 	= function(){
		bjs.initselect({
			class : "#" + this.id + " .select2"
		}) ;
		bjs.initnumber("#" + this.id + " .number") ;
	}

	bos.config.cmdsave 	= bos.config.obj.find("#cmdsave") ;
	bos.config.initfunc 	= function(){
		this.obj.find(".fupload").on("change", function(e){
			bos.config.uname	= $(this).attr("id") ;
			e.preventDefault() ;

            bos.config.fal    = e.target.files ;
            bos.config.gfal   = new FormData() ;
            $.each(bos.config.fal, function(key,val){
              bos.config.gfal.append(key,val) ;
            }) ;

            bos.config.obj.find("#idl" + bos.config.uname).html("<i class='fa fa-spinner fa-pulse'></i>");
            bos.config.obj.find("#id" + bos.config.uname).html("") ;

            bjs.ajaxfile(bos.config.base_url + "/saving_image/" + bos.config.uname , bos.config.gfal, this) ;
		}) ;

		this.obj.find("form").on("submit", function(e){
			e.preventDefault() ;
			bjs.ajax( bos.config.base_url + "/saving", bjs.getdataform(this), bos.config.cmdsave )
		}) ;
 	}

	$(function(){
		bos.config.initcomp() ;
		bos.config.initfunc() ;
	}) ;
</script>
