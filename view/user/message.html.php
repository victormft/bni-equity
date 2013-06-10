<?php

use Equity\Core\View,
    Equity\Library\Worth,
    Equity\Library\Text,
    Equity\Model\User\Interest;

$bodyClass = 'user-profile';
include 'view/prologue.html.php';
include 'view/header.html.php';

$user = $this['user'];
$worthcracy = Worth::getAll();
?>
<script type="text/javascript">
	// Mark DOM as javascript-enabled
	jQuery(document).ready(function ($) {
	    //change div#preview content when textarea lost focus
		$("#message").blur(function(){
			$("#preview").html($("#message").val());
		});

		//add fancybox on #a-preview click
		$("#a-preview").fancybox({
			'titlePosition'		: 'inside',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		});
	});
</script>

<div id="sub-header">
    <div>
        <h2><a href="<?php echo SITE_URL ?>/user/<?php echo $user->id; ?>"><img src="<?php echo $user->avatar->getLink(75, 75, true); ?>" /></a> <?php echo Text::get('profile-name-header'); ?> <br /><em><?php echo $user->name; ?></em></h2>
    </div>
</div>

<div id="main">

    <div class="center">

    <?php if (!empty($_SESSION['user']->id)) : ?>
    <div class="widget user-message">

        <h3 class="title"><?php echo Text::get('user-message-send_personal-header'); ?></h3>

        <form method="post" action="<?php echo SITE_URL ?>/message/personal/<?php echo $user->id; ?>">
            <div id="bocadillo"></div>
            <textarea id="message" name="message" cols="50" rows="5"></textarea>

            <a target="_blank" id="a-preview" href="#preview" class="preview">&middot;<?php echo Text::get('regular-preview'); ?></a>
            <div style="display:none">
                <div id="preview" style="width:400px;height:300px;overflow:auto;">

                    </div>
            </div>



            <button class="green" type="submit"><?php echo Text::get('project-messages-send_message-button'); ?></button>
        </form>

    </div>
    <?php endif; ?>

        <?php echo new View('view/user/widget/worth.html.php', array('worthcracy' => $worthcracy, 'level' => $user->worth)) ?>

        <?php echo new View('view/user/widget/about.html.php', array('user' => $user)) ?>

        <?php echo new View('view/user/widget/social.html.php', array('user' => $user)) ?>

    </div>
    <div class="side">
        <?php echo new View('view/user/widget/investors.html.php', $this) ?>
        <?php echo new View('view/user/widget/sharemates.html.php', $this) ?>
    </div>

</div>

<?php include 'view/footer.html.php' ?>

<?php include 'view/epilogue.html.php' ?>
