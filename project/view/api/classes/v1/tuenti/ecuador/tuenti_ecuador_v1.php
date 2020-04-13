<?php

class tuenti_ecuador_v1 extends class_base{
    
    public $s_key_file = "";
    public $a_resource = array();

    public function __construct() {}
    
    public function pin() {
        $this->exec_resource( "pin" );
        // TODO: definir la logica custom de cada implementacion
        // TODO: luego realizar el envio del los headers y json
    }

    public function messageMT() {
        $this->exec_resource( "messageMT" );
        // TODO: definir la logica custom de cada implementacion
        // TODO: luego realizar el envio del los headers y json
    }

    public function messageMTBulk() {
        $this->exec_resource( "messageMTBulk" );
        // TODO: definir la logica custom de cada implementacion
        // TODO: luego realizar el envio del los headers y json
    }

    public function token() {
        
        $s_key_file_path = $this->class_folder.$this->s_key_file;

        $o_jwt = new jwt();
        
        $a_jwt_result = $o_jwt->decrypt( 
            array(
                "token"    => $this->id,
                "key_file" => $s_key_file_path,
            ) 
        );

        $a_message = array(
            "ok"    => "User validated by UpLink",
            "error" => "User no validated by UpLink",
        );

        //var_dump( $a_jwt_result );
        $b_status      = false;
        $a_jwt_payload = array();

        if ( isset( $a_jwt_result['payload'] ) )
        {
            $a_jwt_payload = json_decode( $a_jwt_result['payload'], true );
            if ( is_null( $a_jwt_payload ) )
                $a_jwt_payload = array();
        }
       
        if( ! empty( $a_jwt_payload ) )
        {
            $b_status = $a_jwt_payload['status'] == 1 ? true : false;

            $a_jwt_result['success'] = $b_status;
            $a_jwt_result['code']    = $b_status ? 200 : 404;
            $a_jwt_result['message'] = $b_status ? $a_message['ok'] : $a_message['error'];
        }

        //if ( $a_jwt_result['isVerified'] )
        if ( $b_status )
            $this->send_200( array(
                "Description" => "User validated by UpLink", 
                "Vendor"  => $a_jwt_result, 
            ));  
        else
            $this->send_404( array(
                "Description" => "User no validated by UpLink", 
                "Vendor" => $a_jwt_result, 
            ));  
    }

    public function notification() {

        // const
        define("RECEPCION_EXITOSA", 0);
        define("ID_DE_SERVICIO_INVALIDO", 113);
        /*
        const RECEPCION_EXITOSA                     = 0;
        const ALTA                                  = 100;
        const RENOVACION_SUSCRIPCION                = 101;
        const RENOVACION_PARCIAL_SUSCRIPCION        = 102;
        const BAJA                                  = 103;
        const SALDO_INSUFICIENTE                    = 104;
        const REINTENTO_ENCOLADO                    = 105;
        const CANTIDAD_DE_ENVIOS_MT_EXCEDIDOS       = 106;
        const ERROR_DE_AUTENTICACION_POR_HEADERS    = 107; // Error de Autenticación - Headers
        const RPS_EXCEDIDOS                         = 108; // Request per Second (RPS) excedidos
        const ERROR_CON_EL_SISTEMA_DE_TRANSACCION   = 109;
        const MSISDN_INVALIDO                       = 110;
        const ENVIO_MT_DUPLICADO                    = 112;
        const ID_DE_SERVICIO_INVALIDO               = 113; // ID Servicio es invalido
        const SC_INVALIDO                           = 114; // SC es inválido
        const CANAL_INVALIDO                        = 115; // Canal es inválido
        const ID_DE_SUSCRIPCION_INVALIDO            = 116;
        const SUSCRIPCION_EN_ESTADO_DE_CONFIRMACION = 117;
        */
        $messages = [
            "RECEPCION_EXITOSA"                     => 'Recepción exitosa',
            "ALTA"                                  => 'Alta',
            "RENOVACION_SUSCRIPCION"                => 'Renovacion Suscripción',
            "RENOVACION_PARCIAL_SUSCRIPCION"        => 'Renovacion parcial Suscripción',
            "BAJA"                                  => 'Baja',
            "SALDO_INSUFICIENTE"                    => 'Saldo insuficiente',
            "REINTENTO_ENCOLADO"                    => 'Reintento encolado',
            "CANTIDAD_DE_ENVIOS_MT_EXCEDIDOS"       => 'Cantidad de envíos MT excedidos',
            "ERROR_DE_AUTENTICACION_POR_HEADERS"    => 'Error de Autenticación - Headers',
            "RPS_EXCEDIDOS"                         => 'Request per Second (RPS) excedidos',
            "ERROR_CON_EL_SISTEMA_DE_TRANSACCION"   => 'Error con el Sistema de Transacción',
            "MSISDN_INVALIDO"                       => 'MSISDN es inválido',
            "ENVIO_MT_DUPLICADO"                    => 'Envío MT duplicado',
            "ID_DE_SERVICIO_INVALIDO"               => 'ID Servicio es inválido',
            "SC_INVALIDO"                           => 'SC es inválido',
            "CANAL_INVALIDO"                        => 'Canal es inválido',
            "ID_DE_SUSCRIPCION_INVALIDO"            => 'ID de suscripción inválido',
            "SUSCRIPCION_EN_ESTADO_DE_CONFIRMACION" => 'Suscripción en estado de confirmación'
        ];

        // variables
        $a_valid_service_id = array(1,2);
        
        $a_request_data = $this->get_request_data();
        $b_request_data = ! empty( $a_request_data );
        
        $s_service_id_key   = "serviceID";
        $b_service_id_param = $b_request_data ? isset( $a_request_data[ $s_service_id_key ] ) : false;
        $i_service_id_value = $b_service_id_param ? $a_request_data[ $s_service_id_key ] : 0;
        
        $b_service_id_valid = in_array( $i_service_id_value, $a_valid_service_id );

        $s_status_code    = $b_service_id_valid ? RECEPCION_EXITOSA : ID_DE_SERVICIO_INVALIDO; 
        $s_status_message = $b_service_id_valid ? $messages['RECEPCION_EXITOSA'] : $messages['ID_DE_SERVICIO_INVALIDO'];

        $a_result = array( 
            "statusCode"    => $s_status_code,
            "statusMessage" => $s_status_message,
        );

        log::add_entry( array( 
            "operator" => "tuenti_ecuador",
            "data"     => $a_request_data 
        ) );

        if ( $b_service_id_valid )
            $this->send_200( array(
                "base"    => $a_result,
                //"Vendor"  => $a_result, 
            ) );
        else
            $this->send_404(array(
                "base"    => $a_result,
                //"Vendor"  => $a_result, 
            ) );
    }
}