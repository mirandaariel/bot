<?php include( COMPONENT_LINK ) ?>
</head>

<body>

        <?php include( COMPONENT_NAVBAR ) ?>

        <div id="main-wrapper" class="main-wrapper">

            <div class="section">
               
                <div class="content-container">
                    
                    Contenido

                    <?php $o_content->create() ?>

                    Formulario

                    <?php $o_form->create() ?>

                    <div class="content-container-footer"></div>
                </div>
            </div>
        </div>
        
        <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>wf/airbnb/js/webflow.js" type="text/javascript"></script>
        <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
        
        <?php $oYApp->save() ?>
        <?php $oYApp->save_in_file() ?>

        <script type="text/javascript"> 
            UIkit.container = document.getElementById('#main-wrapper');

            fmwk.add( s_default + "js/yApp.js" );
            fmwk.load();
        </script>
</body>
</html>