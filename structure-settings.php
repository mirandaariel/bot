<?php

//var_dump( __FILE__ );
//print_r( $_SERVER );

// se obtiene informacion particular del proyecto
    include_once( dirname(__FILE__) . "/project/project-settings.php" );

// controlar el ambiente de la app
    //[HTTPS] => on
    //[HTTP_HOST] => labs.yobi.com.ar
    //[HTTP_HOST] => localhost

    // variable de control
    $a_control = array(
        "HTTPS"       => false,
        "DESARROLLO"  => false,
        "STAGE"       => false,
        "PRODUCCION"  => false,
    );

    // setear la variable de control que define HTTPS
        if ( isset( $_SERVER['HTTPS'] ) )
            if ( $_SERVER['HTTPS'] == "on" )
                $a_control['HTTPS'] = true;
    
    // setear la variable de control que define el ambiente host
        if ( strpos( $_SERVER['HTTP_HOST'], "localhost" ) !== false )
            $a_control['DESARROLLO'] = true;
        else if ( 
            strpos( $_SERVER['HTTP_HOST'], "labs.estructura" ) !== false || 
            strpos( $_SERVER['HTTP_HOST'], "stage.estructura" ) !== false )
            $a_control['STAGE'] = true;
        else
            $a_control['PRODUCCION'] = true;

    // definicion de variables
        $s_FMWK_CLIE_NAME = "bot";
        $s_protocolo = $a_control['HTTPS'] ? "https" : "http";

        if ( $a_control['DESARROLLO'] )
        {
            include( "development-settings.php" );
        }
        else if ( $a_control['STAGE'] )
        {
            $s_FMWK_CLIE_SERV   = $s_protocolo . "://labs.estructura.co/bot/";
            $s_FMWK_CLIE_ROOT   = "/bot/";
            $s_FMWK_CLIE_DIRE   = "/var/www/html/labs/" . $s_protocolo . "/bot/";

            $s_FMWK_BASE_SERV   = "172.30.0.52";
            $s_FMWK_BASE_NOMB   = "bot_calidad_v24";
            $s_FMWK_BASE_USUA   = "appsbase";
            $s_FMWK_BASE_PASW   = "21abpapsse03!";

            $s_YOBI_SERVIDOR_01 = $s_protocolo . "://labs.estructura.co/";
            $s_ROOT_DISTANCE    = "../"; 

            $s_FMWK_YOBI_ROOT   = $s_YOBI_SERVIDOR_01 . "core/fmwk/";
            $s_FMWK_YOBI_SERV   = $s_FMWK_YOBI_ROOT;
            $s_FMWK_YOBI_CLAV   = "0123456789012345678901234567890123456789";
            $s_FMWK_YOBI_PATH   = '/var/www/html/labs/' . $s_protocolo . '/core/fmwk/';
            
            $s_STRUCTURE_DEFAULT_HTTP = $s_YOBI_SERVIDOR_01 . "core/default/";
            $s_STRUCTURE_DEFAULT_ROOT = "/core/default/";
            $s_STRUCTURE_DEFAULT_PATH = '/var/www/html/labs/' . $s_protocolo . '/core/default/';

            $s_STRUCTURE_VENDORS_HTTP = $s_YOBI_SERVIDOR_01 . "core/vendors/";
            $s_STRUCTURE_VENDORS_ROOT = "/core/vendors/";
            $s_STRUCTURE_VENDORS_PATH = "/var/www/html/labs/" . $s_protocolo . "/core/vendors/";
        }
        else if ( $a_control['PRODUCCION'] )
        {
            $s_FMWK_CLIE_SERV   = $s_protocolo . "://bot.com/";
            $s_FMWK_CLIE_ROOT   = "/";
            $s_FMWK_CLIE_DIRE   = "/var/www/html/clie/soporteartistas/com/v24.1/";

            $s_FMWK_BASE_SERV   = "172.30.0.52";
            $s_FMWK_BASE_NOMB   = "bot_produccion_v24";
            $s_FMWK_BASE_USUA   = "appsbase";
            $s_FMWK_BASE_PASW   = "21abpapsse03!";

            $s_YOBI_SERVIDOR_01 = $s_FMWK_CLIE_SERV;
            $s_ROOT_DISTANCE    = "/"; 

            $s_FMWK_YOBI_ROOT   = $s_YOBI_SERVIDOR_01 . "core/fmwk/";
            $s_FMWK_YOBI_SERV   = $s_FMWK_YOBI_ROOT;
            $s_FMWK_YOBI_CLAV   = "0123456789012345678901234567890123456789";
            $s_FMWK_YOBI_PATH   = $s_FMWK_CLIE_DIRE . '/core/fmwk/';

            $s_STRUCTURE_DEFAULT_HTTP = $s_YOBI_SERVIDOR_01 . "core/default/";
            $s_STRUCTURE_DEFAULT_ROOT = "/core/default/";
            $s_STRUCTURE_DEFAULT_PATH = $s_FMWK_CLIE_DIRE . '/core/default/';

            $s_STRUCTURE_VENDORS_HTTP = $s_YOBI_SERVIDOR_01 . "core/vendors/";
            $s_STRUCTURE_VENDORS_ROOT = "/core/vendors/";
            $s_STRUCTURE_VENDORS_PATH = $s_FMWK_CLIE_DIRE . "/core/vendors/";
        }

// Definicion de las constantes del sistema
    if ( ! isset( $s_YOBI_SERVIDOR_01 ) )
        print_r( $_SERVER );

    // definir la constante de la version de PHP. 
        // Se utiliza para sustituir funciones que se encuentran obsoletas
        // PHP_VERSION_ID está disponible a partir de PHP 5.2.7
        if ( !defined('PHP_VERSION_ID') ) 
        {
            $version = explode('.', PHP_VERSION);
            define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
        }

    // definicion de todo el ambiente de la app
    define( "YOBI_SERVIDOR_01", $s_YOBI_SERVIDOR_01 );
    define( "ROOT_DISTANCE",    $s_YOBI_SERVIDOR_01 );

    // donde esta el framework
    define( "FMWK_YOBI_ROOT",   $s_FMWK_YOBI_ROOT );
    define( "FMWK_YOBI_PATH",   $s_FMWK_YOBI_PATH . FMWK_YOBI_VERS );
    define( "FMWK_YOBI_SERV",   $s_FMWK_YOBI_SERV . FMWK_YOBI_VERS );
    define( "FMWK_YOBI_CLAV",   $s_FMWK_YOBI_CLAV );

    // donde esta default
    define( "STRUCTURE_DEFAULT_HTTP", $s_STRUCTURE_DEFAULT_HTTP . STRUCTURE_DEFAULT_VERS );
    define( "STRUCTURE_DEFAULT_ROOT", $s_STRUCTURE_DEFAULT_ROOT . STRUCTURE_DEFAULT_VERS );
    define( "STRUCTURE_DEFAULT_PATH", $s_STRUCTURE_DEFAULT_PATH . STRUCTURE_DEFAULT_VERS );

    // donde esta vendors
    define( "STRUCTURE_VENDORS_HTTP", $s_STRUCTURE_VENDORS_HTTP . STRUCTURE_VENDORS_VERS );
    define( "STRUCTURE_VENDORS_ROOT", $s_STRUCTURE_VENDORS_ROOT . STRUCTURE_VENDORS_VERS );
    define( "STRUCTURE_VENDORS_PATH", $s_STRUCTURE_VENDORS_PATH . STRUCTURE_VENDORS_VERS );

    // donde esta la propia app
    if ( ! defined( "FMWK_CLIE_MODU" ) )                                                                                // si no esta definido no hay previa configuracion de un modulo
      define( "FMWK_CLIE_MODU", false );                                                                                // determina si la app es no un modulo

    if ( ! FMWK_CLIE_MODU )
    {
      define( "FMWK_MODU_REFE", "" );                                                                                   // la referencia al modulo debe estar vacia
      define( "FMWK_MODU_NAME", "" );                                                                                   // el nombre del modulo debe estar vacio
    }

    define( "FMWK_CLIE_HTTP", $s_protocolo );
    define( "FMWK_CLIE_NAME", $s_FMWK_CLIE_NAME . FMWK_MODU_NAME );
    define( "FMWK_CLIE_SERV", $s_FMWK_CLIE_SERV . FMWK_MODU_REFE );
    define( "FMWK_CLIE_ROOT", $s_FMWK_CLIE_ROOT . FMWK_MODU_REFE );                                                     // root de la aplicacion
    define( "FMWK_CLIE_DIRE", $s_FMWK_CLIE_DIRE . FMWK_MODU_REFE );                                                     // necesario a partir de la v14
    define( "FMWK_CLIE_PATH", $s_FMWK_CLIE_DIRE . FMWK_MODU_REFE );

    // donde esta la base de datos
    define( "FMWK_BASE_SERV", $s_FMWK_BASE_SERV );
    define( "FMWK_BASE_NOMB", $s_FMWK_BASE_NOMB );
    define( "FMWK_BASE_USUA", $s_FMWK_BASE_USUA );
    define( "FMWK_BASE_PASW", $s_FMWK_BASE_PASW );

    // caracteristicas del ambiente
    define( "FMWK_AMBI_DESA", $a_control['DESARROLLO']  ); 
    define( "FMWK_AMBI_CALI", $a_control['STAGE'] );
    define( "FMWK_AMBI_PROD", $a_control['PRODUCCION'] );      