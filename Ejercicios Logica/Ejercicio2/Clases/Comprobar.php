<?php

class Comprobar {

    private $cadena;

    public function __construct($cadena) {

        $this->cadena = $cadena;

    }

    public function getCadena() {
        return $this->cadena;
    }

    public function compute($cadena_A_Ejecutarse){

        if((Comprobar::operation($cadena_A_Ejecutarse))){ 

            try {

                $ejecutar = 'echo '.$cadena_A_Ejecutarse.';';
                return (eval($ejecutar));
               
            } catch (ParseError $e) {
                return "false"; // se retorna en forma de String debido los retorna como 0 y 1         
            }

        } else {

            return "false";
            
        }

    }

    public static function operation($cadena_a_ser_evaluada) {

        $cadena_Contiene_Elementos_Requeridos = (preg_match('/^[0-9.+*-\/\()]+$/',$cadena_a_ser_evaluada));
        $cantidad_Parentesis = ((substr_count($cadena_a_ser_evaluada,"("))+(substr_count($cadena_a_ser_evaluada,")")));
        return (($cadena_Contiene_Elementos_Requeridos) ? (((($cantidad_Parentesis) % 2) == 0) ? true : false) : false);

    }

}

?>
