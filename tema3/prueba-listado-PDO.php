<?php
 //Si la sesión no está activa, la iniciamos
 if(session_status() == PHP_SESSION_NONE){
    session_start();
}

//Incluimos el fichero de la conexión a la base de datos
include('prueba-dbconex-PDO.php');
// FETCH_ASSOC preparamos la consulta
$consultation = $dbh->prepare("SELECT * FROM familia ORDER BY nombre ASC");
// Especificamos el fetch mode (tipo de array) antes de llamar a fetch()
$consultation->setFetchMode(PDO::FETCH_ASSOC);
// Ejecutamos la consulta
$consultation->execute();

//Liberamos  la conexión con el servidor
//$consultation->closeCursor();
//Incluimos el fichero de desconexión a la base de datos
//include('DBdesconex.php');
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba_T3</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="dwes.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="encabezado">
        <h1>Tarea: Listado de productos de una familia</h1>
    </div>
    <div id="contenido">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label>Familia: </label>
        <select name='SLCTfamilia'>;
            <?php while($row = $consultation->fetch()):?>
                    <option value="<?=$row['cod']?>"><?=$row['nombre']?></option>
            <?php endwhile; ?>
        </select>
        <input type="submit" value='Mostrar Productos' />
    </form>
        <?php if(isset($_POST['SLCTfamilia'])):  //Sino si la familia está definida, mostramos sus productos
            include('prueba-dbconex-PDO.php');
            $family = $_POST['SLCTfamilia'];
            $consultation = $dbh->prepare("SELECT nombre_corto, PVP FROM producto WHERE familia = ? ORDER BY nombre_corto ASC");
            $consultation->setFetchMode(PDO::FETCH_ASSOC);
                if($consultation->execute(array($_POST['SLCTfamilia']))):?>
                    <h2>Productos de la familia: <?= $family?></h2>
                    <hr>
                    <?php while($row = $consultation->fetch()):?>
                            <p><span><?=$row['nombre_corto']?></span>: <?=$row['PVP']?>€<button type="button" name="btn-edit">Editar</button></p>
                    <?php endwhile?>
                <?php endif; ?>
        <?php endif;?>
    </div>
    <div id="pie">
    </div>
</body>
</html>