<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

class mail
{
  public $sFrom = "Bot Test - Contact <contact@bot.com>";
  public $sRepl = "Bot Test - Contact <contact@bot.com>";
  public $aCopi = array();
  public $aBCop = array();
  
  public function send( $aPara )
	{
    //echo "mail.send <br /> \n";
    global $APP_CONFIGURATION;

    // inicializacion de variables
    $aPara['aDest'] = ( isset( $aPara['aDest'] ) )? $aPara['aDest'] : array();
    $aPara['aCopi'] = ( isset( $aPara['aCopi'] ) )? $aPara['aCopi'] : array();
    $aPara['aBCop'] = ( isset( $aPara['aBCop'] ) )? $aPara['aBCop'] : array();
    $aPara['sMsje'] = ( isset( $aPara['sMsje'] ) )? $aPara['sMsje'] : "";
    $aPara['bDbug'] = ( isset( $aPara['bDbug'] ) )? $aPara['bDbug'] : false;
    $bDbug = $aPara['bDbug'];
    $sCopi = "";
    $sBCop = "";
    $sCont = "";
    $sFrom = $this->sFrom;
    $sRepl = ( ! isset( $aPara['sRepl'] ) )? $this->sRepl : $aPara['sRepl'];
    $aCopi = $this->aCopi;
    $aBCop = $this->aBCop;

    // 2020.01.26 - Acceso y control a configuracion global
    if ( isset( $APP_CONFIGURATION['ambientes'] ) && ! FMWK_AMBI_DESA )
    {
      $s_ambiente = FMWK_AMBI_CALI ? "stage" : "produccion";
      $a_config   = $APP_CONFIGURATION['ambientes'][ $s_ambiente ]['email'];

      if ( isset( $a_config['from'] ))
        $sFrom = $a_config['from'];

      if ( isset( $a_config['replay'] ))
        $sRepl = $a_config['replay'];      
    }

    /*/ solo para testeo -------------------------------------------------------
    $bDbug = true;
    // solo para testeo ------------------------------------------------------*/
    
    if ( isset( $aPara['sTemp'] ) )
    {
      // obtener template
      $sRuta = FMWK_CLIE_SERV."project/php/mail/";                                      // ruta donde se deben encontrar los templates de los mails
      $sRuta .= $aPara['sTemp'];                                                // se construye la ruta con el template pasado dentro de los parametros
      //var_dump( $sRuta );
      $oArch = fopen( $sRuta, "r" );                                            // se abre el archivo en modo lectura
      $sCont = stream_get_contents( $oArch );                                   // se obtiene el contenido del archivo
      // insertar datos en el template 
      if( isset( $aPara['aDato'] ) )
      {
        foreach( $aPara['aDato'] as $sEnti => $aInst )                          // se recorre el array de datos, cuya estructura se encuentra separada por entidad
        {
          $sBloq = "";                                                          // guarda string si existe bloque de datos.
          $sAux2 = "";                                                          // guardara el string con todas las instancias del bloque.
          
          if ( count( $aInst ) > 1 )                                            // se evalua si array tiene varios elementos. si es mayor a 1 significa bloque de datos
          {
            $sEtiq = "[$sEnti]";                                                // la etiqueta que delimita el bloque debe llevar el nombre de la entidad
            $iLong = strlen( $sEtiq );                                          // longitud de la etiqueta
            $iEtii = strpos( $sCont, $sEtiq );                                  // posicion de la primer etiqueta
            $iEtif = strrpos( $sCont, $sEtiq );;                                // posicion de la ultima etiqueta
            if ( $iEtii !== false && $iEtif !== false )
              $sBloq = substr( $sCont, $iEtii + $iLong, $iEtif-$iEtii-$iLong );   // se obtiene el contenido desde la posicion anterior hasta el final del archivo
          }
          
          foreach( $aInst as $iPosi => $aCamp )                                 // separada por instancias de la entidad
          {
            if ( $sBloq == "" )
            {
              foreach( $aCamp as $sCamp => $xValo )                             // dentro de cada instancia un array campo:valor
                $sCont = str_replace( "[$sCamp]", $xValo, $sCont );             // reemplazo los tags del template del mail por los valores extraidos de las instancias. 
            }
            else
            {
              $sAux1 = $sBloq;                                                  // guarda string de la instancia del bloque
              foreach( $aCamp as $sCamp => $xValo )                             // dentro de cada instancia un array campo:valor
                $sAux1 = str_replace( "[$sCamp]", $xValo, $sAux1 );             // reemplazo los tags del template del mail por los valores extraidos de las instancias. 
              $sAux2 .= $sAux1;                                                 // se guarda la instancia modificada
            }
          }
          if ( $sBloq != "" )
            $sCont = substr_replace($sCont,$sAux2,$iEtii, $iEtif-$iEtii+$iLong); // se reemplaza el contenido entre las posiciones del tag
          $sCont = str_replace( "[$sEnti]", "", $sCont );
        }
      }
    }
    // construccion de los valores de copia y copia oculta para la cabecera
    $aAuxi = array(
      array_merge( $aCopi, $aPara['aCopi'] ),
      array_merge( $aBCop, $aPara['aBCop'] ),
    );
    foreach( $aAuxi as $iPosi => $aPosi )
    {
      foreach( $aPosi as $iMail => $sMail )
      {
        if ( $iPosi == 0 )
          $sCopi .= (( $sCopi != "" )? ", " : "")."$sMail";
        else
          $sBCop .= (( $sBCop != "" )? ", " : "")."$sMail";
      }
    }

    /*/ 2020.02.04 - DEBUG PARA IMPLEMENTAR PHPMailer
    var_dump( $sCopi );
    var_dump( $sBCop );
    var_dump( $aPara['sTitu'] );
    var_dump( $sCont );
    var_dump( $aPara['sMsje'] );
    //*/

    // -----------------------------------------------------------------------------------------------------------------
    // 2020.02.04
    // fuera de estas lineas es para mantener la compatibilidad hacia atras y para realizar una rapida implementacion

    //if ( ! $bDbug && ! FMWK_AMBI_DESA )
    if ( false )
    {
        
        // variables
        $a_accounts = array();
        //var_dump( $a_accounts );

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        //var_dump( $mail );

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;              // Enable verbose debug output
        $mail->isSMTP();                                    // Send using SMTP
        $mail->Host       = $a_accounts[0]['host'];         // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                           // Enable SMTP authentication
        $mail->Username   = $a_accounts[0]['user'];         // SMTP username
        $mail->Password   = $a_accounts[0]['pass'];         // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = $a_accounts[0]['port'];         // TCP port to connect to

        //Recipients
        $mail->setFrom( $a_accounts[0]['user'], $a_accounts[0]['name'] );
            
        if ( FMWK_AMBI_CALI )
        {
          $mail->addAddress( "mirandaariel@gmail.com", "" );
        }
        else if ( FMWK_AMBI_PROD )
        {
            foreach( $aPara['aDest'] as $iPosi => $sDest )
                $mail->addAddress( $sDest, "" );  // Add a recipient
        }
        else
        {
          $mail->addAddress( "mirandaariel@gmail.com", "" );
        }
            
        // la posicion 0 corresponde a las copias.
        if ( FMWK_AMBI_PROD )
        {
            if ( ! empty( $aAuxi[0] ) )
            {
                foreach( $aAuxi[0] as $i_recipient => $s_recipient )
                {
                    //var_dump( $s_recipient ); 
                    $mail->addAddress( $s_recipient, "" );  // Add a recipient
                }
            }
        }

        $mail->addReplyTo( $a_accounts[0]['user'], $a_accounts[0]['name'] );
            
        // Attachments
        // $mail->addAttachment($s_attach);         // Add attachments
            
        // Content
        $s_subject  = $aPara['sTitu'];
        $s_body     = $sCont;
        $s_alt_body = "";

        if ( $s_alt_body == "" )
          $s_alt_body = $s_body;
        
        $mail->CharSet = 'utf-8';

        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $s_subject;
        $mail->Body    = $s_body;
        $mail->AltBody = $s_alt_body;

        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        
        try {
            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        /*
        //*/
    }
    // -----------------------------------------------------------------------------------------------------------------

    if ( $bDbug )
      return $sBody;

	}
}