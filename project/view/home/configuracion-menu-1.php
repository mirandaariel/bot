<?php 

// variables 
    $i_rol = $oYApp->a_data['usuario'][0]['app_rol_id'];
    
    $s_view = $oYApp->aGet_['s_complete'];
    $s_view = str_replace( "/". FMWK_CLIE_ROOT, "", $s_view );
    $s_view = str_replace( FMWK_CLIE_ROOT, "", $s_view );
    $s_view = FMWK_CLIE_SERV . $s_view;

    $a_items = array(
        array(
            "label" => "inicio",
            "url"   => FMWK_CLIE_SERV . "main",
        ),
        array(
            "label" => "Artistas",
            "url"   => FMWK_CLIE_SERV . "artists/list/state",
        ),
        /*
        array(
            "label" => "Vendedores",
            "url"   => FMWK_CLIE_SERV . "sellers",
        ),
        */
        array(
            "label" => "Sistema",
            "url"   => FMWK_CLIE_SERV . "system/entities",
        ),
    );

// control de acuerdo a la vista actual
    if ( $s_view == FMWK_CLIE_SERV . "main" );
        unset( $a_items[0] );

// control de acuerdo con el rol de usuario

    // los roles usuario y reclutador no pueden ingresar al sistema de administracion.
    if ( in_array( $i_rol, array(2,4) ) )
        unset( $a_items[3] );

    // el rol usuario no puede acceder a las vistas de informacion de los fotografos ni vendedores
    if ( in_array( $i_rol, array(2) ) )
    {
        unset( $a_items[1] );
        unset( $a_items[2] );
    }

$a_parameters['control']['menu_1'] = array(
    "show"  => true,
    "items" => $a_items,
);

