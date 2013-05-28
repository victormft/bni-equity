<?php
	use Equity\Library\Text,
		Equity\Model\Blog\Post;

    $post = Post::get($this['post'], LANG);
    $level = (int) $this['level'] ?: 3;
    
	if ($this['show'] == 'list') {
		$post->text = Text::recorta($post->text, 500);
	}

    if (empty($this['url'])) {
        $url = '/blog/';
    } else {
        $url = $this['url'];
        $post->text = nl2br(Text::urlink($post->text));
    }
?>
    <?php if (count($post->gallery) > 1) : ?>
		<script type="text/javascript" >
			$(function(){
				$('#post-gallery<?php echo $post->id ?>').slides({
					container: 'post-gallery-container',
					paginationClass: 'slderpag',
					generatePagination: false,
					play: 0
				});
			});
		</script>
    <?php endif; ?>
	<h<?php echo $level + 1?>><a href="<?php echo $url.$post->id; ?>"><?php echo $post->title; ?></a></h><?php echo $level + 1?>>
	<span class="date"><?php echo $post->fecha; ?></span>
	<?php if (!empty($post->tags)) : $sep = '';?>
		<span class="categories">
            <?php foreach ($post->tags as $key => $value) :
                echo $sep.'<a href="<?php echo SITE_URL ?>/blog/?tag='.$key.'">'.$value.'</a>';
            $sep = ', '; endforeach; ?>
        </span>
	<?php endif; ?>
	<?php if (count($post->gallery) > 1) : ?>
        <div id="post-gallery<?php echo $post->id ?>" class="post-gallery">
			<div class="post-gallery-container">
				<?php $i = 1; foreach ($post->gallery as $image) : ?>
				<div class="gallery-image gallery-post<?php echo $post->id ?>" id="gallery-post<?php echo $post->id ?>-<?php echo $i ?>">
					<img src="<?php echo $image->getLink(500, 285); ?>" alt="<?php echo $post->title; ?>" />
				</div>
				<?php $i++; endforeach; ?>
			</div>
			<!-- carrusel de imagenes si hay mas de una -->
                <a class="prev">prev</a>
                    <ul class="slderpag">
                        <?php $i = 1; foreach ($post->gallery as $image) : ?>
                        <li><a href="#" id="navi-gallery-post<?php echo $post->id ?>-<?php echo $i ?>" rel="gallery-post<?php echo $post->id ?>-<?php echo $i ?>" class="navi-gallery-post<?php echo $post->id ?>">
                    <?php echo htmlspecialchars($image->name) ?></a>
                        </li>
                        <?php $i++; endforeach ?>
                    </ul>
                <a class="next">next</a>
			<!-- carrusel de imagenes -->
		</div>
	<?php elseif (!empty($post->image)) : ?>
        <div class="gallery-image gallery-post<?php echo $post->id ?>" id="gallery-post<?php echo $post->id ?>-<?php echo $i ?>">
            <img src="<?php echo $post->image->getLink(500, 285); ?>" alt="<?php echo $post->title; ?>" />
        </div>
	<?php endif; ?>
	<?php if (!empty($post->media->url)) :
            $embed = $post->media->getEmbedCode();
            if (!empty($embed))  : ?>
		<div class="embed"><?php echo $embed; ?></div>
	<?php endif; endif; ?>
	<?php if (!empty($post->legend)) : ?>
		<div class="embed-legend">
			<?php echo $post->legend; ?>
		</div>
	<?php endif; ?>
	<blockquote>
        <?php echo $post->text; ?>
        <?php if ($this['show'] == 'list') : ?><div class="read_more"><a href="<?php echo $url.$post->id; ?>"><?php echo Text::get('regular-read_more') ?></a></div><?php endif ?>
    </blockquote>
