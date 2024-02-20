<?php

/**
 * En el archivo Helpers se encuentran diferentes funciones 
 * que alludaran a la reutilización de codigo tales como:
 *  1. Url del proyecto
 *  2. Url acceder assets
 *  3. getModal: Acceder a los modales
 *  4. Head: Llamar al head
 *  5. MainHead: Es la cabecera principal(css, metas)
 *  6. MainMenu: Es donde esta todo el menu
 *  7. footer: Mostrar footer
 *  7. getFile: Llamada a generar reportes
 *  8. MainJs: Son todas las llamadas a los js
 *  9. dep: Muestra información formateada
 * 10. strClean: Limpia una cadena
 */

#Retornar la url del proyecto
function base_url()
{
    return BASE_URL;
}

#Ruta para acceder a las Assets 
function media()
{
    return BASE_URL . "/Assets";
}

#Llamar Head
function MainHead($data = "")
{
    $view_header = "Views/html/MainHead.php";
    require_once($view_header);
}

#MainHeader
function MainHeader($data = "")
{
    $view_header = "Views/html/MainHeader.php";
    require_once($view_header);
}


#ExtraJs
function MainJs($data = "")
{
    $view_header = "Views/html/MainJs.php";
    require_once($view_header);
}

#MainJs
function ExtraJs($data = "")
{
    $view_heade = "Views/html/ExtraJs.php";
    require_once($view_heade);
}
#Footer
function MainFooter($data = "")
{
    $view_header = "Views/html/MainFooter.php";
    require_once($view_header);
}

#Llamar MainMenu
function MainMenu($data = "")
{
    $view_header = "Views/html/MainMenu.php";
    require_once($view_header);
}

#GetModal
function getModal(string $nameModal, $data)
{
    $view_modal = "Views/Template/Modals/{$nameModal}.php";
    require_once $view_modal;
}

#GetFile
function getFile(string $url, $data)
{
    ob_start();
    require_once("Views/{$url}.php");
    $file = ob_get_clean();
    return $file;
}

#footerAdmin
function footer($data = "")
{
    $view_footer = "Views/html/footer.php";
    require_once($view_footer);
}

//Muestra información formateada
function dep($data)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

function getPermisos(int $idmodulo)
{
    require_once("Models/PermisosModel.php");
    $objPermisos = new PermisosModel();
    $idrol = $_SESSION['userData']['idrol'];
    $arrPermisos = $objPermisos->permisosModulo($idrol);
    $permisos = '';
    $permisosMod = '';
    if (count($arrPermisos) > 0) {
        $permisos = $arrPermisos;
        $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
    }
    $_SESSION['permisos'] = $permisos;
    $_SESSION['permisosMod'] = $permisosMod;
}

//strClean
function strClean($strCadena)
{
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
    $string = trim($string);
    $string = stripslashes($string);
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}

//Genera una contraseña de 10 caracteres
function passGenerator($length = 10)
{
    $pass = "";
    $longitudPass = $length;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena = strlen($cadena);

    for ($i = 1; $i <= $longitudPass; $i++) {
        $pos = rand(0, $longitudCadena - 1);
        $pass .= substr($cadena, $pos, 1);
    }
    return $pass;
}
