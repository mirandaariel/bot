<?php include( COMPONENT_LINK ) ?>
    
</head>

<body>

        <?php include( COMPONENT_NAVBAR ) ?>

        <div class="main-wrapper">

            <!--
            <div class="section-only-brand">
                <h4 class="content-header-2-h4">Soporte a Artistas</h4>
                <h4 class="content-email-link">
                    <a href="<?php echo FMWK_CLIE_SERV ?>login" style="text-decoration: none;">
                        Iniciar Sesión
                    </a>
                    -
                    <a href="<?php echo FMWK_CLIE_SERV ?>register" style="text-decoration: none;">
                        Registrarse
                    </a>
                </h4>
                <h4 class="content-email-link">
                    <a href="mailto:casting@soporteartistas.com" style="text-decoration: none;">
                        casting@soporteartistas.com
                    </a>
                </h4>
            </div>
            -->

            <div class="home-1-bg-container">
                <div class="home-1-bg-imagen desktop"
                    style="background-image: url(<?php echo $s_image_desktop ?>);"></div>
                <div class="home-1-bg-imagen tablet"
                    style="background-image: url(<?php echo $s_image_tablet ?>);"></div>
                <div class="home-1-bg-imagen landscape"
                    style="background-image: url(<?php echo $s_image_landscape ?>);"></div>
                <div class="home-1-bg-imagen portrait"
                    style="background-image: url(<?php echo $s_image_portrait ?>);"></div>
            </div>
            <div class="home-1-content-container">
                <h4 class="content-header-2-h4 white">
                    Soporte a Artistas
                </h4>
                <a href="<?php echo FMWK_CLIE_SERV ?>login" class="content-header-2-link home-1">
                    quiero ser parte
                </a>
            </div>

        </div>

        <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>wf/airbnb/js/webflow.js" type="text/javascript"></script>
        <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
        
        <?php //$oYApp->save() ?>
        <?php //$oYApp->save_in_file() ?>

        <script type="text/javascript"> 
            fmwk.add( sClie + "project/js/home/index.js" );
            fmwk.load();
        </script>
</body>
</html>