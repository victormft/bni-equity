<?php

use Equity\Library\Text,
    Equity\Model,
    Equity\Core\Redirection,
    Equity\Library\SuperForm;

define('ADMIN_NOAUTOSAVE', true);

$project = $this['project'];

if (!$project instanceof Model\Project) {
    throw new Redirection('/admin/projects');
}

$accounts = $this['accounts'];

$filters = $this['filters'];

//arrastramos los filtros
$filter = "?status={$filters['status']}&category={$filters['category']}";


// Superform
?>
<form method="post" action="<?php echo SITE_URL ?>/admin/projects/<?php echo $filter ?>" class="project" enctype="multipart/form-data">

    <?php echo new SuperForm(array(

        'action'        => '',
        'level'         => 3,
        'method'        => 'post',
        'title'         => '',
        'hint'          => 'Es necesario que un proyecto tenga una cuenta PayPal para ejecutar los cargos. La cuenta bancaria es solamente para tener toda la información en el mismo entorno pero no se utiliza en este sistema',
        'class'         => 'aqua',
        'footer'        => array(
            'view-step-preview' => array(
                'type'  => 'submit',
                'name'  => 'save-accounts',
                'label' => Text::get('regular-save'),
                'class' => 'next'
            )
        ),
        'elements'      => array(
            'id' => array (
                'type' => 'hidden',
                'value' => $project->id
            ),
            'bank' => array(
                'type'      => 'textbox',
                'title'     => 'Cuenta bancaria',
                'value'     => $accounts->bank
            ),
            'paypal' => array(
                'type'      => 'textbox',
                'required'  => true,
                'title'     => 'Cuenta paypal',
                'value'     => $accounts->paypal
            )

        )

    ));
    ?>

</form>