<?php
class Caja
{
    var $alto;
    var $ancho;
    var $largo;
    var $contenido;
    var $color;
    
    function introduce($cosa)
    {
        $this->contenido = $cosa;
    }
    
    function muestra_contenido()
    {
        return $this->contenido; 
    }
}

$micaja = new Caja;

$micaja->introduce("algo"); 

echo $micaja->muestra_contenido(); 
?>