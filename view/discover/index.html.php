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
	Goteo\Model\Category,
	Goteo\Library\Text;

$bodyClass = 'discover';
$categories = Category::getList();
include 'view/prologue.html.php';
include 'view/header.html.php' ?>

<script type="text/javascript">	
    jQuery(document).ready(function ($) {
        /* todo esto para cada tipo de grupo */
        <?php foreach ($this['lists'] as $type=>$list) :
            if(array_empty($list)) continue; ?>
            $("#discover-group-<?php echo $type ?>-1").show();
            $("#navi-discover-group-<?php echo $type ?>-1").addClass('active');
        <?php endforeach; ?>

        $(".discover-arrow").click(function (event) {
            event.preventDefault();

            /* Quitar todos los active, ocultar todos los elementos */
            $(".navi-discover-group-"+this.rev).removeClass('active');
            $(".discover-group-"+this.rev).hide();
            /* Poner acctive a este, mostrar este */
            $("#navi-discover-group-"+this.rel).addClass('active');
            $("#discover-group-"+this.rel).show();
        });

        $(".navi-discover-group").click(function (event) {
            event.preventDefault();

            /* Quitar todos los active, ocultar todos los elementos */
            $(".navi-discover-group-"+this.rev).removeClass('active');
            $(".discover-group-"+this.rev).hide();
            /* Poner acctive a este, mostrar este */
            $("#navi-discover-group-"+this.rel).addClass('active');
            $("#discover-group-"+this.rel).show();
        });
    });
</script>
    <div id="sub-header">
        <div>
            <h2><?php echo Text::html('discover-banner-header') ?></h2>
        </div>
    </div>

    <div id="main">
        <?php //echo new View('view/discover/searcher.html.php',
                //            array(
                  //              'categories' => $categories,
                    //            'locations'  => $locations,
                      //          'rewards'    => $rewards
                        //    )
           // ); ?>

    <?php foreach ($this['lists'] as $type=>$list) :
        if (array_empty($list))
            continue;
        ?>
        <div class="widget projects" id="dynamicContent">
            <h2 class="title"><?php echo $this['title'][$type] ?></h2>
            <?php foreach ($list as $group=>$projects) : ?>
                <div class="discover-group discover-group-<?php echo $type ?>" id="discover-group-<?php echo $type ?>-<?php echo $group ?>">

                    <div class="discover-arrow-left">
                        <a class="discover-arrow" href="/discover/view/<?php echo $type; ?>" rev="<?php echo $type ?>" rel="<?php echo $type.'-'.$projects['prev'] ?>">&nbsp;</a>
                    </div>

                    <?php foreach ($projects['items'] as $project) :
                        echo new View('view/project/widget/project.html.php', array('project' => $project));
                    endforeach; ?>

                    <div class="discover-arrow-right">
                        <a class="discover-arrow" href="/discover/view/<?php echo $type; ?>" rev="<?php echo $type ?>" rel="<?php echo $type.'-'.$projects['next'] ?>">&nbsp;</a>
                    </div>

                </div>
            <?php endforeach; ?>


            <!-- carrusel de imagenes -->
            <div class="navi-bar">
                <ul class="navi">
                    <?php foreach (array_keys($list) as $group) : ?>
                    <li><a id="navi-discover-group-<?php echo $type.'-'.$group ?>" href="/discover/view/<?php echo $type; ?>" rev="<?php echo $type ?>" rel="<?php echo "{$type}-{$group}" ?>" class="navi-discover-group navi-discover-group-<?php echo $type ?>"><?php echo $group ?></a></li>
                    <?php endforeach ?>
                </ul>
                <a class="all" href="/discover/view/<?php echo $type; ?>"><?php echo Text::get('regular-see_all'); ?></a>
            </div>

        </div>

    <?php endforeach; ?>
    
    <script type="text/javascript">
		$(document).ready(function() {
			$(".search a").click(function() {
				$("#dynamicContent").load($(this).attr("href")); 
				$(".search a.current").removeClass("current");
				$(this).addClass("current");
				return false;
			});
	});
	</script>
        
        <div class="search">
        	
            <h2>Projects</h2>
        	<ul>
                    <li>
                        <a href="/discover/view_ajax/highlighted">Destaques</a>
                    </li>
                    <li>
                        <a href="/discover/view_ajax/popular">Populares</a>
                    </li>
                    <li>
                        <a href="/discover/view_ajax/recent">Recentes</a>
                    </li>
                    <li>
                        <a href="/discover/view_ajax/outdated">Próximos de Expirar</a>
                    </li>
                    <li>
                        <a href="#">Sucessos</a>
                    </li>
                </ul>
            
            
            <h2><?php echo Text::get('project-view-categories-title') ?></h2>
        	<ul>
				<?php foreach ($categories as $id=>$name) : ?>
            	<li><a href="/discover/results/<?php echo $id; ?>"><?php echo $name; ?></a></li>
            	<?php endforeach; ?>
            </ul>
        
        </div>
    
    
    </div>
    

    <?php include 'view/footer.html.php' ?>

<?php include 'view/epilogue.html.php' ?>