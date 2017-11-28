<?php
class widgetWriteme extends cmsWidget {

    public function run(){
		
		$req['name'] = $this->getOption('req_name');
		$req['phone'] = $this->getOption('req_phone');
		$req['mail'] = $this->getOption('req_mail');
		$req['subject'] = $this->getOption('req_subject');
		$req['message'] = $this->getOption('req_message');
		$required = "";
		foreach($req as $key=>$r){
			if($r == 1){
				$required .= '"'.$key.'",';
			}
		}
		$required = substr($required, 0, -1);
		
        return array(
			'mail' => $this->getOption('email'), 
			'copy_mail' => $this->getOption('email_copy'),
			'side' => $this->getOption('side'),
			'required' => $required,
			
			
        );

    }

}
