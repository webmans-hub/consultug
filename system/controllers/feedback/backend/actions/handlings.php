<?php

class actionFeedbackHandlings extends cmsAction {

    public function run(){

        $grid = $this->loadDataGrid('handlings');

        return cmsTemplate::getInstance()->render('backend/handlings', array(
            'grid' => $grid
        ));

    }

}
