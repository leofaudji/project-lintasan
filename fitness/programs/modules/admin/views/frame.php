<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('bismillah/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/icon/css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/icon/css/ionicons.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/animate.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/jQueryUI/jquery-ui.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/select2/css/select2.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/datepicker/bootstrap-datetimepicker.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/w2/w2ui-1.5.rc1.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/pnotify/pnotify.custom.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('bismillah/core.desktop.css')?>">
	<style media="screen">
		body{ background-image: url("./uploads/bg/bg.jpg"); }
	</style>
</head>
<body id="osx" data-bismillahauth="">
	<audio id="wrap-audio-notif">
		<source type="audio/mpeg" src="./uploads/notif.mp3"></source>
	</audio>
	<div id="topbar">
		<table id="general">
			 <tr>
				  <td width="2%" class="icon" onclick="">
						<i class="ion-cube"></i>
				  </td>
				  <td width="20%" onclick="">
						<strong><?=$app_title?></strong>
				  </td>
				  <td width="50%" class="text-center"><?=$fullname?></td>
				  <td class="text-right">
						<table id="right">
							 <tr>
								  <td>
										<i class="fa fa-circle transition" id="oObj" style="color:#3498db"></i>
								  </td>
								  <td >
										<?=$city?> (<span id="texttime"></span>)
								  </td>
								  <td class="hover transition" id="framemenu_open">
										<i class="fa fa-th-large"></i>
								  </td>
								  <td class="hover transition" id="framemenu_profile">
										<i class="fa fa-tasks"></i>
								  </td>
							 </tr>
						</table>
				  </td>
			 </tr>
		</table>
	</div><!-- topbar -->

	<div id="footerbar" class="transition">
		<div class="dock">
		</div>
	</div><!-- footerbar -->



	<!-- sidebar menu -->
	<div class="sidebar menu transition" ng-app="framemenu" ng-controller="framemenu_controller">
		<h4><i class="ion-ios7-keypad-outline"></i>&nbsp;&nbsp;Menus</h4>
		<div class="search">
			 <input class="form-control" name="search" id="search"
			 placeholder="Search ..." ng-model="framemenu_searchstring">
		</div>
		<ul class="detailmenu">
			 <li ng-repeat="dbr in items | framemenu_searchfor:framemenu_searchstring"
			 class="item {{dbr.parent}}" ng-click="form_desktop(dbr.o)">
				  <i class="{{dbr.icon}}"></i>&nbsp;&nbsp;{{dbr.name}}
			 </li>
		</ul>
	</div>
	<!-- end menu -->
	<!-- sidebar profil -->
	<div class="sidebar profile transition">
		<div class="nav">
			 <div class="btn-group">
				  <button class="btn btn-tab active" href="#frame_t1" data-toggle="tab" >Profil</button>
				  <button class="btn btn-tab" href="#frame_t2" data-toggle="tab">Notification</button>
			 </div>
		</div>
		<div class="tab-content">
			 <div role="tabpanel" class="tab-pane fade in active" id="frame_t1">
				  <div class="me">
						<div class="wrap-img">
							 <img class="img-responsive img-thumbnail" src="<?=$data_var['ava']?>" id="file-pic">
							 <input type="file" name="file-hidden-pic" class="file-hidden" accept="image/*" id="file-hidden-pic">
						</div>
						<h4>User Name</h4>
						<div class="icon-circle" style="background-color:#e67e22" data-toggle="tooltip"
						title="Change Background">
							 <i class="ion-ios-monitor"></i>
							 <input type="file" name="bg-hidden-pic" class="file-hidden" accept="image/*" id="bg-hidden-pic">
						</div>
						<div class="icon-circle" style="background-color:#3498db" data-toggle="tooltip"
						title="Your Profile" onclick="scOSX.OpenProfile()">
							 <i class="ion-ios-person-outline"></i>
						</div>
						<div class="icon-circle" style="background-color:#34495e" data-toggle="tooltip"
						title="Logout" id="logout">
							 <i class="ion-ios-locked-outline"></i>
						</div>
				  </div>
				  <div class="item parent">
						<i class="ion-ios7-time-outline"></i>&nbsp;&nbsp;&nbsp;Hari Ini
				  </div>
				  <div class="wrap sidebar_tanggal">
						<h3 ><?= date("l") . ",<br />" . date("d M Y") ?></h3>
				  </div>
			 </div>
			 <div role="tabpanel" class="tab-pane fade" id="frame_t2">
				  <div style="text-align:center">
						<div style="margin:auto;">
							 <ul class="notification" id="wrapnotification"></ul>
						</div>
				  </div>
			 </div>
		</div>
	</div>
	<!-- end profil -->

	<script type="text/javascript" src="<?=base_url('bismillah/jQuery/jquery-2.2.3.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/jQueryUI/jquery-ui.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/angular/angular.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/bootstrap/js/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/select2/js/select2.full.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/w2/w2ui-1.5.rc1.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/pnotify/pnotify.custom.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/datepicker/moment.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/datepicker/bootstrap-datetimepicker.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('bismillah/jQuery/jquery.number.js')?>"></script>

	<script type="text/javascript">
	<?php
		echo 'var base_url = "'.base_url().'" ;' ;
	?>
	</script>
	<?php
		require_once 'frame.menu.js.php' ;
	?>
	<script type="text/javascript" src="<?=base_url('bismillah/core.js')?>"></script>
	<script type="text/javascript">
		var menit = 0 ;
		bjs_os.dock_init() ;
		bjs_os.frame_init() ;

		bjs.ajax("admin/frame/ping") ;
		bjs.ajax("admin/frame/ceknotif") ;
		setInterval(function(){
			bjs.ajax("admin/frame/ping") ;

			//notif setiap 10 menit
			if(++menit == 10){
				bjs.ajax("admin/frame/ceknotif") ;
				menit 	= 0 ;
			}
		}, 60000) ;
	</script>
</body>
</html>
