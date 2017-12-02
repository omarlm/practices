<?php
    include('../include/DBconex.php');// Incluimos la conexión a la BBDD
    if(session_status() == PHP_SESSION_NONE){// Si la sesión no está activa, la iniciamos
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="es">
<?php include_once('../templates/head.html') ?>
<body>
    <div class="container-fluid">
        <?php include_once('../templates/nav.html') ?>
        <div class="container">
            <!-- SELECCIÓN DE MUNICIPIOS -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label>Municipios: </label>
                <select class="custom-select" name='SLCTmunicipio'>;
                    <option selected>Seleccione un municipio</option>
                    <?php while($row = $consultation->fetch()):?>
                            <option value="<?=$row['idMunicipio']?>"><?=$row['nombreMun']?></option>
                    <?php endwhile; ?>
                </select>
                <input class="btn btn-outline-primary" type="submit" value="Ver playas"/>
            </form>
            <!-- Incluimos las playas del municipio seleccionado -->
            <?php include_once('../include/tabla-playas.php') ?>
        </div>
    </div>
</body>
</html>