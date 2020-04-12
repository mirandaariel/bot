<?php
//var_dump( dirname(__FILE__)."/base.php" );

// 20160203 - "default/php/conf/ambi.php" queda sin efecto ya que esta informacion se encuentra en
//            la carpeta de la app, en el archivo "structure-settings.php"
// include_once( dirname(__FILE__)."/../../../default/php/conf/ambi.php" );                                         // configuracion de la app

// 20160204 - las constantes definidas aqui se ubicaron en el archivo "project/project-settings"

// array de clases
$aFmwkMode = array(
  "accion", "conversacion", "keyword", "keyword_accion", "keyword_respuesta", "media_file", "mensaje", "mensaje_accion", 
  "mensaje_respuesta", "respuesta",
);

// array de funciones definidas en el proyecto
$aFmwkFunc = array(
  "currency.php",
  "request.php",
  "mail.php",
  "mercpago.php",
  "tiendaNube.php",
  "iCurl.php",
);

// 20150512. DEBUG. array con las clases que se encuentran en linea. Prueba para evaluar la 
// performance de utilizar la app en localhost contra el framework en linea.
$aFmwkLine = array(
  "aCore" => array( "fmwk", "base", "clas", "form", "stck", "conf", "incl", ),
  "aFunc" => array( "fmwkfunc", "fmwkimag", "pasw", ),
);