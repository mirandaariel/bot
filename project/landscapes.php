<?php 

// 20151006. IMPORTANTE. Todas las funciones de las vistas, despues del switch deben tener 
// return $aParameters

// 20160125. IMPORTANTE. Opciones de valores que pueden ser procesados por la vista.
//header( "location: ".FMWK_CLIE_SERV."publicar" );
//$aParameters['content']['user-notification'] = $aResult['sProc'];
//$aParameters['control']['redirect'] = FMWK_CLIE_SERV."publicar/condiciones";

include_once( STRUCTURE_DEFAULT_HTTP."/default-landscapes.cls" );

$aLandscape = array();
$aLandscape = array_merge_recursive( $aLandscape, $a_default_landscapes );

/*
$aLandscape['user'] = array(
  "user/upload" => array(
    "user-upload-no-session" => function ( $aParameters ) { 
      header( "location: ".FMWK_CLIE_SERV );
      return $aParameters;
    },
    "user-upload-session" => function ( $aParameters ) { 
      $aParameters['control']['link-app-title']    = false;
      $aParameters['control']['link-user-login']   = false;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = false;
      $aParameters['control']['button-view-data']  = true;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = true;
      $aParameters['control']['dropdown-alerts']   = true;
      $aParameters['control']['dropdown-user']     = true;
      return $aParameters;
    },
    "user-upload-ajax" => function ( $aParameters ) { 
      $oYApp = unserialize( $_SESSION['oYApp'] );
      
      $aPara = $oYApp->oFrameworkConnection->oFramework->aPara;
      
      $aAuxi = array(
        "aFile" => $aPara['aFile'],
        "file" => $aPara['file'],
      );
      unset( $aPara['aFile'] );
      unset( $aPara['file'] );

      foreach ( $aAuxi['file'] as $i_auxi_inst => $s_auxi_inst ) 
      {
        $aPara['aFile'] = array(
          "mimgnomb" => array(
            "name"     => $aAuxi['aFile']['file']['name'][ $i_auxi_inst ],
            "type"     => $aAuxi['aFile']['file']['type'][ $i_auxi_inst ],
            "tmp_name" => $aAuxi['aFile']['file']['tmp_name'][ $i_auxi_inst ],
            "error"    => $aAuxi['aFile']['file']['error'][ $i_auxi_inst ],
            "size"     => $aAuxi['aFile']['file']['size'][ $i_auxi_inst ],
          ),
        );
        $aPara['mimgnomb'] = $aPara['aFile']['mimgnomb']['name'];
        $aPara['mimgiden'] = "";
        $aPara['mimgfcls'] = "usua";
        $aPara['mimgfkey'] = $oYApp->aModu[ $oYApp->sModu ]['login']['usua'][0]['usuaiden'];

        $bExif = false;
        $aRecord = array();
        $sFile = $aPara['aFile']['mimgnomb']['tmp_name'];
        $aAux2 = array( "GPSLatitude", "GPSLongitude" );                                        // array con los campos de interes para analisis en el array del exif
        $oExif = exif_read_data( $sFile, NULL, true, true);                                     // leer exif data
        if ( $oExif !== false )                                                                 // si existe
        {
          $bExif = true;
          $aExif = array();
          foreach ( $oExif as $sClav => $xSecc )                                                // recorro todo el array hasta extraer datos relacionados con geotag
          {
            if ( strtolower( $sClav ) == "gps" )
              $aExif = $xSecc;
          }
          //var_dump( $aExif );
          if ( empty( $aExif ) )
            $bExif = false;
          //  var_dump( $oExif );
          $aRecord = array();
          foreach ( $aAux2 as $iCamp => $sCamp )                                                // se repite la logica segun los campos de interes en el array aAuxi
          {
            if ( isset( $aExif[$sCamp] ) )                                                      // si esta seteado el campo
            {
              $dCoor = 0;
              foreach( $aExif[$sCamp] as $iPosi => $sPosi )                                     // recorro el array de valor de grados, minutos y segundo y se convierte a decimal
              {
                $aPosi = explode( "/", $sPosi );
                $dPosi = $aPosi[0]/$aPosi[1];
                if ( $iPosi == 1 )
                  $dPosi = $dPosi / 60;
                else if ( $iPosi == 2 )
                  $dPosi = $dPosi / 3600;
                $dCoor += $dPosi;
              }
              if ( $aExif[$sCamp.'Ref'] == "S" || $aExif[$sCamp.'Ref'] == "W" )                 // referencia de latitud sur o longitud oeste hace que el valor sea negativo
                $dCoor = -1 * $dCoor;
              $sAuxi = $sCamp == "GPSLatitude" ? "regilati" : "regilong";                       // segun el valor del campo en analisis, se define el campo de la entidad regi
              //$aPara[$sAuxi] = $dCoor;                                                          // asignacion del valor de la coordenada en el array que se persistira en la base.
              $aRecord[$sAuxi] = $dCoor;                                                          // asignacion del valor de la coordenada en el array que se persistira en la base.
            }
          }
        }

        // crear instancia
        $oInst = new mimg();
        $aInst = $oInst->set( $aPara );
        
        if ( $bExif )
        {
          $aRecord['regiusua'] = $aPara['mimgfkey'];
          $aRecord['regimimg'] = $aInst['iIden'];
          $aRecord['regiexif'] = json_encode( $oExif );
          $oInst = new regi();
          $aInst = $oInst->set( $aRecord );
        }            
      } 
      
      $_SESSION['oYApp'] = serialize( $oYApp );
      return $aParameters;
    },
    "user-upload-ajax-event-clcik" => function ( $aParameters ) {
      $oYApp = unserialize( $_SESSION['oYApp'] );

      switch ( $aParameters['event']['target-id'] ) {
        case 'form-dropzone-next':
          $i_usuaiden = $oYApp->aModu[ $oYApp->sModu ]['login']['usua'][0]['usuaiden'];

          $oMimg = new mimg ();
          //var_dump( $oMimg );
          $oMimg->aBase['aFilt'][] = "mimg.mimgfcls = 'usua'";
          $oMimg->aBase['aFilt'][] = "mimg.mimgfkey = '$i_usuaiden'";
          $oMimg->aBase['aFilt'][] = "mimg.mimgbatc = '".$aParameters['data']['mimgbatc']."'";
          $oMimg->busc();
          $aMimg = $oMimg->resuConRela();
          
          $i_records_quantity = 0;
          foreach ( $aMimg as $iMimgInst => $aMimgInst ) 
          {
            //var_dump( $aMimgInst );
            if ( ! empty( $aMimgInst['regi'] ) )
              $i_records_quantity++;
          }

          $aParameters['content']['text-photos-quantity'] = count( $aMimg );
          $aParameters['content']['text-records-quantity'] = $i_records_quantity;
          break;
        default:
          break;
      }

      $_SESSION['oYApp'] = serialize( $oYApp );
      return $aParameters;
    },
  ),
  "user/my-pictures" => array(
    "user-my-pictures-no-session" => function ( $aParameters ) { 
      header( "location: ".FMWK_CLIE_SERV );
      return $aParameters;
    },
    "user-my-pictures-session" => function ( $aParameters ) {
      $oYApp = unserialize( $_SESSION['oYApp'] );

      $i_usuaiden = $oYApp->aModu[ $oYApp->sModu ]['login']['usua'][0]['usuaiden'];

      $oMimg = new mimg ();
      $oMimg->aBase['aFilt'][] = "mimg.mimgfcls = 'usua'";
      $oMimg->aBase['aFilt'][] = "mimg.mimgfkey = '$i_usuaiden'";
      $oMimg->busc();
      $aMimg = $oMimg->resu();

      $oYApp->aModu[ $oYApp->sModu ]['mimg'] = $aMimg;

      $aParameters['control']['link-app-title']    = false;
      $aParameters['control']['link-user-login']   = false;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = false;
      $aParameters['control']['button-view-data']  = true;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = true;
      $aParameters['control']['dropdown-alerts']   = true;
      $aParameters['control']['dropdown-user']     = true;

      $_SESSION['oYApp'] = serialize( $oYApp );
      return $aParameters;
    },    
    "user-my-pictures-ajax" => function ( $aParameters ) { 
      return $aParameters;
    },
  ),
  "user/records-review" => array(
    "user-records-review-no-session" => function ( $aParameters ) { 
      header( "location: ".FMWK_CLIE_SERV );
      return $aParameters;
    },
    "user-records-review-session" => function ( $aParameters ) { 

      $aParameters['control']['link-app-title']    = false;
      $aParameters['control']['link-user-login']   = false;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = false;
      $aParameters['control']['button-view-data']  = true;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = true;
      $aParameters['control']['dropdown-alerts']   = true;
      $aParameters['control']['dropdown-user']     = true;

      return $aParameters;
    },
    "user-records-review-ajax" => function ( $aParameters ) { 
      //var_dump( "user-records-review-ajax" );

      switch ( $aParameters['event']['target-name'] ) {
        case 'button-record-approve':
          $a_regi = array(
            "regiiden" => $aParameters['data']['record_id'],
            "regiapro" => 1
          );

          $o_regi = new regi ();
          $a_regi= $o_regi->set( $a_regi );
          
          break;
        case 'button-record-reject':
          $a_regi = array(
            "regiiden" => $aParameters['data']['record_id'],
            "regiapro" => 0
          );

          $o_regi = new regi ();
          $a_regi= $o_regi->set( $a_regi );
          
          break;
        case 'validate':
          $i_regiiden = $aParameters['data']['record_id'];

          $o_regi = new regi ();
          $o_regi->aBase['aFilt'][] = "regi.regiiden = '$i_regiiden'";
          $o_regi->busc();
          $a_regi= $o_regi->resuConRela();
          
          $s_regiubic = "//maps.googleapis.com/maps/api/staticmap";
          $s_regiubic .= "?center=".$a_regi[0]['regilati'].",".$a_regi[0]['regilong'];
          $s_regiubic .= "&zoom=13&size=259x200&maptype=roadmap";
          $s_regiubic .= "&markers=color:blue|label:S|".$a_regi[0]['regilati'].",".$a_regi[0]['regilong'];

          $aParameters['content']['record_iden'] = $a_regi[0]['regiiden'];
          $aParameters['content']['regiexif'] = $a_regi[0]['regiexif'];
          $aParameters['content']['regiubic'] = $s_regiubic;
          $aParameters['content']['mimgnomb_review'] = $a_regi[0]['mimg'][0]['mimgnomb_review'];
          break;
        default:
          break;
      }
      
      return $aParameters;
    },
  ),
);

$aLandscape['species'] = array(
  "species" => array(
    "species-no-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = true;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = false;
      $aParameters['control']['dropdown-alerts']   = false;
      $aParameters['control']['dropdown-user']     = false;
      return $aParameters;
    },
    "species-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = false;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = true;
      $aParameters['control']['dropdown-alerts']   = true;
      $aParameters['control']['dropdown-user']     = true;
      return $aParameters;
    },
    "species-ajax" => function ( $aParameters ) {
      return $aParameters;
    },
  ),
  "species/mammals" => array(
    "species-mammals-no-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = true;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = false;
      $aParameters['control']['dropdown-alerts']   = false;
      $aParameters['control']['dropdown-user']     = false;
      return $aParameters;
    },
    "species-mammals-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = false;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = true;
      $aParameters['control']['dropdown-alerts']   = true;
      $aParameters['control']['dropdown-user']     = true;
      return $aParameters;
    },
    "species-mammals-ajax" => function ( $aParameters ) {
      return $aParameters;
    },
  ),
  "species/records" => array(
    "species-records-no-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = true;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = false;
      $aParameters['control']['dropdown-alerts']   = false;
      $aParameters['control']['dropdown-user']     = false;
      return $aParameters;
    },
    "species-records-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = false;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = true;
      $aParameters['control']['dropdown-alerts']   = true;
      $aParameters['control']['dropdown-user']     = true;
      return $aParameters;
    },
    "species-records-ajax" => function ( $aParameters ) {
      return $aParameters;
    },
  ),
);

$aLandscape['specie'] = array(
  "specie" => array(
    "specie-no-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = true;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = false;
      $aParameters['control']['dropdown-alerts']   = false;
      $aParameters['control']['dropdown-user']     = false;
      return $aParameters;
    },
    "specie-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = false;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = true;
      $aParameters['control']['dropdown-alerts']   = true;
      $aParameters['control']['dropdown-user']     = true;
      return $aParameters;
    },
    "specie-ajax" => function ( $aParameters ) {
      return $aParameters;
    },
  ),
  "specie/records" => array(
    "specie-records-no-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = true;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = false;
      $aParameters['control']['dropdown-alerts']   = false;
      $aParameters['control']['dropdown-user']     = false;
      return $aParameters;
    },
    "specie-records-session" => function ( $aParameters ) {
      $aParameters['control']['link-app-title']    = true;
      $aParameters['control']['link-user-login']   = false;
      $aParameters['control']['form-top-search']   = true;
      $aParameters['control']['buttons-views']     = true;
      $aParameters['control']['button-view-data']  = false;
      $aParameters['control']['buttons-actions']   = false;
      $aParameters['control']['dropdown-messages'] = true;
      $aParameters['control']['dropdown-alerts']   = true;
      $aParameters['control']['dropdown-user']     = true;
      return $aParameters;
    },
    "specie-records-ajax" => function ( $aParameters ) {
      return $aParameters;
    },
  ),
);
*/