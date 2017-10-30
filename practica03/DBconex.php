<?php      
//Acceso a la base de datos usando PDO
$dbsystem='mysql';
$host='localhost';
$dbname='dwes';
$dsn = "$dbsystem:host=$host;dbname=$dbname";
$username='dwes';
$password='abc123';
$option = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8");

try {
    $dbh = new PDO($dsn, $username, $password, $option);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo $e->getMessage();
}


//$link = new PDO("mysql:host=localhost;dbname=dwes", "dwes", "abc123");


/* Acceso a la base de datos usando MYSQLi
$link = new mysqli('localhost','dwes', 'abc123', 'dwes')
        or die('No se puede conectar: ' .$link->connect_error);

$link->set_charset('utf8'); */

?>