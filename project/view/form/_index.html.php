<?php include( COMPONENT_LINK ) ?>

    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-shims.js"></script>      
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/scoped.js"></script>        
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/beta-noscoped.js"></script>
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-browser-noscoped.js"></script>
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-flash-noscoped.js"></script>
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-media-noscoped.js"></script>
    <!--
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-flash.swf"></script>
    -->
</head>

<body>

    <?php include( COMPONENT_NAVBAR ) ?>
    
    <div class="main-wrapper">
            
        <div class="seccion seccion_2">
                
            <div class="seccion-contenido">
                    
                <div class="contenido contenido_2">
                        
                    <div class="contenido-con-2-cols w-clearfix">
                        
                        <div class="contenido-col-1 contenido-con-2-cols">
                            
                            <?php $o_view_info ->create() ?>
                        </div>
                        
                        <div class="contenido-col-2 contenido-con-2-cols">
                            
                            <div class="form-container en-contenido-col-2">
                            
                                <div id="contenido-col-2-scroll">
                                    <?php $o_form->create() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php //include( COMPONENT_PANEL_RIGHT ) ?>
        </div>
    </div>
    
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>wf/clean/js/webflow.js" type="text/javascript"></script>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->

    <?php $oYApp->save() ?>
    <?php $oYApp->save_in_file() ?>

    <script type="text/javascript"> 
        fmwk.add( sClie + "project/js/form/index.js" );
        fmwk.load();
    </script>
</body>
</html>