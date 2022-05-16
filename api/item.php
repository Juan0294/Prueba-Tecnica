<?php

include_once ("../Clases/Producto.php");

header("Content-Type: application/json");

switch($_SERVER['REQUEST_METHOD']){

    case 'POST':
        
        $_POTS = json_decode(file_get_contents('php://input'),true);
        echo (Producto::agregarProducto(new Producto(0, $_GET["name"], $_POTS["price"], $_POTS["store_id"])));

    break;
    case 'GET':
        
       echo Producto::verProducto_s((isset($_GET["id"])) ? $_GET["id"] : null);

    break;
    case 'PUT':
        
        $nombre = $_GET["name"];
        $_POTS = json_decode(file_get_contents('php://input'),true); 
        echo Producto::actualizar_Producto($nombre, (new Producto(0, $nombre, $_POTS["price"], $_POTS["store_id"])));
      
    break;
    case 'DELETE':

        echo (Producto::eleminar_Producto($_GET["name"]));

    break;

}

?>