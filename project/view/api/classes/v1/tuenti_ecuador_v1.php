<?php

class tuenti_ecuador_v1 extends class_base{
    
    public $a_resource = array(
        "pin" => array(
            "allow_method" => array("POST"),
            "method" => array(
                "POST" => array(
                    "url"  => "http://api-dev.uplinkbusiness.com/api/v2/pin/generate",
                    "data_type" => "json",
                    "data_client"  => array(
                        "cellphone_number",
                    ),
                    "data_mapping" => array(
                        'subscriberId' => "cellphone_number",
                    ),
                    "data" => array( 
                        'subscriberId' => null,
                        'serviceId'    => 2,
                    ),
                    "headers" => array(
                        "apikey: 6gwHyMfdXvXjxMyjjdCXPa:7rLJhkiwnmtzVDna3jfaXo",
                        "Content-Type: application/json",
                    ),
                ),
                "POST_verify" => array(
                    "url"  => "https://api-dev.uplinkbusiness.com/api/v2/pin/verify",
                    "data_type" => "json",
                    "data_client"  => array(
                        "cellphone_number",
                    ),
                    "data_mapping" => array(
                        'subscriberId' => "cellphone_number",
                        'pin'          => "id",
                    ),
                    "data" => array( 
                        //'subscriberId' => 593983771863,
                        'subscriberId' => null,
                        'serviceId'    => 2,
                        'pin'          => null,
                    ),
                    "headers" => array(
                        "apikey: 6gwHyMfdXvXjxMyjjdCXPa:7rLJhkiwnmtzVDna3jfaXo",
                        "Content-Type: application/json",
                    ),
                ),
                "GET" => array(
                    "url"  => "https://api-dev.uplinkbusiness.com/api/v2/pin/verify",
                    "data_type" => "json",
                    "data_client"  => array(),
                    "data_mapping" => array(
                        'subscriberId' => "cellphone_number",
                        'pin'          => "id",
                    ),
                    "data" => array( 
                        //'subscriberId' => 593983771863,
                        'subscriberId' => null,
                        'serviceId'    => 2,
                        'pin'          => null,
                    ),
                    "headers" => array(
                        "apikey: 6gwHyMfdXvXjxMyjjdCXPa:7rLJhkiwnmtzVDna3jfaXo",
                        "Content-Type: application/json",
                    ),
                ),
            ),
        ),
        "messageMT" => array(
            "allow_method" => array("POST"),
            "method" => array(
                "POST" => array(
                    "url"  => "https://api-dev.uplinkbusiness.com/api/v2/sendMT",
                    "data_type" => "json",
                    "data_client"  => array(
                        "service_id",
                        "cellphone_number",
                        "message",
                        "short_code",
                    ),
                    "data_mapping" => array(
                        'subscriberId' => "cellphone_number",
                        'serviceId'    => "service_id",
                        'message'      => "message",
                        'sc'           => "short_code",
                    ),
                    "data" => array( 
                        'subscriberId' => null,
                        'serviceId'    => null,
                        'sc'           => null, //"8686",
                        'chargeType'   => 1,    // desactivado por el vendor
                        'message'      => null
                    ),
                    "headers" => array(
                        "apikey: 6gwHyMfdXvXjxMyjjdCXPa:7rLJhkiwnmtzVDna3jfaXo",
                        "Content-Type: application/json",
                    ),
                ),
            ),
        ),
        "messageMTBulk" => array(
            "allow_method" => array("POST"),
            "method" => array(
                "POST" => array(
                    "url"  => "https://api-dev.uplinkbusiness.com/api/v2/sendMTBulk",
                    "data_type" => "json",
                    "data_client"  => array(
                        "service_id",
                        //"cellphone_number",
                        "message",
                        "short_code",
                    ),
                    "data_mapping" => array(
                        //'subscriberId' => "cellphone_number",
                        'serviceId'    => "service_id",
                        'message'      => "message",
                        'sc'           => "short_code",
                    ),
                    "data" => array( 
                        //'subscriberId' => null,
                        'serviceId'    => null,
                        'sc'           => null, //"8686",
                        'chargeType'   => 1,    // desactivado por el vendor
                        'message'      => null
                    ),
                    "headers" => array(
                        "apikey: 6gwHyMfdXvXjxMyjjdCXPa:7rLJhkiwnmtzVDna3jfaXo",
                        "Content-Type: application/json",
                    ),
                ),
            ),
        ),
        "token" => array(
            "allow_method" => array("GET",),
            "method" => array(
                "GET" => array(
                    "url"  => "https://api-dev.uplinkbusiness.com/api/v2/pin/verify",
                    "data_type" => "json",
                    "data_client"  => array(),
                    "data_mapping" => array(
                        //'subscriberId' => "cellphone_number",
                        //'pin'          => "id",
                    ),
                    "data" => array(),
                    "headers" => array(
                        //"apikey: 6gwHyMfdXvXjxMyjjdCXPa:7rLJhkiwnmtzVDna3jfaXo",
                        "Content-Type: application/json",
                        "token: [id]",
                    ),
                ),
            ),
        ),
    );

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
        
        $o_jwt = new jwt();
        
        $a_jwt_result = $o_jwt->decrypt( array("token" => $this->id) );

        //var_dump( $a_jwt_result );

        if ( $a_jwt_result['isVerified'] )
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
}