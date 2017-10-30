<?PHP
  $numero = $_REQUEST['numEntero'];
  
  if($numero%2 == 0){
    echo "El número ".$numero." es par";
  }else{
    echo "El número ".$numero." es impar";
  }
?>

<br><br>
<a href="par.html">Volver...</a>