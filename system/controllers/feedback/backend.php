<?php

class backendFeedback extends cmsBackend {
   
    public $useDefaultOptionsAction = true;

    public function actionIndex(){
        $this->redirectToAction('options');
    }

    public function getBackendMenu(){
        return array(
            array(
                'title' => LANG_FEEDBACK_BACKEND_TAB_OPTIONS,
                'url' => href_to($this->root_url, 'options')
            ),
            /*{comgen-backend-menu}*/

            array(
                'title' => LANG_FEEDBACK_HANDLINGS,
                'url' => href_to($this->root_url, 'handlings')
            ),
        );
    }

}
