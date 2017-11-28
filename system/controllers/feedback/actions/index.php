<?php

class actionFeedbackIndex extends cmsAction{

    public function run(){

        $user = cmsUser::getInstance();
        $template = cmsTemplate::getInstance();

        return $template->render('index', array(
            'message' => LANG_FEEDBACK_CONTROLLER,
        ));

    }

}
