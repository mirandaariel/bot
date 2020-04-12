<?php
//print_r( __FILE__ );

//$a_parameters = $oYApp->controlParameters();
//$a_parameters = $oYApp->executeLogic( $a_parameters );

// control de inicio de sesion
    if ( ! $oYApp->bLgin )
        header( "location: " . FMWK_CLIE_SERV );

// definir componentes - INI
    
    // rutas
    define( "THEME_PATH", STRUCTURE_DEFAULT_PATH . "themes/clean/" );
    define( "COMPONENT_PATH", THEME_PATH . "components/" );

    // componentes de layout
    define( "COMPONENT_LINK", COMPONENT_PATH . "layout/link/general/1/link.php" );
    define( "COMPONENT_NAVBAR", COMPONENT_PATH . "layout/navbar/2/navbar.php" );
    //define( "COMPONENT_MENU_1", COMPONENT_PATH . "layout/menu-1/1/menu-1.php" );
    //define( "COMPONENT_MENU_2", COMPONENT_PATH . "layout/menu-2/1/menu-2.php" );
    //define( "COMPONENT_PANEL_LEFT", COMPONENT_PATH . "layout/panel/left/1/panel-left.php" );
    //define( "COMPONENT_PANEL_RIGHT", COMPONENT_PATH . "layout/panel/right/1/panel-right.php" );

// variables
    $o_base = new base();

/*/ 2017.09.10 - codigos aleatorios para los formularios - INI
    $a_form_control = array(
        "6" => $oYApp->oFrameworkConnection->oFramework->codiGene( array("iLong"=>16) ),
        "7" => $oYApp->oFrameworkConnection->oFramework->codiGene( array("iLong"=>16) ),
    );

    $oYApp->a_data['form_control'] = $a_form_control;
    $oYApp->save();
    // 2017.09.10 - codigos aleatorios para los formularios - FIN

    $b_form_9_delete = false;   

    $s_usuario_id = $oYApp->a_data['usuario'][0]['id'];
    $s_app_rol_id = $oYApp->a_data['usuario'][0]['app_rol_id'];

    $a_form = array();
    $o_base = new base();
    //*/

/*/ 2017.02.20 - buscar procesos instancias de acuerdo con las entidades objetivo - INI
    
    // template de la consulta que cambiara por cada objetivo que se desee consultar
        $s_query_template = "SELECT 
            wf_instancia.id wf_instancia_id, 
            wf_instancia_soporte.entidad_nombre,
            wf_instancia_soporte.entidad_clave,
            wf_instancia_soporte.filtro
            FROM wf_instancia 
            LEFT OUTER JOIN wf_instancia_etapa ON wf_instancia_etapa.wf_instancia_id = wf_instancia.id
            LEFT OUTER JOIN wf_instancia_soporte ON wf_instancia_soporte.wf_instancia_etapa_id = wf_instancia_etapa.id
            LEFT OUTER JOIN wf_asignacion_rol ON wf_asignacion_rol.wf_etapa_id = wf_instancia_etapa.wf_etapa_id
            LEFT OUTER JOIN wf_asignacion_usuario ON wf_asignacion_usuario.wf_etapa_id = wf_instancia_etapa.wf_etapa_id
            LEFT OUTER JOIN wf_etapa ON wf_etapa.id = wf_instancia_etapa.wf_etapa_id
            WHERE wf_instancia.entidad_nombre = '[objetivo_nombre]'
                AND wf_instancia.entidad_clave = [objetivo_clave]
                AND wf_etapa.flag_instanciada = 1
                AND wf_etapa.orden <= 2
                -- AND wf_instancia_etapa.flag_pendiente = 1
                AND ( wf_asignacion_rol.app_rol_id = [app_rol_id]
                    OR wf_asignacion_usuario.usuario_id = [usuario_id] 
                )";

    // array de objetivos a consutlar
        $a_objetivos = array(
            array( "usuario", $s_usuario_id ),
        );

    // obtener los soportes que seran enviados a la vista
        foreach ( $a_objetivos as $i_for_instance => $a_for_instance ) 
        {
            $s_objetivo_nombre = $a_for_instance[0];
            $s_objetivo_clave  = $a_for_instance[1];
            
            $s_query_instance = $s_query_template;
            $s_query_instance = str_replace( "[objetivo_nombre]", $s_objetivo_nombre, $s_query_instance ); 
            $s_query_instance = str_replace( "[objetivo_clave]",  $s_objetivo_clave,  $s_query_instance ); 
            $s_query_instance = str_replace( "[usuario_id]",      $s_usuario_id,      $s_query_instance ); 
            $s_query_instance = str_replace( "[app_rol_id]",      $s_app_rol_id,      $s_query_instance ); 

            $a_base = $o_base->procSent( $s_query_instance );
            $a_data = $a_base['aDato'];

            foreach ( $a_data as $i_soporte_instance => $a_soporte_instance ) 
            {
                $s_soporte = $a_soporte_instance['entidad_nombre'];
                $o_soporte = new $s_soporte();
                $o_soporte ->enable_relations();
                $o_soporte ->aBase['aFilt'][] = $a_soporte_instance['filtro'];
                $a_soporte = $o_soporte->find();

                // 2017.03.21 - controlar si la ultima respuesta asociada al estado aprobado, desestimado o 
                // conejo. En caso de existir el objetivo NO DEBE SER MOSTRADO

                // obtener las respuestas para la instancia y la etapa en analisis
                $s_sql = "SELECT
                    wf_instancia_etapa.wf_instancia_id,
                    wf_instancia_etapa.orden,
                    wf_instancia_respuesta.id,
                    wf_instancia_respuesta.fecha_creacion,
                    wf_estado.nombre 
                    FROM wf_instancia_etapa  
                    LEFT OUTER JOIN wf_instancia_respuesta ON wf_instancia_respuesta.wf_instancia_etapa_id = wf_instancia_etapa.id 
                    LEFT OUTER JOIN wf_etapa_estado ON wf_etapa_estado.id = wf_instancia_respuesta.wf_etapa_estado_id
                    LEFT OUTER JOIN wf_estado ON wf_estado.id = wf_etapa_estado.wf_estado_id
                    WHERE wf_instancia_etapa.wf_instancia_id = [wf_instancia_id] 
                    AND wf_instancia_etapa.orden = 2
                    AND wf_estado.nombre IN ('Aprobado', 'Desestimado', 'Conejo')";
                $s_sql  = str_replace( "[wf_instancia_id]", $a_soporte_instance['wf_instancia_id'], $s_sql );
                $a_base = $o_base ->procSent( $s_sql );
                $a_respuesta = $a_base['aDato'];

                // si hay respuesta para los estados mencionados en la consulta SQL, no se deben mostrar 
                // los objetivos
                if ( empty( $a_respuesta ) )
                    $a_form[] = $a_soporte[0];  
            }
        }
        //echo $s_query_instance;
        //var_dump( $a_form );

    // 2018.05.13 - control existencias de formulario para el usuario logueado
        $b_form = empty( $a_form ) ? false : true;

        if ( ! $b_form )
        {
            
            $o_wf_instancia = new wf_instancia();
            $o_wf_instancia ->aBase['aFilt'][] = "wf_instancia.wf_proceso_id = 1";            
            $o_wf_instancia ->aBase['aFilt'][] = "wf_instancia.entidad_nombre = 'usuario'";            
            $o_wf_instancia ->aBase['aFilt'][] = "wf_instancia.entidad_clave = '$s_usuario_id'";   
            $a_wf_instancia = $o_wf_instancia->find();         

            if( empty( $a_wf_instancia ) )
            {   
                wf_proceso::crear_instancia_desde_objetivo( array(
                    "proceso"    => 1,
                    "entidad"    => "usuario",
                    "entidad_id" => $s_usuario_id,
                ));
            }

            $o_wf_instancia = new wf_instancia();
            $o_wf_instancia ->aBase['aFilt'][] = "wf_instancia.wf_proceso_id = 2";            
            $o_wf_instancia ->aBase['aFilt'][] = "wf_instancia.entidad_nombre = 'usuario'";            
            $o_wf_instancia ->aBase['aFilt'][] = "wf_instancia.entidad_clave = '$s_usuario_id'";   
            $a_wf_instancia = $o_wf_instancia->find();         

            if( empty( $a_wf_instancia ) )
            {   
                wf_proceso::crear_instancia_desde_objetivo( array(
                    "proceso"    => 2,
                    "entidad"    => "usuario",
                    "entidad_id" => $s_usuario_id,
                ));
            }
            //exit();
            
            header( "location: " . FMWK_CLIE_SERV . "main" );
        }
    //*/

/*/ paneles - INI
    $a_parameters['control']['panel-right'] = array(
        "show" => true,
        "file" => FMWK_CLIE_DIRE . "project/view/includes/panels/ficha/default-derecho.php",
    );
    //*/

// workflow engine
    
    // obtener instancias de las etapas que el usuario puede visualizar

        // en este caso, como la etapa tiene un soporte que corresponde a un formulario definido en el motor de 
        // formularios la instancia de la etapa que solo puede ver es aquella que le corresponde al usuario logueado.
        $a_obtener_etapa_instancias = wf_proceso::obtener_etapa_instancias( array(
            "proceso"     => 14,
            "etapa_orden" => 1,
        ) );
        $s_query_instance = $a_obtener_etapa_instancias['query'];
        //print_r( $s_query_instance );
        //var_dump( $a_obtener_etapa_instancias );
        //exit();

    // ejecutar la consulta y obtener las instancias de cada formulario
        $a_formularios       = array();
        $a_query_formularios = $o_base->procSent( $s_query_instance );

        foreach ( $a_query_formularios['aDato'] as $i_query_record => $a_query_record ) 
        {
            $o_formulario = new form_cabecera();
            $a_formulario = $o_formulario->read( array( "id" => $a_query_record['form_cabecera_id'] ) );

            $a_formularios[] = $a_formulario[0];
        }

    $a_procesos    = array( 14, 15 );
    $a_formularios = array();

    foreach ( $a_procesos as $i_proceso_posi => $i_proceso_id ) 
    {
        $a_obtener_etapa_instancias = wf_proceso::obtener_etapa_instancias( array(
            "proceso"     => $i_proceso_id,
            "etapa_orden" => 1,
        ) );

        $s_query_instance = $a_obtener_etapa_instancias['query'];

        $a_query_formularios = $o_base->procSent( $s_query_instance );

        foreach ( $a_query_formularios['aDato'] as $i_query_record => $a_query_record ) 
        {
            $o_formulario = new form_cabecera();
            $a_formulario = $o_formulario->read( array( "id" => $a_query_record['form_cabecera_id'] ) );

            $a_formularios[] = $a_formulario[0];
        }
    }

    //var_dump( $a_formularios );
    //exit();
        
// configuracion de cards
    $a_cards = array();

    $a_object_config = array(
        "objects" => array(),
        "control" => array(),
    );

    foreach ( $a_formularios as $i_formulario => $a_formulario ) 
    {
        //$o_entity = new $value();
        
        $a_card = $a_object_config;

        $a_card['object'] = new \YOBI\COMPONENTS\CONTAINER\card_1();
        $a_card['object'] = $a_card['object']->config( array(
            "id"               => "card_" . $a_formulario['codigo'],
            "width"            => 4,
            //"img_top"          => $o_entity->aLabels['list-icon-url'],
            "body_title"       => $a_formulario['nombre'],
            //"body_description" => $value['description'],
            "body_buttons"     => array(
                array(
                    "id"    => "",
                    "label" => "Completar",
                    "href"  => FMWK_CLIE_SERV . "form/" . $a_formulario['codigo'],
                ),
            ),
        ) );    

        //$a_cards[ $key ] = $a_card;
        $a_cards[] = $a_card;
    }

    //var_dump( $a_cards );
    //exit();

// 2017.10.17 - configuracion theme clean - INI
    $a_parameters['content']['brand']     = FMWK_CLIE_TITU;
    $a_parameters['content']['tag_title'] = FMWK_CLIE_TITU . " - Principal";

    $a_parameters['control']['navbar-brand-isologo'] = false;
    $a_parameters['control']['form-buscar-action']   = 1;
    $a_parameters['control']['form-buscar']          = true;

    $a_parameters['control']['navbar-logo-desktop-file'] = FMWK_CLIE_SERV . "project/images/logo/cabecera-logo.fw.png";
    
    $a_parameters['control']['dropdown-user']        = true;
    $a_parameters['control']['dropdown-user-title']  = false;
    $a_parameters['control']['dropdown-user-avatar'] = true;
    
    include( "configuracion-menu-1.php" );
    //include( FMWK_CLIE_DIRE . "project/view/species/ficha-especie-configuracion-menu-2.php" );
    //*/

/*/ 2018.04.10 - configuracion de cards
    $a_cards = array();

    $a_object_config = array(
        "objects" => array(),
        "control" => array(),
    );

    foreach ( $a_form as $key => $value ) 
    {
        $a_card = $a_object_config;

        $a_card['object'] = new \YOBI\COMPONENTS\CONTAINER\card_1();
        $a_card['object'] = $a_card['object']->config( array(
            "id"               => "card_" . $value['id'],
            //"width"            => 4,
            //"img_top"          => $value['imagen_portada']['16:9']['imagen_portada_origfile'],
            "img_top"          => $value['media_imagen'][0]['imagen_portada_card'],
            "body_title"       => $value['nombre'],
            "body_description" => $value['description'],
            "body_buttons"     => array(
                array(
                    "id"    => "",
                    "label" => $value['foot_link_label'],
                    "href"  => $value['link'],
                ),
            ),
        ) );    

        $a_cards[ $key ] = $a_card;
    }
    //*/

include( "main.html.php" );