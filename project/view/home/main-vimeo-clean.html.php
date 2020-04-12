<?php include( STRUCTURE_DEFAULT_PATH . "view/includes/wf-mdl-link.php" ) ?> 
        
        <link   href="<?php echo STRUCTURE_VENDORS_HTTP ?>jquery/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" >
        <script src ="<?php echo STRUCTURE_VENDORS_HTTP ?>jquery/ui/1.12.1/jquery-ui.js"></script>

    </head>
    
    <body class="body form-page form-page-clean">
        
        <?php include( STRUCTURE_DEFAULT_PATH . "view/includes/wf-mdl-header.php" ) ?> 
        
        <div class="main-wrapper">
            <div class="default-section">
                <div class="container-2 w-container">
                    
                    <?php foreach ( $a_grupo as $i_grupo => $a_grupo ) { ?>
                    <?php //var_dump( $a_grupo['pr_publicidad'] ) ?>
                    <?php if ( ! empty( $a_grupo['pr_publicidad'] ) ) { ?>
                    <div class="grupo-contenedor w-clearfix">
                        <h1 class="grupo-titulo">
                            <?php echo $a_grupo['vista_titulo_1'] ?>
                        </h1>
                        <div class="grupo-data-contenedor">
                            <h1 class="grupo-data-titulo">
                                <?php echo $a_grupo['vista_titulo_2'] ?>
                            </h1>
                            <p class="grupo-data-parrafo">
                                <?php echo $a_grupo['vista_descripcion'] ?>
                            </p>
                        </div>
                        <div class="grupo-instancias-contenedor">
                            <?php foreach ( $a_grupo['pr_publicidad'] as $i_instancia => $a_instancia ) { ?>
                            <a href="<?php echo FMWK_CLIE_SERV . "ad/" . $a_instancia['codigo'] ?>">
                                <div class="instancia-contenedor">
                                    <div class="instancia-imagen-contenedor">
                                        <img class="instancia-imagen" 
                                            src="<?php echo $a_instancia['imagen_portada']['16:9']['imagen_portada_card'] ?>"></div>
                                    <div class="instancia-data-contenedor">
                                        <h1 class="instancia-titulo">
                                            <?php echo $a_instancia['nombre'] ?>
                                        </h1>
                                        <h6 class="instancia-valores">
                                            <?php echo $a_instancia['a_card_vimeo']['s_valores'] ?>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <div class="contanier-footer"></div>
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