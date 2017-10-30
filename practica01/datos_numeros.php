<?php
  $numShort = $_REQUEST['numIntShort'];
  $numLong = $_REQUEST['numIntLong'];

  echo "<h1>LISTA DE PARES DE NÚMEROS DE ".$numShort." y ".$numLong.":</h1>";

  while($numShort <= $_REQUEST['numIntLong']){
    echo "(".$numShort.",".$numLong.") ";
    $numShort++;
    $numLong--;
  }
?>
<br><br>
<a href="numeros.html">Volver...</a>