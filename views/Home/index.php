<div class="panel panel-default login-form">
  <div class="panel-heading">
    <h3 class="panel-title">Logowanie</h3>
  </div>
  <div class="panel-body">
	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
	<label style="display:block;">Login
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    		<input type="text" name="opr_name" class="form-control" autocomplete="username" placeholder="Login" />
		</div>
	</label>
	<label style="display:block;">Hasło
    	<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input type="password" name="opr_password" class="form-control" autocomplete="current-password" placeholder="Hasło"/>
		</div>
	</label>
	<div class="input-control">
		<input class="btn btn-primary" name="submit" type="submit" value="Zaloguj" />
	</div>
    </form>
  </div>
</div>