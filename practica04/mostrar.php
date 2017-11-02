<?php 
// Si la sesión no está activa, iniciamos la sesión
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_POST['closeSession'])){ // Si pulsa cerrar sesión
    $preferences = null;
    session_unset();   // Destruimos las variables de sesión
    session_destroy(); // Destruimos finalmente la información de la sesión
}else{
    // Recogemos las preferencias del usuario desde la sesión 
    $preferences = $_SESSION['preferences'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DWES04 Sesiones</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <legend>Preferencias</legend>
            <label class="etiqueta">Idioma:</label><br/>
            <label class="texto"><?= $preferences['language']; ?></label><br/><br/>
            <label class="etiqueta">Perfil público:</label><br/>
            <label class="texto"><?= $preferences['profile']; ?></label><br/><br/>
            <label class="etiqueta">Zona horaria:</label><br/>
            <label class="texto"><?= $preferences['timezone']; ?></label><br/>
            <br/><br/>
            <input type="submit" name="closeSession" value="Borrar preferencias"/>
            <br/><br/>
            <a href="preferencias.php">Establecer preferencias</a>
        </fieldset>
    </form>
</body>

</html>