<?php

use Equity\Library\Text,
    Equity\Core\ACL;

$translator = ACL::check('/translate') ? true : false;
?>
<div class="widget board">
    <?php if (!empty($this['pages'])) : ?>
    <table>
        <thead>
            <tr>
                <th><!-- Editar --></th>
                <th>Página</th>
                <th>Descripción</th>
                <th><!-- Traducir --></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this['pages'] as $page) : ?>
            <tr>
                <td><a href="<?php echo SITE_URL ?>/admin/pages/edit/<?php echo $page->id; ?>">[Editar]</a></td>
                <td><?php echo $page->name; ?></td>
                <td><?php echo $page->description; ?></td>
                <?php if ($translator) : ?>
                <td><a href="<?php echo SITE_URL ?>/translate/pages/edit/<?php echo $page->id; ?>" >[Traducir]</a></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
    <p>No se han encontrado registros</p>
    <?php endif; ?>
</div>