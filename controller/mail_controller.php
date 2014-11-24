<?php 
	/**
	* 
	*/
	require_once('libs/PHPMailer/class.phpmailer.php');

	class MailController 
	{
		
		function __construct()
		{
			$this->mail = new PHPMailer(true);
			$this->password = file_get_contents("/home/francisco/miclave.txt");
			$this->mail->IsSMTP(); // telling the class to use SMTP
			$this->mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
			$this->mail->SMTPAuth   = true;                  // enable SMTP authentication
			$this->mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$this->mail->Host       = $this->host;      // sets GMAIL as the SMTP server
			$this->mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$this->mail->Username   = $this->username;  // GMAIL username
			$this->mail->Password   = $this->password;            // GMAIL password
		}

		private $mail;
		private $host = "smtp.gmail.com";
		private $username = "franciscogallazzi@gmail.com";
		

		private $password = "";

		public function send($destino,$nombre,$subject,$mensaje){
			try {
				$this->mail->AddAddress($destino, $nombre);
				$this->mail->SetFrom($this->username, 'Trastos.com');
				//$this->mail->AddReplyTo('name@yourdomain.com', 'First Last');
				$this->mail->Subject = $subject;
				//$this->mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
				$this->mail->MsgHTML($mensaje);
				//$this->mail->AddAttachment('images/phpmailer.gif');      // attachment
				//$this->mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
				$this->mail->Send();
				//echo "Message Sent OK</p>\n";
			} catch (phpmailerException $e) {
			  	//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			  	return false;
			} catch (Exception $e) {
			  	//echo $e->getMessage(); //Boring error messages from anything else!
			  	return false;
			}
			return true;
		}
	}
 ?>