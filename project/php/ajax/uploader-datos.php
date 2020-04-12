<?php

//var_dump( $_GET );
//dvar_dump( $_POST );

session_start();

// 2016-05-03 - Obtener la ruta de la aplicacion para poder ubicar el archivo de la clase yApp
$s_app_dire = "";
if ( isset( $_POST['sClie'] ) )
  $s_app_dire = $_POST['sClie'];

//var_dump( $s_app_dire . "project/yApp.php" );
//include_once( $s_app_dire . "project/yApp.php" );

// 2017.01.15 - ajuste porque el script se encuentra dentro de la aplicacion
//include_once( "C:/data/wamp/www/beta/silvestris/" . "project/yApp.php" );
$s_app_dire = dirname( __FILE__ ) . "/../../../";
include_once( $s_app_dire . "project/yApp.php" );

$aPara = $oYApp->oFrameworkConnection->oFramework->aPara;
//var_dump( $oYApp->a_data );

$a_instancia                  = array();
$a_instancia['batch_id']      = $_POST['batch_id'];
$a_instancia['clase_foranea'] = $_POST['clase_foranea'];
$a_instancia['clave_foranea'] = $oYApp->a_data['usuario'][0]['id'];                                 // usuario logueado
$a_instancia['mimgnomb']      = $aPara['mimgnomb'][0];
$a_instancia['aFile']         = $aPara['aFile'];

$o_entidad = new media_imagen();
$a_create  = $o_entidad->create( $a_instancia );

$a_instancia['id'] = $a_create['iIden'];