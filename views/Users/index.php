<?php if(!isset($_SESSION['is_logged_in'])) : header('Location: '.ROOT_URL); ?>
<?php else : ?>
<div>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>users/register">Dodaj użytkownika</a>
	<a class="btn btn-success btn-share pull-right" href="<?php echo ROOT_PATH; ?>users/password">Zmień hasło</a>
<div class="panel panel-default">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Login</th>
				<th class='text-center'>Poziom uprawnień</th>
				<th class='text-center'>Status</th>
				<th class='text-center'>Usuń</th>
			</tr>
		</thead>
		<tbody class='progress_bar_tbody'>
			<?php foreach($viewmodel as $item) : ?>
				<tr>
					<td><?php echo $item['opr_login']; ?></td>
					<td>
						<div class="progress">
							<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $item['opr_level'];?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $item['opr_level'];?>%">
							</div>
						</div>
						<input class="form-control opr_level_input" min=0 max=100 opr_id="<?php echo $item['opr_id'];?>" type="number" value="<?php echo $item['opr_level'];?>">
					</td>
					<?php if($item['opr_status']===true) : $status = 'Zalogowany';?>
					<?php else : $status = 'Nie zalogowany';?>
					<?php endif; ?>
					<td class='text-center'>
						<?php echo $status; ?>
					</td>
					<td class='text-center'>
							<button class="btn btn-danger" type="button" data-toggle="modal" data-target=".button_<?php echo $item['opr_login'];?>" name="delete" value="delete" >Usuń</button>
							<div class="button_<?php echo $item['opr_login'];?> modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 								<div class="modal-dialog modal-lg">
    								<div class="modal-content">
										<div class="modal-body">
        									<p style="font-size:1.8rem;" class="text-left">Czy na pewno chcesz usunąć użytkownika <?php echo $item['opr_login'];?>?</p>
										</div>
										<div class="modal-footer">
											<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>users/delete">
												<input type="hidden" name="opr_login" value="<?php echo $item['opr_login'];?>">
												<button type="submit" class="btn btn-default" name="yes" value="<?php echo $item['opr_id'];?>">Usuń</button>
        										<button type="submit" class="btn btn-primary" name="no" value="no" data-dismiss="modal">Anuluj</button>
											</form>
    									</div>
    								</div>
  								</div>
							</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
	$(".opr_level_input").bind("keyup change", function(){
		let level = this.value;
		let opr_id = $(this).attr('opr_id');
		const progress_bar = $(this).parent().parent().find('.progress-bar');
		if(level>100){level = 100;}else if(level<0){level=0;}else if(level===''){level=0;}
		progress_bar.attr('aria-valuenow', level);
		progress_bar.css('width', level+'%');
		progress_bar.text(level);
		$.ajax({
        type: "post",
        url: "/www/users/level",
        dataType: "json",
        data: {
			opr_id: opr_id,
			opr_level: level
        },
        success: function(e, n) {
			console.log(n);
		},
        error: function(e, n, t) {
            console.log(e), console.log(n), console.log(t);
        },
        complete: function(o, e) {}
	});
	
	});
});
</script>
<?php endif; ?>