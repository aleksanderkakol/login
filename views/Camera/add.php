<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Nowa tablica rejestracyjna pojazdu</h3>
  </div>
  <div class="panel-body">
	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
	<div class="form-group">
		<label>Wjazd dla pracownika</label>
    	<select id="to_employee" name="to_employee" class="form-control">
			<option value="false">Nie</option>
			<option value="true">Tak</option>
		</select>
	</div>
    	<div class="form-group">
    		<label>Imię i Nazwisko</label>
    		<input id="lpr_name" placeholder="Imię i Nazwisko" type="text" name="lpr_name" class="form-control" required />
		</div>
		<div class="form-group">
    		<label>Firma</label>
    		<input id="company_name" placeholder="Nazwa firmy" type="text" name="company_name" class="form-control" />
		</div>
		<div class="form-group">
    		<label>Marka pojazdu</label>
    		<input id="car_name" placeholder="Marka pojazdu" type="text" name="car_name" class="form-control" />
    	</div>
    	<div class="form-group">
    		<label>Numer tablicy pojazdu</label>
    		<input placeholder="Numer rejestracyjny" type="text" name="lpr_plate" class="form-control" required />
    	</div>
    	<div class="form-group">
			<label>Pozwolenie na wjazd</label>
			<select class="form-control" name="lpr_on_whitelist" id="lpr_whlist" required>
				<option value="true">Tak</option>
				<option value="false">Nie</option>
			</select>
		</div>
		<div class="form-group">
    		<label>Brama</label>
    		<input id="gate_name" placeholder="Nazwa bramy" type="text" name="gate_name" class="form-control" required />
		</div>
		<div id="date" class="form-group">
		<div class="date_container">
			<label class="date_label">Wjazd ważny do</label>
			<div id="valid_to"></div>
			<input id="valid_to_input"  type="text" name="valid_to" class="form-control" required>
		</div>
	</div>
		<a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>camera">Cofnij</a>
    	<input class="btn btn-primary" name="submit" type="submit" value="Dodaj" />
    </form>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
	const input_element = $('#lpr_name')[0];
	const parent_element = $('#lpr_name').parent();
	const company_input_element = $('#company_name')[0];
	const company_parent_element = $('#company_name').parent();
	const company_label_element = $('#company_name').prev();
	$(document).on("change", "#to_employee", function(event) {
		if ($(this).val() === 'true') {
			$('#lpr_name').remove();
			$('#company_name').remove();
			$(company_label_element).remove();
			$("<select id='select_name' class='form-control plate_user_name' name='lpr_name'></select>").appendTo(parent_element);
			$.ajax({
            	type: "post",
            	url: "/ajax/people",
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
				$(company_label_element).appendTo(company_parent_element);
				$(company_input_element).appendTo(company_parent_element);
			}
		});

		$("#valid_to").datepicker({
			altField: "#valid_to_input",
        	altFormat: "yy-mm-dd"
		})
		.datepicker("setDate", new Date());
});
</script>