<?php 

// debug 
    //print_r( __FILE__ . "<br> \n" );
    //print_r( $a_form_registro );

// variables

    $_v = array(
        "b_email_existe"  => null,
        
        "b_ctrl_email_duplicado"   => false,
        "b_ctrl_datos_vacios"      => false,

        "s_url"           => "",
        "s_email"         => "",
        "s_email_session" => "",         // email del usuario registrado
        "s_query"         => "",
        "a_query"         => array(),
        "o_base"          => new base(),
    );

/*/ logica

    // construir la url del formulario para ofrecerla ante alguna situacion de error
    // recargar el formulario limpia los campos, lo contrario sucede cuando se regresa a partir 
    // del historial del navegador.

        $_v['s_url'] = $oYApp->aGet_['s_complete'];
        $_v['s_url'] = str_replace( FMWK_CLIE_ROOT, "", $_v['s_url'] );
        $_v['s_url'] = FMWK_CLIE_SERV . $_v['s_url'];

    // identificar si existe el correo electronico en la base de datos
        $_v['s_email'] = $a_form_registro['V55X3LPJ67U2W49012IR'];
        $_v['s_query'] = "SELECT * FROM usuario WHERE email = '" . $_v['s_email'] . "'";

        $_v['a_query'] = $_v['o_base']->procSent( $_v['s_query'] );
        $_v['a_query'] = $_v['a_query']['aDato'];

        $_v['b_email_existe'] = empty( $_v['a_query'] ) ? false : true;

    // 2019.02.02 - control error que se produce al volver a la pagina del formulario que fue cargado
    // y rechazado por utilizar un email existente. 
    // los valores que se analizan no tienen datos entonces el script lo procesa como si no tuviese
    // errores

        if ( is_null( $_v['s_email'] ) )
            $_v['b_ctrl_datos_vacios'] = true; 
        else if ( trim( $_v['s_email'] ) == "" )
            $_v['b_ctrl_datos_vacios'] = true; 

    // si existe el usuario se debe interrumpir el codigo de index_custom cambiando el valor de
    // b_form_registro

        if ( ! $oYApp->bLgin )
        {
            if ( $_v['b_email_existe'] )   
                $_v['b_ctrl_email_duplicado'] = true;
        }

    //*/

    switch ( $i_form_custom_step ) 
    {
        case 1:
            
            $a_mensaje = array(
                "title"       => "Disciplinas artísticas registradas!",
                "description" => "Hemos registrado los datos que ingresaste. Este formulario es la base para determinar
                    los tipos de proyectos donde puedes trabajar y las oportunidades que pueden resultarte interesantes.",
            );

            /*
            if ( $_v['b_ctrl_email_duplicado'] )
            {
                $a_mensaje = array(
                    "title"       => "Correo Electrónico Rechazado",
                    "description" => "El correo electrónico pertenece a un usuario registrado. <br /> 
                        Prueba <a href='" . FMWK_CLIE_SERV . "login '>iniciar sesión</a> o recuperar la contraseña.",
                );
            }

            if ( ! $_v['b_ctrl_email_duplicado'] )
            {   
                $a_mensaje = array(
                    "title"       => "Formulario Actualizado!",
                    "description" => "Excelente que mantengas actualizada tu información. Esto es clave para las búsquedas
                        y para la comunicación entre nosotros.",
                );
            }

            if ( $_v['b_ctrl_datos_vacios'] )
            {   
                //var_dump( $oYApp );

                $a_mensaje = array(
                    "title"       => "Error en Datos Enviados",
                    "description" => "Por favor, presiona el siguiente <a href='". $_v['s_url'] ."'>link</a>.",
                );
            }

            

            if ( $_v['b_ctrl_email_duplicado'] )
                $b_form_registro = false;
            
            if ( $_v['b_ctrl_datos_vacios'] )
                $b_form_registro = false;

            //var_dump( $b_form_registro );
            */

            break;
        
        case 2:

            /*
            // envio de email
            if ( ! $oYApp->bLgin )
            {
                

                // enviar el email con el codigo de validacion
                $a_mail = array();
                //$a_mail['usuario'] = array( $a_usuario );
                $a_mail['usuario'] = $_v['a_query'];
                $a_mail['empresa'] = array(
                    array( 
                        "empresa_nombre" => FMWK_CLIE_TITU, 
                        "FMWK_CLIE_SERV" => FMWK_CLIE_SERV,
                        "FORM_REGISTRACION_URL" => FMWK_CLIE_SERV . "form/C4Y14E1Z?ref=" . $_v['a_query'][0]['id_aleatorio'] ,
                    ),
                );

                $a_email_config = array(
                  //"aDest" => array( $a_usuario[0]['email'] ),                                
                  "aDest" => array( $_v['a_query'][0]['email'] ),                                
                  "sTitu" => FMWK_CLIE_TITU . " - Registración",
                  "sTemp" => "registracion.php",
                  "aDato" => $a_mail,
                  //"bDbug" => true,
                ); 

                // envio de email
                $o_mail = new mail();
                $s_mail = $o_mail ->send( $a_email_config );
                //echo $s_mail;
            }
            */

            break;

        default:
            # code...
            break;
    }

// debug
    
    //var_dump( $b_form_registro );
    //var_dump( $_v );
