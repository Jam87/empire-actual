<?php

class MaterialModel extends Mysql
{
    private $cod_material_empire;   
    private $material_empire;  
    private $status;
    


    public function __construct()
    {
        parent::__construct();
    }


    #######################
    ### COMBOX:MATERIAL ###
    #######################

    public function comboxMaterial()
    {

        $sql = "SELECT cod_material_empire, material_empire FROM material";

        $request = $this->select_all($sql);
        return $request;
    }  


    ####################################
    ### MOSTRAR TODOS LOS MATERIALES ###
    ####################################

    public function selectMaterial()
    {

        // $sql = "SELECT c.cod_cliente, c.expediente, c.nombre_completo, c.personaContacto, t.descripcion_evaluar, p.descripcion_p, e.descripcion, c.cod_Pago, c.excepto_impuesto, c.email,
        // c.ejecutivo, c.fechaInspeccionNormal, c.horaInspeccionNormal, c.fechaInspeccionRapida, c.telefono, c.extension, c.movil, c.direccion, c.observaciones, c.estado
        // FROM cliente c
        // INNER JOIN proposito p
        // ON c.cod_Proposito = p.cod_proposito
        // INNER JOIN entidad e
        // ON c.cod_Solicitante = e.cod_entidad
        // INNER JOIN tvaluo  t
        // ON c.cod_evaluar = t.id_tavaluo
        // ";

        $sql = "SELECT * 
                FROM material
                WHERE status != 0;      
        ";

        $request = $this->select_all($sql);
        return $request;
    }

    #########################
    ### MOSTRAR 1 CLIENTE ###
    #########################

    public function selectUsuario(int $idcliente)
    {
        $this->intIdCliente = $idcliente;
        $sql = "SELECT c.cod_cliente, c.expediente, c.nombre_completo, c.personaContacto, c.cedula, c.numero_ruc, t.descripcion_evaluar, p.descripcion_p, e.descripcion, f.descripcion, c.excepto_impuesto, c.email, 
                       c.ejecutivo, c.fechaInspeccionNormal, c.horaInspeccionNormal, c.fechaInspeccionRapida, c.telefono, c.extension, c.movil, c.direccion, c.observaciones, c.estado
                FROM cliente c    
                INNER JOIN proposito p
                ON c.cod_Proposito = p.cod_proposito
                INNER JOIN entidad e
                ON c.cod_Solicitante = e.cod_entidad
                INNER JOIN cat_forma_pago f
                ON c.cod_Pago = f.cod_forma_pago
                INNER JOIN tvaluo  t
                ON c.cod_evaluar = t.id_tavaluo
                WHERE cod_cliente = $this->intIdCliente";

        $request = $this->select($sql);
        return $request;
    }

    #########################
    ### SAVE NEW MATERIAL ###
    #########################

    public function insertMaterial($description, $intEstado) {

        $return = "";

        $this->material_empire    = $description;
        $this->status             = $intEstado;      
      


        $sql = "SELECT material_empire FROM material WHERE material_empire = '{$this->material_empire}'";

        #Mando a llamar la función(select_all)
        $request = $this->select_all($sql);

        // dep($request);
        // exit();

        if (empty($request)) {

            #Consulta
            $sql = "INSERT INTO material(material_empire, status) VALUES(?,?)";

            $arrData = array(
                $this->material_empire, $this->status 
            );


            // dep($arrData);
            // exit();

            $requestInsert = $this->insert($sql, $arrData);
            return $requestInsert;
        } else {
            $return = "existe";
        }
        return $return;
    }


    ##############################
    ### MODELO: EDIT MATERIAL ###
    ##############################

    public function editMaterial(int $idMaterial)
    {       

        //Buscar Tipo de Usuario
        $this->cod_material_empire= $idMaterial;
        $sql = "SELECT * FROM material WHERE cod_material_empire = $this->cod_material_empire";
        $request = $this->select($sql);
        return $request;
    }


    ###############################
    ### MODELO: UPDATE MATERIAL ###
    ###############################
     public function updateEditMaterial(int $intIdidMaterial, string $description, int $intEstado)
    {
        $this->cod_material_empire = $intIdidMaterial;  
        $this->material_empire     = $description;
        $this->status              = $intEstado;   

        // $sql = "SELECT * FROM material WHERE equipment_description = '{$this->equipment_descripcion}' AND id_equipment != $this->id_Equipment";

        // $request = $this->select_all($sql);

        $sql = "UPDATE material SET material_empire = ?, status = ? WHERE cod_material_empire = $this->cod_material_empire";
        $arrData = array($this->material_empire , $this->status);

        // var_dump($arrData);
        // exit();

        $request = $this->update($sql, $arrData);
        
        return $request;
    }


    ### MODELO: DELETE MATERIAL ### 
    public function deleteMaterial(int $intIdMaterial)
    {

        #id
        $this->cod_material_empire = $intIdMaterial;

        $sql = "UPDATE material SET status = ? WHERE cod_material_empire = $this->cod_material_empire";

        $arrData = array(0);
        $request = $this->update($sql, $arrData);

        if ($request) {
            $request = 'ok';
        } else {
            $request = 'error';
        }
        return $request;
    }


  


    ### MODELO: UPDATE EQUIPMENT ###
    /*public function updateEquipment(int $intIdEquipment, string $description, int $intEstado)
    {

        $this->id_Equipment          = $intIdEquipment;
        $this->equipment_descripcion = $description;
        $this->activo                = $intEstado;

        $sql = "SELECT * FROM equipment WHERE equipment_description = '{$this->equipment_descripcion}' AND id_equipment != $this->id_Equipment";

        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE equipment SET equipment_description = ?, activo = ? WHERE id_Equipment = $this->id_Equipment";
            $arrData = array($this->equipment_descripcion, $this->activo);

            var_dump($arrData);
            exit();

            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }*/
}
