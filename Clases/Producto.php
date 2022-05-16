<?php 

class Producto {

    private $id;
    private $nombre;
    private $precio;
    private $id_tienda;

    public function __construct($id, $nombre, $precio, $id_tienda) {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->id_tienda = $id_tienda;

    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getIdtienda() {
        return $this->id_tienda;
    }

    public static function hay_Datos() {

        return ((count(Producto::obtener_Datos())) == 0) ? true : false;

    }

    public static function obtener_Datos() {

        return (json_decode((file_get_contents("../data/productos.json")), true));
    
    }

    public static function retornar_Index($datos, $nombre_O_Id_Articulo, $campo_Buscar) {

        return (array_search($nombre_O_Id_Articulo,array_column($datos, $campo_Buscar)));
    
    }

    public static function actualizar_Archivo_Datos($array, $respuesta, $devolver_respuesta) {

        try {

            $archivo = fopen("../data/productos.json", "w");
            fwrite($archivo, json_encode($array));
            fclose($archivo);
            if($devolver_respuesta) {return ('{"message":"'.$respuesta.'"}');};
           
        } catch (Exception $e) {

            return ('{"message":"the item could not be add.'.$e->getMessage().'"}');
          
        }

    }

    public static function agregarProducto($objProducto) {

        $datos_Productos = Producto::obtener_Datos();

        $index = (Producto::retornar_Index($datos_Productos, $objProducto->getNombre(), 'name'));
       
        if((!(is_numeric($index)))){

            $id = ((count($datos_Productos))+1);
            array_push($datos_Productos, Array("id"=> $id, "name" => $objProducto->getNombre(), "price" => $objProducto->getPrecio(), "store_id" => $objProducto->getIdtienda()));
            Producto::actualizar_Archivo_Datos($datos_Productos, "", false);
            return (Producto::verProducto_s($id));

        } else {

            return ('{"message":"A product already exist with the name: "'.$objProducto->getNombre().'}');

        }
   
    }

    public static function verProducto_s($id_producto) {

        if((!(Producto::hay_Datos()))) {

            $datos_Productos = Producto::obtener_Datos();
            $index = (Producto::retornar_Index($datos_Productos, $id_producto, 'id'));

            if((isset($id_producto))){

               return ((is_numeric($index))) ? (json_encode($datos_Productos[(($id_producto)-1)])) : '{"message":"there is no exist a item wiht the id: '.$id_producto.'"}';

            } else {

                return (json_encode($datos_Productos));
                
            }
    
        } else {

            return ('{"message":"there is no items to show."}');

        }

    }

    public static function actualizar_Producto($nombre_Articulo, $objProducto) {

        if((!(Producto::hay_Datos()))) {

            $datos_Productos = Producto::obtener_Datos();
            $index = (Producto::retornar_Index($datos_Productos, $nombre_Articulo, 'name'));

            if((is_numeric($index))){

                $datos_Productos[$index] = Array("id"=>$datos_Productos[$index]["id"], "name"=>$objProducto->getNombre(), "price"=>$objProducto->getPrecio(), "store_id"=>$objProducto->getIdtienda());
                Producto::actualizar_Archivo_Datos($datos_Productos, "", false);
                return (Producto::verProducto_s(($datos_Productos[$index]["id"])));
                
            } else {

                return ('{"message":"the item with name: '.$nombre_Articulo.' do not exist."}');

            }

        } else {

            return ('{"message":"there is no items to update."}');

        }

    }

    public static function eleminar_Producto($nombre_Articulo) {

        if((!(Producto::hay_Datos()))) {

            $datos_Productos = Producto::obtener_Datos(); 
            $index = (Producto::retornar_Index($datos_Productos, $nombre_Articulo, 'name'));

            if((is_numeric($index))){

                unset($datos_Productos[$index]);
                $datos_Productos = array_values($datos_Productos);
                return (Producto::actualizar_Archivo_Datos($datos_Productos, "item deleted", true));
                
            } else {

                return ('{"message":"the item with name: '.$nombre_Articulo.' do not exist."}');

            }

        } else {

            return ('{"message":"there is no items to delete."}');

        }
        
    }

}

?>
