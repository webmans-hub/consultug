<?

Error_Reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);

$name = trim($_POST['name']);
$name = iconv("UTF-8", "windows-1251", $name);

$phone = trim($_POST['phone']);
$emailback = trim($_POST['emailback']);

$message = trim($_POST['message']);
$message = iconv("UTF-8", "windows-1251", $message);

$emailto = trim($_POST['emailto']);
$emailto = base64_decode($emailto);

$emailfrom = trim($_POST['emailfrom']);
$emailfrom = base64_decode($emailfrom);

$emailfromtitle = trim($_POST['emailfromtitle']);
$emailfromtitle = iconv("UTF-8", "windows-1251", $emailfromtitle);


$subject = trim($_POST['subject']);
$subject = iconv("UTF-8", "windows-1251", $subject);


$send="<html><body><h2>".$subject."</h2>";
if($name)	$send.="<p><b>Имя:</b> ".$name."</p>";
if($phone)	$send.="<p><b>Телефон:</b> ".$phone."</p>";
if($emailback)	$send.="<p><b>Email:</b> ".$emailback."</p>";
if($message)	$send.="<p><b>Сообщение:</b> <br/>".$message."</p>";
$send .="</body></html>";


$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 

					$messenger = cmsCore::getController('messages');
                    $to = array('email' => $emailto, 'name' => $emailto);
                    $letter = 'From:'.$emailfromtitle.' <'.$emailfrom.'>' . "\r\n" . $headers;

                    $messenger->sendEmail($to, $letter, array(
                        'nickname' => $emailto,                        
                    ));

/*$mail=mail ($emailto, $subject, $send,'From:'.$emailfromtitle.' <'.$emailfrom.'>' . "\r\n" . $headers);

if($mail){
	//print "Message sended";	
}
else{
	print "There are problems";
}*/


?>
