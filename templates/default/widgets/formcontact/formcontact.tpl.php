<?php $this->addCSS("templates/default/css/formcontact.css"); ?>
<?php $this->addJS("templates/default/js/formcontact.js"); ?>

<div class="widget_formcontact_block">

<div class="contactform">
	<input type="hidden" value="<?php echo $widget->options['subject']; ?>" name="subject" class="field_subject"/>
	<input type="hidden" value="<?php echo base64_encode($widget->options['emailto']); ?>" name="emto" class="field_emto" />
	<input type="hidden" value="<?php echo base64_encode($widget->options['emailfrom']); ?>" name="emfrom" class="field_emfrom" />
	<input type="hidden" value="<?php echo $widget->options['emailfromtitle']; ?>" name="emailfromtitle" class="field_emailfromtitle" />
	
	<?php if ($widget->options['name']) { ?>
	<div class="inputwrapper"><input type="text" class="field_name<?php if ($widget->options['name_required']) { echo ' required'; } ?>" value="" name="name" placeholder="<?php echo $widget->options['name']; ?>" /><span class="errormess"><?php echo LANG_WD_FORMCONTACT_OBAYZAT; ?></span></div>
	<?php } ?>
	
	<?php if ($widget->options['phone']) { ?>
	<div class="inputwrapper"><input type="text" class="field_phone<?php if ($widget->options['phone_required']) { echo ' required'; } ?>" value="" name="phone" placeholder="<?php echo $widget->options['phone']; ?>"/><span class="errormess"><?php echo LANG_WD_FORMCONTACT_OBAYZAT; ?></span></div>
	<?php } ?>
	
	<?php if ($widget->options['emailback']) { ?>
	<div class="inputwrapper"><input type="text" class="field_emailback<?php if ($widget->options['emailback_required']) { echo ' required'; } ?>" value="" name="emailback" placeholder="<?php echo $widget->options['emailback']; ?>"/><span class="errormess"><?php echo LANG_WD_FORMCONTACT_ERROREMAIL; ?></span></div>
	<?php } ?>
	
	<?php if ($widget->options['message']) { ?>
	<div class="inputwrapper"><textarea class="field_message<?php if ($widget->options['message_required']) { echo ' required'; } ?>" name="message" placeholder="<?php echo $widget->options['message']; ?>"></textarea><span class="errormess"><?php echo LANG_WD_FORMCONTACT_OBAYZAT; ?></span></div>
	<?php } ?>
	<div class="formcontactsubmit"><?php echo $widget->options['submitbutton']; ?></div>
	<div class="ajaxotvet"><?php echo LANG_WD_FORMCONTACT_DONE; ?></div>
	<div id="formcontactajax"></div>
</div>

</div>