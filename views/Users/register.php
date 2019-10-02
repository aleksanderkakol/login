<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Register!</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    	<div class="form-group">
    		<label>Name</label>
    		<input type="text" name="opr_name" class="form-control" />
    	</div>
    	<div class="form-group">
    		<label>Level</label>
    		<input type="number" name="opr_level" class="form-control" />
    	</div>
    	<div class="form-group">
    		<label>Password</label>
    		<input type="password" name="opr_password" class="form-control" />
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Submit" />
        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>login">Cancel</a>
    </form>
  </div>
</div>
