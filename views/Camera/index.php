<div>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>camera/add">Dodaj</a>
	<?php if($viewmodel == null) : ?>
		<h2 class="text-center">Brak Przypisanych Tablic</h2>
	<?php else : ?>
		<div class="panel panel-default">
			<table class="table table-hover">
				<thead class="panel-heading">
					<tr class="panel-title active">
						<th>Imię i Nazwisko</th>
						<th class='text-center'>Firma</th>
						<th class='text-center'>Marka pojazdu</th>
						<th class='text-center'>Numer rejestracyjny</th>
						<th class='text-center'>Pozwolenie na wjazd</th>
						<th class='text-center'>Ważne do</th>
						<th class='text-center'>Brama</th>
						<th class='text-center'>Usuń</th>
					</tr>
				</thead>
				<tbody class="tbody">
					<?php foreach($viewmodel as $item) : ?>
						<tr>
							<td><?php echo $item['lpr_user_name']; ?></td>
							<td class='text-center' ><?php echo $item['lpr_company']; ?></td>
							<td class='text-center' ><?php echo $item['lpr_car']; ?></td>
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
							<td  class='text-center'><input class="form-control text-center valid" type="text" value="<?php echo $item['lpr_valid_to']; ?>"></td>
							<td  class='text-center'><?php echo $item['lpr_gate']; ?></td>
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
	<?php endif; ?>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {

	update_lpr = (lpr,value,date) =>{
		$.ajax({
			type: "post",
        	url: "/camera/update",
        	dataType: "json",
        	data: {
				lpr: lpr,
				value: value,
				date: date
        	},
        	success: function(e, n) {
				console.log(n);
			},
        	error: function(e, n, t) {
            	console.log(e), console.log(n), console.log(t);
        	},
        	complete: function(o, e) {
			}
		});
	}

	let date = $('.valid').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$(".valid").on("change", function(){
		const select = $(this).parent().prev().children(".select-plate");
		const lpr = select.attr('lpr');
		const value = select.val();
		update_lpr(lpr,value,$(this).val());
	});

	$(".select-plate").on("change", function(){
		const validDate = $(this).parent().next().children(".valid").val();
		const select = $(this);
		const lpr = select.attr('lpr');
		const value = select.val();
		update_lpr(lpr,value,validDate);
	});
});
</script>