<?php

//var_dump( dirname(__FILE__)."/stck.php" );

// 20160204. $_POST['sClie'] debe tener la direccion absoluta del file system del servidor, el valor
//           de "FMWK_CLIE_DIRE".
//           El valor de $_POST['sClie'] se setea en el archivo HTML de la vista al asignar el valor
//           de "FMWK_CLIE_DIRE" a jStck.data.sClie ;

include_once( $_POST['sClie']."project/yApp.php" );