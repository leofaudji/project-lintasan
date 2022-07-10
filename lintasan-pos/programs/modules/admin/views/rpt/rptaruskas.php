<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="taruskas">
                        <button class="btn btn-tab tpel active" href="#taruskas_1" data-toggle="tab" >Laporan Arus Kas</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptaruskas.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="taruskas_1" style="padding-top:5px;">
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
                                            <button type="button" class="btn btn-primary pull-right" id="cmdview">Preview</button> 
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
            </div>
        </div>
        <div class="footer fix hidden" style="height:32px">
            <button class="btn btn-primary pull-right" id="cmdsave">Simpan</button>
        </div>

    </form>
</div>
<script type="text/javascript">
    <?=cekbosjs();?>

    bos.rptaruskas.grid1_data 	 = null ;
    bos.rptaruskas.grid1_loaddata= function(){
        this.grid1_data 		= {
            "tglawal"	   : this.obj.find("#tglawal").val(),
            "tglakhir"	   : this.obj.find("#tglakhir").val()
        } ;
    }

    bos.rptaruskas.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.rptaruskas.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: [
                { field: 'kode', caption: 'Rek', size: '100px', sortable: false},
                { field: 'keterangan', caption: 'Keterangan', size: '350px', sortable: false},
                { field: '1', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false},
                { field: '2', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false},
                { field: '3', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false},
                { field: '4', caption: '', size: '120px',render:'float:2',style:'text-align:right', sortable: false}
            ]
        });
    }

    bos.rptaruskas.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.rptaruskas.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.rptaruskas.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptaruskas.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptaruskas.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.rptaruskas.settab 		= function(n){
        this.obj.find("#taruskas button:eq("+n+")").tab("show") ;
    }
    bos.rptaruskas.obj.find("#cmdview").on("click", function(){
        bos.rptaruskas.initreport();
	}) ;
    bos.rptaruskas.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    
    bos.rptaruskas.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }

    bos.rptaruskas.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.rptaruskas.grid1_render() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
        }
    }


    bos.rptaruskas.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag


    }

    bos.rptaruskas.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.rptaruskas.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.rptaruskas.grid1_destroy() ;
        }) ;
    }

    bos.rptaruskas.objs = bos.rptaruskas.obj.find("#cmdsave") ;
    bos.rptaruskas.initfunc	   = function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;


        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.rptaruskas.grid1_reloaddata();
        });
    }

    $(".selectrekakt").select2({
        ajax: {
            url: bos.rptaruskas.base_url + '/seekrekening',
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
        bos.rptaruskas.initcomp() ;
        bos.rptaruskas.initcallback() ;
        bos.rptaruskas.initfunc() ;
    });
</script>