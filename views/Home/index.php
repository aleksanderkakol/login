<?php if(isset($_SESSION['is_logged_in'])) : header('Location: '.ROOT_URL.'login'); ?>
<?php else : ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Logowanie</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    	<div class="form-group">
    		<label>Name</label>
    		<input type="text" name="opr_name" class="form-control" autocomplete="username" placeholder="Login" />
    	</div>
    	<div class="form-group">
    		<label>Password</label>
    		<input type="password" name="opr_password" class="form-control" autocomplete="current-password" placeholder="Hasło"/>
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Login" />
    </form>
  </div>
</div>
<?php endif; ?>