<?php

//var_dump( $_GET );
//var_dump( $_POST );
//exit();

//session_start();

// 2016-05-03 - Obtener la ruta de la aplicacion para poder ubicar el archivo de la clase yApp
$s_app_dire = "";
if ( isset( $_POST['sClie'] ) )
  $s_app_dire = $_POST['sClie'];

// 2017.01.15 - ajuste porque el script se encuentra dentro de la aplicacion
$s_app_dire = dirname( __FILE__ ) . "/../../../";
include_once( $s_app_dire . "project/yApp.php" );

$aPara = $oYApp->oFrameworkConnection->oFramework->aPara;

// declaracion de variables
$s_batch_id = $_POST['batch_id'];

$a_resumen = array(
    "archivos_cargados" => 0,
    "archivos_aceptados" => 0,
    "archivos_rechazados" => 0,
);

$o_base = new base();

// obtener informacion global sobre los archivos subidos.

$s_sql = "SELECT 
    flag_geo,
    COUNT(*) cantidad 
    FROM media_imagen 
    WHERE batch_id = '$s_batch_id'
    GROUP BY flag_geo";
$a_sql = $o_base->procSent( $s_sql );
$a_data = $a_sql['aDato'];

foreach ( $a_data as $i_instancia => $a_instancia ) 
{
    $a_resumen['archivos_cargados'] += $a_instancia['cantidad'];

    if ( $a_instancia['flag_geo'] == "0" )
        $a_resumen['archivos_rechazados'] = $a_instancia['cantidad'];
    else if ( $a_instancia['flag_geo'] == "1" )
        $a_resumen['archivos_aceptados'] = $a_instancia['cantidad'];
}

// envío via email del resultado de la carga de archivos de imagenes.

// preparar informacion para la vista
$aResu['aDato']['resumen'] = $a_resumen;
$aResu['bProc'] = true;