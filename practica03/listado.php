<?php
 //Si la sesión no está activa, la iniciamos
 if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include ('DBconex.php');

if(!isset($_SESSION['MenuFamilias'])){ //Si la sesión está vacía, realizamos la consulta
    $_SESSION['MenuFamilias'] = array();
    $query = "SELECT * FROM familia ORDER BY nombre ASC";
    $result = $link->query($query) or die ('Consulta fallida: ' . $link->error);

    $MenuFamilias= array();
    $i = 0;

    foreach ($result as $col_value) { //Guardamos las familias en un array
        $MenuFamilias[$i] = $col_value['nombre'];
        $i++;
    }

    $_SESSION['MenuFamilias'] = $MenuFamilias; //Guardamos el array de familias en una variable de sesión
    $result->free(); //Liberamos el resultado
    include('DBdesconex.php'); //Cerramos la conexión a la base de datos 
}else{
    $MenuFamilias = $_SESSION['MenuFamilias'];
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Ejercicios Tema 3</title>
  <link href="dwes.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="contenido">
        <?php if(isset($_POST['SLCTfamilia'])): //Si la familia está definida y no es null, mostramos su información
            include ('DBconex.php');
            $familia = $_POST['SLCTfamilia'];
            $query = "SELECT nombre_corto, PVP FROM producto WHERE familia = '$familia' ORDER BY nombre_corto ASC";
            $result = $link->query($query) or die ('Consulta fallida: ' . $link->error);

        ?>
            <h2>Productos de la familia:<?= $familia?></h2>
            <table border='2'>
                <tr>
                    <td>Nombre</td><td>PVP</td>
                </tr>
                <?php while ($fila = $result->fetch()): ?> <!--// Mientras la fila no esté vacía -->
                        <tr>
                            <?php if(($fila['nombre_corto'] == "") || ($fila['PVP'] == null)):?>
                                <td>Desconocido</td>
                            <?php endif ?>
                            <td><?=$fila['nombre_corto']?></td>
                            <td><?=$fila['PVP']?></td>  
                        </tr>
                <?php endwhile;
                        $result->free_result();
                        include('DBdesconex.php');
                ?>
            </table>        
    </div>
        <?php elseif(!isset($_POST['SLCTfamilia'])): // Sino si la familia no está definida y es null, mostramos las familias
                $_SESSION['SLCTfamilia'] = null;
        ?>
                <div id="encabezado">
                    <h1>Tarea: Listado de productos de una familia</h1>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <label>Familia: </label>
                    <select name='SLCTfamilia'>;
                    <?php for ($i=0; $i<count($MenuFamilias); $i++): ?>
                            <option><?= $MenuFamilias[$i] ?></option>
                    <?php endfor; ?>
                    </select>
                    <input type="submit" value='Mostrar Productos'/>
                    </form>        
                </div>
        <?php endif;?>

<div id="pie">
</div>
</body>
</html>