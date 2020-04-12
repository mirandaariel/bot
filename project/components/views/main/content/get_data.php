<?php

// inicializacion
    session_start();

// 2019.08.17 - debug performance

    // esto no sirve porque no se carga la funcion que levanta las clases la primera vez que se invocan
    // es necesario disparar setLinkToFramework()

    include_once( $_SESSION['CONST']['STRUCTURE_DEFAULT_PATH'] . "yApp.php" );

    $s_FMWK_CLIE_NAME = $_SESSION['CONST']['FMWK_CLIE_NAME'];

    $oYApp = unserialize( $_SESSION['a_app'][ $s_FMWK_CLIE_NAME ] );

    $oYApp->setLinkToFramework();

// variables
    
    $aResu = array(
        "iEsta" => 1,                                                                                                   // codigo de ejecucion exitosa [1:ok|0:error]
        "sEsta" => "",                                                                                                  // string de ejecucion mensaje, cuando hay error.
        "iCant" => 0,                                                                                                   // cantidad de registros afectados
        "aDato" => array(),                                                                                             // contendra todo los datos del resultado de la consulta
    );

    $a_items = array();

// testing

    $s_mensaje    = "";
    $i_mensaje_id = $_POST['a_crud_result']['iIden'];

    $o_mensaje = new mensaje();
    $o_mensaje ->enable_relations();
    $a_mensaje = $o_mensaje->read( array( "id" => $i_mensaje_id ));
    
    if ( ! empty( $a_mensaje[0]['respuesta'] ))
        $s_mensaje .= $a_mensaje[0]['respuesta'][0]['valor'] . "<br>";
    
    if ( ! empty( $a_mensaje[0]['accion'] ))
    {
        foreach ( $a_mensaje[0]['accion'] as $i_accion => $a_accion ) 
        {
            $s_accion_resultado = $a_accion['resultado'];
            $a_accion_resultado = json_decode( $s_accion_resultado, true );
            
            if ( $a_accion_resultado['mensaje'] != "" )
                $s_mensaje .= $a_accion_resultado['mensaje'];
        }
    }

    if ( $s_mensaje == "" )
        $s_mensaje = "Discúlpame, no te he entendido.";

// logica

// enviar datos

    if ( isset( $a_accion_resultado['actions'] ) )
        $aResu['aDato']['actions'] = $a_accion_resultado['actions'];

    $aResu['aDato']['content'] = $s_mensaje;
    
    echo json_encode( $aResu );