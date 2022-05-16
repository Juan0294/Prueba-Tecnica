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


   /*
  [[[***FUNCION OBTENER DATOS***]]]
  Descripcion:
  */

  public static function obtener_Datos(){

    return ($datos_tiendas = json_decode((file_get_contents("../data/tiendas.json")), true));

  }

  /*
  [[[***FUNCION ACTUALIZAR DATOS***]]]
  Descripcion:
  */

  public static function actualizar_Datos($array){

    $archivo = fopen("../data/tiendas.json", "w");
    fwrite($archivo, json_encode($array));
    fclose($archivo);

  }

  public function agregarTienda($objTienda) {

    $datos_tiendas = Tienda::obtener_Datos(); 
    array_push($datos_tiendas, Array( "id"=> ((count($datos_tiendas))+1), "nombre" => $objTienda->getNombre(), "items" => $objTienda->getItems()));
    Tienda::actualizar_Datos($datos_tiendas);
    return (Tienda::verTienda_s($objTienda->getNombre()));

  }

  public static function verTienda_s($nombre){

    $datos_tiendas = Tienda::obtener_Datos(); 
    return (!(empty($nombre))) ? (json_encode($datos_tiendas[((count($datos_tiendas))-1)])) : (json_encode($datos_tiendas));

  }

  public static function eleminar_Tienda($nombre_Tienda){

    $datos_tiendas = Tienda::obtener_Datos(); 
    unset($datos_tiendas[(array_search($nombre_Tienda,array_column($datos_tiendas, 'nombre')))/* retorna la posicion del index a elimniar */]);
    $datos_tiendas = array_values($datos_tiendas);
    Tienda::actualizar_Datos($datos_tiendas);
    return ('{"message":"store deleted"}');
    
  }

}

?>
