<?php

//var_dump( __FILE__ );

// includes ------------------------------------------------------------------------------------ INI
include_once( dirname(__FILE__) . "/project/yApp.php" );
// includes ------------------------------------------------------------------------------------ FIN 

// variables ----------------------------------------------------------------------------------- INI
// variables ----------------------------------------------------------------------------------- FIN

// implementacion ------------------------------------------------------------------------------ INI

//echo "<pre>"; var_dump( $_GET ); echo "</pre>";

ctrlQuerStri();                                                                                     // control de los parametros pasados

//echo "<pre>"; var_dump( $_GET ); echo "</pre>";

$aView = ctrlVistArch ( $_GET );                                                                    // control de existencia de archivo de vista
//echo "<pre>"; var_dump( $aView ); echo "</pre>";
//exit();
$oYApp->init();

if( FMWK_CLIE_LAND )
  include ( "modules/landing/index.php" );                                                             // se muestra la vista si existe.
  //include ( "view/landing/index.php" );                                                             // se muestra la vista si existe.
else
  include ( $aView['sArch'] );                                                                      // se muestra la vista si existe.

// implementacion ------------------------------------------------------------------------------ FIN

// funciones ----------------------------------------------------------------------------------- INI

function ctrlArchExis ( $aPara ) {
  //echo "<pre>"; var_dump( "ctrlArchExis" ); echo "</pre>";

  $bExis = false;
  $sArch = "";
  $sRuta = $aPara['sRuta'];
  $aNomb = array( "index", $aPara['sRuta'] );
  $aExte = array( ".php", ".html.php", ".html" );                                                   // array con las posibles extensiones que se manejan
  $aFold = array( 
    "project", 
    STRUCTURE_DEFAULT_PATH,
  );                                                                                                // array con las carpetas base donde buscar la vista
  // controlar todas las posibilidades de existencia para el archivo de la vista.
  foreach ( $aNomb as $iNomb => $sNomb )
  {
    foreach ( $aExte as $iExte => $sExte ) 
    {
      if ( $sNomb == "index" )
        $sArch = "view/".$sRuta."/$sNomb".$sExte;
      else
        $sArch = "view/".$sRuta.$sExte;
      
      // controlar que no se busque sobre la carpeta view solamente
      $sAuxi = str_replace( $sRuta.$sExte, "", $sArch );
      if ( $sAuxi == "view/" && strpos( $sRuta, "/" ) === false )
      {
        break 2;                                                                                    // termina el bucle principal $aNomb
        //var_dump( $sRuta );
        //var_dump( $sExte );
        //var_dump( $sArch );
        //var_dump( $sAuxi );        
      }

      //var_dump( $sArch );
      //var_dump( $sAuxi );

      $sAuxi = $sArch;
      foreach ( $aFold as $iFold => $sFold ) 
      {
        $sArch = $sFold."/".$sAuxi;
        //var_dump( $sArch );

        if ( file_exists( $sArch ) )
        {
          $bExis = true;
          break 3;                                                                                    // termina el bucle principal $aNomb
        }
      }
    }
  }
  // devolver los datos
  return array(
    "bExis" => $bExis,
    "sRuta" => $sRuta,
    "sArch" => $sArch,
  );
}

function ctrlVistArch ( $aPara ) {
  //echo "<pre>"; var_dump( "ctrlVistArch" ); echo "</pre>";

  $sArch = "";
  $bExis = false;                                                                                   // bandera que determina si el archivo tiene o no extension
  $aUrlv = array();                                                                                 // guarda string incluido en la url que no corresponde a una vista
  $aCtrlArchExis = array(
    "bExis" => $bExis,
    "sRuta" => "",
    "sArch" => "",
  );

  $a_view = array(
    "s_view_name"   => "",
    "s_view_file"   => "",
    "s_view_folder" => "",
  );

  $aUrl_ = $_GET['a_url_value']['a_left'];                                                          // array auxiliar para verificar si existe la vista
  //$aUrl_ = $_GET['aUrl_'];

  // buscar si existe archivos de vista para la url ingresada
  // si no hay datos en aUrl_ no se controlan si existen los archivos por lo tanto no se busca en
  // las carpetas bases default o project
  foreach ( $_GET['a_url_value']['a_left'] as $iPosi => $sPart ) 
  {
    $sRuta = implode( "/", $aUrl_ );                                                                // construccion de la ruta segun los valores
    $aCtrlArchExis = ctrlArchExis ( array( 
      "sPart" => $sPart,
      "sRuta" => $sRuta, 
    ) );
    if ( $aCtrlArchExis['bExis'] )
      break;
    else
      $aUrlv[] = array_pop( $aUrl_ );                                                               // quita las ultimas entradas de aUrl_ cada vez que pasa                                           
  }

  // controlar si no se ha encontrado vista
  //echo "<pre>"; var_dump( $aCtrlArchExis ); echo "</pre>";
  if ( ! $aCtrlArchExis['bExis'] )
  {
    //if ( $aCtrlArchExis['sRuta'] == "" )
    //  $aCtrlArchExis['sRuta'] = "index";
    
    // controlar si la vista esta en la carpeta home
    $aFold = array( 
      "project", 
      STRUCTURE_DEFAULT_PATH, //"default",
    );
    $sArch = "view/home/".$aCtrlArchExis['sRuta'].".php";
    
    $sAuxi = $sArch;
    foreach ( $aFold as $iFold => $sFold ) 
    {
      $sArch = $sFold."/".$sAuxi;
      $sArch = str_replace( '//', "/", $sArch );
      //echo "<pre>"; var_dump( $sArch ); echo "</pre>";

      if ( file_exists( $sArch ) )
      {
        //$aCtrlArchExis['sRuta'] = "home";
        $aCtrlArchExis['sRuta'] = "home/".$sRuta;
        $aCtrlArchExis['sArch'] = $sArch;
        $aCtrlArchExis['bExis'] = true;
      }
      if ( $aCtrlArchExis['bExis'] )
        break;
    }

    //echo "<pre>"; var_dump( $aCtrlArchExis ); echo "</pre>";
    if ( ! $aCtrlArchExis['bExis'] )
    {
      $sArch = "view/home/index.php";
      if ( file_exists( "project/".$sArch ) )
        $sArch = "project/".$sArch;
      else if ( file_exists( STRUCTURE_DEFAULT_PATH.$sArch ) )
        $sArch = STRUCTURE_DEFAULT_PATH.$sArch;

      //echo "<pre>"; var_dump( $sArch ); echo "</pre>";
      
      $aCtrlArchExis['sRuta'] = "home";
      $aCtrlArchExis['sArch'] = $sArch;
      $aCtrlArchExis['bExis'] = true;
    }      
  }

  // guardar las partes de la url que no se corresponden con algun archivo de vista. Son 
  // considerados valores que se pasan a traves de la url
  if ( ! empty( $aUrlv ) )
  {
    //$_GET['aUrlv'] = $aUrlv;
    $_GET['a_url_value']['a_right'] = $aUrlv;
  }

  $a_auxi = explode( "/", $aCtrlArchExis['sRuta'] );

  $a_view['s_view_name']   = $aCtrlArchExis['sRuta'];
  $a_view['s_view_file']   = $aCtrlArchExis['sArch'];
  $a_view['s_view_folder'] = $a_auxi[0];

  $_GET = array_merge( $_GET, $a_view );

  /*
  $_GET['sRuta'] = $aCtrlArchExis['sRuta'];
  $_GET['sArch'] = $aCtrlArchExis['sArch'];
  */

  return $aCtrlArchExis;
}

function ctrlQuerStri() {
  $aUrl_ = array();
  $aPara = array();
  
  $a_request_uri = array(
    "s_root"      => "",
    "s_complete"  => $_SERVER['REQUEST_URI'],
    "a_parameter" => array(), 
    "a_url_value" => array(
      "a_left"  => array(),
      "a_right" => array(),
    ),
  );

  $sQuer = $a_request_uri['s_complete'];                                                            // se obtiene ruta relativa que figura en el navegador
  
  // obtener valores en la url y parametros
  if ( FMWK_CLIE_ROOT != "/")
    $sQuer = str_replace( FMWK_CLIE_ROOT, "", $sQuer );                                               // remueve lo que corresponde a la ruta base de la app cliente

  // separar partes de la query string
  $aQuer = explode( "?", $sQuer );
  if ( isset( $aQuer[0] ) )
    $aUrl_ = explode( "/", $aQuer[0] );
  if ( isset( $aQuer[1] ) )
    $aPara = explode( "&", $aQuer[1] );

  $aAuxi = array();
  foreach ( $aUrl_ as $iPosi => $sValo ) {
    if( $sValo != "" )
      $aAuxi[] = $sValo;
  }
  $aUrl_ = $aAuxi;

  $aAuxi = array();
  foreach ( $aPara as $iPosi => $sPar_ ) {
    $aPar_ = explode( "=", $sPar_ );
    $aAuxi[ $aPar_[0] ] =  urldecode( $aPar_[1] );
  }
  $aPara = $aAuxi;

  // guardar valores
  $a_request_uri['a_parameter']           = $aPara;
  $a_request_uri['a_url_value']['a_left'] = $aUrl_;
  
  $_GET = array_merge( $_GET, $a_request_uri );
  
  /*
  $_GET['sUrl_'] = $_SERVER['REQUEST_URI'];
  $_GET['aUrl_'] = $aUrl_;
  $_GET['aPara'] = $aPara;
  */
}

// funciones ----------------------------------------------------------------------------------- FIN