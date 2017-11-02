<?php 
//Si la sesión no está activa, iniciamos la sesión
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$message = null;

// Si envía el formulario, almacenamos los datos 
if(isset($_POST['submit'])){ 

    // Si la sesión 'preferencias' no existe, la creamos y la inicializamos 
    if(!isset($_SESSION['preferences'])){ 
        $_SESSION['preferences'] = array();
    }

    // Recogemos las preferencias del usuario
    $langague = $_POST['SLCTidioms'];
    $profile = $_POST['SLCTprofile'];
    $timezone = $_POST['SLCTtimezone'];

    // Pasamos las preferencias a un array asociativo (clave => valor)
    $preferences = array("language" => $langague, "profile" => $profile, "timezone" => $timezone);

    // Almacenamos el array de preferencias de usuario en una variable de sesión
    $_SESSION['preferences'] = $preferences;
    
    // Almacenamos el mensaje a mostrar una vez establecida las preferencias 
    $message = "Información guardada en la sesión";

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
    <!--Una vez establecidas las preferencias, deben estar seleccionadas como variables por defecto en los tres cuadros desplegables-->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <legend>Preferencias</legend>
            <span class="mensaje"><?= $message ?></span>
            <label class="etiqueta">Idioma:</label>
            <select name="SLCTidioms">
                <option value="español">español</option>
                <option value="inglés">inglés</option>
            </select>
            <label class="etiqueta">Perfil público:</label>
            <select name="SLCTprofile">
                <option value="sí">sí</option>
                <option value="no">no</option>
            </select>
            <label class="etiqueta">Zona horaria:</label>
            <select name="SLCTtimezone">
                <option value="GMT-1">GMT-1</option>
                <option value="GMT-2">GMT-2</option>
                <option value="GMT">GMT</option>
                <option value="GMT+1">GMT+1</option>
                <option value="GMT+2">GMT+2</option>
            </select>
            <br/>
            <br/><br/>
            <input type="submit" name="submit" value="Establecer preferencias"/>
            <br/><br/>
            <a href="mostrar.php">Mostrar preferencias</a>
        </fieldset>
    </form>
</body>

</html>