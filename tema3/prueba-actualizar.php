<?php 

//Si la sesión no está activa, la iniciamos
 if(session_status() == PHP_SESSION_NONE){
    session_start();
}
//Si pulsa el botón de actualizar
if(isset($_POST['btn-udpate'])){

    //Recogemos los datos del formulario
    $shorName = $_POST['shortName'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $pvp = $_POST['pvp'];
    
    //Incluimos el fichero de la conexión a la base de datos
    include('prueba-dbconex-PDO.php');

    // Preparamos la consulta
    $consultation = $dbh->prepare("INSERT INTO producto (nombre_corto, nombre, descripcion, PVP) VALUES (:nombre_corto, :nombre, :descripcion, :PVP)");
    
    // Establecemos los parámetros y ejecutamos 
    $consultation->bindParam(':nombre_corto', $shorName);
    $consultation->bindParam(':nombre', $name);
    $consultation->bindParam(':descripcion', $description);
    $consultation->bindParam(':PVP', $pvp);  
    $consultation->execute();

    // Mensaje de éxito en la inserción
    echo "Se han actualizado los datos";

    // Cerramos conexión
    $dbh = null;

}









?>