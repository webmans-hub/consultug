<?php

class actionFeedbackAjaxAddHandling extends cmsAction {
	
    public function run(){

        //$errors = false;

        //$form = $this->getForm('handling');

        //$is_submitted = $this->request->has('submit');

        //$handling = $form->parse($this->request, $is_submitted);
        $handling = array();
        $handling['name'] = $this->request->get('feedback-name');		
        $handling['phone'] = $this->request->get('feedback-phone');
        $handling['date_handing'] = date("Y-m-d H:i:s");
        $handling['url'] = $this->request->get('feedback-url');
        $handling['button_click'] = $this->request->get('feedback-form-button');
        
        
        $error = false;
//        if ($is_submitted){
//
//            $errors = $form->validate($this, $handling);
//
//            if (!$errors){
                  $handling_id = $this->model->addHandling($handling);
                  if($handling_id){
                    $error = true;
					$messenger = cmsCore::getController('messages');
					$to = array('email' => 'ocenka@consultug.ru', 'name' => 'Консалтинг-Юг');
                    $letter = array('name' => 'feedback_form');
					$messenger->sendEmail($to, $letter, array(
						'name' => $handling['name'],
						'phone' => $handling['phone'],						
						'date_handing' => $handling['date_handing'],
						'url' => $handling['url'],
                                                'button_click'=> $handling['button_click']
                                                
					));
                  }
//                $this->redirectToAction('handling', array($handling_id));
//            }
//
//            if ($errors){
//                cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
//            }
//
//        }
//        
//        
	//$array = $this->request->get('id');

		//$error = $handling;
        $template = cmsTemplate::getInstance();

        return $template->renderJSON($error);

    }
	
}