<?php

class actionFeedbackAddHandling extends cmsAction {
	
    public function run(){

        $errors = false;

        $model = cmsCore::getModel($this->name);

        $form = $this->getForm('handling');

        $is_submitted = $this->request->has('submit');

        $handling = $form->parse($this->request, $is_submitted);

        if ($is_submitted){

            $errors = $form->validate($this, $handling);

            if (!$errors){
                $handling_id = $model->addHandling($handling);
                $this->redirectToAction('handlings');
            }

            if ($errors){
                cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
            }

        }

        $template = cmsTemplate::getInstance();

        return $template->render('backend/form_handling', array(
            'do' => 'add',
            'form' => $form,
            'errors' => $errors,
            'handling' => $handling
        ));

    }
	
}