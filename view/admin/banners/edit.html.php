<?php


use Equity\Library\Text,
    Equity\Model;

$banner = $this['banner'];

// proyectos disponibles
// si tenemos ya proyecto seleccionado lo incluimos
$projects = Model\Banner::available($banner->project);
$status = Model\Project::status();

?>
<form method="post" action="/admin/banners" enctype="multipart/form-data">
    <input type="hidden" name="action" value="<?php echo $this['action'] ?>" />
    <input type="hidden" name="order" value="<?php echo $banner->order ?>" />
    <input type="hidden" name="id" value="<?php echo $banner->id; ?>" />

<p>
    <label for="banner-project">Projeto:</label><br />
    <select id="banner-project" name="project">
        <option value="" >Selecionar o projeto a ser mostrado no banner</option>
    <?php foreach ($projects as $project) : ?>
        <option value="<?php echo $project->id; ?>"<?php if ($banner->project == $project->id) echo' selected="selected"';?>><?php echo $project->name . ' ('. $status[$project->status] . ')'; ?></option>
    <?php endforeach; ?>
    </select>
</p>

<p>
    <label for="banner-image">Imagem de fundo: 700 x 300 (restrito)</label><br />
    <input type="file" id="banner-image" name="image" />
    <?php if (!empty($banner->image)) : ?>
        <br />
        <input type="hidden" name="prev_image" value="<?php echo $banner->image->id ?>" />
        <img src="<?php echo $banner->image->getLink(700, 300, true) ?>" title="Fondo album" alt="falla imagen"/>
    <?php endif; ?>
</p>

    <input type="submit" name="save" value="Guardar" />
</form>
