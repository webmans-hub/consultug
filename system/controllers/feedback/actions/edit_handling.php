<?php

class actionFeedbackEditHandling extends cmsAction {
	
    public function run($id=false){
        
        if(!cmsUser::isAdmin()){cmsCore::error404();}
        
        if (!$id) { cmsCore::error404(); }

        $handling = $this->model->getHandling($id);

        if (!$handling) { cmsCore::error404(); }

        $user = cmsUser::getInstance();

        $is_can_edit = true;

        if (!$is_can_edit) { cmsCore::error404(); }

        $errors = false;

        $form = $this->getForm('handling');

        $is_submitted = $this->request->has('submit');				

        if ($is_submitted){

            $handling = $form->parse($this->request, $is_submitted);

            $errors = $form->validate($this, $handling);

            if (!$errors){
                $this->model->updateHandling($id, $handling);
                $this->redirectToAction('handling', array($id));
            }

            if ($errors){
                cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
            }

        }

        $template = cmsTemplate::getInstance();

        return $template->render('form_handling', array(
            'do' => 'edit',
            'form' => $form,
            'errors' => $errors,
            'handling' => $handling
        ));

    }
	
}