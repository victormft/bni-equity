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

 use Goteo\Core\ACL,
    Goteo\Library\Text;
?>
    <div id="menu">
        
        <h2><?php echo Text::get('regular-menu'); ?></h2>
        
        <div class="up_content">
        
        	<ul>
            
            	<li>
                	<a href="/faq">FAQ/Ajuda</a>
                </li>
                
                <li class="separator">
                	<span>|</span>
                </li>
            	
                <li>
                	<a href="/about">Quem somos?</a>
                </li>
                
                <li class="separator">
                	<span>|</span>
                </li>
                
                <li>
                    <a href="/news">Notícias</a>
                </li>
            
            </ul>
        
        </div>
        
        <ul>
            <li class="home"><a href="/"><?php //echo Text::get('regular-home'); ?><font style="font-size:36px; font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif; font-weight:bold"><text style="color:#8dc63f">BNI</text>Equity</font></a></li>
            <li class="explore"><a href="/discover"><?php //echo Text::get('regular-discover'); ?>
            <img src="http://localhost/view/css/dollar.png" width="20" height="20" /><span>Investir<br><span style="color:#888; font-size:12px; padding-left: 20px;">em projetos</span></span></a></li>
            <li class="create"><a  href="/project/create"><?php //echo Text::get('regular-create'); ?><img src="http://localhost/view/css/puzzle.png" width="20" height="20" /><span>Criar<br><span style="color:#888; font-size:12px; padding-left: 20px;">seu projeto</span></span></a></li>
            <li class="howitworks"><a  href="/project/create"><?php //echo Text::get('regular-create'); ?><img src="http://localhost/view/css/questionmark.png" width="20" height="20" /><span>Como Funciona?<br><span style="color:#888; font-size:12px; padding-left: 20px;">entenda o BNIEquity</span></span></a></li>
            <li class="search">
                <form method="get" action="/discover/results">
                    <fieldset id="fieldset">
                        <legend><?php echo Text::get('regular-search'); ?></legend>
                        <input id="query" type="text" name="query" value="Buscar projetos..." onfocus="this.value=''" onblur="this.value='Buscar projetos...'" />
                        <input type="submit" value="Buscar" >
                    </fieldset>
                </form>
                <script>
                $('#query').focus(function(){
    				$('#fieldset').addClass('active');
				});
				$('#query').blur(function(){
    				$('#fieldset').removeClass('active');
				});
				</script>
            </li>
        <!--
		    <?php if (!empty($_SESSION['user'])): ?>
            <li class="community"><a href="/community"><span><?php echo Text::get('community-menu-main'); ?></span></a>
                <div>
                    <ul>
                        <li><a href="/community/activity"><span><?php echo Text::get('community-menu-activity'); ?></span></a></li>
                        <li><a href="/community/sharemates"><span><?php echo Text::get('community-menu-sharemates'); ?></span></a></li>
                    </ul>
                </div>
            </li>
            <?php else: ?>
            <li class="login">
                <a href="/community"><span><?php echo Text::get('community-menu-main'); ?></span></a>
            </li>
            <?php endif ?>
         -->
            <?php if (!empty($_SESSION['user'])): ?>            
            <li class="dashboard"><a href="/dashboard"><span><?php echo Text::get('dashboard-menu-main'); ?></span><img src="<?php echo $_SESSION['user']->avatar->getLink(28, 28, true); ?>" /></a>
                <div>
                    <ul>
                        <li><a href="/dashboard/activity"><span><?php echo Text::get('dashboard-menu-activity'); ?></span></a></li>
                        <li><a href="/dashboard/profile"><span><?php echo Text::get('dashboard-menu-profile'); ?></span></a></li>
                        <li><a href="/dashboard/projects"><span><?php echo Text::get('dashboard-menu-projects'); ?></span></a></li>
                        <?php if (ACL::check('/translate')) : ?>
                        <li><a href="/translate"><span><?php echo Text::get('regular-translate_board'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if (ACL::check('/review')) : ?>
                        <li><a href="/review"><span><?php echo Text::get('regular-review_board'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if (ACL::check('/admin')) : ?>
                        <li><a href="/admin"><span><?php echo Text::get('regular-admin_board'); ?></span></a></li>
                        <?php endif; ?>
                        <li class="logout"><a href="/user/logout"><span><?php echo Text::get('regular-logout'); ?></span></a></li>
                    </ul>
                </div>
            </li>            
            <?php else: ?>            
            <li class="login">
                <a href="/user/login"> <img src="http://localhost/view/css/log_in.png" width="20" height="20" /><span><?php echo Text::get('regular-login'); ?></span></a>
            </li>
            
            <?php endif ?>
        </ul>
    </div>
    
    
    <div id="dynamic_result"> 
    
<!--    <div id="sub_dyn">
    </div>
-->
	   
		<div id="out_search">
        <a class="expand_search" href="#"></a>
        </div>
        
		<div id="main">
            <div class="widget projects" id="dynamicContent_search">
            
            </div>
		</div>        
    </div>

   
<script type="text/javascript">
	$(document).ready(function() {
	//$("#query").keypress(function() { // inclui todos os links com id="dynamic"
		//$("#dynamic_result").animate({'display':'block'}, 'slow');
		//$("#dynamic_result").css("display", "block");
	$("#query").keyup(function() {
	
		var len = $("#query").val().length;
		var val = $("#query").val();
			
		if(len >=3){	
			
				$("#dynamic_result").css("height", "600px");
				$("#sub-header").css("opacity", "0.2");
				$("#dynamicContent_search").load("/discover/view_ajax_search/"+val);
		}
		
		else{	
			
				$("#dynamic_result").css("height", "0px");
				$("#sub-header").css("opacity", "1");
		}
	});
	
	//});
	
	
	
	$("#out_search").click(function() { // inclui todos os links com id="dynamic"
		//$("#dynamic_result").css("display", "none");
		$("#dynamic_result").css("height", "0px");
		$("#sub-header").css("opacity", "1");		
	});
});

</script>