<?php 

class _accionBase extends clas {
  
  // ------------------------------------------------------------------------------------------- INI
  public function _accionBase () {
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
      "descripcion" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "descripcion",
        "s_type"   => "text",
        "s_label"  => "descripcion",
        "a_grid"   => array(
            "s_field"        => "descripcion",
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
      "logica_archivo" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "logica_archivo",
        "s_type"   => "varchar",
        "s_label"  => "logica_archivo",
        "a_grid"   => array(
            "s_field"        => "logica_archivo",
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
      "logica_clase" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "logica_clase",
        "s_type"   => "varchar",
        "s_label"  => "logica_clase",
        "a_grid"   => array(
            "s_field"        => "logica_clase",
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
      "logica_metodo" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "logica_metodo",
        "s_type"   => "varchar",
        "s_label"  => "logica_metodo",
        "a_grid"   => array(
            "s_field"        => "logica_metodo",
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
      "flag_ejecucion_unica" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "flag_ejecucion_unica",
        "s_type"   => "tinyint",
        "s_label"  => "flag_ejecucion_unica",
        "a_grid"   => array(
            "s_field"        => "flag_ejecucion_unica",
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
      "nombre", 
      "descripcion", 
      "logica_archivo", 
      "logica_clase", 
      "logica_metodo", 
      "flag_ejecucion_unica", 
    );                                                                                              // columnas de la entidad en la basa de datos
    $this->aTipo = array(

      "int", 
      "varchar", 
      "text", 
      "varchar", 
      "varchar", 
      "varchar", 
      "tinyint", 
    );                                                                                              // tipo de datos de las columnas. Sirven para los componentes grilla y formulario
    $this->aEtiq = array(

      "id", 
      "nombre", 
      "descripcion", 
      "logica_archivo", 
      "logica_clase", 
      "logica_metodo", 
      "flag_ejecucion_unica", 
    );                                                                                              // etiqueta de los campos. Serán mostrados en el componente grilla y formulario
    $this->iGridText = 50;                                                                          // longitud maxima de un campo de texto en la grilla.
    $this->aGrid = array( 
      array( "id", "id", 60, 30, true, "center", false, false ), 
      array( "nombre", "nombre", 60, 30, true, "center", false, false ), 
      array( "descripcion", "descripcion", 60, 30, true, "center", false, false ), 
      array( "logica_archivo", "logica_archivo", 60, 30, true, "center", false, false ), 
      array( "logica_clase", "logica_clase", 60, 30, true, "center", false, false ), 
      array( "logica_metodo", "logica_metodo", 60, 30, true, "center", false, false ), 
      array( "flag_ejecucion_unica", "flag_ejecucion_unica", 60, 30, true, "center", false, false ), 

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
    $this->aBase['aEnti'][] = "accion";                                                               // nombre de la tabla en la base de datos.
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