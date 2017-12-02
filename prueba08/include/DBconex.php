  
<?php

    // Establecemos la conexión a la base de datos
    $dbsystem='mysql';
    $host='localhost';
    $dbname='playasdb';
    $dsn = "$dbsystem:host=$host;dbname=$dbname";
    $username='dwes';
    $password='abc123';
    $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

    //Conectamos con la BBDD
    try {
        $dbh = new PDO($dsn, $username, $password, $option);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo $e->getMessage();
    }

    // Preparamos la consulta
    try{
        $consultation = $dbh->prepare("SELECT idMunicipio, nombreMun FROM municipio ORDER BY nombreMun ASC");
        // Especificamos el fetch mode (tipo de array) antes de llamar a fetch()
        $consultation->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos la consulta
        $consultation->execute();
    }catch(Exception $e){
            die("Ups! Parece que ha habido un error en la consulta... Inténtelo de nuevo, más tarde");
    }
?>