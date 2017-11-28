<?php

function grid_handlings($controller){

    $options = array(
        'is_sortable' => false,
        'is_filter' => false,
        'is_pagination' => false,
        'is_draggable' => true,
        'order_by' => 'ordering',
        'order_to' => 'asc',
        'show_id' => false
    );

    $columns = array(
        'id' => array(
            'title' => 'id',
            'width' => 30,
        ),
        'name' => array(
            'title' => LANG_FEEDBACK_HANDLING_NAME,
        ),
        'phone' => array(
            'title' => LANG_FEEDBACK_HANDLING_PHONE,
        ),
        'url' => array(
            'title' => LANG_FEEDBACK_HANDLING_URL,
        ),
    );

    $actions = array(
        array(
            'title' => LANG_EDIT,
            'class' => 'edit',
            'href' => href_to($controller->root_url, 'edit_handling', array('{id}')),
        ),
        array(
            'title' => LANG_DELETE,
            'class' => 'delete',
            'href' => href_to($controller->root_url, 'delete_handling', array('{id}')),
            'confirm' => LANG_FEEDBACK_DELETE_HANDLING_CONFIRM,
        )
    );

    return array(
        'options' => $options,
        'columns' => $columns,
        'actions' => $actions
    );

}

