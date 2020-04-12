<?php 

class respuesta extends _respuestaBase {
    public $oYApp = null;

    public function respuesta () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "respuesta",
            "title-default" => "Entidad respuesta",
            "plural"        => "respuesta",
            "singular"      => "respuesta",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        $this->a_property['id']   ['s_label'] = "ID";
        $this->a_property['valor']['s_label'] = "Valor";
        
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