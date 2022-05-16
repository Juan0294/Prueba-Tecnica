
<?php 

require_once ('./clases/Comprobar.php');

$cadenas_A_Evaluar = array("Hello World", "2 + 10 / 2 - 20", "(2 + 10) / 2 - 20", "(2 + 10 / 2 - 20");

$objComprobar = new Comprobar(null);

foreach($cadenas_A_Evaluar as $cadena){

    echo ($objComprobar->operation((str_replace(" ", "", $cadena)))) ? "true" : "false";
    
}


foreach($cadenas_A_Evaluar as $cadena){

    echo $objComprobar->compute((str_replace(" ", "", $cadena)));
    
}

?>
