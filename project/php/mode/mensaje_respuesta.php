<?php 

class mensaje_respuesta extends _mensaje_respuestaBase {
    public $oYApp = null;

    public function mensaje_respuesta () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "mensaje_respuesta",
            "title-default" => "Entidad mensaje_respuesta",
            "plural"        => "mensaje_respuesta",
            "singular"      => "mensaje_respuesta",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        $this->a_property['id']          ['s_label'] = "ID";
        $this->a_property['mensaje_id']  ['s_label'] = "Mensaje ID";
        $this->a_property['respuesta_id']['s_label'] = "respuesta ID";
        
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
}