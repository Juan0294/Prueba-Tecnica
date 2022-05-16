<?php 

include_once ("../Clases/Usuario.php");

header("Content-Type: application/json");

switch($_SERVER['REQUEST_METHOD']){

    case 'POST':
        
        $_POTS = json_decode(file_get_contents('php://input'),true);
        echo (Usuario::agregarUsuario(new Usuario($_POTS['username'], $_POTS['password'])));

    break;

}

?>