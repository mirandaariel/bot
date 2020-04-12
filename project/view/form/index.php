<?php

// definir componentes - INI
    
    // rutas
    define( "THEME_PATH", STRUCTURE_DEFAULT_PATH . "themes/airbnb/" );
    define( "COMPONENT_PATH", THEME_PATH . "components/" );

    // componentes de layout
    define( "COMPONENT_LINK", COMPONENT_PATH . "layout/link/general/1/link.php" );
    define( "COMPONENT_NAVBAR", COMPONENT_PATH . "layout/navbar/1/navbar.php" );

// debug

    //var_dump( $oYApp->aGet_['a_url_value'] );
    //var_dump( $oYApp );
    //exit(); 

// control de parametros en la url
    $a_url_parameters = $oYApp->aGet_['a_parameter'];

    if ( isset( $a_url_parameters['user'] ) )
    {
        if ( $a_url_parameters['user'] == "new" )
            $oYApp->getUser();
    }
    
// 2018.06.18 - variables

    $i_rol         = $oYApp->a_data['usuario'][0]['app_rol_id'];
    $s_form_codigo = $oYApp->aGet_['a_url_value']['a_left'][1];

// obtener id del formulario

    $o_form_cabecera = new form_cabecera();
    $o_form_cabecera ->enable_relations();
    $o_form_cabecera ->aBase['aFilt'][] = "form_cabecera.codigo = '$s_form_codigo'";
    $a_form_cabecera = $o_form_cabecera->find();
    $s_form_id       = $a_form_cabecera[0]['id'];

    // 2020.01.14 - determinar si tiene la configuracion para referidos
    $b_form_referido = ! empty($a_form_cabecera[0]['form_parametro']);

// control de existencia de formulario
    if ( empty( $a_form_cabecera ) )
        header( "location: " . FMWK_CLIE_SERV . "main" );

// control de inicio de sesion

    $b_user_session    = $oYApp->bLgin;
    $b_user_temp       = is_null( $oYApp->iUsrt ) ? false : true;
    $b_user_habilitado = false;

    if ( $b_user_session )
        $b_user_habilitado = true;
    else if ( ! $b_user_session && $b_user_temp )
        $b_user_habilitado = true;
    

    if ( ! $b_user_habilitado && $b_form_referido )
    {
        $b_user_habilitado = true;
        $a_temp_usua = $oYApp->getUser();
        //var_dump( $a_temp_usua );
        //exit();
    }

    /*
    var_dump( $a_form_cabecera );
    var_dump( $a_form_cabecera[0]['form_entrada'] );
    var_dump( $a_form_cabecera[0]['form_parametro'] );
    var_dump( $b_user_temp );
    var_dump( $b_user_habilitado );
    exit();
    //*/

    if ( ! $b_user_habilitado )
        header( "location: " . FMWK_CLIE_SERV );
    
// formulario - INI
    // configuracion del formulario
        $a_form = array(
            "id"      => "form",
            "type"    => array(
                "container" => "view",
                "name"      => "engine",
                "instance"  => $s_form_id,
                "custom"    => FMWK_CLIE_DIRE . "project/view/form/index_custom.cls",
            ), 
            "cached"  => false,
            "scroll"  => array(
                "enabled" => false,
                //"extra_discount" => 87 + 36 + 50,                                                                       //menu + padding bottom del contenedor del FROMulario 
            ),
            "css" => array(
                //"width"          => "50%",
                "padding-top"    => 0,
                "padding-bottom" => 50,
                "margin-bottom"  => 0,
            ),
        );
        
        $o_form = new \YOBI\COMPONENTS\form_1();
        $o_form = $o_form->config( $a_form );

// paneles - INI
    $a_parameters['control']['panel-right'] = array(
        "show" => true,
        //"file" => FMWK_CLIE_DIRE . "project/view/includes/panels/ficha/default-derecho.php",
    );
    //$a_parameters['control']['panel-right-file'] = FMWK_CLIE_DIRE . "project/view/includes/panels/content-evaluation.php";

// configuracion local de componentes que no tienen la estructura de objeto sino scripts php y html

    $a_componente_navbar = array(
        "search" => array(
            "custom"    => FMWK_CLIE_PATH . "project/view/home/component_navbar_1.cls",
            "ajax_file" => FMWK_CLIE_SERV . "project/php/ajax/header-search-input.php",
        ),
        "sesion_elementos" => array(
            /*
            array(
                "href"  => FMWK_CLIE_SERV . "records/upload",
                "label" => "",
                //"img"   => STRUCTURE_VENDORS_HTTP . "icons/material.io/web/ic_camera_alt_black_48dp_2x.png",
                "icon"  => "camera",
                "tooltip" => "Subir Fotos"
            ),
            */
        ),
    );

// 2017.10.17 - configuracion theme clean - INI
    $a_parameters['content']['brand']                = "Formulario";
    //$a_parameters['content']['brand']                = $a_form_cabecera[0]['nombre'];
    $a_parameters['content']['tag_title']            = FMWK_CLIE_TITU . " - " . $a_form_cabecera[0]['nombre'];
    $a_parameters['control']['navbar-brand-isologo'] = false;
    //$a_parameters['control']['form-buscar-action']   = 1;
    //$a_parameters['control']['form-buscar']          = true;
    $a_parameters['control']['dropdown-user']        = true;
    $a_parameters['control']['dropdown-user-title']  = false;
    $a_parameters['control']['dropdown-user-avatar'] = true;
    
    $a_parameters['control']['navbar-logo-desktop-file'] = FMWK_CLIE_SERV . "project/images/logo/cabecera-logo.fw.png";

    $a_parameters['control']['no_session_elements'] = false;

    include( "configuracion-menu-1.php" );
    //include( FMWK_CLIE_DIRE . "project/view/species/ficha-especie-configuracion-menu-2.php" );

    // 2018.09.11 - si el usuario es temporal porque tuvo inicio rapido, debo reconfigurar el menu 1
    // para que el link apunte a cerrar la sesion y el usuario deba realizar la recuperacion de 
    // contraseña.
    if ( ! $b_user_session && $b_user_temp )
    {
        $a_parameters['control']['menu_1']['items'] = array(
            array(
                "label" => "Salir",
                "url"   => FMWK_CLIE_SERV . "logout",
            ),
        );
    }

// 2018.02.26 - componente view_info_1 - INI

    $a_dashboard = array();

    /*/ dashboard
    // pueden visualizarlos todos menos los usuarios generales

        if ( $i_rol != 2 )
        {
            // obtener la cantidad de registros de la entidad.
            $s_query = "SELECT COUNT(*) AS cantidad FROM form_header_usuario";
            $o_base  = new base();
            $a_base  = $o_base->procSent( $s_query );

            $s_dashboard_postulantes = number_format( $a_base['aDato'][0]['cantidad'], 0, '', '.');

            $a_dashboard = array(
                array(
                    "value" => $s_dashboard_postulantes,
                    "label" => "Postulantes",
                ),
            );
        }
        //*/

    $o_view_info = new \YOBI\COMPONENTS\CONTAINER\view_info_1();
    $o_view_info ->config( array(
        "title_1"     => "Vista",
        //"title_2"     => "Formulario",
        "title_2"     => $a_form_cabecera[0]['nombre'],
        "description" => $a_form_cabecera[0]['descripcion'],
        /*
        "description" => "<br />
            Al completar este sencillo formulario ya quedas registrada/o para todas las búsquedas de 
            castings. <br /> <br />
            Por favor, ingrese los datos que se solicitan.",
        //"dashboard"   => $a_dashboard,
        */
    ) );


//var_dump( $a_form_cabecera );
//var_dump( $a_form_cabecera[0]['media_imagen'] );
//exit();

$b_imagen_portada_original = isset( $a_form_cabecera[0]['imagen_portada_origfile'] );
//var_dump( $a_form_cabecera[0]['imagen_portada_origfile'] );

// 2020.01.31 - control necesario para produccion.
if  ( strpos( $a_form_cabecera[0]['imagen_portada_origfile'], "_default") !== false )
    $b_imagen_portada_original = false;

$s_imagen_portada_original = $b_imagen_portada_original ? $a_form_cabecera[0]['imagen_portada_origfile'] : 
    FMWK_CLIE_SERV . "project/images/forms/". $s_form_codigo . "/artists-form-$s_form_codigo.jpg";

$s_imagen_portada_landscape = $s_imagen_portada_original;
$s_imagen_portada_mobile    = $s_imagen_portada_original;

if ( isset( $a_form_cabecera[0]['imagen_portada_1185x300'] ) ) 
    if ( control_file( $a_form_cabecera[0]['imagen_portada_1185x300'] ) )
        $s_imagen_portada_original = $a_form_cabecera[0]['imagen_portada_1185x300'];

if ( isset( $a_form_cabecera[0]['imagen_portada_740x185'] ) )
    if ( control_file( $a_form_cabecera[0]['imagen_portada_740x185'] ) ) 
        $s_imagen_portada_landscape = $a_form_cabecera[0]['imagen_portada_740x185'];

if ( isset( $a_form_cabecera[0]['imagen_portada_343x300'] ) ) 
    if ( control_file( $a_form_cabecera[0]['imagen_portada_343x300'] ) ) 
        $s_imagen_portada_mobile = $a_form_cabecera[0]['imagen_portada_343x300'];


//var_dump( $s_imagen_portada_original );
//exit();

function control_file ( $s_file ) {
    $s_file = str_replace( FMWK_CLIE_SERV, FMWK_CLIE_PATH, $s_file );
    return file_exists( $s_file );
}

include( "index.html.php" );