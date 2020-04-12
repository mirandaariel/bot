<?php

/*
function mi_autocargador($clase) {
    include 'clases/' . $clase . '.clase.php';
}

spl_autoload_register( 'mi_autocargador' );
*/
// O, utilizar una función anónima, a partir de PHP 5.3.0
spl_autoload_register( function ( $sClas ) {
  
  include_once( dirname(__FILE__)."/../../../project/php/conf/base.php" );                          // configuracion de la app
  
  global $aFmwkFunc;                                                                                // array en php/conf/base.php
  global $aFmwkMode;                                                                                // array en php/conf/base.php
  global $aFmwkLine;                                                                                // array en php/conf/base.php
  
  $sClasOrig = "";
  $sClasRuta = "";                                                                                  // string con la ruta del archivo de la clase
  $sClasExte = $sClas.".php";                                                                       // string con nombre del archivo de la clase mas extension

  // obtener la ruta segun el origen de la clase
  if ( in_array( $sClasExte, $aFmwkFunc ) )
    $sClasOrig = dirname(__FILE__)."/../func/".$sClasExte;
  else if ( in_array( $sClas, $aFmwkMode ) )
    $sClasOrig = dirname(__FILE__)."/../mode/".$sClasExte;
  else if ( $sClasExte == "fmwk.php" )
    $sClasOrig = FMWK_YOBI_SERV."fmwk.php?".FMWK_YOBI_CLAV;
  else if ( in_array( $sClas, $aFmwkLine['aCore'] ) )
    $sClasOrig = FMWK_YOBI_SERV."php/core/".$sClasExte."?".FMWK_YOBI_CLAV;
  else if ( in_array( $sClas, $aFmwkLine['aFunc'] ) )
    $sClasOrig = FMWK_YOBI_SERV."php/func/".$sClasExte."?".FMWK_YOBI_CLAV;
  
  $sClasOrig = trim($sClasOrig);
  include_once( trim($sClasOrig) );                                                                       // realizar la carga del codigo de la clase
});

// hay que revisar como levantar los archivos de las clases del modelo para que
// este archivo pueda utilizarse desde la web y en el proyecto solo este 
// php/core/incl.php

// -----------------------------------------------------------------------------
// recorre el array de las clases del modelo definidas
// -----------------------------------------------------------------------------
/*
foreach( $aFmwkFunc as $sIden => $sValo )
{
  include_once( dirname(__FILE__)."/../func/".$sValo );                         // dirname define que la busqueda se inicie desde la posicion de este script
}

$sFmwkObje = "//[TAGI] \n";                                                     // variable que guardara el string para el contenido del switch
foreach( $aFmwkMode as $sIden => $sValo )
{
  include_once( dirname(__FILE__)."/../mode/".$sValo.".php" );                  // dirname define que la busqueda se inicie desde la posicion de este script
  $sFmwkObje .= 'case "'.$sValo.'": $oFmwkObje = new '.$sValo.'(); break;'."\n";// linea que ira en el switch del archivo obje.php
}
*/
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// creacion del contenido del switch de php/conf/obje.php
// -----------------------------------------------------------------------------
$sFmwkObje = "//[TAGI] \n";                                                     // variable que guardara el string para el contenido del switch
foreach( $aFmwkMode as $sIden => $sValo )
  $sFmwkObje .= 'case "'.$sValo.'": $oFmwkObje = new '.$sValo.'(); break;'."\n";// linea que ira en el switch del archivo obje.php

$sArch = dirname(__FILE__)."/obje.php";                                         // variable con la ruta del archivo a modificar
$oArch = fopen( $sArch, "r" );                                                  // se abre el archivo en modo lectura
$sCont = stream_get_contents( $oArch );                                         // se guarda el contenido del archivo
fclose( $oArch );                                                               // se cierra el archivo en modo lectura
$iTagc = strpos( $sCont, "//[TAGC" );                                           // se obtiene la posicion del tag que define la cantidad de case del switch
$sTagc = substr( $sCont, $iTagc );                                              // se obtiene el contenido desde la posicion anterior hasta el final del archivo
$sCtrl = "//[TAGC:".count( $aFmwkMode )."]";                                    // se crea el string de control en relacion a la cantidad de clases del modelo definidas
if ( $sTagc != $sCtrl )                                                         // si la cantidad de case en el switch es diferente de la cantidad de clases definidas
{
  $iTagi = strpos( $sCont, "//[TAGI]" );                                        // se obtiene la posicion del tag de referencia del inicio del contenido del switch
  $iTagf = strpos( $sCont, "//[TAGF]" );                                        // se obtiene la posicion del tag de referencia del final del contenido del switch
  $sCont = substr_replace( $sCont, $sFmwkObje, $iTagi, $iTagf - $iTagi );       // se reemplaza el contenido entre las posiciones anteriores por el valor nuevo de case
  $sCont = str_replace( $sTagc, $sCtrl, $sCont );                               // se reemplaza el tag que informa la cantidad de case del switch
  $oArch = fopen( $sArch, "w" );                                                // se abre el archivo en modo escritura
  fwrite( $oArch, $sCont );                                                     // se escribe el nuevo contenido
  fclose( $oArch );                                                             // se cierra el archivo
}
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------