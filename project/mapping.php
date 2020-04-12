<?php

/*
  Estructura definida para el array y las diferentes formas de realizar el mapeo de datos con 
  propiedades de entidades que se encuentran en la logica de la aplicacion.

  $aMapping = array(
    "propiedad-desconocida-1" => "entidad-conocida.propiedad-1",
    "propiedad-desconocida-2" => array(
      "entidad-conocida.propiedad-1",
      "entidad-conocida.propiedad-2",
    ),
    "propiedad-desconocida-3" => function ( $aParameters ) {
      // $_POST: se puede acceder a los otros valores que vienen desde la vista
      // $aParameters[0]: nombre de la propiedad desconocida
      // $aParameters[1]: valor de propiedad pasado por referencia para que pueda ser modificado
      
      $sProp = $aParameters[0];
      $aParameters[1] .= "modificada por funcion (2)";

      // array de estructura similar al detallado en el mapeo de la propiedad-desconocida-2
      return array(
        "entidad-conocida.propiedad-3",
      );
    },
  );

$aMapping = array(
  "publicar" => array(
    "publicar/ubicacion" => array(
      "ciudadBarrio" => array(
        "ubic.ubicloca",
        "ubic.ubicbarr",
      ),
      "ubicacionCalle" => "ubic.ubiccall",
      "ubicacionAltura" => "ubic.ubicaltu",
    ),
    "publicar/caracteristicas" => array(
      "expensas"          => "prop.propexpe",
      "descripPropiedad"  => "prop.propdesc",
      "cantAmbientes"     => "prop.propambi",
      "cantDormitorios"   => "prop.propcdor",
      "cantBanos"         => "prop.propcban",
      "cantCocheras"      => "prop.propccoc",
      "edoPropiedad"      => "prop.propproe",
    ),
    "publicar/precio" => array(
      "publicarPrecio"  => "anun.anunprec",
      "selectDeposito"  => "anun.anunmdep",
      "selectAjuste" => function ( $aParameters ) {
        $sProp = $aParameters[0];                                                                   // auxiliar del nombre de la propiedad
        $sValo = $aParameters[1];                                                                   // auxiliar del valor
        
        $aValo = explode("-", $aParameters[1] );
        $aValo[1] = $aValo[1] == "anual" ? 1 : 2;

        $aParameters[1] = array();                                                                  // al modificar este indice, se modifica el valor a procesar por la app
        
        // se detallan todas las instancias de valores para cada instancia de propiedades que se 
        // definen en el array del return
        $aParameters[1][0] = $aValo[1];
        $aParameters[1][1] = $aValo[0];
        $aParameters[1][2] = $aValo[1] == 2 ? $aValo[0] : 0;
        $aParameters[1][3] = $aValo[1] == 2 ? $aValo[0] : 0;
                
        return array(
          "anun.anunperi",
          "anun.anunpr2s",
          "anun.anunpr3s",
          "anun.anunpr4s",
        );
      },
    ),
    "publicar/condiciones" => array(
      "seguroCaucion"     => "anun.anunacau",
      "garantiaProvincia" => "anun.anungcap",
      "garantiaRestoPais" => "anun.anungpro",
      "abl"               => "anun.anuniabl",
      "expensas"          => "anun.anuniexp",
      "aptoProfesional"   => "anun.anunapro",
      "usoComercial"      => "anun.anuncome",
    ),
  ),
);
*/

$aMapping = array();