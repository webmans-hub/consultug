<?php

    $this->addBreadcrumb(LANG_FEEDBACK_CONTROLLER, $this->href_to(''));

    if ($do == 'add') { 
        $page_title = LANG_FEEDBACK_ADD_HANDLING; 
    }

    if ($do == 'edit') { 
        $page_title = LANG_FEEDBACK_EDIT_HANDLING; 
        $this->addBreadcrumb($handling['title'], $this->href_to('handling', $handling['id']));
    }

    $this->setPageTitle($page_title);

    $this->addBreadcrumb($page_title);

?>

<h1><?php echo $page_title; ?></h1> 

<?php
    $this->renderForm($form, $handling, array(
            'action' => '',
            'method' => 'post',
            'toolbar' => false
    ), $errors);
