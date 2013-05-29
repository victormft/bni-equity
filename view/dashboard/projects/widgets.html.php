<?php

	use Equity\Core\View,
        Equity\Library\Text;
?>
<div class="widget projects">
    <h2 class="widget-title title"><?php echo Text::get('project-spread-widget_title'); ?></h2>
    <?php echo new View('view/project/widget/embed.html.php', array('project'=>$this['project'])) ?>
</div>

