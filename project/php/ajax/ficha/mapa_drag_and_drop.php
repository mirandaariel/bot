<?php

include_once( FMWK_CLIE_DIRE . "project/yApp.php" );

// obtener la configuracion de la fuente para la consulta a la base de datos que popula la grilla
$a_source = $oYApp->a_view['a_config']['view-data']['a_entity_custom']['a_source'];

// separar el filtro (where) de la consulta sql - INI
    $s_sql = $a_source['s_sql_query'];
    $i_pos = strpos( $s_sql, "WHERE" );

    if ( $i_pos !== false )
    {
        $s_qr1 = substr( $s_sql, 0, $i_pos );
        $s_qr2 = str_replace( $s_qr1, "", $s_sql );
    }
    else
    {
        // 2018.01.29 - Si no tiene WHERE se guarda la misma para del select y JOIN si tiene.
        $s_qr1 = $s_sql;
        $s_qr2 = "";
    }
// separar el filtro (where) de la consulta sql - FIN

// 2018.01.31 - control que la clausula del where no corresponda a las coordenadas - INI
    // las cordenadas es lo ultimo que se agrega a la consulta. Si no se realiza este control se 
    // supone que las coordenadas son parte de la consulta. Por eso se borra el contenido de $s_qr2
    $s_qr2 = str_replace( "WHERE ", "", $s_qr2 );
    $s_mdad_query = $a_source['a_sql_where']['mapa_drag_and_drop']; // drag and drop query
    if ( $s_qr2 == $s_mdad_query )
        $s_qr2 = "";
// 2018.01.31 - control que la clausula del where no corresponda a las coordenadas - FIN

// preparar nueva estructura del array

    // solo se guarda la consulta sin WHERE
    $a_source['s_sql_select'] = $s_qr1;

    // si no fue creado el array con los filtros, se crea en este momento.
    if ( ! isset( $a_source['a_sql_where'] ) )
        $a_source['a_sql_where'] = array();

    // la primera vez se guardan los valores de la url como puede ser el link de la especie
    // se hace una sola vez porque si no se acumulan los filtros del area, porque la consulta se
    // va guardando con los nuevos filtros.
    if ( ! isset( $a_source['a_sql_where']['url_value'] ) )
    {
        if ( $s_qr2 != "" )
        {
            $s_qr2 = trim( str_replace( "WHERE", "",  $s_qr2 ) );
            $a_source['a_sql_where']['url_value'] = "( $s_qr2 )";
        }
    }

    // 2018.01.16 - asignar valores del area que visualiza el mapa (bounds)
    // esta chequeado que primero viene el sur y norte.
    // https://developers.google.com/maps/documentation/javascript/reference?hl=es#LatLngBounds
    // Google: ( southwest: ( 0 (lat), 1 (lng) ), northest ( 0 (lat), 1 (lng) ) )
    
    $a_south_west = $_POST['south_west'];
    $a_north_east = $_POST['north_east'];

    $a_source['a_sql_where']['mapa_drag_and_drop'] = "( 
        latitud > " . $a_south_west[0] . " AND latitud < " . $a_north_east[0] . " 
        AND longitud > " . $a_south_west[1] . " AND longitud < " . $a_north_east[1] . ")";

    // construir la nueva consulta - INI
        $s_sql = "";
        $i_w = 0;
        
        foreach ( $a_source['a_sql_where'] as $k_w => $s_w ) 
        {
            // el filtro de area debe estar por afuera del resto
            if ( $k_w == "mapa_drag_and_drop" )
                continue;

            $s_sql .= $i_w == 0 ? " " : " OR ";
            $s_sql .= $s_w;
            $i_w++;
        }

        if ( $s_sql != "" )
            $s_sql = " WHERE ( $s_sql ) ";

        if ( isset( $a_source['a_sql_where']['mapa_drag_and_drop'] ) )
        {
            $s_sql .= $s_sql != "" ? " AND " : " WHERE ";
            $s_sql .= $a_source['a_sql_where']['mapa_drag_and_drop'];
        }

        $s_sql = $a_source['s_sql_select'] . " $s_sql";
        $a_source['s_sql_query']  = $s_sql;
        //echo $s_sql;
    // construir la nueva consulta - FIN
// preparar nueva estructura del array

// volver a asignar la consulta para que lo tome la grilla
$oYApp->a_view['a_config']['view-data']['a_entity_custom']['a_source'] = $a_source;
$oYApp->save();
$oYApp->save_in_file();