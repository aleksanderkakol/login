<?php if(!isset($_SESSION['is_logged_in'])) : header('Location: '.ROOT_URL); ?>
<?php else : ?>
<?php
$teams = array(
	"DN" => "Prezes Zarządu", 
	"DT" => "Członek Zarządu ds. Technicznych", 
	"DE" => "Członek Zarządu ds. Ekonomicznych", 
	"DF" => "Dział Finansowo-Księgowy",
	"DP" => "Dyrektor ds. Eksploatacji",
	"DG" => "Dyrektor ds. Energetycznych i Utrzymiania Ruchu",
	"DR" => "Pełnomocnik Zarządu ds. Media Relations",
	"EU" => "Dział Umów i Zamówień Publicznych",
	"ED" => "Dyspozytornia", 
	"EM" => "Zespół Mechanicznego Oczyszczania Ścieków", 
	"EB" => "Zespół Biologicznego Oczyszczania Ścieków", 
	"EO" => "Zespół Przeróbki Osadu", 
	"EG" => "Zespół Obsługi Biogazu",
	"FK" => "Zespół kontrolingu",
	"IR" => "Zespół Ds. Rozwoju i Marketingu", 
	"II" => "Zespół Ds. Przygotowania i Prowadzenia Inwestycji",
	"LB" => "Laboratorium Badawcze", 
	"LP" => "Zespół Pobierania Próbek",
	"ME" => "Zespół Elektroenergetyczny", 
	"MA" => "Zespół Automatyki", 
	"MM" => "Zespół Mechaniczny", 
	"MT" => "Zespół Transportu", 
	"MB" => "Zespół Budowlany", 
	"MI" => "Zespół Informatyczny i Systemów Sterowania", 
	"NK" => "Dział Zarządzania Zasobami Ludzkimi", 
	"NI" => "Dział Inwestycji i Rozwoju", 
	"NA" => "Stanowisko ds. Analizy Ryzyka", 
	"NB" => "Stanowisko ds. BHP", 
	"NZ" => "Zespół ds. Kontroli Zarządczej", 
	"NS" => "Informatyk-ASI", 
	"ND" => "Inspektor ds. Ochrony Danych Osobowych",  
	"NO" => "Dział Organizacyjny",
	"NR" => "Radca Prawny",
	"OE" => "Sekretariat", 
	"OZ" => "Zespół Ds. Zaopatrzenia", 
	"OA" => "Zespół Ds. Administracyjno-majątkowych i Ubezpieczeń", 
	"OR" => "Zespół Ds. Public Relations", 
	"OS" => "Zespół Ds. Socjalnych i Archiwum", 
	"OM" => "Magazyny", 
	"OG" => "Zespół Gospodarczy",
	"PE" => "Dział Eksploatacji", 
	"PT" => "Dział Technologiczny i Ochrony Środowiska", 
	"PS" => "Dział Obsługi ITPO",
	"TL" => "Laboratorium",  
	"TM" => "Dział Utrzymania Ruchu", 
	"TR" => "Zespół Produkcji Energii", 
	"TI" => "Zespół Inżynieryjno-Techniczny"
);
?>
<div style="display: flex;flex-wrap: wrap;">
	<?php foreach($teams as $key => $team) : ?>
		<div class="ajax panel panel-default col-xs-4">
			<div class="panel-heading row"><?php echo $team; ?></div>
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Nazwa</th>
							<th>Użycie Karty</th>
						</tr>
					</thead>
					<tbody class=<?php echo $key; ?>>
					</tbody>
				</table>
			</div>
		</div>
		<?php endforeach; ?>
		<div class="ajax panel panel-default col-xs-12">
		<div class="panel-heading row">Pozostali</div>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Imię i Nazwisko</th>
						<th>Ostatnie użycie Karty</th>
						<th>Ilość wprowadzanych osób</th>
					</tr>
				</thead>
				<tbody class="others">
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>

<script>
window.addEventListener('DOMContentLoaded', (event) => {
	getUsers();
	$(document).ready(function() {
		$('.panel-body').hide();
		$('.panel-heading').click(function(e){
			var $this = $(this).parent().find('.panel-body');
			$this.slideToggle(300);
		})
	});
});
</script>