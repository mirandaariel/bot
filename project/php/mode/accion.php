<?php 

class accion extends _accionBase {
    public $oYApp = null;

    public function accion () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "accion",
            "title-default" => "Entidad accion",
            "plural"        => "accion",
            "singular"      => "accion",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        $this->a_property['id']                  ['s_label'] = "ID";
        $this->a_property['nombre']              ['s_label'] = "Nombre";
        $this->a_property['descripcion']         ['s_label'] = "Descripcion";
        $this->a_property['logica_archivo']      ['s_label'] = "Lógica Archivo";
        $this->a_property['logica_clase']        ['s_label'] = "Lógica Clase";
        $this->a_property['logica_metodo']       ['s_label'] = "Lógica Método";
        $this->a_property['flag_ejecucion_unica']['s_label'] = "Ejecución única";
        
        $this->a_property['descripcion']['s_type'] = "textarea";
        
        //$this->a_property['id']['a_grid']['b_hidden'] = true;
        
        $this->a_property['id']['a_form']['b_hidden'] = true;

        $this->aBase['a_dependencies'] = array();
    }

    public function obteRela ( $aValo = null ) {
        $aInst = $aValo;
        
        //foreach( $aInst as $iInstPosi => $aInstValo )
        //    $aInst[ $iInstPosi ] = $aInstValo;
        
        return $aInst;
    }

    public function output_format ( $a_parameters = null ) {
        
        $a_parameters = parent::output_format( $a_parameters );
        
        $aInst = $a_parameters;
        
        //foreach( $aInst as $iInstPosi => $aInstValo )
        //    $aInst[ $iInstPosi ] = $aInstValo;
        
        return $aInst;
    }

    static public function exec_actions ( $a_parameters = null ) {
        $a_mensaje  = $a_parameters['mensaje'];
        $a_acciones = $a_parameters['acciones'];

        if ( ! isset( $_SESSION['actions'] ) )
            $_SESSION['actions'] = array(
                "ejecucion_unica" => array(),
            ); 

        // crear la relacion entre el mensaje y la accion
        if ( ! empty( $a_acciones ) ) {
            foreach ( $a_acciones as $i_accion => $a_accion ) 
            {
                //var_dump( $a_accion );
                //var_dump( $_SESSION );

                $i_accion_id = $a_accion['id'];
                $s_accion_resultado = "";
                $a_logic_result = array();

                $b_flag_ejecucion_unica = $a_accion['flag_ejecucion_unica'] == 1 ? true : false;

                // si es ejecucion unica se debe controlar ejecucion previa
                if ( $b_flag_ejecucion_unica )
                    if ( in_array( $i_accion_id, $_SESSION['actions']['ejecucion_unica'] ) )
                        continue;
                
                if ( isset( $a_accion['logica_archivo'] ) )
                {
                    $s_logica_archivo = FMWK_CLIE_PATH . "project/" . $a_accion['logica_archivo'];
                    $s_logica_clase   = $a_accion['logica_clase'];
                    $s_logica_metodo  = $a_accion['logica_metodo'];

                    include( $s_logica_archivo );
                    
                    $a_logic_result = $s_logica_clase::$s_logica_metodo( array( 
                        "mensaje" => array( $a_mensaje['aDato'] ),
                    ));

                    // si es ejecucion unica se debe guardar en menoria para no repetir
                    if ( $b_flag_ejecucion_unica )
                        $_SESSION['actions']['ejecucion_unica'][] = $i_accion_id;

                }

                $o_mensaje_respuesta = new mensaje_accion();
                $o_mensaje_respuesta ->create( array(
                    "mensaje_id" => $a_mensaje['iIden'],
                    "accion_id"  => $i_accion_id,
                    "resultado"  => json_encode( $a_logic_result ),
                ));
            }
        }
    }
}