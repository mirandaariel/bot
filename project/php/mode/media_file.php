<?php 

class media_file extends _media_fileBase {
    public $oYApp = null;

    public function media_file () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "media_file",
            "title-default" => "Entidad media_file",
            "plural"        => "media_file",
            "singular"      => "media_file",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        $this->a_property['id']                ['s_label'] = "ID";
        $this->a_property['nombre']            ['s_label'] = "Nombre";
        $this->a_property['descripcion']       ['s_label'] = "Descripción";
        $this->a_property['flag_habilitado']   ['s_label'] = "Habilitado";
        $this->a_property['fecha_creacion']    ['s_label'] = "F. Creación";
        $this->a_property['fecha_modificacion']['s_label'] = "F. Modificación";
        $this->a_property['usuario_id']        ['s_label'] = "Nombre";

        $this->a_property['id']    ['a_grid']['b_frozen'] = true;
        $this->a_property['nombre']['a_grid']['b_frozen'] = true;

        $this->a_property['id']                ['a_grid']['b_hidden'] = true;
        $this->a_property['descripcion']       ['a_grid']['b_hidden'] = true;
        $this->a_property['fecha_creacion']    ['a_grid']['b_hidden'] = true;
        $this->a_property['fecha_modificacion']['a_grid']['b_hidden'] = true;

        $this->a_property['fecha_creacion']    ['a_form']['b_hidden'] = true;
        $this->a_property['fecha_modificacion']['a_form']['b_hidden'] = true;
        
        $this->a_property['nombre']            ['a_grid']['i_width'] = 200;
        $this->a_property['fecha_creacion']    ['a_grid']['i_width'] = 150;
        $this->a_property['fecha_modificacion']['a_grid']['i_width'] = 150;
        
        $this->a_property['usuario_id']['a_relation']['s_entity']    = "usuario";
        $this->a_property['usuario_id']['a_relation']['s_property']  = "id";
        $this->a_property['usuario_id']['a_relation']['a_replace'][] = "nombre";
        $this->a_property['usuario_id']['a_relation']['a_replace'][] = "apellido";
        $this->a_property['usuario_id']['a_relation']['a_replace'][] = "email";

        $this->a_property['imagen_portada']  ['s_type']  = "file-image";
        $this->a_property['imagen_portada']  ['a_ratio'] = array(
            "16:9" => true,
            "4:3"  => false,
            "1:1"  => false,
            "2:3"  => false,
        );

        $this->aBase['a_dependencies'] = array();
    }

    public function obteRela ( $aValo = null ) {
        $aInst = $aValo;
        
        foreach( $aInst as $iInstPosi => $aInstValo )
        {
            // obtener las imagenes
            $oInst = new media_imagen();
            $oInst->aBase['aFilt'][] = "media_imagen.clase_foranea = 'media_file'";
            $oInst->aBase['aFilt'][] = "media_imagen.clave_foranea = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['media_imagen'] = $oInst->find();

            $aInst[ $iInstPosi ] = $aInstValo;
        }
        return $aInst;
    }

    public function output_format ( $a_parameters = null ) {
        
        $a_parameters = parent::output_format( $a_parameters );
        
        $aInst = $a_parameters;
        
        foreach( $aInst as $iInstPosi => $aInstValo )
        {   
            // setear valores que utiliza el bloque card
            // $aInstValo['link']   = FMWK_CLIE_SERV . "services/" . $aInstValo['url_friendly'];    

            /*/ setear valores que utiliza el bloque list
            $aInstValo['a_list_view'] = array(
                "s_entity_image" => $aInstValo['imagen_perfil_card'],
                "s_entity_title" => $this->aLabels['singular'],
            );
            //*/

            // setear los valores que utiliza la vista con estructura de articulo
            //$aInstValo['titulo']    = $aInstValo['nombre'];
            //$aInstValo['contenido'] = $aInstValo['descripcion'];
            
            $aInst[ $iInstPosi ] = $aInstValo;
        }
        
        return $aInst;
    }
}