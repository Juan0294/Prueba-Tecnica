<?php 

include_once ("../Clases/Auth.php");

header("Content-Type: application/json");

switch($_SERVER['REQUEST_METHOD']){

    case 'POST':
        
        $_POTS = json_decode(file_get_contents('php://input'),true);
        echo Auth::jwt($_POTS['username'], $_POTS['password']);

    break;

}

?>