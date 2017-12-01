<?php
    $this->setPageTitle(LANG_PHOTOBATTLE_CONTROLLER);
    $this->addBreadcrumb(LANG_PHOTOBATTLE_CONTROLLER);
?>

<a class='add' title='<?php echo LANG_PHOTOBATTLE_ADD; ?>' href='<?php href_to('photobattle','add'); ?>'>
<?php echo LANG_PHOTOBATTLE_ADD; ?>
</a>

<h1><?php echo (LANG_PHOTOBATTLE_CONTROLLER); ?></h1>

<?php if (!$battles) { ?>
    <p><?php echo LANG_PHOTOBATTLE_NONE; ?></p>
    <?php return; ?>
<?php } ?>