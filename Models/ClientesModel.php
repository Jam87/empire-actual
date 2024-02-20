<?php
### CLASE: MarcaModel ###
class ClientesModel extends Mysql
{
    private $cod_customer;
    private $nombres_empire;
    private $apellidos_empire;
    private $opening_hours_empire;
    private $closing_time_empire;
    private $status;



    public function __construct()
    {
        parent::__construct();
    }


    /********************/
    /* COMBOX:CLIENTES */
    /******************/
    public function comboxClientes()
    {
        $sql = "SELECT cod_customer, CONCAT(nombres_empire, ' ', apellidos_empire) AS nombre_completo FROM clientes";

        $request = $this->select_all($sql);
        return $request;
    }


   
    ##########################
    ### SHOW ALL CUSTOMERS ###
    ##########################

    public function selectCliente()
    {

        $sql = "SELECT 
                    cod_customer,
                    CONCAT(nombres_empire, ' ', apellidos_empire) AS nombre_completo, 
                    CONCAT(
                        TIME_FORMAT(opening_hours_empire, '%h:%i %p'), 
                        ' - ', 
                        TIME_FORMAT(closing_time_empire, '%h:%i %p')
                    ) AS horario_completo,
                    status
                FROM clientes
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


    ### MODELO: SAVE NEW CUSTOMER ###
    public function insertClient($nombres, $apellidos, $horaApertura, $horaCierre, $intEstado) {

        $return = "";

        $this->nombres_empire       = $nombres;
        $this->apellidos_empire     = $apellidos;
        $this->opening_hours_empire = $horaApertura;
        $this->closing_time_empire  = $horaCierre;
        $this->status               = $intEstado;      
      

        $sql = "SELECT nombres_empire FROM clientes WHERE nombres_empire = '{$this->nombres_empire}'";

        #Mando a llamar la función(select_all)
        $request = $this->select_all($sql);

        // dep($request);
        // exit();

        if (empty($request)) {

            #Consulta
            $sql = "INSERT INTO clientes(nombres_empire, apellidos_empire, opening_hours_empire, closing_time_empire, status) VALUES(?,?,?,?,?)";

            $arrData = array(
                $this->nombres_empire, $this->apellidos_empire, $this->opening_hours_empire, $this->closing_time_empire, $this->status 
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


    #############################
    ### MODELO: UPDATE CLIENT ###
    #############################

    public function updateEditClient(int $intIdidClient, string $nombres, string $apellidos, $horaApertura, $horaCierre, $intEstado)
    {
        $this->cod_customer          = $intIdidClient;  
        $this->nombres_empire        = $nombres;
        $this->apellidos_empire      = $apellidos;   
        $this->opening_hours_empire  = $horaApertura;  
        $this->closing_time_empire   = $horaCierre; 
        $this->status                = $intEstado; 
           


        // $sql = "SELECT * FROM material WHERE equipment_description = '{$this->equipment_descripcion}' AND id_equipment != $this->id_Equipment";

        // $request = $this->select_all($sql);

        $sql = "UPDATE clientes SET nombres_empire = ?, apellidos_empire = ?, opening_hours_empire = ?, closing_time_empire = ?, status  = ? ";
        $arrData = array($this->nombres_empire , $this->apellidos_empire, $this->opening_hours_empire, $this->closing_time_empire, $this->status);

        // var_dump($arrData);
        // exit();

        $request = $this->update($sql, $arrData);
        
        return $request;
    }

  

    ### MODELO: DELETE CLIENT ### 
    public function deleteClient(int $idCliente)
    {
        
        #id
        $this->cod_customer = $idCliente;

        $sql = "UPDATE clientes SET status = ? WHERE cod_customer = $this->cod_customer";

        $arrData = array(0);
        $request = $this->update($sql, $arrData);

        if ($request) {
            $request = 'ok';
        } else {
            $request = 'error';
        }
        return $request;
    }


    ###########################
    ### MODELO: EDIT CLIENT ###
    ###########################

    public function editClient(int $idClient)
    {       

        //Buscar Tipo de Usuario
        $this->cod_customer = $idClient;
        $sql = "SELECT * FROM clientes WHERE cod_customer = $this->cod_customer";
        $request = $this->select($sql);
        return $request;
    }

 
}
