<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tark">
                        <button class="btn btn-tab tpel active" href="#tark_1" data-toggle="tab" >Laporan Analisa Ratio Keuangan</button>
                        <button class="btn btn-tab tpel" href="#tark_2" data-toggle="tab">Setup</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.rptanalisaratiokeu.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tark_1" style="padding-top:5px;">
                    <table width="100%">
                        <tr>
                            <td height="25px" width="100%">
                                <table class="osxtable form">
                                    <tr>
                                        <td width="85px">
                                            <input style="width:80px" type="text" class="form-control date" id="periode" name="periode" required value=<?=date("Y")?> <?=date_periodset(false)?>></td>

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
                <div role="tabpanel" class="tab-pane fade full-height" id="tark_2">
                    <table width = "100%" class="osxtable form">
                        <tr>
                            <td>Rek. Penjualan</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkpjawal" id="rekarkpjawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Penjualan Awal">
                                    <option value="<?= $rekarkpjawal ?>" selected='selected'><?= $rekarkpjawal ?> - <?= $ketrekarkpjawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkpjakhir" id="rekarkpjakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Penjualan Akhir">
                                    <option value="<?= $rekarkpjakhir ?>" selected='selected'><?= $rekarkpjakhir ?> - <?= $ketrekarkpjakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Kas & Bank</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkkbawal" id="rekarkkbawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Kas & Bank Awal">
                                    <option value="<?= $rekarkkbawal ?>" selected='selected'><?= $rekarkkbawal ?> - <?= $ketrekarkkbawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkkbakhir" id="rekarkkbakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Kas & Bank Akhir">
                                    <option value="<?= $rekarkkbakhir ?>" selected='selected'><?= $rekarkkbakhir ?> - <?= $ketrekarkkbakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Piutang</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkpiutangawal" id="rekarkpiutangawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Piutang Awal">
                                    <option value="<?= $rekarkpiutangawal ?>" selected='selected'><?= $rekarkpiutangawal ?> - <?= $ketrekarkpiutangawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkpiutangakhir" id="rekarkpiutangakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Piutang Akhir">
                                    <option value="<?= $rekarkpiutangakhir ?>" selected='selected'><?= $rekarkpiutangakhir ?> - <?= $ketrekarkpiutangakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Persediaan</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkpsdawal" id="rekarkpsdawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Persediaan Awal">
                                    <option value="<?= $rekarkpsdawal ?>" selected='selected'><?= $rekarkpsdawal ?> - <?= $ketrekarkpsdawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkpsdakhir" id="rekarkpsdakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Persediaan Akhir">
                                    <option value="<?= $rekarkpsdakhir ?>" selected='selected'><?= $rekarkpsdakhir ?> - <?= $ketrekarkpsdakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Porskot</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkpsktawal" id="rekarkpsktawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Porsekot Awal">
                                    <option value="<?= $rekarkpsktawal ?>" selected='selected'><?= $rekarkpsktawal ?> - <?= $ketrekarkpsktawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkpsktakhir" id="rekarkpsktakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Porsekot Akhir">
                                    <option value="<?= $rekarkpsktakhir ?>" selected='selected'><?= $rekarkpsktakhir ?> - <?= $ketrekarkpsktakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Aktiva Tetap</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkatawal" id="rekarkatawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Aktiva Tetap Awal">
                                    <option value="<?= $rekarkatawal ?>" selected='selected'><?= $rekarkatawal ?> - <?= $ketrekarkatawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkatakhir" id="rekarkatakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Aktiva Tetap Akhir">
                                    <option value="<?= $rekarkatakhir ?>" selected='selected'><?= $rekarkatakhir ?> - <?= $ketrekarkatakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Aktiva Tidak Berwujud</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkatwawal" id="rekarkatwawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Aktiva Tdk Berwujud Awal">
                                    <option value="<?= $rekarkatwawal ?>" selected='selected'><?= $rekarkatwawal ?> - <?= $ketrekarkatwawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkatwakhir" id="rekarkatwakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Aktiva Tdk Berwujud Akhir">
                                    <option value="<?= $rekarkatwakhir ?>" selected='selected'><?= $rekarkatwakhir ?> - <?= $ketrekarkatwakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Aktiva Lain-Lain</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkallawal" id="rekarkallawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Aktiva Lain-Lain Awal">
                                    <option value="<?= $rekarkallawal ?>" selected='selected'><?= $rekarkallawal ?> - <?= $ketrekarkallawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkallakhir" id="rekarkallakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Aktiva Lain-Lain Akhir">
                                    <option value="<?= $rekarkallakhir ?>" selected='selected'><?= $rekarkallakhir ?> - <?= $ketrekarkallakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Hut. Dagang</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkhdawal" id="rekarkhdawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Hutang Dagang Awal">
                                    <option value="<?= $rekarkhdawal ?>" selected='selected'><?= $rekarkhdawal ?> - <?= $ketrekarkhdawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkhdakhir" id="rekarkhdakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Hutang Dagang Akhir">
                                    <option value="<?= $rekarkhdakhir ?>" selected='selected'><?= $rekarkhdakhir ?> - <?= $ketrekarkhdakhir ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Hut. Bank / Jk. Panjang</td>
                            <td>:</td>
                            <td>
                                <select name="rekarkhbawal" id="rekarkhbawal" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Hutang Bank / Jk Panjang Awal">
                                    <option value="<?= $rekarkhbawal ?>" selected='selected'><?= $rekarkhbawal ?> - <?= $ketrekarkhbawal ?></option>
                                </select>
                            </td>
                            <td align="center">sd</td>
                            <td>
                                <select name="rekarkhbakhir" id="rekarkhbakhir" class="form-control select selectrekakt" style="width:100%"
                                        data-placeholder="Rek. Hutang Bank / Jk Panjang Akhir">
                                    <option value="<?= $rekarkhbakhir ?>" selected='selected'><?= $rekarkhbakhir ?> - <?= $ketrekarkhbakhir ?></option>
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

    bos.rptanalisaratiokeu.grid1_data 	 = null ;
    bos.rptanalisaratiokeu.grid1_loaddata= function(){
        this.grid1_data 		= {
            "periode"	   : this.obj.find("#periode").val()
        } ;
    }

    bos.rptanalisaratiokeu.grid1_load    = function(){
        var thn = this.obj.find("#periode").val();
        var kolom = [];
        kolom.push({ field: 'no', caption: 'NO', size: '50px', sortable: false,render:'int',style:'text-align:right'});
        kolom.push({ field: 'keterangan', caption: 'Keterangan', size: '350px', sortable: false});
        
        for(t=thn-4;t<=thn;t++){
            kolom.push({ field: t,caption:t,  size: '100px', render:'int',sortable: false});
        }

        //JSON.stringify(kolom);

        this.obj.find("#grid1").w2grid({
            name		: this.id + '_grid1',
            limit 	: 100 ,
            url 		: bos.rptanalisaratiokeu.base_url + "/loadgrid",
            postData : this.grid1_data ,
            show 		: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false, 
            columns: kolom
        });
    }

    bos.rptanalisaratiokeu.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.rptanalisaratiokeu.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.rptanalisaratiokeu.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.rptanalisaratiokeu.grid1_removeallcolumn 	= function(){
        for(i = 0 ; i<w2ui[this.id + '_grid1'].columns.length ; i++){
           // alert(w2ui[this.id + '_grid1'].columns.length);
            if(w2ui[this.id + '_grid1'].columns[i].field != undefined){
                 w2ui[this.id + '_grid1'].removeColumn(w2ui[this.id + '_grid1'].columns[i].field);
            }
        }
    }
    bos.rptanalisaratiokeu.grid1_initcolumn 	= function(){
        //bos.rptanalisaratiokeu.grid1_removeallcolumn();
        //w2ui[this.id + '_grid1'].addColumn([{ field: 'keterangan1', caption: 'Keterangan1', size: '50px', sortable: false}]) ;
        w2ui[this.id + '_grid1'].destroy() ;
        this.grid1_loaddata() ;
        this.grid1_load() ;
    }

    bos.rptanalisaratiokeu.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.rptanalisaratiokeu.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    bos.rptanalisaratiokeu.settab 		= function(n){
        this.obj.find("#tark button:eq("+n+")").tab("show") ;
    }

    bos.rptanalisaratiokeu.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.rptanalisaratiokeu.grid1_render() ;
        }else{
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
        }
    }

    bos.rptanalisaratiokeu.obj.find("#cmdview").on("click", function(){
        bos.rptanalisaratiokeu.initreport();
    }) ;

    bos.rptanalisaratiokeu.initreport  = function(s,e){
        bjs.ajax(this.base_url+ '/initreport', bjs.getdataform(this.obj.find("form"))) ;
    }
    bos.rptanalisaratiokeu.openreport  = function(){
        bjs_os.form_report( this.base_url + '/showreport' ) ;
    }


    bos.rptanalisaratiokeu.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag


    }

    bos.rptanalisaratiokeu.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.rptanalisaratiokeu.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.rptanalisaratiokeu.grid1_destroy() ;
        }) ;
    }

    bos.rptanalisaratiokeu.objs = bos.rptanalisaratiokeu.obj.find("#cmdsave") ;
    bos.rptanalisaratiokeu.initfunc	   = function(){
        this.grid1_loaddata() ;
        this.grid1_load() ;
        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                bjs.ajax( bos.rptanalisaratiokeu.base_url + '/saving', bjs.getdataform(this) , bos.rptanalisaratiokeu.cmdsave) ;
            }
            // });

        }) ;


        this.obj.find("#cmdrefresh").on("click", function(e){
            //bos.rptanalisaratiokeu.grid1_reloaddata();
            bos.rptanalisaratiokeu.grid1_initcolumn();
        });
    }

    $(".selectrekakt").select2({
        ajax: {
            url: bos.rptanalisaratiokeu.base_url + '/seekrekening',
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
        bos.rptanalisaratiokeu.initcomp() ;
        bos.rptanalisaratiokeu.initcallback() ;
        bos.rptanalisaratiokeu.initfunc() ;
    });
</script>
