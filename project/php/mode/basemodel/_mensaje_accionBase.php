<?php 

class _mensaje_accionBase extends clas {
  
  // ------------------------------------------------------------------------------------------- INI
  public function _mensaje_accionBase () {
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
      "mensaje_id" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "mensaje_id",
        "s_type"   => "int",
        "s_label"  => "mensaje_id",
        "a_grid"   => array(
            "s_field"        => "mensaje_id",
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
      "accion_id" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "accion_id",
        "s_type"   => "int",
        "s_label"  => "accion_id",
        "a_grid"   => array(
            "s_field"        => "accion_id",
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
      "resultado" => array(
        "b_key"    => false,
        "b_unique" => false,
        "s_name"   => "resultado",
        "s_type"   => "text",
        "s_label"  => "resultado",
        "a_grid"   => array(
            "s_field"        => "resultado",
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
      "mensaje_id", 
      "accion_id", 
      "resultado", 
    );                                                                                              // columnas de la entidad en la basa de datos
    $this->aTipo = array(

      "int", 
      "int", 
      "int", 
      "text", 
    );                                                                                              // tipo de datos de las columnas. Sirven para los componentes grilla y formulario
    $this->aEtiq = array(

      "id", 
      "mensaje_id", 
      "accion_id", 
      "resultado", 
    );                                                                                              // etiqueta de los campos. Serán mostrados en el componente grilla y formulario
    $this->iGridText = 50;                                                                          // longitud maxima de un campo de texto en la grilla.
    $this->aGrid = array( 
      array( "id", "id", 60, 30, true, "center", false, false ), 
      array( "mensaje_id", "mensaje_id", 60, 30, true, "center", false, false ), 
      array( "accion_id", "accion_id", 60, 30, true, "center", false, false ), 
      array( "resultado", "resultado", 60, 30, true, "center", false, false ), 

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
    $this->aBase['aEnti'][] = "mensaje_accion";                                                               // nombre de la tabla en la base de datos.
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