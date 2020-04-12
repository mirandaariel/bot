<?php

/*/ debug
    var_dump( $oYApp );
    exit();
    //*/

// definir componentes - INI
    
    // rutas
    define( "THEME_PATH", STRUCTURE_DEFAULT_PATH . "themes/airbnb/" );
    define( "COMPONENT_PATH", THEME_PATH . "components/" );

    // componentes de layout
    define( "COMPONENT_LINK", COMPONENT_PATH . "layout/link/general/1/link.php" );
    //define( "COMPONENT_NAVBAR", COMPONENT_PATH . "layout/navbar/1/navbar.php" );
    //define( "COMPONENT_MENU_1", COMPONENT_PATH . "layout/menu-1/1/menu-1.php" );
    //define( "COMPONENT_MENU_2", COMPONENT_PATH . "layout/menu-2/1/menu-2.php" );
    //define( "COMPONENT_PANEL_LEFT", COMPONENT_PATH . "layout/panel/left/1/panel-left.php" );
    //define( "COMPONENT_PANEL_RIGHT", COMPONENT_PATH . "layout/panel/right/1/panel-right.php" );


// control de inicio de sesion

    $b_user_session    = $oYApp->bLgin;
    $b_user_temp       = is_null( $oYApp->iUsrt ) ? false : true;
    $b_user_habilitado = false;

    if ( $b_user_session )
        $b_user_habilitado = true;
    else if ( ! $b_user_session && $b_user_temp )
        $b_user_habilitado = false;

    if ( $b_user_habilitado )
        header( "location: " . FMWK_CLIE_SERV . "main" );
    //*/

/*/ configuracion local de componentes que no tienen la estructura de objeto sino scripts php y html

    $a_componente_navbar = array(
        "search" => array(
            "custom"    => FMWK_CLIE_PATH . "project/view/home/component_navbar_1.cls",
            "ajax_file" => FMWK_CLIE_SERV . "project/php/ajax/header-search-input.php",
        ),
        "sesion_elementos" => array(
            array(
                "href"  => FMWK_CLIE_SERV . "records/upload",
                "label" => "",
                //"img"   => STRUCTURE_VENDORS_HTTP . "icons/material.io/web/ic_camera_alt_black_48dp_2x.png",
                "icon"  => "camera",
                "tooltip" => "Subir Fotos"
            ),
        ),
    );
    //*/
    
// obtener anuncios
    //$a_anuncio = pr_anuncio::get_importants();
    //var_dump( $a_anuncio );
    //exit();

// imagenes

    $s_image_desktop   = FMWK_CLIE_SERV . "project/images/home/index/singer-01_1400x691.jpg";
    $s_image_tablet    = FMWK_CLIE_SERV . "project/images/home/index/singer-01_800x719.jpg";
    $s_image_landscape = FMWK_CLIE_SERV . "project/images/home/index/singer-01_632x326.jpg";
    $s_image_portrait  = FMWK_CLIE_SERV . "project/images/home/index/singer-01_311x603.jpg";

// configuracion de la vista
    $a_parameters['content']['tag_title'] = FMWK_CLIE_TITU;
    $a_parameters['content']['brand']     = FMWK_CLIE_TITU;  

    $a_parameters['control']['navbar-isologo']           = false;
    $a_parameters['control']['navbar-logo-desktop-file'] = FMWK_CLIE_SERV . "project/images/logo/cabecera-logo.fw.png";
    $a_parameters['control']['navbar-brand-isologo'] = false;  
    //$a_parameters['control']['form-buscar-action']   = 1;
    //$a_parameters['control']['form-buscar']          = true;

include( "index.html.php" );
//include( "index.html.php" );

//header( "location: " . FMWK_CLIE_SERV );