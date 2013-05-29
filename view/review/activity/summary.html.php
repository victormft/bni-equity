<?php

use Equity\Core\View,
    Equity\Model;

?>
<?php if (!empty($this['reviews'])) : ?>
    <h2 class="title">Mis revisiones actuales</h2>
    <?php foreach ($this['reviews'] as $review) : ?>
        <div class="widget">
            <p>El proyecto <strong><?php echo $review->name; ?></strong> de <strong><?php echo $review->owner_name; ?></strong></p>
            <p>La edición del proyecto alcanzó el <strong><?php echo $review->progress; ?>%</strong>, la puntuación actual de la revisión es de <strong><?php echo $review->score; ?>/<?php echo $review->max; ?></strong></p>
            <p>Tu revisión está <?php echo $review->ready == 1 ? 'Lista' : 'Pendiente'; ?><?php if ($review->ready != 1) : ?> Puedes completarla en <a href="<?php echo SITE_URL ?>/review/reviews/evaluate/open/<?php echo $review->id; ?>">tus revisiones</a><?php endif; ?></p>
            <p><a href="<?php echo SITE_URL . '/project/' . $review->project; ?>" target="_blank">Abrir el proyecto</a><br /><a href="<?php echo SITE_URL . '/user/' . $review->owner; ?>" target="_blank">Abrir el perfil del creador</a></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>