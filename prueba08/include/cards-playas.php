<button type="button" class="btn btn-link"><a href="nueva-playa.php" class="btn btn-outline-primary">Añadir playa</a></button>
<?php
   //Para salir del paso uso un array 
    $municipio=explode( '/', $_POST['SLCTmunicipio']);
    $idMunicipio= $municipio[0];

    try{
        $sql = "SELECT nombre, idPlaya, direccion, descripcion, idMun,playaSize, longitud, latitud, imagen, municipio.nombreMun FROM playas INNER JOIN municipio ON idMun = municipio.idMunicipio";
        $sql .= " WHERE idMun = ? ORDER BY nombre ASC;";
        $consultation = $dbh->prepare($sql);
        $consultation->setFetchMode(PDO::FETCH_ASSOC);
        if($consultation->execute(array($idMunicipio))):?>
        <div class="container-fluid">
        <h1 class="text-center">Playas de <?=$municipio[1];?></h1>
            <div class="card-columns">
                <?php while($row = $consultation->fetch()):?>
                            <div class="card">
                                <?php if(($row['imagen'] == null) || (empty($row['imagen']))): $imagen = ""; ?>
                                    <!--<img class="card-img-top img-fluid" src="img/tenerife.jpg" alt="Sin foto"/>-->
                                <?php else:
                                    $imagen = base64_encode($row['imagen']);?>
                                    <img class="card-img-top img-fluid center-block" style="width: 100%;"src="data:image/jpeg;base64,<?=$imagen?>" alt="foto playa "/> 
                                <?php endif;?>   
                                <div class="card-block">
                                    <h4 class="card-title"><?=$row['nombre']?></h4>
                                    <p class="card-text">
                                        Municipio: <span class="text-info"><?=$municipio[1];?></span><br/>
                                        Dirección: <span class="text-info"><?=$row['direccion'];?></span><br/>
                                        Longitud de la playa: <span class="text-info"><?=$row['playaSize'];?></span>
                                    </p>
                                 
                                    <!-- Para salir del paso uso campos ocultos pero lo ideal sería pasar los datos por sesión, almacenarlos en un array y guardarlos en una sesión -->
                                   <form action="info-playas.php" method="post">
                                       <input type="hidden" name="nombre" value="<?=$row['nombre'];?>"/>
                                       <input type="hidden" name="idPlaya" value="<?=$row['idPlaya'];?>"/>
                                       <input type="hidden" name="direccion" value="<?=$row['direccion'];?>"/>
                                       <input type="hidden" name="descripcion" value="<?=$row['descripcion'];?>"/>
                                       <input type="hidden" name="idMun" value="<?=$row['idMun'];?>"/>
                                       <input type="hidden" name="playaSize" value="<?=$row['playaSize'];?>"/>
                                       <input type="hidden" name="latitud" value="<?=$row['latitud'];?>"/>
                                       <input type="hidden" name="longitud" value="<?=$row['longitud']?>"/>
                                       <input type="hidden" name="imagen" value="<?=$imagen;?>"/>
                                       <input type="hidden" name="nombreMun" value="<?=$municipio[1]?>"/>
                                       <input type="submit" name="btn-verDetalles" class="btn btn-outline-primary btn-block" value="Ver Mapa"/>
                                   </form>
                                   <!--<button type="button" class="btn btn-link">Ver detalles</button>-->
                                </div>
                            </div>
                        <?php endwhile?>
                </div>
        <?php endif; 
        }catch(Exception $e){
            die("Ups! Parece que ha habido un error en la consulta... Inténtelo de nuevo, más tarde");
        }
?>
</div> <!--Fin car-columns-->  
</div><!-- Fin container -->       
