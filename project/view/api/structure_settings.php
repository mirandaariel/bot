<?php

//<pre>string(26) "test.api.manager.moob.club"
//</pre><pre>string(50) "/var/platform/www/test.api.manager/core/v1/classes"

if ( $_SERVER["SERVER_NAME"] == "localhost" )
{
    define( "SERVER_NAME", "localhost");
    define( "SERVER_PATH", "/opt/lampp/htdocs/test/apimanager/");
}
else if ( $_SERVER["SERVER_NAME"] == "test.api.manager.moob.club" )
{
    define( "SERVER_NAME", "test.api.manager.moob.club");
    define( "SERVER_PATH", "/var/platform/www/test.api.manager/");
}
