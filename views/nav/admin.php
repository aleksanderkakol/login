<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo ROOT_URL; ?>lista">Liczba osób: ......</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a id="zewng" href="zewng:">Wizualizacja</a></li>
                <li><a href="<?php echo SALTO_URL; ?>" target="blank">Zarządzanie KD</a></li>
                <li><a href="<?php echo ROOT_URL; ?>visit">Obsługa gości</a></li>
                <li><a href="<?php echo ROOT_URL; ?>camera">Lista tablic</a></li>
                <li><a href="<?php echo ROOT_URL; ?>raport">Raporty</a></li>
                <li><a id="photos" href="<?php echo ROOT_URL; ?>photos?page=1">Zdjęcia</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo ROOT_URL; ?>users">Użytkownicy</a></li>
                <li><a href="<?php echo ROOT_URL; ?>">Witaj <?php echo $_SESSION['user_data']['login']; ?></a></li>
                <li><a href="<?php echo ROOT_URL; ?>logout">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</nav>