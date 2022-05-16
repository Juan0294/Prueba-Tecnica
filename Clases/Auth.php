<?php

require_once ('../vendor/autoload.php');
use Firebase\JWT\JWT;

class Auth {

    public static function jwt($nombre_usuario, $contrasena) {

        $time = time();
        $key = 'my_secret_key';

        $token = array(
            'iat' => $time, // Tiempo que inició el token
            'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
            'data' => [ // información del usuario
                'id' => 1,
                'name' => 'Eduardo'
            ]
        );

        $jwt = JWT::encode($token, $key, 'HS256');

        return ('{"access_token":"'.$jwt.'"}');

    } 

}

?>