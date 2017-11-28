<?php

class actionFeedbackDeleteHandling extends cmsAction {
	
    public function run($id=false){
        
        if(!cmsUser::isAdmin()){cmsCore::error404();}
        
        if (!$id) { cmsCore::error404(); }

        $handling = $this->model->getHandling($id);

        if (!$handling) { cmsCore::error404(); }

        $user = cmsUser::getInstance();

        $is_can_delete = true;

        if (!$is_can_delete) { cmsCore::error404(); }

        $this->model->deleteHandling($id);

        $this->redirectToAction('handlings');

    }

}