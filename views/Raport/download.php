<?php 
unset($_SESSION['filename']);
$start = $_POST['start'];
$end = $_POST['end'];

if($_POST['raport_username'] === '') {
	$username = 'wszystkich użytkowników';
} else {
	$username = $_POST['raport_username'];
}

if($_POST['raport_doorname'] === '') {
	$doorname = 'wszystkich drzwi';
} else {
	$doorname = 'drzwi '.$_POST['raport_doorname'];
}

if($_POST['event'] === 'hours') {
	$event = 'godzin';
} else if($_POST['event'] === 'alarms') {
	$event = 'alarmow';
} else if($_POST['event'] === 'access') {
	$event = 'dostepu';
} else if($_POST['event'] === 'all') {
	$event = '';
}


if (strpos($username, '?') == true) {
	$username = str_replace('?', 'o', $username);
}
if (strpos($username, '/') == true) {
	$username = str_replace('/', '_', $username);
}

if (strpos($doorname, '?') == true) {
	$doorname = str_replace('?', 'o', $doorname);
}
if (strpos($doorname, '/') == true) {
	$doorname = str_replace('/', '_', $doorname);
}

if($viewmodel){
	$filename = 'raporty\Raport '.$event.' dla '.$username.' i '.$doorname.' '.$start.' '.$end.'.csv';
	$_SESSION['filename'] = $filename;
	$head = fopen($filename, 'w');
	$headers = $viewmodel;
	fputcsv($head, array_keys($headers['0']));
	fclose($head);
	$data = fopen($filename, 'a');
	foreach($viewmodel as $item) {
		fputcsv($data, $item, ';');
	}
	fclose($data);
}
header('Location: '.ROOT_URL.'raport');
?>