<?php

class form_mensaje_action {
    
    static public function create_pre ( $a_parameters = null ) {
        
        global $oYApp;

        $a_result = array(
            "actions" => array(),
        );

        $a_result['actions'] = array(
            array(
                "object" => "YOBI.APP.containers['container_contenido']",
                "method" => "replace_content_data",
                "data"   => "Pensando...",
            ),
        );
        
        return $a_result;
    }

    static public function create ( $a_parameters = null ) {
        
        global $oYApp;

        $a_result = array(
            "actions" => array(),
        );

        $a_result['actions'] = array(
            array(
                "object" => "YOBI.APP",
                "method" => "broadcast_container_value",
                "data"   => $a_parameters,
            ),
        );
        
        return $a_result;
    }
}

