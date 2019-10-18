<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>visit/add">Dodaj wizytę</a>
	<a class="btn btn-success btn-share pull-right" href="<?php echo ROOT_PATH; ?>visit">Aktualne wizyty</a>
	<?php endif; ?>
	<h2 class="text-center">Historia wizyt</h2>
	<?php foreach($viewmodel as $item) : ?>
	<div style="overflow:hidden;" class="panel panel-default">
		<div class="cursor panel-heading row"><span class="col-xs-4"><?php echo 'Karta Gość '.$item['vcard_id']; ?></span><span class="col-xs-4" > Wejście <?php echo date('Y-m-d H:i:s', strtotime($item['ts1'])); ?></span><span class="col-xs-4"> Wyjście <?php echo date('Y-m-d H:i:s', strtotime($item['ts2'])); ?></span></div>
		<div class="panel-body row ">
			<div class="col-xs-4">
				<label>Imię i nazwisko</label>
				<p class="panel"><?php echo $item['name11']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Firma/Instytucja</label>
				<p class="panel"><?php echo $item['nadmiar1']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Zapraszający</label>
				<p class="panel"><?php echo $item['name21']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Data wejścia</label>
				<p class="panel"><?php echo $item['ts1']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Data wyjścia</label>
				<p class="panel"><?php echo $item['ts2']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Typ dokumentu</label>
				<p class="panel"><?php echo $item['doctype_name']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Numer dokumentu</label>
				<p class="panel"><?php echo $item['doc_num']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Liczba wprowadzanych osób</label>
				<p class="panel"><?php echo $item['nadmiar3']; ?></p>
			</div>
			<div class="col-xs-4">
				<label>Dodatkowy opis</label>
				<p class="panel"><?php echo $item['nadmiar2']; ?></p>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
	$(document).ready(function() {
		$('.panel-body').hide();
		$('.panel-heading').click(function(e){
			var $this = $(this).parent().find('.panel-body');
			$this.slideToggle(300);
		})
    
	});
});
</script>