<?php include('../include/data-info-playa.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('../templates/head.html') ?>
<body>
<?php include_once('../templates/nav.html') ?>
    <div class="container div-separe">
            <div class="container-fluid">
                 <div class="card">
                    <img class="card-img-top card-fluid" src="" alt="AQUÍ LA FOTO">
                    <div class="card-block">
                        <h4 class="card-title text-center" >Playas de <?=$nombrePlaya;?></h4>
                        <p class="card-text">
                        Municipio: <span class="text-info"><?=$nombreMun;?></span></br>
                        Dirección: <span class="text-info"><?=$direccion;?></span></br>
                        Tamaño de la playa: <span class="text-info"><?=$playaSize;?></span></br>
                        Descripción: <span class="text-info"><?=$descripcion;?></span>
                        </p>
                    </div>
                    <div class="container">
                        
                    </div>
                </div>
                <button type="button" class="btn btn-link"><a href="principal.php" class="btn btn-outline-primary">Volver</a></button>

            </div><!--Fin contianer-fluid-->
    </div><!-- Fin container-->
</body>
</html>