<?php
require("../config.php");
header('Content-Type: text/xml');
echo "<?xml version='1.0' encoding='UTF-8' ?>";
try {
        $dbh = new PDO("pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS);
        if($dbh) {
                echo "<status><status>200</status></status>";
        }
} catch (PDOException $e){
        echo "<status><status>400</status></status>";
}
?>