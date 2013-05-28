<?php


namespace Equity\Controller {

    use Equity\Core\View,
        Equity\Model\Project,
        Equity\Model\Banner,
        Equity\Model\Post,
        Equity\Model\Promote,
        Equity\Library\Text,
		Equity\Library\Listing;

    class Index extends \Equity\Core\Controller {
        
        public function index () {

            if (isset($_GET['error'])) {
                throw new \Equity\Core\Error('418', Text::html('fatal-error-teapot'));
            }

            // hay que sacar los que van en portada de su blog (en cuanto aclaremos lo de los nodos)
            $posts    = Post::getList();
            $promotes = Promote::getAll(true);
            $banners  = Banner::getAll();
			
			$projects = Project::published('highlighted');
			$viewData=array();
			$viewData['list'] = Listing::get($projects);
			$viewData['title'] = Text::get('discover-group-highlighted-header');
			$viewData['type'] = 'highlighted';
			

            foreach ($posts as $id=>$title) {
                $posts[$id] = Post::get($id);
            }

                foreach ($promotes as $key => &$promo) {
                    try {
                        $promo->projectData = Project::get($promo->project, LANG);
                    } catch (\Equity\Core\Error $e) {
                        unset($promotes[$key]);
                    }
                }

                foreach ($banners as $id => &$banner) {
                    try {
                        $banner->project = Project::get($banner->project, LANG);
                    } catch (\Equity\Core\Error $e) {
                        unset($banners[$id]);
                    }
                }

            $post = isset($_GET['post']) ? $_GET['post'] : reset($posts)->id;

            return new View('view/index.html.php',
                array(
                    'banners'  => $banners,
                    'posts'    => $posts,
                    'promotes' => $promotes,
					'viewData' => $viewData
                )
            );
            
        }
		
		
    }
    
}