<?php
#Convierte la 1 letra en Mayuscula si no lo esta
$controller = ucwords($controller);


/**
 * Hago referencia a la carpeta(controllers)
 * Concateno el Controlador que voy a pasar
 * Le concateno .php
 * Ejemplo: Controllers/Usuarios.php
 */
$controllerFile = "Controllers/" . $controller . ".php";



#Verifico si existe el controlador 
if (file_exists($controllerFile)) {
	 #Lo mando a llamar(Usuario.php)
	require_once($controllerFile);
	#Instancio 
	$controller = new $controller();

    #Verifico si existe el metodo: Mando 2 parametros(el controlador y metodo)
	if (method_exists($controller, $method)) {

		#Utilizo el metodo
		#$params = Le mando el parametro si es que si es necesario por medio de la URL
		#Si no le mandamos parametro este es vacio 
		$controller->{$method}($params);
	} else {
		require_once("Controllers/Error.php");
	}
} else {
	require_once("Controllers/Error.php");
}
