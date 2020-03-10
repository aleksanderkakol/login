<div>
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
						<td class='text-center'><?php echo $status; ?></td>
						<td  class='text-center'><?php echo $item['lpr_valid_to']; ?></td>
						<td  class='text-center'><?php echo $item['lpr_gate']; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endif; ?>
</div>