<?php
use Equity\Library\Text;
?>
<a href="<?php echo SITE_URL ?>/admin/posts/add" class="button red">Nueva entrada en portada</a>

<div class="widget board">
    <?php if (!empty($this['posts'])) : ?>
    <table>
        <thead>
            <tr>
                <th>Título</th> <!-- title -->
                <th>Posición</th> <!-- order -->
                <td><!-- Move up --></td>
                <td><!-- Move down --></td>
                <td><!-- Remove --></td>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['posts'] as $post) : ?>
            <tr>
                <td><?php echo $post->title; ?></td>
                <td><?php echo $post->order; ?></td>
                <td><a href="<?php echo SITE_URL ?>/admin/posts/up/<?php echo $post->id ?>/home">[&uarr;]</a></td>
                <td><a href="<?php echo SITE_URL ?>/admin/posts/down/<?php echo $post->id ?>/home">[&darr;]</a></td>
                <td><a href="<?php echo SITE_URL ?>/admin/posts/remove/<?php echo $post->id ?>/home">[Quitar de la portada]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>No se han encontrado registros</p>
    <?php endif; ?>
</div>