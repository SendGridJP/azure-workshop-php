<?php 
    require 'vendor/autoload.php';
	
	class MyMailer
	{
		private $sg_username = "";
		private $sg_password = "";
		
		function __construct()
		{
			/* USER CREDENTIALS
			/  Fill in the variables below with your SendGrid
			/  username and password.
			====================================================*/
			$this->sg_username = getenv("SENDGRID_USERNAME");
			$this->sg_password = getenv("SENDGRID_PASSWORD");
		}

		public function send($to)
		{
			/* CREATE THE SENDGRID MAIL OBJECT
			====================================================*/
			$sendgrid = new SendGrid( $this->sg_username, $this->sg_password, array("turn_off_ssl_verification" => true) );
			$mail = new SendGrid\Email();
			
			/* SEND MAIL
			/  Replace the the address(es) in the setTo/setTos
			/  function with the address(es) you're sending to.
			====================================================*/
			try {
			    $mail->
				    setFrom( "test@sendgridjp.asia" )->
				    addTo( $to )->
				    setSubject( "サンプルメール" )->
				    setText( "こんにちは\n\nこれはサンプルメールです。\nSendGridへようこそ。\nhttp://www.sendgrid.com\n" )->
				    setHtml( "こんにちは<br>\n<br>\nこれはサンプルメールです。<br>\n<a href=\"http://www.sendgrid.com\">SendGrid</a>ようこそ。<br>\n" );
			    
			    $response = $sendgrid->send( $mail );
			
			    if (!$response) {
			        throw new Exception("Did not receive response.");
			    } else if ($response->message && $response->message == "error") {
			        throw new Exception("Received error: ".join(", ", $response->errors));
			    } else {
			        print_r($response);
			    }
			} catch ( Exception $e ) {
			    var_export($e);
			}
		}
	}
	