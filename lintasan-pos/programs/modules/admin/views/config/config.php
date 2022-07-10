<form>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tgeneral" data-toggle="tab">GENERAL</a></li>
			<li><a href="#akt" data-toggle="tab">AKUNTANSI</a></li>
            <li><a href="#pb" data-toggle="tab">PEMBELIAN</a></li>
            <li><a href="#pj" data-toggle="tab">PENJUALAN</a></li>
            <li><a href="#cs" data-toggle="tab">KASIR</a></li>
			<li class="pull-right">
                <button class="btn btn-primary" id="cmdsave">Save</button>
                <button  type='button' class="btn btn-danger" onclick="bos.config.close()">Close</button>
			</li>
		</ul>
        
		<div class="tab-content">

			<div class="tab-pane active" id="tgeneral">
				<?php require_once 'config.general.php' ?>
		    </div>


			<div class="tab-pane" id="akt">
				<?php require_once 'config.akt.php' ?>
		    </div>
            
            <div class="tab-pane" id="pb">
				<?php require_once 'config.pb.php' ?>
		    </div>
            
            <div class="tab-pane" id="pj">
				<?php require_once 'config.pj.php' ?>
		    </div>
            
            <div class="tab-pane" id="cs">
				<?php require_once 'config.cs.php' ?>
		    </div>

		</div>
	</div>
    <div class="nav-tabs-custom">

    </div>

</form>

<script type="text/javascript">
	if(typeof bos === "undefined") window.location.href = "<?=base_url()?>";

	bos.config.initcomp 	= function(){

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
    
    $('#reklrthlalu').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#reklrthberjalan').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#reklrthberjalan').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekpendoprawal').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekpendoprakhir').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekbyoprawal').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekbyoprakhir').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekpendnonoprawal').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekpendnonoprakhir').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekbynonoprawal').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekbynonoprakhir').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#rekpbdisc').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#rekpbppn').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#rekpbhut').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#rekpbhutdisc').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#rekpbhutpembulatan').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#pjgudang').select2({
        ajax: {
            url: bos.config.base_url + '/seekgudang',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekpjpiutang').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    
    $('#rekpjpiutangdisc').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#rekpjpiutangpembulatan').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#rekpajakawal').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#rekpajakakhir').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });



    $('#rekselisih').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('.rekakt').select2({
        ajax: {
            url: bos.config.base_url + '/seekrekening',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });


	$(function(){
		bos.config.initcomp() ;
		bos.config.initfunc() ;
	}) ;
</script>
