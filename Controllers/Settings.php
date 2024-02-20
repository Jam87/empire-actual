<?php

class Settings extends Controllers
{

    public function __construct()
    {
        session_start(); #Inicio sesion
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
        parent::__construct();
    }

    ### CONTROLADOR ###
    public function Settings()
    {
        $data['page_title'] = "Jipsafey | Configuración";
        $data['page_name'] = "Configuracion";
        $data['description'] = "";
        $data['breadcrumb-item'] = "Usuarios";
        $data['breadcrumb-activo'] = "Usuario";
        $data['data-sidebar-size'] = $_SESSION['usuario'][0]['colapsar'];
        $data['page_functions_js'] = "functions_settings.js";


        #Cargo la vista(tipos). La vista esta en View - Tipos
        $this->views->getView($this, "settings", $data);
    }

    ##########################
    ### GUARDA EL PASSWORD ###
    ##########################

    public function setPassword()
    {

        if ($_POST) {

            $strPassword = empty($_POST['password']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['password']);


            if ($strPassword) {

                $request_Usuario = $this->model->insertUsuario($strPassword);
            }

            #Verificar
            if ($request_Usuario  > 0) {

                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'No es posible almacenar los datos');
            }

            #Convierto .json
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    ##########################
    ### GUARDA EL COLLAPSE ###
    ##########################

    public function setCollapse()
    {

        if ($_POST) {

            $Collapse = strClean($_POST['listCollapse']);


            $request_Collapse = $this->model->insertCollapse($Collapse);


            #Verificar
            if ($request_Collapse  > 0) {

                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            } else {
                $arrResponse = array('status' => true, 'msg' => 'No es posible almacenar los datos');
            }

            #Convierto .json
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
