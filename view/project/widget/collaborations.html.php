<?php

use Equity\Library\Text;

$level = (int) $this['level'] ?: 3;

$project = $this['project'];

?>
<div class="widget project-collaborations collapsable" id="project-collaborations">
    
    <h<?php echo $level + 1?> class="supertitle"><?php echo Text::get('project-collaborations-supertitle'); ?></h><?php echo $level ?>>

    <h<?php echo $level ?> class="title"><?php echo Text::get('project-collaborations-title'); ?></h><?php echo $level ?>>
    
    <ul>
        <?php foreach ($project->supports as $support) : ?>
        
        <li class="support <?php echo htmlspecialchars($support->type) ?>">
            <strong><?php echo htmlspecialchars($support->support) ?></strong>
            <p><?php echo htmlspecialchars($support->description) ?></p>
        </li>
        <?php endforeach ?>
    </ul>
    
    <a class="more" href="<?php echo SITE_URL ?>/project/<?php echo $project->id; ?>/needs-non"><?php echo Text::get('regular-see_more'); ?></a>
    <a class="button green" href="<?php echo SITE_URL ?>/project/<?php echo $project->id; ?>/messages"><?php echo Text::get('regular-collaborate'); ?></a>
    
</div>