<?php 
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

use Goteo\Core\View,
    Goteo\Library\Text;

$currentPost = $this['posts'][$this['post']];

$bodyClass = 'home';
// para que el prologue ponga el código js para botón facebook en el bannerside
$fbCode = Text::widget(Text::get('social-account-facebook'), 'fb');
include 'view/prologue.html.php';
include 'view/header.html.php';
?>
<!--
<script type="text/javascript">
    $(function(){
        $('#sub-header').slides();
    });
</script>
-->
<div id="sub-header" class="banners">
    <div class="clearfix">
        <div id="slider">
            <!-- Módulo de texto más sign in -->
        <!--    <div class="subhead-banner"><?php echo Text::html('main-banner-header'); ?></div> -->
            <!-- Módulo banner imagen más resumen proyecto -->
            <?php $width=1; if (!empty($this['banners'])) : foreach ($this['banners'] as $id=>$banner) : ?>
            <div id="subhead-banner" class="subhead-banner<?php echo $width ?>"><?php $width = $width+1; echo new View('view/header/banner.html.php', array('banner'=>$banner)); ?></div>
            <?php endforeach;
            else : ?>
            <div class="subhead-banner"><?php echo Text::html('main-banner-header'); ?></div>
            <?php endif; ?>
        </div>
        <!-- <div class="mod-pojctopen"><?php echo Text::html('open-banner-header', $fbCode); ?></div> -->
    </div> 
  <!--  <div class="sliderbanners-ctrl" style="width:<?php echo (32+$width*18) ?>px; margin: 0 auto;">
        <a class="prev">prev</a>
        <ul class="paginacion"></ul>
        <a class="next">next</a>
    </div>
    -->
</div>

<!--
<div id="msg-home">
	<div class="title">A primeira plataforma de Equity Crowdfunding do Brasil </div>
	<div class="text">Com o BNIEquity é possível tornar-se sócio de empresas que estão começando agora e que precisam de um suporte financeiro.</div>
</div>
-->
<div class="space" style="height:10px; margin-bottom:30px;"></div>

<div id="main">

    <?php if (!empty($this['posts'])): ?>
    <script type="text/javascript">
        $(function(){
            $('#learn').slides({
                container: 'slder_container',
                paginationClass: 'slderpag',
                generatePagination: false,
                play: 0
            });
        });
    </script>
    <div id="learn" class="widget learn">
        <h2 class="title"><?php echo Text::get('home-posts-header'); ?></h2>
        <div class="slder_container"<?php if (count($this['posts'])==1) echo ' style="display:block;"'; ?>>

            <?php $i = 1; foreach ($this['posts'] as $post) : ?>
            <div class="slder_slide">
                <div class="post" id="home-post-<?php echo $i; ?>" style="display:block;">
                    <?php  if (!empty($post->media->url)) : ?>
                        <div class="embed">
                            <?php echo $post->media->getEmbedCode(); ?>
                        </div>
                    <?php elseif (!empty($post->image)) : ?>
                        <div class="image">
                            <img src="<?php echo $post->image->getLink(500, 285); ?>" alt="Imagen"/>
                        </div>
                    <?php endif; ?>
                    <h3><?php echo $post->title; ?></h3>
                    <div class="description">
                <?php echo Text::recorta($post->text, 600) ?>
                    </div>

                    <div class="read_more"><a href="/blog/<?php echo $post->id; ?>"><?php echo Text::get('regular-read_more') ?></a></div>
                </div>
            </div>
            <?php $i++; endforeach; ?>
        </div>
        <a class="prev">prev</a>
        <ul class="slderpag">
            <?php $i = 1; foreach ($this['posts'] as $post) : ?>
            <li><a href="#" id="navi-home-post-<?php echo $i ?>" rel="home-post-<?php echo $i ?>" class="tipsy navi-home-post" title="<?php echo htmlspecialchars($post->title) ?>">
                <?php echo htmlspecialchars($post->title) ?></a>
            </li>
            <?php $i++; endforeach ?>
        </ul>
        <a class="next">next</a>

    </div>

    <?php endif; ?>
<!--
    <?php //if (!empty($this['promotes'])): ?>
    <div class="widget projects">

        <h2 class="title"><?php //echo Text::get('home-promotes-header'); ?></h2>

        <?php //foreach ($this['promotes'] as $promo) : ?>

                <?php //echo new View('view/project/widget/project.html.php', array(
                 //   'project' => $promo->projectData,
                    //'balloon' => '<h4>' . htmlspecialchars($promo->title) . '</h4>' .
                   //              '<blockquote>' . $promo->description . '</blockquote>'
                //)) ?>

        <?php //endforeach ?>

    </div>
<?php //endif; ?>

-->    

<script type="text/javascript">
	$(document).ready(function() {
	$("a#dynamic").click(function() { // inclui todos os links com id="dynamic"
		$("#dynamicContent").load($(this).attr("href")); // carrega o conteúdo da página em HREF dentro da DIV #dynamicContent (id="dynamicContent")
		$(".dynamic_select.active").removeClass("active");
		$(this).children().addClass("active");
		return false; // remove a ação do link para navegar até a página do HREF, pois ela já foi carregada na DIV
	});
});
</script>

    
   		<a id="dynamic" href="/discover/view_ajax/highlighted">
			<div class="dynamic_select active">
       			<span>highlighted</spam>
        	</div>
        </a>
        <a id="dynamic" href="/discover/view_ajax/recent">
        	<div class="dynamic_select">
				<span>recent</span>
			</div>
        </a>
        <div class="clear"><p></p></div>

    <div class="widget projects" id="dynamicContent">
		





<!--    
 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!   
 -->   



<?php echo new View(
                'view/discover/ajax.html.php',
                $this['viewData']
             );
?>    
<!--
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
-->       








    </div>
    
    

</div>
<?php include 'view/footer.html.php'; ?>
<?php include 'view/epilogue.html.php'; ?>