<?php 

$s_view = $oYApp->aGet_['s_complete'];
$s_view = str_replace( "/". FMWK_CLIE_ROOT, "", $s_view );
$s_view = str_replace( FMWK_CLIE_ROOT, "", $s_view );
$s_view = FMWK_CLIE_SERV . $s_view;

$a_parameters['control']['menu_1'] = array(
    "show" => true,
    "items" => array(
        array(
            "label" => "Inicio",
            "url"   => FMWK_CLIE_SERV . "main",
        ),
    ),
);