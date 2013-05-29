<?php

use Equity\Library\Text;
$lang = (LANG != 'es') ? '?lang='.LANG : '';
?>
<ul class="share-equity">
    <li class="twitter"><a href="<?php echo Text::get('social-account-twitter') ?>" target="_blank"><?php echo Text::get('regular-share-twitter'); ?></a></li>
    <li class="facebook"><a href="<?php echo Text::get('social-account-facebook') ?>" target="_blank"><?php echo Text::get('regular-share-facebook'); ?></a></li>
    <li class="rss"><a rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo SITE_URL ?>/rss<?php echo $lang ?>" target="_blank"><?php echo Text::get('regular-share-rss'); ?></a></li>
</ul>