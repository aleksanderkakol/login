<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Zew</title>
  <link rel="shortcut icon" href="<?php echo ROOT_PATH; ?>favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/style.css">
</head>
<body>
	<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">Liczba osób: ......</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
					<?php if(isset($_SESSION['is_logged_in'])) : ?>
          <ul class="nav navbar-nav">
            <li><a id="zewng" href="">Wizualizacja KD</a></li>
            <li><a href="<?php echo SALTO_URL; ?>" target="blank">Zarządzanie KD</a></li>
            <li><a href="<?php echo ROOT_URL; ?>visit">Obsługa gości</a></li>
            <li><a href="<?php echo ROOT_URL; ?>raport">Raporty</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo ROOT_URL; ?>users">Użytkownicy</a></li>
	          <li><a href="<?php echo ROOT_URL; ?>">Witaj <?php echo $_SESSION['user_data']['login']; ?></a></li>
	          <li><a href="<?php echo ROOT_URL; ?>logout">Wyloguj</a></li>
          </ul>
            <?php else : ?>
            <ul class="nav navbar-nav">
              <li><a id="zewng" href="">Wizualizacja KD</a></li>
              <li><a href="<?php echo SALTO_URL; ?>" target="blank">Zarządzanie KD</a></li>
            </ul>
						<?php endif; ?>
        </div>
      </div>
    </nav>

    <div class="container">
     <div class="row">
			 <?php Messages::display(); ?>
     	<?php require($view); ?>
     </div>
    </div>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/js/script.js"></script>
</body>
</html>
