<?php

?>
<div id="project-selector">
    <?php if (!empty($this['projects'])) : ?>
        <form id="selector-form" name="selector_form" action="<?php echo SITE_URL ?><?php echo '/dashboard/'.$this['section'].'/'.$this['option'].'/select'; ?>" method="post">
        <label for="selector">Proyecto:</label>
        <select id="selector" name="project" onchange="document.getElementById('selector-form').submit();">
        <?php foreach ($this['projects'] as $project) : ?>
            <option value="<?php echo $project->id; ?>"<?php if ($project->id == $_SESSION['project']->id) echo ' selected="selected"'; ?>><?php echo $project->name; ?></option>
        <?php endforeach; ?>
        </select>
        <!-- un boton para seleccionar si no tiene javascript -->
        </form>
    <?php else : ?>
    <p>No tienes ning&uacute;n proyecto, puedes crear uno <a href="<?php echo SITE_URL ?>/project/create">aqu&iacute;</a></p>
    <?php endif; ?>
</div>
