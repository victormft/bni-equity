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

// en la página de cofinanciadores, paginación de 20 en 20
require_once 'library/pagination/pagination.php';

//recolocamos los cofinanciadores para la paginacion
$the_investors = array();
foreach ($this['investors'] as $i=>$p) {
    $the_investors[] = $p;
}

$pagedResults = new \Paginated($the_investors, 20, isset($_GET['page']) ? $_GET['page'] : 1);

?>
<div id="sub-header">
    <div>
        <h2><a href="<?php echo SITE_URL ?>/user/<?php echo $user->id; ?>"><img src="<?php echo $user->avatar->getLink(75, 75, true); ?>" /></a> <?php echo Text::get('profile-name-header'); ?> <br /><em><?php echo $user->name; ?></em></h2>
    </div>
</div>

<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>

<div id="main">

    <div class="center">
        <div class="widget project-supporters">
            <h3 class="title"><?php echo Text::get('profile-my_investors-header'); ?></h3>
            <dl class="summary">
                <dt class="supporters"><?php echo Text::get('project-menu-supporters'); ?></dt>
                <dd class="supporters"><?php echo count($this['investors']) ?></dd>
            </dl>

            <div class="supporters">
                <ul>
                <?php while ($investor = $pagedResults->fetchPagedRow()) : ?>
                    <li class="activable"><?php echo new View('view/user/widget/supporter.html.php', array('user' => $investor, 'worthcracy' => $worthcracy)) ?></li>
                <?php endwhile ?>
                </ul>
            </div>

            <ul id="pagination">
                <?php   $pagedResults->setLayout(new DoubleBarLayout());
                        echo $pagedResults->fetchPagedNavigation(); ?>
            </ul>

        </div>
    </div>
    <div class="side">
        <?php echo new View('view/user/widget/sharemates.html.php', $this) ?>
        <?php echo new View('view/user/widget/user.html.php', $this) ?>
    </div>

</div>

<?php include 'view/footer.html.php' ?>

<?php include 'view/epilogue.html.php' ?>
