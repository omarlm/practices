<?php 
//Si pulsa el botón de actualizar
if(isset($_POST['btn-update'])){

    //Recogemos los datos del formulario, incluido el del campo oculto
    $codProduct = $_POST['codProduct'];
    $shortName = $_POST['shortName'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $pvp = $_POST['pvp'];
    $pvp = floatval($pvp);
    
    //Incluimos el fichero de la conexión a la base de datos
    include('DBconex.php');

    // Preparamos la consulta
    try{
        $consultation = $dbh->prepare("UPDATE producto SET nombre_corto = ?, nombre = ?, descripcion = ?, PVP = ? WHERE cod = ?");
        // Establecemos los parámetros y ejecutamos la consulta
        if($consultation->execute(array($shortName, $name, $description, $pvp, $codProduct))){
            // Mensaje de éxito en la inserción
            $message = "Se han actualizado los datos";
        }
    }catch(Exception $e){
        die("Ups! Parece que ha habido un error en la consulta... Inténtelo de nuevo, más tarde");
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tarea 3 - Actualizar </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="dwes.css" rel="stylesheet" type="text/css">
</head>
<body>
<p><?=$message?></p>
<button onClick="document.location.href='listado.php'">Continuar</button>
</body>
</html>

