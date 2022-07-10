<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="thpproduksi">
                        <button class="btn btn-tab tpel active" href="#thpproduksi_1" data-toggle="tab" >Laporan Harga Pokok Produksi</button>
                        <button class="btn btn-tab tpel" href="#thpproduksi_2" data-toggle="tab">Setup</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rpthpproduksi.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="thpproduksi_1" style="padding-top:5px;">
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
                <div role="tabpanel" class="tab-pane fade full-height" id="thpproduksi_2">
                    <table width = "100%" class="osxtable form">
                        <tr>
                            <td>BBB</td>
                            <td>:</td>
                            <td>
                                <select name="rekhppbbbawal" id="rekhppbbbawal" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BBB Awal">
                                    <option value="<?= $rekhppbbbawal ?>" selected='selected'><?= $rekhppbbbawal ?> - <?= $ketrekhppbbbawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekhppbbbakhir" id="rekhppbbbakhir" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BBB Akhir">
                                    <option value="<?= $rekhppbbbakhir ?>" selected='selected'><?= $rekhppbbbakhir ?> - <?= $ketrekhppbbbakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>BBP</td>
                            <td>:</td>
                            <td>
                                <select name="rekhppbbpawal" id="rekhppbbpawal" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BBP Awal">
                                    <option value="<?= $rekhppbbpawal ?>" selected='selected'><?= $rekhppbbpawal ?> - <?= $ketrekhppbbpawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekhppbbpakhir" id="rekhppbbpakhir" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BBP Akhir">
                                    <option value="<?= $rekhppbbpakhir ?>" selected='selected'><?= $rekhppbbpakhir ?> - <?= $ketrekhppbbpakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>BTKL</td>
                            <td>:</td>
                            <td>
                                <select name="rekhppbtklawal" id="rekhppbtklawal" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BTKL Awal">
                                    <option value="<?= $rekhppbtklawal ?>" selected='selected'><?= $rekhppbtklawal ?> - <?= $ketrekhppbtklawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekhppbtklakhir" id="rekhppbtklakhir" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BBTKL Akhir">
                                    <option value="<?= $rekhppbtklakhir ?>" selected='selected'><?= $rekhppbtklakhir ?> - <?= $ketrekhppbtklakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>BOP</td>
                            <td>:</td>
                            <td>
                                <select name="rekhppbopawal" id="rekhppbopawal" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BOP Awal">
                                    <option value="<?= $rekhppbopawal ?>" selected='selected'><?= $rekhppbopawal ?> - <?= $ketrekhppbopawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekhppbopakhir" id="rekhppbopakhir" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BOP Akhir">
                                    <option value="<?= $rekhppbopakhir ?>" selected='selected'><?= $rekhppbopakhir ?> - <?= $ketrekhppbopakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>BDP</td>
                            <td>:</td>
                            <td>
                                <select name="rekhppbdpawal" id="rekhppbdpawal" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BDP Awal">
                                    <option value="<?= $rekhppbdpawal ?>" selected='selected'><?= $rekhppbdpawal ?> - <?= $ketrekhppbdpawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekhppbdpakhir" id="rekhppbdpakhir" class="form-control select" style="width:100%"
                                        data-placeholder="Rek. BDP Akhir">
                                    <option value="<?= $rekhppbdpakhir ?>" selected='selected'><?= $rekhppbdpakhir ?> - <?= $ketrekhppbdpakhir ?></option>
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

    bos.rpthpproduksi.grid1_data 	 = null ;
    bos.rpthpproduksi.grid1_loaddata= function(){
        this.grid1_data 		= {
            "tglawal"	   : this.obj.find("#tglawal").val(),
            "tglakhir"	   : this.obj.find("#tglakhir").val()
        } ;
    }

    bos.rpthpproduksi.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.rpthpproduksi.base_url + "/loadgrid",
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

    bos.rpthpproduksi.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.rpthpproduksi.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.rpthpproduksi.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rpthpproduksi.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rpthpproduksi.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.rpthpproduksi.settab 		= function(n){
        this.obj.find("#thpproduksi button:eq("+n+")").tab("show") ;
    }
    bos.rpthpproduksi.obj.find("#cmdview").on("click", function(){
        bos.rpthpproduksi.initreport();
	}) ;
    bos.rpthpproduksi.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    
    bos.rpthpproduksi.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rpthpproduksi.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.rpthpproduksi.grid1_render() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
        }
    }


    bos.rpthpproduksi.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag


    }

    bos.rpthpproduksi.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.rpthpproduksi.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.rpthpproduksi.grid1_destroy() ;
        }) ;
    }

    bos.rpthpproduksi.objs = bos.rpthpproduksi.obj.find("#cmdsave") ;
    bos.rpthpproduksi.initfunc	   = function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
                e.preventDefault() ;
                if( bjs.isvalidform(this) ){
                    bjs.ajax( bos.rpthpproduksi.base_url + '/saving', bjs.getdataform(this) , bos.rpthpproduksi.cmdsave) ;
                }
           // });

        }) ;


        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.rpthpproduksi.grid1_reloaddata();
        });
    }

    $('#rekhppbbbawal').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbbbakhir').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbbpawal').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbbpakhir').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbtklawal').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbtklakhir').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbopawal').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbopakhir').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbdpawal').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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

    $('#rekhppbdpakhir').select2({
        ajax: {
            url: bos.rpthpproduksi.base_url + '/seekrekening',
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
        bos.rpthpproduksi.initcomp() ;
        bos.rpthpproduksi.initcallback() ;
        bos.rpthpproduksi.initfunc() ;
    });
</script>