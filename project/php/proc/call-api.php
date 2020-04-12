<?php

include_once( "../../yApp.php" );

$s_carto_username = "silvestris";
$s_carto_apikey   = "034401ec099198f88b27c29e41dc706939faa9d7";
$s_sql = "INSERT INTO registro (bio_especie_id, fecha_creacion, id, latitud, longitud) VALUES ([bio_especie_id], '[fecha_creacion]', [id], [latitud], [longitud])";

$aPost = array(
    "q" => "INSERT INTO registro (bio_especie_id, fecha_creacion, id, latitud, longitud) VALUES (51, '2017-03-27 00:27:39', 1001, 38.9098333333330000, 1.4386666666667000)",
    "api_key" => "034401ec099198f88b27c29e41dc706939faa9d7",
);

$s_call_api_url = "https://silvestris.carto.com/api/v2/sql?q=INSERT INTO registro (bio_especie_id, fecha_creacion, id, latitud, longitud) VALUES (51, '2017-03-27 00:27:39', 1001, 38.9098333333330000, 1.4386666666667000)&api_key=034401ec099198f88b27c29e41dc706939faa9d7";
//$s_call_api_url = "http://www.yobi.com.ar";
$s_call_api_url = "https://silvestris.carto.com/api/v2/sql";


$aHead = array();
$aHead[] = "Content-type: multipart/form-data";

$oCurl = curl_init();  
curl_setopt( $oCurl, CURLOPT_HTTPHEADER, $aHead );
curl_setopt( $oCurl, CURLOPT_URL, $s_call_api_url );  
curl_setopt( $oCurl, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $oCurl, CURLOPT_HEADER, true );
curl_setopt( $oCurl, CURLOPT_POST, true );  
curl_setopt( $oCurl, CURLOPT_POSTFIELDS, $aPost );  
       
$sResp = curl_exec ( $oCurl );  
$iHead = curl_getinfo( $oCurl, CURLINFO_HEADER_SIZE );
$sHead = substr( $sResp, 0, $iHead );
$sBody = trim( substr( $sResp, $iHead ) );

var_dump( $sResp );
var_dump( $iHead );
var_dump( $sHead );
var_dump( $sBody );

curl_close( $oCurl );  
