<div class="header active">
    <table class="header-table">
        <tr>
            <td class="icon" ><i class="fa fa-building"></i></td>
            <td class="title">
                <div class="nav ">
                    <div class="btn-group" id="tjll">
                        <button class="btn btn-tab tpel active" href="#tjll_1" data-toggle="tab" >Daftar Jurnal</button>
                        <button class="btn btn-tab tpel" href="#tjll_2" data-toggle="tab">Jurnal</button>
                    </div>
                </div>
            </td>
            <td class="button">
                <table class="header-button" align="right">
                    <tr> 
                        <td>
                            <div class="btn-circle btn-close transition" onclick="bos.trjurnallainlain.close()">
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
                <div role="tabpanel" class="tab-pane active full-height" id="tjll_1" style="padding-top:5px;">
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
                <div role="tabpanel" class="tab-pane fade full-height" id="tjll_2">
                    <table width="100%">
                        <tr>
                            <td width="100%" class="osxtable form">
                                <table>
                                    <tr>
                                        <td width="14%"><label for="faktur">Faktur</label> </td>
                                        <td width="1%">:</td>
                                        <td width="35%">
                                            <input type="text" id="faktur" name="faktur" class="form-control" placeholder="Faktur" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="tgl">Tanggal</label> </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <input style="width:80px" type="text" class="form-control date" id="tgl" name="tgl" required value=<?=date("d-m-Y")?> <?=date_set()?>>
                                        </td>
                                        <td width="14%"><label for=""></label> </td>
                                        <td width="1%"></td>
                                        <td >

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="nomor">No</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input type="text" id="nomor" name="nomor" class="form-control" placeholder="Nomor" required>
                                        </td>
                                    </tr>
									<tr>
                                        <td width="14%"><label for="rekkas">Rekening</label> </td>
                                        <td width="1%">:</td>
                                        <td> 
                                            <select name="rekening" id="rekening" class="form-control select rekselect" style="width:100%"
                                                    data-placeholder="Rekening"></select>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="14%"><label for="keterangan">Keterangan</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="keterangan" >
                                        </td>
                                    </tr>
									<tr>
                                        <td width="14%"><label for="debet">Debet</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input type="text" name="debet" id="debet" 
                                                   class="form-control number" value="0"> 
                                        </td>
                                    </tr>
									<tr>
                                        <td width="14%"><label for="kredit">Kredit</label> </td>
                                        <td width="1%">:</td>
                                        <td>
                                            <input type="text" name="kredit" id="kredit" 
                                                   class="form-control number" value="0"> 
											
										</td>
                                    </tr>
									<tr>
                                        <td width="14%"><label for=""></label> </td>
                                        <td width="1%"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary pull-right" id="cmdok">OK</button>
										</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height = "230px" >
                                <div id="grid2" class="full-height"></div>
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
    //grid daftar po
    bos.trjurnallainlain.grid1_data    = null ;
    bos.trjurnallainlain.grid1_loaddata= function(){

        var tglawal = bos.trjurnallainlain.obj.find("#tglawal").val();
        var tglakhir = bos.trjurnallainlain.obj.find("#tglakhir").val();
        this.grid1_data 		= {'tglawal':tglawal,'tglakhir':tglakhir} ;
    }

    bos.trjurnallainlain.grid1_load    = function(){
        this.obj.find("#grid1").w2grid({
            name	: this.id + '_grid1',
            limit 	: 100 ,
            url 	: bos.trjurnallainlain.base_url + "/loadgrid",
            postData: this.grid1_data ,
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            multiSearch		: false,
            columns: [
                { field: 'faktur', caption: 'Faktur', size: '120px', sortable: false, style:"text-align:center"},
                { field: 'tgl', caption: 'Tgl', size: '100px', sortable: false , style:"text-align:center"},
                { field: 'rekening', caption: 'Rekening', size: '150px', sortable: false , style:"text-align:left"},
				{ field: 'ketrekening', caption: 'Ket. Rekening', size: '150px', sortable: false , style:"text-align:left"},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false , style:"text-align:left"},
                { field: 'debet', caption: 'Debet', size: '100px', sortable: false , render:'float:2'},
                { field: 'kredit', caption: 'Kredit', size: '100px', sortable: false , render:'float:2'},
                { field: 'cmdedit', caption: ' ', size: '80px', sortable: false },
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ]
        });
    }

    bos.trjurnallainlain.grid1_setdata	= function(){
        w2ui[this.id + '_grid1'].postData 	= this.grid1_data ;
    }
    bos.trjurnallainlain.grid1_reload		= function(){
        w2ui[this.id + '_grid1'].reload() ;
    }
    bos.trjurnallainlain.grid1_destroy 	= function(){
        if(w2ui[this.id + '_grid1'] !== undefined){
            w2ui[this.id + '_grid1'].destroy() ;
        }
    }

    bos.trjurnallainlain.grid1_render 	= function(){
        this.obj.find("#grid1").w2render(this.id + '_grid1') ;
    }

    bos.trjurnallainlain.grid1_reloaddata	= function(){
        this.grid1_loaddata() ;
        this.grid1_setdata() ;
        this.grid1_reload() ;
    }

    //grid detail
    bos.trjurnallainlain.grid2_load    = function(){
        this.obj.find("#grid2").w2grid({
            name	: this.id + '_grid2',
            show: {
                footer 		: true,
                toolbar		: false,
                toolbarColumns  : false
            },
            columns: [
                { field: 'no', caption: 'No', size: '50px', sortable: false},
                { field: 'rekening', caption: 'Rekening', size: '150px', sortable: false , style:"text-align:left"},
				{ field: 'ketrekening', caption: 'Ket. Rekening', size: '150px', sortable: false , style:"text-align:left"},
                { field: 'keterangan', caption: 'Keterangan', size: '200px', sortable: false , style:"text-align:left"},
                { field: 'debet', caption: 'Debet', size: '100px', sortable: false , render:'float:2'},
                { field: 'kredit', caption: 'Kredit', size: '100px', sortable: false , render:'float:2'},
                { field: 'cmddelete', caption: ' ', size: '80px', sortable: false }
            ],
			summary: [
				{recid:"ZZZZ",no:"",rekening:"",ketrekening:"",keterangan:"Total",debet:"",kredit:"",cmdedit:"",cmd:""}
			]
        });


    }

    bos.trjurnallainlain.grid2_destroy 	= function(){
        if(w2ui[this.id + '_grid2'] !== undefined){
            w2ui[this.id + '_grid2'].destroy() ;
        }
    }

    bos.trjurnallainlain.grid2_reload		= function(){
        w2ui[this.id + '_grid2'].reload() ;
    }

    bos.trjurnallainlain.grid2_append    = function(no,rekening,ketrekening,keterangan,debet,kredit){
        var datagrid  = w2ui[this.id + '_grid2'].records;
        var lnew      = true;
        var nQty      = 1;
        var recid     = "";
        if(no <= datagrid.length){
            recid = no;
            w2ui[this.id + '_grid2'].set(recid,{rekening: rekening,ketrekening:ketrekening,keterangan: keterangan,  debet: debet,kredit:kredit});
        }else{
            recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trjurnallainlain.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add([
                { recid:recid,
                 no: no,
                 rekening: rekening,
                 ketrekening: ketrekening,
                 keterangan: keterangan,
                 debet:debet,
				 kredit:kredit,
                 cmddelete:Hapus}
            ]) ;
        }
        bos.trjurnallainlain.initdetail();
        bos.trjurnallainlain.hitungjumlah();
    }

    bos.trjurnallainlain.grid2_deleterow = function(recid){
        if(confirm("Item di hapus dari detail ???"+recid)){
            w2ui[this.id + '_grid2'].select(recid);
            w2ui[this.id + '_grid2'].delete(true);
            bos.trjurnallainlain.grid2_urutkan();
        }
    }

    bos.trjurnallainlain.grid2_urutkan = function(){
        var datagrid = w2ui[this.id + '_grid2'].records;
        w2ui[this.id + '_grid2'].clear();
        for(i=0;i<datagrid.length;i++){
            var no = i+1;
            datagrid[i]["recid"] = no;
            var recid = no;
            var Hapus = "<button type='button' onclick = 'bos.trjurnallainlain.grid2_deleterow("+recid+")' class='btn btn-danger btn-grid'>Delete</button>";
            w2ui[this.id + '_grid2'].add({recid:recid,no: no, rekening: datagrid[i]["rekening"], ketrekening: datagrid[i]["ketrekening"],
                                          keterangan: datagrid[i]["keterangan"], debet:datagrid[i]["debet"],kredit:datagrid[i]["kredit"],cmddelete:Hapus});
        }
    }

    bos.trjurnallainlain.cmdedit 		= function(faktur){
        bjs.ajax(this.url + '/editing', 'faktur=' + faktur);
    }

    bos.trjurnallainlain.cmddelete 	= function(faktur){
        if(confirm("Delete Data?")){
            bjs.ajax(this.url + '/deleting', 'faktur=' + faktur);
        }
    }

    bos.trjurnallainlain.cmdcetak	= function(faktur,jenis,rekening){
        /*if(jenis == "KM"){
            bjs.ajax(this.url + '/printbuktikm', 'faktur='+faktur+'&rekening='+rekening);
        }else if(jenis == "KK"){
            bjs.ajax(this.url + '/printbuktikk', 'faktur='+faktur+'&rekening='+rekening);
        }*/
    }
    
    bos.trjurnallainlain.printbukti = function (contenthtml) {
        var mywindow = window.open('', 'Print', 'height=600,width=800');

        mywindow.document.write(contenthtml);

        mywindow.document.close();
        mywindow.focus()
        mywindow.print();
        mywindow.close();
    }

    bos.trjurnallainlain.hitungjumlah 			= function(){

        var nRows = w2ui[this.id + '_grid2'].records.length;
        var totdebet = 0 ;
		var totkredit = 0 ;
        for(i=0;i< nRows;i++){
             totdebet += w2ui[this.id + '_grid2'].getCellValue(i,4);
			 totkredit += w2ui[this.id + '_grid2'].getCellValue(i,5);
            
        }
        
		w2ui[this.id + '_grid2'].set("ZZZZ",{debet:totdebet,kredit:totkredit});
    }


    bos.trjurnallainlain.setopt = function(nama,isi){
        this.obj.find('input:radio[name='+nama+'][value='+isi+']').prop('checked',true);
    }

    bos.trjurnallainlain.init 			= function(){

        this.obj.find("#rekening").sval("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#kredit").val("0.00") ;
		this.obj.find("#debet").val("0.00") ;



        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
        w2ui[this.id + '_grid2'].clear();

        bos.trjurnallainlain.initdetail();
    }

    bos.trjurnallainlain.settab 		= function(n){
        this.obj.find("#tjll button:eq("+n+")").tab("show") ;
    }

    bos.trjurnallainlain.tabsaction	= function(n){
        if(n == 0){
            this.obj.find(".bodyfix").css("height","100%") ;
            this.obj.find(".footer").addClass("hidden") ;
            bos.trjurnallainlain.grid1_render() ;
            bos.trjurnallainlain.init() ;
        }else{
            bos.trjurnallainlain.grid2_reload() ;
            this.obj.find(".bodyfix").css("height","calc(100% - 32px)") ;
            this.obj.find(".footer").removeClass("hidden") ;
            this.obj.find("#faktur").focus() ;
        }
    }
    bos.trjurnallainlain.initdetail 			= function(){
        var datagrid = w2ui[this.id + '_grid2'].records;

        this.obj.find("#nomor").val(datagrid.length+1) ;
        this.obj.find("#rekening").sval("") ;
        this.obj.find("#keterangan").val("") ;
        this.obj.find("#debet").val("0") ;
		this.obj.find("#kredit").val("0") ;



    }

    bos.trjurnallainlain.initcomp		= function(){
        bjs.initdate("#" + this.id + " .date") ;
        bjs_os.inittab(this.obj, '.tpel') ;
        bjs_os._header(this.id) ; //drag header
        this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag

        this.grid1_loaddata() ;
        this.grid1_load() ;

        this.grid2_load() ;
        bjs.ajax(this.url + '/init') ;
        bjs.ajax(this.url + '/getfaktur') ;
    }

    bos.trjurnallainlain.initcallback	= function(){
        this.obj.on("bos:tab", function(e){
            bos.trjurnallainlain.tabsaction( e.i )  ;
        });
        this.obj.on('remove', function(){
            bos.trjurnallainlain.grid1_destroy() ;
            bos.trjurnallainlain.grid2_destroy() ;
        }) ;
    }

    bos.trjurnallainlain.objs = bos.trjurnallainlain.obj.find("#cmdsave") ;
    bos.trjurnallainlain.initfunc	   = function(){
        this.obj.find("#cmdok").on("click", function(e){

            var no          = bos.trjurnallainlain.obj.find("#nomor").val();
            var rekening       = bos.trjurnallainlain.obj.find("#rekening").val();
            var ketrekening       = bos.trjurnallainlain.obj.find("#rekening").text();
            var keterangan  = bos.trjurnallainlain.obj.find("#keterangan").val();
            var debet         = bos.trjurnallainlain.obj.find("#debet").val();
			debet = string_2n(debet);
			var kredit         = bos.trjurnallainlain.obj.find("#kredit").val();
			kredit = string_2n(kredit);
            bos.trjurnallainlain.grid2_append(no,rekening,ketrekening,keterangan,debet,kredit);
        }) ;


        this.obj.find("#nomor").on("blur", function(e){
            var no = bos.trjurnallainlain.obj.find("#nomor").val();
            var datagrid = w2ui['bos-form-trjurnallainlain_grid2'].records;
            if(no <= datagrid.length){
                bos.trjurnallainlain.obj.find("#rekening").sval([{id:w2ui['bos-form-trjurnallainlain_grid2'].getCellValue(no-1,1),text:w2ui['bos-form-trjurnallainlain_grid2'].getCellValue(no-1,2)}]);
                bos.trjurnallainlain.obj.find("#keterangan").val(w2ui['bos-form-trjurnallainlain_grid2'].getCellValue(no-1,3));
                bos.trjurnallainlain.obj.find("#debet").val(w2ui['bos-form-trjurnallainlain_grid2'].getCellValue(no-1,4));
				bos.trjurnallainlain.obj.find("#kredit").val(w2ui['bos-form-trjurnallainlain_grid2'].getCellValue(no-1,5));
            }else{
                bos.trjurnallainlain.obj.find("#nomor").val(datagrid.length + 1)
            }

        });

        this.obj.find('form').on("submit", function(e){
            //this.obj.find("#cmdsave").on("click", function(e){
            e.preventDefault() ;
            if( bjs.isvalidform(this) ){
                var datagrid2 =  w2ui['bos-form-trjurnallainlain_grid2'].records;
                datagrid2 = JSON.stringify(datagrid2);
                bjs.ajax( bos.trjurnallainlain.base_url + '/saving', bjs.getdataform(this)+"&grid2="+datagrid2 , bos.trjurnallainlain.cmdsave) ;
            }

        }) ;

        this.obj.find("#cmdrefresh").on("click", function(e){
            bos.trjurnallainlain.grid1_reloaddata();
        });
    }

    $('.rekselect').select2({
        ajax: {
            url: bos.trjurnallainlain.base_url + '/seekrekening',
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
        bos.trjurnallainlain.initcomp() ;
        bos.trjurnallainlain.initcallback() ;
        bos.trjurnallainlain.initfunc() ;
        bos.trjurnallainlain.initdetail();
    });
</script>