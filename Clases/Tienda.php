<?php 

class Tienda {

    private $id;
    private $nombre;
    private $items;
  
    public function __construct($id, $nombre, $items) {
    
        $this->id = $id;
        $this->nombre = $nombre;
        $this->items = $items;

    }

    public function getId() {
        return $this->id;
    }
 
    public function getNombre() {
        return $this->nombre;
    }
 
    public function getItems() {
        return $this->items;
    }

    public static function hay_Datos() {

        return ((count(Tienda::obtener_Datos())) == 0) ? true : false;
    
    }
    
    public static function obtener_Datos() {
    
        return (json_decode((file_get_contents("../data/tiendas.json")), true));
    
    }

    public static function retornar_Index($datos, $nombre_O_Id_Tienda, $campo_Buscar) {

        return (array_search($nombre_O_Id_Tienda,array_column($datos, $campo_Buscar)));

    }

    public static function actualizar_Archivo_Datos($array, $respuesta, $devolver_respuesta) {

        try {

            $archivo = fopen("../data/Tiendas.json", "w");
            fwrite($archivo, json_encode($array));
            fclose($archivo);
            if($devolver_respuesta) {return ('{"message":"'.$respuesta.'"}');};
           
        } catch (Exception $e) {

            return ('{"message":"the item could not be add.'.$e->getMessage().'"}');
          
        }

    }

    public static function agregarTienda($objTienda) {

        $datos_Tiendas = Tienda::obtener_Datos();
        $index = (Tienda::retornar_Index($datos_Tiendas, $objTienda->getNombre(), 'name'));
       
        if((!(is_numeric($index)))){

            $id = ((count($datos_Tiendas))+1);
            array_push($datos_Tiendas, Array("id"=> $id, "name" => $objTienda->getNombre(), "items" => $objTienda->getItems()));
            Tienda::actualizar_Archivo_Datos($datos_Tiendas, "", false);
            Tienda::verTienda_s($id);
            return (Tienda::verTienda_s($id));

        } else {

            return ('{"message":"A store already exist with the name: "'.$objTienda->getNombre().'}');

        }
   
    }

    public static function verTienda_s($id_Tienda) {

        if((!(Tienda::hay_Datos()))) {

            $datos_Tiendas = Tienda::obtener_Datos();
            $index = (Tienda::retornar_Index($datos_Tiendas, $id_Tienda, 'id'));

            if((isset($id_Tienda))){

               return ((is_numeric($index))) ? (json_encode($datos_Tiendas[(($id_Tienda)-1)])) : '{"message":"there is no exist a store wiht the id: '.$id_Tienda.'"}';

            } else {

                return (json_encode($datos_Tiendas));
                
            }
    
        } else {

            return ('{"message":"there is no items to show."}');

        }
        
    }

    public static function eleminar_Tienda($nombre_Tienda) {

        if((!(Tienda::hay_Datos()))) {

            $datos_Tiendas = Tienda::obtener_Datos();
            $index = (Tienda::retornar_Index($datos_Tiendas, $nombre_Tienda, 'name'));
         
            if((is_numeric($index))){

                unset($datos_Tiendas[$index]);
                $datos_Tiendas = array_values($datos_Tiendas);
                return (Tienda::actualizar_Archivo_Datos($datos_Tiendas, "store deleted", true));
                
            } else {

                return ('{"message":"the store with name: '.$nombre_Tienda.' do not exist."}');

            }

        } else {

            return ('{"message":"there is no items to delete."}');

        }
        
    }

}

?>
