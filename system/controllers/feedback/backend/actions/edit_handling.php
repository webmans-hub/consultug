<?php

class actionFeedbackEditHandling extends cmsAction {
	
    public function run($id=false){

        if (!$id) { cmsCore::error404(); }

        $model = cmsCore::getModel($this->name);

        $handling = $this->model->getHandling($id);

        if (!$handling) { cmsCore::error404(); }

        $errors = false;

        $form = $this->getForm('handling');

        $is_submitted = $this->request->has('submit');				

        if ($is_submitted){

            $handling = $form->parse($this->request, $is_submitted);

            $errors = $form->validate($this, $handling);

            if (!$errors){
                $model->updateHandling($id, $handling);
                $this->redirectToAction('handlings');
            }

            if ($errors){
                cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
            }

        }

        $template = cmsTemplate::getInstance();

        return $template->render('backend/form_handling', array(
            'do' => 'edit',
            'form' => $form,
            'errors' => $errors,
            'handling' => $handling
        ));

    }
	
}