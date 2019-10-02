<?php if (!isset($_SERVER['HTTP_ACCEPT_ENCODING'])) {
    ob_start();            
}
elseif (strpos(' ' . $_SERVER['HTTP_ACCEPT_ENCODING'], 'x-gzip') == false) {
    if (strpos(' ' . $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') == false) {
        ob_start();
    }
    elseif(!ob_start("ob_gzhandler")) {
        ob_start();
    }   
}
elseif(!ob_start("ob_gzhandler")) {
    ob_start();
} ?>
<?php
//Start Session
session_start();
// Include Config
require('config.php');

spl_autoload_register ( function ($class) {
    $sources = array("controllers/$class.php", "classes/$class.php ",  "models/$class.php " );
        foreach ($sources as $source) {
            if (file_exists($source)) {
                require_once $source;
            } 
        } 
    });

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}
