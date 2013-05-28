<?php

use Equity\Library\Text,
    Equity\Library\Content;

$bodyClass = 'admin';

$table = $this['table'];
$id = $this['id'];

$content = Content::get($table, $id, $_SESSION['translator_lang']);

$sizes = array(
    'title'       => 'cols="100" rows="2"',
    'name'        => 'cols="100" rows="1"',
    'description' => 'cols="100" rows="4"',
    'url'         => 'cols="100" rows="1"',
    'text'        => 'cols="100" rows="10"'
);
?>
<div class="widget board">
    <form action="<?php echo SITE_URL ?>/translate/<?php echo $table ?>/edit/<?php echo $id ?>/<?php echo $this['filter'] . '&page=' . $_GET['page'] ?>" method="post" >
        <input type="hidden" name="table" value="<?php echo $table ?>" />
        <input type="hidden" name="id" value="<?php echo $id ?>" />
        <input type="hidden" name="lang" value="<?php echo $_SESSION['translator_lang'] ?>" />


        <?php foreach (Content::$fields[$table] as $field=>$fieldName) : ?>
        <p>
            <label for="<?php echo 'id'.$field ?>"><?php echo $fieldName ?></label><br />
            <textarea id="<?php echo 'id'.$field ?>" name="<?php echo $field ?>" <?php echo $sizes[$field] ?>><?php echo $content->$field; ?></textarea>
        </p>
        <?php endforeach;  ?>
        <input type="submit" name="save" value="Guardar" />

    </form>
</div>

<div class="widget board">
    <h3>Contenido original</h3>

    <?php foreach (Content::$fields[$table] as $field=>$fieldName) :
        $campo = 'original_'.$field; ?>
        <label for="<?php echo 'id'.$field ?>"><?php echo $fieldName ?>:</label><br />
        <blockquote>
            <?php echo nl2br($content->$campo); ?>
        </blockquote>
        <br />
    <?php endforeach;  ?>


</div>
