<?php
class formFeedbackHandling extends cmsForm {

    public function init() {

        return array(

            array(
                'type' => 'fieldset',
                'childs' => array(

                    new fieldString('name', array(
                        'title' => LANG_FEEDBACK_HANDLING_NAME,
						'rules' => array(
							array('required'),
						),
                    )),

                    new fieldString('phone', array(
                        'title' => LANG_FEEDBACK_HANDLING_PHONE,
						'rules' => array(
							array('required'),
						),
                    )),

                    new fieldString('url', array(
                        'title' => LANG_FEEDBACK_HANDLING_URL,
						'rules' => array(
							array('required'),
						),
                    )),

                )
            )

        );

    }

}