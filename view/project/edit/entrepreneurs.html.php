<style>

/**
 * Entrepreneurs
 */
 
body.project-edit div#main.entrepreneurs div.superform li.element.support-new > .title {
    display: none;
}

/* Viendo */

body.project-edit div#main.entrepreneurs div.superform li.element.support div.title {
    font-size: 14px;
    text-transform: uppercase;
    width: 70%;
    float: left;
}

body.project-edit div#main.entrepreneurs div.superform li.element.support div.support {
    padding-left: 55px;
    background: none no-repeat 10px center;
    min-height: 32px;
}

body.project-edit div#main.entrepreneurs div.superform li.element.support div.task {
    background-image: url('/view/css/icon/m/task.png');
}

body.project-edit div#main.entrepreneurs div.superform li.element.support div.lend {
    background-image: url('/view/css/icon/m/lend.png');
}

body.project-edit div#main.entrepreneurs div.superform li.element.support div.description {
    float: left;
    width: 70%;
    margin: .5em 0;
}

/*
body.project-edit div#main.entrepreneurs div.superform li.element.support input.edit,
body.project-edit div#main.entrepreneurs div.superform li.element.support input.remove {
    width: 7em;
}
*/

body.project-edit div#main.entrepreneurs div.superform li.element.support input.edit {
    margin-top: -1em;
}

body.project-edit div#main.entrepreneurs div.superform li.element.support input.remove {
    margin-bottom: 1em;
    margin-top: 0;
}

/* Editando */


body.project-edit div#main.entrepreneurs div.superform li.element.editsupport > .children  ol {
    padding: 0 !important;
    margin: 0 !important;
}

body.project-edit div#main.entrepreneurs div.superform li.element.editsupport li.buttons div.contents,
body.project-edit div#main.entrepreneurs div.superform li.element.editsupport li.buttons ol {
    margin: 0 !important;
    padding: 0 !important;
}

body.project-edit div#main.entrepreneurs div.superform li.element.editsupport li.buttons ol {
    text-align: right;
}

body.project-edit div#main.entrepreneurs div.superform li.element.editsupport li.buttons li {
    display: inline-block;
    padding: 0;
    margin: 0;
}

body.project-edit div#main.entrepreneurs div.superform li.element.editsupport li.buttons input {
    width: auto;
    float: left;
    margin: 0 10px 0 0;
}


body.project-edit div#main.entrepreneurs div.superform li.element.editsupport div.children li.element.support-description textarea {
    height: 4em;
    min-height: 4em;
}

body.project-edit div#main.entrepreneurs div.superform li.element.editsupport li.support-type div.contents {
    padding-left: 55px;
    background: none no-repeat 10px center;
    min-height: 32px;
    line-height: 32px;
}

body.project-edit div#main.entrepreneurs div.superform li.element.editsupport li.support_task div.contents {
    background-image: url('/view/css/icon/m/task.png');
}

body.project-edit div#main.entrepreneurs div.superform li.element.editsupport li.support_lend div.contents {
    background-image: url('/view/css/icon/m/lend.png');
}


</style>


<?php 

use Equity\Core\View,
    Equity\Library\Text,
    Equity\Library\SuperForm;
    
$project = $this['project'];
$errors = $project->errors[$this['step']] ?: array();
$okeys  = $project->okeys[$this['step']] ?: array();


$entrepreneurs = array();

foreach ($project->entrepreneurs as $entrepreneur) {

    // a ver si es el que estamos editando o no
    if (!empty($this["entrepreneur-{$entrepreneur->id}-edit"])) {
       

        // a este grupo le ponemos estilo de edicion
        $entrepreneurs["entrepreneur-{$entrepreneur->id}"] = array(
                'type'      => 'group',
                'class'     => 'support editsupport',
                'children'  => array(                    
                    "entrepreneur-{$entrepreneur->id}-edit" => array(
                        'type'  => 'hidden',
                        'value' => '1'
                    ),
					
					"entrepreneur-{$entrepreneur->id}-name" => array(
                        'title'     => "Name" /*Text::get('supports-field-support')*/,
                        'type'      => 'textbox',
                        'required'  => true,
                        'size'      => 100,
                        'class'     => 'inline',
                        'value'     => $entrepreneur->name,
                        'errors'    => !empty($errors["entrepreneur-{$entrepreneur->id}-name"]) ? array($errors["entrepreneur-{$entrepreneur->id}-name"]) : array(),
                        'ok'        => !empty($okeys["entrepreneur-{$entrepreneur->id}-name"]) ? array($okeys["entrepreneur-{$entrepreneur->id}-name"]) : array(),
                        'hint'      => "What's this guy's name?" /*Text::get('tooltip-project-support-support')*/
                    ),					
					
					"entrepreneur-{$entrepreneur->id}-role" => array(
                        'title'     => "Role" /*Text::get('supports-field-support')*/,
                        'type'      => 'textbox',
                        'required'  => true,
                        'size'      => 100,
                        'class'     => 'inline',
                        'value'     => $entrepreneur->role,
                        'errors'    => !empty($errors["entrepreneur-{$entrepreneur->id}-role"]) ? array($errors["entrepreneur-{$entrepreneur->id}-role"]) : array(),
                        'ok'        => !empty($okeys["entrepreneur-{$entrepreneur->id}-role"]) ? array($okeys["entrepreneur-{$entrepreneur->id}-role"]) : array(),
                        'hint'      => "What is the role of this guy??" /*Text::get('tooltip-project-support-support')*/
                    ),				
                    
					"entrepreneur-{$entrepreneur->id}-founder" => array(
						'type'      => 'group',
						'class'     => 'inline',
						'title'     => "Founder?",
						'hint'      => "Is this guy a founder??" /*Text::get('tooltip-project-post_address')*/,
						'children'  => array(
							'founder_radio' =>  array(
								'name'  => 'founder',
								'value' => true,
								'type'  => 'radio',
								'class' => 'inline',
								'label' => "Yes",
								'id'    => 'founder',
								'checked' => $entrepreneur->founder ? true : false,
								'children' => array(
									// Children vacio si nao marcado
									'founder' => array(
										'type' => 'hidden',
										'name' => "founder",
										'value' => true
									),	
								)
							),						
						
							'not-founder_radio' =>  array(
								'name'  => 'founder',
								'value' => false,
								'type'  => 'radio',
								'class' => 'inline',
								'label' => "No",
								'id'    => 'not-founder',
								'checked' => !$entrepreneur->founder ? true : false,
								'children' => array(
									// Children vacio si nao marcado																	
									'not-founder' => array(
										'type' => 'hidden',
										'name' => "not-founder",
										'value' => false
									)
								)
							),
						)					
					),
                    
                    "entrepreneur-{$entrepreneur->id}-bios" => array(
                        'type'      => 'textarea',
                        'required'  => true,
                        'title'     => "Bios" /*Text::get('supports-field-description')*/,
                        'cols'      => 100,
                        'rows'      => 4,
                        'class'     => 'inline support-description',
                        'value'     => $entrepreneur->bios,
                        'errors'    => !empty($errors["entrepreneur-{$entrepreneur->id}-bios"]) ? array($errors["entrepreneur-{$entrepreneur->id}-bios"]) : array(),
                        'ok'        => !empty($okeys["entrepreneur-{$entrepreneur->id}-bios"]) ? array($okeys["entrepreneur-{$entrepreneur->id}-bios"]) : array(),
                        'hint'      => "Give us a brief bios of this guy." /*Text::get('tooltip-project-support-description')*/
                    ),					
					
                    "entrepreneur-{$entrepreneur->id}-buttons" => array(
                        'type' => 'group',
                        'class' => 'buttons',
                        'children' => array(
                            "entrepreneur-{$entrepreneur->id}-ok" => array(
                                'type'  => 'submit',
                                'label' => Text::get('form-accept-button'),
                                'class' => 'inline ok'
                            ),
                            "entrepreneur-{$entrepreneur->id}-remove" => array(
                                'type'  => 'submit',
                                'label' => Text::get('form-remove-button'),
                                'class' => 'inline remove weak'
                            )
                        )
                    )
                )
            );

    } else {
        $entrepreneurs["entrepreneur-{$entrepreneur->id}"] = array(
            'class'     => 'support',
            'view'      => 'view/project/edit/entrepreneurs/entrepreneur.html.php',
            'data'      => array('entrepreneur' => $entrepreneur),
        );

    }
}

$sfid = 'sf-project-supports';


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

echo new SuperForm(array(

    'id'            => $sfid,

    'action'        => '',
    'level'         => $this['level'],
    'method'        => 'post',
    'title'         => "Entrepreneurs" /*Text::get('supports-main-header')*/,
    'hint'          => "In this section, give us more information about the entrepreneurs or main leaders of your company." /*Text::get('guide-project-supports')*/,    
    'class'         => 'aqua',
    'elements'      => array(        
        'process_entrepreneurs' => array (
            'type' => 'hidden',
            'value' => 'entrepreneurs'
        ),
		
        'entrepreneurs' => array(
            'type'      => 'group',
            'title'     => "Entrepreneurs" /*Text::get('supports-fields-support-title')*/,
            'hint'      => "Talk about them! :)" /*Text::get('tooltip-project-supports')*/,
            'children'  => $entrepreneurs + array(
                'entrepreneur-add' => array(
                    'type'  => 'submit',
                    'label' => Text::get('form-add-button'),
                    'class' => 'add support-add red',
                )
            )
        ),	
		
		'images' => array(        
            'title'     => Text::get('overview-fields-images-title'),
            'type'      => 'group',
            'required'  => true,
            'hint'      => Text::get('tooltip-project-image'),
            'errors'    => !empty($errors['image']) ? array($errors['image']) : array(),
            'ok'        => !empty($okeys['image']) ? array($okeys['image']) : array(),
            'class'     => 'images',
            'children'  => array(
                'image_upload'    => array(
                    'type'  => 'file',
                    'label' => Text::get('form-image_upload-button'),
                    'class' => 'inline image_upload',
                    'hint'  => Text::get('tooltip-project-image')
                )
            )
        ),        
        'gallery' => array(
            'type'  => 'group',
            'title' => Text::get('overview-field-image_gallery'),
            'class' => 'inline',
            'children'  => $images
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
                            'name'  => 'view-step-rewards',
                            'label' => Text::get('form-next-button'),
                            'class' => 'next'
                        )
                    )
                )
            )
        )
    )

));

?>

<!--<script type="text/javascript">
$(document).ready(function() {
    $("input.ok").click(function() {
        $("li.support").hide();
    });
});
</script>-->


<script type="text/javascript">
$(function () {

    var entrepreneurs = $('div#<?php echo $sfid ?> li.element#entrepreneurs');

    entrepreneurs.delegate('li.element.support input.edit', 'click', function (event) {
        var data = {};
        data[this.name] = '1';
        Superform.update(entrepreneurs, data);
        event.preventDefault();
    });

    entrepreneurs.delegate('li.element.editsupport input.ok', 'click', function (event) {
        var data = {};
		var thenum = this.name.match(/\d+/g); 
		thenum = thenum.join("");
        data[this.name.substring(0, 13) + thenum + "-edit"] = '0';
        Superform.update(entrepreneurs, data);
	    event.preventDefault();
		
    });

    entrepreneurs.delegate('li.element.editsupport input.remove, li.element.support input.remove', 'click', function (event) {
        var data = {};
        data[this.name] = '1';
        Superform.update(entrepreneurs, data);
        event.preventDefault();
    });

    entrepreneurs.delegate('#entrepreneur-add input', 'click', function (event) {
       var data = {};
       data[this.name] = '1';
       Superform.update(entrepreneurs, data);
       event.preventDefault();
    });

});
</script>