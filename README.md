
----------------------------------------------------------------------------------------------------------------------
Estructura de directorios php poo mvc
______________________________________________________________________________________________________________________

config: Incluye los ficheros de configuración de la base de datos, globales, etc.
_____________________________________________________________________________________________________________________

controller: como sabemos en la arquitectura MVC los controladores se encargarán de recibir y filtrar datos que le llegan de las vistas, llamar a los modelos y pasar los datos de estos a las vistas. Pues en este directorio colocaremos los controladores.
_____________________________________________________________________________________________________________________
core: Incluye las clases base de las que heredarán los controladores y modelos, y también podríamos colocar más librerías hechas por nosotros o por terceros, esto sería el núcleo del framework.
_____________________________________________________________________________________________________________________

model: Incluye los modelos, para ser fieles al paradigma orientado objetos tenemos que tener una clase por cada tabla o entidad de la base de datos(excepto para las tablas pivote) y estas clases servirán para crear objetos de ese tipo de entidad(por ejemplo crear un objeto usuario para crear un usuario en la BD). También tendremos modelos de consulta a la BD que contendrán consultas más complejas que estén relacionadas con una o varias entidades.
_____________________________________________________________________________________________________________________

view: Incluye las vistas, es decir, donde se imprimirán los datos y lo que verá el usuario.
_____________________________________________________________________________________________________________________

---- Clases del núcleo ----

Clases nos servirán para conectarnos a la base de datos utilizando el driver MySQLi que es el más rápido.
Con la opciòn de uso de PDO, y también nos servirá para conectar a la base de datos un constructor de consultas.

---- clase ModeloBase -----

la clase ModeloBase que hereda de la clase EntidadBase y a su vez será heredada por los modelos de consultas. La clase ModeloBase permitirá utilizar el constructor de consultas que hemos incluido y también los métodos de EntidadBase, así como otros métodos que programemos dentro de la clase, por ejemplo yo tengo un método para ejecutar consultas sql que directamente me devuelve el resultset en un array de objetos preparado para pasárselo a una vista, podríamos tener cientos para diferentes cosas.

----- AyudaVistas ---------
La clase AyudaVistas que puede contener diversos helpers (pequeños métodos que nos ayuden en pequeñas tareas dentro de las vistas).

-----ControladorFrontal----
El fichero ControladorFrontal.func.php que tiene las funciones que se encargan de cargar un controlador u otro y una acción u otra en función de lo que se le diga por la url.
El controlador frontal index.php
El controlador frontal es donde se cargan todos los ficheros de la aplicación y por tanto la única pagína que visita el usuario realmente es esta, en este caso index.php.

------Modelos y objetos----
Si queremos seguir el paradigma de la programación orientada a objetos teóricamente deberíamos tener una clase por cada tabla de la base de datos(excepto tablas pivote) que haga referencia a un objeto de la vida real, en este caso el objeto que crearíamos seria «Usuario» y el usuario tendría un nombre, un apellido, un email, etc, pues bien eso serian los atributos del objeto y tendríamos un método get y set por cada atributo que servirán para establecer el valor de las propiedades y para conseguir el valor de cada atributo. Esta clase hereda de EntidadesBase y tiene un método save para guardar el usuario en la base de datos, podríamos tener otro método update que seria similar, etc.
