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

    /*
    public static function existe_Procuto($nombre_O_Id_Articulo, $campo){

        $datos_Productos = Producto::obtener_Datos(); 
        return (!(empty(array_search($nombre_O_Id_Articulo,array_column($datos_Productos, $campo))))) ? true : false;

    }
    */

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

    /*
    public static function agregarProducto($objProducto) {

        $datos_Productos = Producto::obtener_Datos(); 
        $id = ((count($datos_Productos))+1);
        array_push($datos_Productos, Array("id"=> $id, "name" => preg_replace('~[""]~', '', $objProducto->getNombre()), "price" => $objProducto->getPrecio(), "store_id" => $objProducto->getIdtienda()));
        Producto::actualizar_Archivo_Datos($datos_Productos, "", false);
        return (Producto::verProducto_s($id));
        
    }
    */

    /*
    FUNCION AGREGAR PRODUCTO

    Parametros: "$objProducto" Objeto con todos los datos de la clase
    producto (id, nombre, precio, id_tienda).

    Descripcion:

    1. Se llama a la funcion estatica "obtener_Datos()" para obtener todos 
    los datos de los productos. almacenados en la carpeta: "data" con nom-
    bre de archivo: "productos.json" esta funcion me retorna un array el
    cual es guardado en la variable "$datos_Productos".

    2. Mediante la funcion estatica "retornar_Index()" se consulta la exis-
    tencia de un producto ya existente dentro del array "$datos_Productos" 
    (array que contiene los datos de todos los productos existentes generado
    mediante la funcion estatica "obtener_Datos()") con el mismo nombre del 
    producto que se esta intentando agregar, esto con el de corroborar que
    ya no exista un dato con el mismo nombre. Es

    
    3. Si el valor obteneido por la funcion estatica "retornar_Index()" al macenado
    en la variable "$index" no es de tipo numerico, es decir no se encontro ninguna 
    posicion dentro del array "$datos_Productos", donde su "campo nombre=> ''" sea 
    igual al nombre del producto que estamos intentando agregar. Si es asi se proce-
    dera a continuar con el proceso se insercio, de lo contrario se retornara una cadena
    en formato Json en donde se indica que ya existe un producto identificado con ese mis-
    mo nombre. 

    4. Se declara y se instancia la variable "$id", la cual almacena el numero de id del
    producto a insertarse. Este valor es generado al obtener la dimension del array 
    "$datos_Productos" mediante la funcion "count" y sumandole un numero 1.
    
    5. Mediante el funcion "array_push" le agregamos una nueva posicion la cual es un array
    al array "$datos_Productos". Esta nueva posicion (array) se instancia en ese momento con 
    los datos del producto que se va agregar al macenados en la variable $id del paso 4 y el
    objeto recibido como parametro llamado "$objProducto".

    6. Mediante la funcion estatica "actualizar_Archivo_Datos()" /la cual recibe como parametros
    el array de los datos: "$datos_Productos", un string opcional (en caso que se quiera retornar un mensaje)
    y una variable de tipo booleano para determinar si se muestra el mensaje o no./ Se 
    hace envio del array con los datos "$datos_Productos" para proceder a actualizar el archivo 
    ubicado en la carpeta data con nombre "productos.json" en esta funcion.   

    */

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

               return ((is_numeric($index))) ? (json_encode($datos_Productos[(($id_producto)-1)])) : '{"message":"there is no exist item wiht the id: '.$id_producto.'"}';

            } else {

                return (json_encode($datos_Productos));
                
            }
    
        } else {

            return ('{"message":"there is no items to show."}');

        }

    }

    /*
    FUNCION ACTUALIZAR 

    Descripcion:

    
    1. Se comprueba mediante la funcion estatica "hay_Datos()" que existan datos
    en el archivo "productos.json". Si retorna verdadero se continua ejecutando la funcion, si no,
    se retorna una cadena en formato Json en donde se que no existen productos para ser
    eliminados.

    
2. Se almacenan todos los datos de los productos mediante la funcion estatica "obtener_Datos()",
los cuales seran almacenados en el array "$datos_Productos", para proceder a manipular su respectiva
informacion. 

3. En la variable "$index" se almacena la respuesta que retorna la funcion estatica "retornar_Index()"
(Funcion que retorna el indice, de un producto mendiante el campo 'id' o 'name' en caso de ya existir.)
La cual puede ser de tipo numerico en caso de retornar un indice o booleano en caso de no encontrar ninguno.

4. En el siguiente condicional se comprueba mediante la funcion "isset()" que la variable recibida como
parametro "$id_producto" este definida y no sea nula. De cumplirse esta condincion se procede con la funcion, de lo
contrario.

5. Se procede a actualizar el array "$datos_Productos" en el indice indicado por la variable $index (paso 3) 
al reemplazar el valor (array) existente en esa posicion por el nuevo, el cual es instanciado en ese momento como
un array 



    */

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