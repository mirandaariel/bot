<?php 

// control de errores de implementacion
    if ( ! isset( $s_component ) )
    {
        print_r( "No se encuentra implementada la variable s_component. Revisar en ambiente Default, el archivo \\themes\clean\components\form\\1\logic" );
        exit();
    }

// logica
    switch ( $s_component ) 
    {
        /*
        case 'Verdadero o falso':
            $s_component = "YOBI\COMPONENTS\INPUT\checkbox_1";
            break;
        case 'Parrafo simple':
            $s_component = "YOBI\COMPONENTS\INPUT\\textarea_1";
            break;
        case 'Combo respuesta única':
            $s_component = "YOBI\COMPONENTS\INPUT\drop_down_1";
            $s_auxi      = $x_value;
            $x_value     = array();
            $a_config    = array(
                "multiple" => false,
            );
            
            // asignar las opciones del input al array de opciones para el componente
            foreach ( $a_input['input_data']['values'] as $i_input_value => $a_input_value ) 
            {
                $x_value[] = array(
                    "s_selected" => (int) $s_auxi == $a_input_value['id'] ? "selected" : "",
                    "s_label"    => $a_input_value['nombre'],
                    "s_value"    => $a_input_value['id'],
                );
            }
            break;
        case 'Fecha':
            $s_component = "YOBI\COMPONENTS\INPUT\date_2";
            $a_config    = array(
                "format" => "dd-mm-yyyy",
            );
            break;
        case 'Grabar video':
            $s_component = "YOBI\COMPONENTS\INPUT\\video_1";
            $s_custom    = $this->a_config['type']['custom'];
            $s_css_class = "video_1_input";
            $x_value     = array();

            // obtener los registros de los archivos
                foreach ( $a_input['response_data'] as $i_input_response_data => $a_input_response_data ) 
                {
                    // guardar los datos que se pasan al componente
                    $x_value[] = array(
                        "entity" => "form_input_usuario",
                        "id"     => $a_input_response_data['id'],
                        "nombre" => $a_input_response_data['video_ruta'],
                    );
                }
        */
        case 'YOBI\COMPONENTS\INPUT\uploader_1':
            //print_r( "<br> \n" );
            //var_dump( $x_value );
            
            // variables
                $b_value     = is_null( $x_value ) || trim( $x_value ) == "" ? false : true;
                $s_component = "YOBI\COMPONENTS\INPUT\uploader_1";
                $s_custom    = $this->a_config['type']['custom'];
                $s_css_class = "uploader_1_input";
                $a_config    = array(
                    "editable" => false,
                );
                //$x_value     = array();

            if ( $b_value )
            {
                // obtener los registros de los archivos

                    $a_value     = explode( ":", $x_value );
                    $s_entidad   = $a_value[0];
                    $o_entidad   = new $s_entidad ();
                    $a_instancia = $o_entidad->read( array( "id" => $a_value[1] ) );
                    
                // construir el array de configuracion de valor del componente
                    if ( ! empty( $a_instancia ) )
                    {
                        $x_value   = array();
                        $x_value[] = array(
                            "entity" => $s_entidad,
                            "id"     => $a_instancia[0]['id'],
                            "nombre" => $a_instancia[0]['nombre'],
                        );
                    }
            }
            break;
        case 'YOBI\COMPONENTS\INPUT\video_1':
            //print_r( "components_inputs_config.php:YOBI\COMPONENTS\INPUT\\video_1 <br> \n" );
            //var_dump( $x_value );
            
            // variables
                $b_value     = is_null( $x_value ) || trim( $x_value ) == "" ? false : true;
                $s_component = 'YOBI\COMPONENTS\INPUT\video_1';
                $s_custom    = $this->a_config['type']['custom'];
                $s_css_class = "video_1_input";
                //$x_value     = array();

            /*
            if ( $b_value )
            {
                // obtener los registros de los archivos

                    $a_value     = explode( ":", $x_value );
                    $s_entidad   = $a_value[0];
                    $o_entidad   = new $s_entidad ();
                    $a_instancia = $o_entidad->read( array( "id" => $a_value[1] ) );
                    
                // construir el array de configuracion de valor del componente
                    if ( ! empty( $a_instancia ) )
                    {
                        $x_value   = array();
                        $x_value[] = array(
                            "entity" => $s_entidad,
                            "id"     => $a_instancia[0]['id'],
                            "nombre" => $a_instancia[0]['nombre'],
                        );
                    }
            }
            //*/
            break;
        case 'YOBI\COMPONENTS\INPUT\video_2':
            //print_r( "components_inputs_config.php:YOBI\COMPONENTS\INPUT\\video_2 <br> \n" );
            //var_dump( $x_value );
            //var_dump( $this->a_config );
            //var_dump( $a_config );
            
            // variables
                $b_value     = is_null( $x_value ) || trim( $x_value ) == "" ? false : true;
                $s_component = 'YOBI\COMPONENTS\INPUT\video_2';
                $s_custom    = $this->a_config['type']['custom'];
                $s_css_class = "video_2_input";
                $a_config    = array(
                    'aws_s3_region'         => 'us-east-1',
                    'aws_s3_version'        => 'latest',
                    'aws_s3_key'            => 'AKIAI4TJR7ISQVBIGGTQ',
                    'aws_s3_secret'         => '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',
                    "aws_s3_bucket"         => "yobi.test.video",
                    "aws_s3_delete_object"  => true,
                );
                //$x_value     = array();

            /*
            if ( $b_value )
            {
                // obtener los registros de los archivos

                    $a_value     = explode( ":", $x_value );
                    $s_entidad   = $a_value[0];
                    $o_entidad   = new $s_entidad ();
                    $a_instancia = $o_entidad->read( array( "id" => $a_value[1] ) );
                    
                // construir el array de configuracion de valor del componente
                    if ( ! empty( $a_instancia ) )
                    {
                        $x_value   = array();
                        $x_value[] = array(
                            "entity" => $s_entidad,
                            "id"     => $a_instancia[0]['id'],
                            "nombre" => $a_instancia[0]['nombre'],
                        );
                    }
            }
            //*/
            break;
        default:
            # code...
            break;
    }

// debug 
   // print_r( $s_component . "<br> \n" );