<?php 

class logic_currencies {
    
    static public function process_message ( $a_parameters = null ) {
        
        // variables

            global $oYApp;

            $a_result = array(
                "mensaje" => "",
            );

            $s_mensaje_valor = trim( $a_parameters['mensaje'][0]['valor'] );
            $a_mensaje_valor = explode( " ", $s_mensaje_valor );
           
            $a_countries  = array( "españa", "argentina", "usa" ); 
            $a_currencies = array( "euro", "dolar", "peso" ); 
            
            $a_country_currency = array( 
                "españa"    => "euro", 
                "argentina" => "peso", 
                "usa"       => "dolar",
            ); 

            $a_currency_code = array( 
                "euro"  => "EUR", 
                "peso"  => "ARS", 
                "dolar" => "USD",
            ); 

            $a_mensaje_monedas = array();
            $a_mensaje_paises  = array();
        
        // logica

            // obtener monedas y paises
                
                foreach ( $a_mensaje_valor as $i_valor => $s_valor ) 
                {
                    $s_valor = str_replace( ".", "", $s_valor );

                    if ( in_array( $s_valor, $a_currencies ) )
                        $a_mensaje_monedas[] = $a_currency_code[ $s_valor ];

                    if ( in_array( $s_valor, $a_countries ) )
                    {
                        $s_moneda = $a_country_currency[ $s_valor ];

                        $a_mensaje_paises[]  = $s_valor;
                        $a_mensaje_monedas[] = $a_currency_code[ $s_moneda ];
                    }
                }

            // controles

                $b_monedas = ! empty( $a_mensaje_monedas ) && count( $a_mensaje_monedas ) == 2;

            // clase currency - se encarga de conectarse a las APIs currency exchange rates and currency conversions

                $o_currency = new currency();
                
                $a_currency_result = $o_currency ->get_conversion( array( 
                    "currency_from" => $a_mensaje_monedas[0],
                    "currency_to"   => $a_mensaje_monedas[1],
                ));

                $d_rate = $a_currency_result['rate'];


        // response

            if ( ! $b_monedas )
                $a_result['mensaje'] = "No se ha podido realizar la cotizacion porque es necesario que informe dos monedas. <br>
                    Puedes poner el nombre del pais o los codigos de las monedas. Si deseas convertir un monto, simplemente inclúyelo. <br>";

            if ( $b_monedas )
                $a_result['mensaje'] = "La cotización es, 1 " . $a_mensaje_monedas[0] . " igual a <b> $d_rate </b> " . $a_mensaje_monedas[1];            

            return $a_result;
    }
}
