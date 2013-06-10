<?php


use Equity\Library\Text,
    Equity\Core\ACL;

$translator = ACL::check('/translate') ? true : false;
?>
<a href="<?php echo SITE_URL ?>/admin/blog/add" class="button red">Nueva entrada</a>

<div class="widget board">
    <?php if (!empty($this['posts'])) : ?>
    <table>
        <thead>
            <tr>
                <td><!-- Edit --></td>
                <th>Título</th> <!-- title -->
                <th>Fecha</th> <!-- date -->
                <th>Publicado</th>
                <th>En portada</th>
                <th>Al pie</th>
                <th><!-- Traducir--></th>
                <td><!-- Remove --></td>
                <td></td><!-- preview -->
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['posts'] as $post) : ?>
            <tr>
                <td><a href="<?php echo SITE_URL ?>/admin/blog/edit/<?php echo $post->id; ?>">[Editar]</a></td>
                <td><?php echo $post->title; ?></td>
                <td><?php echo $post->date; ?></td>
                <td><?php echo $post->publish ? 'Sí' : ''; ?></td>
                <td><?php echo $post->home ? 'Sí' : ''; ?></td>
                <td><?php echo $post->footer ? 'Sí' : ''; ?></td>
                <?php if ($translator) : ?>
                <td><a href="<?php echo SITE_URL ?>/translate/post/edit/<?php echo $post->id; ?>" >[Traducir]</a></td>
                <?php endif; ?>
                <td><a href="<?php echo SITE_URL ?>/admin/blog/remove/<?php echo $post->id; ?>" onclick="return confirm('Seguro que deseas eliminar este registro?');">[Quitar]</a></td>
                <td><a href="<?php echo SITE_URL ?>/blog/<?php echo $post->id; ?>?preview=<?php echo $_SESSION['user']->id ?>" target="_blank">[Ver publicado]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>No se han encontrado registros</p>
    <?php endif; ?>
</div>