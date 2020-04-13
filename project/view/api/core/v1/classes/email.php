<?php

// variables
    $s_script_folder = dirname( __FILE__ );
    $s_vendor_folder = $s_script_folder."/../vendor/";

// librerias

    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    //require $s_vendor_folder . 'autoload.php';

class email {
    
    public function send( $a_params = null ) {

        $s_operator = $a_params['operator'];
        $s_country  = $a_params['country'];
        $s_attach   = $a_params['attach'];
        $s_date     = date("Y.m.d H");

        $mail = new PHPMailer(true);
        //var_dump( $mail );
        
        $a_smtp = array(
            "host" => "smtp.gmail.com",
            "name" => "Media Moob", 
            "user" => "plataforma@memoob.com",
            "pass" => "plat**2019",
            "port" => 587,
        );

        $a_recipients = array(
            "to" => array(
                array('ariel@memoob.com', 'Ariel Miranda'),
            ),
        );

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;              // Enable verbose debug output
        $mail->isSMTP();                                    // Send using SMTP
        $mail->Host       = $a_smtp['host'];                // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                           // Enable SMTP authentication
        $mail->Username   = $a_smtp['user'];                // SMTP username
        $mail->Password   = $a_smtp['pass'];                // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = $a_smtp['port'];                // TCP port to connect to

        //Recipients
        $mail->setFrom( $a_smtp['user'], $a_smtp['name'] );
        
        foreach( $a_recipients['to'] as $i_recipient => $a_recipient )
            $mail->addAddress( $a_recipient[0], $a_recipient[1] );  // Add a recipient
        
        if ( isset( $a_recipients['cc'] ) )
        {
            foreach( $a_recipients['cc'] as $i_recipient => $a_recipient )
                $mail->addAddress( $a_recipient[0], $a_recipient[1] );  // Add a recipient
        }

        $mail->addReplyTo( $a_smtp['user'], $a_smtp['name'] );
        
        // Attachments
        $mail->addAttachment($s_attach);         // Add attachments
        
        // Content
        $s_subject  = "API Manager - Log - $s_operator - $s_country - $s_date";
        $s_body     = "logs";
        $s_alt_body = "";

        if ( $s_alt_body == "" )
            $s_alt_body = $s_body;

        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $s_subject;
        $mail->Body    = $s_body;
        $mail->AltBody = $s_alt_body;

        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->send();
    }

}