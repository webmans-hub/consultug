<?php

class actionFeedbackHandling extends cmsAction {
	
    public function run($id = false){
        
        if(!cmsUser::isAdmin()){cmsCore::error404();}
        
        if (!$id) { cmsCore::error404(); }

        $handling = $this->model->getHandling($id);

        if (!$handling) { cmsCore::error404(); }

        $user = cmsUser::getInstance();

        $template = cmsTemplate::getInstance();

        return $template->render('handling', array(
            'handling' => $handling,
        ));

    }
	
}