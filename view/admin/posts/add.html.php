<?php

use Equity\Library\Text,
    Equity\Model;

// sacar los posts publicados y el actual
$posts = Model\Blog\Post::getAll(1);

?>
<div class="widget board">
    <form method="post" action="/admin/posts">

        <input type="hidden" name="action" value="<?php echo $this['action']; ?>" />
        <input type="hidden" name="order" value="<?php echo $this['post']->order; ?>" />
        <input type="hidden" name="home" value="1" />

        <p>
            <label for="home-post">Entrada:</label><br />
            <select id="home-post" name="post">
                <option value="" >Seleccionar la entrada a publicar en portada</option>
            <?php foreach ($posts as $post) : ?>
                <option value="<?php echo $post->id; ?>"<?php if ($this['post']->post == $post->id) echo' selected="selected"';?>><?php echo $post->title . ' ['. $post->date . ']'; ?></option>
            <?php endforeach; ?>
            </select>
        </p>

        <p>Solo se está asignando a la portada una entrada ya publicada. Para gestionar las entradas ir a la <a href="<?php echo SITE_URL ?>/admin/blog" target="_blank">gestión de blog</a></p>

        <input type="submit" name="save" value="Guardar" />
    </form>
</div>