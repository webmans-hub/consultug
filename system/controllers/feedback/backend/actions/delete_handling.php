<?php

class actionFeedbackDeleteHandling extends cmsAction {
	
    public function run($id=false){

        if (!$id) { cmsCore::error404(); }

        $model = cmsCore::getModel($this->name);

        $handling = $model->getHandling($id);

        if (!$handling) { cmsCore::error404(); }

        $model->deleteHandling($id);

        $this->redirectToAction('handlings');

    }

}