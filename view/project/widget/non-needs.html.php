<?php

use Equity\Library\Text;

$project = $this['project'];
$types   = $this['types'];
$level = (int) $this['level'] ?: 3;

$minimum    = $project->mincost;
$optimum    = $project->maxcost;

// separar los costes por tipo
$items = array();

foreach ($project->supports as $item) {
    
    $items[$item->type][] = (object) array(
        'name' => $item->support,
        'description' => $item->description
    );
}


?>
<div class="widget project-needs">
        
    <h<?php echo $level ?> class="title"><?php echo Text::get('project-collaborations-title'); ?></h><?php echo $level ?>>
           
    <table width="100%">
        
        <?php foreach ($items as $type => $list): ?>
        
        <thead class="<?php echo htmlspecialchars($type)?>">
            <tr>
                <th class="summary"><?php echo htmlspecialchars($types[$type]) ?></th>
            </tr>            
        </thead>
        
        <tbody>            
            <?php foreach ($list as $item): ?>
            <tr class="noreq">
                <th class="summary"><strong><?php echo htmlspecialchars($item->name) ?></strong>
                <blockquote style="font-weight:normal;"><?php echo $item->description ?></blockquote>
                <a class="button green" href="<?php echo SITE_URL ?>/project/<?php echo $project->id; ?>/messages"><?php echo Text::get('regular-collaborate'); ?></a>
                </th>
            </tr>            
            <?php endforeach ?>
        </tbody>
        
        <?php endforeach ?>
                                        
    </table>
    
</div>