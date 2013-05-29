<?php

use Equity\Core\View,
    Equity\Library\Text,
    Equity\Library\Worth;

$project = $this['project'];

$level = (int) $this['level'] ?: 3;

$reached    = \amount_format($project->invested);
$supporters = count($project->investors);

$worthcracy = Worth::getAll();

$investors = array();

foreach ($project->investors as $user=>$investor) {
    $investors[] = $investor;
}


// en la p�gina de cofinanciadores, paginaci�n de 20 en 20
require_once 'library/pagination/pagination.php';

$pagedResults = new \Paginated($investors, 20, isset($_GET['page']) ? $_GET['page'] : 1);


?>
<div class="widget project-supporters">
    
    <h<?php echo $level ?> class="title"><?php echo Text::get('project-menu-supporters'); ?></h><?php echo $level ?>>
    
    <dl class="summary">
        <dt class="supporters"><?php echo Text::get('project-menu-supporters'); ?></dt>
        <dd class="supporters"><?php echo $supporters ?></dd>
        
        <dt class="reached"><?php echo Text::get('project-invest-total'); ?></dt>
        <dd class="reached"><?php echo $reached ?> <span class="euro">&euro;</span></dd>
        
    </dl>   
        
    <div class="supporters">
        <ul>
        <?php while ($investor = $pagedResults->fetchPagedRow()) : ?>
            <li><?php echo new View('view/user/widget/supporter.html.php', array('user' => $investor, 'worthcracy' => $worthcracy)) ?></li>
        <?php endwhile ?>
        </ul>            
    </div>        

    <ul id="pagination">
        <?php   $pagedResults->setLayout(new DoubleBarLayout());
                echo $pagedResults->fetchPagedNavigation(); ?>
    </ul>

</div>