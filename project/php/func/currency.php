<?php 

class currency {
    
    public $s_apikey_current = null;

    public $a_api = array(
        "amdoren" => array(
            "api_key"   => "nXHrzdntFvV9wKJAP5AWkw2GKvMfz3",
            "resources" => array(
                "conversion" => array(
                    "method"         => "GET",
                    "url_endpoint"   => "https://www.amdoren.com/api/currency.php",
                    "url_parameters" => array(
                        "api_key"       => "api_key",
                        "currency_from" => "from",
                        "currency_to"   => "to",
                        "ammount"       => "amount"
                    ),
                    "response"  => array(
                        "rate" => "amount",
                    ),
                ),
            ),
        ),
    );

    public function currency () {}

    public function get_vendor( $a_parameters = null ) {
        $this->s_apikey_current = $this->a_api['amdoren']['api_key'];
        return $this->a_api['amdoren'];
    }

    public function get_conversion( $a_parameters = null ) {
        
        $a_result   = array();
        $a_vendor   = $this->get_vendor();
        $a_resource = $a_vendor['resources']['conversion'];
        
        $s_url_parameters = $this->build_url_parameters_string( array(
            "resource" => $a_resource,
            "values"   => $a_parameters, 
        ));

        $s_url_endpoint = $a_resource['url_endpoint'] . $s_url_parameters;

        $a_request = request::send( array(
            "method"   => $a_resource['method'],
            "url"      => $s_url_endpoint,
        ));

        foreach ( $a_resource['response'] as $s_our_key => $s_vendor_key ) 
            $a_result[ $s_our_key ] = $a_request[ $s_vendor_key ];

        return $a_result;
    }

    public function build_url_parameters_string( $a_parameters = null ) {
        $s_url_parameters = empty( $a_parameters['resource']['url_parameters'] ) ? "" : "?";
        
        foreach ( $a_parameters['resource']['url_parameters'] as $s_parameter_id => $s_parameter_value ) 
        {
            if ( $s_parameter_id == "api_key" )
                $a_parameters['values'][ $s_parameter_id ] = $this->s_apikey_current;                

            if ( isset( $a_parameters['values'][ $s_parameter_id ] ) )
                $s_url_parameters .= ( $s_url_parameters != "?" ? "&" : "" ) . 
                    "$s_parameter_value=" . $a_parameters['values'][ $s_parameter_id ];
        }

        return $s_url_parameters;
    } 
}