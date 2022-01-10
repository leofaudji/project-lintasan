<link rel="stylesheet" type="text/css" href="<?=base_url('bismillah/dynatree/ui.dynatree.css')?>">
<script  type="text/javascript" src="<?=base_url('bismillah/jQueryUI/jquery-ui-1.10.3.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('bismillah/jQuery/jquery.cookie.js')?>" ></script>
<script type="text/javascript" src="<?=base_url('bismillah/dynatree/jquery.dynatree.min.js')?>"></script>
<div class="header active">
	<table class="header-table">
		<tr>
			<td class="icon" ><i class="fa fa-building"></i></td>
			<td class="title">
				<div class="nav ">
					<div class="btn-group" id="tdaerah">
						<button class="btn btn-tab tdi active" href="#tusername_1" data-toggle="tab" >Daftar Level</button>
						<button class="btn btn-tab tdi" href="#tusername_2" data-toggle="tab">Level</button>
					</div>
				</div>
			</td>
			<td class="button">
				<table class="header-button" align="right">
					<tr>
						<td>
							<div class="btn-circle btn-close transition" onclick="bos.username_lv.close()">
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
				<div id="grusername_lv" class="full-height"></div>
			</div>
			<div role="tabpanel" class="tab-pane fade full-height" id="tusername_2">
				<br />
				<div class="row">
		    		<div class="col-sm-4">
		    				<div class="form-group">
								<label for="code">Code</label>
								<input type="text" class="form-control" name="code" id="code"
								placeholder="Code ex: 0001-0009" maxlength="4" minlength="4" required>
			                </div>
		    		</div>
		    	</div>
            <div class="form-group">
   				<label for="name">Name</label>
   				<input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
            </div>
            <input type="hidden" id="value" name="value">
            <div id="menu" style="min-height:300px;max-height:350px;overflow:auto;border: 1px solid #eee"></div>
			</div>
		</div>
	</div>
	<div class="footer fix hidden" style="height:32px">
		<button class="btn btn-primary btn-block" id="cmdsave">Simpan</button>
	</div>
	</form>
</div>
<script type="text/javascript">
	if(typeof bos === "undefined") window.location.href = "<?=base_url()?>";

	bos.username_lv.grid1_data 	= null ;
	bos.username_lv.grid1_loaddata= function(){
	}

	bos.username_lv.grid1_load	= function(){
		this.obj.find("#grusername_lv").w2grid({
	        name	: this.id + '_grid1',
	        limit 	: 100 ,
	        url 	: bos.username_lv.base_url + "/loadgrid",
	        postData: this.grid1_data ,
	        show: {
	        	footer 		: true
	        },
	        columns: [
	        	{ field: 'code', caption: 'Code', size: '60px', sortable: false},
	            { field: 'name', caption: 'Name', size: '150px', sortable: false },
	            { field: 'cmdedit', caption: ' ', size: '80px', sortable: false,style:'text-align:center;' },
	            { field: 'cmddelete', caption: ' ', size: '80px', sortable: false,style:'text-align:center;' }
	        ]
	    });
	}
	bos.username_lv.grid1_setdata	= function(){
		w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
	}
	bos.username_lv.grid1_reload		= function(){
		w2ui[this.id + '_grid1'].reload() ;
	}
	bos.username_lv.grid1_destroy 	= function(){
		if(w2ui[this.id + '_grid1'] !== undefined){
			w2ui[this.id + '_grid1'].destroy() ;
		}
	}
	bos.username_lv.grid1_render 	= function(){
		this.obj.find("#grusername_lv").w2render(this.id + '_grid1') ;
	}

	bos.username_lv.grid1_reloaddata	= function(){
		this.grid1_loaddata() ;
		this.grid1_setdata() ;
		this.grid1_reload() ;
	}

	bos.username_lv.cmdedit 		= function(code){
		bjs.ajax(this.base_url + '/editing', 'code=' + code);
	}

	bos.username_lv.cmddelete 	= function(code){
		if(confirm("Hapus Data?")){
			bjs.ajax(this.base_url + '/deleting', 'code=' + code);
		}
	}

	bos.username_lv.inittree 		= function(){
		this.obj.find("#menu").dynatree({
			checkbox: true,
			selectMode: 2,
			onSelect: function(select, node) {
				// Get a list of all selected nodes, and convert to a key array:
				var selKeys = $.map(node.tree.getSelectedNodes(), function(node){
				  return node.data.key;
				});

				bos.username_lv.obj.find("#value").val(selKeys.join(","));
				// Get a list of all selected TOP nodes
				var selRootNodes = node.tree.getSelectedNodes(true);
				// ... and convert to a key array:
				var selRootKeys = $.map(selRootNodes, function(node){
				  return node.data.key;
				});
			},
			onKeydown: function(node, event) {
				if( event.which == 32 ) {
				  node.toggleSelect();
				  return false;
				}
			},
			cookieId: "dynatree-Cb3",
			idPrefix: "dynatree-Cb3-"
		});
	}

	bos.username_lv.init 			= function(){
		this.obj.find("#code").attr("readonly", false) ;
		this.obj.find("#code").val("") ;
		this.obj.find("#name").val("") ;
		this.obj.find("#value").val("") ;
      this.obj.find("#menu").dynatree("getRoot").visit(function(node){
         node.select(false);
      });
	}

	bos.username_lv.initcomp		= function(){
		this.grid1_loaddata() ;
		this.grid1_load() ;
		bjs.initenter(this.obj) ;
		bjs.initselect({
			class	: "#" + this.id + " .select2",
			url 	: this.base_url
		}) ;
		bjs_os.inittab(this.obj, '.tdi') ;
		bjs_os._header(this.id) ; //drag header
		this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
	}

	bos.username_lv.initcallback	= function(){
		this.obj.on("bos:tab", function(e){
			bos.username_lv.tabsaction( e.i )  ;
		});
		this.obj.on('remove', function(){
			bos.username_lv.grid1_destroy() ;
		}) ;
	}

   bos.username_lv.cmdsave       = bos.username_lv.obj.find("#cmdsave")
	bos.username_lv.initfunc		= function(){
		setTimeout(function(){
			bos.username_lv.obj.find('#code').focus() ;
		},1) ;
		this.obj.find("#code").on("blur", function(){
			if($(this).val() !== ""){
				bjs.ajax( bos.username_lv.base_url + '/editing', 'code=' + $(this).val()) ;
			}
		}) ;
		this.obj.find('form').on("submit", function(e){
         e.preventDefault() ;
			if( bjs.isvalidform(this) ){
				bjs.ajax( bos.username_lv.base_url + '/saving', bjs.getdataform(this) , bos.username_lv.cmdsave) ;
			}
		}) ;
	}

	bos.username_lv.settab 		= function(n){
		this.obj.find("#tdaerah button:eq("+n+")").tab("show") ;
	}

	bos.username_lv.tabsaction	= function(n){
		if(n == 0){
			this.obj.find(".bodyfix").css("height","100%") ;
			this.obj.find(".footer").addClass("hidden") ;
			bos.username_lv.grid1_render() ;
			bos.username_lv.init() ;
		}else{
			this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
			this.obj.find(".footer").removeClass("hidden") ;
		}
	}

	$(function(){
		bos.username_lv.initcomp() ;
		bos.username_lv.initcallback() ;
		bos.username_lv.initfunc() ;
		bos.username_lv.inittree() ;
	})
</script>
