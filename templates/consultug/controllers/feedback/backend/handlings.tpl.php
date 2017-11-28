<?php

    $this->addBreadcrumb(LANG_FEEDBACK_HANDLINGS);

    $this->addToolButton(array(
        'class' => 'add',
        'title' => LANG_FEEDBACK_ADD_HANDLING,
        'href'  => $this->href_to('add_handling')
    ));

    $this->addToolButton(array(
        'class' => 'save',
        'title' => LANG_SAVE,
        'href'  => null,
        'onclick' => "icms.datagrid.submit('{$this->href_to('handlings_reorder')}')"
    ));

?>

<?php $this->renderGrid($this->href_to('handlings_ajax'), $grid); ?>

<div class="buttons">
    <?php echo html_button(LANG_SAVE_ORDER, 'save_button', "icms.datagrid.submit('{$this->href_to('handlings_reorder')}')"); ?>
</div>
