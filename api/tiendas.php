<?php

include_once ("../Clases/Tienda.php");

header("Content-Type: application/json");

switch($_SERVER['REQUEST_METHOD']){

    case 'POST':
        
        $objTienda = new Tienda(0, $_GET["nombre"], Array());
        echo ($objTienda->agregarTienda($objTienda));

    break;
    case 'GET':
        
        $nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : "";
        echo (Tienda::verTienda_s($nombre));

    break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'),true);
        echo "El id de la tienda es a actualizarse es: ".$_GET["id"];
    break;
    case 'DELETE':

        echo (Tienda::eleminar_Tienda($_GET["nombre"]));

    break;

}

?>