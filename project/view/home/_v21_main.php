<?php

//var_dump( __FILE__ );
//var_dump( $oYApp->a_data['usuario'][0]['app_usuario'] );
//exit();

$b_publicidad = false;                                                                              // flag que determina si hay publicidades para mostrar
$i_publicidad_indice = 0;

$s_facebook_appId = "";
$s_usuario_id = $oYApp->a_data['usuario'][0]['id'];
$s_app_rol_id = $oYApp->a_data['usuario'][0]['app_rol_id'];

// 2017.04.17 - obtener grupos de publicidades
$o_grupo = new pr_grupo();
$o_grupo ->enable_relations();
$o_grupo ->aBase['aFilt'][] = "pr_grupo.flag_visible = 1";
$a_grupo = $o_grupo->find();
//var_dump( $a_grupo[0]['pr_publicidad'] );
//exit();

// asignar valores para la vista
$oYApp->a_view[ 's_tag_title' ] = FMWK_CLIE_TITU . " - Principal";
$oYApp->a_view[ 's_app_title' ] = "ARTISTS SUPPORT";

$a_parameters['control']['buttons-views']     = true;
$a_parameters['control']['button-view-general'] = true;
$a_parameters['control']['button-view-card']  = false;
$a_parameters['control']['button-view-list']  = false;
$a_parameters['control']['button-view-image'] = false;
$a_parameters['control']['button-view-map']   = false;
$a_parameters['control']['button-view-data']  = false;
$a_parameters['control']['form-buscar']       = false;
$a_parameters['control']['dropdown-user'] = $oYApp->bLgin;
$a_parameters['control']['menu'] = $oYApp->bLgin;

// obtener el appId de facebook
if ( FMWK_AMBI_CALI )
    $s_facebook_appId = $APP_CONFIGURATION['a_api']['preproduccion']['facebook']['appId'];
else if ( FMWK_AMBI_PROD )
    $s_facebook_appId = $APP_CONFIGURATION['a_api']['produccion']['facebook']['appId'];
$a_parameters['content']['facebook-appId'] = $s_facebook_appId;

//include( "main.html.php" );
//include( "main-clean.html.php" );
include( "main-vimeo-clean.html.php" );