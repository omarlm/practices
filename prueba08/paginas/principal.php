<?php
    // Incluimos la conexión a la BBDD
    include('../include/DBconex.php');
?>
<!DOCTYPE html>
<html lang="es">
<?php include_once('../templates/head.html') ?>
<body>
    <?php include_once('../templates/nav.html') ?>
    <div class="container"><!--Contenedor principal: englobal todo -->
        <div class="container-fluid">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label>Municipios: </label>
                <select class="custom-select" name='SLCTmunicipio' onchange='this.form.submit()'>
                    <option selected>Seleccione un municipio</option>
                    <?php while($row = $consultation->fetch()):?>
                            <option value="<?=$row['idMunicipio'] ."/". $row['nombreMun'] ?>"><?=$row['nombreMun']?></option>
                    <?php endwhile; ?>
                </select>
               <!-- <input class="btn btn-outline-primary" type="submit" value="Ver playas"/>-->
            </form>
        <?php if(isset($_POST['SLCTmunicipio'])) ://Si selecciona un municipio, incluimos sus playas
            include_once('../include/cards-playas.php')?>
        <?php endif ?>
        </div><!--Fin container-->
    </div><!--Fin container fluid-->
</body>
</html>