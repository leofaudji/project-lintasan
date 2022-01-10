/*
	l: location
	d: data
	o: Object
	m: Method
	v: value

	version: 1.0.0 - Beta
*/
if (typeof jQuery === "undefined") {
  throw new Error("We Are need jQuery");
}

$.fn.serializeobject = function(){
   var o = {};
   var a = this.serializeArray();
   $.each(a, function() {
       if (o[this.name]) {
           if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
           }
           o[this.name].push(this.value || '');
       } else {
           o[this.name] = this.value || '';
       }
   });
   return o;
};

$.fn.sval	= function(val){
	if(val == undefined || val == '') val = {} ;
	var co	  = $(this);
	if(val !== {}){
		var cop = '', ci 	= [] ;
		$.each( val, function(i, o){
			cop += '<option value="' + o.id + '">' + o.text + '</option>' ;
			ci.push(o.id) ;
		}) ;
		co.empty().append(cop).val(ci).trigger('change') ;
	}else{
		co.empty() ;
	}
}

Number.prototype.numberformat 	= function(d, dc, uc){
	var nfn = this,
    nfc = isNaN(d = Math.abs(d)) ? 0 : d,
    nfd = dc == undefined ? "." : dc,
    nft = uc == undefined ? "," : uc,
    nfs = nfn < 0 ? "-" : "",
    nfi = String(parseInt(nfn = Math.abs(Number(nfn) || 0).toFixed(nfc))),
    nfj = (nfj = nfi.length) > 3 ? nfj % 3 : 0;
   return nfs + (nfj ? nfi.substr(0, nfj) + nft : "") +
   			nfi.substr(nfj).replace(/(\d{3})(?=\d)/g, "$1" + nft) +
   			(nfc ? nfd + Math.abs(nfn - nfi).toFixed(nfc).slice(2) : "") ;
}

var bos 		= {} ;
var bjs		= {
	loadpage	: function(id, p, d, isreport){
		if(d == undefined) d = "" ;
		//if(d !== "") p += "&" + d ;
		$(id).load(p) ;
	},

	ajaxerr 	: function(r, s, e){
		console.log(r + " , " + s + " , " + e) ;
	},

	ajax 		: function(l, d, o){
		var l 	= base_url + l, _s	= this ;

		$.ajax({
			type	      : "POST" ,
			headers		: { "sistem_by":"bismillahsuksesduniaakhirat"},
			url			: l,
	 		data	      : d,
			dataType 	: 'text' ,
			beforeSend	: function(){
				if(o !== undefined) $(o).button('loading') ;
			} ,
			error		: function(r, s, e){
				_s.ajaxerr(r, s, e) ;
				if(o !== undefined) $(o).button('reset') ;
			} ,
			success		: function(r){
				eval(r) ;
				if(o !== undefined) $(o).button('reset') ;
			}
		}) ;
	},

	ajaxfile 	: function(l, d, o){
		var i 	= base_url + l, _s	= this ;

		$.ajax({
			type	      : "POST" ,
			headers	   : { "sistem_by":"bismillahsuksesduniaakhirat"},
			url			: l,
	 		data	      : d,
			cache		   : false,
			processData	: false,
	      contentType	: false,
			beforeSend	: function(){
				if(o !== undefined) $(o).attr('readonly', true) ;
			} ,
			error		: function(r, s, e){
				_s.ajaxerr(r, s, e) ;
				if(o !== undefined) $(o).attr('readonly', false) ;
			} ,
			success		: function(r){
				eval(r) ;
				if(o !== undefined) $(o).attr('readonly', false) ;
			}
		}) ;
	},

	isvalidform	: function(o){
		var co_e 	= "", co_t 	= "", co_o 	= null ;
		$(o).find('input,textarea,select').filter('[required]')
		.each(function(i){
			co_v 	= true ;
			co_om 	= $(this) ;
			if( co_om.val() == "" || co_om.val() == null){
				co_v= false ;
			}
			//number
			if( co_om.hasClass("number") && co_om.val() == 0 ){
				co_v= false ;
			}
			if(!co_v){
				co_t 	= co_om.attr('placeholder') !== undefined ? co_om.attr('placeholder') : co_om.attr('data-placeholder') ;
				co_e   += co_t + " Empty! \n";
				if(co_o == null) co_o = co_om ;
				co_om.parent(".form-group").addClass('has-error') ;
			}else{
				co_om.parent(".form-group").removeClass('has-error') ;
			}
		}) ;

		if(co_e !== ""){
			alert(co_e) ;
			co_o.focus() ;
			return false;
		}else{
			return true;
		}
	},

	getdataform	: function(o){
		return $(o).serialize() ;
	},

	getdatajson	: function(){
		return $(o).serializeobject() ;
	},

	setopt 		: function(o, n, v){
		o.find("input[name='"+ n +"'][value='" + v + "']").prop('checked', true);
	},

	setcookie	: function(n, v, ex){

	},

	getcookie 	: function(n){

	},

	initenter	: function(o){
		o.find('input').on("keypress", function(e) {
      	/* ENTER PRESSED*/
      	if (e.keyCode == 13) {
	      	/* FOCUS ELEMENT */
	      	oi  = $(this).parents('form').eq(0).find(":input:visible:enabled:not([readonly])");
	      	i   = oi.index(this);
	      	if (i == oi.length - 1) {
               oi[0].select();
	      	} else {
	            oi[i + 1].focus(); //  handles submit buttons
	      	}
	      	return false;
      	}
		});
	},

	initdate	: function(o, lt){
		if(lt == undefined) lt = false ;
		$(o).datetimepicker({
		    language: 'en' ,
		    pickTime: lt
		}) ;
	},

	initselect	: function(p){
		var cp 	= {
			class 	: '.select2',
			url 	: 'admin/load',
			multi	: false,
			clear	: false,
			mininput: 0
		}
		$.extend(true, cp, p) ;

		$(cp.class).select2({
			multiple 	: cp.multi,
			allowClear	: cp.clear,
			minimumInputLength 	: cp.mininput,
			ajax:{
				url 	: function () { return base_url + cp.url + "/" + $(this).attr('data-sf'); } ,
				dataType: 'json',
		        data    : function (par) { return { q : par.term, p : par.page} ;  },
		        processResults	: function (data,page){  return { results: data }; }
		    }
		}) ;
	},

	initnumber	: function(o, d){
		if(d == undefined ) d = 0 ;
		$(o).number( true,d );
	},

	initprogress: function(o, s, e){
      var p = {} ;
      p.et  = parseFloat(100 / parseInt(e)) ;
      p.pr  = Math.min( parseFloat(p.et*s), 100) ;

      o.attr("aria-valuenow",p.pr) ;
      o.css("width",p.pr + "%") ;
      o.html('<span class="sr-only">'+parseInt(p.pr) +'%</span>') ;
	},

	form 		: function(par){//open form
		var f = {} ;
		f.par	= {
			module 	: "Utama" ,
			name 		: "oweb" ,
			loc 		: "sys/about" ,
			data 		: "" ,
			obj		: "bismillahsuksesduniaakhirat" ,
			nocontent: false ,
			idcontent: ".bwrapper" ,
			attr		: ""
		}

		$.extend(true,f.par,par) ;

		if(f.par.attr !== "") f.par.attr.replace("'",'"') ;

		if( $(f.par.idcontent).find(".bwrapper-content").length > 0 ){
			f.lid 	= $(f.par.idcontent).find(".bwrapper-content").attr("id") ;
			f.lobj	= $(f.par.idcontent).find(".bwrapper-content").attr("data-bobj") ;
			$("#"+f.lid).trigger("remove").remove() ;
			eval(" " + f.lobj+ " = null ; ") ;
		}
		$(f.par.idcontent).html("") ;

		/*Initialize*/
		f.par.obj 	= f.par.obj.replace(" ","") ;
		f.obj 		= "bos." + f.par.obj ;
		f.id 		= "bos-form-" + f.par.obj ;
		f.idload 	= f.id + "-wraper" ;
		f.idpreload	= f.id + "-wraper" ;
		if(f.par.nocontent){ f.idpreload	= f.id ; }

		f.html		 		= '' ;
		if(!f.par.nocontent){
			f.html		+= '<div id="'+ f.id +'" class="bwrapper-content" data-bobj="'+ f.obj +'" '+f.par.attr+'>' ;
			f.html		+= '<section class="content-header">' ;
			f.html		+= '	<h1>'+f.par.name+'</h1>' ;
			f.html		+= '	<ol class="breadcrumb">' ;
			f.html		+= '	<li><a href="#">'+f.par.module+'</a></li>' ;
			f.html		+= '	<li class="active">'+f.par.name+'</li>' ;
			f.html		+= '	</ol>' ;
			f.html		+= '</section>' ;
			f.html		+= '<section class="content" id="'+f.idload+'"></section>' ;
			f.html		+= '</div>' ;
		}

		f.html	   		+= '<script type="text/javascript">' ;
		f.html	   		+= 	' ' + f.obj +' = ({ ';
		f.html	   		+=		'id 		: "'+ f.id +'" , ';
		f.html	   		+=		'obj 		: $("#'+ f.id +'") , ';
		f.html	   		+=		'base_url: "'+ f.par.loc +'" , ';
		f.html	   		+=		'url 		: "'+ f.par.loc +'" , ';
		f.html	  		   +=		'reload	: function(){ bjs.loadpage("#'+f.idpreload+'","'+f.par.loc+'","'+f.par.data+'") } ';
		f.html	   		+=	'}) ;  ' ;

		if(!f.par.nocontent){
			f.html	   	+=	' bjs.loadpage("#'+f.idload+'","'+f.par.loc+'","'+f.par.data+'") ; ' ;
			f.html	    += '</script>' ;
			$(f.par.idcontent).append(f.html) ;
		}else{
			f.html	   	+=	' bjs.loadpage("#'+f.id+'","'+f.par.loc+'","'+f.par.data+'") ; ' ;
			f.html	    += '</script>' ;
			$(f.par.idcontent).append('<div id="'+f.id+'" class="bwrapper-content" data-bobj="'+ f.obj +'" '+f.par.attr+'></div>'+f.html) ;
		}

		console.log("Name OBJECT FORM -> " + f.obj) ;
		console.log( eval(f.obj) ) ;
	},

	form_report	: function(l){
		var o 	= $("#rpt_modal_show") ;
		o.find("iframe").attr("src", l ) ;
		o.modal("show") ;
	}
}

var bjs_os    = {
   cfg          : {
      pos       : {top:0, left:0} ,
      dock      : 0 ,
      form      : 0 ,
      color     : ["#1abc9c","#2ecc71","#3498db","#9b59b6","#1BA39C","#f1c40f","#e67e22","#e74c3c","#D2527F","#19B5FE"] ,
      animate   : {
         default    : "flipInX" ,
         close      : "zoomOut" ,
         max        : "zoomIn-osx" ,
         max2       : "zoomIn-osx-def" ,
         min        : "zoomOutDown-def minimize" ,
         all        : "flipInX zoomOut zoomIn-osx zoomIn-osx-def zoomOutDown-def minimize"
      }
   } ,

   form         : function(par){
      var _s    = this , f = {} ;
      if(_s.cfg.pos.top == 0) _s.getpos() ;
		f.par	= {
			module 	: "Utama" ,
			name 		: "oweb" ,
			loc 		: "sys/about" ,
         obj		: "bismillahsuksesduniaakhirat" ,
			data 		: "" ,
         size     : {
            width : _s.cfg.pos.left - 30, //default is max
            height: _s.cfg.pos.top - 60,
            top   : 0,
            left  : 0
         },
         opt      : {
            title : true,
            resize: true,
            modal : false,
            frame : false,
            dock  : true,
            help  : false
         },
         class    :{
            body  : '' ,
            header: ''
         }
		}
      $.extend(true,f.par,par) ;

      //set postion form
      if(f.par.size.width <= 300)  f.par.size.width = 350 ;
      f.par.size.top  = Math.max(0, (_s.cfg.pos.top - f.par.size.height) / 2 ) + 10 ;
      f.par.size.left = Math.max(0, (_s.cfg.pos.left - f.par.size.width) / 2 ) ;
      if(f.par.size.top > _s.cfg.pos.top){
         f.par.size.top = _s.cfg.pos.top ;
      }
      if(f.par.size.left > _s.cfg.pos.left){
         f.par.size.left = _s.cfg.pos.left ;
      }

      // add form increment
      _s.cfg.form++ ;

      //form style
      f.style    = 'height:' + f.par.size.height + 'px;display:block;'  ;
   	f.style	 += 'width:' + f.par.size.width + 'px;'  ;
   	f.style	 += 'top:' + f.par.size.top + 'px;'  ;
   	f.style	 += 'left:' + f.par.size.left + 'px;'  ;
   	f.style	 += 'z-index:' + _s.cfg.form  ;

      //Initialize
		f.par.obj  = f.par.obj.replace(" ","") ;
		f.obj 	  = "bos." + f.par.obj ;
		f.id 		  = "bos-form-" + f.par.obj ;
      f.idload   = f.id + '-body' ;

      //html tiitle
      f.html_t   = '' ;
      if(f.par.opt.title){

         f.html_t	   +=		'<div class="header '+ f.par.class.header +'" id="'+ f.id +'-title">';
         f.html_t	   +=			'<table class="header-table">';
         f.html_t	   +=	        	'<tr>';
         f.html_t	   +=	             	'<td class="icon"> <i class="'+ f.par.icon +'"></i> </td>';
         f.html_t	   +=	                '<td class="title" >'+ f.par.name +'</td> ';
         f.html_t	   +=	                '<td class="button" > ';
         f.html_t	   +=	                	'<table class="header-button" align="right">';
         f.html_t	   +=	                     	'<tr>';
         if(f.par.opt.help){
            f.html_t	   +=	                       	'<td>';
            f.html_t	   +=	                        	'<div class="btn-help" title="Help"';
            f.html_t    += 								 'onclick="'+f.obj+'.help()">';
            f.html_t	   +=	                            	'<i class="fa fa-question-circle"></i>';
            f.html_t	   +=	                            '</div>';
            f.html_t	   +=	                        '</td>';
         }
         if(!f.par.opt.modal){
            f.html_t	   +=	                       	'<td>';
            f.html_t	   +=	                        	'<div class="btn-circle btn-minimize transition"';
            f.html_t    += 								 'onclick="'+f.obj+'.minimize()">';
            f.html_t	   +=	                            	'<img src="./uploads/titlebar/min.png">';
            f.html_t	   +=	                            '</div>';
            f.html_t	   +=	                        '</td>';
            if(f.par.opt.resize){
               f.html_t	   +=	                    '<td>';
               f.html_t	   +=	                    	'<div class="btn-circle btn-maximize transition"' ;
               f.html_t    += 							'onclick="'+f.obj+'.maximize()">';
               f.html_t	   +=	                             '<img src="./uploads/titlebar/max.png">';
               f.html_t	   +=	                        '</div>';
               f.html_t	   +=	                    '</td>';
            }
         }
         f.html_t	   +=	                            '<td>';
         f.html_t	   +=	                             	'<div class="btn-circle btn-close transition" onclick="'+f.obj+'.close()">';
         f.html_t	   +=	                                 	'<img src="./uploads/titlebar/close.png">';
         f.html_t	   +=	                                '</div>';
         f.html_t	   +=	                            '</td>';
         f.html_t	   +=	                        '</tr>';
         f.html_t	   +=	                    '</table>';
         f.html_t	   +=	                '</td>';
         f.html_t	   +=	            '</tr>';
         f.html_t	   +=	        '</table>';
         f.html_t	   +=	    '</div>' ;
      }
      //end title
      //html jscript
      f.html_js  = '' ;
      f.html_js += '<script type="text/javascript">' ;
      f.html_js += 	' ' + f.obj+' = ({ ';
      f.html_js +=		'id 	  : "'+ f.id +'" , ';
      f.html_js +=		'idload : "'+ f.idload +'" , ';
      f.html_js +=		'obj 	  : $("#'+ f.id +'") , ';
      f.html_js +=		'url 	  : "'+ f.par.loc +'" , ';
      f.html_js +=		'base_url   : "'+ f.par.loc +'" , ';
      f.html_js +=		'minimize	: function(){ bjs_os._minimize("'+ f.id +'") } , ';
      f.html_js +=		'ominimize	: function(){ bjs_os._ominimize("'+ f.id +'") } , ';
      f.html_js +=		'maximize	: function(){ bjs_os._maximize("'+ f.id +'") } , ';
      f.html_js +=		'close    	: function(){ bjs_os._close("'+ f.id +'","'+ f.obj +'") } , ';
      f.html_js +=		'header     : bjs_os._header("'+ f.id +'"), ';
      f.html_js +=		'help       : function(e){ e.stopPropagation() ; e.preventDefault() ; bjs_os._help("'+ f.par.loc +'","'+ f.par.name +'") } , ';
      if(!f.par.opt.frame){
         f.html_js+=    'reload     : function(){ bjs.loadpage("#'+f.idload+'", "'+f.par.loc+'", "'+f.par.data+'") }';
      }
      f.html_js +=	'}) ;  ' ;
      f.html_js +=	'bjs_os.setopen("'+f.id+'") ;' ;
      if(!f.par.opt.frame){
         f.html_js+= 'bjs.loadpage("#'+f.idload+'","'+f.par.loc+'","'+f.par.data+'") ; ' ;
      }
      if(f.par.opt.resize){
         f.html_js+= 	'$("#'+f.id+'").resizable({';
         f.html_js+=		   'minHeight : ' + f.par.size.height + ',' ;
         f.html_js+=		   'minWidth  : ' + f.par.size.width + ',' ;
         f.html_js+=		   'maxHeight : ' + (_s.cfg.pos.top - 30) + ',' ;
         f.html_js+=		   'maxWidth  : ' + (_s.cfg.pos.left - 60) + ',' ;
         f.html_js+=		   'handles: "all"' ;
         f.html_js+= 	'}) ; ' ;
      }
      f.html_js += 	'$("#'+f.id+'").click(function(){';
      f.html_js += 		' bjs_os.setindex(this,false) ;' ;
      f.html_js += 	'}) ; ' ;
      f.html_js += 	' bjs_os.hidesidebar() ;' ;
      f.html_js += '</script>' ;
      //end html javascript
      //html
      f.html     = '<div class="bos-form bos-active '+_s.cfg.animate.default+'" style="'+ f.style +'" ';
      f.html 	 += 'id="'+ f.id +'" data-style="'+ f.style +'" data-width="'+f.par.size.width+'px"' ;
   	f.html	 += 'data-height="'+f.par.size.height+'px">' ;
      f.html    +=    '<div class="bos-form-wrap" id="'+ f.id +'-wrapper">' ;
      f.html    +=         f.html_t ;
      f.html    += 			'<div class="'+ f.par.class.body +' body" id="'+ f.id +'-body">' ;
   	if(f.par.opt.frame){
   		f.html +=			   '<iframe src="'+f.par.loc+'" frameborder="0" width="100%" height="100%" style="padding-top:30px;"></iframe>';
   	}
      f.html    +=    '</div>' ;
      f.html    +=    f.html_js ;
      f.html    += '</div>' ;


      //check body
      if($("body").find("#"+f.id).length > 0 ){
   		$("body").find("#"+f.id).remove() ;
   	}else{
   		if(f.par.opt.dock){
   			_s.dock_add(f.id, f.par.icon, f.par.name) ;
   		}
   	}

      //append
   	$("body").prepend(f.html) ;
   	console.log("Name OBJECT FORM -> " + f.obj) ;
   	console.log( eval(f.obj) ) ;
   },

   form_report  : function(o){
      //nanti sik
      setTimeout(function(){
         bjs_os.form({
            module    : "Laporan",
            name      : "Laporan",
            md5       : "f5fe8be4da25dee9cf66e384e6534cb3",
            obj       : "rpt_modal_show",
            loc       : o,
            icon      : "ion-ios-paper",
            opt       : {
               resize : false,
               modal  : true,
               frame  : true,
               dock   : false,
            }
         }) ;
      },1) ;
   },

   _minimize    : function(id){
      var _o = {} , _s = this;
      _o.obj = $("body #" + id) ;
   	_o.e 	 = $.Event("bos:minimize") ;
   	_o.obj.removeClass( _s.cfg.animate.all ).delay(100)
   	.queue(function(){
   		$(this)
   		.addClass( _s.cfg.animate.min )
   		.dequeue()
   		.trigger(_o.e).delay(500).queue(function(){
   			$(this).css({
   				"display":"none",
   				"z-index":"-999"
   			}).
   			dequeue() ;
   		})
   		_o.objnow 		= _s.getlastform() ;
   		if(_o.objnow !== null){
   			$(_o.objnow).addClass("bos-active") ;
   		}
   	}) ;
   },

   _ominimize   : function(id){
      var _o = {} , _s = this;
      _o.obj = $("body #" + id) ;
      _o.e 	 = $.Event("bos:ominimize") ;
   	if( _o.obj.hasClass("minimize") ){
   		_o.obj.css({"opacity":0,"display":"block"})
   		.removeClass(  _s.cfg.animate.all ).delay(100)
   		.queue(function(){
   			$(this)
   			.addClass( _s.cfg.animate.default )
   			.css("opacity","100")
   			.dequeue()
   			.trigger(_o.e) ;
   		}) ;
   	}
   	_s.setindex(_o.obj,true) ;
   },

   _maximize    : function(id){
      var _o = {} , _s = this;
      _o.l   = true ;
   	_o.obj = $("body #" + id) ;
   	_o.e 	 = $.Event("bos:maximize") ;
      if( _o.obj.css("width") == (_s.cfg.pos.left - 30) + "px" ) _o.l    = false ;

      if(_o.l){//maximize
         _o.obj.removeClass( _s.cfg.animate.all ).delay(100)
   		.queue(function(){
   			$(this).addClass( _s.cfg.animate.max )
   			.css({
   				width : _s.cfg.pos.left - 30 + "px",
   				height: _s.cfg.pos.top - 60 + "px",
   				left 	: "20px" ,
   				top 	: "30px"
   			}).dequeue()
   			.trigger(_o.e) ;
   			$(this).find(".bodyfix").addClass("max") ;
   			$(this).find(".footer").addClass("max") ;
   		}) ;
      }else{
         _o.obj.removeClass( _s.cfg.animate.all ).delay(100)
   		.queue(function(){
   			$(this)
   			.addClass( _s.cfg.animate.max2 )
   			.attr("style" , _o.obj.attr("data-style") ).dequeue()
   			.trigger(_o.e) ;
   			$(this).find(".bodyfix").removeClass("max") ;
   			$(this).find(".footer").removeClass("max") ;

   			_s.cfg.form++ ;
   			$(this).css("z-index",_s.cfg.form) ;
   		}) ;
      }

   },

   _close       : function(id, o){
      var _s    = this, _o = null ;
      $('#' + id).removeClass(_s.cfg.animate.all)
   	.addClass(_s.cfg.animate.close).delay(500).queue(function(){
   		$(this).remove().dequeue() ;
   		eval(" " + o + " = null ; ") ;
   		_s.dock_remove(id) ;
   		_o = _s.getlastform() ;
   		if(_o !== null){
   			$(_o).addClass("bos-active") ;
   		}
   	}) ;
   },

   _header      : function(id){
      $('#' + id).draggable({
   		handle	: '#' + id + '-title',
   		cursor	: 'move'
   	}) ;
   },

   _help        : function(u, n){
      //nanti sik
   },

   setindex     : function(o, _){
      if(this.cfg.form > parseInt($(o).css('z-index')) || _){
         this.cfg.form++ ;
         $('body').find('.bos-form.bos-active').removeClass('bos-active') ;
         $(o).css("z-index",this.cfg.form) ;
   		$(o).addClass("bos-active") ;
      }
      this.hidesidebar() ;
   },

   getlastform  : function(){
      var f = {o : null, n : -1, oj : null} ;
      $('body').find('.bos-form').each(function(){
         f.oj    = $(this) ;
         if(! f.oj.hasClass('minimize')){
            if( f.n < parseInt(f.oj.css("z-index")) ){
               f.n    = parseInt(f.oj.css("z-index")) ;
               f.o    = this;
            }
         }
      }) ;
      return f.o ;
   },

   setopen      : function(id){
      $('body').find('.bos-form.bos-active').removeClass('bos-active') ;
      $('#' + id +'.bos-form').addClass('bos-active') ;
   },

   getpos       : function(){
      this.cfg.pos.top = $(document).innerHeight() ;
      this.cfg.pos.left= $(document).innerWidth() ;
   },

   hidesidebar  : function(){
      $(".sidebar").css("z-Index","99990").removeClass("active") ;
   },

   dock_add     : function(id, i, t){
      if(this.cfg.dock < 10){
         var f = {
            o : $("#footerbar .dock") ,
            s : '' ,
            h : '' ,
            c : this.cfg
         } ;
   		f.o.find("#" + id + "_dock").remove() ;
   		f.s = 'id="'+id+'_dock" onclick="bjs_os._ominimize(&quot;'+id+'&quot;)"' ;
   		f.h = '<div class="icon-circle '+f.c.animate.default+' animated bg-'+(f.c.dock+1)+'" '+f.s+' title="'+t+'"><i class="'+i+'"></i></div>';

   		f.o.append(f.h) ;
   		f.o.find("#" + id + "_dock").tooltip({"container":"body"}) ;

   		this.cfg.dock++ ;
   	}
   },

   dock_remove  : function(id){
      $("#footerbar .dock").find("#" + id + "_dock").remove() ;
   	this.cfg.dock-- ;
   	this.cfg.dock = Math.max(0,this.cfg.dock) ;
   },

   dock_init    : function(){
      this.getpos() ;
      var c = this.cfg ;
      $(window).mousemove(function(event){
			var o 	= $("#footerbar") ;
			if(event.pageY > c.pos.top - 50){
				if(!o.hasClass("active")) o.addClass("active") ;
			}else{
				if(o.hasClass("active")) o.removeClass("active") ;
			}
		}) ;
   },

   inittab    : function(o,c){
      var e   = $.Event("bos:tab") ;
      e.c     = c ;
      o.find(c+'[data-toggle="tab"]').on('shown.bs.tab', function(){
         o.find(c).each(function(){
            $(this).removeClass("active") ;
         }) ;
         $(this).addClass("active") ;

         e.i    = $(this).index() ;
         o.trigger(e) ;
      }) ;
   },

   frame_init    : function(){
      var s = this ;
      $('[data-toggle="tooltip"]').tooltip() ;

      $("#osx #topbar").find("#framemenu_open").click(function(){
   		var o 	= $(".sidebar.menu") ;
   		if(o.hasClass("active")){
   			o.removeClass("active") ;
   			o.find("#search").blur() ;
   			o.css("z-Index","99990") ;
   		}else{
   			o.find("#search").focus() ;
   			bjs_os.hidesidebar();
   			o.css("z-Index","99999").addClass("active") ;
   		}
   	}) ;

      $("#osx #topbar").find("#framemenu_profile").click(function(){
   		var o 	= $(".sidebar.profile") ;
   		if(o.hasClass("active")){
   			o.removeClass("active") ;
   			o.css("z-Index","99990") ;
   		}else{
   			bjs_os.hidesidebar();
   			o.css("z-Index","99999").addClass("active") ;
   		}
   	}) ;

   	$("#osx .nav .btn-group .btn-tab").click(function(){
   		$("#osx .nav .btn-group .btn-tab").each(function(){
   			$(this).removeClass("active") ;
   		}) ;
   		$(this).addClass("active") ;
   	}) ;

   	$("#osx #logout").click(function(e){
           e.preventDefault() ;
           if(confirm("Meninggalkan Aplikasi?")){
              bjs.ajax('admin/frame/logout') ;
           }
       });
   }
}
