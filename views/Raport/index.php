<?php if(!isset($_SESSION['is_logged_in'])) : header('Location: '.ROOT_URL); ?>
<?php else : ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Raporty</h3>
  </div>
  <div class="panel-body">
  <form class="form_add_visit" action="<?php $_SERVER['PHP_SELF']; ?>raport/download" method="post">
  	<div class="form-group">
	  <label>Imię i Nazwisko</label>
	  <input autocomplete="off" id="raport_username" type="text" oninput="peopleSuggests('#raport_username');" name="raport_username" placeholder="Nazwa" class="form-control">
	</div>
	<div class="form-group">
		<label>Nazwa przejścia/drzwi</label>
	  	<input autocomplete="off" type="text" id="raport_doorname" oninput="doorSuggests();" name="raport_doorname" placeholder="Nazwa drzwi" class="form-control">
	</div>
	<div class="form-group">
		<label>Rodzaj zdarzenia</label>
    	<select name="event" id="event" class="form-control">
			<option value="all" selected>Wszystko</option>
			<option value="hours">Godziny</option>
			<option value="alarms">Alarmy</option>
			<option value="access">Dostęp</option>
		</select>
	</div>
	<div id="date" class="form-group">
		<div class="date_container">
			<label class="date_label">Data od</label>
			<div id="date_start"></div>
			<input readonly="readonly" id="date_start_input"  type="text" name="start" class="form-control" required>
		</div>
		<div class="date_container">
			<label class="date_label" >Data do</label>
			<div id="date_end"></div>
    		<input readonly="readonly" id="date_end_input" type="text" name="end" class="form-control date" required>
		</div>
	</div>
          <div class="btn_wrap">
			<input class="btn btn-primary" name="submit" type="submit" value="Generuj raport" />
			<?php if(isset($_SESSION['filename']) && file_exists($_SESSION['filename'])) : ?>
			<a href="<?php echo $_SESSION['filename']; ?>" download >Pobierz</a>
			<?php endif; ?>
          </div>
        </form>
  </div>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
	$(document).ready(function() {
    $("#date_start").datepicker({
        altField: "#date_start_input",
        altFormat: "dd-mm-yy"
    })
    .datepicker("setDate", new Date());

    let date3 = $('#date_start').datepicker('getDate');
    date3.setDate(date3.getDate() + 1);
    
    $('#date_end').datepicker({
        altField: "#date_end_input",
        altFormat: "dd-mm-yy"})
        .datepicker('setDate',date3);
});
});
</script>
<?php endif; ?>