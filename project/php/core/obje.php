<?php 
// -----------------------------------------------------------------------------
// este script se utiliza para evitar error en aquellas versiones de PHP que no
// permiten la creación dinamica de objetos, permitiendo utilizar una variable
// despues de la palabra reservada new
// -----------------------------------------------------------------------------

$oFmwkObje = null;
switch( $sEnti )
{
//[TAGI] 
case "bio_clase": $oFmwkObje = new bio_clase(); break;
case "bio_clasificacion": $oFmwkObje = new bio_clasificacion(); break;
case "bio_clasificacion_atributo": $oFmwkObje = new bio_clasificacion_atributo(); break;
case "bio_clasificacion_organizacion": $oFmwkObje = new bio_clasificacion_organizacion(); break;
case "bio_clasificacion_valor": $oFmwkObje = new bio_clasificacion_valor(); break;
case "bio_especie": $oFmwkObje = new bio_especie(); break;
case "bio_especie_area": $oFmwkObje = new bio_especie_area(); break;
case "bio_especie_clasificacion": $oFmwkObje = new bio_especie_clasificacion(); break;
case "bio_especie_division_1": $oFmwkObje = new bio_especie_division_1(); break;
case "bio_especie_division_2": $oFmwkObje = new bio_especie_division_2(); break;
case "bio_especie_grupo_investigacion": $oFmwkObje = new bio_especie_grupo_investigacion(); break;
case "bio_especie_link": $oFmwkObje = new bio_especie_link(); break;
case "bio_especie_organizacion": $oFmwkObje = new bio_especie_organizacion(); break;
case "bio_especie_pais": $oFmwkObje = new bio_especie_pais(); break;
case "bio_familia": $oFmwkObje = new bio_familia(); break;
case "bio_filo": $oFmwkObje = new bio_filo(); break;
case "bio_genero": $oFmwkObje = new bio_genero(); break;
case "bio_orden": $oFmwkObje = new bio_orden(); break;
case "bio_reino": $oFmwkObje = new bio_reino(); break;
case "bio_sinonimia": $oFmwkObje = new bio_sinonimia(); break;
case "biz_anuncio": $oFmwkObje = new biz_anuncio(); break;
case "biz_difusion": $oFmwkObje = new biz_difusion(); break;
case "biz_establecimiento": $oFmwkObje = new biz_establecimiento(); break;
case "biz_pedido": $oFmwkObje = new biz_pedido(); break;
case "biz_pedido_estado": $oFmwkObje = new biz_pedido_estado(); break;
case "biz_pedido_producto": $oFmwkObje = new biz_pedido_producto(); break;
case "biz_pedido_resultado": $oFmwkObje = new biz_pedido_resultado(); break;
case "biz_pedido_servicio": $oFmwkObje = new biz_pedido_servicio(); break;
case "biz_referencia": $oFmwkObje = new biz_referencia(); break;
case "darwin_core": $oFmwkObje = new darwin_core(); break;
case "darwin_core_basis": $oFmwkObje = new darwin_core_basis(); break;
case "darwin_core_type": $oFmwkObje = new darwin_core_type(); break;
case "geo_aglomerado": $oFmwkObje = new geo_aglomerado(); break;
case "geo_area": $oFmwkObje = new geo_area(); break;
case "geo_area_area_tipo": $oFmwkObje = new geo_area_area_tipo(); break;
case "geo_area_clasificacion": $oFmwkObje = new geo_area_clasificacion(); break;
case "geo_area_clima": $oFmwkObje = new geo_area_clima(); break;
case "geo_area_division_1": $oFmwkObje = new geo_area_division_1(); break;
case "geo_area_division_2": $oFmwkObje = new geo_area_division_2(); break;
case "geo_area_grupo_investigacion": $oFmwkObje = new geo_area_grupo_investigacion(); break;
case "geo_area_habitat": $oFmwkObje = new geo_area_habitat(); break;
case "geo_area_organizacion": $oFmwkObje = new geo_area_organizacion(); break;
case "geo_area_pais": $oFmwkObje = new geo_area_pais(); break;
case "geo_area_relacion": $oFmwkObje = new geo_area_relacion(); break;
case "geo_area_tipo": $oFmwkObje = new geo_area_tipo(); break;
case "geo_clasificacion": $oFmwkObje = new geo_clasificacion(); break;
case "geo_clasificacion_atributo": $oFmwkObje = new geo_clasificacion_atributo(); break;
case "geo_clasificacion_organizacion": $oFmwkObje = new geo_clasificacion_organizacion(); break;
case "geo_clasificacion_valor": $oFmwkObje = new geo_clasificacion_valor(); break;
case "geo_clima": $oFmwkObje = new geo_clima(); break;
case "geo_clima_variables": $oFmwkObje = new geo_clima_variables(); break;
case "geo_continente": $oFmwkObje = new geo_continente(); break;
case "geo_division_1": $oFmwkObje = new geo_division_1(); break;
case "geo_division_1_tipo": $oFmwkObje = new geo_division_1_tipo(); break;
case "geo_division_2": $oFmwkObje = new geo_division_2(); break;
case "geo_division_2_tipo": $oFmwkObje = new geo_division_2_tipo(); break;
case "geo_division_3": $oFmwkObje = new geo_division_3(); break;
case "geo_division_3_tipo": $oFmwkObje = new geo_division_3_tipo(); break;
case "geo_habitat": $oFmwkObje = new geo_habitat(); break;
case "geo_habitat_valor": $oFmwkObje = new geo_habitat_valor(); break;
case "geo_habitat_variable": $oFmwkObje = new geo_habitat_variable(); break;
case "geo_pais": $oFmwkObje = new geo_pais(); break;
case "geo_pais_clima": $oFmwkObje = new geo_pais_clima(); break;
case "geo_pais_division_1_tipo": $oFmwkObje = new geo_pais_division_1_tipo(); break;
case "geo_pais_division_2_tipo": $oFmwkObje = new geo_pais_division_2_tipo(); break;
case "geo_pais_division_3_tipo": $oFmwkObje = new geo_pais_division_3_tipo(); break;
case "geo_puntos": $oFmwkObje = new geo_puntos(); break;
case "geo_subcontinente": $oFmwkObje = new geo_subcontinente(); break;
case "geo_zona": $oFmwkObje = new geo_zona(); break;
case "perfil_capacitacion": $oFmwkObje = new perfil_capacitacion(); break;
case "perfil_experiencia": $oFmwkObje = new perfil_experiencia(); break;
case "perfil_habilidad": $oFmwkObje = new perfil_habilidad(); break;
case "perfil_habilidad_tipo": $oFmwkObje = new perfil_habilidad_tipo(); break;
case "registro": $oFmwkObje = new registro(); break;
case "registro_clasificacion": $oFmwkObje = new registro_clasificacion(); break;
case "registro_clima": $oFmwkObje = new registro_clima(); break;
case "registro_deceso_causa": $oFmwkObje = new registro_deceso_causa(); break;
case "registro_estado": $oFmwkObje = new registro_estado(); break;
case "registro_habitat": $oFmwkObje = new registro_habitat(); break;
case "registro_signo": $oFmwkObje = new registro_signo(); break;
case "registro_validacion": $oFmwkObje = new registro_validacion(); break;
case "registro_identificacion": $oFmwkObje = new registro_identificacion(); break;
case "registro_identificacion_adicional": $oFmwkObje = new registro_identificacion_adicional(); break;
case "social_grupo_investigacion": $oFmwkObje = new social_grupo_investigacion(); break;
case "social_objetivo": $oFmwkObje = new social_objetivo(); break;
case "social_objetivo_tipo": $oFmwkObje = new social_objetivo_tipo(); break;
case "social_organizacion": $oFmwkObje = new social_organizacion(); break;
case "social_organizacion_objetivo": $oFmwkObje = new social_organizacion_objetivo(); break;
case "social_organizacion_tipo": $oFmwkObje = new social_organizacion_tipo(); break;
case "app_rol": $oFmwkObje = new app_rol(); break;
case "wf_asignacion_rol": $oFmwkObje = new wf_asignacion_rol(); break;
case "wf_asignacion_usuario": $oFmwkObje = new wf_asignacion_usuario(); break;
case "wf_estado": $oFmwkObje = new wf_estado(); break;
case "wf_etapa": $oFmwkObje = new wf_etapa(); break;
case "wf_etapa_estado": $oFmwkObje = new wf_etapa_estado(); break;
case "wf_instancia": $oFmwkObje = new wf_instancia(); break;
case "wf_instancia_comentario": $oFmwkObje = new wf_instancia_comentario(); break;
case "wf_instancia_estado": $oFmwkObje = new wf_instancia_estado(); break;
case "wf_instancia_etapa": $oFmwkObje = new wf_instancia_etapa(); break;
case "wf_instancia_objetivo": $oFmwkObje = new wf_instancia_objetivo(); break;
case "wf_instancia_respuesta": $oFmwkObje = new wf_instancia_respuesta(); break;
case "wf_instancia_soporte": $oFmwkObje = new wf_instancia_soporte(); break;
case "wf_objetivo": $oFmwkObje = new wf_objetivo(); break;
case "wf_proceso": $oFmwkObje = new wf_proceso(); break;
case "wf_soporte": $oFmwkObje = new wf_soporte(); break;
case "media_imagen": $oFmwkObje = new media_imagen(); break;
//[TAGF]
case "": $oFmwkObje = null; break;
}
return $oFmwkObje;
//[TAGC:106]