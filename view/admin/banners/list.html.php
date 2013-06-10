<?php


use Equity\Library\Text;

?>
<a href="<?php echo SITE_URL ?>/admin/banners/add" class="button red">Nuevo banner</a>

<div class="widget board">
    <?php if (!empty($this['bannered'])) : ?>
    <table>
        <thead>
            <tr>
                <th>Proyecto</th> <!-- preview -->
                <th>Estado</th> <!-- status -->
                <th>Posición</th> <!-- order -->
                <th><!-- Subir --></th>
                <th><!-- Bajar --></th>
                <th><!-- Editar--></th>
                <th><!-- Quitar--></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['bannered'] as $banner) : ?>
            <tr>
                <td><a href="<?php echo SITE_URL ?>/project/<?php echo $banner->project; ?>" target="_blank" title="Preview"><?php echo $banner->name; ?></a></td>
                <td><?php echo $banner->status; ?></td>
                <td><?php echo $banner->order; ?></td>
                <td><a href="<?php echo SITE_URL ?>/admin/banners/up/<?php echo $banner->project; ?>">[&uarr;]</a></td>
                <td><a href="<?php echo SITE_URL ?>/admin/banners/down/<?php echo $banner->project; ?>">[&darr;]</a></td>
                <td><a href="<?php echo SITE_URL ?>/admin/banners/edit/<?php echo $banner->project; ?>">[Editar]</a></td>
                <td><a href="<?php echo SITE_URL ?>/admin/banners/remove/<?php echo $banner->project; ?>">[Quitar]</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>No se han encontrado registros</p>
    <?php endif; ?>
</div>