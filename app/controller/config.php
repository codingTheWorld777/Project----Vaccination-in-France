
<!-- ----- debut config -->
<?php

// Utile pour le débugage car c'est un interrupteur pour les echos et print_r.
// Eviter de declarer plusieurs fois le const DEBUG
include_once 'debug.php';
include_once '../../vendor/autoload.php';

// Configuration de la base de données
//$dsn = 'mysql:dbname=nguyenh3;host=localhost;charset=utf8';
//$username = 'nguyenh3';
//$password = 'liy4X5sN';
//$username = 'root';
//$password = 'root';

// Configuration pour la connexion au serveur en ligne
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];  //host-server
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8;port=$port";

// chemin absolu vers le répertoire du projet SUR DEV-ISI 
$root = dirname(dirname(__DIR__)) . "/";

if (DEBUG) {
    echo ("<ul>");
    echo (" <li>dsn = $dsn</li>");
    echo (" <li>username = $username</li>");
    echo (" <li>password = $password</li>");
    echo ("<li>---</li>");
    echo (" <li>root = $root</li>");

    echo ("</ul>");
}

?>
<!-- ----- fin config -->



