<?php

class actionPhotobattleAdd extends cmsAction{
    
    public function run(){
        
        $template = cmsTemplate::getInstance();
        $template->addOutput('Add action');
    }
}
?>