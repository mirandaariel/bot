<?php

include_once( "../../yApp.php" );

$o_usuario = new usuario();
$a_usuario = $o_usuario->read();

foreach( $a_usuario as $i_usuario_instancia => $a_usuario_instancia ) {
    $s_nick_aleatorio = $oYApp->oFrameworkConnection->oFramework->codiGene( array("iLong"=>64) );

    $a_usuario_instancia['nick'] = $s_nick_aleatorio;
    $a_update = $o_usuario->update( $a_usuario_instancia );

    var_dump( $a_update );
    //var_dump( $s_nick_aleatorio );
    //var_dump( $a_usuario_instancia );
}