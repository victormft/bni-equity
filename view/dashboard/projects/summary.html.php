<?php

use Equity\Core\View,
    Equity\Library\Text,
    Equity\Model\Project;

$project = $this['project'];

if (!$project instanceof  Equity\Model\Project) {
    return;
}
?>
<div class="widget">
    <p><strong><?php echo $project->name ?></strong></p>
    <a class="button red" href="<?php echo SITE_URL ?>/project/edit/<?php echo $project->id ?>"><?php echo Text::get('regular-edit') ?></a>
    <a class="button" href="<?php echo SITE_URL ?>/project/<?php echo $project->id ?>" target="_blank"><?php echo Text::get('dashboard-menu-projects-preview') ?></a>
    <?php if ($project->status == 1) : ?>
    <a class="button weak" href="<?php echo SITE_URL ?>/project/delete/<?php echo $project->id ?>" onclick="return confirm('<?php echo Text::get('dashboard-project-delete_alert') ?>')"><?php echo Text::get('regular-delete') ?></a>
    <?php endif ?>
</div>

<div class="status">

    <div id="project-status">
        <h3><?php echo Text::get('form-project-status-title'); ?></h3>
        <ul>
            <?php foreach (Project::status() as $i => $s): ?>
            <li><?php if ($i == $project->status) echo '<strong>' ?><?php echo htmlspecialchars($s) ?><?php if ($i == $project->status) echo '</strong>' ?></li>
            <?php endforeach ?>
        </ul>
    </div>

</div>

<div id="meter-big" class="widget collapsable">

    <?php echo new View('view/project/meter_hor_big.html.php', $this) ?>
    
</div>

