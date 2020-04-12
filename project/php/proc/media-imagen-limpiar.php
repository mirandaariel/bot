<?php

// 2017.03.05 - Proceso que crea las instancias de distribucion de publicidad (pr_distribucion)

include_once( "../../yApp.php" );

// declaracion

$o_base = new base();

// consulta sql
// $s_sql  = "...";
// $a_base = $o_base->procSent( $s_sql );

// eliminar a traves del modelo de datos las imagenes de usuarios que no tienen geo posicionamiento
$o_media_imagen = new media_imagen();
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.flag_geo = 0";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.clase_foranea = 'usuario'";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.mimgfatt IS NULL";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.mimgfrat IS NULL";
$a_media_imagen = $o_media_imagen->find();

foreach ( $a_media_imagen as $i_instancia => $a_instancia ) 
    $o_media_imagen->delete( $a_instancia );

// eliminar a traves del modelo de datos las imagenes de usuarios que no batch id
$o_media_imagen = new media_imagen();
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.clase_foranea = 'usuario'";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.mimgfatt IS NULL";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.mimgfrat IS NULL";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.batch_id IS NULL";
$a_media_imagen = $o_media_imagen->find();

foreach ( $a_media_imagen as $i_instancia => $a_instancia ) 
    $o_media_imagen->delete( $a_instancia );

// eliminar a traves del modelo de datos las imagenes cargadas de UN USUARIO EN PARTICULAR
$o_media_imagen = new media_imagen();
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.clase_foranea = 'usuario'";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.clave_foranea = '11'";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.mimgfatt IS NULL";
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.mimgfrat IS NULL";
$a_media_imagen = $o_media_imagen->find();

foreach ( $a_media_imagen as $i_instancia => $a_instancia ) 
    $o_media_imagen->delete( $a_instancia );

// eliminar a traves del modelo de datos las imagenes que no tienen clase foranea asociada
$o_media_imagen = new media_imagen();
$o_media_imagen ->aBase['aFilt'][] = "media_imagen.clase_foranea = '' OR media_imagen.clave_foranea = 0 OR media_imagen.clase_foranea IS NULL ";
$a_media_imagen = $o_media_imagen->find();

foreach ( $a_media_imagen as $i_instancia => $a_instancia ) 
    $o_media_imagen->delete( $a_instancia );