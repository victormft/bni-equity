<?php

use Equity\Core\View,
    Equity\Model;

?>
<?php if (!empty($this['reviews'])) : ?>
    <h2 class="title">Mis revisiones anteriores</h2>
    <?php foreach ($this['reviews'] as $review) : ?>
        <div class="widget">
            <p>El proyecto <strong><?php echo $review->name; ?></strong> de <strong><?php echo $review->owner_name; ?></strong></p>
            <p>La edición del proyecto alcanzó el <strong><?php echo $review->progress; ?>%</strong>, la puntuación de la revisión fue de <strong><?php echo $review->score; ?>/<?php echo $review->max; ?></strong></p>
            <p><a href="<?php echo SITE_URL ?>/review/history/details/<?php echo $review->id; ?>">Ver detalles de la revisión</a></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>