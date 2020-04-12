<?php

//session_start();

// variables
    $s_app_dire = FMWK_CLIE_PATH;

// includes
  
// inicializacion del script
  
// 2019.08.17 - debug performance

    // esto no sirve porque no se carga la funcion que levanta las clases laprimera vez que se invocan
    include_once( $_SESSION['CONST']['STRUCTURE_DEFAULT_PATH'] . "yApp.php" );
    $s_FMWK_CLIE_NAME = $_SESSION['CONST']['FMWK_CLIE_NAME'];

    $oYApp = unserialize( $_SESSION['a_app'][ $s_FMWK_CLIE_NAME ] );

    $oYApp->setLinkToFramework();

// logica de la vista del panel - INI
    
    // variables para la vista
    $s_panel_content_title       = "Datos Guardados";
    $s_panel_content_description = "Los informacion ingresada ha sido guardada. Gracias.";

    // determinar si la accion es alta.
    $b_mensaje = isset( $_POST['data']['mensaje'] ) ? true : false;
    
    if( $b_mensaje )
    {
        $s_panel_content_title       = $_POST['data']['mensaje']['title'];
        $s_panel_content_description = $_POST['data']['mensaje']['description'];
    }

// botones
    $a_buttons = array();
        
    $a_buttons[] = array(
        "id"        => "boton_cancelar",
        "label"     => "Volver al Formulario",
        "css_class" => " uk-modal-close",
    );

    $a_buttons[] = array(
        "id"     => "boton_cerrar",
        "label"  => "Ir a Página Principal",
        "href"   => FMWK_CLIE_SERV . "main",
    );

    // array para la vista con la instancia del componente y valores de control
    $a_button_config = array(
        "control" => array(),
        "object"  => null,
    );

    foreach ( $a_buttons as $i_button => $a_button ) 
    {
        // controlar la existencia de la proiedad id
        $a_button['id'] = isset( $a_button['id'] ) ? $a_button['id'] : "button_" . $i_button;
        
        // array auxiliar con la informacion que proviene de la configuracion con la que se invoca a
        // el componente data wells.
        $a_button_data = $a_button;

        // asignacion del template para la vista
        $a_button = $a_button_config;

        // instanciar el objeto componente boton
        $a_button['object'] = new \YOBI\COMPONENTS\INPUT\button_1();
        $a_button['object'] = $a_button['object']->config( $a_button_data );

        // verificar variables de control
        $a_button['control']['href'] = isset( $a_button_data['href'] ) ? true : false;

        $a_buttons[ $i_button ] = $a_button;
    }

include( "modal.html.php" );