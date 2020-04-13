<?php

/*/ debug
    echo "<pre>";
    var_dump( $_GET );
    var_dump( $_POST );
    var_dump( $_SERVER );
    var_dump( $_SERVER['REQUEST_URI'] );
    echo "</pre>";
    //*/

// includes

    include( "structure_settings.php" );

// variables

    $s_error_message = "";

    $s_project_folder = "/test/apimanager/";

    $s_request_uri = $_SERVER['REQUEST_URI'];
    
    $s_request_uri = str_replace( $s_project_folder, "", $s_request_uri );
    
    $s_request_uri_ctrl = strpos($s_request_uri, "/");
    $b_request_uri_ctrl = $s_request_uri_ctrl !== false ? 
        ( $s_request_uri_ctrl == 0 ? true : false ) : false;
    if ( $b_request_uri_ctrl )
        $s_request_uri = substr( $s_request_uri, 1 );
    
    $a_request_uri = explode( "?", $s_request_uri );
    
    $a_uri_values = explode( "/", $a_request_uri[0] );
    
    $b_params_values = isset( $a_request_uri[1] );
    $a_params_values = $b_params_values ? explode( "&", $a_request_uri[1] ) : array();

    $a_uri_keys   = array(
        "internal_version", "operator", "country", 
        "country_version", "resource", "id",
        "action",
    );

    $a_control_url_values = array();
    foreach( $a_uri_keys as $i_key => $s_key )
        $a_control_url_values[ $s_key ] = array(
            "set"      => false,
            "approved" => false,
        );

    $a_url_values_allow = array(
        "internal_version" => array("v1", "v2"),
        "operator"         => array("tuenti"),
        "country"          => array("ecuador"),
        "country_version"  => array("v1", "v2"),
        "resource"         => array("pin", "token", "messageMT", "messageMTBulk", "notification"),
        "action"           => array("verify"),
    );

    $a_country_code = array(
        "ec" => "ecuador"
    );
    
    $a_core_class = array("class_base.php", "jwt.php", "log.php", "email.php");

    $s_method = "";

    $b_method_get_error = false;

    $a_error_messages_url_param = array(
        "internal_version" => array(
            "set"      => "La versión del API Manager no se encuentra declarada. ",
            "approved" => "La versión del API Manager no es válida. "
        ),
        "operator" => array(
            "set"      => "El operador no se encuentra declarado. ",
            "approved" => "El operador no es válido. "
        ),
        "country" => array(
            "set"      => "El país no se encuentra declarado. ",
            "approved" => "El país no es válido. "
        ),
        "country_version" => array(
            "set"      => "La versión del operador no se encuentra declarada. ",
            "approved" => "La versión del operador no es válida. "
        ),
        "resource" => array(
            "set"      => "El recurso no se encuentra declarado. ",
            "approved" => "El recurso no es válido. "
        ),
        "id" => array(
            "set"      => "El id del recurso no se encuentra declarado. ",
            //"approved" => "El recurso no es válido. "
        ),
        "action" => array(
            //"set"      => "El id del recurso no se encuentra declarado. ",
            "approved" => "La acción no es válida. "
        ),
    );

// uri values and parameters - order

    // uri values
    $a_auxi = array();
    foreach( $a_uri_values as $i_uri_value => $s_uri_value )
        $a_auxi[ $a_uri_keys[ $i_uri_value ] ] = $s_uri_value;
    $a_uri_values = $a_auxi;

    // parameters
    if ( ! empty( $a_params_values ) )
    {
        $a_auxi = array();
        foreach( $a_params_values as $i_param => $s_param )
        {
            $a_param = explode("=", $s_param);
            $a_auxi[ $a_param[0] ] = $a_param[1];
        }
        $a_params_values = $a_auxi;
    }

    //var_dump( $a_uri_values );

// validar uri values

    // 2020.01.08 - country code
    $s_url_country = $a_uri_values['country'];
    if ( isset( $a_country_code[ $s_url_country ] ) )
        $a_uri_values['country'] = $a_country_code[ $s_url_country ];

    foreach( $a_control_url_values as $s_ctrl_param => $a_ctrl_param )
    {
        //if ( $s_ctrl_param != "internal_version" )
        //    break;
        $b_approved = false;

        $b_set   = isset( $a_uri_values[ $s_ctrl_param ] );
        $s_value = $b_set ? $a_uri_values[ $s_ctrl_param ] : "";
        $b_empty = $b_set ? ( $s_value == "" ? true : false ) : true;
        
        $b_allow = isset( $a_url_values_allow[ $s_ctrl_param ] );
        $a_allow = $b_allow ? $a_url_values_allow[ $s_ctrl_param ] : array();
        
        if( $b_allow )
            $b_approved = !$b_empty ? in_array( $s_value, $a_allow ) : false;
        
        $a_ctrl_param['set']      = ( $b_set && !$b_empty );
        $a_ctrl_param['allow']    = $b_allow;
        $a_ctrl_param['approved'] = $b_approved;

        $a_control_url_values[ $s_ctrl_param ] = $a_ctrl_param;
    }

    $s_control_url_values = json_encode( $a_control_url_values );
    //echo $s_control_url_values;

// validar clase

    $s_config_folder  = "";
    $s_core_folder    = "";
    $s_class_folder   = "";
    $s_class_path     = "";
    $s_project_folder = dirname( __FILE__ );
    
    
    //if ( $b_internal_version )
    if ( $a_control_url_values['internal_version']['approved'] )
    {
        $s_core_folder   = $s_project_folder."/core/". $a_uri_values['internal_version'] . "/classes/";
        
        //if ( $b_internal_version && $b_country_version )
        if ( $a_control_url_values['country_version']['approved'] )
            $s_class_folder = $s_project_folder."/classes/". $a_uri_values['country_version'] . "/";
    }

    // 2020.01.02 - carpeta donde se encuentra la implementacion operador-pais
    if ( $a_control_url_values['operator']['approved'] )
        $s_class_folder .= $a_uri_values['operator'] . "/";
    if ( $a_control_url_values['country']['approved'] )
        $s_class_folder .= $a_uri_values['country'] . "/";
    
    //if ( $b_operator && $b_country && $b_country_version )
    if ( $a_control_url_values['operator']['approved'] &&
         $a_control_url_values['country']['approved'] &&
         $a_control_url_values['country_version']['approved'] )
    {
        $s_class_name = $a_uri_values['operator']."_".
                        $a_uri_values['country']."_".
                        $a_uri_values['country_version'];

        $s_class_file = $s_class_name.".php";
        $s_class_path = $s_class_folder.$s_class_file;

        //2020.01.02 - construir ruta del archivo de configuracion
        $s_config_folder = $s_project_folder."/config/". $a_uri_values['country_version']."/".
                           $a_uri_values['operator']."/".
                           $a_uri_values['country']."/";
        $s_config_file   = $s_config_folder . "config.json";
    }

    if ( ! isset( $s_config_file ) )
        $s_config_file = "";

    $b_config_file  = file_exists( $s_config_file );
    $b_core_folder  = file_exists( $s_core_folder );
    $b_class_folder = file_exists( $s_class_folder );
    $b_class_file   = $b_class_folder ? file_exists( $s_class_path ) : false;

// controles

    // carpeta core por defecto
    $b_core_default = false;
    if ( !$b_core_folder )
    {
        $s_core_folder  = $s_project_folder."/core/default/";
        $b_core_folder  = true;
        $b_core_default = true;
    }

    // incluir clases core
    if ( $b_core_folder )
    {
        foreach( $a_core_class as $i_core_class => $s_core_class )
        {
            if ( $s_core_class == "class_base.php" )
                include( $s_core_folder.$s_core_class );
            else if ( ! $b_core_default )
                include( $s_core_folder.$s_core_class );
        }
    
        $o_class  = new class_base();    
        $s_method = $o_class->get_request_method();
    }

    // errores de la url 
    // vienen luego de las clases core porque es necesario obtener el metodo del request
    $b_error = false;
    foreach( $a_control_url_values as $s_ctrl_param => $a_ctrl_param )
    {
        if( $s_ctrl_param == "resource" )
        {
            if ( $s_method == "POST" && $a_ctrl_param['approved'] &&
                 ! $a_control_url_values['id']['set'] )
            {
                $b_error = false;
                break;
            }
            else if ( $s_method == "GET" && $a_ctrl_param['approved'] &&
                      $a_control_url_values['id']['set'] )
            {
                $b_error = false;
                break;
            }
        }

        if ( !$a_ctrl_param['set'] ||
             ( !$a_ctrl_param['approved'] && $a_ctrl_param['allow'] ) )
        {
            $b_error = true;

            if ( $s_method == "POST" )
                unset( $a_error_messages_url_param['id'] );

            break;
        }
    }
    
    // incluir clase del operador e instanciar
    if ( !$b_error && $b_class_file )
    {
        include( $s_class_path );
        
        $o_class  = new $s_class_name();
        
        // 2020.01.02 - definir archivo de configuracion
        if ( $b_config_file )
            $o_class->set_config_file( $s_config_file );

        // 2020.01.02 - guardar la ruta de la clase
        $o_class->set_class_folder( $s_class_folder );

        // la validacion esta arriba
        if ( $s_method == "GET" )
        {
            $o_class->set_id( $a_uri_values['id'] );
        }
        else if ( $s_method == "POST" && $a_control_url_values['action']['allow'] )
        {
            if ( $a_control_url_values['id']['set'] )
                $o_class->set_id( $a_uri_values['id'] );
            if ( $a_control_url_values['action']['approved'] )
                $o_class->set_action( $a_uri_values['action'] );
        }
            
    }
    

 // logica
    if ( !$b_error )
    {
        $s_resource = $a_uri_values['resource'];

        $o_class->$s_resource();
    }
        
    
// definicion de mensajes
    
    foreach( $a_control_url_values as $s_ctrl_param => $a_ctrl_param )
    {
        if( isset( $a_error_messages_url_param[ $s_ctrl_param ] ) )
        {
            if ( !$a_ctrl_param['set'] && isset( $a_error_messages_url_param[ $s_ctrl_param ]['set'] ) )
                $s_error_message .= $a_error_messages_url_param[ $s_ctrl_param ]['set'];
            else if ( !$a_ctrl_param['approved'] && isset( $a_error_messages_url_param[ $s_ctrl_param ]['approved'] ) )
                $s_error_message .= $a_error_messages_url_param[ $s_ctrl_param ]['approved'];
        }
    }

// show messages

    if ( $b_error )
    {
        if ( $s_error_message == "" )
            $s_error_message = "Error no identificado. Por favor, controlar los valores de la URL y su relación con el método $s_method utilizado.";

        $o_class->send_404( array( "Description" => $s_error_message ) );
    }
         
/*/ debug 

    echo "<pre style='background-color: #ddd; padding: 16px;'>";
    
    var_dump( getallheaders() );
    var_dump( $_REQUEST );
    var_dump( $_SERVER );

    echo_variable( 'b_internal_version' ); 
    echo_variable( 'b_operator' ); 
    echo_variable( 'b_country' ); 
    echo_variable( 'b_country_version' ); 
    echo_variable( 'b_resource' ); 
    echo_variable( 'b_error' ); 

    echo_variable( 's_core_folder' ); 
    echo_variable( 's_class_name' ); 
    echo_variable( 's_class_folder' ); 
    echo_variable( 's_class_path' ); 
    echo_variable( 'b_class_folder' ); 
    echo_variable( 'b_class_file' ); 

    echo_variable( 's_request_uri' ); 
    echo_variable( 'a_request_uri' ); 
    echo_variable( 'a_uri_values' ); 
    echo_variable( 'a_params_values' ); 

    echo "</pre>";
    //*/

// functions

    function echo_variable ( $s_variable_name = null ) {
        echo "$s_variable_name: <br>";    
        var_dump( $GLOBALS[ $s_variable_name ] );
        echo "<br><br>";
    }