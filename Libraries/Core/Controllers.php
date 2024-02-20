<?php

class Controllers
{
	public function __construct()
	{
		#Instancia de la vista a traves de la clase(view)
		$this->views = new Views();
		#Invoco el metodo: loadModel 
		$this->loadModel();
	}

	#Es para cargar los modelos
	public function loadModel()
	{
		//Ejemplo:HomeModel.php			
		$model = get_class($this) . "Model";
		//echo $model . "<br>";

		#Hace referencia donde esta el modelo
		$routClass = "Models/" . $model . ".php";
		//echo $routClass;

		#Verifico si existe
		if (file_exists($routClass)) {
			#Lo cargo
			require_once($routClass);
			#Creo la instancia de la clase 
			$this->model = new $model();
		}
	}
}
