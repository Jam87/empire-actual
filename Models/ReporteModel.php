<?php
class ReporteModel extends Mysql
{

	private $cod_purchase_empire;
	private $cod_customer_empire;
	private $cod_material_empire;
	private $qty_empire;
	private $size_empire;
	private $purchase_order_empire;
	private $ship_date_empire;
	private $Notes_empire;



	public function __construct()
	{
		parent::__construct();
	}

	public function selectSeguimiento(int $idSegumiento, $idpersona = NULL)
	{

	// echo $idSegumiento;
	// exit();

	 $request = array();


		#DATA SEGUIMIENTO
		$sql = "SELECT p.cod_purchase_empire, CONCAT(c.nombres_empire, ' ',c.apellidos_empire) AS nombre, m.material_empire, p.qty_empire, p.size_empire,
		               p.purchase_order_empire, p.ship_date_empire, p.Notes_empire
		    	FROM purchase_order p
				INNER JOIN clientes c
				ON p.cod_customer_empire = c.cod_customer 
				INNER JOIN material m
				ON p.cod_material_empire = m.cod_material_empire
			    WHERE cod_purchase_empire = $idSegumiento";

		$request_seguimiento = $this->select($sql);

		$request = array(
			 		'seguimiento'   => $request_seguimiento,
			 		// 'cliente'  => $request_cliente,
			 		// 'vehiculo' => $request_vehiculo
			);

		// dep($request_seguimiento);
		// exit();


		#DATA CLIENTE
		// if (!empty($request_avaluo)) {

		// 	$sql = "SELECT a.cod_avaluo /*c.expediente, c.nombre_completo*/
		// 	FROM avaluos a
		// 	-- INNER JOIN cliente c
		// 	-- ON a.clienteId = c.cod_cliente
		// 	WHERE a.cod_avaluo = $idAvaluo";

		// 	$request_cliente = $this->select($sql);

		// 	#DATA VEHICULO
		// 	$sql = "SELECT a.cod_avaluo, a.vehiculoId, v.transmicionId, t.descripcion AS tipoVehiculo, m.marca, d.nombre AS modelo
		// 		FROM avaluos a
		// 		INNER JOIN vehiculos v
		// 		ON a.vehiculoId = v.cod_vehiculo
		// 		INNER JOIN tipo_vehiculo t
		// 		ON v.tipoVehId = t.id
		// 		INNER JOIN marca m
		// 		ON v.marcaId = m.idMarca 
		// 		INNER JOIN modelos d
		// 		ON v.modeloId = d.idmodelo
		// 		WHERE a.cod_avaluo = $idAvaluo";
		// 	$request_vehiculo = $this->select($sql);

		// 	$request = array(
		// 		'avaluo'   => $request_avaluo,
		// 		'cliente'  => $request_cliente,
		// 		'vehiculo' => $request_vehiculo
		// 	);
		// }
		return $request;
	}
}
