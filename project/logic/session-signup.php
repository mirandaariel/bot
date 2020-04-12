<?php 

class logic_session_signup {
    
    static public function process_message ( $a_parameters = null ) {
        
        // variables

            global $oYApp;

            $a_result = array(
                "mensaje" => "",
            );

            if ( $oYApp->bLgin )
                $a_result['mensaje'] = "Ya estas registrado";
            
            if ( ! $oYApp->bLgin )
            {
                $s_mensaje_valor = trim( $a_parameters['mensaje'][0]['valor'] );
                $s_mensaje_valor = trim( str_replace( "session sign up:", "", $s_mensaje_valor ) );
                $a_mensaje_valor = explode( ",", $s_mensaje_valor );

                $s_user_nombre   = trim( $a_mensaje_valor[0] );
                $s_user_email    = trim( $a_mensaje_valor[1] );
                $s_user_password = md5( trim( $a_mensaje_valor[2] ) );

                //var_dump( $s_user_email );
                //var_dump( $s_user_password );
                
                $a_registration_result = $oYApp->userResgistration( array( 
                    "data" => array(
                        "nombre"   => $s_user_nombre,
                        "email"    => $s_user_email,
                        "password" => $s_user_password,
                    ),
                ));
                //var_dump( $a_registration_result );
                
                if ( count( $a_mensaje_valor ) < 3 )
                    $a_result['mensaje'] = "Debe ingresar todos los parámetros requeridos: nombre, email y password.";
                else if ( $a_registration_result['bProc'] )
                    $a_result['mensaje'] = "Listo!, se ha creado una nueva cuenta exitosamente";
                else
                    $a_result['mensaje'] = $a_registration_result['sProc'];
                
                if ( $a_registration_result['bProc'] )
                    $a_result['actions'] = array(
                        array(
                            "object"   => "window.location",
                            "property" => "href",
                            "data"     => FMWK_CLIE_SERV,
                        ),
                    );
            }
            
            /*
            
        // logica
            
        // response
            */
            return $a_result;
    }
}
