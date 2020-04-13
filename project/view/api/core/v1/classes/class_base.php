<?php

class class_base {
    
    public $id = null;
    public $action = null;
    public $class_folder = null;
    public $config_file = null;

    public $a_service = array();
    public $a_status_code_group_key = array("base", "header");

    public $a_status_code = array(
        "200" => array(
            "base" => array(
                "Type"        => "Success",
                "Status"      => 200,
                "Message"     => "Ok",
                "Description" => "HTTP response success",
                "Vendor"      => "",
                "Client"      => "",
            ),
            "header" => array(),
        ),
        "400" => array(
            "base" => array(
                "Type"        => "Client Error",
                "Status"      => 400,
                "Message"     => "Bad Request",
                "Description" => "HTTP response for the request by the client was not processed, as the server could not understand what the client is asking for",
                "Required"    => array(),            ),
            "header" => array(),
        ),
        "404" => array(
            "base" => array(
                "Type"        => "Client Error",
                "Status"      => 404,
                "Message"     => "Not Found",
                "Description" => "HTTP response for the requested resource is not available to access",
                "Vendor"      => "",
            ),
            "header" => array(),
        ),
        "405" => array(
            "base" => array(
                "Type"        => "Client Error",
                "Status"      => 405,
                "Message"     => "Method Not Allowed",
                "Description" => "The request method is known by the server but is not supported by the target resource.",
            ),
            "header" => array(
                "Allow" => "GET, POST, HEAD",
            ),
        ),
        "500" => array(
            "base" => array(
                "Type"        => "Server Error",
                "Status"      => 500,
                "Message"     => "Internal Server Error",
                "Description" => "HTTP response indicates that there might be a system failure.",
                "Vendor"      => "",
            ),
            "header" => array(),
        )
    );

    public function __construct() {}
    
    public function info() {
        $this->send_404();
    }

    public function pin() {
        $this->send_404();
    }

    public function messageMT() {
        $this->send_404();
    }

    public function messageMTBulk() {
        $this->send_404();
    }

    public function token() {

        //$a_result = $this->get_404_array();
        //$s_result = json_encode( $a_result );

        //$this->send_404( array( "result" => $s_result ) );
        $this->send_404();
    }

    public function notification() {

        //$a_result = $this->get_404_array();
        //$s_result = json_encode( $a_result );

        //$this->send_404( array( "result" => $s_result ) );
        $this->send_404();
    }

    public function get_class_folder() {
        return $this->class_folder;
    }

    public function get_request_method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get_request_id() {
        return $this->id;
    }

    public function get_request_action() {
        return $this->action;
    }

    public function get_request_data() {
        //var_dump("get_request_data");
        //var_dump( $_POST );
        //var_dump( file_get_contents('php://input') );

        $a_data = array();
        
        $s_request_method = $this->get_request_method();
        
        if ( ! is_null( $this->id ) && $s_request_method == "GET" )
        {
            //var_dump( 1 );
            // Method GET
            $a_data = array( "id" => $this->id );
        }
        if ( ! is_null( $this->id ) && $s_request_method == "POST" )
        {
            //var_dump( 2 );
            $a_data = $_POST;
            $a_data['id'] = $this->id;
        }
        else if ( ! empty( $_POST ) )
        {
            //var_dump( 3 );
            // Request Header Content-Type: application/x-www-form-urlencoded
            $a_data = $_POST;
        }
        else
        {
            //var_dump( 4 );
            
            // Request Header Content-Type: application/json
            $s_data_json = file_get_contents('php://input');
            //var_dump( $s_data_json );
            //var_dump( $s_request_method );

            if ( $s_request_method == "POST" ) {
                $a_data = json_decode( $s_data_json, true );
                //echo "<pre>";var_dump($a_data);echo "</pre>";
            } else {

                $a_data_json = explode("&", $s_data_json );
                //var_dump( $a_data_json );

                foreach( $a_data_json as $s_key_value )
                {
                    $a_key_value = explode("=", $s_key_value);
                    
                    if ( isset( $a_data[ $a_key_value[0] ] ) )
                        $a_data[ $a_key_value[0] ] = $a_key_value[1];
                }
            }
        }
        //var_dump( $a_data );
        return $a_data;
    }

    public function send( $x_code, $a_parameters ) {

        // 2020.01.08 - carrier-country maybe define his required structure response
        $b_custom_base = isset( $a_parameters['base'] );

        // get default status code data
        // verify status code data from $a_parameters
        $a_status_code = $this->update_status_code($x_code, $a_parameters);
        //var_dump( $a_status_code );

        // send header to the response
        $this->output_headers($a_status_code);

        // send JSON to the resonse        
        $a_output = $b_custom_base ? $a_parameters['base'] : $a_status_code;
        $this->output_json($a_output);

        exit();
    }

    public function send_200( $a_parameters = null ) {
        $this->send(200, $a_parameters);
    }

    public function send_400( $a_parameters = null ) {
        $this->send(400, $a_parameters);
    }

    public function send_404( $a_parameters = null ) {
        $this->send(404, $a_parameters);
    }

    public function send_405( $a_parameters = null ) {
        $this->send(405, $a_parameters);
    }

    public function send_500( $a_parameters = null ) {
        $this->send(500, $a_parameters);
    }

    function send_request( $a_parameters = null ){
		
        // variables
        $s_result  = "";
        $a_result  = array();
        
        $s_url      = isset( $a_parameters['url'] ) ? $a_parameters['url'] : "";
        $s_method   = isset( $a_parameters['method'] ) ? $a_parameters['method'] : "";
        $s_function = isset( $a_parameters['function'] ) ? $a_parameters['function'] : "";
        $a_data     = isset( $a_parameters['data'] ) ? $a_parameters['data'] : array();
        $a_headers  = isset( $a_parameters['headers'] ) ? $a_parameters['headers'] : array();
        
        $b_headers = ! empty( $a_headers );
        
        //var_dump( $s_url );
        //var_dump( $a_data );

        //$s_data     = json_encode( $a_data );
        
        //Initiate cURL.
        $ch = curl_init( $s_url );
    
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $s_method);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    
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
        
        //var_dump( $s_result );
        //var_dump( $a_result );
        //var_dump( $_COOKIE );
    
        return $a_result;
    }

    public function output_headers( $a_status_code ) {
        
        // prepare header response
        $s_status  = $a_status_code['base']['Status'];
        $s_message = $a_status_code['base']['Message'];

        header("HTTP/1.0 $s_status $s_message");
        header('Content-type: application/json');

        foreach( $a_status_code['header'] as $s_key => $s_value )
            header("$s_key: $s_value");
    }

    public function output_json( $a_status_code ) {
        if ( isset( $a_status_code['header'] ) )
            $a_result = array_merge( $a_status_code['base'], $a_status_code['header'] );
        else
            $a_result = $a_status_code;

        $s_result = json_encode( $a_result );

        echo $s_result;
    }

    public function update_status_code ( $x_code, $a_parameters ) {

        // get default status code data
        $a_status_code = $this->get_status_code_data( $x_code );

        // verify status code data from $a_parameters
        foreach( $this->a_status_code_group_key as $i_group_key => $s_group_key )
        {   
            foreach( $a_status_code[ $s_group_key ] as $s_key => $s_value )
            {
                if ( isset( $a_parameters[ $s_key ] ) )
                    $a_status_code[ $s_group_key ][ $s_key ] = $a_parameters[ $s_key ];
            }
        }
        
        return $a_status_code;
    }

    public function client_request_verify_method( $s_resource ) {
        
        $b_resource_allow_method = false;
        $s_resource_allow_method = "";

        $s_request_method  = $this->get_request_method();
        
        if ( isset($this->a_resource[ $s_resource ]) )
        {
            $a_resource_config = $this->a_resource[ $s_resource ];
                
            $a_resource_allow_method = $a_resource_config['allow_method'];
            $s_resource_allow_method = implode(", ", $a_resource_allow_method);
            $b_resource_allow_method = in_array($s_request_method, $a_resource_allow_method);
        }

        // control if request method is not supported
        if( !$b_resource_allow_method )
            $this->send_405( array( "Allow" => "$s_resource_allow_method" ) );
    }

    public function client_request_verify_data(  $s_resource ) {
        //var_dump( "client_request_verify_data" );

        $s_request_method  = $this->get_request_method();
        $s_request_action  = $this->get_request_action();
        $a_request_data    = $this->get_request_data();
        $a_resource_config = $this->a_resource[ $s_resource ];
        
        $a_required_params = array();

        $s_resource_config = $s_request_method;
        if( ! is_null( $s_request_action ) && $s_request_action != "" )
            $s_resource_config .= "_$s_request_action";

        if ( isset( $a_resource_config['method'][ $s_resource_config ] ))
        {
            $a_method_config      = $a_resource_config['method'][ $s_resource_config ];
            $a_method_data_client = $a_method_config['data_client'];
            $a_method_data        = $a_method_config['data'];      
        }

        //var_dump( $a_method_data );

        foreach( $a_method_data_client as $i_key => $s_key )
            if ( ! isset( $a_request_data[ $s_key ] ) &&
                 is_null( $a_method_data[ $s_key ] ) )
                $a_required_params[] = $s_key;    
        
        if( ! empty( $a_required_params ) )
            $this->send_400( array( "Required" => $a_required_params ) );    
    }

    public function vendor_request_mapping_data( $s_resource ) {
        //var_dump( "vendor_request_mapping_data" );

        $x_vendor_data    = array();
        $s_request_method = $this->get_request_method();
        $s_request_action = $this->get_request_action();
        $a_request_data   = $this->get_request_data();
        
        $s_resource_config = $s_request_method;
        if( ! is_null( $s_request_action ) && $s_request_action != "" )
            $s_resource_config .= "_$s_request_action";

        // get resource config data 
        $a_resource_config = $this->a_resource[ $s_resource ];
        
        if ( isset( $a_resource_config['method'][ $s_resource_config ] ))
        {
            $a_method_config  = $a_resource_config['method'][ $s_resource_config ];
            $a_method_data    = $a_method_config['data']; 
            $a_method_mapping = $a_method_config['data_mapping'];     
        }
        
        // data mapping
        $a_message = array();
        foreach( $a_method_data as $s_key => $x_value )
        {
            //var_dump( $s_key );
            $x_vendor_data[ $s_key ] = $x_value;

            if ( ! isset( $a_method_mapping[ $s_key ] ) )
                continue;

            // controlar los valores por defecto para los servicios
            if( $s_key == "message" )
            {
                if ( isset( $a_message[ $s_key ] ) )
                {
                    if ( isset( $a_message[ $s_key ][ $s_resource ] ) )
                    {
                        $x_vendor_data[ $s_key ] = $a_message[ $s_key ][ $s_resource ]; 
                    }
                }
            }

            //if ( is_null($x_value) && isset( $a_request_data[ $a_method_mapping[ $s_key ] ] ) )
            if ( isset( $a_request_data[ $a_method_mapping[ $s_key ] ] ) )
                $x_vendor_data[ $s_key ] = $a_request_data[ $a_method_mapping[ $s_key ] ];
            //else
            //    $x_vendor_data[ $s_key ] = $x_value;
            
            // 2020.01.02 - la key "service_id" es nuestra, no se conoce como pueden implementarla otras interfaces
            //              tiene que ser uno, sino el primero, de los parametros definidos
            if ( $a_method_mapping[ $s_key ] == "service_id" )
            {
                $s_service_id = $x_vendor_data[ $s_key ];
                //var_dump( $s_service_id );

                if ( isset( $this->a_service[$s_service_id] ) )
                    $a_message = $this->a_service[$s_service_id];
            }

            //var_dump( $a_message );
        }



        //var_dump( $x_vendor_data );
        return $x_vendor_data;
    }

    public function vendor_request_verify_datatype( $s_resource, $x_vendor_data ) {
        // get resource config data 
        $s_request_method  = $this->get_request_method();
        $a_resource_config = $this->a_resource[ $s_resource ];
        
        if ( isset( $a_resource_config['method'][ $s_request_method ] ))
            $a_method_config  = $a_resource_config['method'][ $s_request_method ];
        
        if ( isset( $a_method_config['data_type'] ) )
            if ( $a_method_config['data_type'] == "json" )
                $x_vendor_data = json_encode($x_vendor_data);
        
        return $x_vendor_data;
    }

    public function get_status_code_data ( $x_code ) {
        $s_code = is_int( $x_code ) ? "$x_code" : $x_code;
        return $this->a_status_code[ $s_code ];
    }

    public function get_parameter( $s_key, $a_parameters ) {
        if ( is_null( $a_parameters ) )
            return "";
        else if ( isset( $a_parameters[ $s_key ] ) )
            return $a_parameters[ $s_key ];
        else
            return "";
    }

    public function set_id( $x_id ) {
        $x_id = is_int( $x_id ) ? "$x_id" : $x_id;
        $this->id = $x_id;
    }

    public function set_action( $s_action ) {   
        $this->action = $s_action;
    }
    
    public function set_class_folder( $s_class_folder ) {   
        $this->class_folder = $s_class_folder;
    }

    public function set_config_file( $s_config_file ) {   
        //var_dump("set_config_file");
        //var_dump($s_config_file);

        $s_config_content = file_get_contents($s_config_file);
        $a_config_content = json_decode( $s_config_content, true );
        //echo $página_inicio;
        //var_dump( $a_config_content );

        $this->s_key_file = $a_config_content['carrier']['public_key']['file_name'];
        $this->a_resource = $a_config_content['carrier']['resource'];
        $this->a_service  = $a_config_content['service'];

        //$this->class_folder = $s_class_folder;
    }

    public function exec_resource( $s_resource ) {
        
        //$s_resource = "pin";
        $x_vendor_data = array();

        $s_request_method = $this->get_request_method();
        $s_request_action = $this->get_request_action();
        $a_request_data   = $this->get_request_data();
        
        $s_resource_config = $s_request_method;
        if( ! is_null( $s_request_action ) && $s_request_action != "" )
            $s_resource_config .= "_$s_request_action";
        
        // get resource config data 
        if ( isset( $this->a_resource[ $s_resource ] ) )
        {
            $a_resource_config = $this->a_resource[ $s_resource ];
            
            if ( isset( $a_resource_config['method'][ $s_resource_config ] ))
                $a_method_config  = $a_resource_config['method'][ $s_resource_config ];
            
            $s_vendor_request_url     = $a_method_config['url'];
            $s_vendor_request_method  = "POST";
            $a_vendor_request_headers = isset( $a_method_config['headers'] ) ? $a_method_config['headers'] : array();
        }

        // control if request method is not supported
        $this->client_request_verify_method( $s_resource );

        // control all cliente request data params.
        $this->client_request_verify_data( $s_resource );

        // data mapping between our api (client request) and vendor
        $x_vendor_request_data = $this->vendor_request_mapping_data( $s_resource );

        // control data type to send
        $x_vendor_request_data = $this->vendor_request_verify_datatype( $s_resource, $x_vendor_request_data );
        
        // send the request to the provider/operator
        $a_vendor_request_params = array(
            "method"   => $s_vendor_request_method,
            "url" 	   => $s_vendor_request_url,
            "data"     => $x_vendor_request_data,
            "headers"  => $a_vendor_request_headers,
        );
        
        $a_vendor_request_result = $this->send_request( $a_vendor_request_params );

        // TODO client_response: merge con vendor_response
        // TODO client_response: definir segun la respuesta del vendor el http status code

        // devolver status code
        $this->send_200( array( 
            "Client" => $a_vendor_request_params,
            "Vendor" => $a_vendor_request_result 
        ));    
    }
}