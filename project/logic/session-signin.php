<?php 

class logic_session_signin {
    
    static public function process_message ( $a_parameters = null ) {
        
        // variables

            global $oYApp;

            $a_result = array(
                "mensaje" => "",
            );

            if ( $oYApp->bLgin )
                $a_result['mensaje'] = "Ya has iniciado una sesion";
            
            if ( ! $oYApp->bLgin )
            {
                $s_mensaje_valor = trim( $a_parameters['mensaje'][0]['valor'] );
                $s_mensaje_valor = trim( str_replace( "session sign in:", "", $s_mensaje_valor ) );
                $a_mensaje_valor = explode( ",", $s_mensaje_valor );

                $s_user_email    = trim( $a_mensaje_valor[0] );
                $s_user_password = md5( trim( $a_mensaje_valor[1] ) );

                //var_dump( $s_user_email );
                //var_dump( $s_user_password );

                $a_login_result = $oYApp->login( array( 
                    "data" => array(
                        "email"    => $s_user_email,
                        "password" => $s_user_password,
                    ),
                ));
                //var_dump( $a_login_result );
                
                if ( $a_login_result['bProc'] )
                    $a_result['mensaje'] = "Listo!, has iniciado la sesion exitosamente";
                else
                    $a_result['mensaje'] = $a_login_result['sProc'];
                
                if ( $a_login_result['bProc'] )
                    $a_result['actions'] = array(
                        array(
                            "object"   => "window.location",
                            "property" => "href",
                            "data"     => FMWK_CLIE_SERV,
                        ),
                    );
            }
            
        // logica
            
        // response
 
            return $a_result;
    }
}
