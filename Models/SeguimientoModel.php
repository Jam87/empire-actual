<?php

class SeguimientoModel extends Mysql
{
    private $cod_purchase_empire;
    private $cod_customer_empire;
    private $cod_material_empire;
    private $qty_empire;
    private $size_empire;
    private $material_empire;
    private $purchase_order_empire;
    private $ship_date_empire;
    private $Notes_empire;
    private $status;



    public function __construct()
    {
        parent::__construct();
    }



    ##########################
    ### SHOW ALL CUSTOMERS ###
    ##########################

    public function selectSeguimiento()
    {

        $sql = "SELECT p.cod_purchase_empire,
                       TRIM(SUBSTRING_INDEX(c.nombres_empire, ' ', 1)) AS primer_nombre,
                       TRIM(SUBSTRING_INDEX(c.apellidos_empire, ' ', 1)) AS primer_apellido,
                       CONCAT(
                            TRIM(SUBSTRING_INDEX(c.nombres_empire, ' ', 1)),
                            ' ',
                            TRIM(SUBSTRING_INDEX(c.apellidos_empire, ' ', 1))
                        ) AS nombre_completo,
                       m.material_empire, p.qty_empire, p.size_empire, p.purchase_order_empire, p.ship_date_empire,
                       p.system_date_empire, p.status

                FROM purchase_order p 
                INNER JOIN clientes c
                ON p.cod_customer_empire = c.cod_customer
                INNER JOIN material m
                ON p.cod_material_empire = m.cod_material_empire 
                WHERE p.status != 0;               
                ";

        $request = $this->select_all($sql);
        return $request;
    }



    ### MODELO: SAVE NEW SEGUIMIENTO ###
    public function insertSeguimiento($orden, $comboxCliente, $comboxMaterial, $qty, $size, $shipDate, $textarea_formatted, $intEstado)
    {

        $return = "";

        $this->purchase_order_empire   = $orden;
        $this->cod_customer_empire     = $comboxCliente;
        $this->cod_material_empire     = $comboxMaterial;
        $this->qty_empire              = $qty;
        $this->size_empire             = $size;
        $this->ship_date_empire        = $shipDate;
        $this->Notes_empire            = $textarea_formatted;
        $this->status                  = $intEstado;


        if (empty($request)) {

            #Consulta
            $sql = "INSERT INTO purchase_order(purchase_order_empire, cod_customer_empire, cod_material_empire, qty_empire, size_empire,
                                ship_date_empire, Notes_empire, status) VALUES(?,?,?,?,?,?,?,?)";

            $arrData = array(
                $this->purchase_order_empire,  $this->cod_customer_empire, $this->cod_material_empire, $this->qty_empire,
                $this->size_empire, $this->ship_date_empire, $this->Notes_empire, $this->status
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

    #################################### 
    ### MODELO: IMPRISION DE TICKET ###
    ####################################

    public function insertTicket($orden, $cliente, $material, $qty, $size, $shipDate, $notes){
        $return = "";

        $this->purchase_order_empire   = $orden;
        $this->cod_customer_empire     = $cliente;
        $this->cod_material_empire     = $material;
        $this->qty_empire              = $qty;
        $this->size_empire             = $size;
        $this->ship_date_empire        = $shipDate;
        $this->Notes_empire            = $notes;
        $this->status                  = 0;

        if (empty($request)) {

            #Consulta
            $sql = "INSERT INTO purchase_order(purchase_order_empire, cod_customer_empire, cod_material_empire, qty_empire, size_empire,
                                ship_date_empire, Notes_empire, status) VALUES(?,?,?,?,?,?,?,?)";

            $arrData = array(
                $this->purchase_order_empire,  $this->cod_customer_empire, $this->cod_material_empire, $this->qty_empire,
                $this->size_empire, $this->ship_date_empire, $this->Notes_empire, $this->status
            );

            

            $requestInsert = $this->insert($sql, $arrData);
          

            return $requestInsert;
       }
    }

    #####################################
    ### MODELO: Obtengo el idRegistro ###
    #####################################

    public function getIdRegistro(){

        $sql = "SELECT MAX(cod_purchase_empire) AS idRegistro FROM purchase_order";
        $request = $this->select($sql);
       
        return $request;
    }


    ##################################
    ### MODELO: UPDATE SEGUIMIENTO ###
    ##################################

    public function updateEditSeguimiento($intIdSeguimiento, $orden, $comboxCliente, $comboxMaterial, $qty, $size, $shipDate, $notes, $intEstado)
    {

        $this->cod_purchase_empire   = $intIdSeguimiento;
        $this->purchase_order_empire = $orden;
        $this->cod_customer_empire   = $comboxCliente;
        $this->cod_material_empire   = $comboxMaterial;
        $this->qty_empire            = $qty;
        $this->size_empire           = $size;
        $this->ship_date_empire      = $shipDate;
        $this->Notes_empire          = $notes;
        $this->status                = $intEstado;



        // $sql = "SELECT * FROM material WHERE equipment_description = '{$this->equipment_descripcion}' AND id_equipment != $this->id_Equipment";

        // $request = $this->select_all($sql);

        $sql = "UPDATE purchase_order 
                SET purchase_order_empire = ?, cod_customer_empire = ?, cod_material_empire = ?, qty_empire = ?, 
                    size_empire  = ?, ship_date_empire  = ?, Notes_empire  = ?, status  = ? 
                WHERE cod_purchase_empire = " . $this->cod_purchase_empire;



        $arrData = array(
            $this->purchase_order_empire, $this->cod_customer_empire, $this->cod_material_empire, $this->qty_empire,
            $this->size_empire, $this->ship_date_empire, $this->Notes_empire, $this->status
        );

        //  var_dump($arrData);
        //  exit();

        $request = $this->update($sql, $arrData);

        return $request;
    }



    ### MODELO: DELETE SEGUIMIENTO ### 
    public function deleteSeguimiento(int $idSeguimiento)
    {

        #id
        $this->cod_purchase_empire = $idSeguimiento;

        $sql = "UPDATE purchase_order SET status = ? WHERE cod_purchase_empire = $this->cod_purchase_empire";

        $arrData = array(0);
        $request = $this->update($sql, $arrData);

        if ($request) {
            $request = 'ok';
        } else {
            $request = 'error';
        }
        return $request;
    }


    ################################
    ### MODELO: EDIT SEGUIMIENTO ###
    ################################

    public function editSeguimiento(int $idSeguimiento)
    {


        //Buscar Tipo de Usuario
        $this->cod_purchase_empire = $idSeguimiento;

        $sql = "SELECT p.cod_purchase_empire, c.cod_customer, CONCAT(c.nombres_empire, ' ', c.apellidos_empire) AS nombre_completo, 
                       m.cod_material_empire, m.material_empire, p.qty_empire, p.size_empire, p.purchase_order_empire,
                       p.ship_date_empire, p.Notes_empire, p.status

                FROM purchase_order p     
                INNER JOIN clientes c
                ON p.cod_customer_empire = c.cod_customer   
                INNER JOIN material m
                ON p.cod_material_empire = m.cod_material_empire                  
                WHERE cod_purchase_empire = $this->cod_purchase_empire";


        $request = $this->select($sql);

       
        return $request;
    }

    ###############################################
    ########## MOSTRAR UN SEGUIMIENTO #############
    ###############################################

    public function selectSeguimientoId(int $idSeguimiento)
    {

        $this->cod_purchase_empire = $idSeguimiento;

        // $sql = "SELECT e.equipment_description, t.description_transmission, v.rodamiento, v.circulacion, v.engine, v.chasis, v.color, v.cilindro, v.pasajeros,
        //                v.gravamen, v.traccion, v.centrimetro, v.potencia, v.frenos, v.rines 
        //         FROM vehiculos v
        //         INNER JOIN equipment e
        //         ON v.equipoId = e.id_equipment
        //         INNER JOIN transmission t
        //         ON v.transmicionId = t.cod_trasmission             
        //         WHERE cod_purchase_empire = $this->cod_purchase_empire";
        $sql = "SELECT Notes_empire, system_date_empire, status
                FROM purchase_order
                WHERE cod_purchase_empire = $this->cod_purchase_empire";

        $request = $this->select($sql);
        return $request;
    }
}
