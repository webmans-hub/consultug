<?php
	
    $this->setPageTitle(LANG_FEEDBACK_HANDLINGS);
    $this->addBreadcrumb(LANG_FEEDBACK_CONTROLLER);
	
    $this->addToolButton(array(
        'class' => 'add',
        'title' => LANG_FEEDBACK_ADD_HANDLING,
        'href' => $this->href_to('add_handling')
    ));

?>

<h1><?php echo LANG_FEEDBACK_HANDLINGS; ?></h1>

<?php if (!$handlings) { ?>
	<p><?php echo LANG_FEEDBACK_HANDLINGS_NONE; ?></p>
	<?php return; ?>
<?php } ?>

<table class="feedback-handlings-list">
    <tr>
         <th><?php echo LANG_FEEDBACK_LIST_ITEM_DATE; ?></th>
         <th><?php echo LANG_FEEDBACK_LIST_ITEM_NAME; ?></th>
         <th><?php echo LANG_FEEDBACK_LIST_ITEM_PHONE; ?></th>
         <th><?php echo LANG_FEEDBACK_LIST_ITEM_URL; ?></th>
         <th><?php echo LANG_FEEDBACK_LIST_ITEM_BUTTOM; ?></th>
    </tr>
    <?php foreach($handlings as $handling) { ?>
      <tr class="feedback-handling item">
        <td class="date_handing"><?php echo $handling['date_handing']; ?></td>
        <td class="name"><?php echo $handling['name']; ?></td>
        <td class="phone"><?php echo $handling['phone']; ?></td>
        <td class="url"><?php echo $handling['url']; ?></td> 
        <td class="button_click"><?php echo $handling['button_click']; ?></td>
        <td class="edit"><a href="<?php echo '/feedback/edit_handling/'.$handling['id']; ?>"><?php echo LANG_FEEDBACK_EDIT_HANDLING; ?></a></td>
      </tr>
    <?php } ?>
</table>
	
<?php if($total > $perpage) { ?>
    <?php echo html_pagebar($page, $perpage, $total); ?>	
<?php } ?>
