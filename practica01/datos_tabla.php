<?php
 $numero = $_REQUEST['numEntero'];

 if(($numero >=1) && ($numero <=9)){
    
    echo "<h1>TABLA DE MULTIPLICAR:</h1>";
    for ($i=1; $i<=10 ; $i++) {    
        echo "<p><strong>".$numero."</strong> x ".$i." = ".$i * $numero."</p>";
    }
 }
?>

<br><br>
<a href="tabla.html">Volver...</a>
