<?php

    $this->setPageTitle($handling['title']);
	
    $this->addBreadcrumb(LANG_FEEDBACK_CONTROLLER, $this->href_to(''));
    $this->addBreadcrumb(LANG_FEEDBACK_HANDLINGS, $this->href_to('handlings'));
    $this->addBreadcrumb($handling['title']);

    $this->addToolButton(array(
        'class' => 'edit',
        'title' => LANG_FEEDBACK_EDIT_HANDLING,
        'href' => $this->href_to('edit_handling', $handling['id'])
    ));

    $this->addToolButton(array(
        'class' => 'delete',
        'title' => LANG_FEEDBACK_DELETE_HANDLING,
        'href' => $this->href_to('delete_handling', $handling['id'])
    ));

?>

<h1><?php echo LANG_FEEDBACK_IS_EDIT; ?></h1>
<a href='/feedback/handlings'><?php echo LANG_FEEDBACK_BUTTOM_BACK; ?> </a>
<div id="feedback-handling">
	<div class="name"><?php echo $handling['name']; ?></div>
	<div class="phone"><?php echo $handling['phone']; ?></div>
	<div class="url"><?php echo $handling['url']; ?></div>
</div>
