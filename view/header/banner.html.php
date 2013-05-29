<?php

use Equity\Library\Text,
	Equity\Model\Project\Category;

$banner = $this['banner'];

$categories = Category::getNames($banner->project->id);

$metter_txt = Text::get('regular-banner-metter');
list($mreach, $mof, $mrest) = explode('-', $metter_txt);
?>
<a href="<?php echo SITE_URL ?>/project/<?php echo $banner->project->id ?>" class="expand"></a>
<div class="shb-info clearfix">
    <h2><?php echo $banner->project->name ?></h2>
    <small><?php echo "Founder: " ?><span><?php echo $banner->project->user->name ?></span></small>
    <small><?php echo "Categories: " ?><span><?php $sep = ''; foreach ($categories as $key=>$value) :
            echo $sep.htmlspecialchars($value);
        $sep = ', '; endforeach; ?></span></small>
    <small class="description"><span style="font-style:italic;"><?php echo "\"".$banner->project->description."\"" ?></span></small>
    <small><?php echo "Goal: " ?><span><?php echo "R$ ".\amount_format(htmlspecialchars($banner->project->mincost)) ?></span></small>
    
    <!--<div class="col-return clearfix">
        <h3><?php echo Text::get('project-rewards-social_reward-title') ?></h3>
        <p><?php echo current($banner->project->social_rewards)->reward ?></p>
        <ul>
            <?php $c = 1; foreach ($banner->project->social_rewards as $id=>$reward) : ?>
            <li><img src="<?php echo SRC_URL ?>/view/css/icon/s/<?php echo $reward->icon ?>.png" alt="<?php echo $reward->icon ?>" title="<?php echo $reward->reward ?>" /></li>
            <?php if ($c>4) break; else $c++; endforeach; ?>
        </ul>
     
      <!--  <div class="license"><?php foreach ($banner->project->social_rewards as $id=>$reward) :
            if (empty($reward->license)) continue; ?>
            <img src="<?php echo SRC_URL ?>/view/css/license/<?php echo $reward->license ?>.png" alt="<?php echo $reward->license ?>" /></div>
            <?php break; endforeach; ?>
       -->
<!--       
    </div>
    <ul class="financ-meter">
        <li><?php echo $mreach ?></li>
        <li class="reached"><?php echo \amount_format($banner->project->amount) ?> <img src="<?php echo SRC_URL ?>/view/css/euro/blue/s.png" alt="&euro;" /></li>
        <li><?php echo $mof ?></li>
        <li class="optimun"><?php echo ($banner->project->amount >= $banner->project->mincost) ? \amount_format($banner->project->maxcost) : \amount_format($banner->project->mincost); ?> <img src="<?php echo SRC_URL ?>/view/css/euro/violet/s.png" alt="&euro;" /></li>
        <?php if ($banner->project->days > 0) : ?>
        <li><?php echo $mrest ?></li>
        <li class="days"><?php echo $banner->project->days ?> <?php echo Text::get('regular-days') ?></li>
        <?php endif; ?>
    </ul>
-->
</div>
<div class="shb-img">
    <img src="<?php echo $banner->image->getLink(310, 230, true) ?>" title="<?php echo $banner->project->name ?>" alt="<?php echo $banner->project->name ?>" />    

	<div class="status">
        <ul>
                <li>
                    <strong><?php echo number_format(round(($banner->project->invested / $banner->project->mincost) * 100)) ?>%</strong>
                    <p>Atingidos</p>
                </li>
                <li>
                    <strong>R$
                        <span><?php echo \amount_format(htmlspecialchars($banner->project->invested)) ?></span>
                    </strong>
                    <p>Investidos</p>
                </li>
                <li>
                    <strong><?php echo number_format(htmlspecialchars($banner->project->days)) ?> dias</strong>
                    <p>Restantes</p>
                </li>
        </ul>
    </div>

</div>


