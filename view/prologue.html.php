<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo EQUITY_META_TITLE ?></title>
        <link rel="icon" type="image/png" href="/myicon.png" />
        <meta name="description" content="<?php echo EQUITY_META_DESCRIPTION ?>" />
        <meta name="keywords" content="<?php echo EQUITY_META_KEYWORDS ?>" />
        <meta name="author" content="<?php echo EQUITY_META_AUTHOR ?>" />
        <meta name="copyright" content="<?php echo EQUITY_META_COPYRIGHT ?>" />
        <meta name="robots" content="all" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <meta property="og:title" content="Equity.org" />
        <meta property="og:description" content="<?php echo EQUITY_META_DESCRIPTION ?>" />
        <meta property="og:image" content="<?php echo SITE_URL ?>/equity_logo.png" />
        <link rel="stylesheet" type="text/css" href="<?php echo SRC_URL ?>/view/css/equity.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo SRC_URL ?>/view/css/home_slider.css">
      <!--[if IE]>
      <link href="<?php echo SRC_URL ?>/view/css/ie.css" media="screen" rel="stylesheet" type="text/css" />
      <![endif]-->

        <script type="text/javascript">
        if(navigator.userAgent.indexOf('Mac') != -1)
		{
			document.write ('<link rel="stylesheet" type="text/css" href="<?php echo SRC_URL ?>/view/css/mac.css" />');
		}
	    </script>
        <?php if (!isset($useJQuery) || !empty($useJQuery)): ?>
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.tipsy.min.js"></script>
          <!-- custom scrollbars -->
          <link type="text/css" href="<?php echo SRC_URL ?>/view/css/jquery.jscrollpane.min.css" rel="stylesheet" media="all" />
          <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.mousewheel.min.js"></script>
          <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.jscrollpane.min.js"></script>
          <!-- end custom scrollbars -->
		  <!-- sliders -->
		  <!-- <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.slides.min.js"></script> -->
		  <!-- end sliders -->
          <!-- fancybox-->   
		  <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.fancybox.min.js"></script>
          <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/new_slider.js"></script>
		  <link rel="stylesheet" type="text/css" href="<?php echo SRC_URL ?>/view/css/fancybox/jquery.fancybox.min.css" media="screen" />
          <!-- end custom fancybox-->          

		  <!-- vigilante de sesi�n -->
		  <script type="text/javascript" src="<?php echo SITE_URL ?>/view/js/watchdog.js"></script>
          

        <?php endif ?>
    </head>

    <body<?php if (isset($bodyClass)) echo ' class="' . htmlspecialchars($bodyClass) . '"' ?>>
<?php if (isset($fbCode)) : ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo \Equity\Library\Lang::locale(); ?>/all.js#xfbml=1&appId=189133314484241";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php endif; ?>
        <script type="text/javascript">
            // Mark DOM as javascript-enabled
            jQuery(document).ready(function ($) {
                $('body').addClass('js');
                $('.tipsy').tipsy();
                /* Rolover sobre los cuadros de color */
                $("li").hover(
                        function () { $(this).addClass('active') },
                        function () { $(this).removeClass('active') }
                );
                $('.activable').hover(
                    function () { $(this).addClass('active') },
                    function () { $(this).removeClass('active') }
                );
                $(".a-null").click(function (event) {
                    event.preventDefault();
                });
            });
        </script>
        <noscript><!-- Please enable JavaScript --></noscript>

		<div id="language">
        	<ul>
            	<li>
                	<a href="?lang=en">
                    	<img alt="en" width="30" height="30" src="<?php echo SRC_URL ?>/view/css/lang/en.png" />
                    </a>
                </li>
                
                <li>
                	<a href="?lang=pt">
                    	<img alt="pt" width="30" height="30" src="<?php echo SRC_URL ?>/view/css/lang/pt.png" />
                    </a>
                </li>
            </ul>
         </div>

        <div id="wrapper">
