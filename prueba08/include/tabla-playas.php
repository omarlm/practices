
<?php if(isset($_POST['SLCTmunicipio'])): //Al seleccionar un municipio muestra sus playas
        try{
                $sql = "SELECT nombre, idPlaya, direccion, idMun,playaSize, longitud, latitud, imagen, municipio.nombreMun FROM playas INNER JOIN municipio ON idMun = municipio.idMunicipio";
                $sql .= " WHERE idMun = ? ORDER BY nombre ASC;";
                $consultation = $dbh->prepare($sql);
                $consultation->setFetchMode(PDO::FETCH_ASSOC);
                if($consultation->execute(array($_POST['SLCTmunicipio']))):?>
                    <table class="table table-hover">
                    <thead class="thead-inverse">   
                        <tr>
                            <th>Playas</th>
                            <th></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $consultation->fetch()):
                        //$_SESSION['playa'] = $row;    
                        ?>
                        <tr>
                            <td><?=$row['nombre']?><span><!--<button type="button" class="btn btn-link">Ver detalles</button></span>--></td>   
                            <td class="text-right"><a href="pages/info-playas.php?id=<?=$row["idPlaya"]?>" class="btn btn-outline-primary" >Ver detalles</a></td>
                        <tr/>
                        <?php endwhile?>
                    </tbody>
                    </table>
                    <a href="nueva-playa.php" class="btn btn-outline-primary">Añadir playa</a>
                <?php endif; 

            }catch(Exception $e){
                die("Ups! Parece que ha habido un error en la consulta... Inténtelo de nuevo, más tarde");
            }  
endif;?>
   


