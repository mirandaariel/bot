<?php

session_start();
//var_dump( $_SESSION );

// variables
    $s_post = "";

    $aResu['sProc'] = "";
    $aResu['bProc'] = true;
    $aResu['aDato'] = array();

    //$s_file_structure_settings = dirname(__FILE__)."/../../../../../../structure-settings.php";
    $s_file_structure_settings = $_SESSION['CONST']['FMWK_CLIE_PATH'] . "structure-settings.php";

// includes
    include_once( $s_file_structure_settings );

switch ( $_POST['action'] ) 
{
    case 'obtener-contenido':
        
        include( "modal.php" );

        break;
    default:
        # code...
        break;
}
