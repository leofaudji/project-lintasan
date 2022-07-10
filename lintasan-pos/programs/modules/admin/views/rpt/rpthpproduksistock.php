<style media="screen">
   #bos-form-rptbukubesar-wrapper .text-number{font-size: 16px; font-weight: bold; text-align: right;}
   #bos-form-rptbukubesar-wrapper .info{border-radius: 4px; margin-right: 20px}
</style> 
<form novalidate>         
<div class="bodyfix scrollme" style="height:100%"> 
    <table class="osxtable form" border="0">
		<tr>
			<td width="80px"><label for="tgl">Tgl</label> </td>
			<td width="20px">:</td>
			<td width="100px">
				<input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td>
			<td width="40px">s/d</td>
			<td width="100px">
				<input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" required value=<?=date("d-m-Y")?> <?=date_set()?>>
			</td>   
			<td></td>
			<td></td>
		</tr> 
		<tr> 
			<td><label for="stock">Produk</label> </td>
			<td>:</td>
			<td colspan="3"> 
            <select name="stock" id="stock" class="form-control select" style="width:100%"
            data-placeholder="Stock" required></select>
			</td>			
			<td></td>
			<td></td>
			<td width="100px">
				<button type = "button" class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
			</td>
			<td width="100px">	
				<button type = "button" class="btn btn-primary pull-right" id="cmdview">Preview</button>
			</td>
		</tr>
      <tr><td colspan="6"><hr class="no-margin no-padding"></td></tr>
   </table> 
   <div class="row" style="height: calc(100% - 50px);"> 
      <div class="col-sm-12 full-height">
         <div id="grid1" class="full-height"></div>
      </div> 
   </div> 
</div>
<script type="text/javascript">
    <?=cekbosjs();?>

    bos.rpthpproduksistock.grid1_data 	 = null ;
    bos.rpthpproduksistock.grid1_loaddata= function(){
        this.grid1_data 		= {
            "tglawal"	   : this.obj.find("#tglawal").val(),
            "tglakhir"	   : this.obj.find("#tglakhir").val(),
			"stock"	   : this.obj.find("#stock").val()
        } ;
    }

    bos.rpthpproduksistock.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.rpthpproduksistock.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'keterangan', caption: 'Keterangan', size: '350px', sortable: false},
                { field: '1', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false},
                { field: '2', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false},
                { field: '3', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false},
                { field: '4', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false}
            ]
        });
    }

    bos.rpthpproduksistock.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.rpthpproduksistock.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.rpthpproduksistock.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rpthpproduksistock.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rpthpproduksistock.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.rpthpproduksistock.obj.find("#cmdview").on("click", function(){
        bos.rpthpproduksistock.initreport();
	}) ;
    bos.rpthpproduksistock.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    
    bos.rpthpproduksistock.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }


    bos.rpthpproduksistock.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag


    }

    bos.rpthpproduksistock.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.rpthpproduksistock.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.rpthpproduksistock.grid1_destroy() ;
        }) ;
    }

    bos.rpthpproduksistock.initfunc	   = function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        


        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.rpthpproduksistock.grid1_reloaddata();
        });
    }

    $('#stock').select2({
        ajax: {
            url: bos.rpthpproduksistock.base_url + '/seekstock',
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
        bos.rpthpproduksistock.initcomp() ;
        bos.rpthpproduksistock.initcallback() ;
        bos.rpthpproduksistock.initfunc() ;
    });
</script>