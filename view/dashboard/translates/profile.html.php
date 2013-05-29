<?php

use Equity\Core\View,
    Equity\Library\Text,
    Equity\Library\SuperForm;

$user = $this['user'];
$errors = $this['errors'];

$original = \Equity\Model\User::get($user->id);

$sfid = 'sf-project-profile';
?>

<?php if (isset($this['ownprofile'])) : ?>
<div class="widget">Estas traduciendo tu perfil personal. <a href="<?php echo SITE_URL ?>/dashboard/translates/profile">Volver al perfil del autor del proyecto</a></div>
<?php elseif (!isset($this['noowner']) && $user->id != $_SESSION['user']->id && $_SESSION['user']->roles['translator']->id == 'translator') : ?>
<div class="widget">Estas traduciendo el perfil del autor del proyecto. <a href="<?php echo SITE_URL ?>/dashboard/translates/profile/own">Traducir mi perfil personal</a></div>
<?php endif; ?>

<form method="post" action="<?php echo SITE_URL ?>/dashboard/translates/profile/save" class="project" enctype="multipart/form-data">

<?php echo new SuperForm(array(
    'id'            => $sfid,
    'action'        => '',
    'level'         => 3,
    'method'        => 'post',
    'title'         => '',
    'hint'          => Text::get('guide-project-user-information'),
    'footer'        => array(
        'view-step-preview' => array(
            'type'  => 'submit',
            'name'  => 'save-userProfile',
            'label' => Text::get('regular-save'),
            'class' => 'next'
        )
    ),
    'elements'      => array(
        'process_userProfile' => array (
            'type' => 'hidden',
            'value' => 'userProfile'
        ),
        'id' => array (
            'type' => 'hidden',
            'value' => $user->id
        ),
        'about-orig' => array(
            'type'      => 'html',
            'title'     => Text::get('profile-field-about'),
            'html'     => nl2br($original->about)
        ),
        'about' => array(
            'type'      => 'textarea',
            'cols'      => 40,
            'rows'      => 4,
            'class'     => 'inline',
            'title'     => '',
            'hint'      => Text::get('tooltip-user-about'),
            'errors'    => array(),
            'ok'        => array(),
            'value'     => $user->about
        ),
        'keywords-orig' => array(
            'type'      => 'html',
            'title'     => Text::get('profile-field-keywords'),
            'html'     => $original->keywords
        ),
        'keywords' => array(
            'type'      => 'textbox',
            'size'      => 20,
            'class'     => 'inline',
            'title'     => '',
            'hint'      => Text::get('tooltip-user-keywords'),
            'errors'    => array(),
            'ok'        => array(),
            'value'     => $user->keywords
        ),
        'contribution-orig' => array(
            'type'      => 'html',
            'title'     => Text::get('profile-field-contribution'),
            'html'     => nl2br($original->contribution)
        ),
        'contribution' => array(
            'type'      => 'textarea',
            'cols'      => 40,
            'rows'      => 4,
            'class'     => 'inline',
            'title'     => '',
            'hint'      => Text::get('tooltip-user-contribution'),
            'errors'    => array(),
            'ok'        => array(),
            'value'     => $user->contribution
        )
    )
));
?>
</form>
