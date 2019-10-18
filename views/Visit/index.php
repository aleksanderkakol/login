<?php if(!isset($_SESSION['is_logged_in'])) : header('Location: '.ROOT_URL); ?>
<?php else : ?>
<div>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>visit/add">Dodaj wizytę</a>
	<a class="btn btn-success btn-share pull-right" href="<?php echo ROOT_PATH; ?>visit/history">Historia wizyt</a>
	<?php if($viewmodel == null) : ?>
	<h2 class="text-center">Brak Aktualnych Wizyt</h2>
	<?php else : ?>
	<h2 class="text-center">Aktualne Wizyty</h2>
	<?php endif; ?>
	<?php foreach($viewmodel as $item) : ?>
	<div class="panel panel-default">
		<div class="panel-heading"><strong><?php echo 'Karta Gościa numer '.$item['vcard_id']; ?></strong></div>
		<div class="panel-body row">
			<div class="col-xs-4">
				<label>Imię i nazwisko</label>
				<p class="panel"><?php echo $item['name11']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Firma/Instytucja</label>
				<p class="panel"><?php echo $item['nadmiar1']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Data wejścia</label>
				<p class="panel"><?php echo date('Y-m-d H:i:s', strtotime($item['ts1'])); ?></p>
			</div>
			<div class="col-xs-4">
				<label>Zapraszający</label>
				<p class="panel"><?php echo $item['name21']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Numer dokumentu</label>
				<p class="panel"><?php echo $item['doc_num']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Liczba wprowadzanych osób</label>
				<p class="panel"><?php echo $item['nadmiar3']; ?></p>
			</div>
			<div class="col-xs-12">
				<label>Dodatkowy opis</label>
				<p class="panel"><?php echo $item['nadmiar2']; ?></p>
			</div>
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>visit/delete">
				<input name="vcard" type="hidden" value="<?php echo $item['vcard_id'];?>">
				<input name="number" type="hidden" value="<?php echo $item['nadmiar3'];?>">
				<input name="name11" type="hidden" value="<?php echo $item['name11'];?>">
				<input name="delete" type="hidden" value="<?php echo $item['id'];?>">
				<button class="btn-danger btn col-xs-2 col-xs-offset-5" value="Submit" name="submit" type="submit">Zakończ wizytę</button>
			</form>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
	$(document).ready(function() {
		$('.panel-heading').click(function(e){
			var $this = $(this).parent().find('.panel-body');
			$this.slideToggle(300);
		})
    
	});
});
</script>
<?php endif; ?>