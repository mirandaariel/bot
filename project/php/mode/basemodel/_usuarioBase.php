<?php 

class _usuarioBase extends clas {
  
  // ------------------------------------------------------------------------------------------- INI
  public function _usuarioBase () {
    $this->a_view = array(
        "a_list" => array(
            "a_image" => array(),                                                                   // cada elemento es un lugar para la imagen en el item
            "a_line"  => array(),                                                                   // cada elemento es una linea de texto en el item
        ),
        "a_grid" => array(
            "b_multiple_seleccion" => true,
            "b_agrupacion"         => false,
            "a_agrupacion"         => array(
                "groupField"      => array(), //["codigo"],
                "groupColumnShow" => array(), //[false],
                "groupText"       => array(), //["<b>Reserva {0}</b>"],
                "groupOrder"      => array(), //["asc"],
                "groupSummary"    => array(), //[true],
                "groupCollapse"   => false,   //false
            ),
        ),
    );
    $this->a_property = array(
      "id" => array(
        "b_key"    => true,
        "b_unique" => false,
        "s_name"   => "id",
        "s_type"   => "int",
        "s_label"  => "id",
        "a_grid"   => array(
            "s_field"        => "id",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "id_aleatorio" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "id_aleatorio",
        "s_type"   => "varchar",
        "s_label"  => "id_aleatorio",
        "a_grid"   => array(
            "s_field"        => "id_aleatorio",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "nick" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "nick",
        "s_type"   => "varchar",
        "s_label"  => "nick",
        "a_grid"   => array(
            "s_field"        => "nick",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "email" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "email",
        "s_type"   => "varchar",
        "s_label"  => "email",
        "a_grid"   => array(
            "s_field"        => "email",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "password" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "password",
        "s_type"   => "varchar",
        "s_label"  => "password",
        "a_grid"   => array(
            "s_field"        => "password",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "nombre" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "nombre",
        "s_type"   => "varchar",
        "s_label"  => "nombre",
        "a_grid"   => array(
            "s_field"        => "nombre",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "apellido" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "apellido",
        "s_type"   => "varchar",
        "s_label"  => "apellido",
        "a_grid"   => array(
            "s_field"        => "apellido",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "nacionalidad" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "nacionalidad",
        "s_type"   => "varchar",
        "s_label"  => "nacionalidad",
        "a_grid"   => array(
            "s_field"        => "nacionalidad",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "identificacion_nacional" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "identificacion_nacional",
        "s_type"   => "varchar",
        "s_label"  => "identificacion_nacional",
        "a_grid"   => array(
            "s_field"        => "identificacion_nacional",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "fecha_nacimiento" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "fecha_nacimiento",
        "s_type"   => "varchar",
        "s_label"  => "fecha_nacimiento",
        "a_grid"   => array(
            "s_field"        => "fecha_nacimiento",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "telefono_celular" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "telefono_celular",
        "s_type"   => "varchar",
        "s_label"  => "telefono_celular",
        "a_grid"   => array(
            "s_field"        => "telefono_celular",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "codigo_validacion" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "codigo_validacion",
        "s_type"   => "varchar",
        "s_label"  => "codigo_validacion",
        "a_grid"   => array(
            "s_field"        => "codigo_validacion",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "habilitado" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "habilitado",
        "s_type"   => "tinyint",
        "s_label"  => "habilitado",
        "a_grid"   => array(
            "s_field"        => "habilitado",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "email_verificado" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "email_verificado",
        "s_type"   => "tinyint",
        "s_label"  => "email_verificado",
        "a_grid"   => array(
            "s_field"        => "email_verificado",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "flag_newsletter" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "flag_newsletter",
        "s_type"   => "tinyint",
        "s_label"  => "flag_newsletter",
        "a_grid"   => array(
            "s_field"        => "flag_newsletter",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "imagen_perfil" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "imagen_perfil",
        "s_type"   => "varchar",
        "s_label"  => "imagen_perfil",
        "a_grid"   => array(
            "s_field"        => "imagen_perfil",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "imagen_portada" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "imagen_portada",
        "s_type"   => "varchar",
        "s_label"  => "imagen_portada",
        "a_grid"   => array(
            "s_field"        => "imagen_portada",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "fecha_creacion" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "fecha_creacion",
        "s_type"   => "varchar",
        "s_label"  => "fecha_creacion",
        "a_grid"   => array(
            "s_field"        => "fecha_creacion",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "fecha_modificacion" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "fecha_modificacion",
        "s_type"   => "varchar",
        "s_label"  => "fecha_modificacion",
        "a_grid"   => array(
            "s_field"        => "fecha_modificacion",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "ruta_upload" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "ruta_upload",
        "s_type"   => "varchar",
        "s_label"  => "ruta_upload",
        "a_grid"   => array(
            "s_field"        => "ruta_upload",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "persona_genero_id" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "persona_genero_id",
        "s_type"   => "int",
        "s_label"  => "persona_genero_id",
        "a_grid"   => array(
            "s_field"        => "persona_genero_id",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "app_rol_id" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "app_rol_id",
        "s_type"   => "int",
        "s_label"  => "app_rol_id",
        "a_grid"   => array(
            "s_field"        => "app_rol_id",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),
      "flag_borrado" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "flag_borrado",
        "s_type"   => "tinyint",
        "s_label"  => "flag_borrado",
        "a_grid"   => array(
            "s_field"        => "flag_borrado",
            "s_column_label" => "",
            "s_align"        => "left",
            "i_width"        => 100,
            "i_height"       => 30,
            "b_sortable"     => false,
            "b_hidden"       => false,
            "b_frozen"       => false,
        ),
        "a_form"  => array(
            "s_mask"     => "",
            "s_label"    => "",
            "b_hidden"   => false,
            "b_required" => false,
            "b_create"   => false,
        ),
        "a_relation" => array(
            "s_entity"   => "",
            "s_property" => "",
            "a_replace"  => array(),
        ),
      ),

    );
    $this->aProp = array(

      "id", 
      "id_aleatorio", 
      "nick", 
      "email", 
      "password", 
      "nombre", 
      "apellido", 
      "nacionalidad", 
      "identificacion_nacional", 
      "fecha_nacimiento", 
      "telefono_celular", 
      "codigo_validacion", 
      "habilitado", 
      "email_verificado", 
      "flag_newsletter", 
      "imagen_perfil", 
      "imagen_portada", 
      "fecha_creacion", 
      "fecha_modificacion", 
      "ruta_upload", 
      "persona_genero_id", 
      "app_rol_id", 
      "flag_borrado", 
    );                                                                                              // columnas de la entidad en la basa de datos
    $this->aTipo = array(

      "int", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "tinyint", 
      "tinyint", 
      "tinyint", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "varchar", 
      "int", 
      "int", 
      "tinyint", 
    );                                                                                              // tipo de datos de las columnas. Sirven para los componentes grilla y formulario
    $this->aEtiq = array(

      "id", 
      "id_aleatorio", 
      "nick", 
      "email", 
      "password", 
      "nombre", 
      "apellido", 
      "nacionalidad", 
      "identificacion_nacional", 
      "fecha_nacimiento", 
      "telefono_celular", 
      "codigo_validacion", 
      "habilitado", 
      "email_verificado", 
      "flag_newsletter", 
      "imagen_perfil", 
      "imagen_portada", 
      "fecha_creacion", 
      "fecha_modificacion", 
      "ruta_upload", 
      "persona_genero_id", 
      "app_rol_id", 
      "flag_borrado", 
    );                                                                                              // etiqueta de los campos. Serán mostrados en el componente grilla y formulario
    $this->iGridText = 50;                                                                          // longitud maxima de un campo de texto en la grilla.
    $this->aGrid = array( 
      array( "id", "id", 60, 30, true, "center", false, false ), 
      array( "id_aleatorio", "id_aleatorio", 60, 30, true, "center", false, false ), 
      array( "nick", "nick", 60, 30, true, "center", false, false ), 
      array( "email", "email", 60, 30, true, "center", false, false ), 
      array( "password", "password", 60, 30, true, "center", false, false ), 
      array( "nombre", "nombre", 60, 30, true, "center", false, false ), 
      array( "apellido", "apellido", 60, 30, true, "center", false, false ), 
      array( "nacionalidad", "nacionalidad", 60, 30, true, "center", false, false ), 
      array( "identificacion_nacional", "identificacion_nacional", 60, 30, true, "center", false, false ), 
      array( "fecha_nacimiento", "fecha_nacimiento", 60, 30, true, "center", false, false ), 
      array( "telefono_celular", "telefono_celular", 60, 30, true, "center", false, false ), 
      array( "codigo_validacion", "codigo_validacion", 60, 30, true, "center", false, false ), 
      array( "habilitado", "habilitado", 60, 30, true, "center", false, false ), 
      array( "email_verificado", "email_verificado", 60, 30, true, "center", false, false ), 
      array( "flag_newsletter", "flag_newsletter", 60, 30, true, "center", false, false ), 
      array( "imagen_perfil", "imagen_perfil", 60, 30, true, "center", false, false ), 
      array( "imagen_portada", "imagen_portada", 60, 30, true, "center", false, false ), 
      array( "fecha_creacion", "fecha_creacion", 60, 30, true, "center", false, false ), 
      array( "fecha_modificacion", "fecha_modificacion", 60, 30, true, "center", false, false ), 
      array( "ruta_upload", "ruta_upload", 60, 30, true, "center", false, false ), 
      array( "persona_genero_id", "persona_genero_id", 60, 30, true, "center", false, false ), 
      array( "app_rol_id", "app_rol_id", 60, 30, true, "center", false, false ), 
      array( "flag_borrado", "flag_borrado", 60, 30, true, "center", false, false ), 

      // field, label, width, height, sortable, align, hide, frozen
      //array( "columna", "colunomb", 100, 30, true, 'right', false, false ),                       // se debe setear la etiqueta y el id del campo porque corresponde a otra tabla
    );                                                                                              // configuración del componenete grilla.
    $this->aFilt = array(
      "aText" => array(
        //array( "colu_nomb" => "etiq" ),
      ),
      "aComb" => array(
        //array( "colu_nomb" => array(
        //  array( " " => "etiq" ),
        //  array( "valo_codi" => "valo_desc" ),
        //)),
      ),
      "aFech" => array(
        //array( "colu_nomb" => "etiq" ),
      ),
    );
    $this->aBase['aEnti'][] = "usuario";                                                               // nombre de la tabla en la base de datos.
    $this->aBase['aClav'][] = "id";                                                                 // campos que representan la clave primaria
    $this->aBase['aUnic'][] = "";                                                                   // campos que son unique.
    $this->aBase['aRela'] = array(
      //"otra_enti" => array( 
      //  "otra_enti.otra_enti_colu = enti_nomb.enti_colu",
      //),
    );
    $this->aBase['aAgre'] = array(                                                                  // cuando estoy utilizando la grilla para mostrar las instancias del objeto
      //"enti_colu" => array( 
      //  "otra_enti" => "otra_enti_colu",
      //),      
    );
    $this->aBase['aForm'] = array(                                                                  // componentes tipo select por ejemplo
      //"enti_colu" => array(                                                        
      //  "clas_nomb" => array( "clas_camp_valo" => "clas_camp_etiq" ),   
      //),
    );
  }
  // ------------------------------------------------------------------------------------------- FIN  
}