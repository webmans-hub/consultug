<?php

class actionMessagesRefresh extends cmsAction {

    public function run(){

        $contact_id = $this->request->get('contact_id', 0) or cmsCore::error404();
        $last_date  = $this->request->get('last_date', '');

        $contact = $this->model->getContact($this->cms_user->id, $contact_id);

        if (!$contact){ $this->cms_template->renderJSON(array('error' => true)); }

        $messages = $this->model->filterEqual('is_new', 1)->getMessagesFromContact($this->cms_user->id, $contact_id);

        if ($messages){

            $messages_html = $this->cms_template->render('message', array(
                'messages'  => $messages,
                'last_date' => $last_date,
                'is_notify' => true,
                'user'      => $this->cms_user
            ), new cmsRequest(array(), cmsRequest::CTX_INTERNAL));

            $this->model->setMessagesReaded($this->cms_user->id, $contact_id);

        }

        $this->cms_template->renderJSON(array(
            'error'      => false,
            'contact_id' => $contact['contact_id'],
            'is_online'  => (int) $contact['is_online'],
            'date_log'   => mb_strtolower(string_date_age_max($contact['date_log'], true)),
            'html'       => ($messages ? $messages_html : false)
        ));

    }

}
