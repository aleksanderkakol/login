<div class="visit-history">
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>visit/add">Dodaj wizytę</a>
	<a class="btn btn-success btn-share pull-right" href="<?php echo ROOT_PATH; ?>visit">Aktualne wizyty</a>
	<h2 class="text-center">Historia wizyt</h2>
	<div class="form-group wrapper col-xs-12">
		<div class="date_history col-xs-4 col-xs-offset-4">
			<div id="date"></div>
			<input id="date_input" type="text" name="date" class="form-control text-center" required>
		</div>
	</div>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
	$(document).ready(function() {

		toAppend = (item) =>
		{
			try{
				return `
				<div style="overflow:hidden;" class="panel panel-default">
					<div class="cursor panel-heading row">
						<span class="col-xs-4">Karta Gość ${item['vcard_id']}</span>
						<span class="col-xs-4" > Wejście ${item['ts1']}</span>
						<span class="col-xs-4"> Wyjście ${item['ts2']}</span>
					</div>
					<div style="max-height:100%;" class="panel-body row ">
						<div class="col-xs-4">
						<label>Imię i nazwisko</label>
						<p class="panel">${item['name11']}</p>
					</div>
					<div class="col-xs-4">
						<label>Firma/Instytucja</label>
						<p class="panel">${item['nadmiar1']}</p>
					</div>
					<div class="col-xs-4">
						<label>Zapraszający</label>
						<p class="panel">${item['name21']}</p>
					</div>
					<div class="col-xs-4">
						<label>Data wejścia</label>
						<p class="panel">${item['ts1']}</p>
					</div>
					<div class="col-xs-4">
						<label>Data wyjścia</label>
						<p class="panel">${item['ts2']}</p>
					</div>
					<div class="col-xs-4">
						<label>Typ dokumentu</label>
						<p class="panel">${item['doctype_name']}</p>
					</div>
					<div class="col-xs-4">
						<label>Numer dokumentu</label>
						<p class="panel">${item['doc_num']}</p>
					</div>
					<div class="col-xs-4">
						<label>Liczba wprowadzanych osób</label>
						<p class="panel">${item['nadmiar3']}</p>
					</div>
					<div class="col-xs-4">
						<label>Dodatkowy opis</label>
						<p class="panel">${item['nadmiar2']}</p>
					</div>
				</div>`;
			} catch(error) {
				return `<div style="overflow:hidden;" class="panel panel-default"><h3 class='text-center'>${error}</h3></div>`;
			}
		}

		selected_date = (date) =>{
		$.ajax({
			type: "post",
        	url: "/visit/date",
        	dataType: "json",
        	data: {
				date: date
        	},
        	success: function(e, n) {
				$(".panel").remove();
				if(e.length<1){
					return $(".visit-history").append(`<div style="overflow:hidden;" class="panel panel-default"><h3 class='text-center'>Brak wpisów</h3></div>`);
				}
				e.forEach((item)=>{
					$(".visit-history").append(toAppend(item));
				});
				$('.panel-body').css('display','none');
				$('.panel-heading').on('click',function(e){
				e.preventDefault();
				e.stopPropagation();
				let $body = $(this).next('.panel-body');
				$body.slideToggle(300);
				});
			},
        	error: function(e, n, t) {
            	console.log(e), console.log(n), console.log(t);
				return $(".visit-history").append(`<div style="overflow:hidden;" class="panel panel-default"><h3 class='text-center'>Błąd połączenia</h3></div>`);
        	},
        	complete: function(o, e) {
			}
		});
	}

		$("#date").datepicker({
			dateFormat: "yy-mm-dd",
			altField: "#date_input",
        	altFormat: "yy-mm-dd",
			onSelect: function(dateText){
				selected_date(dateText);
			}
		})
		.datepicker("setDate", new Date());

		$("#date_input").on("change",function(e){
			selected_date($(this).val());
		});
	});
});
</script>