<?php

use Equity\Core\View,
    Equity\Library\Text,
    Equity\Model\User\Interest;

$user = $this['user'];

$categories = Interest::getAll($user->id);

$shares = array();
foreach ($categories as $catId => $catName) {
    $shares[$catId] = Interest::share($user->id, $catId);
}


?>
<script type="text/javascript">
function displayCategories(categoryId1,categoryId2){
	$("div.users").css("display","none");
	$("#mates-" + categoryId1).fadeIn("slow");
	$("#mates-" + categoryId2).fadeIn("slow");
}
</script>
<div class="widget user-mates">
	<!-- categorias -->
    <h3 class="supertitle"><?php echo Text::get('profile-sharing_interests-header'); ?></h3>
    <div class="categories">    
    <?php $keys = array_keys($categories);?>
    <ul>       
        <?php 
		$cnt = 0;
		foreach ($categories as $catId=>$catName) {
            if (count($shares[$catId]) == 0) {$cnt++;continue;} ?>
            <li><a href="#" onclick="displayCategories(<?php echo $catId;?>,
            <?php 
			if(($cnt+1)==count($categories))echo $keys[0];
			else echo $keys[$cnt+1];
			$cnt++;
			?>
            ); return false;">
            <?php echo $catName?></a></li>
        <?php 	
		} ?>
    </ul>
    </div>
    
    
    <!-- usuarios sociales -->
    <?php
    // mostramos 2
    $muestra = 1;
	
    foreach ($shares as $catId => $sharemates) {
        if (count($sharemates) == 0) continue;
        ?>
    <div class="users" id="mates-<?php echo $catId ?>" 
	<?php if ($muestra > 2) {echo 'style="display:none;"';} else {$muestra++;} ?>>
	    
        <h3 class="supertitle"><?php echo $categories[$catId] ?></h3>

        <!--pintar usuarios -->
        <ul>
        <?php $c=1; // limitado a 6 sharemates en el lateral
        foreach ($sharemates as $mate){ ?>
            <li class="activable<?php if(($c%2)==0)echo " nomarginright"?>">            	
                <div class="user">
                	<a href="<?php echo SITE_URL ?>/user/<?php echo htmlspecialchars($mate->user) ?>" class="expand">&nbsp;</a>
                    <div class="avatar">
                        <a href="<?php echo SITE_URL ?>/user/<?php echo htmlspecialchars($mate->user) ?>">
                            <img src="<?php echo $mate->avatar->getLink(43, 43, true) ?>" />
                        </a>
                    </div>
                    <h4>
                    	<a href="<?php echo SITE_URL ?>/user/<?php echo htmlspecialchars($mate->user) ?>">
						<?php echo htmlspecialchars(Text::recorta($mate->name,20)) ?>
                        </a>
                    </h4>
                    <span class="projects">
						<?php echo Text::get('regular-projects'); ?> (<?php echo $mate->projects ?>)
                    </span>
                    <span class="invests">
						<?php echo Text::get('regular-investing'); ?> (<?php echo $mate->invests ?>)
                    </span>
                </div>
            </li>
        <?php if ($c>5) break; else $c++;
		} ?>
        
        </ul>
        <a class="more" href="<?php echo SITE_URL ?>/user/profile/<?php echo $this['user']->id ?>/sharemates/<?php echo $catId ?>"><?php echo Text::get('regular-see_more'); ?></a>
    </div>
    <?php } ?>
    
</div>