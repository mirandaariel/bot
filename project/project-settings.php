<?php

//var_dump( __FILE__ );

/*/ 2017.03.12 - PHP.INI configuration --------------------------------------------------------- INI
post_max_size       = 20M
upload_max_filesize = 20M
max_file_uploads    = 20
// 2017.03.12 - PHP.INI configuration ---------------------------------------------------------- FIN*/

include_once( dirname(__FILE__)."/php/conf/base.php" );

// versiones con las que trabaja el projecto
define( "FMWK_YOBI_VERS", "v24.1/" );
define( "FMWK_BASE_VERS", 24 );
define( "STRUCTURE_DEFAULT_VERS", "v24.1/" );
define( "STRUCTURE_VENDORS_VERS", "v24.1/" );

// configuracion propia del proyecto
define( "FMWK_CLIE_LAND", false );                                                                  // el sitio tiene landing

define( "FMWK_CLIE_LOGO", "B" );
define( "FMWK_CLIE_TITU", "Bot" );
define( "FMWK_CLIE_FOOT", "&copy; Bot" );

define( "FMWK_CLIE_SOCL", true );                                                                   // links sociales flag
define( "FMWK_CLIE_FBLk", "https://www.facebook.com/" );                                            // links a la pagina de facebook
define( "FMWK_CLIE_GPLk", "https://plus.google.com/" );                                             // links a la pagina de google plus
define( "FMWK_CLIE_TWLk", "https://twitter.com/" );                                                 // links a la pagina de twitter
define( "FMWK_CLIE_LILk", "https://www.linkedin.com/" );                                            // links a la pagina de linkedin
define( "FMWK_CLIE_PILk", "http://www.pinterest.com/" );                                            // links a la pagina de pinterest
define( "FMWK_CLIE_YTLk", "https://www.youtube.com/" );                                             // links a la pagina de youtube

// 2017.02.28 - centralizar la definicion de las entidades principales - INI
    $APP_CONFIGURATION = array(
        "a_entidades_principales" => array(     
            "usuario", 
            "keyword", 
            "respuesta", 
            "accion", 
        ),
        "a_menu" => array(
            "main" => array(
                "s_view"       => "api",
                "s_link"       => "[FMWK_CLIE_SERV]" . "api",
                "s_label"      => "Api",
                "b_active"     => false,
                "s_active_css" => "active",
                "b_icon"       => true,
                "s_icon"       => "dashboard",
                "b_options"    => false,
                "a_options"    => array(),
                "b_session"    => true,
            ),
        ),
        "ambientes" => array(
            "desarrollo" => array(
                "email" => array(),
            ),
            "stage"    => array(
                "email" => array(
                    "from"   => "Soporte a Artistas - Contacto <contact@bot.com>",
                    "replay" => "Soporte a Artistas - Contacto <contact@bot.com>",
                ),
            ),
            "produccion" => array(
                "email" => array(
                    "from"   => "Soporte a Artistas - Contacto <contact@bot.com>",
                    "replay" => "Soporte a Artistas - Contacto <contact@bot.com>",
                ),
            ),
        ),
    );