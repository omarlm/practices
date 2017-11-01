  
<?php
    // Establecemos la conexión a la base de datos
    $dbsystem='mysql';
    $host='localhost';
    $dbname='dwes';
    $dsn = "$dbsystem:host=$host;dbname=$dbname";
    $username='dwes';
    $password='abc123';
    $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

    try {
        $dbh = new PDO($dsn, $username, $password, $option);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo $e->getMessage();
    }
?>