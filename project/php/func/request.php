<?php

class request {

    static public function send( $a_parameters = null ){
        
        // variables
        $s_result  = "";
        $a_result  = array();
        
        $s_url      = isset( $a_parameters['url'] ) ? $a_parameters['url'] : "";
        $s_method   = isset( $a_parameters['method'] ) ? $a_parameters['method'] : "";
        $a_data     = isset( $a_parameters['data'] ) ? $a_parameters['data'] : array();
        $a_headers  = isset( $a_parameters['headers'] ) ? $a_parameters['headers'] : array();
        
        $b_headers = ! empty( $a_headers );
        
        //Initiate cURL.
        $ch = curl_init( $s_url );
    
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $s_method);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    
        // SSL isues
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $a_data);
    
        //Set the content type to application/json
        if ( $b_headers )
            curl_setopt($ch, CURLOPT_HTTPHEADER, $a_headers);
    
        //Execute the request
        $s_result = curl_exec($ch);
    
        if( $s_result === false)
        {
            var_dump( $s_result );
            echo 'Curl error: ' . curl_error($ch) . "<br/>";
        }
        
        $a_result = json_decode($s_result, true );
        
        return $a_result;
    }
}