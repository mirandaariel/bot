<?php

// inicializacion del script

    session_start();

// variables

    $a_result = array();

// 2019.08.22 - logica

    if ( isset( $_SESSION['filters'] ) )
        $a_result = $_SESSION['filters'];
    
// devolucion

    $aResu['sProc'] = "";
    $aResu['bProc'] = true;
    $aResu['aDato'] = $_POST;
    $aResu['aDato']['filters'] = $a_result;

    echo json_encode( $aResu );