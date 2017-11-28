<?php

    $this->addBreadcrumb(LANG_FEEDBACK_HANDLINGS, $this->href_to('handlings'));

    if ($do == 'add') { 
        $page_title = LANG_FEEDBACK_ADD_HANDLING; 
    }

    if ($do == 'edit') { 
        $page_title = LANG_FEEDBACK_EDIT_HANDLING; 
    }

    $this->setPageTitle($page_title);
    $this->addBreadcrumb($page_title);

    $this->renderForm($form, $handling, array(
            'action' => '',
            'method' => 'post',
            'toolbar' => false
    ), $errors);
