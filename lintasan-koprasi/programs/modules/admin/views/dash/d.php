<style media="screen">
   #bos-form-d-wrapper #wrap-filter{
      background-color: #F7F7FA ;
      position: absolute;
      top: 49px ;
      left: -350px;
      width: 300px;
      height: calc(100% - 49px) ;
      z-index: 1 ;
      padding: 0px;
      box-shadow: 4px 4px 4px rgba(0,0,0,.06),4px 4px 4px rgba(0,0,0,.06) ;
   }
      #bos-form-d-wrapper #wrap-filter.active{ display: block; left: 0px; z-index: 99999}
      #bos-form-d-wrapper #wrap-filter #frm{
         padding: 20px;
         height: calc(100% - 25px) ;
         overflow-y: auto;
      }
      #bos-form-d-wrapper #wrap-filter #filter{
         position: absolute;
         bottom: 0 ;
         left: 0;
         right: 0;
         padding: 10px ;
      }
   #bos-form-d-wrapper #wrap-map{
      height: 500px;
      background: #aaa;
      border-radius: 4px;
   }
   .dsh2{border-radius: 3px; position: relative;}
		.dsh2.bodyfix{ padding: 0 !important; height: 100% !important; background: #F7F7FA ; }
		.dsh2 .dsh-header{
			background-color: #fff ;
			width: 100% ;
			padding: 10px ;
			color: #454545 ;
			font-size: 16px ;
			letter-spacing: 0.02em ;
			border-bottom: 1px solid rgba(225,225,225,.7) ;
			position: relative;
			border-radius: 3px 3px 0px 0px;
         height:50px;
		}
			.dsh2 .dsh-header h4{margin: 0; padding: 0 ; display: inline-block; font-weight: 300 ; }
			.dsh2 .dsh-header h4.icon:hover{opacity: .8 ; cursor: pointer;}
			.dsh2 .dsh-header .close{
            font-size: 14px ;
				float: right;
				color: #454545 ;
				cursor: pointer;
				margin: 2px 4px ;
				opacity: .5 ;
			}
         .dsh2 .dsh-panel{border-radius: 8px; padding-top: 10px;padding-bottom:10px;}
            .dsh2 .dsh-panel .head{margin: 0; padding: 0 ; font-weight: 300 ; letter-spacing: 1px;}
               .dsh2 .dsh-panel .head span{float: right; color: #f35958;}
               .dsh2 .dsh-panel .countbox{margin-top: 20px; padding: 10px 20px; color: #fff; border-radius: 5px; }
                  .dsh2 .dsh-panel .countbox.black{color: #454545; background-color: #e6e6e6;}
            .dsh2 .dsh-panel .table tr td{
               border-bottom: 1px solid rgba(230,230,230,.7);
               padding: 10px 0px ;
            }
</style>
<div class="bodyfix dsh2">
   <div id="wrap-filter" class="transition">
      <form id="frmfilter">
         <div id="frm">
            <div class="form-group">
               <label>Tanggal Awal</label> <br />
               <input type="text" class="form-control date" name="tgl_awal" id="tgl_awal"
               <?=date_set()?> value="<?=date("d-m-Y")?>" style="width:100px;display: inline-block;" > s/d
               <input type="text" class="form-control date" name="tgl_akhir" id="tgl_akhir"
               <?=date_set()?> value="<?=date("d-m-Y")?>" style="width:100px;display: inline-block;" >
            </div>
         </div>
         <div id="filter">
            <button type="submit" name="cmdfilter" id="cmdfilter" class="btn btn-primary btn-block">Filter</button>
         </div>
      </form>
   </div>
	<div class="dsh-header">
			<table class="osxtable">
				<tr>
					<td width="15%">
						&nbsp;
						<h4 class="icon" id="title-icon"><i class="ion-android-menu"></i></h4>
						&nbsp;&nbsp;
						<h4 id="title">Dashboard</h4>
					</td>
					<td width="84%" style="padding-left: 18em;">&nbsp;</td>
					<td width="1%">
						<h4 class="close" title="Tutup" onclick="bos.d.close()">x</h4>
					</td>
				</tr>
			</table>
		</div>
   <div style="height: calc(100% - 50px) ;padding: 10px 15px !important; overflow-y:auto;" id="mybody">
		<div class="row">
			<div class="col-sm-4">
				<div class="panel dsh-panel">
					<div class="panel-body">
                  <h4 class="head">PENJUALAN</h4>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="countbox" style="background-color: #45C6FF">
                           <h6 class="fw-300">TOTAL PENJUALAN</h6>
                           <h5 id="text_jual">0</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="countbox" style="background-color: #AD9AFF">
                           <h6 class="fw-300">TR. PENJUALAN</h6>
                           <h5 id="text_jualn">0</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="countbox" style="background-color: #FF4545">
                           <h6 class="fw-300">LABA KOTOR</h6>
                           <h5 id="text_lk">0</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="countbox" style="background-color: #FFAA45">
                           <h6 class="fw-300">MARGIN LK</h6>
                           <h5 id="text_lk_margin">0</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="countbox black">
                           <h6 class="fw-300">TOTAL PEMBELIAN</h6>
                           <h5 id="text_beli">0</h5>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="countbox black">
                           <h6 class="fw-300">TR. PEMBELIAN</h6>
                           <h5 id="text_belin">0</h5>
                        </div>
                     </div>
                  </div>
               </div>
				</div>
			</div>
         <div class="col-sm-8">
				<div class="panel dsh-panel" style="padding-top:0px;">
               <center>
					   <div class="panel-body" id="c_jual" style="width:85%"></div>
               </center>
				</div>
			</div>
         <div class="col-sm-12">
            <div class="panel dsh-panel">
					<div class="panel-body">
                  <h4 class="head">BARANG TERLARIS</h4>
                  <div class="row" id="text_bt"></div>
               </div>
            </div>
         </div>
      </div>
   <div>
</div>

<script type="text/javascript" src="<?=base_url('bismillah/chart/Chart-2.4.0.min.js')?>"></script>
<script type="text/javascript">
   <?=cekbosjs();?>
   bos.d.initcomp	= function(){
      bjs.initdate("#" + this.id + " .date") ;
   }

   bos.d.filter  = bos.d.obj.find("#wrap-filter") ;
   bos.d.initcallback	= function(){
      this.obj.find("#title-icon").on("click", function(){
         if(bos.d.filter.hasClass('active')){
            bos.d.filter.removeClass('active');
         }else{
            bos.d.filter.addClass('active');
         }
      }) ;
   }
   bos.d.frmfilter      = bos.d.obj.find("#frmfilter") ;
   bos.d.initfunc 		= function(){
      bjs.ajax(this.url + "/loadd", bjs.getdataform(this.frmfilter) ) ;
   }

   bos.d.loading      	= '<div class="loading-text">Loading...</div>' ;
   bos.d.loadc          = function(){
      bos.d.obj.find("#c_jual").html(bos.d.txt_loading) ;
      bjs.ajax(this.url + "/loadc", bjs.getdataform(this.frmfilter) ) ;
   }

   bos.d.setc  = function(jdata) {
      bos.d.obj.find("#c_jual").html('<canvas id="vs_c_jual" width="100%"></canvas>') ;
      bos.d.cc_jual = bos.d.obj.find("#vs_c_jual")[0].getContext("2d") ;

      bos.d.c_jual  = new Chart( bos.d.cc_jual, {
         type : "line",
         data : jdata,
         options :{
            title : {
               display: true,
               text: "Penjualan Barang"
            },
            legend: {
               display: false
            }
         }
      });
      this.obj.find("#text_bt").html("") ;
      bjs.ajax(this.url + "/loadt", bjs.getdataform(this.frmfilter) ) ;
   }

   $(function(){
      bos.d.initcomp() ;
      bos.d.initcallback() ;
      bos.d.initfunc() ;
   }) ;
</script>
