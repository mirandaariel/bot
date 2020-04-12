<?php 

class logic_session_logout {
    
    static public function process_message ( $a_parameters = null ) {
        
        // variables

            global $oYApp;

            $a_result = array(
                "mensaje" => "",
            );

            if ( $oYApp->bLgin )
            {
                $a_result['mensaje'] = "Se esta cerrando la sesión.";
            
                $a_result['actions'] = array(
                    array(
                        "object"   => "window.location",
                        "property" => "href",
                        "data"     => FMWK_CLIE_SERV . "logout",
                    ),
                );
            }
            
            return $a_result;
    }
}
