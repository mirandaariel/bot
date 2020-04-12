<?php 

class mensaje extends _mensajeBase {
    public $oYApp = null;

    public function mensaje () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "mensaje",
            "title-default" => "Entidad mensaje",
            "plural"        => "mensaje",
            "singular"      => "mensaje",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        $this->a_property['id']             ['s_label'] = "ID";
        $this->a_property['valor']          ['s_label'] = "Valor";
        $this->a_property['fecha_creacion'] ['s_label'] = "F. Creación";
        $this->a_property['conversacion_id']['s_label'] = "Conversación ID";
        $this->a_property['usuario_id']     ['s_label'] = "Usuario ID";
        
        $this->a_property['valor']['s_type']  = "textarea";

        //$this->a_property['id']['a_grid']['b_hidden'] = true;
        
        $this->a_property['id']             ['a_form']['b_hidden'] = true;
        $this->a_property['fecha_creacion'] ['a_form']['b_hidden'] = true;
        $this->a_property['conversacion_id']['a_form']['b_hidden'] = true;
        $this->a_property['usuario_id']     ['a_form']['b_hidden'] = true;
        
        $this->aBase['a_dependencies'] = array();
    }

    public function create( $a_parameters = null ) {
        
        // conversacion instancia - id provisorio 
        $a_parameters['conversacion_id'] = date( "YmdHis" );

        $a_parameters = parent::create( $a_parameters );

        // controlar la existencia de una keyword
        $s_valor = trim( $a_parameters['aDato']['valor'] );
        $a_valor = explode(" ", $s_valor);

        $i_mensaje_id = $a_parameters['iIden'];
        
        $a_keyword_result_match = keyword::get_keyword_match( array(
            "mensaje" => $s_valor,
        ));
        //var_dump( $a_keyword_result_match );

        // crear la relacion entre el mensaje y la respuesta
        if ( ! empty( $a_keyword_result_match['respuesta'] ) )
        {
            $i_respuesta_id = $a_keyword_result_match['respuesta'][0]['id'];
            $o_mensaje_respuesta = new mensaje_respuesta();
            $o_mensaje_respuesta ->create( array(
                "mensaje_id"   => $i_mensaje_id,
                "respuesta_id" => $i_respuesta_id,
            ));
        }

        // crear la relacion entre el mensaje y la accion
        accion::exec_actions( array(
            "mensaje"  => $a_parameters,
            "acciones" => $a_keyword_result_match['accion'],
        ));

        /*
        foreach ($a_valor as $i_v => $s_v ) 
        {
            $o_keyword = new keyword();
            $o_keyword ->enable_relations();
            $o_keyword ->aBase['aFilt'][] = "keyword.valor = '$s_v'";
            $a_keyword = $o_keyword->find();
            var_dump( $a_keyword );
            exit();

            if ( ! empty( $a_keyword ) )
            {
                // crear la relacion entre el mensaje y la respuesta
                if ( ! empty( $a_keyword[0]['respuesta'] ) )
                {
                    $i_respuesta_id = $a_keyword[0]['respuesta'][0]['id'];
                    $o_mensaje_respuesta = new mensaje_respuesta();
                    $o_mensaje_respuesta ->create( array(
                        "mensaje_id"   => $i_mensaje_id,
                        "respuesta_id" => $i_respuesta_id,
                    ));
                }

                // crear la relacion entre el mensaje y la accion
                accion::exec_actions( array(
                    "mensaje"  => $a_parameters,
                    "acciones" => $a_keyword[0]['accion'],
                ));
            }
        }
        */

        return $a_parameters;
    }

    public function obteRela ( $aValo = null ) {
        $aInst = $aValo;
        
        foreach( $aInst as $iInstPosi => $aInstValo )
        {
            // obtener las respuestas asociadas
            $oInst = new mensaje_respuesta();
            $oInst->aBase['aFilt'][] = "mensaje_respuesta.mensaje_id = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['mensaje_respuesta'] = $oInst->find();

            $aInstValo['respuesta'] = array();
            foreach ( $aInstValo['mensaje_respuesta'] as $i_instancia => $a_instancia ) 
            {
                $oInst = new respuesta();
                $a_instancia_read = $oInst->read( array( "id" => $a_instancia['respuesta_id'] ));
                $aInstValo['respuesta'][] = $a_instancia_read[0];
            }

            // obtener las acciones asociadas
            $oInst = new mensaje_accion();
            $oInst->aBase['aFilt'][] = "mensaje_accion.mensaje_id = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['mensaje_accion'] = $oInst->find();

            $aInstValo['accion'] = array();
            foreach ( $aInstValo['mensaje_accion'] as $i_instancia => $a_instancia ) 
            {
                $oInst = new accion();
                $a_instancia_read = $oInst->read( array( "id" => $a_instancia['accion_id'] ));

                $a_instancia_read[0]['resultado'] = $a_instancia['resultado'];

                $aInstValo['accion'][] = $a_instancia_read[0];
            }

            // no se desean las instancias de las relaciones muchos a muchos
            unset( $aInstValo['mensaje_respuesta'] );
            unset( $aInstValo['mensaje_accion'] );

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
}