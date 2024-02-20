
<?php
require_once 'Libraries/mpdf/vendor/autoload.php';

class Reporte extends Controllers
{
	public function __construct()
	{
		session_start();
		parent::__construct();
	}


	### CONTROLADOR  dep($data);  ###
	public function generarReporte($idSegumiento)
	{
// $idSegumiento = intval($idSegumiento);
// var_dump($idSegumiento); 
// 		exit();

		
		if (is_numeric($idSegumiento)) {
			$idpersona = '';
			$data = $this->model->selectSeguimiento($idSegumiento, $idpersona);		
			
			// dep($data);
			// exit();

			$mpdfConfig = array(
				//Width			   
			   //'format' => [432, 288], //px
			    'format' => ['153mm', '102mm'], //mm
			   //'format' => ['6in', '4in'], //pulgada
				//Tamaño font
			   'default_font_size' => 0,
				//Tipo de font 
			   'default_font' => '',
			   //Margen
			   'margin_left' => 1,	
			   'margin_right' => 1,
			   'margin_top' => 1,
			   'margin_bottom' => 1,
			   'orentacion' => 'P'
			   	
		  );
		  
		   // Obtener datos del cliente y material (si es necesario)
			// $data = array(
			// 	'seguimiento' => $seguimiento,
			// );



			$html = getFile("Template/Modals/comprobantePDF", $data);
			$mpdf = new \Mpdf\Mpdf($mpdfConfig);
			$mpdf->WriteHTML($html);
			$mpdf->Output();


		} else {
			//Muestro alguna vista
			echo "Dato no valido";
		}
	}
}
