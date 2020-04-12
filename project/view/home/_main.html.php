<?php include( COMPONENT_LINK ) ?>
</head>

<body>

    <?php include( COMPONENT_NAVBAR ) ?>
    
    <div class="main-wrapper">
        
        <div class="seccion seccion_2">
            
            <div class="seccion-contenido">
                
                <?php //include( COMPONENT_MENU_1 ) ?>
                
                <?php //include( COMPONENT_MENU_2 ) ?>

                <div class="contenido contenido_2">
                    
                    <div class="contenido-con-2-cols w-clearfix">
                        <div class="contenido-col-1 contenido-con-2-cols">
                          <div class="view-info-container">
                            <div class="view-info-data-container">
                              <h3 class="view-info-data-h3">Vista</h3>
                              <h2 class="view-info-data-h2">Principal</h2>
                              <div class="view-info-data-paragraph-container">
                                <p>
                                    Selecciona el formulario para ingresar tus datos, según el rol 
                                    que deseas cubrir.
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="contenido-col-2 contenido-con-2-cols">
                            
                            <div id="contenido-col-2-scroll">
                                
                                <div>
                                    
                                    <?php foreach ( $a_cards as $key => $value) { ?>
                                        <?php $value['object']->create() ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php //include( COMPONENT_PANEL_LEFT ) ?>

            <?php //include( COMPONENT_PANEL_RIGHT ) ?>
        </div>
    </div>
    
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>wf/clean/js/webflow.js" type="text/javascript"></script>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

    <?php $oYApp->save() ?>
    <?php $oYApp->save_in_file() ?>

    <script type="text/javascript"> 
        fmwk.add( sClie + "project/js/home/main.js" );
        fmwk.load();
    </script>
</body>
</html>