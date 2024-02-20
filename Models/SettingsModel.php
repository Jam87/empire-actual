<?php

class SettingsModel extends Mysql
{

    private $cod_usuario;
    private $contrasenia;
    private $colapsar;
    private $date_registro;



    public function __construct()
    {
        parent::__construct();
    }

    ##########################
    ### MODIFICAR PASSWORD ###
    ###########################

    public function insertUsuario(string $strPassword)
    {

        $this->cod_usuario = $_SESSION['usuario'][0]['cod_usuario'];
        $this->contrasenia = $strPassword;
        $this->date_registro = date('Y-m-d H:i:s');


        $sql = "UPDATE secure_user SET contrasenia = ?, date_registro = ? WHERE cod_usuario =  {$this->cod_usuario}";

        $arrData = array(
            $this->contrasenia,
            $this->date_registro
        );

        $requestInsert = $this->insert($sql, $arrData);

        if (empty($requestInsert)) {
            $requestInsert = 'ok';
        }

        return $requestInsert;
    }

    ##########################
    ### MODIFICAR COLLAPSE ###
    ##########################

    public function insertCollapse(string $Collapse)
    {

        $this->cod_usuario = $_SESSION['usuario'][0]['cod_usuario'];
        $m = $this->colapsar = $Collapse;

        $sql = "UPDATE secure_user SET 	colapsar = ? WHERE cod_usuario =  {$this->cod_usuario}";

        $arrData = array(
            $this->colapsar
        );

        $requestInsert = $this->insert($sql, $arrData);

        if (empty($requestInsert)) {
            $requestInsert = 'ok';
        }

        return $requestInsert;
    }
}
