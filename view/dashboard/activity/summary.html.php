<?php

use Equity\Core\View,
    Equity\Model,
    Equity\Library\Worth,
    Equity\Library\Text;

$waitfor = Model\Project::waitfor();
$worthcracy = Worth::getAll();

$user = $_SESSION['user'];

$support = $user->support;

$lsuf = (LANG != 'es') ? '?lang='.LANG : '';
?>
<script type="text/javascript">

    jQuery(document).ready(function ($) {

        /* todo esto para cada lista de proyectos (flechitas navegacion) */
            $("#discover-group-my_projects-1").show();
            $("#navi-discover-group-my_projects-1").addClass('active');
            $("#discover-group-invest_on-1").show();
            $("#navi-discover-group-invest_on-1").addClass('active');

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
<!-- mis proyectos -->
<?php if (!empty($this['lists']['my_projects'])) : ?>
    <div class="widget projects">
        <h2 class="title"><?php echo Text::get('profile-my_projects-header'); ?></h2>
        <?php foreach ($this['lists']['my_projects'] as $group=>$projects) : ?>
            <div class="discover-group discover-group-my_projects" id="discover-group-my_projects-<?php echo $group ?>">

                <div class="discover-arrow-left">
                    <a class="discover-arrow" href="#my_projects" rev="my_projects" rel="<?php echo 'my_projects-'.$projects['prev'] ?>">&nbsp;</a>
                </div>

                <?php foreach ($projects['items'] as $project) :
                        echo new View('view/project/widget/project.html.php', array(
                            'project'   => $project,
                            'balloon' => '<h4>' . htmlspecialchars($this['status'][$project->status]) . '</h4>' .
                                         '<blockquote>' . $waitfor[$project->status] . '</blockquote>',
                            'dashboard' => true,
                            'own'       => true
                        ));                    
                endforeach; ?>

                <div class="discover-arrow-right">
                    <a class="discover-arrow" href="#my_projects" rev="my_projects" rel="<?php echo 'my_projects-'.$projects['next'] ?>">&nbsp;</a>
                </div>

            </div>
        <?php endforeach; ?>


        <!-- carrusel de cuadritos -->
        <div class="navi-bar">
            <ul class="navi">
                <?php foreach (array_keys($list) as $group) : ?>
                <li><a id="navi-discover-group-<?php echo 'my_projects-'.$group ?>" href="#my_projects" rev="my_projects" rel="<?php echo "my_projects-{$group}" ?>" class="navi-discover-group navi-discover-group-my_projects"><?php echo $group ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>

    </div>
<?php endif; ?>

<!-- Proyectos que cofinancio -->
<?php if (!empty($this['lists']['invest_on'])) : ?>
    <div class="widget projects">
        <h2 class="title"><?php echo Text::get('profile-invest_on-header'); ?></h2>
        <?php foreach ($this['lists']['invest_on'] as $group=>$projects) : ?>
            <div class="discover-group discover-group-invest_on" id="discover-group-invest_on-<?php echo $group ?>">

                <div class="discover-arrow-left">
                    <a class="discover-arrow" href="#invest_on" rev="invest_on" rel="<?php echo 'invest_on-'.$projects['prev'] ?>">&nbsp;</a>
                </div>

                <?php foreach ($projects['items'] as $project) :

                    $url = SITE_URL . '/widget/project/' . $project->id;
                    $widget_code = Text::widget($url . $lsuf);
                    $widget_code_investor = Text::widget($url.'/invested/'.$user->id.'/'.$lsuf);
                    ?>
                <div style="float:left;">
                      <?php  echo new View('view/project/widget/project.html.php', array(
                            'project' => $project,
                            'investor'  => $user
                        )); ?>
                <br clear="both"/>
                <?php if ($project->status > 2) : ?>
                      <div id="widget-code" style="float:none;width:250px;margin-left:25px;">
                          <div class="wc-embed" onclick="$('#widget_code').focus();$('#widget_code').select()"><?php echo Text::get('dashboard-embed_code'); ?></div>
                        <textarea id="widget_code" style="width:230px;margin:0 0 10px;" onclick="this.focus();this.select()" readonly="readonly"><?php echo htmlentities($widget_code); ?></textarea>
                      </div>

                      <div id="widget-code" style="float:none;width:250px;margin-left:25px;">
                        <div class="wc-embed" onclick="$('#investor_code').focus();$('#investor_code').select()"><?php echo Text::get('dashboard-embed_code_investor'); ?></div>
                        <textarea id="investor_code" style="width:230px;margin:0 0 10px;" onclick="this.focus();this.select()" readonly="readonly"><?php echo htmlentities($widget_code_investor); ?></textarea>
                      </div>
                <?php endif; ?>
                </div>
                <?php endforeach; ?>

                <div class="discover-arrow-right">
                    <a class="discover-arrow" href="#invest_on" rev="<?php echo $type ?>" rel="<?php echo 'invest_on-'.$projects['next'] ?>">&nbsp;</a>
                </div>

            </div>
        <?php endforeach; ?>


        <!-- carrusel de cuadritos -->
        <div class="navi-bar">
            <ul class="navi">
                <?php foreach (array_keys($list) as $group) : ?>
                <li><a id="navi-discover-group-<?php echo 'invest_on-'.$group ?>" href="#invest_on" rev="invest_on" rel="<?php echo "invest_on-{$group}" ?>" class="navi-discover-group navi-discover-group-invest_on"><?php echo $group ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>

    </div>
<?php endif; ?>

<!-- nivel de meritocracia -->
<?php echo new View('view/user/widget/worth.html.php', array('worthcracy' => $worthcracy, 'level' => $user->worth, 'amount' => $support['amount'])) ?>
