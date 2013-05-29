<?php
use Equity\Core\View,
	Equity\Library\Text;
?>

<script type="text/javascript">	
    jQuery(document).ready(function ($) {
        /* todo esto para el tipo de grupo */
            $("#discover-group-<?php echo $this['search'] ?>-1").show();
            $("#navi-discover-group-<?php echo $this['search'] ?>-1").addClass('active');
        

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


<h2 class="title"><?php echo $this['title']; ?></h2>
            <?php foreach ($this['list'] as $group=>$projects) : ?>
                <div class="discover-group discover-group-<?php echo $this['search'] ?>" id="discover-group-<?php echo $this['search'] ?>-<?php echo $group ?>">

                    <div class="discover-arrow-left">
                        <a class="discover-arrow" href="<?php echo SITE_URL ?>/discover/view_ajax_search/<?php echo $this['search'] ?>" rev="<?php echo $this['search'] ?>" rel="<?php echo $this['search'].'-'.$projects['prev'] ?>">&nbsp;</a>
                    </div>

                    <?php foreach ($projects['items'] as $project) :
                        echo new View('view/project/widget/project.html.php', array('project' => $project));
                    endforeach; ?>

                    <div class="discover-arrow-right">
                        <a class="discover-arrow" href="<?php echo SITE_URL ?>/discover/view_ajax_search/<?php echo $this['search']; ?>" rev="<?php echo $this['search'] ?>" rel="<?php echo $this['search'].'-'.$projects['next'] ?>">&nbsp;</a>
                    </div>

                </div>
            <?php endforeach; ?>


            <!-- carrusel de imagenes -->
            <div class="navi-bar">
                <ul class="navi">
                    <?php foreach (array_keys($this['list']) as $group) : ?>
                    <li><a id="navi-discover-group-<?php echo $this['type'].'-'.$group ?>" href="<?php echo SITE_URL ?>/discover/view_ajax_search/<?php echo $this['search']; ?>" rev="<?php echo $this['search'] ?>" rel="<?php echo "{$this['search']}-{$group}" ?>" class="navi-discover-group navi-discover-group-<?php echo $this['search'] ?>"><?php echo $group ?></a></li>
                    <?php endforeach ?>
                </ul>
                <a class="all" href="<?php echo SITE_URL ?>/discover/view/<?php echo $this['type']; ?>"><?php echo Text::get('regular-see_all'); ?></a>
            </div>