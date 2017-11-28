<?php

class formWidgetWritemeOptions extends cmsForm {

    public function init() {

        return array(

            array(
                'type' => 'fieldset',
                'title' => LANG_OPTIONS, 
                'childs' => array(

                    new fieldString('options:email', array(
                        'title' => LANG_WD_WRITEME_EMAIL,
                        'rules' => array(
                            array('required')
                        )
                    )),
                    new fieldString('options:email_copy', array(
                        'title' => LANG_WD_WRITEME_EMAIL_COPY,
                    )),
                    
                    new fieldList('options:side', array(
						'title'     => LANG_WD_WRITEME_SIDE,
						'items' => array(
							'left' => LANG_WD_WRITEME_SIDE_LEFT,
							'right' => LANG_WD_WRITEME_SIDE_RIGHT,
						) 
                    )),

                )
            ),
            
            array(
                'type' => 'fieldset',
                'title' => LANG_WD_WRITEME_REQ, 
                'childs' => array(

                    new fieldCheckbox('options:req_name', array(
                        'title' => LANG_WD_WRITEME_REQ_NAME,
                        'default' => 1,
                    )),
                    new fieldCheckbox('options:req_phone', array(
                        'title' => LANG_WD_WRITEME_REQ_PHONE,
                        'default' => 0,
                    )),
                    new fieldCheckbox('options:req_mail', array(
                        'title' => LANG_WD_WRITEME_REQ_EMAIL,
                        'default' => 1,
                    )),
                    new fieldCheckbox('options:req_subject', array(
                        'title' => LANG_WD_WRITEME_REQ_SUBJECT,
                        'default' => 0,
                    )),
                    new fieldCheckbox('options:req_message', array(
                        'title' => LANG_WD_WRITEME_REQ_MESSAGE,
                        'default' => 1,
                    )),

                )
            ),

        );

    }

}
