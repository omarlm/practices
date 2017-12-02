<!DOCTYPE html>
<html lang="en">
<?php include_once('../templates/head.html') ?>

<body>
    <?php include_once('../templates/nav.html') ?>
    <div class="container">
        <div class="container-fluid">
            <div class="col-12">
                 <!-- form user info -->
                <div class="card card-outline-secondary">
                    <div class="card-header">
                        <h3 class="mb-0">Información de la playa</h3>
                    </div>
                    <div class="card-block">
                        <form class="form" role="form" autocomplete="off" enctype="multipart/form-data"> 
                         <!-- Un fila con dos columnas: 3 + 9 = 12 -->   
                        <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Dirección</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="direccion"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Descripción</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="descripcion"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Tamañano playa</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="playaSize"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Longitud</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="longitud"/>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Latitud</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="latitud"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Imagen</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="file" name="imagen" placeholder="sube tu foto"/>
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="hidden" name="idMun" value="idMun"/>
                                    <input type="reset" class="btn btn-secondary" value="Borrar datos"/>
                                    <input type="button" class="btn btn-primary" value="Añadir playa"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- /form user info -->
                <button type="button" class="btn btn-link"><a href="principal.php" class="btn btn-outline-primary">Volver...</a></button>
            </div>
        </div><!--Fin container-fluid-->
    </div><!--Fin contianer-->




    <!-- 1º COPY PASTE 
<div class="container">
  <h3>Bienvenido al registro de playas de Tenerife en: </h3>
<form>
  <div class="form-group">
    <label for="exampleFormControlInput1">Nombre</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="nombre de la playa">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
</form>

</div>

<!--ORIGINAL 
<div class="container-fluid">
        <form  class="form-group" action="" method="post">
            <fieldset>
                <legend>Agrega una nueva playa a: Nombre municipio</legend>
                <label>Nombre: </label>
                <input type="text" name="name">
                <label>Descripción: </label>
                <input type="text" name="descripc">
                <label>Dirección: </label>
                <input type="text" name="direccion">
                <label>Tamaño playa: </label>
                <input type="text" name="playaSize">
                <label>longitud: </label>
                <input type="text" name="longitud">
                <label>latitud: </label>
                <input type="text" name="latitud">
                <label>imagen: </label>
                <input type="text" name="imagen">
                <input type="hidden" name="idMun" value="idMun"/>
                <button type="submit" name="submit" class="btn btn-primary">Enviar datos</button>
                <button type="submit" name="closeSession" class="btn btn-primary">Eliminar datos</button>
            </fieldset>
        </form>
    </div>
-->
</body>

</html>