<?php

use Equity\Library\Text,
    Equity\Core\ACL;

$translator = ACL::check('/translate') ? true : false;
?>
<!-- <a href="<?php echo SITE_URL ?>/admin/icons/add/?filter=<?php echo $this['filter']; ?>" class="button red">Añadir tipo</a> -->

<div class="widget board">
    <form id="groupfilter-form" action="<?php echo SITE_URL ?>/admin/icons" method="get">
        <label for="group-filter">Mostrar los tipos para:</label>
        <select id="group-filter" name="filter" onchange="document.getElementById('groupfilter-form').submit();">
            <option value="">Todo</option>
        <?php foreach ($this['groups'] as $groupId=>$groupName) : ?>
            <option value="<?php echo $groupId; ?>"<?php if ($this['filter'] == $groupId) echo ' selected="selected"';?>><?php echo $groupName; ?></option>
        <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="widget board">
    <?php if (!empty($this['icons'])) : ?>
    <table>
        <thead>
            <tr>
                <th><!-- Editar --></th>
                <th>Nombre</th> <!-- name -->
                <th>Tooltip</th> <!-- descripcion -->
                <th>Agrupación</th> <!-- group -->
                <th><!-- Traducir--></th>
<!--                        <th> Remove </th>  -->
            </tr>
        </thead>

        <tbody>
            <?php foreach ($this['icons'] as $icon) : ?>
            <tr>
                <td><a href="<?php echo SITE_URL ?>/admin/icons/edit/<?php echo $icon->id; ?>/?filter=<?php echo $this['filter']; ?>">[Editar]</a></td>
                <td><?php echo $icon->name; ?></td>
                <td><?php echo $icon->description; ?></td>
                <td><?php echo !empty($icon->group) ? $this['groups'][$icon->group] : 'Ambas'; ?></td>
                <?php if ($translator) : ?>
                <td><a href="<?php echo SITE_URL ?>/translate/icon/edit/<?php echo $icon->id; ?>" >[Traducir]</a></td>
                <?php endif; ?>
                <!-- <td><a href="<?php echo SITE_URL ?>/admin/icons/remove/<?php echo $icon->id; ?>/?filter=<?php echo $this['filter']; ?>" onclick="return confirm('Seguro que deseas eliminar este registro?');">[Quitar]</a></td> -->
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <?php else : ?>
    <p>No se han encontrado registros</p>
    <?php endif; ?>
</div>