<?php 

class Usuario {

    private $nombre;
    private $contrasena;

    public function __construct($nombre, $contrasena){

        $this->nombre = $nombre;
        $this->contrasena = $contrasena;

    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public static function obtener_Datos(){

        return ($datos_tiendas = json_decode((file_get_contents("../data/usuarios.json")), true));
    
    }

    public static function actualizar_Datos($array, $respuesta){

        try {

            $archivo = fopen("../data/usuarios.json", "w");
            fwrite($archivo, json_encode($array));
            fclose($archivo);
            return ('{"message":"'.$respuesta.'"}');
           
        } catch (Exception $e) {

            return ('{"message":"the user could not be add.'.$e->getMessage().'"}');
          
        }

    }

    public static function retornar_Index($datos, $nombre_Usuario) {

        return (array_search($nombre_Usuario,array_column($datos, 'username')));
    
    }

    public static function agregarUsuario($objUsuario){

        $datos_Usuarios = Usuario::obtener_Datos();

        $index = (Usuario::retornar_Index($datos_Usuarios, $objUsuario->getNombre()));
       
        if((!(is_numeric($index)))){

            array_push($datos_Usuarios, Array("username" => $objUsuario->getNombre(), "password" => $objUsuario->getContrasena()));
            return (Usuario::actualizar_Datos($datos_Usuarios, "User created succesfull"));

        } else {

            return ('{"message":"A user already exist with the name: "'.$objUsuario->getNombre().'}');

        }

    }

}

?>