<?php

//El autoload va a servir para que cargue todas las clases automaticamente
spl_autoload_register(function($class){
	#file_exists: Si existe el archivo
	#Ejemplo: Libraries/Core/Usuario.php 

	#Si existe el ARCHIVO 
	if(file_exists("Libraries/".'Core/'.$class.".php")){

		#Lo requiero o mando a llamar
		require_once("Libraries/".'Core/'.$class.".php");
	}
});
