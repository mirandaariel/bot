<?php

include_once( "../../yApp.php" );

$o_entidad = new geo_area();
$a_entidad = $o_entidad->read();

foreach( $a_entidad as $i_entidad_instancia => $a_entidad_instancia ) {
    //$s_nick_aleatorio = $oYApp->oFrameworkConnection->oFramework->codiGene( array("iLong"=>64) );
    $s_link = Convertir::url( $a_entidad_instancia['nombre'] );

    $a_entidad_instancia['url_friendly'] = $s_link;
    $a_update = $o_entidad->update( $a_entidad_instancia );

    //var_dump( $a_update );
    var_dump( $s_link );
    //var_dump( $a_entidad_instancia );
}