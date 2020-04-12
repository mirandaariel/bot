<?php 

class keyword extends _keywordBase {
    public $oYApp = null;

    public function keyword () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "keyword",
            "title-default" => "Entidad keyword",
            "plural"        => "keyword",
            "singular"      => "keyword",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        $this->a_property['id']         ['s_label'] = "ID";
        $this->a_property['valor']      ['s_label'] = "Nombre";
        $this->a_property['descripcion']['s_label'] = "Descripción";
        
        $this->a_property['descripcion']['s_type'] = "textarea";

        //$this->a_property['id']['a_grid']['b_hidden'] = true;
        
        $this->a_property['id']['a_form']['b_hidden'] = true;
        
        $this->aBase['a_dependencies'] = array();
    }

    public function obteRela ( $aValo = null ) {
        $aInst = $aValo;
        
        foreach( $aInst as $iInstPosi => $aInstValo )
        {
            $oInst = new keyword_respuesta();
            $oInst->aBase['aFilt'][] = "keyword_respuesta.keyword_id = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['keyword_respuesta'] = $oInst->find();

            $aInstValo['respuesta'] = array();
            foreach ( $aInstValo['keyword_respuesta'] as $i_instancia => $a_instancia ) 
            {
                $oInst = new respuesta();
                $a_instancia_read = $oInst->read( array( "id" => $a_instancia['respuesta_id'] ));
                $aInstValo['respuesta'][] = $a_instancia_read[0];
            }

            unset( $aInstValo['keyword_respuesta'] );

            $oInst = new keyword_accion();
            $oInst->aBase['aFilt'][] = "keyword_accion.keyword_id = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['keyword_accion'] = $oInst->find();

            $aInstValo['accion'] = array();
            foreach ( $aInstValo['keyword_accion'] as $i_instancia => $a_instancia ) 
            {
                $oInst = new accion();
                $a_instancia_read = $oInst->read( array( "id" => $a_instancia['accion_id'] ));
                $aInstValo['accion'][] = $a_instancia_read[0];
            }

            unset( $aInstValo['keyword_accion'] );
            
            $aInst[ $iInstPosi ] = $aInstValo;
        }
        return $aInst;
    }

    public function output_format ( $a_parameters = null ) {
        
        $a_parameters = parent::output_format( $a_parameters );
        
        $aInst = $a_parameters;
        
        //foreach( $aInst as $iInstPosi => $aInstValo )
        //    $aInst[ $iInstPosi ] = $aInstValo;
        
        return $aInst;
    }

    static public function get_keyword_match ( $a_parameters = null ) {
        //var_dump( "keyword.get_keyword_match()" );
        //var_dump( $a_parameters );

        $s_mensaje = trim( $a_parameters['mensaje'] );
        $a_mensaje = explode(" ", $s_mensaje);

        $i_search = array();
        $a_search = array();

        $o_base = new base();

        $a_query_search = array(
            "keyword"   => "SELECT id, valor FROM keyword WHERE [filtro] valor LIKE '%[valor]%' OR valor LIKE '[valor]%' OR valor LIKE '%[valor]' OR valor = '[valor]' ",
            "respuesta" => "SELECT DISTINCT r.id, r.valor
                FROM keyword_respuesta kr
                LEFT OUTER JOIN respuesta r ON r.id = kr.respuesta_id
                WHERE kr.keyword_id IN ( [keyword_ids] )",
            "accion"   => "SELECT DISTINCT a.id, a.nombre
                FROM keyword_accion ka
                LEFT OUTER JOIN accion a ON a.id = ka.accion_id
                WHERE ka.keyword_id IN ( [keyword_ids] )",
        );

        $a_keyword_id   = array();
        $a_respuesta_id = array();
        $a_accion_id    = array();

        $a_respuesta = array();
        $a_accion    = array();

        // obtener keywords id
        foreach ($a_mensaje as $i_v => $s_v )
        {
            $s_filter = "";
            $s_query  = $a_query_search['keyword'];
            
            // control para evitar registros duplicados
            if ( ! empty( $a_keyword_id ) )
            {
                $s_keywords_id = implode( ", ", $a_keyword_id );
                $s_filter = " id NOT IN ( $s_keywords_id ) AND ( ";
            }

            // reemplazar valores
            $s_query = str_replace( "[valor]", $s_v, $s_query );
            $s_query = str_replace( "[filtro]", $s_filter, $s_query );
            if ( $s_filter != "" ) $s_query .= ")";
            
            // obtener datos
            $a_base = $o_base->procSent( $s_query );
            
            if ( ! empty( $a_base['aDato'] ) )
            {
                // guardar id de registros para evitar duplicados
                foreach ( $a_base['aDato'] as $i_reg => $a_reg )
                {
                    // guardar lo que coincide con el mensaje
                    if ( strpos( $s_mensaje, $a_reg['valor'] ) !== false )
                    {
                        $a_search[] = $a_reg;
                        $i_search[] = $a_reg['id'];
                    }

                    // guardar los ids.
                    if ( ! in_array( $a_reg['id'], $a_keyword_id ) )
                        $a_keyword_id[] = $a_reg['id']; 
                } 
            }
        } 

        $b_keyword_id = ! empty( $i_search );
        $s_keyword_id = $b_keyword_id ? implode(", ", $i_search ) : "";

        if ( $b_keyword_id )
        {
            // obtener respuestas
            $s_query = $a_query_search['respuesta'];
            $s_query = str_replace( "[keyword_ids]", $s_keyword_id, $s_query );
            $a_base  = $o_base->procSent( $s_query );
            
            if ( ! empty( $a_base['aDato'] ) )
                foreach ( $a_base['aDato'] as $i_reg => $a_reg )
                    if ( ! in_array( $a_reg['id'], $a_respuesta_id ) )
                        $a_respuesta_id[] = $a_reg['id'];

            $b_respuesta_id = ! empty( $a_respuesta_id );
            $s_respuesta_id = $b_respuesta_id ? implode( ", ", $a_respuesta_id ) : "";

            if ( $b_respuesta_id )
            {
                $o_respuesta = new respuesta();
                $o_respuesta ->aBase['aFilt'][] = "respuesta.id IN ( $s_respuesta_id )";
                $a_respuesta = $o_respuesta->find();
            }
            
            // obtener acciones
            $s_query = $a_query_search['accion'];
            $s_query = str_replace( "[keyword_ids]", $s_keyword_id, $s_query );
            $a_base  = $o_base->procSent( $s_query );

            if ( ! empty( $a_base['aDato'] ) )
                foreach ( $a_base['aDato'] as $i_reg => $a_reg )
                    if ( ! in_array( $a_reg['id'], $a_accion_id ) )
                        $a_accion_id[] = $a_reg['id'];

            $b_accion_id = ! empty( $a_accion_id );
            $s_accion_id = $b_accion_id ? implode( ", ", $a_accion_id ) : "";

            if ( $b_accion_id )
            {
                $o_accion = new accion();
                $o_accion ->aBase['aFilt'][] = "accion.id IN ( $s_accion_id )";
                $a_accion = $o_accion->find();
            }
        
        }

        //var_dump( $a_keyword_id );
        //var_dump( $s_accion_id );
        //var_dump( $a_search );
        //var_dump( $i_search );

        //var_dump( $a_respuesta_id );
        //var_dump( $a_accion_id );
        
        return array(
            "respuesta" => $a_respuesta,
            "accion"    => $a_accion,
        );
    }
}