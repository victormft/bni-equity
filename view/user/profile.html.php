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

    jQuery(document).ready(function ($) {

        /* todo esto para cada lista de proyectos (flechitas navegacion) */
        <?php foreach ($this['lists'] as $type=>$list) :
            if(array_empty($list)) continue; ?>
            $("#discover-group-<?php echo $type ?>-1").show();
            $("#navi-discover-group-<?php echo $type ?>-1").addClass('active');
        <?php endforeach; ?>

        $(".discover-arrow").click(function (event) {
            event.preventDefault();

            /* Quitar todos los active, ocultar todos los elementos */
            $(".navi-discover-group-"+this.rev).removeClass('active');
            $(".discover-group-"+this.rev).hide();
            /* Poner acctive a este, mostrar este */
            $("#navi-discover-group-"+this.rel).addClass('active');
            $("#discover-group-"+this.rel).show();
        });

        $(".navi-discover-group").click(function (event) {
            event.preventDefault();

            /* Quitar todos los active, ocultar todos los elementos */
            $(".navi-discover-group-"+this.rev).removeClass('active');
            $(".discover-group-"+this.rev).hide();
            /* Poner acctive a este, mostrar este */
            $("#navi-discover-group-"+this.rel).addClass('active');
            $("#discover-group-"+this.rel).show();
        });

    });
</script>


<div id="sub-header">
    <div>
        <h2><a href="<?php echo SITE_URL ?>/user/<?php echo $user->id; ?>"><img src="<?php echo $user->avatar->getLink(75, 75, true); ?>" /></a> <?php echo Text::get('profile-name-header'); ?> <br /><em><?php echo $user->name; ?></em></h2>
    </div>
</div>

<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>

<div id="main">

    <div class="center">

        <?php echo new View('view/user/widget/worth.html.php', array('worthcracy' => $worthcracy, 'level' => $user->worth)) ?>

        <?php echo new View('view/user/widget/about.html.php', array('user' => $user)) ?>

        <?php echo new View('view/user/widget/social.html.php', array('user' => $user)) ?>


        <?php foreach ($this['lists'] as $type=>$list) :
            if (array_empty($list))
                continue;
            ?>
            <div class="widget projects">
                <h2 class="title"><?php echo Text::get('profile-'.$type.'-header'); ?></h2>
                <?php foreach ($list as $group=>$projects) : ?>
                    <div class="discover-group discover-group-<?php echo $type ?>" id="discover-group-<?php echo $type ?>-<?php echo $group ?>">

                        <div class="discover-arrow-left">
                            <a class="discover-arrow" href="#<?php echo $type; ?>" rev="<?php echo $type ?>" rel="<?php echo $type.'-'.$projects['prev'] ?>">&nbsp;</a>
                        </div>

                        <?php foreach ($projects['items'] as $project) :
                            if ($type == 'my_projects')  {
                                echo new View('view/project/widget/project.html.php', array('project' => $project));
                            } else {
                                echo new View('view/project/widget/project.html.php', array('project' => $project, 'investor' => $user));
                            }
                        endforeach; ?>

                        <div class="discover-arrow-right">
                            <a class="discover-arrow" href="#<?php echo $type; ?>" rev="<?php echo $type ?>" rel="<?php echo $type.'-'.$projects['next'] ?>">&nbsp;</a>
                        </div>

                    </div>
                <?php endforeach; ?>


                <!-- carrusel de cuadritos -->
                <div class="navi-bar">
                    <ul class="navi">
                        <?php foreach (array_keys($list) as $group) : ?>
                        <li><a id="navi-discover-group-<?php echo $type.'-'.$group ?>" href="#<?php echo $type; ?>" rev="<?php echo $type ?>" rel="<?php echo "{$type}-{$group}" ?>" class="navi-discover-group navi-discover-group-<?php echo $type ?>"><?php echo $group ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>

            </div>

        <?php endforeach; ?>

    </div>
    <div class="side">
        <?php if (!empty($_SESSION['user'])) echo new View('view/user/widget/investors.html.php', $this) ?>
        <?php echo new View('view/user/widget/sharemates.html.php', $this) ?>
    </div>

</div>

<?php include 'view/footer.html.php' ?>

<?php include 'view/epilogue.html.php' ?>
