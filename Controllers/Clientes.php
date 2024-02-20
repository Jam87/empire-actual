<?php
class Clientes extends Controllers
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
    public function Clientes()
    {
        $data['page_title'] = "Customers";
        $data['page_name'] = "Customers";
        $data['description'] = "";
        $data['breadcrumb-item'] = "Usuarios";
        $data['breadcrumb-activo'] = "Usuario";
        $data['page_functions_js'] = "functions_clientes.js";
        $data['data-sidebar-size'] = 'lg';

        #Data modal
        $data['page_title_modal'] = "";
        $data['page_title_bold'] = "Dear user";
        $data['descrption_modal1'] = "fields marked with ";
        $data['descrption_modal2'] = "they are needed.";

        #Cargo la vista(tipos). La vista esta en View - Tipos
        $this->views->getView($this, "clientes", $data);
    }

    ########################
    ### OBTENER CLIENTES ###
    ########################

    function mostrarClientes()
    {

        $arrData = $this->model->comboxClientes();

        if (is_array($arrData) == true) {
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        exit();
    }


    #######################################
    ### CONTROLADOR: SHOW ALL CUSTOMERS ###
    #######################################
    public function getClientes()
    {
        #Cargo el modelo(selectBancos) 
        $arrData = $this->model->selectCliente();

        for ($i = 0; $i < count($arrData); $i++) {

            #Estado
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge rounded-pill bg-success">Active</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge rounded-pill bg-danger">Inactive</span>';
            }

            #Botones de accion
            $arrData[$i]['options'] = '<div class="text-center">            
		    <button type="button" class="btn btn-warning btn-sm" onClick="fntEditCliente(' . $arrData[$i]['cod_customer'] . ')" title="Editar"><i class="ri-edit-2-line"></i></button>
			<button type="button" class="btn btn-danger btn-sm" onClick="fntDelCliente(' . $arrData[$i]['cod_customer'] . ')" title="Eliminar"><i class="ri-delete-bin-5-line"></i></button>
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

    ##########################################                
    ### CONTROLADOR: GUARDAR NUEVO CLIENTE ###
    ##########################################

    public function setClientes()
    {

        //  dep($_POST);
        //  exit();

        if ($_POST) {

            #Capturo los datos dle modal

            $intIdidClient = intval($_POST['idCliente']);


            $nombres       = strClean($_POST['nombres']);
            $apellidos     = strClean($_POST['apellidos']);
            $horaApertura  = $_POST['horaApertura'];
            $horaCierre    = $_POST['horaCierre'];
            $intEstado     = intval($_POST['lStatus']);

            if ($intIdidClient == 0) {

                #Crear
                $request_Client = $this->model->insertClient($nombres, $apellidos, $horaApertura, $horaCierre, $intEstado);

                //  dep($request_Client);
                //   exit();

                $option = 1;
            } else {
                #Actualizar updateMarca
                $request_Client = $this->model->updateEditClient($intIdidClient, $nombres, $apellidos, $horaApertura, $horaCierre, $intEstado);

                $option = 2;
            }

            #Verificar
            if ($request_Client !== 'existe') {
                if ($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'The material was stored correctly.');
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Data updated correctly.');
                }
            } else {
                $arrResponse = array('status' => false, 'msg' => '¡Attention! El material already exists.');
            }


            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    ##################################
    ### CONTROLADOR: DELETE CLIENT ###
    ##################################

    public function delCliente()
    {

        if ($_POST) {

            $intIdClient = intval($_POST['idCliente']);

            $requestDelete = $this->model->deleteClient($intIdClient);

            if ($requestDelete) {
                $arrResponse = array('status' => true, 'msg' => 'The client has been deleted');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error deleting client.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

            die();
        }
    }

    ################################
    ### CONTROLADOR: EDIT CLIENT ###
    ################################

    public function EditClient(int $idClient)
    {
        #id
        $intIdClient = intval($idClient);

        if ($intIdClient  > 0) {
            $arrData = $this->model->editClient($intIdClient);

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
