<?php if(!isset($_SESSION['is_logged_in'])) : header('Location: '.ROOT_URL); ?>
<?php else : ?>
<div>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>camera/add">Dodaj</a>
<div class="panel panel-default">
	<table class="table table-hover">
		<thead class="panel-heading">
			<tr class="panel-title active">
				<th>Imię i Nazwisko</th>
				<th class='text-center'>Numer rejestracyjny</th>
				<th class='text-center'>Pozwolenie na wjazd</th>
				<th class='text-center'>Usuń</th>
			</tr>
		</thead>
		<tbody class="tbody">
			<?php foreach($viewmodel as $item) : ?>
				<tr>
					<td><?php echo $item['lpr_user_name']; ?></td>
					<td  class='text-center'><?php echo $item['lpr_plate']; ?></td>
					<?php if($item['lpr_on_whitelist']=='true') : $status = 'Tak'; $value = 1; $secondValue = 0; $secondOption = 'Nie'?>
					<?php else : $status = 'Nie'; $value = 0; $secondValue = 1; $secondOption = 'Tak'?>
					<?php endif; ?>
					<td class='text-center'>
						<select lpr="<?php echo $item['lpr_id']; ?>" name="lpr_whlist" class="form-control select-plate">
							<option value="<?php echo $value; ?>"><?php echo $status; ?></option>
							<option value="<?php echo $secondValue; ?>"><?php echo $secondOption; ?></option>
						</select>
					</td>
					<td class='text-center'>
							<button class="btn btn-danger" type="button" data-toggle="modal" data-target=".button_<?php echo $item['lpr_id'];?>" name="delete" value="delete" >Usuń</button>
							<div class="button_<?php echo $item['lpr_id'];?> modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 								<div class="modal-dialog modal-lg">
    								<div class="modal-content">
										<div class="modal-body">
        									<p style="font-size:1.8rem;" class="text-left">Czy na pewno chcesz usunąć tablicę <?php echo $item['lpr_plate'];?>?</p>
										</div>
										<div class="modal-footer">
											<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>camera/delete">
												<input type="hidden" name="lpr_plate" value="<?php echo $item['lpr_plate'];?>">
												<button type="submit" class="btn btn-default" name="yes" value="<?php echo $item['lpr_id'];?>">Usuń</button>
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
	$(".select-plate").on("change", function(){
		const select = $(this);
		const lpr = select.attr('lpr');
		const value = select.val();
		$.ajax({
			type: "post",
        	url: "/www/camera/update",
        	dataType: "json",
        	data: {
				lpr: lpr,
				value: value
        	},
        	success: function(e, n) {
				select.attr("disabled", true);
				console.log(n);
			},
        	error: function(e, n, t) {
            	console.log(e), console.log(n), console.log(t);
        	},
        	complete: function(o, e) {
				select.attr("disabled", false);
			}
		});
	});
});
</script>
<?php endif; ?>