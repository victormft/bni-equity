<style>
	
	body.project-edit div#main.enterprise div.superform li.element.reward-amount > div.contents > input {
		width: 10em;
		max-width: 10em;
		min-width: 3em;
		float: left;
		padding-right: 2em;
		background-image: url('/view/css/euro/s.png');    
		background-repeat: no-repeat;
		background-position: 10.7em center;
		font-weight: bold;
	}
	

	body.project-edit div#main.enterprise div.superform li.element.select > div.contents > select {
		background-position: 0 -53px;
		width: 202px;
		background-image: url(dropdown_202.png);	
		
		cursor: pointer;
		height: 28px;
		margin-bottom: 5px;
		padding: 0;
		position: relative

	}
	
	div.file {
		position:absolute;
		left: 25px;
		top: 15px;
		font-size:16px;
		
	}


	
</style>

<?php 

use Equity\Core\View,
    Equity\Library\Text,
    Equity\Library\SuperForm;
    
$project = $this['project'];
$errors = $project->errors[$this['step']] ?: array();
$okeys  = $project->okeys[$this['step']] ?: array();


//tem um bocado de coisa aqui no "company"

$images = array();
foreach ($project->gallery as $image) {
    $images[] = array(
        'type'  => 'html',
        'class' => 'inline gallery-image',
        'html'  => is_object($image) ?
                   $image . '<img src="'.SRC_URL.'/image/'.$image->id.'/128/128" alt="Imagen" /><button class="image-remove weak" type="submit" name="gallery-'.$image->id.'-remove" title="Quitar imagen" value="remove"></button>' :
                   ''
    );

}





$categories = array();

foreach ($this['categories'] as $value => $label) {
    $categories[] =  array(
        'value'     => $value,
        'label'     => $label,
        'checked'   => in_array($value, $project->categories)
        );            
}

$ftypes = array();

foreach ($this['ftypes'] as $value => $label) {
    $ftypes[] =  array(
        'value'     => $value,
        'label'     => $label,
        'checked'   => in_array($value, $project->ftypes)
        );            
}


$superform = array(
    'level'         => $this['level'],
    'action'        => '',
    'method'        => 'post',
    'title'         => "Cadastro da sua startup" /*Text::get('overview-main-header')*/,
    'hint'          => "Informações gerais sobre sua Startup." /*Text::get('guide-project-description')*/,
    'class'         => 'aqua',        
    'elements'      => array(
        'process_enterprise' => array (
            'type' => 'hidden',
            'value' => 'enterprise'
        ),
        
		
	'your_company' => array(
            'type'      => 'group',
            'title'     => "Startup",
            'hint'      => Text::get('tooltip-project-contract_data'),
            'children'  => array(
                'name' => array(
                    'type'      => 'textbox',
                    'title'     => "Nome da startup" /*Text::get('overview-field-name')*/,
                    'required'  => true,
                    'hint'      => Text::get('tooltip-project-name'),
                    'value'     => $project->name,
                    'errors'    => !empty($errors['name']) ? array($errors['name']) : array(),
                    'ok'        => !empty($okeys['name']) ? array($okeys['name']) : array()
                ),

                'subtitle' => array(
                    'type'      => 'textbox',
                    'title'     => "Pitch de uma linha" /*Text::get('overview-field-subtitle')*/,
                    'required'  => false,
                    'value'     => $project->subtitle,
                    'hint'      => Text::get('tooltip-project-subtitle'),
                    'errors'    => !empty($errors['subtitle']) ? array($errors['subtitle']) : array(),
                    'ok'        => !empty($okeys['subtitle']) ? array($okeys['subtitle']) : array()
                ),

                
                //ADD. Antes: user_avatar
                'startup_logo' => array(
                    'type'      => 'group',
                    'required'  => true,
                    'title'     => "Logo" /*Text::get('profile-fields-image-title')*/,
                    'hint'      => Text::get('tooltip-user-image'),
                    'errors'    => !empty($errors['avatar']) ? array($errors['avatar']) : array(),
                    'ok'        => !empty($okeys['avatar']) ? array($okeys['avatar']) : array(),
                    'class'     => 'user_avatar',
                    'children'  => array(
                        'avatar_upload'    => array(
                            'type'  => 'file',
                            'label' => Text::get('form-image_upload-button'),
                            'class' => 'inline avatar_upload',
                            'hint'  => Text::get('tooltip-user-image'),
                        ),
                        'avatar-current' => array(
                            'type' => 'hidden',
                            'value' => $user->avatar->id == 1 ? '' : $user->avatar->id,
                        ),
                        'avatar-image' => array(
                            'type'  => 'html',
                            'class' => 'inline avatar-image',
                            'html'  => is_object($user->avatar) &&  $user->avatar->id != 1 ?
                                       $user->avatar . '<img src="'.SRC_URL.'/image/' . $user->avatar->id . '/128/128" alt="Avatar" /><button class="image-remove" type="submit" name="avatar-'.$user->avatar->id.'-remove" title="Quitar imagen" value="remove">X</button>' :
                                       ''
                        )
                    )
                ),
                
                
				
		'company_cep' => array(
                    'type'      => 'textbox',
                    'class'     => 'inline',
                    'required'  => true,
                    'title'     => Text::get('personal-field-zipcode'),
                    'size'      => 20,
                    'hint'      => Text::get('tooltip-project-main_address'),
                    'errors'    => !empty($errors['company_cep']) ? array($errors['company_cep']) : array(),
                    'ok'        => !empty($okeys['company_cep']) ? array($okeys['company_cep']) : array(),
                    'value'     => $project->company_cep
                ),
				
                'site' => array(
                        'type'      => 'textbox',
                        'required'  => true,
                        'title'     => "Company website" /*Text::get('profile-field-websites')*/,
                        'hint'      => Text::get('tooltip-user-webs'),
                        'class'     => 'webs',
                        'errors'    => !empty($errors['site']) ? array($errors['site']) : array(),
                        'ok'        => !empty($okeys['site']) ? array($okeys['site']) : array(),
                        'value'     => $project->site
                ),
				
		'company_facebook' => array(
                    'type'      => 'textbox',
                    'class'     => 'facebook',
                    'size'      => 40,
                    'title'     => Text::get('regular-facebook'),
                    'hint'      => Text::get('tooltip-user-facebook'),
                    'errors'    => !empty($errors['company_facebook']) ? array($errors['company_facebook']) : array(),
                    'ok'        => !empty($okeys['company_facebook']) ? array($okeys['company_facebook']) : array(),
                    'value'     => empty($project->company_facebook) ? Text::get('regular-facebook-url') : $project->company_facebook
                ),
				
                
				
				//ta dando pau
				/*'brazilian_bool' => array(
                    'type'      => 'checkbox',
                    'class'     => 'inline cols_1',
                    'required'  => false,
                    'name'      => 'brazilian_bool',
                    'label'     => Text::get('overview-field-usubs'),
                    'hint'      => Text::get('tooltip-project-usubs'),
                    'errors'    => array(),
                    'ok'        => array(),
                    'value'     => 1,
                    'checked'   => $project->brazilian_bool
                ),*/
				
		'growth_stage' => array(
                    'type'      => 'select',
                    'class'     => 'inline select',
                    'required'  => true,
                    'options'   => array("Select stage...", "Startup", "Early stage", "Growth"),
                    'size'      => 100,
                    'title'     => "Business Growth Stage",
                    'hint'      => Text::get('tooltip-project-contract_name'),
                    'errors'    => !empty($errors['growth_stage']) ? array($errors['growth_stage']) : array(),
                    'ok'        => !empty($okeys['growth_stage']) ? array($okeys['growth_stage']) : array(),
                    'value'     => $project->growth_stage
                ),
				
                'category' => array(    
                        'type'      => 'checkboxes',
                        'name'      => 'categories[]',
                        'title'     => Text::get('overview-field-categories'),
                        'required'  => true,
                        'class'     => 'cols_3',
                        'options'   => $categories,
                        'hint'      => Text::get('tooltip-project-category'),
                        'errors'    => !empty($errors['categories']) ? array($errors['categories']) : array(),
                        'ok'        => !empty($okeys['categories']) ? array($okeys['categories']) : array()
                ),
				

				
                'past_funding' => array(
                        'type'      => 'group',
                        'class'     => 'inline',
                        'title'     => "Funding to date",
                        'hint'      => Text::get('tooltip-project-post_address'),
                        'children'  => array(
                                'never' =>  array(
                                        'name'  => 'past_funded',
                                        'value' => false,
                                        'type'  => 'radio',
                                        'class' => 'inline',
                                        'label' => "Never",
                                        'id'    => 'past_funding-no',
                                        'checked' => !$project->past_funded ? true : false,
                                        'children' => array(
                                                // Children vacio si es igual 
                                                'never_funded' => array(
                                                        'type' => 'hidden',
                                                        'name' => "never_funded",
                                                        'value' => 'never'
                                                ),
                                        )
                                ),

                                'yes' =>  array(
                                        'name'  => 'past_funded',
                                        'value' => true,
                                        'type'  => 'radio',
                                        'class' => 'inline',
                                        'label' => "Yes, I had funding before",
                                        'id'    => 'past_funding-yes',
                                        'checked' => $project->past_funded ? true : false,
                                        'children' => array(



                                                // Domicilio postal (a desplegar si es diferente) 
                                                'past_fundings' => array(
                                                        'type'      => 'checkboxes',
                                                        'name'      => 'ftypes[]',
                                                        'title'     => "Past fundings",
                                                        'required'  => true,
                                                        'class'        => 'inline cols_3',
                                                        'options'   => $ftypes,
                                                        'hint'      => Text::get('tooltip-project-post_address'),
                                                        'errors'    => !empty($errors['ftypes']) ? array($errors['ftypes']) : array(),
                                                        'ok'        => !empty($okeys['ftypes']) ? array($okeys['ftypes']) : array(),
                                                        //'value'     => $project->post_address
                                                ),

                                                'investment_secured' => array(
                                                        'type'      => 'textarea',
                                                        'title'     => "Secured investments",
                                                        'hint'      => "Tell us about previous investments already secured! :)",

                                                        'errors'    => !empty($errors['investment_secured']) ? array($errors['investment_secured']) : array(),
                                                        'ok'        => !empty($okeys['investment_secured']) ? array($okeys['investment_secured']) : array(),
                                                        'value'     => $project->investment_secured
                                                ),

                                        )
                                ),
                        )
                ),
				
			
			
			
			
			),
			
			
		
			
		),
		
		'complementary' => array(
				'type'      => 'group',
				'title'     => "Complementary information",
				'hint'      => Text::get('tooltip-project-contract_data'),
				'children'  => array(
				
                                    
										
                                    'employees' => array(
                                            'type'      => 'textbox',
                                            'class'     => 'inline',
                                            'required'  => true,
                                            'title'     => "Current number of employess" /*Text::get('personal-field-zipcode')*/,
                                            'size'      => 6,
                                            'hint'      => "The name says" /*Text::get('tooltip-project-main_address')*/,
                                            'errors'    => !empty($errors['employees']) ? array($errors['employees']) : array(),
                                            'ok'        => !empty($okeys['employees']) ? array($okeys['employees']) : array(),
                                            'value'     => $project->employees
                                    ),

                                    

                                    'revenue' => array(
                                            'type'      => 'select',
                                            'class'     => 'inline select',
                                            'required'  => true,
                                            'options'   => array("Select...", "Yes", "No"),
                                            'size'      => 20,
                                            'title'     => "Revenue last year",
                                            'hint'      => Text::get('tooltip-project-contract_name'),
                                            'errors'    => !empty($errors['revenue']) ? array($errors['revenue']) : array(),
                                            'ok'        => !empty($okeys['revenue']) ? array($okeys['revenue']) : array(),
                                            'value'     => $project->revenue
                                    ),

                                    'profit' => array(
                                            'type'      => 'select',
                                            'class'     => 'inline select',
                                            'required'  => true,
                                            'options'   => array("Select...", "Yes", "No"),
                                            'size'      => 20,
                                            'title'     => "Profit last year",
                                            'hint'      => Text::get('tooltip-project-contract_name'),
                                            'errors'    => !empty($errors['profit']) ? array($errors['profit']) : array(),
                                            'ok'        => !empty($okeys['profit']) ? array($okeys['profit']) : array(),
                                            'value'     => $project->profit
                                    ),

                                    'press' => array(
                                            'type'      => 'select',
                                            'class'     => 'inline select',
                                            'required'  => true,
                                            'options'   => array("Select...", "Yes", "No"),
                                            'size'      => 20,
                                            'title'     => "Press reference",
                                            'hint'      => "We regularly get enquiries from the press and we would like to involve your business, where appropriate, to raise the profile of your business." /*Text::get('tooltip-project-contract_name')*/,
                                            'errors'    => !empty($errors['press']) ? array($errors['press']) : array(),
                                            'ok'        => !empty($okeys['press']) ? array($okeys['press']) : array(),
                                            'value'     => $project->press
                                    ),

				),
		),
		
		
		
		
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
                            'name'  => 'view-step-pitch',
                            'label' => Text::get('form-next-button'),
                            'class' => 'next'
                        )
                    )
                )
            )
        
        )
		
	)
);



echo new SuperForm($superform);
