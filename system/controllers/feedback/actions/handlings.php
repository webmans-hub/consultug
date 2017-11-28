<?php

class actionFeedbackHandlings extends cmsAction {
	
    public function run(){
        
        if(!cmsUser::isAdmin()){cmsCore::error404();}
        
        $page = $this->request->get('page', 1);		
        $perpage = 15;

        $template = cmsTemplate::getInstance();

        $total = $this->model->getHandlingsCount();

        $this->model->limitPage($page, $perpage);

        $this->model->orderBy('id', 'desc');

        $handlings = $this->model->getHandlings();

        return $template->render('handlings', array(
            'handlings' => $handlings,
            'total' => $total,
            'page' => $page,
            'perpage' => $perpage
        ));

    }
	
}