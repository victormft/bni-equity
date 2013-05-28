<?php

use Equity\Library\Worth;

$worthcracy = isset($this['worthcracy']) ? $this['worthcracy'] : Worth::getAll();

if (!isset($this['level'])) $this['level'] = 9999;

// level: nivel que hay que resaltar con el "soy"
// , en este caso el resto de niveles por encima del destacado son grises

?>
<ul class="worthcracy">
<?php foreach ($worthcracy as $level => $worth): ?>
<li class="worth-<?php echo $level ?><?php if ($level <= $this['level']) echo ' done' ?>">
    <span class="threshold">+ de <strong><?php echo $worth->amount ?></strong></span>        
    <?php if ($level == $this['level']) : ?>
    <strong class="name"><?php echo htmlspecialchars($worth->name) ?></strong>
    <?php else: ?>
    <em class="name"><?php echo htmlspecialchars($worth->name) ?></em>        
    <?php endif; ?>
</li>
<?php endforeach ?>
</ul>