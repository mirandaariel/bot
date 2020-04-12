<?php 

class usuario extends _usuarioBase {
    public $oYApp = null;

    public function usuario () {
        global $oYApp;
        $this->aLabels = array(
            "title"         => "Usuario",
            "title-default" => "Entidad Usuario",
            "plural"        => "Usuarios",
            "singular"      => "Usuario",
            "list-icon-url" => STRUCTURE_VENDORS_HTTP . "images/icons/ic_person_black_48dp.png",
        );
        $this->oYApp = $oYApp;
        parent::__construct();

        // 2017.04.09 - filtrar los usuarios temporales
        $this->aBase['aFilt'][] = "usuario.email IS NOT NULL AND usuario.email <> '' AND usuario.flag_borrado = 0 ";
        
        $this->aBase['a_dependencies'] = array(
          "geo_ubicacion",
          "app_usuario",
        );

        $this->a_view[ 'a_list' ][ 'a_line' ] = array(
            array( "nombre","apellido"),
            array( "email" ),
            array( "nick" ),
        );

        $this->s_user_rol = "";
        
        $this->a_property['id_aleatorio']           ['s_label'] = "ID R.";
        $this->a_property['nick']                   ['s_label'] = "Nick";
        $this->a_property['email']                  ['s_label'] = "Correo Electrónico";
        $this->a_property['nombre']                 ['s_label'] = "Nombre";
        $this->a_property['apellido']               ['s_label'] = "Apellido";
        $this->a_property['nacionalidad']           ['s_label'] = "Nacionalidad";
        $this->a_property['password']               ['s_label'] = "Contraseña";
        $this->a_property['identificacion_nacional']['s_label'] = "D.N.I.";
        $this->a_property['fecha_nacimiento']       ['s_label'] = "Fecha de Nacimiento";
        $this->a_property['telefono_celular']       ['s_label'] = "Celular";
        $this->a_property['codigo_validacion']      ['s_label'] = "Código de Validación";
        $this->a_property['habilitado']             ['s_label'] = "Habilitado";
        $this->a_property['email_verificado']       ['s_label'] = "Email Verificado";
        $this->a_property['flag_newsletter']        ['s_label'] = "Suscripto Newsletter";
        $this->a_property['fecha_creacion']         ['s_label'] = "Fecha de Alta";
        $this->a_property['fecha_modificacion']     ['s_label'] = "Última Modificación";
        $this->a_property['ruta_upload']            ['s_label'] = "Carpeta de Archivos";
        $this->a_property['imagen_perfil']          ['s_label'] = "Imagen Perfil";
        $this->a_property['imagen_portada']         ['s_label'] = "Imagen Portada";
        $this->a_property['app_rol_id']             ['s_label'] = "Rol";
        $this->a_property['flag_borrado']           ['s_label'] = "Borrado Lógico";

        $this->a_property['email']                  ['b_unique'] = true;

        $this->a_property['password']               ['s_type']  = "password";
        $this->a_property['fecha_nacimiento']       ['s_type']  = "date";
        $this->a_property['imagen_perfil']          ['s_type']  = "file-image";
        $this->a_property['imagen_portada']         ['s_type']  = "file-image";
        
        $this->a_property['id']                ['a_form']['b_hidden'] = true;
        $this->a_property['id_aleatorio']      ['a_form']['b_hidden'] = true;
        $this->a_property['email_verificado']  ['a_form']['b_hidden'] = true;
        $this->a_property['fecha_creacion']    ['a_form']['b_hidden'] = true;
        $this->a_property['fecha_modificacion']['a_form']['b_hidden'] = true;
        $this->a_property['ruta_upload']       ['a_form']['b_hidden'] = true;
        $this->a_property['codigo_validacion'] ['a_form']['b_hidden'] = true;
        $this->a_property['persona_genero_id'] ['a_form']['b_hidden'] = true;
        $this->a_property['flag_borrado']      ['a_form']['b_hidden'] = true;
        
        //$this->a_property['id']               ['a_grid']['b_hidden'] = true;
        $this->a_property['id_aleatorio']     ['a_grid']['b_hidden'] = true;
        $this->a_property['nick']             ['a_grid']['b_hidden'] = true;
        $this->a_property['password']         ['a_grid']['b_hidden'] = true;
        $this->a_property['ruta_upload']      ['a_grid']['b_hidden'] = true;
        $this->a_property['persona_genero_id']['a_grid']['b_hidden'] = true;
        $this->a_property['imagen_perfil']    ['a_grid']['b_hidden'] = true;
        $this->a_property['imagen_portada']   ['a_grid']['b_hidden'] = true;
        $this->a_property['flag_borrado']     ['a_grid']['b_hidden'] = true;
        
        $this->a_property['nick']                   ['a_grid']['i_width']  = 200;
        $this->a_property['email']                  ['a_grid']['i_width']  = 250;
        $this->a_property['nombre']                 ['a_grid']['i_width']  = 150;
        $this->a_property['apellido']               ['a_grid']['i_width']  = 150;
        $this->a_property['identificacion_nacional']['a_grid']['i_width']  = 200;
        $this->a_property['fecha_nacimiento']       ['a_grid']['i_width']  = 200;
        $this->a_property['codigo_validacion']      ['a_grid']['i_width']  = 200;
        $this->a_property['email_verificado']       ['a_grid']['i_width']  = 150;
        $this->a_property['flag_newsletter']        ['a_grid']['i_width']  = 250;
        $this->a_property['fecha_creacion']         ['a_grid']['i_width']  = 150;
        $this->a_property['fecha_modificacion']     ['a_grid']['i_width']  = 150;

        $this->a_property['app_rol_id']['a_relation']['s_entity']    = "app_rol";
        $this->a_property['app_rol_id']['a_relation']['s_property']  = "id";
        $this->a_property['app_rol_id']['a_relation']['a_replace'][] = "nombre";
    }

    public function user_access ( $a_parameters = null ) {
        if ( $this->s_user_rol == "user" )
        {
            $this->aBase['a_dependencies'] = array();
            
            $this->a_property['flag_newsletter']['s_label'] = "Recibir Newsletter";

            $this->a_property['id']              ['a_form']['b_hidden'] = true;
            $this->a_property['nick']            ['a_form']['b_hidden'] = true;
            $this->a_property['habilitado']      ['a_form']['b_hidden'] = true;
            $this->a_property['nacionalidad']    ['a_form']['b_hidden'] = true;
            $this->a_property['imagen_perfil']   ['a_form']['b_hidden'] = true;
            $this->a_property['imagen_portada']  ['a_form']['b_hidden'] = true;
            $this->a_property['fecha_nacimiento']['a_form']['b_hidden'] = true;
            $this->a_property['flag_newsletter'] ['a_form']['b_hidden'] = true;
            
            $this->a_property['app_rol_id']['a_relation'] = array();
            $this->a_property['app_rol_id']['a_form']['b_hidden'] = true;
        }
    }
    
    public function create ( $a_parameters = null ) {
        $a_parameters['app_rol_id'] = 2;
        $a_parameters['codigo_validacion'] = $this->oYApp->oFrameworkConnection->oFramework->codiGene( array("iLong"=>4) );
        //$a_parameters['password']          = md5( $a_parameters['codigo_validacion'] );

        $a_parameters = parent::create( $a_parameters );
        //var_dump( $a_parameters['iIden'] );

        $this->oYApp->instancia_codigo_aleatorio( array(
            "codigo_longitud" => 16,
            "entidad_nombre"  => "usuario",
            "entidad_campo"   => "id_aleatorio",
            "instancia_id"    => $a_parameters['iIden'],
        ) );

        return $a_parameters;
    }

    public function update ( $a_parameters = null ) {
        
        $a_parameters = parent::update( $a_parameters );
        
        $this->oYApp->instancia_codigo_aleatorio( array(
            "codigo_longitud" => 16,
            "entidad_nombre"  => "usuario",
            "entidad_campo"   => "id_aleatorio",
            "instancia_id"    => $a_parameters['id'],
        ) );

        return $a_parameters;
    }

    public function delete ( $a_parameters = null ) {
        //print_r( "app.usuario.delete <br> \n" );
        //var_dump( $a_parameters );
        //var_dump( $this );

        // variables 
            
            $o_base = new base();

            $a_instancia = $this->aInst;
            $i_instancia = $a_instancia[0]['id'];

        // proceso
            
            $s_query = "UPDATE usuario SET flag_borrado = 1 WHERE id = $i_instancia";
            //print_r( $s_query . "<br> \n" );

            $o_base->procSent( $s_query );
            
        //return $a_parameters;
    }

    public function obteRela ( $aValo = null ) {
        $aInst = $aValo;
        $o_base = new base();

        foreach( $aInst as $iInstPosi => $aInstValo )
        {
            $oInst = new media_imagen();
            $oInst->aBase['aFilt'][] = "media_imagen.clase_foranea = 'usuario'";
            $oInst->aBase['aFilt'][] = "media_imagen.clave_foranea = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['media_imagen'] = $oInst->find();

            /*
            / obtener videos
            $oInst = new media_video();
            $oInst->aBase['aFilt'][] = "media_video.clase_foranea = 'usuario'";
            $oInst->aBase['aFilt'][] = "media_video.clave_foranea = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['media_video'] = $oInst->find();
            
            $oInst = new media_audio();
            $oInst->aBase['aFilt'][] = "media_audio.clase_foranea = 'usuario'";
            $oInst->aBase['aFilt'][] = "media_audio.clave_foranea = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['media_audio'] = $oInst->find();
            
            $oInst = new geo_ubicacion();
            $oInst->aBase['aFilt'][] = "geo_ubicacion.clase_foranea = 'usuario'";
            $oInst->aBase['aFilt'][] = "geo_ubicacion.clave_foranea = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['geo_ubicacion'] = $oInst->find();
            //*/
            
            $oInst = new app_rol();
            $aInstValo['app_rol'] = $oInst->read( array( "id" => $aInstValo[ 'app_rol_id' ] ) );

            // obtener usuario que realizo la reserva.
            $oInst = new app_usuario();
            $oInst->aBase['aFilt'][] = "app_usuario.usuario_id = '" . $aInstValo[ 'id' ] . "'";
            $aInstValo['app_usuario'] = $oInst->find();
            
            if ( empty( $aInstValo['app_usuario'] ) )
            {
                $aInstValo['app_usuario'] = $oInst->create( array( "usuario_id" => $aInstValo[ 'id' ] ) );
                $aInstValo['app_usuario'] = $oInst->read( array( "id" => $aInstValo['app_usuario']['iIden'] ) );
            }

            /*/ 2017.05.04 - obtener la instancia de la imagen del ultimo registro cientifico
            $aInstValo['registro'] = array();
            if ( $aInstValo['app_usuario'][0]['registro_ultimo_id'] != "0" )
            {
                $o_registro = new registro();
                $o_registro ->enable_relations();
                $a_registro = $o_registro->read( 
                        array( "id" => $aInstValo['app_usuario'][0]['registro_ultimo_id'] ) );
                $aInstValo['registro'] = $a_registro;
                //var_dump( $aInstValo['registro'][0]['media_imagen'][0] );
            }
            //*/

            $aInst[ $iInstPosi ] = $aInstValo;
        }
        return $aInst;
    }

    public function ctrlPasw ( $xValo ) {
        $oPasw = new pasw();
        if ( $this->bInst )
            return $oPasw->comparar( $xValo, $this->dato("password") );
        else
            return false;
    }

    function output_format ( $a_parameters = null ) {
        //var_dump( "output_format" );
        $a_parameters = parent::output_format( $a_parameters );

        $aInst = $a_parameters;
        
        foreach( $aInst as $iInstPosi => $aInstValo )
        {
            /*
            $s_accion_url     = FMWK_CLIE_SERV . "users/" . $aInstValo['nick'];
            $s_imagen_portada = $aInstValo['imagen_portada_portada'];
            $s_imagen_perfil  = $aInstValo['imagen_perfil_perfil'];
            $s_html_adicional = "";
            $s_card_titulo    = $aInstValo['nombre'] . " " . $aInstValo['apellido'];

            if ( trim( $s_card_titulo ) == "" )
                $s_card_titulo = $aInstValo['email'];
            */

            /*/ 2017.05.04 - control de la existencia de instancia de registro cientifico.
            if ( ! empty( $aInstValo['registro'] ) )
            {
                $s_imagen_portada = $aInstValo['registro'][0]['media_imagen'][0]['mimgnomb_origfile'];

                $s_html_adicional = "<div class='panel-tags'>
                  <div class='tags'>
                    <div class='cont'>
                      <img src='http://placehold.it/50/ff0000?text=+' alt='...' class='img-circle state-conservation' draggable='false'>
                      <p class='titu'>Scarlet-headed Blackbird</p>
                    </div>
                     <div class='cont cont-ptos'>
                      <p class='titu'>Impact</p>
                      <p class='ptos'>5.778</p>
                    </div>
                    <div class='cont cont-ptos'>
                      <p class='titu'>Points</p>
                      <p class='ptos'>230</p>
                    </div>
                     <div class='cont'>
                        <p class='titu'>
                            <a href='http://www.canon.es/for_home/product_finder/cameras/digital_slr/eos_1dx_mark_ii/'
                                target='_blank'>
                                Canon
                            </a>
                        </p>
                    </div>
                  </div>
                </div>";
            }


            $aInstValo['a_card_view'] = array(
                "card-template-url"   => STRUCTURE_DEFAULT_PATH . "view/bloques/card-general-avatar.html.php",
                //"card-template-url"   => STRUCTURE_DEFAULT_PATH . "view/bloques/card-general-1.html.php",
                "card-avatar-image-url" => $s_imagen_perfil,
                "card-html-adicional"   => $s_html_adicional,
                "card-avatar-titulo"    => $s_card_titulo,
                "card-avatar-subcabecera" => $aInstValo['app_rol'][0]['nombre'],
                "card-portada-url"      => $s_imagen_portada, //$aInstValo['imagen_portada_portada'],
                "card-titulo"           => $s_card_titulo,
                "card-info"             => "El usuario tiene que tener un campo donde comunicar sobre el", //$aInstValo['descripcion_breve'],
                "card-accion-url-link"  => $s_accion_url,
                "card-accion-url-label" => "Ver perfil",
            );

            $aInstValo['a_image_view'] = array(
                "image-template-url"     => STRUCTURE_DEFAULT_PATH . "view/bloques/view-image-item-1.html.php",
                "image-portada-url"      => $s_imagen_portada, //$aInstValo['imagen_portada_portada'],
                "image-accion-url-link"  => $s_accion_url,
            );
            */

            // setear los valores que utiliza la vista con estructura de articulo
            $aInstValo['titulo']                 = $s_card_titulo;
            $aInstValo['imagen_portada_portada'] = $aInstValo['imagen_portada_portada'];
            
            // 2017.09.30 - control del nombre del usuario para el dropdown user del navbar - INI
                $i_drop_longitud  = 13;
                $i_mail_separador = false;

                $s_dropdown_user  = $aInstValo['nombre'] . " " . $aInstValo['apellido'];
                
                if ( trim( $s_dropdown_user ) == "" )
                {
                    $s_dropdown_user  = $aInstValo['email'];
                    $i_mail_separador = strpos( $s_dropdown_user, "@" );
                    $s_dropdown_user  = substr( $s_dropdown_user, 0, $i_mail_separador );
                    $i_drop_longitud--;
                }
                
                if ( strlen( $s_dropdown_user ) > 16 )
                    $s_dropdown_user = substr( $s_dropdown_user, 0, $i_drop_longitud ) . "...";

                if ( $i_mail_separador !== false )
                    $s_dropdown_user .= "@";

                $aInstValo['dropdown_user'] = $s_dropdown_user;
            // 2017.09.30 - control del nombre del usuario para el dropdown user del navbar - FIN
                        
            $aInst[ $iInstPosi ] = $aInstValo;
        }
        
        return $aInst;
    }
}