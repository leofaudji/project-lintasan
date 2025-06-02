<div class="header active">
	<table class="header-table"> 
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tdaerah">
						<button class="btn btn-tab tdi active" href="#tusername_1" data-toggle="tab" >Daftar Username</button>
						<button class="btn btn-tab tdi" href="#tusername_2" data-toggle="tab">Username</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.username.close()">
								<img src="./uploads/titlebar/close.png">
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div><!-- end header -->
<div class="body">
	<form>
	<div class="bodyfix scrollme" style="height:100%">
		<div class="tab-content full-height">
			<div role="tabpanel" class="tab-pane active full-height" id="tusername_1" style="padding-top:5px;">
				<div id="grid1" class="full-height"></div>
			</div>
			<div role="tabpanel" class="tab-pane fade full-height" id="tusername_2">
				<br />
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label for="fullname">Fullname</label>
							<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" required>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label for="passowrd">Password</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="level">Level</label>
							<select class="form-control select2" data-sf="load_level"
							name="level" id="level" data-placeholder="Level" required>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="image">Foto <span id="idlimage"></span></label>
							<input type="file" name="image" id="image" accept="image/*">
						</div>
					</div>
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-6 col-sm-offset-3" id="idimage"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer fix hidden" style="height:32px">
		<button class="btn btn-primary btn-block" id="cmdsave">Simpan</button>
	</div>
	</from>
</div>
<script type="text/javascript">
	if(typeof bos === "undefined") window.location.href = "<?=base_url()?>";

	bos.username.grid1_data 	= null ;
	bos.username.grid1_loaddata= function(){
	}

	bos.username.grid1_load	= function(){
		this.obj.find("#grid1").w2grid({
	        name	: this.id + '_grid1',
	        limit 	: 100 ,
	        url 	: bos.username.base_url + "/loadgrid",
	        postData: this.grid1_data ,
	        show: {
	        	footer 		: true
	        },
	        columns: [
	            { field: 'username', caption: 'Username', size: '80px', sortable: false },
	            { field: 'fullname', caption: 'Fullname', size: '150px', sortable: false },
	            { field: 'cmdedit', caption: ' ', size: '80px', sortable: false,style:'text-align:center;' },
	            { field: 'cmddelete', caption: ' ', size: '80px', sortable: false,style:'text-align:center;' }
	        ]
	    });
	}
	bos.username.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.username.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.username.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}
	bos.username.grid1_render 	= function(){
		this.obj.find("#grid1").w2render(this.id + '_grid1') ;
	}

	bos.username.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.username.cmdedit 		= function(username){
		bjs.ajax(this.base_url + '/editing', 'username=' + username);
	}

	bos.username.cmddelete 	= function(username){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.base_url + '/deleting', 'username=' + username);
		}
	}

	bos.username.init 			= function(){
		this.obj.find("#username").val("").attr("readonly", false).focus() ;
		this.obj.find("#fullname").val("") ;
      this.obj.find("#password").val("") ;
		this.obj.find("#level").sval({}) ;
		this.obj.find("#image").val("") ;
		this.obj.find("#idlimage").html("") ;
		this.obj.find("#idimage").html("") ;

		bjs.ajax(this.base_url + '/init') ;
	}

	bos.username.initcomp		= function(){
		this.grid1_loaddata() ;
		this.grid1_load() ;
		bjs.initselect({
			class 		: "#" + this.id + " .select2"
		}) ;
		bjs_os.inittab(this.obj, '.tdi') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.username.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.username.tabsaction( e.i )  ;
		});

		this.obj.on('remove', function(){
			bos.username.grid1_destroy() ;
		}) ;
	}

	bos.username.settab 		= function(n){
		this.obj.find("#tdaerah button:eq("+n+")").tab("show") ;
	}

	bos.username.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.username.grid1_render() ;
			bos.username.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
			this.obj.find("#username").focus() ;
		}
	}

   bos.username.cmdsave       = bos.username.obj.find("#cmdsave") ;
	bos.username.initfunc		= function(){
		setTimeout(function(){
			bos.username.obj.find('#username').focus() ;
		},1) ;
		this.obj.find("#username").on("blur", function(){
			bjs.ajax( bos.username.base_url + '/seekusername', 'username=' + $(this).val() ) ;
		});
		this.obj.find("#image").on("change", function(e){
			e.preventDefault() ;

            bos.username.cfile    = e.target.files ;
            bos.username.gfile    = new FormData() ;
            $.each(bos.username.cfile, function(cKey,cValue){
              bos.username.gfile.append(cKey,cValue) ;
            }) ;

            bos.username.obj.find("#idlimage").html("<i class='fa fa-spinner fa-pulse'></i>");
            bos.username.obj.find("#idimage").html("") ;
				bos.username.obj.find("#image").val("") ;


            bjs.ajaxfile(bos.username.base_url + "/saving_image", bos.username.gfile, this) ;

		})
		this.obj.find('form').on("submit", function(e){
         e.preventDefault() ;
			if( bjs.isvalidform(this) ){
				bjs.ajax( bos.username.base_url + '/saving', bjs.getdataform(this) , bos.username.cmdsave) ;
			}
		}) ;
	}

	$(function(){
		bos.username.initcomp() ;
		bos.username.initcallback() ;
		bos.username.initfunc() ;
	})
</script>
