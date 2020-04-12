<div id="panel_modal_container" class="contenido-dinamico" yobi-cached="0">

    <button class="uk-modal-close-default" type="button" uk-close></button>        
        
    <h2 class="uk-modal-title">
        <?php echo $s_panel_content_title ?>
    </h2>
    
    <p>
        <?php echo $s_panel_content_description ?>
    </p>
    
    <?php foreach ( $a_buttons as $i_button => $a_button ) { ?>
        <?php $a_button['object']->create() ?>
    <?php } ?>
</div>