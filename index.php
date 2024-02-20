<?php
#Configuracion
require_once "Config/Config.php";
#Archivos de ayuda
require_once "Helpers/Helpers.php";

### RECOJO DATO DE LA URL ###
# Si no viene ningun parametro por default me va a cargar: Controlador:home Modelo:home

$url =  !empty($_GET['url']) ? $_GET['url'] : 'seguimiento/seguimiento'; #Por default va a cargar el controlador:login y Modelo:login
$arrUrl = explode("/", $url);
$controller = $arrUrl[0]; #Controlador
$method = $arrUrl[0]; #Por default el metodo es el mismo que el controlador
$params = "";

#Valido
if (!empty($arrUrl[1])) {
	$method = $arrUrl[1]; #Metodo
}

if (!empty($arrUrl[2])) {
	if ($arrUrl[2] != "") {
		for ($i = 2; $i < count($arrUrl); $i++) {
			$params .=  $arrUrl[$i] . ',';
			# code...
		}
		$params = trim($params, ',');
	}
}

#echo 'Controller: '.$controller. ' - '.'Metodo: '.$method;

#Cargo: Autoload
require_once("Libraries/Core/Autoload.php");

#Cargo: Controlador
require_once("Libraries/Core/Load.php");
