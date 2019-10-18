<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Nowa wizyta</h3>
  </div>
  <div class="panel-body">
  <form class="form_add_visit" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	  <h3>Dodaj wizytę!</h3>
	  <div class="form-group">
		<label>Karta dla pracownika:</label>
    	<select id="to_employee" name="to_employee" class="form-control">
			<option value="false">Nie</option>
			<option value="true">Tak</option>
		</select>
	</div>
  	<div class="form-group">
	  <label>Imię i Nazwisko Gościa:</label>
	  <input id="name11" type="text" name="name11" placeholder="Nazwa gościa" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Firma/Instytucja:</label>
    	<input id="company" type="text" name="nadmiar1" placeholder="Firma/Instytucja" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Imię i Nazwisko odwiedzanego:</label>
    	<input id="name21" type="text" name="name21" oninput="peopleSuggests('#name21');" placeholder="Nazwa odwiedzanego"  class="form-control" required>
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
    	<input id="nadmiar3" type="number" name="nadmiar3" min="1" placeholder="Liczba wprowadzanych osób" class="form-control" required>
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
	
    const input_element = $('#name11')[0];
    const parent_element = $('#name11').parent();
    $(document).on("change", "#to_employee", function(event) {
		if ($(this).val() === 'true') {
			$('#name11').remove();
			$('#name21').parent().css('display','none');
			$("#name21").attr("disabled", true);
			$('#company').parent().css('display','none');
			$("#company").attr("disabled", true);
			$('#nadmiar3').parent().css('display','none');
			$("#nadmiar3").attr("disabled", true);
			$("<select id='select_name' class='form-control plate_user_name' name='name11'></select>").appendTo(parent_element);
			$.ajax({
            	type: "post",
            	url: "/www/visit/people",
				dataType: "json",
				success: function(e, t) {
					e.map((person) => {
						$(`<option value='${person}'>${person}</option>`).appendTo("#select_name")
					});
				},
				error: function(e, t, o) {
					console.log(e), console.log(t), console.log(o)
				},
				complete: function(e, t) {}
				})
            } else {
                $("#select_name").remove();
				$(input_element).appendTo(parent_element);
				$('#name21').parent().css('display','block');
				$("#name21").attr("disabled", false);
				$('#company').parent().css('display','block');
				$("#company").attr("disabled", false);
				$('#nadmiar3').parent().css('display','block');
				$("#nadmiar3").attr("disabled", false);
			}
            });
});
</script>
