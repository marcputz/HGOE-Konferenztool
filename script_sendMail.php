<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './frameworks/PHPMailer/src/Exception.php';
require './frameworks/PHPMailer/src/PHPMailer.php';
require './frameworks/PHPMailer/src/SMTP.php';

if(isset($_POST['to']) && isset($_POST['msg_body']) && isset($_POST['msg_title']) && isset($_POST['subject'])) {
	$mail = new PHPMailer(true);                              // Passing 'true' enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0;                                 // Disable debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.sprit.org';  					  // Specify SMTP server
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'web-admin';     // SMTP username
		$mail->Password = 'fidelio123456@!';                  // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;								      // TCP port to connect to
		$mail->CharSet = 'UTF-8';

		//Recipients
		$mail->setFrom('web-admin@hgoe-burgenland.at', 'HGÖ Burgenland');
		$mail->addAddress($_POST['to']);                      // Add a recipient
		
		//make html msg
		$html = '<body style="background-color: rgb(215, 228, 233);">';
		$html .= '	<style>';
		$html .= '		@import url("https://fonts.googleapis.com/css?family=Open+Sans");';
		$html .= '	</style>';		
		$html .= '	<span style="font-family: Open Sans, Arial, sans-serif; width: 100%;">';
		$html .= '		<div style="width: 100%; text-align: center; margin-top: 20px; height: 86px; line-height: 86px;">';
		$html .= '			<a href="www.hgoe-burgenland.at" style="margin: 8px; filter: drop-shadow(1px 2px 3px #444);">';
		$html .= '				<img style="height: 70px;" src="http://hgoe-burgenland.at/konferenztool/admin/assets/img/hgoe_logo_breitbild.png">';
		$html .= '			</a>';
		$html .= '		</div>';
		$html .= '		<div style="border: 1px solid #000; margin: 30px; margin-top: 10px; padding: 30px; background-color: #FFF; box-shadow: 3px 3px 5px #777 ;">';
		$html .= '			<div style="margin-bottom: 30px;">';
		$html .= '				' . $_POST['msg_title'];
		$html .= '			</div>';
		$html .= '			<div style="margin-top: 30px; margin-bottom: 30px;">';
		$html .= '				' . $_POST['msg_body'];
		$html .= '			</div>';
		$html .= '			<div>';
		$html .= '				Mit freundlichen Grüßen<br>';
		$html .= '				<b>Ihr HGÖ Team</b>';
		$html .= '			</div>';
		$html .= '		</div>';
		$html .= '	</span>';
		$html .= '</body>';

		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = $_POST['subject'];
		$mail->Body    = $html;
		$mail->AltBody = $_POST['msg_title'] . "\n\n" . $_POST['msg_body'] . "\n\nMit freundlichen Grüßen\nIhr HGÖ Team";

		$mail->send();
		echo 'DEBUG: Nachricht wurde gesendet!';
	} catch (Exception $e) {
		echo 'ERROR: Nachricht konnte nicht gesendet werden. ' . $mail->ErrorInfo;
	}
} else {
	echo 'ERROR: Script-Fehler. Benötigte Parameter fehlen';
}
?>