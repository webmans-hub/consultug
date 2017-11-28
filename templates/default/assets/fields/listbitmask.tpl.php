<?php if ($field->title) { ?><label for="<?php echo $field->id; ?>"><?php echo $field->title; ?></label><?php } ?>
<?php if($field->getOption('is_checkbox_multiple')){ ?>

    <?php echo html_select_multiple($field->element_name, $field->data['items'], $field->data['selected'], array('id'=>$field->id)); ?>

<?php } else { ?>

    <?php
        $this->addJSFromContext('templates/default/js/jquery-chosen.js');
        $this->addCSSFromContext('templates/default/css/jquery-chosen.css');
    ?>

    <?php echo html_select($field->element_name, $field->data['items'], $field->data['selected'], (array('id'=>$field->id, 'multiple' => true))); ?>

    <script type="text/javascript">
        $('#<?php echo $field->id; ?>').chosen({no_results_text: '<?php echo LANG_LIST_EMPTY; ?>', placeholder_text_single: '<?php echo LANG_SELECT; ?>', placeholder_text_multiple: '<?php echo LANG_SELECT_MULTIPLE; ?>', width: '100%', search_placeholder: '<?php echo LANG_BEGIN_TYPING; ?>'});
        $(function(){
            $('.chosen-container-multi .chosen-choices li.search-field input[type="text"]').width(150);
        });
    </script>

<?php }
