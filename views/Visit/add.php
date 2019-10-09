<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Nowa wizyta</h3>
  </div>
  <div class="panel-body">
  <form class="form_add_visit" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	  <h3>Dodaj wizytę!</h3>
	  <div class="form-group">
		<label>Karta dla pracownika:</label>
    	<select name="to_employee" class="form-control">
			<option value="false">Nie</option>
			<option value="true">Tak</option>
		</select>
	</div>
  	<div class="form-group">
	  <label>Imię i Nazwisko Gościa:</label>
	  <input type="text" name="name11" placeholder="Nazwa gościa" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Firma/Instytucja:</label>
    	<input id="company" type="text" name="nadmiar1" placeholder="Firma/Instytucja" class="form-control">
	</div>
	<div class="form-group">
		<label>Imię i Nazwisko odwiedzanego:</label>
    	<input type="text" name="name21" placeholder="Nazwa odwiedzanego"  class="form-control" required>
	</div>
	<div class="form-group">
		<label>Dokument:</label>
    	<select name="doctype_id" id="doctype" class="form-control">
		</select>
	</div>
	<div class="form-group">
		<label>Numer dokumentu:</label>
    	<input type="text" name="doc_num" placeholder="Numer dokumentu" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Liczba wprowadzonych osób:</label>
    	<input type="number" name="nadmiar3" min="1" placeholder="Liczba wprowadzanych osób" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Numer karty:</label>
    	<select name="vcard_id" id="card_id" class="form-control" required>
		</select>
	</div>
	<div class="form-group">
		<label>Dodatkowy opis:</label>
    	<input type="text" name="nadmiar2" placeholder="Dodatkowe informacje" class="form-control">
	</div>
          <div class="btn_wrap">
		  	<a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>visit">Anuluj</a>
            <input class="btn btn-primary" name="submit" type="submit" value="Dodaj wizytę" />
          </div>
        </form>
  </div>
</div>

<script>
window.addEventListener('DOMContentLoaded', (event) => {
	getVisitorCards();
});
</script>
