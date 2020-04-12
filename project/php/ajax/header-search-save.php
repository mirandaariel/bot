<?php

//var_dump( __FILE__ );
//var_dump( $_POST );
//var_dump( $_GET );
//exit();

//session_start();

// 2016-05-03 - Obtener la ruta de la aplicacion para poder ubicar el archivo de la clase yApp
$s_app_dire = "";
if ( isset( $_POST['sClie'] ) )
    $s_app_dire = $_POST['sClie'];

// 2017.01.15 - ajuste porque el script se encuentra dentro de la aplicacion
$s_app_dire = dirname( __FILE__ ) . "/../../../";
include_once( $s_app_dire . "project/yApp.php" );
//var_dump( $oYApp );

$aResu['sProc'] = "";
$aResu['bProc'] = true;
$aResu['aDato'] = array();

// guardar los datos en la instancia de la aplicacion
$a_config = array(
    "header-search-input" => array(
        "a_filtro" => array(),
    ),
);

$oYApp->a_view['a_config']['header-search-input']['a_filtro'] = $_POST['data']['a_filtro'];
$oYApp->a_data['a_config']['header-search-input']['a_filtro'] = $_POST['data']['a_filtro'];         // 2017.05.02 - para que acceda home/search
$oYApp->save();

$aResu['aDato']['item'] = $a_item;