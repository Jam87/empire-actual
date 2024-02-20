<?php 
#MOSTRAR PAGINA DE ERROR
	class Errors extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function notFound()
		{
			#Cargo la vista(error). A traves del metodo(getView)
			$this->views->getView($this,"error");
		}
	}

	$notFound = new Errors();
	$notFound->notFound();
 ?>