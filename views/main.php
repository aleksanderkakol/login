<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="shortcut icon" href="<?php echo ROOT_PATH; ?>favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/style.css">
</head>
<body>
  <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['user_data']['level'] >= ADMIN_LEVEL) : ?>
    <?php require('nav/admin.php'); ?>
  <?php elseif(isset($_SESSION['is_logged_in']) && $_SESSION['user_data']['level'] < ADMIN_LEVEL && $_SESSION['user_data']['level'] > DYSPOZYTOR) : ?>
    <?php require('nav/user.php'); ?>
  <?php elseif(isset($_SESSION['is_logged_in']) && $_SESSION['user_data']['level'] <= DYSPOZYTOR) : ?>
    <?php require('nav/guest.php'); ?>
  <?php else : ?>
    <?php require('nav/basic.php'); ?>
  <?php endif; ?>
  <div class="content container">
    <div class="row">
      
      <?php if(!strpos($_SERVER['REQUEST_URI'], 'login') && $_SERVER['REQUEST_URI']!=ROOT_PATH) :?>
        <a style="margin-bottom:20px;" class="btn btn-info" href="<?php echo ROOT_URL;?>login"><i class="glyphicon glyphicon-home"></i> Strona główna</a>
      <?php endif; ?>
      <?php Messages::display(); ?>
      <?php require($view); ?>
      <?php unset($_SESSION['errorMsg']); ?>
    </div>
  </div>
  <div class="footer-nav">
    <img src="<?php echo ROOT_PATH; ?>logo.png" alt=logo.net" style="width:100px;height:33px;">
    <div class="footer_logo">© Wszystkie prawa zastrzeżone</div>
  </div>
  <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets/js/script.js"></script>
</body>
</html>
