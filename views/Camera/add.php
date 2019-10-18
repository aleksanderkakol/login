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
    		<input id="lpr_name" placeholder="Imię i Nazwisko" type="text" name="lpr_name" class="form-control" />
    	</div>
    	<div class="form-group">
    		<label>Numer tablicy pojazdu</label>
    		<input placeholder="Numer rejestracyjny" type="text" name="lpr_plate" class="form-control" />
    	</div>
    	<div class="form-group">
			<label>Pozwolenie na wjazd</label>
			<select class="form-control" name="lpr_on_whitelist" id="lpr_whlist">
				<option value="true">Tak</option>
				<option value="false">Nie</option>
			</select>
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Dodaj" />
        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>camera">Anuluj</a>
    </form>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
	const input_element = $('#lpr_name')[0];
    const parent_element = $('#lpr_name').parent();
	$(document).on("change", "#to_employee", function(event) {
		if ($(this).val() === 'true') {
			$('#lpr_name').remove();
			$("<select id='select_name' class='form-control plate_user_name' name='lpr_name'></select>").appendTo(parent_element);
			$.ajax({
            	type: "post",
            	url: "/www/camera/people",
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
			}
			});
});
</script>