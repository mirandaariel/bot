<?php include( STRUCTURE_DEFAULT_PATH . "view/includes/wf-mdl-link.php" ) ?> 
        
        <link   href="<?php echo STRUCTURE_VENDORS_HTTP ?>jquery/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" >
        <script src ="<?php echo STRUCTURE_VENDORS_HTTP ?>jquery/ui/1.12.1/jquery-ui.js"></script>

        <style type="text/css">
            .sponsor{
                position: relative;
                border: 0px solid #000;
                margin-bottom: 10px;
            }

            .sponsor .contenedor-link,
            .sponsor .contenedor-leyenda{
                border: 0px solid red;
                text-align: center;
            }

            .sponsor .contenedor-link {
                margin-top: -10px;
            }

            .sponsor .contenedor-link a,
            .sponsor .contenedor-leyenda h3{
                color: #999;
                margin-right: 10px;
                font-family: arial;
                font-weight: 400;
                font-size: 14px;
                margin-bottom: 0px;
                margin-top: 0px;
            }
            
            .sponsor .contenedor-link a {
                text-decoration: none;
                font-weight: bold;
                color: #999;
            }

            .deal-comision-usuario,
            .accion-comision-usuario {
                background-color: #EF6C00;
                margin-top: 0px;
                margin-right: 10px;
                text-align: center;
            }

            .deal-comision-usuario h3,
            .accion-comision-usuario h3{
                text-align: center;
                color: #fff;
                margin: 0px;
            }

            .deal-comision-usuario{
                background-color: #E65100;
            }
            
            .deal-comision-usuario small,
            .accion-comision-usuario small{
                font-size: 12px;
                color: #fff;
            }

            .publicidad-acciones .w-button {
                font-family: arial;
                font-size: 14px;
                text-transform: uppercase;
                font-weight: bold;
                margin-bottom: 16px;
            }

            @media screen and (min-width: 992px) {
                .deal-comision-usuario,
                .accion-comision-usuario{
                    margin-left: 125px;
                    margin-right: 125px;
                }

                .imagen-contenedor{
                    margin-left: 125px;
                    margin-right: 125px;
                }
                
                .imagen-contenedor img {
                    max-height: 450px;
                }
            }
        </style>
    </head>
    
    <body class="body">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=<?echo $a_parameters['content']['facebook-appId'] ?>";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <?php include( STRUCTURE_DEFAULT_PATH . "view/includes/wf-mdl-header.php" ) ?> 

        <div class="gray section">
            
            <div class="view-container w-container">
                
                <div class="view-tabs w-tabs" data-duration-in="300" data-duration-out="100">
                    
                    <?php include( STRUCTURE_DEFAULT_PATH . "view/includes/wf-mdl-views.php" ) ?> 
                    
                    <?php include( STRUCTURE_DEFAULT_PATH . "view/includes/wf-mdl-views-panels.php" ) ?> 

                </div>

                <?php if ( $b_publicidad ) { ?>
                <div id="view-general-custom-content">
                    <?php //var_dump( $a_publicidad_instancia ) ?>
                    <div class="sponsor"
                        style="display: <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['miembro-show'] ?>;" >
                        <div class="contenedor-leyenda">
                            <h3>
                                Campaña de un miembro de Artists Support
                            </h3>
                        </div>
                        <div class="contenedor-link">
                            <a href="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['miembro-link'] ?>"
                                target="_blank">
                                <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['miembro-label'] ?>
                            </a>
                        </div>
                    </div>
                    <div class="accion-comision-usuario"
                        style="display: <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-show'] ?>;">
                        <h3>
                            <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-valores'] ?>
                        </h3>
                        <small>por compartir en Facebook</small>
                    </div>
                    <div class="deal-comision-usuario"
                        style="display: <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-deal-show'] ?>;">
                        <h3>
                            <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-deal-valores'] ?>
                        </h3>
                        <small>por venta concretada</small>
                    </div>
                    <h1 class="article-title">
                        <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['nombre'] ?>
                    </h1>
                    <br />
                    <div class="imagen-contenedor">
                        <img class="article-portrait" sizes="(max-width: 767px) 100vw, (max-width: 991px) 728px, 940px" 
                            src="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['imagen_portada_article'] ?>" 
                            srcset="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['imagen_portada_article'] ?> 500w, 
                                <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['imagen_portada_article'] ?> 800w, 
                                <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['imagen_portada_article'] ?> 1080w, 
                                <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['imagen_portada_article'] ?> 1200w">
                    </div>
                    
                    <div class="article-paragraph">
                        <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['descripcion'] ?>
                    </div>
                    
                    <div class="article-paragraph publicidad-acciones" style="text-align: center;">
                        <a class="w-button" style="display: <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-url-show'] ?>;" 
                            href="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-url-link'] ?>" target="_blank">
                            <?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-url-label'] ?>
                        </a>

                        <button class="w-button boton-fb-compartir" 
                            style="display:<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-fb-compartir-show'] ?>;" 
                            data-accion-link="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-fb-compartir-link'] ?>"
                            data-publicidad-id="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-publicidad-id'] ?>"
                            data-distribucion-id="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-distribucion-id'] ?>"
                            data-accion-id="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-fb-compartir-id'] ?>"
                            data-accion-tipo="<?php echo $a_publicidad_instancia[ $i_publicidad_indice ]['a_general_view']['card-accion-fb-compartir-tipo'] ?>">
                            Compartir
                        </button>

                        <a id="boton-siguiente" class="w-button" 
                            href="<?php echo FMWK_CLIE_SERV . "main?" . ($i_publicidad_indice+1) ?>" >
                            siguiente
                        </a>
                    </div>
                </div>
                <?php } else { ?>
                <div id="view-general-custom-content">
                    <h1 class="article-title">
                        Suficiente por hoy
                    </h1>
                    <h2 class="article-description">
                        Se han acabado las campañas que teníamos para hoy. Mañana tendrás mas para que
                        puedas seguir generando ingresos. Te esperamos!!!
                    </h2>
                    <img class="article-portrait" 
                        src="<?php echo FMWK_CLIE_SERV ?>project/images/content/news-genera-ingresos.jpg">
                    <p class="article-paragraph">
                        Si quieres acercar cualquier inquietud, sugerencia u observación, por favor,
                        no dudes en comunicarte con nosotros. Podes enviarnos un email 
                        <a href="mailto:contacto@artists.support">contacto@artists.support</a>.
                    </p>
                </div>
                <?php } ?>
            </div>
        </div>

        <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>wf/mdl/js/webflow.js" type="text/javascript"></script>
        <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
        
    </body>

    <script>
        fmwk.add( s_default + "js/yApp.js" );
        fmwk.add( sClie + "project/js/home/main.js" );
        fmwk.load();
    </script>
</html>