<style>

	body.project-edit div#main.userPersonal div.superform li.element.select > div.contents > select {
		background-position: 0 -53px;
		width: 202px;
		background: transparent  
			url('/view/project/edit/dropdown_202.png')
			no-repeat 0 0;
		cursor: pointer;
		height: 28px;
		margin-bottom: 5px;
		padding: 0;
		position: relative

	}


</style>



<?php


use Goteo\Library\Text,
    Goteo\Library\SuperForm,
    Goteo\Core\View;

$project = $this['project'];
$errors = $project->errors[$this['step']] ?: array();         
$okeys  = $project->okeys[$this['step']] ?: array();

// si tiene algo en direccion postal entonces tiene una direccion secundaria (la postal)
$secondary_address = empty($project->post_address) ? false : true;


echo new SuperForm(array(

    'level'         => $this['level'],
    'method'        => 'post',
    'title'         => Text::get('personal-main-header'),
    'hint'          => Text::get('guide-project-contract-information'),    
    'elements'      => array(
        'process_userPersonal' => array (
            'type' => 'hidden',
            'value' => 'userPersonal'
        ),
        
		
//AQUI TINHA O TIPO DE PESSOA	

 		/*'contract_entity-radioset' => array(
            'type'      => 'group',
            'title'     => Text::get('personal-field-contract_entity'),
            'hint'      => Text::get('tooltip-project-contract_entity'),
            'children'  => array(
                'contract_entity-person' =>  array(
                    'name'  => 'contract_entity',
                    'value' => false,
                    'type'  => 'radio',
                    'class' => 'inline',
                    'label' => Text::get('personal-field-contract_entity-person'),
                    'id'    => 'contract_entity-person',
                    'checked' => !$project->contract_entity ? true : false,
                    'children' => array(
                        // vacio si es persona f�sica 
                        'contract_entity-person' => array(
                            'type' => 'hidden',
                            'name' => "post_address-same",
                            'value' => 'person'
                        ),
                    )
                ),
                'contract_entity-entity' =>  array(
                    'name'  => 'contract_entity',
                    'value' => true,
                    'type'  => 'radio',
                    'class' => 'inline',
                    'label' => Text::get('personal-field-contract_entity-entity'),
                    'id'    => 'contract_entity-entity',
                    'checked' => $project->contract_entity ? true : false,
                    'children' => array(
                        // A desplegar si es persona jur�dica 
                        'entity_name' => array(
                            'type'      => 'textbox',
                            'class'     => 'inline',
                            'required'  => true,
                            'size'      => 20,
                            'title'     => Text::get('personal-field-entity_name'),
                            'hint'      => Text::get('tooltip-project-entity_name'),
                            'errors'    => !empty($errors['entity_name']) ? array($errors['entity_name']) : array(),
                            'ok'        => !empty($okeys['entity_name']) ? array($okeys['entity_name']) : array(),
                            'value'     => $project->entity_name
                        ),
                        
                        'entity_cif' => array(
                            'type'      => 'textbox',
                            'class'     => 'inline',
                            'required'  => true,
                            'title'     => Text::get('personal-field-entity_cif'),
                            'size'      => 15,
                            'hint'      => Text::get('tooltip-project-entity_cif'),
                            'errors'    => !empty($errors['entity_cif']) ? array($errors['entity_cif']) : array(),
                            'ok'        => !empty($okeys['entity_cif']) ? array($okeys['entity_cif']) : array(),
                            'value'     => $project->entity_cif
                        ),
                        
                        'entity_office' => array(
                            'type'      => 'textbox',
                            'class'     => 'inline',
                            'required'  => true,
                            'size'      => 20,
                            'title'     => Text::get('personal-field-entity_office'),
                            'hint'      => Text::get('tooltip-project-entity_office'),
                            'errors'    => !empty($errors['entity_office']) ? array($errors['entity_office']) : array(),
                            'ok'        => !empty($okeys['entity_office']) ? array($okeys['entity_office']) : array(),
                            'value'     => $project->entity_office
                        )
                    )
                )
            )
        ),*/	

        'contract' => array(
            'type'      => 'group',
            'title'     => "Personal information" /*Text::get('personal-field-contract_data')*/,
            'hint'      => Text::get('tooltip-project-contract_data'),
            'children'  => array(
			
			/*
                'contract_name' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'size'      => 20,
                    'title'     => Text::get('personal-field-contract_name'),
                    'hint'      => Text::get('tooltip-project-contract_name'),
                    'errors'    => !empty($errors['contract_name']) ? array($errors['contract_name']) : array(),
                    'ok'        => !empty($okeys['contract_name']) ? array($okeys['contract_name']) : array(),
                    'value'     => $project->contract_name
                ),*/
				'leader_name' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'size'      => 20,
                    'title'     => Text::get('personal-field-contract_name'),
                    'hint'      => Text::get('tooltip-project-contract_name'),
                    'errors'    => !empty($errors['leader_name']) ? array($errors['leader_name']) : array(),
                    'ok'        => !empty($okeys['leader_name']) ? array($okeys['leader_name']) : array(),
                    'value'     => $project->leader_name
                ),
				
				'leader_gender' => array(
                    'type'      => 'select',
					'class'     => 'inline select',
                    'required'  => true,
					'options'   => array("Masculino", "Feminino"),
                    'size'      => 100,
                    'title'     => "Gender",
                    'hint'      => Text::get('tooltip-project-contract_name'),
                    'errors'    => !empty($errors['leader_gender']) ? array($errors['leader_gender']) : array(),
                    'ok'        => !empty($okeys['leader_gender']) ? array($okeys['leader_gender']) : array(),
                    'value'     => $project->leader_gender
                ),
				
				'leader_rg' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => "RG",
                    'size'      => 9,
                    'hint'      => Text::get('tooltip-project-contract_nif'),
                    'errors'    => !empty($errors['leader_rg']) ? array($errors['leader_rg']) : array(),
                    'ok'        => !empty($okeys['leader_rg']) ? array($okeys['leader_rg']) : array(),
                    'value'     => $project->leader_rg
                ),
				/*'contract_nif' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-contract_nif'),
                    'size'      => 9,
                    'hint'      => Text::get('tooltip-project-contract_nif'),
                    'errors'    => !empty($errors['contract_nif']) ? array($errors['contract_nif']) : array(),
                    'ok'        => !empty($okeys['contract_nif']) ? array($okeys['contract_nif']) : array(),
                    'value'     => $project->contract_nif
                ),*/

                'contract_birthdate'  => array(
                    'type'      => 'datebox',
                    'required'  => true,
                    'size'      => 8,
                    'title'     => Text::get('personal-field-contract_birthdate'),
                    'hint'      => Text::get('tooltip-project-contract_birthdate'),
                    'errors'    => !empty($errors['contract_birthdate']) ? array($errors['contract_birthdate']) : array(),
                    'ok'        => !empty($okeys['contract_birthdate']) ? array($okeys['contract_birthdate']) : array(),
                    'value'     => $project->contract_birthdate
                ),
					
				
				
				
				

                /*'phone' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-phone'),
                    'size'      => 15,
                    'hint'      => Text::get('tooltip-project-phone'),
                    'errors'    => !empty($errors['phone']) ? array($errors['phone']) : array(),
                    'ok'        => !empty($okeys['phone']) ? array($okeys['phone']) : array(),
                    'value'     => $project->phone
                ),*/
				
			)
		),
				
		'contact' => array(
            'type'      => 'group',
            'title'     => "Contacts",
            'hint'      => Text::get('tooltip-project-contract_data'),
            'children'  => array(
				
				
				'leader_telephone' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-phone'),
                    'size'      => 15,
                    'hint'      => Text::get('tooltip-project-phone'),
                    'errors'    => !empty($errors['leader_telephone']) ? array($errors['leader_telephone']) : array(),
                    'ok'        => !empty($okeys['leader_telephone']) ? array($okeys['leader_telephone']) : array(),
                    'value'     => $project->leader_telephone
                ),

                /*'contract_email' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-contract_email'),
                    'size'      => 9,
                    'hint'      => Text::get('tooltip-project-contract_email'),
                    'errors'    => !empty($errors['contract_email']) ? array($errors['contract_email']) : array(),
                    'ok'        => !empty($okeys['contract_email']) ? array($okeys['contract_email']) : array(),
                    'value'     => $project->contract_email
                ),*/
				
				'leader_email' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => "Email",
                    'size'      => 9,
                    'hint'      => Text::get('tooltip-project-contract_email'),
                    'errors'    => !empty($errors['leader_email']) ? array($errors['leader_email']) : array(),
                    'ok'        => !empty($okeys['leader_email']) ? array($okeys['leader_email']) : array(),
                    'value'     => $project->leader_email
                ),
				
								
				'leader_facebook' => array(
                    'type'      => 'textbox',
                    'class'     => 'facebook',
                    'size'      => 40,
                    'title'     => Text::get('regular-facebook'),
                    'hint'      => Text::get('tooltip-user-facebook'),
                    'errors'    => !empty($errors['leader_facebook']) ? array($errors['leader_facebook']) : array(),
                    'ok'        => !empty($okeys['leader_facebook']) ? array($okeys['leader_facebook']) : array(),
                    'value'     => empty($project->leader_facebook) ? Text::get('regular-facebook-url') : $project->leader_facebook
                ),
				
								
				'leader_linkedin' => array(
                    'type'      => 'textbox',
                    'class'     => 'linkedin',
                    'size'      => 40,
                    'title'     => Text::get('regular-linkedin'),
                    'hint'      => Text::get('tooltip-user-linkedin'),
                    'errors'    => !empty($errors['leader_linkedin']) ? array($errors['leader_linkedin']) : array(),
                    'ok'        => !empty($okeys['leader_linkedin']) ? array($okeys['leader_linkedin']) : array(),
                    'value'     => empty($project->leader_linkedin) ? Text::get('regular-linkedin-url') : $project->leader_linkedin
                ),
				
				'leader_twitter' => array(
                    'type'      => 'textbox',
                    'class'     => 'twitter',
                    'size'      => 40,
                    'title'     => Text::get('regular-twitter'),
                    'hint'      => Text::get('tooltip-user-twitter'),
                    'errors'    => !empty($errors['leader_twitter']) ? array($errors['leader_twitter']) : array(),
                    'ok'        => !empty($okeys['leader_twitter']) ? array($okeys['leader_twitter']) : array(),
                    'value'     => empty($project->leader_twitter) ? Text::get('regular-twitter-url') : $project->leader_twitter
                )
            )
        ),

        /* Domicilio */
        'main_address' => array(
            'type'      => 'group',
            'title'     => Text::get('personal-field-main_address'),
            'hint'      => Text::get('tooltip-project-main_address'),
            'children'  => array(
                /*'address' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-address'),
                    'rows'      => 6,
                    'cols'      => 40,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['address']) ? array($errors['address']) : array(),
                    'ok'        => !empty($okeys['address']) ? array($okeys['address']) : array(),
                    'value'     => $project->address
                ),*/
				
				'leader_street' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-address'),
                    'size'      => 60,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['leader_street']) ? array($errors['leader_street']) : array(),
                    'ok'        => !empty($okeys['leader_street']) ? array($okeys['leader_street']) : array(),
                    'value'     => $project->leader_street
                ),
				
				'leader_city' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-location'),
                    'size'      => 60,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['leader_city']) ? array($errors['leader_city']) : array(),
                    'ok'        => !empty($okeys['leader_city']) ? array($okeys['leader_city']) : array(),
                    'value'     => $project->leader_city
                ),
				
				'leader_state' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => "State",
                    'size'      => 20,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['leader_state']) ? array($errors['leader_state']) : array(),
                    'ok'        => !empty($okeys['leader_state']) ? array($okeys['leader_state']) : array(),
                    'value'     => $project->leader_state
                ),

                /*'zipcode' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-zipcode'),
                    'size'      => 7,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['zipcode']) ? array($errors['zipcode']) : array(),
                    'ok'        => !empty($okeys['zipcode']) ? array($okeys['zipcode']) : array(),
                    'value'     => $project->zipcode
                ),*/
				
				'leader_cep' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-zipcode'),
                    'size'      => 20,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['leader_cep']) ? array($errors['leader_cep']) : array(),
                    'ok'        => !empty($okeys['leader_cep']) ? array($okeys['leader_cep']) : array(),
                    'value'     => $project->leader_cep
                ),
				
				'leader_country' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-country'),
                    'size'      => 20,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['leader_country']) ? array($errors['leader_country']) : array(),
                    'ok'        => !empty($okeys['leader_country']) ? array($okeys['leader_country']) : array(),
                    'value'     => $project->leader_country
                ),

                /*'location' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-location'),
                    'size'      => 25,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['location']) ? array($errors['location']) : array(),
                    'ok'        => !empty($okeys['location']) ? array($okeys['location']) : array(),
                    'value'     => $project->location
                ),*/

                /*'country' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-country'),
                    'size'      => 25,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['country']) ? array($errors['country']) : array(),
                    'ok'        => !empty($okeys['country']) ? array($okeys['country']) : array(),
                    'value'     => $project->country
                )*/
            )
        ),

        /* Radio de domicilio postal igual o diferente*/
        /*'post_address-radioset' => array(
            'type'      => 'group',
            'class'     => 'inline',
            'title'     => Text::get('personal-field-post_address'),
            'hint'      => Text::get('tooltip-project-post_address'),
            'children'  => array(
                'post_address-radio-same' =>  array(
                    'name'  => 'secondary_address',
                    'value' => false,
                    'type'  => 'radio',
                    'class' => 'inline',
                    'label' => Text::get('personal-field-post_address-same'),
                    'id'    => 'post_address-radio-same',
                    'checked' => !$project->secondary_address ? true : false,
                    'children' => array(
                        // Children vacio si es igual 
                        'post_address-same' => array(
                            'type' => 'hidden',
                            'name' => "post_address-same",
                            'value' => 'same'
                        ),
                    )
                ),
                'post_address-radio-different' =>  array(
                    'name'  => 'secondary_address',
                    'value' => true,
                    'type'  => 'radio',
                    'class' => 'inline',
                    'label' => Text::get('personal-field-post_address-different'),
                    'id'    => 'post_address-radio-different',
                    'checked' => $project->secondary_address ? true : false,
                    'children' => array(
                        // Domicilio postal (a desplegar si es diferente) 
                        'post_address' => array(
                            'type'      => 'textbox',
                            'class'     => 'inline',
                            'title'     => Text::get('personal-field-address'),
                            'rows'      => 6,
                            'cols'      => 40,
                            'hint'      => Text::get('tooltip-project-post_address'),
                            'errors'    => !empty($errors['post_address']) ? array($errors['post_address']) : array(),
                            'ok'        => !empty($okeys['post_address']) ? array($okeys['post_address']) : array(),
                            'value'     => $project->post_address
                        ),

                        'post_zipcode' => array(
                            'type'      => 'textbox',
                            'class'     => 'inline',
                            'title'     => Text::get('personal-field-zipcode'),
                            'size'      => 7,
                            'hint'      => Text::get('tooltip-project-post_address'),
                            'errors'    => !empty($errors['post_zipcode']) ? array($errors['post_zipcode']) : array(),
                            'ok'        => !empty($okeys['post_zipcode']) ? array($okeys['post_zipcode']) : array(),
                            'value'     => $project->post_zipcode
                        ),

                        'post_location' => array(
                            'type'      => 'textbox',
                            'class'     => 'inline',
                            'title'     => Text::get('personal-field-location'),
                            'size'      => 25,
                            'hint'      => Text::get('tooltip-project-post_address'),
                            'errors'    => !empty($errors['post_location']) ? array($errors['post_location']) : array(),
                            'ok'        => !empty($okeys['post_location']) ? array($okeys['post_location']) : array(),
                            'value'     => $project->post_location
                        ),

                        'post_country' => array(
                            'type'      => 'textbox',
                            'class'     => 'inline',
                            'title'     => Text::get('personal-field-country'),
                            'size'      => 25,
                            'hint'      => Text::get('tooltip-project-post_address'),
                            'errors'    => !empty($errors['post_country']) ? array($errors['post_country']) : array(),
                            'ok'        => !empty($okeys['post_country']) ? array($okeys['post_country']) : array(),
                            'value'     => $project->post_country
                        )
                    )
                ),
            )
        ),*/

        'footer' => array(
            'type'      => 'group',
            'children'  => array(
                'errors' => array(
                    'title' => Text::get('form-footer-errors_title'),
                    'view'  => new View('view/project/edit/errors.html.php', array(
                        'project'   => $project,
                        'step'      => $this['step']
                    ))                    
                ),
                'buttons'  => array(
                    'type'  => 'group',
                    'children' => array(
                        'next' => array(
                            'type'  => 'submit',
                            'name'  => 'view-step-enterprise',
                            'label' => Text::get('form-next-button'),
                            'class' => 'next'
                        )
                    )
                )
            )
        
        )
        
    )

));