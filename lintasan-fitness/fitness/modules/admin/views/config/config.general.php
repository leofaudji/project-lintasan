<div class="row">

	<div class="col-sm-12">
		<div class="form-group">
			<label for="app_title">App Title</label>
			<input type="text" name="app_title" id="app_title" placeholder="App Title" value="<?=$app_title?>"
			class="form-control" required>
        </div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			<label for="fapp_logo">App Logo <span id="idlapp_logo"></span></label>
			<input type="file" id="app_logo" accept="image/*" class="fupload">
			<div id="idapp_logo"><?=$app_logo?></div>
        </div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			<label for="fapp_login_image">App login Image <span id="idlapp_login_image"></span></label>
			<input type="file" id="app_login_image" accept="image/*" class="fupload">
			<div id="idapp_login_image"><?=$app_login_image?></div>
        </div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			<label for="kota">Kota</label>
			<input type="text" name="kota" id="kota" value="<?=$kota?>" class="form-control" required>
		</div>
	</div>

</div>
