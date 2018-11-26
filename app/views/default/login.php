<div class="container">
	<div class="card mt-5">
		<div class="card-title text-center mt-2"><h3>Iniciar sesión</h3></div>
		<form action="<?=URL;?>public/?url=default/login" class="card-body" method="post">
			<div class="form-group">
				<input type="text" name="name" class="form-control <?=$errors?>" placeholder="Usuario">
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control <?=$errors?>" placeholder="contraseña">
			</div>
			<input type="submit" value="Iniciar" name="btn-login" class="btn btn-primary btn-block">
		</form>
	</div>
</div>