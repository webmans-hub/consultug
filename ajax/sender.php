<?php

	if(!empty($_POST)){

		require_once "../bootstrap.php";	
		
		$mail = explode(',', $_POST['tomail']);
		
		$run = cmsCore::getController('messages');
		
		foreach($mail as $to){
			if(!empty($to)){
				$result = $run->sendEmail($to, 'writeme', array(
					'name' => $_POST['name'],
					'phone' => $_POST['phone'],
					'mail' => $_POST['mail'],
					'subject' => $_POST['subject'],
					'message' => $_POST['message']
				));
			}
		}
		
		echo $result;
		
	}
	
?>
