<?php include( COMPONENT_LINK ) ?>
    
    <!--
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-shims.js"></script>      
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/scoped.js"></script>        
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/beta-noscoped.js"></script>
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-browser-noscoped.js"></script>
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-flash-noscoped.js"></script>
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-media-noscoped.js"></script>
    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>front-end-framework/betajs/betajs-flash.swf"></script>
    -->

    <style type="text/css">
        .formulario {
            margin-top: 32px;
            margin-bottom: 32px;
            float: left;
            width: 100%;
        }

        .formulario .input-contenedor {
            margin-bottom: 24px;
        }

        .formulario form {
            float: left;
            width: 100%;
        }

        .form-group .select2-selection__rendered {
            background-color: #f5f8fa;
            border: 1px solid #cbd6e2;
        }
    </style>

</head>

<body class="body">

    <?php //if ( $b_user_session ) { ?>
    <?php include( COMPONENT_NAVBAR ) ?>
    <?php //} ?>
    
    <div class="main-wrapper">
        
        <div class="section-article">
            
            <?php include( "menu_1.php" ) ?>

            <div class="content-container">
                
                <div class="content-image header">
                    <img src="<?php echo $s_imagen_portada_original ?>" 
                        alt="">
                </div>
                
                <div class="content-image-landscape">
                    <img src="<?php echo $s_imagen_portada_landscape ?>" alt="" class="content-image-landscape-img">
                </div>
                
                <div class="content-image-mobile">
                    <img src="<?php echo $s_imagen_portada_mobile ?>" alt="">
                </div>
        

                <?php if ( $b_usuario_ref ) { ?>
                <div class="content-article-reviews list-view w-clearfix">
                    <div class="content-article-review-item view-list w-clearfix">
                        <div class="cth-3-c1-l5-avatar cari">
                            <img src="<?php echo $a_usuario_ref[0]['imagen_perfil_perfil'] ?>" 
                                sizes="44px" alt="">
                        </div>
                        <div class="cth-3-c1-l5-info cari">
                            <h5 class="cth-3-c1-l5-info-h5">
                                <?php echo $a_usuario_ref[0]['nombre'] ?>
                            </h5>
                            <h6 class="cth-3-c1-l5-info-h6" style="margin: 0px;">
                                <?php echo date("d-m-Y") ?>
                            </h6>
                        </div>
                        <div class="content-article-review-item-p view-lists">
                            <p class="paragraph">&quot;Has llegado a nosotros a través de <?php echo $a_usuario_ref[0]['nombre'] ?>.&quot;</p>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="content-checkout-default _32px">
                    <h1 class="content-checkout-default-title">
                        <?php echo $a_form_cabecera[0]['nombre'] ?>
                    </h1>
                    <h4 class="content-checkout-default-subtitle">
                        <?php echo $a_form_cabecera[0]['descripcion'] ?>
                    </h4>

                    <?php $o_form->create() ?>

                </div>
                
                <!--
                <div class="content-checkout-default"></div>
                -->
            </div>
        </div>
    </div>
    <!--
    <div class="page-footer w-clearfix">
        <div class="footer-content checkout-page">
            <ul class="footer-list w-clearfix w-list-unstyled">
                <li class="footer-list-item">
                    <div>Items: 2</div>
                </li>
                <li class="footer-list-item">
                    <div>Unidades: 220</div>
                </li>
                <li class="footer-list-item">
                    <div>Total: $ 48.000,00</div>
                </li>
            </ul>
        </div>
        <div class="footer-controls">
            <div class="footer-control-item">Enviar Pedido</div>
            <div class="footer-control-item">Pagar</div>
        </div>
    </div>
    -->

    <script src="<?php echo STRUCTURE_VENDORS_HTTP ?>wf/airbnb/js/webflow.js" type="text/javascript"></script>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
    
    <?php $oYApp->save() ?>
    <?php $oYApp->save_in_file() ?>

    <script type="text/javascript"> 
        fmwk.add( s_default + "js/yApp.js" );
        fmwk.load();
    </script>
</body>
</html>