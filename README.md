# Prueba-Tecnica
Solución prueba tecnica. 

[Aclaracion]

La API simula la base de datos mediante los archivos .json: productos.json, tiendas.json, usuarios.json. Ubicados en la carpeta data.  

[POST MAN]

[USUARIO]

Crear Nuevo Usuario ruta/register.php

[OBTENER TOKEN]

ruta/auth.php

[TIENDA]

Crear Nueva Tienda: ruta/store.php?name=mi_tienda
Eliminar Tienda: ruta/store.php?name=mi_tienda
Ver todas la tiendas creada: ruta/store.php

[ARTICULO]

Crear nuevo Producto: ruta/item.php?name=nevera

Actualizar Producto: ruta/item.php?name=piano

Listar Todos los Productos: /item.php

Eliminar Producto: /item.php?name=lavadora

[FUNCIONES]

[CLASE PRODUCTO]

[FUNCION AGREGAR PRODUCTO]

Nombre: agregar_Producto($objProducto)

Parametro: $obj_Producto(Objeto Clase Producto)

Descripción:

1.	Se almacenan todos los datos de los productos mediante la funcion estatica "obtener_Datos()", los cuales seran almacenados en el array "$datos_Productos", para proceder a manipular su respectiva informacion. 

2.	En la variable "$index" se almacena la respuesta que retorna la función estática "retornar_Index()" (Función que retorna el índice, de un producto mediante el campo 'id' o 'name' en caso de ya existir.) La cual puede ser de tipo numérico en caso de retornar un índice o booleano en caso de no encontrar ninguno.

3.	En el siguiente condicional se comprueba mediante la funcion "isnumeric()" que la variable “$index” sea de tipo numérico, esto con el fin de se haya comprobado la existencia de un producto cuyo índice es igual al valor de esta variable ($index). De ser de tipo booleano se retorna una cadena en formato json en donde se indique ya existe un producto con ese mismo nombre.

4.	Se declara y se instancia la variable "$id", la cual almacena el numero de id del producto a insertarse. Este valor es generado al obtener la dimension del array  "$datos_Productos" mediante la funcion "count" y sumandole un numero 1.
    
5.	Mediante el funcion "array_push" le agregamos una nueva posicion la cual es un array al array "$datos_Productos". Esta nueva posicion (array) se instancia en ese momento con los datos del producto que se va agregar al macenados en la variable $id del paso 4 y el objeto recibido como parametro llamado "$objProducto".

6.	Mediante la funcion estatica "actualizar_Archivo_Datos()" /la cual recibe como parámetros el array de los datos: "$datos_Productos", un string opcional (en caso que se quiera retornar un mensaje) y una variable de tipo booleano para determinar si se muestra el mensaje o no./ Se hace envio del array con los datos "$datos_Productos" para proceder a actualizar el archivo ubicado en la carpeta data con nombre "productos.json" en esta funcion.   

[FUNCIÓN LISTAR PRODUCTO/S] 

Nombre: ver_Productos()

Parametro: $id_producto (numerica)

Descripción:

1.	Se comprueba mediante la función estática "hay_Datos()" que existan datos en el archivo "productos.json". Si retorna verdadero se continúa ejecutando la función, si no, se retorna una cadena en formato json en donde sé que no existen productos para ser eliminados.

2.	Se almacenan todos los datos de los productos mediante la función estática "obtener_Datos()", los cuales serán almacenados en el array "$datos_Productos", para proceder a manipular su respectiva información. 

3.	En la variable "$index" se almacena la respuesta que retorna la función estática "retornar_Index()" (Función que retorna el índice, de un producto mediante el campo 'id' o 'name' en caso de ya existir.) La cual puede ser de tipo numérico en caso de retornar un índice o booleano en caso de no encontrar ninguno.

4.	En el siguiente condicional se comprueba mediante la función "isset()" que la variable recibida como parámetro "$id_producto" este definida y no sea nula. De cumplirse esta condición se procede con la funcion, de lo contrario se retornara un listado con todos los productos existentes al convertir la variable "$datos_Productos" en una cadena con formato json mediante el uso de la función "json_encode()".
    
5.	Finalmente mediante un operador ternario se verifica que la variable "$index" (Paso 3.) sea de tipo numérico, para retornar el producto solicitado mediante el parámetro "id_producto"(menos un 1) al usar este como índice dentro del array "$datos_Productos[]" en una cadena con formato json mediante el uso de la función "json_encode()".

[FUNCIÓN ACTUALIZAR PRODUCTO] 

Nombre: actualizarProducto()

Parametros: $nombre_Articulo (string), $obj_Producto (Objeto Clase Producto)

Descripción:

1.	Se comprueba mediante la funcion estatica "hay_Datos()" que existan datos en el archivo "productos.json". Si retorna verdadero se continua ejecutando la funcion, si no, se retorna una cadena en formato Json en donde se que no existen productos para ser eliminados.

2.	Se almacenan todos los datos de los productos mediante la funcion estatica "obtener_Datos()", los cuales seran almacenados en el array "$datos_Productos", para proceder a manipular su respectiva informacion. 

3.	En la variable "$index" se almacena la respuesta que retorna la funcion estatica "retornar_Index()" Funcion que retorna el indice, de un producto mendiante el campo 'id' o 'name' en caso de ya existir.) La cual puede ser de tipo numerico en caso de retornar un indice o booleano en caso de no encontrar ninguno.

4.	En el siguiente condicional se comprueba mediante la funcion "isset()" que la variable recibida como parametro "$id_producto" este definida y no sea nula. De cumplirse esta condincion se procede con la funcion, de lo contrario.

5.	Se procede a actualizar el array "$datos_Productos" en el indice indicado por la variable “$index” (paso 3)  al reemplazar el valor (array) existente en esa posicion por el nuevo, el cual es instanciado en ese momento como un array. 

6.	Mediante la funcion estatica "actualizar_Archivo_Datos()" Se hace envio del array con los datos "$datos_Productos" con el registro nuevo agregado para posteriormente proceder a actualizar el archivo "productos.json".

7.	Finalmente mediante la funcion estatica "verProducto_s()" se retorna el que se acaba de actualizar, al enviarle como parametro el "id" ("$datos_Productos[$index]["id"]") del mismo.

[FUNCIÓN ELIMINAR PRODUCTO] 

Nombre: eliminarProducto()

Parametros: $nombre_Articulo (string)

Descripción:

1.	Se comprueba mediante la funcion estatica "hay_Datos()" que existan datos en el archivo "productos.json". Si retorna verdadero se continua ejecutando la funcion, si no, se retorna una cadena en formato Json en donde se indique que no existen productos para ser eliminados.

2.	Se almacenan todos los datos de los productos mediante la funcion estatica "obtener_Datos()", los cuales seran almacenados en el array "$datos_Productos", para proceder a manipular su respectiva informacion. 

3.	En la variable "$index" se almacena la respuesta que retorna la funcion estatica "retornar_Index()" Funcion que retorna el indice, de un producto mendiante el campo 'id' o 'name' en caso de ya existir.) La cual puede ser de tipo numerico en caso de retornar un indice o booleano en caso de no encontrar ninguno.

4.	En el siguiente condicional se comprueba mediante la funcion "isnumeric()" que la variable “$index” sea de tipo numérico, esto con el fin de se haya comprobado la existencia de un producto cuyo índice es igual al valor de esta variable ($index). De ser de tipo booleano se retorna una cadena en formato json en donde se indique producto con el nombre obtenido como parametro ($nombre_Articulo).

5.	Se procede a hacer uso de la funcion “unset” para eliminar el indice indicado mediante la variable “$index” del array "$datos_Productos".

6.	Posterior se procede a usar la función “array_values()” para retornar el array "$datos_Productos" con los índices restablecidos secuencialmente, asignándole el nuevo array retornado a por esta función  a esta mismo array ("$datos_Productos").

7.	Finalmente Mediante la funcion estatica "actualizar_Archivo_Datos()" Se hace envio del array con los datos "$datos_Productos" con el registro nuevo agregado para posteriormente proceder a actualizar el archivo "productos.json".


