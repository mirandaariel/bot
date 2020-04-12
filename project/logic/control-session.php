<?php 

class logic_control_session {
    
    static public function process_message ( $a_parameters = null ) {
        
        // variables

            global $oYApp;

            $a_result = array(
                "mensaje" => "",
            );

            $s_mensaje_valor = trim( $a_parameters['mensaje'][0]['valor'] );
            $a_mensaje_valor = explode( " ", $s_mensaje_valor );

            $a_mensaje_response = array(
                "He verificado y no existe una sesion activa. ¿tTe gustaría iniciar sesión o registrarte?. <br>",
            );

        // logica

            if ( ! $oYApp->bLgin )
                $a_result['mensaje'] = $a_mensaje_response[0];

        // response
 
            return $a_result;
    }
}
