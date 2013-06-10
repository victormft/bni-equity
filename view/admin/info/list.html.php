<?php

use Equity\Library\Text,
    Equity\Core\ACL;

$translator = ACL::check('/translate') ? true : false;
?>
<a href="<?php echo SITE_URL ?>/admin/info/add" class="button red">Nueva idea</a>

<div class="widget board">
    <?php if (!empty($this['posts'])) : ?>
    <table>
        <thead>
            <tr>
                <td><!-- Edit --></td>
                <th>Título</th> <!-- title -->
                <th>Publicada</th> <!-- publish -->
                <th>Posición</th> <!-- order -->
                <td><!-- Move up --></td>
                <td><!-- Move down --></td>
                <th><!-- Traducir--></th>
                <td><!-- Remove --></td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['posts'] as $post) : ?>
            <tr>
                <td><a href="<?php echo SITE_URL ?>/admin/info/edit/<?php echo $post->id; ?>">[Editar]</a></td>
                <td><?php echo $post->title; ?></td>
                <td><?php echo $post->publish ? 'Sí' : 'No'; ?></td>
                <td><?php echo $post->order; ?></td>
                <td><a href="<?php echo SITE_URL ?>/admin/info/up/<?php echo $post->id ?>">[&uarr;]</a></td>
                <td><a href="<?php echo SITE_URL ?>/admin/info/down/<?php echo $post->id ?>">[&darr;]</a></td>
                <?php if ($translator) : ?>
                <td><a href="<?php echo SITE_URL ?>/translate/info/edit/<?php echo $post->id; ?>" >[Traducir]</a></td>
                <?php endif; ?>
                <td><a href="<?php echo SITE_URL ?>/admin/info/remove/<?php echo $post->id; ?>" onclick="return confirm('Seguro que deseas eliminar este registro?');">[Quitar]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>No se han encontrado registros</p>
    <?php endif; ?>
</div>