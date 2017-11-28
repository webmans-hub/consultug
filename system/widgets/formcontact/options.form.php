<?php

class formWidgetFormcontactOptions extends cmsForm {

    public function init() {

        return array(

            array(
                'type' => 'fieldset',
                'title' => LANG_OPTIONS, 
                'childs' => array(

                   new fieldString('options:emailto', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_EMAILTO,
						'rules' => array(
							array('required'),
							array('max_length', 200),
							array('min_length', 2)
						)
					)),
					
					new fieldString('options:emailfromtitle', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_EMAILFROMTITLE,
						'rules' => array(
							array('required'),
							array('max_length', 200),
							array('min_length', 2)
						)
					)),
					
					new fieldString('options:emailfrom', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_EMAILFROM,
						'rules' => array(
							array('required'),
							array('max_length', 200),
							array('min_length', 2)
						)
					)),
					
					new fieldString('options:subject', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_SUBJECT,
						'rules' => array(
							array('required'),
							array('max_length', 300),
							array('min_length', 2)
						)
					)),
					
					new fieldString('options:name', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_NAMETITLE,
						'hint' => LANG_WD_FORMCONTACT_OPTIONS_NAMEHINT
					)),
					
					new fieldString('options:phone', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_PHONETITLE,
						'hint' => LANG_WD_FORMCONTACT_OPTIONS_PHONEHINT
					)),
					
					new fieldString('options:emailback', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_EMAILBACKTITLE,
						'hint' => LANG_WD_FORMCONTACT_OPTIONS_EMAILBACKTHINT
					)),
					
					new fieldString('options:message', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_MESSAGETITLE,
						'hint' => ""
					)),
					
					new fieldString('options:submitbutton', array(
						'title' => LANG_WD_FORMCONTACT_OPTIONS_SUBMITTITLE,
						'rules' => array(
							array('required'),
							array('max_length', 200),
							array('min_length', 2)
						)
					)),
					
					new fieldCheckbox('options:name_required', array(
                        'title' => LANG_WD_FORMCONTACT_OPTIONS_NAMEREQIURED,
                        'default' => 1
                    )),
					
					new fieldCheckbox('options:emailback_required', array(
                        'title' => LANG_WD_FORMCONTACT_OPTIONS_EMAILBACKREQIURED,
                        'default' => 1
                    )),
					
					new fieldCheckbox('options:phone_required', array(
                        'title' => LANG_WD_FORMCONTACT_OPTIONS_PHONEREQUIRED,
                        'default' => 1
                    )),
					new fieldCheckbox('options:message_required', array(
                        'title' => LANG_WD_FORMCONTACT_OPTIONS_MESSAGEREQUIRED,
                        'default' => 1
                    )),

                )
            ),

        );

    }

}
