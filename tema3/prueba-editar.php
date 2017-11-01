<?php

 //Si la sesión no está activa, la iniciamos
 if(session_status() == PHP_SESSION_NONE){
    session_start();
}


//Incluimos el fichero de la conexión a la base de datos
include('prueba-dbconex-PDO.php');

//Recogemos el código del producto a editar
$codProduct =  $_POST['codProduct'];

// FETCH_ASSOC preparamos la consulta
$consultation = $dbh->prepare("SELECT cod, nombre_corto, nombre, descripcion, PVP FROM producto WHERE cod = ? ORDER BY nombre_corto ASC");
// Especificamos el fetch mode (tipo de array) antes de llamar a fetch()
$consultation->setFetchMode(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio Tema 3</title>
    <link href="dwes.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="encabezado"> 
        <h1>Tarea: Edición de un producto</h1> 
    </div>
    <div id="contenido">
        <h2>Producto:</h2>
        <form method="post" name="formEdit" action="prueba-actualizar.php">
            <?php if($consultation->execute(array($_POST['codProduct']))):?>
                <?php while($row = $consultation->fetch()):?>
                <!--Controlar si algún campo está vacío para mostrar un "Desconocido u otra cosa" (valor añadido)-->
                    <label>Nombre corto:</label>
                    <input type="text" name="shortName" size=50 value="<?=$row['nombre_corto']?>"/><br/><br>
                    <label>Nombre:</label>
                    <textarea name="name" cols="50" rows="auto"><?=$row['nombre']?></textarea><br/><br>
                    <label>Descripción:</label>
                    <textarea name="description" cols="50" rows="auto" style="overflow-y:scroll;"><?php echo $row['descripcion']?></textarea><br/><br/>
                    <label>PVP:</label>
                    <input type="text" name="pvp" size=10 value="<?=$row['PVP']?>"/><br/><br/>
                <?php endwhile; ?>
            <?php endif;?>
                    <button type="submit" name="btn-update">Actualizar</button>
                    <button type="submit" name="btn-cancel">Cancelar</button>
        </form>
    </div>
    <div id="pie"></div>
</body>
</html>