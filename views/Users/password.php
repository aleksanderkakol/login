<?php if(!isset($_SESSION['is_logged_in'])) : header('Location: '.ROOT_URL); ?>
<?php else : ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Zmień hasło użytkownika <?php echo $_SESSION['user_data']['login']; ?></h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    	<div class="form-group">
    		<label>Hasło</label>
    		<input placeholder="Hasło" type="password" name="opr_password" class="form-control" />
		</div>
		<div class="form-group">
    		<label>Nowe hasło</label>
    		<input placeholder="Nowe hasło" type="password" name="new_password" class="form-control" />
    	</div>
		<div class="form-group">
    		<label>Potwierdź hasło</label>
    		<input placeholder="Potwierdź hasło" type="password" name="confirm_password" class="form-control" />
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Change" />
        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>users">Anuluj</a>
    </form>
  </div>
</div>
<?php endif; ?>