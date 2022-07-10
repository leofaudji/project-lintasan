<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="thppj">
                        <button class="btn btn-tab tpel active" href="#thppj_1" data-toggle="tab" >Laporan Harga Pokok Penjualan</button>
                        <button class="btn btn-tab tpel" href="#thppj_2" data-toggle="tab">Setup</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rpthppenjualan.close()">
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
    <form novalidate>
        <div class="bodyfix scrollme" style="height:100%">
            <div class="tab-content full-height">
                <div role="tabpanel" class="tab-pane active full-height" id="thppj_1" style="padding-top:5px;">
                    <table width="100%">
                        <tr>
                            <td height="25px" width="100%">
                                <table class="osxtable form">
                                    <tr>
                                        <td width="85px">
                                            <input style="width:80px" type="text" class="form-control date" id="tglawal" name="tglawal" value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>
                                        <td width="5px">sd</td>
                                        <td width="85px">
                                            <input style="width:80px" type="text" class="form-control date" id="tglakhir" name="tglakhir" value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>

                                        <td width="85px">
                                            <button type="button" class="btn btn-primary pull-right" id="cmdrefresh">Refresh</button>
                                        </td>
                                        <td width="85px">
                                            <button class="btn btn-primary pull-right" id="cmdview">Preview</button> 
                                        </td>
                                        <td></td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="400px">
                                <div id="grid1" class="full-height"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade full-height" id="thppj_2">
                    <table width = "100%" class="osxtable form">
                        <tr>
                            <td>Persd. Brg Jadi</td>
                            <td>:</td>
                            <td>
                                <select name="rekhppbjawal" id="rekhppbjawal" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. Persd. Barang Jadi Awal">
                                    <option value="<?= $rekhppbjawal ?>" selected='selected'><?= $rekhppbjawal ?> - <?= $ketrekhppbjawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekhppbjakhir" id="rekhppbjakhir" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. Persd. Barang Jadi Akhir">
                                    <option value="<?= $rekhppbjakhir ?>" selected='selected'><?= $rekhppbjakhir ?> - <?= $ketrekhppbjakhir ?></option>
                                </select>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
        <div class="footer fix hidden" style="height:32px">
            <button class="btn btn-primary pull-right" id="cmdsave">Simpan</button>
        </div>

    </form>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>

    bos.rpthppenjualan.grid1_data 	 = null ;
    bos.rpthppenjualan.grid1_loaddata= function(){
        this.grid1_data 		= {
            "tglawal"	   : this.obj.find("#tglawal").val(),
            "tglakhir"	   : this.obj.find("#tglakhir").val()
        } ;
    }

    bos.rpthppenjualan.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.rpthppenjualan.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'kode', caption: 'Rekening', size: '100px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '350px', sortable: false},
                { field: '1', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false},
                { field: '2', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false},
                { field: '3', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false}
            ]
        });
    }

    bos.rpthppenjualan.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.rpthppenjualan.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.rpthppenjualan.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rpthppenjualan.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rpthppenjualan.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.rpthppenjualan.settab 		= function(n){
        this.obj.find("#thppj button:eq("+n+")").tab("show") ;
    }

    bos.rpthppenjualan.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.rpthppenjualan.grid1_render() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
        }
    }
    
    bos.rpthppenjualan.obj.find("#cmdview").on("click", function(){
        bos.rpthppenjualan.initreport();
	}) ;
    
    bos.rpthppenjualan.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    bos.rpthppenjualan.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }


    bos.rpthppenjualan.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag


    }

    bos.rpthppenjualan.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.rpthppenjualan.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.rpthppenjualan.grid1_destroy() ;
        }) ;
    }

    bos.rpthppenjualan.objs = bos.rpthppenjualan.obj.find("#cmdsave") ;
    bos.rpthppenjualan.initfunc	   = function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
                e.preventDefault() ;
                if( bjs.isvalidform(this) ){
                    bjs.ajax( bos.rpthppenjualan.base_url + '/saving', bjs.getdataform(this) , bos.rpthppenjualan.cmdsave) ;
                }
           // });

        }) ;


        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.rpthppenjualan.grid1_reloaddata();
        });
    }
    
    $('#rekhppbjawal').select2({
        ajax: {
            url: bos.rpthppenjualan.base_url + '/seekrekening',
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

    $('#rekhppbjakhir').select2({
        ajax: {
            url: bos.rpthppenjualan.base_url + '/seekrekening',
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
        bos.rpthppenjualan.initcomp() ;
        bos.rpthppenjualan.initcallback() ;
        bos.rpthppenjualan.initfunc() ;
    });
</script>