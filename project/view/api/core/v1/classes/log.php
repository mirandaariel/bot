<?php

class log {

    public static function add_entry ( $a_params = null ) {

        if ( is_array( $a_params['data'] ) )
            $a_params['data'] = json_encode( $a_params['data'] );

        if ( isset( $a_params['operator'] ) )
            $s_operator = $a_params['operator'];

        // file log
        $a_operator = explode("_", $s_operator);
        $s_operator = $a_operator[0];
        $s_country  = $a_operator[1];

        $s_year  = date("Y");
        $s_month = date("m");
        $s_day   = date("d");
        $s_date  = date("Ymd");
        $s_hour  = date("H");

        $s_file_name = $s_operator."_".$s_country."_".$s_date."_".$s_hour;
        $s_file_path = SERVER_PATH . "log/$s_operator/$s_country/$s_year/$s_month/$s_day/$s_file_name";

        // controles

        if ( ! file_exists( SERVER_PATH . "log/$s_operator/" ) )
            mkdir( SERVER_PATH . "log/$s_operator/" );

        if ( ! file_exists( SERVER_PATH . "log/$s_operator/$s_country/" ) )
            mkdir( SERVER_PATH . "log/$s_operator/$s_country/" );

        if ( ! file_exists( SERVER_PATH . "log/$s_operator/$s_country/$s_year/" ) )
            mkdir( SERVER_PATH . "log/$s_operator/$s_country/$s_year/" );

        if ( ! file_exists( SERVER_PATH . "log/$s_operator/$s_country/$s_year/$s_month/" ) )
            mkdir( SERVER_PATH . "log/$s_operator/$s_country/$s_year/$s_month/" );

        if ( ! file_exists( SERVER_PATH . "log/$s_operator/$s_country/$s_year/$s_month/$s_day/" ) )
            mkdir( SERVER_PATH . "log/$s_operator/$s_country/$s_year/$s_month/$s_day/" );

        if ( ! file_exists( $s_file_path ) )
        {
            $gestor = fopen( $s_file_path, 'w');
            fclose($gestor);
        }

        // informacion
        $s_hora = date("H:i:s");
        $s_data = $s_hora . " - " . $a_params['data'];

        $actual = file_get_contents($s_file_path);
        $actual .= $s_data . "\n";
        file_put_contents($s_file_path, $actual);

        // email - extra dev control
        $o_email = new email();
        $o_email->send( array(
            "operator" => $s_operator,
            "country"  => $s_country,
            "attach"   => $s_file_path,
        ) );
    }

}