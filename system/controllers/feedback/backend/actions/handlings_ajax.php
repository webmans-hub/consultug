<?php

class actionFeedbackHandlingsAjax extends cmsAction {

    public function run(){

        if (!$this->request->isAjax()) { cmsCore::error404(); }

        $grid = $this->loadDataGrid('handlings');

        $model = cmsCore::getModel($this->name);
 
        $model->setPerPage(admin::perpage);
 
        $filter = array(); 
        $filter_str = $this->request->get('filter', ''); 
        $filter_str = cmsUser::getUPSActual('feedback.handlings_list', $filter_str);
 
        if ($filter_str){
            parse_str($filter_str, $filter);
            $model->applyGridFilter($grid, $filter);
        }

        $total = $model->getHandlingsCount(); 
        $perpage = isset($filter['perpage']) ? $filter['perpage'] : admin::perpage; 
        $pages = ceil($total / $perpage);

        $handlings = $model->getHandlings();

        cmsTemplate::getInstance()->renderGridRowsJSON($grid, $handlings, $total, $pages);

        $this->halt();

    }

}
