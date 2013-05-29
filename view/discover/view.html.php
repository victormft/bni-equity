<?php

use Equity\Core\View,
    Equity\Library\Text;

// en la p�gina de cofinanciadores, paginaci�n de 20 en 20
require_once 'library/pagination/pagination.php';

$pagedResults = new \Paginated($this['list'], 9, isset($_GET['page']) ? $_GET['page'] : 1);



$bodyClass = 'discover';

include 'view/prologue.html.php';

include 'view/header.html.php' ?>


        <div id="sub-header">
            <div>
                <h2 class="title"><?php echo $this['title']; ?></h2>
            </div>

        </div>

        <div id="main">
            <div class="widget projects">
                <?php while ($project = $pagedResults->fetchPagedRow()) :
                        echo new View('view/project/widget/project.html.php', array(
                            'project' => $project
                            ));
                endwhile; ?>
            </div>

            <ul id="pagination">
                <?php   $pagedResults->setLayout(new DoubleBarLayout());
                        echo $pagedResults->fetchPagedNavigation(); ?>
            </ul>

        </div>        

        <?php include 'view/footer.html.php' ?>
    
<?php include 'view/epilogue.html.php' ?>