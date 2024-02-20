<?php
class Seguimiento extends Controllers
{

    public function __construct()
    {
        session_start(); #Inicio sesion
        /* if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }*/
        parent::__construct();
    }

    ### CONTROLADOR ###
    public function Seguimiento()
    {
        $data['page_title'] = "ORDER TRACKING";
        $data['page_name'] = "ORDER TRACKING";
        $data['description'] = "";
        $data['breadcrumb-item'] = "Usuarios";
        $data['breadcrumb-activo'] = "Usuario";
        $data['page_functions_js'] = "functions_seguimiento.js";
        $data['data-sidebar-size'] = 'lg';

        #Data modal
        $data['page_title_modal'] = "";
        $data['page_title_bold'] = "Dear user";
        $data['descrption_modal1'] = "fields highlighted with";
        $data['descrption_modal2'] = "they are needed.";

        #Cargo la vista(tipos). La vista esta en View - Tipos
        $this->views->getView($this, "seguimiento", $data);
    }



    ########################################
    ### CONTROLADOR: SHOW ALL SEGUMIENTO ###
    ########################################
    public function getSeguimiento()
    {

        $arrData = $this->model->selectSeguimiento();

        for ($i = 0; $i < count($arrData); $i++) {

            #Estado
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge rounded-pill bg-success">Active</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge rounded-pill bg-danger">Inactive</span>';
            }

            #Botones de accion
            $arrData[$i]['options'] = '<div class="text-center"> 
           
            <a title="Print" href="' . base_url() . 'reporte/generarReporte/' . $arrData[$i]['cod_purchase_empire'] . '" target="_blanck" class="btn btn-info btn-sm"> <i class=" ri-printer-line" style="font-size:15px;"></i> </a>
            <button type="button" class="btn btn-secondary waves-effect waves-light btn-sm" onClick="fntViewSeguimiento(' . $arrData[$i]['cod_purchase_empire'] . ')" title="Detalles"><i class="ri-eye-fill"  style="font-size:15px;"></i></button>
		    <button type="button" class="btn btn-warning btn-sm" onClick="fntEditSeguimiento(' . $arrData[$i]['cod_purchase_empire'] . ')" title="Edit"><i class="ri-edit-2-line" style="font-size:15px;"></i></button>        

			<button type="button" class="btn btn-danger btn-sm" onClick="fntDelSeguimiento(' . $arrData[$i]['cod_purchase_empire'] . ')" title="Eliminate"><i class="ri-delete-bin-5-line" style="font-size:15px;"></i></button>
			</div>';
        }


        #JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        exit();
    }

    #######################################
    ### CONTROLADOR: MOSTRAR UN CLIENTE ###
    ######################################
    public function getCliente($idcliente)
    {

        $idcliente = intval($idcliente);

        if ($idcliente > 0) {
            $arrData = $this->model->selectUsuario($idcliente);


            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }

        die();
    }

    ##############################################                
    ### CONTROLADOR: GUARDAR NUEVO SEGUIMIENTO ###
    ##############################################
    public function setSeguimiento()
    {
        if ($_POST) {
            $intIdSeguimiento = intval($_POST['idSeguimiento']);
            $orden = strClean($_POST['orden']);
            $comboxCliente = $_POST['comboxCliente'];
            $comboxMaterial = $_POST['comboxMaterial'];
            $qty = $_POST['qty'];
            $size = $_POST['size'];
            $shipDate = $_POST['shipDate'];
            $notes = $_POST['notes'];
    
            // Procesar el texto: reemplazar saltos de línea con <br>
            $textarea_formatted = nl2br($notes);
            $intEstado = intval($_POST['lStatus']);
    
            if ($intIdSeguimiento == 0) {
                #Crear
                $request_Seguimiento = $this->model->insertSeguimiento($orden, $comboxCliente, $comboxMaterial, $qty, $size, $shipDate, $textarea_formatted, $intEstado);
    
                if ($request_Seguimiento) {
                    $response['success'] = true; // Éxito
                    $response['id'] = $request_Seguimiento; // ID del nuevo registro
                    $option = 1; // Opción para guardar un nuevo registro
                    $seguimientoID = $request_Seguimiento; // Asignar el ID del nuevo registro
                } else {
                    $response['success'] = false; // Falló
                    $option = 0; // Opción para indicar que no se realizó ninguna operación
                    $seguimientoID = null; // No se generó un nuevo ID de seguimiento
                }
            } else {
                #Actualizar updateMarca
                $request_Seguimiento = $this->model->updateEditSeguimiento($intIdSeguimiento, $orden, $comboxCliente, $comboxMaterial, $qty, $size, $shipDate, $textarea_formatted, $intEstado);
    
                $option = 2; // Opción para actualizar un seguimiento existente
                $seguimientoID = $intIdSeguimiento; // ID del seguimiento actualizado
            }
    
            #Verificar
            if ($request_Seguimiento !== 'existe') {
                if ($option == 1) {
                    $arrResponse = array(
                        'status' => true,
                        'msg' => 'The material was stored correctly.',
                        'option' => $option,
                        'seguimientoID' => $seguimientoID
                    );
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Data updated correctly.', 'option' => 2);
                }
            } else {
                $arrResponse = array('status' => false, 'msg' => '¡Attention! El material already exists.');
            }
    
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    

    

    ###########################
    ### CONTROLADOR: TICKET ###
    ###########################

    public function setTicket()
    {
    
        $response = array(); // Array para la respuesta
    
    if($_POST){
        // Capturar los datos del POST
        $orden = strClean($_POST['orden']);
        $cliente = $_POST['cliente'];
        $material = $_POST['material'];
        $qty = $_POST['cantidad'];
        $size = $_POST['tamaño'];
        $shipDate = $_POST['fecha_envio'];
        $notes = $_POST['notas'];

        // Insertar el ticket en la base de datos
        $request_Seguimiento = $this->model->insertTicket($orden, $cliente, $material, $qty, $size, $shipDate, $notes);
        
        // Verificar si la inserción fue exitosa
        if ($request_Seguimiento) {
            $response['success'] = true; // Éxito
            $response['id'] = $request_Seguimiento; // ID del nuevo registro
        } else {
            $response['success'] = false; // Falló
        }
    } else {
        $response['success'] = false; // Falló
    }
    
    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Finalizar la ejecución del script
  }



    #######################################
    ### CONTROLADOR: DELETE SEGUIMIENTO ###
    ######################################

    public function delSeguimiento()
    {

        if ($_POST) {

            $intIdSeguimiento = intval($_POST['idSeguimiento']);

            $requestDelete = $this->model->deleteSeguimiento($intIdSeguimiento);

            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'La orden ha sido eliminada');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error deleting client.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            die();
        }
    }

    #####################################
    ### CONTROLADOR: EDIT SEGUIMIENTO ###
    #####################################

    public function EditSeguimiento(int $idSeguimiento)
    {
        #id
        $intIdSeguimiento = $idSeguimiento;


        if ($intIdSeguimiento  > 0) {
            $arrData = $this->model->editSeguimiento($intIdSeguimiento);


            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    ###########################################
	### CONTROLADOR: MOSTRAR UN SEGUIMIENTO ###
	###########################################
	public function getSeguimientoId($idSeguimiento)
	{

		$idSeguimiento = intval($idSeguimiento);
       
		if ($idSeguimiento > 0) {
			$arrData = $this->model->selectSeguimientoId($idSeguimiento);
			if (empty($arrData)) {
				$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
			} else {
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

		die();
	}
}
