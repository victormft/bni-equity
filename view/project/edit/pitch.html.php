<style>

div.file {
	position:absolute;
	left: 25px;
	top: 15px;
	font-size:16px;
	
}
	
</style>

<?php 

use Goteo\Core\View,
    Goteo\Library\Text,
    Goteo\Library\SuperForm;
    
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

//aditional files
$adfiles = array();
foreach ($project->adfile as $adfile) {
	$adfiles[] = array(
		'type' => 'html',
		'class' => 'inline',
		'html' =>  is_object($adfile) ?
					'<img src="http://localhost/view/css/project/file_uploaded.png" alt="Imagen"/><div class="file">'.$adfile->name.'</div><button class="file-remove" type="submit" name="adfile-'.$adfile->id.'-remove" title="Tirar file" value="remove"></button>' :
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
    'hint'          => "Just gimme your damn pitch!" /*Text::get('guide-project-description')*/,
    'class'         => 'aqua',        
    'elements'      => array(
        'process_pitch' => array (
            'type' => 'hidden',
            'value' => 'pitch'
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
		
		'keywords' => array(
            'type'      => 'textbox',
            'title'     => Text::get('overview-field-keywords'),
            'required'  => true,
            'hint'      => Text::get('tooltip-project-keywords'),
            'errors'    => !empty($errors['keywords']) ? array($errors['keywords']) : array(),
            'ok'        => !empty($okeys['keywords']) ? array($okeys['keywords']) : array(),
            'value'     => $project->keywords
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
