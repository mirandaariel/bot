<?php

class boton_guardar {
    
    static public function event_click ( $a_parameters = null ) {
        //print_r( "boton_actualizar.event_click() <br/> \n" );
        //print_r( $a_parameters );
        
        // variables
            global $oYApp;

            $a_result = array(
                "actions" => array(),
            );
            
            $s_usuario_id = $oYApp->a_data['usuario'][0]['id'];
            if ( $s_usuario_id == "" )
                $s_usuario_id = $oYApp->iUsrt;

            // obtener la instancia del objeto que disparo el evento
            $o_boton = $oYApp->a_components[ $a_parameters['component_id'] ];

            // 2019.09.07 - obtener el formulario al que pertenece para pedir los valores
                $o_form        = $oYApp->a_components[ $o_boton->a_config['form'] ];
                $a_form_values = $o_form->inputs_get_values();
                
                $a_form_auxi = array();
                if ( isset( $a_form_values['registro_seleccionado'] ) ) $a_form_auxi['registro_seleccionado'] = $a_form_values['registro_seleccionado'];
                if ( isset( $a_form_values['form_cabecera_id'] ) ) $a_form_auxi['form_cabecera_id'] = $a_form_values['form_cabecera_id'];

                $a_form_values = array_merge( $_POST['data'], $a_form_auxi );
                
                $b_form_values = empty( $_POST['data'] ) ? false : true;
                
                /*
                var_dump( $_POST );
                var_dump( $a_form_auxi );
                var_dump( $a_form_values );
                exit();
                //*/

            // controlar variables criticas
            $b_respuesta = isset( $a_form_values['registro_seleccionado'] ) ? true : false;
            $b_respuesta = isset( $a_form_values['form_cabecera_id'] ) ? true : false;
            
        // procesar la respuesta
            if ( $b_respuesta )
            {
                // variables
                    $o_base = new base();

                    $a_instance         = $a_form_values['registro_seleccionado'];
                    $i_form_cabecera_id = $a_form_values['form_cabecera_id'];
                    
                    unset( $a_form_values['registro_seleccionado'] );
                    unset( $a_form_values['form_cabecera_id'] );
                    
                    // flag que determina que el registro fue insertado o actualizado
                    $b_control_persistencia = false;

                    //print_r( $a_instance );
                    //print_r( $a_form_values );

                // limpiar los nombres (claves del array) de los campos de la tabla del formulario
                    $a_form_registro = array();
                    
                    foreach ( $a_form_values as $s_clave => $x_valor ) 
                    {
                        $s_clave = str_replace( "i_", "", $s_clave );
                        $a_form_registro[ $s_clave ] = $x_valor;
                    }
                    //print_r( $a_form_registro );

                // asignar valores especiales al registro de los datos del formulario
                    $a_form_registro['usuario_id'] = $oYApp->a_data['usuario'][0]['id'];

                // controlar si el formulario esta configurado como instancia unica. 
                    $o_form_cabecera = new form_cabecera();
                    $a_form_cabecera = $o_form_cabecera->read( array( "id" => $i_form_cabecera_id ) );
                    
                    $s_entidad_datos        = $a_form_cabecera[0]['entidad_datos'];
                    $b_flag_instancia_unica = (int) $a_form_cabecera[0]['flag_instancia_unica'] == 1 ? true : false;
                    //var_dump( $b_flag_instancia_unica );
                    
                    // controlar si existe el registro. si no existe debe ser creado, por lo que se configura en falso
                    // el valor de la variable flag de instancia unica
                        $s_sql  = "SELECT id FROM $s_entidad_datos WHERE usuario_id = $s_usuario_id;";
                        $a_base = $o_base->procSent( $s_sql );
                        
                        if ( empty( $a_base['aDato'] ) )
                            $b_flag_instancia_unica = false;

                // controlar que existan valores para actualizar
                    
                    //print_r( $a_form_registro );
                    $b_form_registro = empty( $a_form_registro ) ? false : true;

                    // 2018.09.11 - controlar que valores existen dentro de a_form_registro
                        if ( count( $a_form_registro ) == 1 )
                        {
                            if ( isset( $a_form_registro['usuario_id'] ) )
                                $b_form_registro = false;
                        }

                    // 2018.10.30 - 

                        //var_dump( $a_form_registro );
                        if ( $b_form_registro )
                        {
                            $a_form_auxi = $a_form_registro;
                            unset( $a_form_auxi['usuario_id'] );

                            $i_control_form_elementos  = count( $a_form_auxi );
                            $i_control_elementos_empty = 0;

                            foreach ( $a_form_auxi as $key => $value ) 
                            {
                                //print_r( $value );
                                if ( is_array( $value ) )
                                    continue;

                                if ( is_null( $value ) || trim( $value ) == "" )
                                    $i_control_elementos_empty++;
                            }

                            //var_dump( $i_control_form_elementos );
                            //var_dump( $i_control_elementos_empty );

                            if ( $i_control_form_elementos == $i_control_elementos_empty )
                                $b_form_registro = false;
                        }


                    //var_dump( $b_form_registro );
                    //print_r( $b_form_registro . "<br> \n" );
                    //print_r( $a_form_registro );
                    //print_r( $a_form_cabecera );
                    //exit();

                // 2019.02.01 - controlar valores que se ingresan en el formulario
                    
                    // la forma mas rapida de implementar la personalizacion de logica para el 
                    // control de los valores de cada formulario, es utilizando un archivo separado
                    // identificado a traves del id del formulario.
                    // esto se necesita, por ejemplo, en el caso de formularios que actualicen valores
                    // de la tabla usuario y que funcionen como fast login.
                    // si el usuario ingresa un correo electronico que ya existe, hasta el momento
                    // el sistema no tiene forma de averiguarlo.

                    $s_form_custom_logic = FMWK_CLIE_DIRE . "project/view/form/";
                    $s_form_custom_logic .= "form_custom_logic_" . $a_form_cabecera[0]['codigo'] . ".php";
                    
                    $b_form_custom_logic = file_exists( $s_form_custom_logic );
                    $i_form_custom_step  = 1;

                    if ( $b_form_custom_logic ) include( $s_form_custom_logic );

                // solo si hay valores se continua
                    //var_dump( $b_form_registro );
                    if ( $b_form_registro )
                    {
                        //var_dump( $b_flag_instancia_unica );

                        // 2018.06.26 - para mayor control la variable $b_control_persistencia debe
                        // estar dentro de los if. Se establece aqui porque se conoce que no hay 
                        // otra accion, es decir, no existe una tercera posibilidad
                        $b_control_persistencia = true;

                        $s_destino_campos  = "";
                        $s_destino_valores = "";

                        // 2019.02.19 - controlar la estructura de los valores
                        foreach ( $a_form_registro as $s_campo => $x_valor ) 
                        {
                            if ( is_array( $x_valor ) )
                            {
                                if ( is_array( $x_valor[0] ) )
                                {
                                    $x_valor_auxi = array();
                                    foreach ( $x_valor as $i_valor_key => $a_valor_data ) 
                                    {
                                        if ( $a_valor_data['s_selected'] == "selected" )
                                            $x_valor_auxi[] = $a_valor_data['s_value'];
                                    }
                                    $x_valor = $x_valor_auxi;
                                }

                                $x_valor = implode( ",", $x_valor );
                            }
                            $a_form_registro[ $s_campo ] = $x_valor;
                        }

                        // si no es instancia unica se deben realizar los inserts
                        if ( ! $b_flag_instancia_unica )
                        {
                            // preparar el string de los nombres de los campos y de los valores
                            foreach ( $a_form_registro as $s_campo => $x_valor ) 
                            {
                                //print_r( $x_valor );
                                
                                $s_destino_campos .= ( $s_destino_campos != "" ? ", " : "" ) . "`$s_campo`"; 
                                $s_destino_valores .= ( $s_destino_valores != "" ? ", " : "" ) . "'$x_valor'"; 
                            }

                            // insertar los valores en la tabla correspondiente.
                            $s_sql = "INSERT INTO [tabla] ( [campos] ) VALUES ( [valores] );";
                            $s_sql = str_replace( "[tabla]", $s_entidad_datos, $s_sql );
                            $s_sql = str_replace( "[campos]", $s_destino_campos, $s_sql );
                            $s_sql = str_replace( "[valores]", $s_destino_valores, $s_sql );
                            //print_r( $s_sql . "<br> \n" );

                            $a_base = $o_base->procSent( $s_sql );

                            $i_instancia_id = $a_base['iIden'];

                            // 2020.01.12 - control de los valores que corresponden a otras entidades para cerrar la 
                            // vinculacion con el id del nuevo registro.

                            foreach ( $a_form_registro as $s_campo => $x_valor ) 
                            {
                                if ( strpos( $x_valor, ":" ) !== false )
                                {
                                    $a_valor = explode( ":", $x_valor);

                                    $s_valor_entidad = $a_valor[0];
                                    $s_valor_id      = $a_valor[1];

                                    $o_valor_entidad = new $s_valor_entidad();
                                    $a_valor_entidad = $o_valor_entidad->read( array( "id" => $s_valor_id ) );
                               
                                    $a_valor_entidad[0]['clave_foranea'] = $i_instancia_id;
                                    $o_valor_entidad->update( $a_valor_entidad[0] );
                                }        
                            }
                        }
                        else if ( $b_flag_instancia_unica )
                        {
                            //print_r( "instancia unica <br />" );

                            $s_destino_campos = "";

                            // preparar el string de los nombres de los campos y de los valores
                            foreach ( $a_form_registro as $s_campo => $x_valor ) 
                            {

                                if ( $s_campo == "usuario_id" || trim($x_valor) == "" )
                                    continue;

                                //print_r( $x_valor );
                                
                                $s_destino_campos .= $s_destino_campos == "" ? "" : ", "; 
                                $s_destino_campos .= "`$s_campo` = '$x_valor'"; 
                            }

                            // insertar los valores en la tabla correspondiente.
                            $s_sql = "UPDATE [tabla] SET [campos] WHERE usuario_id = $s_usuario_id;";
                            $s_sql = str_replace( "[tabla]", $s_entidad_datos, $s_sql );
                            $s_sql = str_replace( "[campos]", $s_destino_campos, $s_sql );
                            //print_r( $s_sql . "<br> \n" );

                            $a_base = $o_base->procSent( $s_sql );

                            //$i_instancia_id = $a_base['iIden'];
                        }

                        // 2018.07.09 - control - entidad de datos de formulario que es soporte de etapa

                            // variables
                                $b_soporte = false;
                                $o_base    = new base();

                            // controlar si el formulario pertenece a un soporte
                                // la consulta contempla que no se vuelva a seleccionar la instancia de la etapa, una
                                // vez que la instancia del proceso ha alcanzado otra etapa.
                                $s_query_soporte = "SELECT 
                                        form_cabecera.nombre,
                                        wf_instancia_etapa.*,
                                        wf_soporte.id AS 'soporte_id'
                                    FROM form_cabecera 
                                    LEFT OUTER JOIN wf_soporte 
                                        ON wf_soporte.form_cabecera_id = form_cabecera.id
                                    LEFT OUTER JOIN wf_instancia
                                        ON wf_instancia.wf_proceso_id = wf_soporte.wf_proceso_id
                                    LEFT OUTER JOIN wf_instancia_etapa
                                        ON wf_instancia_etapa.wf_instancia_id = wf_instancia.id
                                        AND wf_instancia_etapa.wf_etapa_id = wf_soporte.wf_etapa_id
                                    WHERE form_cabecera.entidad_datos = '$s_entidad_datos'
                                        AND wf_instancia.instancia_entidad = 'usuario'
                                        AND wf_instancia.instancia_clave = $s_usuario_id
                                        AND wf_instancia_etapa.orden = wf_instancia.etapa_actual_orden";
                                $a_query_soporte = $o_base->procSent( $s_query_soporte );
                                $a_query_soporte = $a_query_soporte['aDato'];
                                //print_r( "s_query_soporte: <br> \n" );
                                //print_r( $s_query_soporte . "<br> \n" );


                                if ( ! empty( $a_query_soporte ) ) $b_soporte = true;
                                //print_r( "b_soporte: <br> \n" );
                                //print_r( $b_soporte . "<br> \n" );

                            // control sobre aprobar etapa
                                if ( $b_soporte )
                                {
                                    // variables
                                        $b_soporte_existencia = false;
                                        $i_instancia_etapa_id = $a_query_soporte[0]['id'];
                                        $i_soporte_id         = $a_query_soporte[0]['soporte_id'];
                                        $s_entidad_label      = $a_query_soporte[0]['nombre'];

                                    // controlar la existencia de la relacion entre el soporte y 
                                    // la instancia de la etapa

                                        $o_instancia_soporte = new wf_instancia_soporte();
                                        $o_instancia_soporte ->aBase['aFilt'][] = "wf_instancia_soporte.wf_instancia_etapa_id = $i_instancia_etapa_id";
                                        $o_instancia_soporte ->aBase['aFilt'][] = "wf_instancia_soporte.wf_soporte_id = $i_soporte_id";
                                        $a_instancia_soporte = $o_instancia_soporte->find();

                                        if ( ! empty( $a_instancia_soporte ) ) $b_soporte_existencia = true;

                                    // control - crear instancia wf_instancia_soporte
                                        if ( ! $b_soporte_existencia )
                                        {
                                            // 2018.09.04 - en este caso la instancia del soporte debe tener el nombre
                                            // de la tabla de datos del formulario, su label y el id de usuario que carga
                                            // los registros en esa tabla
                                            $o_instancia_soporte->create( array(
                                                "wf_instancia_etapa_id" => $i_instancia_etapa_id,
                                                "wf_soporte_id"         => $i_soporte_id,
                                                "entidad_nombre"        => $s_entidad_datos,
                                                "entidad_label"         => $s_entidad_label,
                                                "entidad_clave"         => $s_usuario_id,
                                            ) );
                                        }

                                    $o_instancia_etapa = new wf_instancia_etapa ();
                                    $a_instancia_etapa = $o_instancia_etapa->read( array( "id" => $i_instancia_etapa_id ) );
                                    $a_instancia_etapa[0]['wf_instancia_etapa_id'] = $i_instancia_etapa_id;
                                    $a_instancia_etapa[0]['flag_etapa_aprobacion'] = "1";

                                    wf_instancia_etapa::aprobar_etapa( 
                                        array(
                                            "a_etapa_instancia" => $a_instancia_etapa[0],
                                        )
                                    );
                                }

                        // no se limpian los datos del formulario, para que el usuario pueda modificarlos si lo desea.                    
                        //$o_form->inputs_clean_values();       

                        // 2018.06.18 - acciones de la version 1 del modelo de datos del motor de formularios que no son 
                        // necesarias

                            // 2017.01.29 - crear o actualizar el registro de la relacion entre la cabecera del formulario y el usuario
                            // 2017.02.23 - controlar que el usuario este logueado para crear la relacion entre el formulario y el usuario
                            // 2017.02.17 - controlar si el usuario no esta logueado, darle una alta automatica     
                            // 2017.03.01 - controlar el ingreso de videos
                    }

                // control actualizacion de campos de entidades externas definidas en la base
                    if ( $b_form_registro && $b_control_persistencia )
                    {
                        // variables

                            // guarda las entradas configuradas para actualizar otros campos
                            $a_entrada_actualiza = array();

                            // obtener los registros de las entradas del formulario
                            $o_form_entrada = new form_entrada ();
                            $o_form_entrada ->aBase['aFilt'][] = "form_entrada.form_cabecera_id = $i_form_cabecera_id";
                            $o_form_entrada ->aBase['aFilt'][] = "form_entrada.actualiza_campos <> ''";
                            $a_form_entrada = $o_form_entrada->find();

                            $a_entrada_actualiza = $a_form_entrada;
                            //var_dump( $a_entrada_actualiza );

                        // procesar los criterios del campo actualiza_campos de cada entrada
                            foreach ( $a_entrada_actualiza as $i_entrada => $a_entrada ) 
                            {
                                // 2018.09.11 - controlar la existencia de valor para actualizar
                                if ( ! isset( $a_form_registro[ $a_entrada['codigo'] ] ) )
                                    continue;

                                //$s_criterio = str_replace( " ", "", $a_entrada['actualiza_campos'] );
                                $s_criterio = $a_entrada['actualiza_campos'];
                                $a_criterio = explode( ",", $s_criterio );


                                foreach ( $a_criterio as $i_criterio_set => $s_criterio_set ) 
                                {
                                    // desglozar el criterio
                                    $a_criterio_set      = explode( ":", $s_criterio_set );
                                    $s_criterio_where    = $a_criterio_set[0];
                                    $s_criterio_campo    = $a_criterio_set[1];
                                    $s_criterio_entradas = "";
                                    $s_criterio_formato  = "";

                                    if ( isset( $a_criterio_set[2] ) ) $s_criterio_entradas = $a_criterio_set[2];
                                    if ( isset( $a_criterio_set[3] ) ) $s_criterio_formato  = $a_criterio_set[3];

                                    // controlar valores de los elementos del criterio
                                    $b_criterio_entradas = trim( $s_criterio_entradas ) == "" ? false : true;
                                    $b_criterio_formato  = trim( $s_criterio_formato ) == "" ? false : true;

                                    // desglozar el elemento segundo campo destino
                                    $a_criterio_campo = explode( ".", $s_criterio_campo );
                                    $s_entidad_nombre = $a_criterio_campo[0];
                                    $s_campo_nombre   = $a_criterio_campo[1];
                                    $s_campo_value    = $a_form_registro[ $a_entrada['codigo'] ];

                                    // procesar el elemento tercero - otras entradas
                                    if ( $b_criterio_entradas )
                                    {
                                        $a_criterio_entradas_valores = array();

                                        $a_criterio_entradas = explode( ";", $s_criterio_entradas );
                                        
                                        foreach ( $a_criterio_entradas as $i_criterio_entrada => $s_criterio_entrada_codigo ) 
                                        {
                                            if ( isset( $a_form_registro[ $s_criterio_entrada_codigo ] ) )
                                            {
                                                if ( trim( $a_form_registro[ $s_criterio_entrada_codigo ] ) != "" )
                                                    $a_criterio_entradas_valores[ $s_criterio_entrada_codigo ] = 
                                                        $a_form_registro[ $s_criterio_entrada_codigo ];
                                            }
                                        }
                                        
                                        foreach ( $a_criterio_entradas_valores as $s_entrada_codigo => $s_entrada_valor ) 
                                            $s_campo_value .= " - " . $s_entrada_valor;
                                    }

                                    // procesar formato
                                    if ( $b_criterio_formato )
                                    {
                                        foreach ( $a_criterio_entradas_valores as $s_entrada_codigo => $s_entrada_valor ) 
                                            $s_criterio_formato = str_replace( "[$s_entrada_codigo]", $s_entrada_valor, $s_criterio_formato );
                                        
                                        $s_criterio_formato = str_replace( "[value]", $a_form_registro[ $a_entrada['codigo'] ], $s_criterio_formato );
                                        
                                        $s_campo_value = $s_criterio_formato;   
                                    }

                                    // guardar el valor en el campo destino
                                    //print_r( "s_campo_value: " . $s_campo_value . "<br> \n" );
                                    if ( trim( $s_campo_value ) != "" )
                                    {
                                        $s_sql_campo = "UPDATE $s_entidad_nombre 
                                            SET $s_campo_nombre = '$s_campo_value' 
                                            WHERE $s_criterio_where = $s_usuario_id";
                                        //print_r( $s_sql_campo . "<br> \n" );
                                        $o_base->procSent( $s_sql_campo );
                                    }
                                }
                            }
                    }
            }

        // 2019.02.01 - logica personaliza de formulario - post persistencia de los datos

            $i_form_custom_step = 2;
            if ( $b_form_custom_logic && $b_form_registro ) include( $s_form_custom_logic );

        // definir el mensaje para el usuario
            
            // respuesta existosa
            if ( $b_respuesta )
            {
                if ( empty( $a_mensaje ) )
                    $a_mensaje = array(
                        "title"       => "Registración Exitosa!",
                        "description" => "Ya formas parte Artists Support!, pronto te llegará un correo
                        electrónico con la contraseña temporal para que puedas ingresar a la plataforma y
                        terminar de completar los datos de tu cuenta. Bienvenido!",
                    );
            }

            // respuesta ante la falta de datos ingresados
            if ( ! $b_form_registro )
            {
                if ( empty( $a_mensaje ) )
                    $a_mensaje = array(
                        "title"       => "Datos no ingresados",
                        "description" => "No has actualizado alguno de los campos del formulario. Completa los datos 
                            solicitados si quieres continuar con el proceso de selección.",
                    );
            }

            // respuesta de los controles existentes en la version anterior.
            if ( isset( $s_message_title ) )
            {
                $a_mensaje = array(
                    "title"       => $s_message_title,
                    "description" => $s_message_paragraph,
                );   
            }

        // procesar la devolucion
            if( ! $b_respuesta )
            {   
                $a_result['actions'] = array(
                    array(
                        "object" => "window",
                        "method" => "alert",
                        "data"   => "Debe seleccionar una acción.",
                    )
                );
            }
            else
            {
                $a_result['actions'] = array(
                    array(
                        "object" => "YOBI.LAYOUT.PANEL_MODAL_2",
                        "method" => "panel_request",
                        "data"   => array(
                            "view"       => "modal",
                            //"panel_file" => FMWK_CLIE_DIRE . "project/view/form/panels/modal/[view]_ajax.php",
                            "panel_file" => FMWK_CLIE_SERV . "project/view/form/panels/modal/[view]_ajax.php",
                            "content_id" => "panel_modal",
                            "data"       => array(
                                "mensaje" => $a_mensaje,
                            ),
                        ),
                    ),
                    array(
                        "object" => "YOBI.LAYOUT.PANEL_MODAL_2",
                        "method" => "open_panel",
                    ),
                );
            }

        return $a_result;
    }
}

class boton_volver {
    
    static public function event_click ( $a_parameters = null ) {
        //print_r( "boton_volver.event_click() <br/> \n" );
        //print_r( $a_parameters );
        
        global $oYApp;

        $a_result = array(
            "actions" => array(),
        );

        // obtener la instancia del objeto que disparo el evento
            $o_boton = $oYApp->a_components[ $a_parameters['component_id'] ];

        // obtener formulario
            $o_form = $oYApp->a_components[ $o_boton->a_config['form'] ];

        // respuesta para la vista

            // si el contenedor es la vista. busco la url de la vista anterior a la actual
            if ( $o_form->a_config['type']['container'] == "view" )
            {
                //print_r( $oYApp );
                //print_r( $oYApp->aHist );
                //print_r( $oYApp->aPath );
                $i_hist = count( $oYApp->aHist );
                $i_path = count( $oYApp->aPath );
                $s_view = $oYApp->aHist[ $i_hist - 2 ];
                $s_view = $oYApp->aPath[ $i_path - 2 ]['s_urlf'];

                $b_user_temp = is_null( $oYApp->iUsrt ) ? false : true;
                if ( $b_user_temp )
                    $s_view = FMWK_CLIE_SERV . "logout";
            }

            if ( $o_form->a_config['type']['container'] == "panel" )
                $a_result['actions'] = array(
                    array(
                        "object" => "YOBI.LAYOUT.PANEL_RIGHT",
                        "method" => "open_panel",
                    ),
                );
            else if ( $o_form->a_config['type']['container'] == "view" )
                $a_result['actions'] = array(
                    array(
                        "object"   => "location",
                        "property" => "href",
                        "data"     => $s_view,
                        //"data"     => FMWK_CLIE_SERV . "main",
                    ),
                );

        return $a_result;
    }
}

class uploader_1_input {
    
    static public function file_upload ( $a_parameters = null ) {
        //print_r( "uploader_1_input.file_upload() <br/> \n" );
        //print_r( $a_parameters );
        //print_r( $_FILES );
        //exit();

        // variables
            global $oYApp;

            $o_base = new base(); 
            
            $a_result = array(
                "actions" => array(),
            );

            $s_usuario_id = $oYApp->a_data['usuario'][0]['id'];

        // obtener la instancia del componente target que dispara el evento y el formulario
            $o_component_target = $oYApp->a_components[ $a_parameters['component_id'] ];
            $o_form             = $oYApp->a_components[ $o_component_target->a_config['form'] ];

        // obtener datos hidden del formulario y aislar los datos que pertenecen al componente
            $a_form_values = $o_form->inputs_get_values();
            //var_dump( $a_form_values );

            foreach ( $a_form_values['registro_seleccionado'] as $i_input_data => $a_input_data ) 
                if ( $a_input_data['name'] == $a_parameters['component_id'] )
                    $a_component_target = $a_input_data;
            
            //var_dump( $a_component_target );

        // obtener datos de la definicion de la cabecera del formulario y de la definicion de la entrada
            $o_form_cabecera = new form_cabecera();
            $a_form_cabecera = $o_form_cabecera->read( array( "id" => $a_component_target['form_cabecera_id'] ) );
            
            $o_form_entrada = new form_entrada();
            $a_form_entrada = $o_form_entrada->read( array( "id" => $a_component_target['form_entrada_id'] ) );
            
        // procesar el archivo
            
            $o_entidad   = new media_file();
            $a_instancia = array();

            // 2020.01.12 - clase foranea para la version 24.1 cuando es un form engine
            $s_clase_foranea = $a_component_target['entity'];

            // 2018.06.27 - el archivo es asociado al usuario logueado porque es posible que el 
            // registro del formulario sobre el que se esta trabajando, no este creado y no se tenga
            // su id. 
            // Para no perder la relacion con este registro de media_file que se crea. Luego se
            // asigna al formulario (input_save_value) el valor para el campo de la entrada, donde
            // estara el id del registro media_file.
            $a_instancia['clase_foranea'] = $s_clase_foranea;
            //$a_instancia['clave_foranea'] = $s_usuario_id;
            $a_instancia['campo_foraneo'] = $a_form_entrada[0]['codigo'];

            // eliminar registro existente

                // 2018.06.30 . El registro solo debe ser elimina si el formulario se encuentra configurado como 
                // instancia unica.
                // Hay que obtener el id del registro de media_file que corresponde al campo que se esta actualizando

                $b_instancia_unica = $a_form_cabecera[0]['flag_instancia_unica'] == "1" ? true : false;
                $s_form_tabla      = $a_form_cabecera[0]['entidad_datos'];
                $s_entrada_campo   = $a_form_entrada[0]['codigo'];

                if ( $b_instancia_unica )
                {
                    $s_sql_form_tabla = "SELECT id, $s_entrada_campo FROM $s_form_tabla WHERE usuario_id = $s_usuario_id";
                    //echo "<pre>"; echo $s_sql_form_tabla; echo "</pre>";
                    $a_sql_form_tabla = $o_base->procSent( $s_sql_form_tabla );
                    $s_entrada_value  = $a_sql_form_tabla['aDato'][0][ $s_entrada_campo ];
                    $b_entrada_value  = trim( $s_entrada_value ) == "" ? false : true;

                    // 2020.01.12 - obtener el id del registro de la endidad del form dinamico
                    $a_instancia['clave_foranea'] = $a_sql_form_tabla['aDato'][0]['id'];

                    if ( $b_entrada_value )
                    {
                        $a_entrada_value = explode( ":", $s_entrada_value );
                        $s_instancia_id  = $a_entrada_value[1];
                        $o_entidad->delete( array( "id" => $s_instancia_id ) );
                    }
                }

            // crear el nuevo registro
            $a_instancia['nombre'] = $_FILES['files']['name'][0];
            $a_instancia['aFile']  = $_FILES;
            
            $a_create = $o_entidad->create( $a_instancia );

        // obtener datos del archivo
            $o_media_imagen = new media_file();
            $a_media_imagen = $o_media_imagen->read( array( "id" => $a_create['iIden'] ) );

            // se guarda el nombre del archivo porque $a_media_imagen se ve afectada por el codigo que sigue
            $s_archivo_nuevo = $a_media_imagen[0]['nombre'];
            
            // asignar el valor que se guardara en el campo de la tabla del formulario
                $o_form->input_save_value( array(
                    "data" => array(
                        "component_id" => $a_parameters['component_id'],
                        "x_value"      => "media_file:" . $a_create['iIden'],
                    ),
                ) );

        // controlar si la entrada tiene que actualizar otros campos
            
            // ejecutar criterios
                $s_criterio = str_replace( " ", "", $a_form_entrada[0]['actualiza_campos'] );
                $a_criterio = explode( ",", $s_criterio );

                foreach ( $a_criterio as $i_criterio_set => $s_criterio_set ) 
                {
                    $a_criterio_set   = explode( ":", $s_criterio_set );
                    $s_criterio_where = $a_criterio_set[0];
                    $s_criterio_campo = $a_criterio_set[1];
                    $a_criterio_campo = explode( ".", $s_criterio_campo );

                    $s_entidad_nombre = $a_criterio_campo[0];
                    $s_campo_nombre   = $a_criterio_campo[1];

                    if ( $s_campo_nombre == "imagen_perfil" || $s_campo_nombre == "imagen_portada" )
                    {
                        $a_instancia = array();

                        $s_temp_folder_path = dirname( $_FILES['files']['tmp_name'][0] );
                        $s_temp_file_name   = $_FILES['files']['name'][0];
                        $s_temp_file_path   = $s_temp_folder_path . "/" . $s_temp_file_name; 
                        $s_orig_file_path   = FMWK_CLIE_PATH . $a_media_imagen[0]['ruta_upload'] . $a_media_imagen[0]['nombre'];
                        
                        // crear o actualizar el nuevo registro
                        if ( copy( $s_orig_file_path, $s_temp_file_path ) ) 
                        {
                            // actualizar _FILE
                            $_FILES['files']['tmp_name'][0] = $s_temp_file_path;

                            // actualizar la instancia de la imagen de perfil del usuario 
                            $o_media_imagen_new = new media_imagen();
                            $o_media_imagen_new ->aBase['aFilt'][] = "media_imagen.clase_foranea = 'usuario'";
                            $o_media_imagen_new ->aBase['aFilt'][] = "media_imagen.clave_foranea = '$s_usuario_id'";
                            $o_media_imagen_new ->aBase['aFilt'][] = "media_imagen.mimgfatt = '$s_campo_nombre'";
                            $a_media_imagen_new = $o_media_imagen_new->find();
                            
                            // controlar si el usuario no tiene imagen de perfil
                            $b_media_update = false;
                            if ( ! empty( $a_media_imagen_new ) )
                                $b_media_update = true;

                            // asignar nuevo nombre y los datos del archivo
                            $a_media_imagen_new[0]['aFile']    = $_FILES;
                            $a_media_imagen_new[0]['mimgnomb'] = $s_temp_file_name;
                            
                            // luego de actualizar el archivo se realiza el control para que se copie el archivo
                            // se hace por afuera porque si se utiliza en clas.update se rompe.
                            if ( $b_media_update )
                            {
                                $a_update = $o_media_imagen_new->update( $a_media_imagen_new[0] );

                                $a_update['iEsta'] = 1;
                                $a_update['iCant'] = 1;
                                $a_update['aDato'] = $a_media_imagen_new[0];
                                
                                $o_media_imagen_new->control_persistence( $a_update );
                            }
                            else
                            {
                                $a_media_imagen_new[0]['clase_foranea'] = "usuario";
                                $a_media_imagen_new[0]['clave_foranea'] = $s_usuario_id;
                                $a_media_imagen_new[0]['mimgfatt']      = $s_campo_nombre;
                                
                                $o_media_imagen_new->create( $a_media_imagen_new[0] );
                            }
                        }
                    }
                }

        // 2019.09.08 - enviar al JS el valor del input para que luego pueda ser envia via POST al presionar el 
        // submit del formulario
            $a_result['data'] = array(
                "value" => "media_file:" . $a_create['iIden'],
            ); 

        // informacion para la vista
            $a_result['actions'][] = array(
                "object" => "instance", 
                "method" => "content_append",
                "data"   => '<div style="float: right; margin-right: 0px; margin-bottom: 8px; margin-left: 8px;">
                    <button type="button" style="background-color: #fff; font-weight: 300;" class="btn btn-light uploader_1_file">'.$s_archivo_nuevo.'</button></div>',
            );

            //var_dump($a_result)
        
        return $a_result;
    }
}

class video_1_input {
    
    static public function video_save ( $a_parameters = null ) {
        //print_r( "video_1_input.video_save() <br/> \n" );
        //print_r( $a_parameters );

        // variables
            global $oYApp;
            
            $s_usuario_id = $oYApp->a_data['usuario'][0]['id'];

            $a_result = array(
                "actions" => array(),
            );

            $a_informacion_extra = array(
                "streamName"     => "", 
                "streamDuration" => "",
                "userId"         => "",
                "cameraName"     => "",
                "micName"        => "",
                "recorderId"     => "",
                "audioCodec"     => "",
                "videoCodec"     => "",
                "fileType"       => "", 
                "videoId"        => "",
            );
            //*/

        // obtener la instancia del componente target que dispara el evento y el formulario
            $o_component_target = $oYApp->a_components[ $a_parameters['component_id'] ];
            $o_form             = $oYApp->a_components[ $o_component_target->a_config['form'] ];

        // procesar los datos del video

            // ordernar la informacion extra de acuerdo con las claves definidas por el proveedor
                if ( count( $a_parameters['data'] ) == 4 )
                {
                    $a_informacion_extra['streamName']     = $a_parameters['data']['streamName'];
                    $a_informacion_extra['fileType']       = $a_parameters['data']['fileType'];
                    $a_informacion_extra['videoId']        = $a_parameters['data']['videoId'];
                    $a_informacion_extra['recorderId']     = $a_parameters['data']['recorderId'];
                }
                else
                {
                    $a_informacion_extra['streamName']     = $a_parameters['data'][0];
                    $a_informacion_extra['streamDuration'] = $a_parameters['data'][1];
                    $a_informacion_extra['userId']         = $a_parameters['data'][2];
                    $a_informacion_extra['cameraName']     = $a_parameters['data'][3];
                    $a_informacion_extra['micName']        = $a_parameters['data'][4];
                    $a_informacion_extra['recorderId']     = $a_parameters['data'][5];
                    $a_informacion_extra['audioCodec']     = $a_parameters['data'][6];
                    $a_informacion_extra['videoCodec']     = $a_parameters['data'][7];
                    $a_informacion_extra['fileType']       = $a_parameters['data'][8];
                    $a_informacion_extra['videoId']        = $a_parameters['data'][9];
                }
        
            $a_informacion_extra['recorderId'] = str_replace( "i_", "", $a_informacion_extra['recorderId'] );

            // la confeccion de la ruta del video es comun al alta o actualizacion del registro
                $s_vendor_repositorio = "https://eu1-addpipe.s3.eu-central-1.amazonaws.com/";
                $s_vendor_client_id   = "14ca9e89ca70313c9f376629f6ea8208";

                $s_video_ruta = $s_vendor_repositorio . $s_vendor_client_id . "/" . $a_informacion_extra['streamName'] .".mp4";
            
                $a_encuesta_respuesta = array( array() );

            // actualizacion de los valores de la instancia
                $a_encuesta_respuesta[0]['video_ruta']        = $s_video_ruta;
                //$a_encuesta_respuesta[0]['informacion_extra'] = json_encode( $a_informacion_extra );
                $a_encuesta_respuesta[0]['informacion_extra'] = $a_informacion_extra;

            // 2017.01.22 - cuando se crea por primera vez no lo traia.
                $a_encuesta_respuesta[0]['video_thumbnail'] = str_replace( ".mp4", ".jpg", $s_video_ruta );   

            //*/

        // preparar la informacion del boton para visualizar el video

            // asignar el valor que se guardara en el campo de la tabla del formulario
                $o_form->input_save_value( array(
                    "data" => array(
                        "component_id" => $a_parameters['component_id'],
                        //"x_value"      => "datos del video",
                        "x_value"      => json_encode( $a_encuesta_respuesta ),
                    ),
                ) );

        // informacion para la vista
            $a_result['actions'][] = array(
                "object" => "instance", 
                "method" => "content_append",
                //"data"   => '<div style="float: right; margin-right: 0px; margin-bottom: 8px; margin-left: 8px;">
                //    <button type="button" style="background-color: #fff; font-weight: 300;" class="btn btn-light uploader_1_file">'.$s_archivo_nuevo.'</button></div>',
            );

        return $a_result;
    }
}

class video_2_input {
    
    static public function video_save ( $a_parameters = null ) {
        //print_r( "video_2_input.video_save() <br/> \n" );
        //print_r( $a_parameters );

        //exit();

        // variables
            global $oYApp;
            
            $s_usuario_id = $oYApp->a_data['usuario'][0]['id'];

            $a_result = array(
                "actions" => array(),
            );
            //*/

        // obtener la instancia del componente target que dispara el evento y el formulario
            $o_component_target = $oYApp->a_components[ $a_parameters['component_id'] ];
            $o_form             = $oYApp->a_components[ $o_component_target->a_config['form'] ];

        // procesar los datos del video

            $a_encuesta_respuesta    = array( array() );
            $a_encuesta_respuesta[0] = $a_parameters['data'];
            //*/

        // preparar la informacion del boton para visualizar el video

            // asignar el valor que se guardara en el campo de la tabla del formulario
                $o_form->input_save_value( array(
                    "data" => array(
                        "component_id" => $a_parameters['component_id'],
                        //"x_value"      => "datos del video",
                        "x_value"      => json_encode( $a_encuesta_respuesta ),
                    ),
                ) );

        // informacion para la vista
            $a_result['actions'][] = array(
                "object" => "instance", 
                "method" => "content_append",
                //"data"   => $a_encuesta_respuesta,
                //"data"   => '<div style="float: right; margin-right: 0px; margin-bottom: 8px; margin-left: 8px;">
                //    <button type="button" style="background-color: #fff; font-weight: 300;" class="btn btn-light uploader_1_file">'.$s_archivo_nuevo.'</button></div>',
            );

        return $a_result;
    }
}