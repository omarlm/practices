<?php

if(!isset($_POST['btn-verDetalles'])){ // Si intentan acceder sin pulsar ver-detalles
    header("Location:../index.php"); //Redireccionamos a la página principal
}else{
    //Recogemos los datos de la playa a mostrar
    $nombrePlaya = $_POST['nombre'];
    $idPlaya = $_POST['idPlaya'];
    $direccion = $_POST['direccion'];
    $descripcion = $_POST['descripcion'];
    $idMun = $_POST['idMun'];
    $playaSize = $_POST['playaSize'];
    $longitud = $_POST['latitud'];
    $latitud = $_POST['longitud'];
    $imagen = base64_encode($_POST['imagen']);
    $nombreMun = $_POST['nombreMun'];

}

?>