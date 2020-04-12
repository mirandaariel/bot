<?php 

class keyword_accion extends _keyword_accionBase {
    public $oYApp = null;

    public function keyword_accion () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "keyword_accion",
            "title-default" => "Entidad keyword_accion",
            "plural"        => "keyword_accion",
            "singular"      => "keyword_accion",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        $this->a_property['id']        ['s_label'] = "ID";
        $this->a_property['keyword_id']['s_label'] = "Keyword ID";
        $this->a_property['accion_id'] ['s_label'] = "Acción ID";
        
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