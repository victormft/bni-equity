<?php

use Equity\Core\View,
    Equity\Library\Worth,
    Equity\Library\Text,
    Equity\Model\User\Interest,
    Equity\Core\Redirection;

$bodyClass = 'user-profile';
include 'view/prologue.html.php';
include 'view/header.html.php';

$user = $this['user'];
$worthcracy = Worth::getAll();

$categories = Interest::getAll($user->id);

if (empty($categories)) {
    throw new Redirection('/user/profile/' . $this['user']->id);
}

$shares = array();
/* if (!empty($this['category'])) {
    $shares[$this['category']->id] = Interest::share($user->id, $this['category']->id);
} else { */
    foreach ($categories as $catId => $catName) {
        $gente = Interest::share($user->id, $catId);
        if (count($gente) == 0) continue;
        $shares[$catId] = $gente;
    }
//}

if (empty($shares)) {
    throw new Redirection('/user/profile/' . $this['user']->id);
}

?>
<div id="sub-header">
    <div>
        <h2><a href="<?php echo SITE_URL ?>/user/<?php echo $user->id; ?>"><img src="<?php echo $user->avatar->getLink(75, 75, true); ?>" /></a> <?php echo Text::get('profile-name-header'); ?> <br /><em><?php echo $user->name; ?></em></h2>
    </div>
</div>

<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>

<div id="main">

    <div class="center">
       
       
       <!-- lista de categor�as -->
        <div class="widget categorylist">
            <h3 class="title"><?php echo Text::get('profile-sharing_interests-header');?></h3>
			<!--
            <div class="filters">
                <span>Ver por:</span>
                <ul>
                    <li><a href="#" class="active">Por categor�as</a></li>
                    <li class="separator">|</li>
                    <li><a href="#">Por tags</a></li>                
                </ul>
            </div>
			-->
            <script type="text/javascript">
            function displayCategory(categoryId){
                $(".user-mates").css("display","none");
                $("#cat" + categoryId).fadeIn("slow");
                $(".active").removeClass('active');
                $("#catlist" + categoryId).addClass('active');
            }
            </script>
            <div class="list">
                <ul>
                    <?php foreach ($categories as $catId=>$catName) : if (count($shares[$catId]) == 0) continue; ?>
                    <li><a id="catlist<?php echo $catId ?>" href="<?php echo SITE_URL ?>/user/profile/<?php echo $this['user']->id ?>/sharemates/<?php echo $catId ?>" <?php if (!empty($this['category'])) : ?>onclick="displayCategory(<?php echo $catId ?>); return false;"<?php endif; ?> <?php if ($catId == $this['category']) echo 'class="active"'?>><?php echo $catName ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- fin lista de categor�as -->
        
        <!-- detalle de categor�a (cabecera de categor�a) -->
        <?php foreach ($shares as $catId => $sharemates) :
            if (count($sharemates) == 0) continue;
            ?>
            <div class="widget user-mates" id="cat<?php echo $catId;?>" <?php if (!empty($this['category']) && $catId != $this['category']) echo 'style="display:none;"'?>>
                <h3 class="title"><?php echo $categories[$catId] ?></h3>
                <div class="users">
                    <ul>
                    <?php 
                    $cnt = 1;
                    foreach ($sharemates as $mate) :
                        if (empty($this['category']) && $cnt > 6) break;
                    ?>
                        <li>
                            <div class="user">
                                <a href="<?php echo SITE_URL ?>/user/<?php echo htmlspecialchars($mate->user) ?>" class="expand">&nbsp;</a>
                                <div class="avatar"><a href="<?php echo SITE_URL ?>/user/<?php echo htmlspecialchars($mate->user) ?>"><img src="<?php echo $mate->avatar->getLink(43, 43, true) ?>" /></a></div>
                                <h4><a href="<?php echo SITE_URL ?>/user/<?php echo htmlspecialchars($mate->user) ?>"><?php echo htmlspecialchars($mate->name) ?></a></h4>
                                <span class="projects"><?php echo Text::get('regular-projects'); ?> (<?php echo $mate->projects ?>)</span>
                                <span class="invests"><?php echo Text::get('regular-investing'); ?> (<?php echo $mate->invests ?>)</span><br/>
                                <span class="profile"><a href="<?php echo SITE_URL ?>/user/profile/<?php echo htmlspecialchars($mate->user) ?>"><?php echo Text::get('profile-widget-button'); ?></a> </span>
                                <span class="contact"><a href="<?php echo SITE_URL ?>/user/profile/<?php echo htmlspecialchars($mate->user) ?>/message"><?php echo Text::get('regular-send_message'); ?></a></span>
                            </div>
                        </li>
                    <?php 
                    $cnt ++;
                    endforeach; ?>
                    </ul>
                </div>
        <?php if (empty($this['category'])) : ?>
            <a class="more" href="<?php echo SITE_URL ?>/user/profile/<?php echo $this['user']->id ?>/sharemates/<?php echo $catId ?>"><?php echo Text::get('regular-see_more'); ?></a>
        <?php else : ?>
            <a class="more" href="<?php echo SITE_URL ?>/user/profile/<?php echo $this['user']->id ?>/sharemates"><?php echo Text::get('regular-see_all'); ?></a>
        <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <!-- fin detalle de categor�a (cabecera de categor�a) -->
        
    </div>
    <div class="side">
        <?php if (!empty($_SESSION['user'])) echo new View('view/user/widget/investors.html.php', $this) ?>
        <?php echo new View('view/user/widget/user.html.php', $this) ?>
    </div>

</div>

<?php include 'view/footer.html.php' ?>

<?php include 'view/epilogue.html.php' ?>
