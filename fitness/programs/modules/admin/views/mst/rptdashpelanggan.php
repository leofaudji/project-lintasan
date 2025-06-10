<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Welcome Member Page</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');

  * {
    box-sizing: border-box;
  }

  .bodya {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Nunito', sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }

  .container {
    background: rgba(255 255 255 / 0.1);
    padding: 40px 30px; 
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    max-width: 500px;
    width: 90%;
  }

  h1 {
    font-size: 4rem;
    margin-bottom: 8px;
    font-weight: 700;
    text-shadow: 1px 1px 5px rgba(0,0,0,0.25);
    animation: bounce 15s ease infinite;
  }

  p.subtitle {
    font-size: 1.7rem;
    margin-bottom: 24px;
    opacity: 0.85;
  }

  .member-photo {
    width: 250px;
    height: 250px;
    margin: 0 auto 20px auto;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.4);
    border: 4px solid rgba(255,255,255,0.4);
    animation: pulse 1s infinite ease-in-out alternate;
  }

  .member-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .member-info {
    font-size: 3rem;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 28px;
  }

  .member-info span {
    display: block;
    animation: gelatine 0.5s infinite;
  }

  .member-kunjungan {
    font-size: 1.4rem;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 28px;
  }

  .member-kunjungan span {
    display: block;
  }

  button.cta-button {
    background: #ffffff;
    color: #2575fc;
    border: none;
    border-radius: 30px;
    padding: 14px 32px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(255, 255, 255, 0.5);
    transition: background-color 0.3s ease, color 0.3s ease;
    width: 100%;
  }

  button.cta-button:hover {
    background: #1a53d8;
    color: #fff;
    box-shadow: 0 8px 30px rgba(26, 83, 216, 0.7);
  }

  @media (max-width: 400px) {
    h1 {
      font-size: 2rem; 
    }
    .member-photo {
      width: 110px;
      height: 110px;
      margin-bottom: 18px;
    }
    .member-info {
      font-size: 3rem;
      margin-bottom: 20px;
    }
    button.cta-button {
      font-size: 1rem;
      padding: 12px 24px;
    }
  }
</style>
</head>
<body>
  <div class="bodya">
    <div class="container" role="main" aria-label="Welcome Member card">
        <h3>Syanjaya Fitnes</h3>
        <img src="./uploads/logo-syanjaya.png" style="opacity:0.9" height="80px"></img>
        <h1>Selamat Datang!</h1>
        <p class="subtitle">We're excited to have you here. <br>Explore, connect, and grow with us!</p>

        <div class="member-photo" aria-label="Member photo">
          <div id="memberfoto"></div>
        </div>

        <div class="member-info" aria-label="Member information">
          <span id="membernama"></span>
          <span id="memberid"></span>
        </div>

      </div>
  </div>
  
</body>
</html>


<script type="text/javascript">
  <?=cekbosjs();?>

  bos.rptdashpelanggan.grid1_data    = null ;
  bos.rptdashpelanggan.grid1_loaddata= function(){
    this.grid1_data     = { 
      "pelanggan"   : this.obj.find("#pelanggan").val(),
      "tglawal"     : this.obj.find("#tglawal").val(),    
      "tglakhir"    : this.obj.find("#tglakhir").val()
    } ;
  }

  bos.rptdashpelanggan.grid1_load    = function(){
      this.obj.find("#grid1").w2grid({
      name    : this.id + '_grid1',
      limit   : 100 ,
      url     : bos.rptdashpelanggan.base_url + "/loadgrid",
      postData : this.grid1_data ,
      show     : {
        footer     : true,
        toolbar    : true,
        toolbarColumns  : false
      },
      multiSearch    : false,
      columns: [ 
        { field: 'no',style:'text-align:right', caption: 'No', size: '40px', sortable: false},
        { field: 'datetime',style:'text-align:right', caption: 'Datetime', size: '140px', sortable: false},
        { field: 'kode', caption: 'Kode', size: '60px', sortable: false},
        { field: 'nama', caption: 'Nama', size: '150px', sortable: false},
        { field: 'alamat', caption: 'Alamat', size: '150px', sortable: false},
        { field: 'statuspelanggan', caption: 'Status', size: '50px', sortable: false}
      ]
    });
   }

   bos.rptdashpelanggan.grid1_setdata  = function(){
    w2ui[this.id + '_grid1'].postData   = this.grid1_data ;
  }
  bos.rptdashpelanggan.grid1_reload    = function(){
    w2ui[this.id + '_grid1'].reload() ;
  }
  bos.rptdashpelanggan.grid1_destroy   = function(){
    if(w2ui[this.id + '_grid1'] !== undefined){
      w2ui[this.id + '_grid1'].destroy() ;
    }
  }

  bos.rptdashpelanggan.grid1_render   = function(){
    this.obj.find("#grid1").w2render(this.id + '_grid1') ;
  }

  bos.rptdashpelanggan.grid1_reloaddata  = function(){
    this.grid1_loaddata() ;
    this.grid1_setdata() ;
    this.grid1_reload() ;
  }

  bos.rptdashpelanggan.cmdedit    = function(id){
    bjs.ajax(this.url + '/editing', 'id=' + id);
  }

  bos.rptdashpelanggan.cmddelete    = function(id){
    if(confirm("Hapus Data?")){
      bjs.ajax(this.url + '/deleting', 'id=' + id);
    }
  }

  bos.rptdashpelanggan.init        = function(){
    bjs.ajax(this.url + "/init") ;
  }

  bos.rptdashpelanggan.initcomp  = function(){
    bjs.initselect({
      class : "#" + this.id + " .select"
    }) ;
    bjs.initdate("#" + this.id + " .date") ;
    bjs_os.inittab(this.obj, '.tpel') ;
    bjs_os._header(this.id) ; //drag header
    this.obj.find(".header").attr("id",this.id + "-title") ; //set to drag
  }

  bos.rptdashpelanggan.initcallback  = function(){
    this.obj.on("remove",function(){
      bos.rptdashpelanggan.grid1_destroy() ; 
    }) ;
    
  }
  
  bos.rptdashpelanggan.obj.find("#cmdrefresh").on("click", function(){
       bos.rptdashpelanggan.grid1_reloaddata() ; 
  }) ; 

  bos.rptdashpelanggan.obj.find("#cmdview").on("click", function(){
    bjs_os.form_report(bos.rptdashpelanggan.url+ '/showreport' ) ;
  }) ;
  
  bos.rptdashpelanggan.objs = bos.rptdashpelanggan.obj.find("#cmdsave") ;
  bos.rptdashpelanggan.initfunc     = function(){
    this.init() ;
    this.grid1_loaddata() ;
    this.grid1_load() ;

    this.obj.find("form").on("submit", function(e){
         e.preventDefault() ;
         if(bjs.isvalidform(this)){
            if(confirm("Apakah Anda yakin ?")){ 
              bjs.ajax( bos.rptdashpelanggan.url + '/saving', bjs.getdataform(this) , bos.rptdashpelanggan.objs) ;
            }
         }
      });
  }

  $(function(){
    bos.rptdashpelanggan.initcomp() ;
    bos.rptdashpelanggan.initcallback() ;
    bos.rptdashpelanggan.initfunc() ;
    
    setInterval(function(){
      bjs.ajax(bos.rptdashpelanggan.url + '/loaddata') ;
		}, 15000) ; 
  }) ;
</script>
