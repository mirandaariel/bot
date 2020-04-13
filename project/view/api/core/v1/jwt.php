<?php

// librerias
    use Jose\Component\Core\AlgorithmManager;
    use Jose\Component\Core\JWK;
    use Jose\Component\Signature\Algorithm\ES512;
    use Jose\Component\Signature\JWSBuilder;
    use Jose\Component\Signature\JWSVerifier;
    use Jose\Component\Signature\Serializer\CompactSerializer;
    use Jose\Component\Signature\Serializer\JWSSerializerManager;
    use Jose\Component\KeyManagement\JWKFactory;

    // Load Composer's autoloader
    require 'vendor/autoload.php';

class jwt {

    public function __construct() {}

    public function decrypt( $a_param = null ) {
        $token = $a_param['token'];
        
        // Variables

            // The algorithm manager with the ES512 algorithm.
            $algorithmManager = new AlgorithmManager([new ES512()]);

            // We instantiate our JWS Builder.
            $jwsBuilder = new JWSBuilder($algorithmManager);

            // We instantiate our JWS Verifier.
            $jwsVerifier = new JWSVerifier($algorithmManager);

            // serializador del objeto token generado por el jwsbuilder
            $serializer = new CompactSerializer();

            // The serializer manager. We only use the JWS Compact Serialization Mode.
            $serializerManager = new JWSSerializerManager([
                new CompactSerializer(),
            ]);

            // Our key.
            $s_file_key = dirname( __FILE__ ) . "/TUEC-ES521-public.pem";
            
            $private_key = JWKFactory::createFromKeyFile(
                "$s_file_key",              // The filename
                'Secret',                   // Secret if the key is encrypted
                [
                    'use' => 'sig',         // Additional parameters
                ]
            );

        // Carga del token de des-serializacion

            // We try to load the token.
            $jws = $serializerManager->unserialize($token);
            
            // We verify the signature. This method does NOT check the header.
            // The arguments are:
            // - The JWS object,
            // - The key,
            // - The index of the signature to check. See 
            $isVerified = $jwsVerifier->verifyWithKey($jws, $private_key, 0);

        // devolucion
            
            $a_function_result = array(
                "isVerified" => $isVerified,
                "payload"    => "",
            );

            if ( $isVerified )
                $a_function_result['payload'] = $jws->getPayload();
            
            return $a_function_result;
    }

}