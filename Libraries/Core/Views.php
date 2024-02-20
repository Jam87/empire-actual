<?php

class Views
{

    #controller: Es el controlador
    #view: La vista a mostrar
    function getView($controller, $view, $data = "")
    {
        $controller = get_class($controller); # Devuelve el nombre de la clase de la cual object es una instancia

        #Valido: Si El controller es igual: Login, voy a buscar su VISTA
        #Es el que cargara por default
        if ($controller == "seguimiento") {
            $view = "Views/" . $view . ".php"; #Ruta buscar la vista

        } else {

            #Es otro controlador, para otra vista
            #Por cada controlador y cada vista creo una carpeta
            #La vista que va a cargar por default, la dejo afuera(login)
            $view = "Views/" . $controller . "/" . $view . ".php";
        }

        require_once $view;
    }
}
