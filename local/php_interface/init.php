<?
require($_SERVER['DOCUMENT_ROOT'] . '/local/include_files/PHPMailer/PhpMailerAutoload.php');

function custom_mail($to, $subject, $message, $additional_headers = '', $additional_parameters = '')
{
	$mail = new PHPMailer\PHPMailer\PHPMailer;

	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'kermesovich1@gmail.com';
	$mail->Password = 'kermes1960';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->CharSet = 'UTF-8';
	
	if($adminUser = CUser::GetByLogin('sergeykapica'))
	{
		$data = $adminUser->fetch();
		$mail->setFrom($data['EMAIL'], 'Уведомление с сайта ' . SITE_SERVER_NAME);
	}

	$mail->addAddress($to);
	$mail->isHTML(true);       
	$mail->setLanguage('ru');
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->send();
	
	return true;
}
?>