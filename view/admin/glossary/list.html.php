<?php

use Equity\Library\Text,
    Equity\Core\ACL;

$translator = ACL::check('/translate') ? true : false;
?>
<a href="<?php echo SITE_URL ?>/admin/glossary/add" class="button red">Nuevo término</a>

<div class="widget board">
    <?php if (!empty($this['posts'])) : ?>
    <table>
        <thead>
            <tr>
                <td><!-- Edit --></td>
                <th>Título</th> <!-- title -->
                <th><!-- Traducir--></th>
                <td><!-- Remove --></td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['posts'] as $post) : ?>
            <tr>
                <td><a href="<?php echo SITE_URL ?>/admin/glossary/edit/<?php echo $post->id; ?>">[Editar]</a></td>
                <td><?php echo $post->title; ?></td>
                <?php if ($translator) : ?>
                <td><a href="<?php echo SITE_URL ?>/translate/glossary/edit/<?php echo $post->id; ?>" >[Traducir]</a></td>
                <?php endif; ?>
                <td><a href="<?php echo SITE_URL ?>/admin/glossary/remove/<?php echo $post->id; ?>" onclick="return confirm('Seguro que deseas eliminar este registro?');">[Quitar]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>No se han encontrado registros</p>
    <?php endif; ?>
</div>