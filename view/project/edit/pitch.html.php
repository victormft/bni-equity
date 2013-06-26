<style>

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


// media del proyecto
if (!empty($project->media->url)) {
    $media = array(
            'type'  => 'media',
            'title' => Text::get('overview-field-media_preview'),
            'class' => 'inline media',
            'type'  => 'html',
            'html'  => !empty($project->media) ? $project->media->getEmbedCode($project->media_usubs) : ''
    );
} else {
    $media = array(
        'type'  => 'hidden',
        'class' => 'inline'
    );
}

$bplan = array();
$bp = $project->bplan;
$bplan[] = array(
	'type' => 'html',
	'class' => 'inline',
	'html' =>  is_object($bp) ?
			    '<img src="'.SITE_URL.'/view/css/project/file_uploaded.png" alt="Imagen"/><div class="file">'.$bp->name.'</div><button class="file-remove" type="submit" name="bplan-'.$bp->id.'-remove" title="Tirar file" value="remove"></button>' :
				''
); 

$finForecast = array();
$fin = $project->finForecast;
$finForecast[] = array(
	'type' => 'html',
	'class' => 'inline',
	'html' =>  is_object($fin) ?
			    '<img src="'.SITE_URL.'/view/css/project/file_uploaded.png" alt="Imagen"/><div class="file">'.$fin->name.'</div><button class="file-remove" type="submit" name="finForecast-'.$fin->id.'-remove" title="Tirar file" value="remove"></button>' :
				''
); 

//aditional files
$adfiles = array();
foreach ($project->adfile as $adfile) {
	$adfiles[] = array(
		'type' => 'html',
		'class' => 'inline',
		'html' =>  is_object($adfile) ?
                            '<img src='.SITE_URL.'"/view/css/project/file_uploaded.png" alt="Imagen"/><div class="file">'.$adfile->name.'</div><button class="file-remove" type="submit" name="adfile-'.$adfile->id.'-remove" title="Tirar file" value="remove"></button>' :
                            ''
	); 
}

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


$superform = array(
    'level'         => $this['level'],
    'action'        => '',
    'method'        => 'post',
    'title'         => "Your pitch" /*Text::get('overview-main-header')*/,
    'hint'          => "Pitch!" /*Text::get('guide-project-description')*/,
    'class'         => 'aqua',        
    'elements'      => array(
        'process_pitch' => array (
            'type' => 'hidden',
            'value' => 'pitch'
        ),
        
        'start_pitch' => array(
            'type'      => 'checkbox',
            'required'  => true,
            'title'     => "Começar o pitch?",
            'hint'      => "Marque se você quer começar uma rodade de investimento.",
            //'errors'    => !empty($errors['media']) ? array($errors['media']) : array(),
            //'ok'        => !empty($okeys['media']) ? array($okeys['media']) : array(),
            'value'     => 0,
            'checked'   => $project->start_pitch
        ),
        
	'media' => array(
            'type'      => 'textbox',
            'required'  => true,
            'title'     => Text::get('overview-field-media'),
            'hint'      => Text::get('tooltip-project-media'),
            'errors'    => !empty($errors['media']) ? array($errors['media']) : array(),
            'ok'        => !empty($okeys['media']) ? array($okeys['media']) : array(),
            'value'     => (string) $project->media
        ),

        'media-upload' => array(
            'name' => "upload",
            'type'  => 'submit',
            'label' => Text::get('form-upload-button'),
            'class' => 'inline media-upload'
        ),
        
        'media-preview' => $media,
			
		
		
        'text_pitch' => array(
                'type'      => 'textarea',
                'title'     => "About the pitch",
                'hint'      => "Give us everything you got!",
                'required'  => true,
                'errors'    => !empty($errors['text_pitch']) ? array($errors['text_pitch']) : array(),
                'ok'        => !empty($okeys['text_pitch']) ? array($okeys['text_pitch']) : array(),
                'value'     => $project->text_pitch
        ),
        
        'amount_needed' => array(
                'title'     => Text::get('rewards-field-individual_reward-amount'),
                'required'  => true,
                'type'      => 'textbox',
                'size'      => 5,
                'class'     => 'inline reward-amount',
                'value'     => $project->amount_needed,
                'errors'    => !empty($errors['amount_needed']) ? array($errors['amount_needed']) : array(),
                'ok'        => !empty($okeys['amount_needed']) ? array($okeys['amount_needed']) : array(),
                'hint'      => Text::get('tooltip-project-individual_reward-amount')
        ),

        'equity' => array(
                'title'     => "Equity offered",
                'required'  => true,
                'type'      => 'textbox',
                'size'      => 5,
                'class'     => 'inline reward-amount',
                'value'     => $project->equity,
                'errors'    => !empty($errors['equity']) ? array($errors['equity']) : array(),
                'ok'        => !empty($okeys['equity']) ? array($okeys['equity']) : array(),
                'hint'      => Text::get('tooltip-project-individual_reward-amount')
        ),
        
        'opportunity' => array(
            'type'      => 'textarea',
            'title'     => "Describe the investment opportunity",
            'hint'      => "Please give a summary of your business investment opportunity",
                                'required'  => true,
            'errors'    => !empty($errors['opportunity']) ? array($errors['opportunity']) : array(),
            'ok'        => !empty($okeys['opportunity']) ? array($okeys['opportunity']) : array(),
            'value'     => $project->opportunity
        ),

        'exit_strategy' => array(
            'type'      => 'textarea',
            'title'     => "Exit strategy",
            'hint'      => "Please outline the exit strategy including timing and forecast company valuation",
                                'required'  => true,
            'errors'    => !empty($errors['exit_strategy']) ? array($errors['exit_strategy']) : array(),
            'ok'        => !empty($okeys['exit_strategy']) ? array($okeys['exit_strategy']) : array(),
            'value'     => $project->exit_strategy
        ),
        
        'employees_forecast' => array(
                'type'      => 'textbox',
                'class'     => 'inline',
                'required'  => true,
                'title'     => "Estimated number of employees in 3 years" /*Text::get('personal-field-zipcode')*/,
                'size'      => 6,
                'hint'      => "Estimate the number of employees you will have in 3 years if you achieve the funding. This is for BNIEquity to estimate our impact on job creation. :)" /*Text::get('tooltip-project-main_address')*/,
                'errors'    => !empty($errors['employees_forecast']) ? array($errors['employees_forecast']) : array(),
                'ok'        => !empty($okeys['employees_forecast']) ? array($okeys['employees_forecast']) : array(),
                'value'     => $project->employees_forecast
        ),
		
	'keywords' => array(
            'type'      => 'textbox',
            'title'     => Text::get('overview-field-keywords'),
            'required'  => true,
            'hint'      => Text::get('tooltip-project-keywords'),
            'errors'    => !empty($errors['keywords']) ? array($errors['keywords']) : array(),
            'ok'        => !empty($okeys['keywords']) ? array($okeys['keywords']) : array(),
            'value'     => $project->keywords
        ),
        
        'business_plan' => array(        
            'title'     => "Business Plan" /*Text::get('overview-fields-images-title')*/,
            'type'      => 'group',
            //'required'  => true,
            'hint'      => Text::get('tooltip-project-image'),
            //'errors'    => !empty($errors['image']) ? array($errors['image']) : array(),
            //'ok'        => !empty($okeys['image']) ? array($okeys['image']) : array(),
            'class'     => 'images',
            'children'  => array(
                    'bplan_upload'    => array(
                            'type'  => 'file',
                            'label' => "Upload file" /*Text::get('form-image_upload-button')*/,
                            'class' => 'inline image_upload',
                            'hint'  => Text::get('tooltip-project-image')
                    ),
                    'bplan' => array(
                            'type'  => 'group',
                            'title' => "Uploaded file" /*Text::get('overview-field-image_gallery')*/,
                            'class' => 'inline',
                            'children'  => $bplan 
                    ),
             )
        ), 


        'finacial_forecast' => array(        
            'title'     => "Finantial forecast" /*Text::get('overview-fields-images-title')*/,
            'type'      => 'group',
            'required'  => true,
            'hint'      => Text::get('tooltip-project-image'),
            'errors'    => !empty($errors['image']) ? array($errors['image']) : array(),
            'ok'        => !empty($okeys['image']) ? array($okeys['image']) : array(),
            'class'     => 'images',
            'children'  => array(
                    'fin_upload'    => array(
                            'type'  => 'file',
                            'label' => "Upload file" /*Text::get('form-image_upload-button')*/,
                            'class' => 'inline image_upload',
                            'hint'  => Text::get('tooltip-project-image')
                    ),
                    'fin' => array(
                            'type'  => 'group',
                            'title' => "Uploaded file" /*Text::get('overview-field-image_gallery')*/,
                            'class' => 'inline',
                            'children'  => $finForecast 
                    ),
            )
        ), 
		
		
		
        'aditional_files' => array(        
                'title'     => "Aditional files" /*Text::get('overview-fields-images-title')*/,
                'type'      => 'group',
                //'required'  => true,
                'hint'      => Text::get('tooltip-project-image'),
                //'errors'    => !empty($errors['image']) ? array($errors['image']) : array(),
                //'ok'        => !empty($okeys['image']) ? array($okeys['image']) : array(),
                'class'     => 'images',
                'children'  => array(
                        'adfile_upload'    => array(
                                'type'  => 'file',
                                'label' => "Upload file" /*Text::get('form-image_upload-button')*/,
                                'class' => 'inline image_upload',
                                'hint'  => Text::get('tooltip-project-image')
                        ),
                        'adfiles' => array(
                                'type'  => 'group',
                                'title' => "Uploaded file" /*Text::get('overview-field-image_gallery')*/,
                                'class' => 'inline',
                                'children'  => $adfiles 
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
                            'name'  => 'view-step-userPersonal2',
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
