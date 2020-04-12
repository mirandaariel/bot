<?php

// debug
  
// definir componentes - INI
    
    // rutas
    define( "THEME_PATH", STRUCTURE_DEFAULT_PATH . "themes/airbnb/" );
    define( "COMPONENT_PATH", THEME_PATH . "components/" );

    // componentes de layout
    define( "COMPONENT_LINK", COMPONENT_PATH . "layout/link/general/1/link.php" );
    define( "COMPONENT_NAVBAR", COMPONENT_PATH . "layout/navbar/1/navbar.php" );
  
/*/ control de inicio de sesion

    $b_user_session    = $oYApp->bLgin;
    $b_user_temp       = is_null( $oYApp->iUsrt ) ? false : true;
    $b_user_habilitado = false;

    if ( $b_user_session )
        $b_user_habilitado = true;
    else if ( ! $b_user_session && $b_user_temp )
        $b_user_habilitado = false;

    if ( ! $b_user_habilitado )
        header( "location: " . FMWK_CLIE_SERV );
    //*/

// contenedor de contenido
    $a_content = array(
        "id" => "container_contenido",
        "data_source" => array(
            "get_data" => FMWK_CLIE_SERV . "project/components/views/main/content/get_data.php",
        ),
    );
    
    $o_content = new \YOBI\COMPONENTS\CONTAINER\content_1();
    $o_content = $o_content->config( $a_content );

// formulario

    $a_form = array(
        "id"    => "form_mensaje",
         "type" => array(
            "name"      => "entity",
            "entity"    => "mensaje",
            "crud"      => "c",
            "instance"  => array(),
            "container" => "view",
            //"dependency" => $b_dependency,
            //"custom"    => FMWK_CLIE_DIRE . "project/components/views/main/form/custom.cls",
            "actions"   => FMWK_CLIE_DIRE . "project/components/views/main/form/actions.cls",
        ), 
        "cached"  => false,
        "scroll"  => array(
            "enabled" => true,
            "extra_discount" => 87 + 36 + 50, //menu + padding bottom del contenedor del FROMulario 
        ),
        "css" => array(
            "padding-top"    => 0,
            "padding-bottom" => 50,
            "margin-bottom"  => 0,
        ),
    );
    
    $o_form = new \YOBI\COMPONENTS\form_1();
    $o_form = $o_form->config( $a_form );

// configuracion de la vista
    
    $a_parameters['content']['brand']     = FMWK_CLIE_TITU;  
    $a_parameters['content']['tag_title'] = FMWK_CLIE_TITU . " - Principal";

    $a_parameters['control']['navbar-isologo']           = false;
    $a_parameters['control']['navbar-logo-desktop-file'] = FMWK_CLIE_SERV . "project/images/logo/cabecera-logo.fw.png";
    $a_parameters['control']['navbar-brand-isologo']     = false;  
    
    $a_parameters['control']['no_session_elements']      = false;  

// template de la vista
    
    include( "main.html.php" );