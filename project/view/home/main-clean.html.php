<?php include( STRUCTURE_DEFAULT_PATH . "view/includes/wf-mdl-link.php" ) ?> 
        
        <link   href="<?php echo STRUCTURE_VENDORS_HTTP ?>jquery/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" >
        <script src ="<?php echo STRUCTURE_VENDORS_HTTP ?>jquery/ui/1.12.1/jquery-ui.js"></script>

    </head>
    
    <body class="body form-page form-page-clean">
        
        <?php include( STRUCTURE_DEFAULT_PATH . "view/includes/wf-mdl-header.php" ) ?> 
        
        <div class="main-wrapper">
            <div class="default-section">
              <div class="container-2 w-container">
                
                <?php foreach ( $a_publicidad_instancia as $i_instancia => $a_instancia ) { ?>
                <div class="post-contenedor">
                    <div class="imagen-contenedor"
                        style="background-image: url('<?php echo $a_instancia['imagen_portada']['16:9']['imagen_portada_origfile'] ?>');"></div>
                    <div class="shadow-contenedor">
                        <div class="shadow-texto-contenedor">
                            <h1 class="shadow-titulo">
                                <?php echo $a_instancia['nombre'] ?>
                            </h1>
                            <h2 class="shadow-subtitulo">
                                <?php echo $a_instancia['miembro_referencia_label'] ?>
                            </h2>
                            <p class="shadown-mensaje">
                                Si tu acción de compartir genera la venta, entonces ganas el dinero de la comisión.
                            </p>
                        </div>
                        <div class="shadow-dashboard-contenedor">
                          <div class="shadow-dashboard-item">
                            <h4 class="item-titulo">COMISIÓN</h4>
                            <h1 class="item-valor">$ 7.500,00</h1>
                          </div>
                          <div class="shadow-dashboard-item">
                            <h4 class="item-titulo">COMPARTIR</h4>
                            <h1 class="item-valor">$ 0,50</h1>
                          </div>
                        </div>
                        <div class="abajo shadow-icono-contenedor">
                          <div class="shadow-icon"><img class="icon-image" 
                            src="<?php echo STRUCTURE_VENDORS_HTTP . "icons/material.io/web/ic_format_align_left_black_48dp_2x.png" ?>">
                            <div class="shadown-icon-texto-contenedor">
                              <h1 class="icon-etiqueta">VER MÁS</h1>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

              </div>
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