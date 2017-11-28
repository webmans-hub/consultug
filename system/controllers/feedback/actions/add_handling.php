<?php

class actionFeedbackAddHandling extends cmsAction {
	
    public function run(){

        $errors = false;
        
        if(!cmsUser::isAdmin()){cmsCore::error404();}

        $form = $this->getForm('handling');

        $is_submitted = $this->request->has('submit');

        $handling = $form->parse($this->request, $is_submitted);

        if ($is_submitted){

            $errors = $form->validate($this, $handling);

            if (!$errors){
                $handling_id = $this->model->addHandling($handling);
                print_r($handling);
                //$this->redirectToAction('handling', array($handling_id));
            }

            if ($errors){
                cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
            }

        }

        $template = cmsTemplate::getInstance();

        return $template->render('form_handling', array(
            'do' => 'add',
            'form' => $form,
            'errors' => $errors,
            'handling' => $handling
        ));

    }
	
}