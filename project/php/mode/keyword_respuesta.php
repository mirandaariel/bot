<?php 

class keyword_respuesta extends _keyword_respuestaBase {
    public $oYApp = null;

    public function keyword_respuesta () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "keyword_respuesta",
            "title-default" => "Entidad keyword_respuesta",
            "plural"        => "keyword_respuesta",
            "singular"      => "keyword_respuesta",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        $this->a_property['id']          ['s_label'] = "ID";
        $this->a_property['keyword_id']  ['s_label'] = "keyword ID";
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