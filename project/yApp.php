<?php

//var_dump( __FILE__ );
//session_start();
//session_destroy();
////var_dump( dirname(__FILE__)."/yApp.php" );

include_once( dirname(__FILE__)."/../structure-settings.php" );

//var_dump( STRUCTURE_DEFAULT_HTTP );

include_once( STRUCTURE_DEFAULT_HTTP."/yAppDefault.cls" );

class yApp extends yAppDefault
{
  // properties

  // methods
  // function __construct( $a_parameters = null ) {}

  public function setLinkToFramework ( $a_parameters = null ) {
    //var_dump( "yApp.setLinkToFramework" );
    error_reporting(0);
    parent::setLinkToFramework();
  }
}
// implementacion ------------------------------------------------------------------------------ INI


function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

// Example

// Inicializar el objeto aplicacion en este archivo porque es el que va incluir cualquier script

// 2016-02-23 - control para no duplicar la instancia cuando se ejecuta un modulo
if ( ! FMWK_CLIE_MODU )
{

    if ( is_session_started() === FALSE ) 
  {
    session_start();
    $_SESSION['CONST'] = array(
      "FMWK_YOBI_ROOT" => FMWK_YOBI_ROOT,
      "FMWK_YOBI_PATH" => FMWK_YOBI_PATH,
      "FMWK_YOBI_SERV" => FMWK_YOBI_SERV,
      "STRUCTURE_DEFAULT_HTTP" => STRUCTURE_DEFAULT_HTTP,
      "STRUCTURE_DEFAULT_ROOT" => STRUCTURE_DEFAULT_ROOT,
      "STRUCTURE_DEFAULT_PATH" => STRUCTURE_DEFAULT_PATH,
      "STRUCTURE_VENDORS_HTTP" => STRUCTURE_VENDORS_HTTP,
      "STRUCTURE_VENDORS_ROOT" => STRUCTURE_VENDORS_ROOT,
      "STRUCTURE_VENDORS_PATH" => STRUCTURE_VENDORS_PATH,
      "FMWK_CLIE_NAME" => FMWK_CLIE_NAME,
      "FMWK_CLIE_PATH" => FMWK_CLIE_PATH,
      "FMWK_CLIE_SERV" => FMWK_CLIE_SERV,
      "FMWK_BASE_SERV" => FMWK_BASE_SERV,
      "FMWK_BASE_NOMB" => FMWK_BASE_NOMB,
      "FMWK_BASE_USUA" => FMWK_BASE_USUA,
      "FMWK_BASE_PASW" => FMWK_BASE_PASW,
      "FMWK_AMBI_DESA" => FMWK_AMBI_DESA,
      "FMWK_AMBI_CALI" => FMWK_AMBI_CALI,
      "FMWK_AMBI_PROD" => FMWK_AMBI_PROD,
    );
  }

  // controlar la existencia de la sesion de la app
  // esto permite tener abierto dos app diferentes
  $b_sesion_app   = false;
  $b_sesion_clave = isset( $_SESSION['a_app'] ) ? true : false;
  
  if ( $b_sesion_clave )
    $b_sesion_app = isset( $_SESSION['a_app'][ FMWK_CLIE_NAME ] ) ? true : false;

  if ( $b_sesion_app )
  {
    //var_dump( "yApp en sesion" );
    //echo FMWK_CLIE_NAME;
    //var_dump( $_SESSION );
    $oYApp = unserialize( $_SESSION['a_app'][ FMWK_CLIE_NAME ] );
    //var_dump( $oYApp);
    
    $oYApp->setLinkToFramework();

    // 2018.05.27 - es necesario volver a levantar el archivo de sesion para no tener clases incompletas
    $oYApp = $oYApp->open_session_object();
  }
  else
  {
    //var_dump( "yApp nueva" );
    $oYApp = new yApp();
    $oYApp ->s_session_id = $oYApp->oFrameworkConnection->oFramework->codiGene( array("iLong"=>16) );
  }
}
// implementacion ------------------------------------------------------------------------------ FIN

//var_dump( $oYApp );

/*/ 2018.05.23 - permisos
    $i_rol = $oYApp->a_data['usuario'][0]['app_rol_id'];

    if ( $i_rol == 2 )
        $APP_CONFIGURATION['a_entidades_principales'] = array();
    else if ( $i_rol == 4 )
        $APP_CONFIGURATION['a_entidades_principales'] = array();
    else if ( $i_rol == 3 )
        $APP_CONFIGURATION['a_entidades_principales'] = array( "usuario", "form_header" );
    //*/
