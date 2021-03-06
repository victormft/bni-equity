<?php


namespace Equity\Controller {

    use Equity\Core\View,
        Equity\Model,
        Equity\Core\Redirection,
        Equity\Library\Text,
        Equity\Library\Listing;

    class Discover extends \Equity\Core\Controller {
    
        /*
         * Descubre proyectos, página general
         */
        public function index () {

            $viewData = array();
            $viewData['title'] = array(
                'popular' => Text::get('discover-group-popular-header'),
                'outdate' => Text::get('discover-group-outdate-header'),
                'recent'  => Text::get('discover-group-recent-header'),
                'success' => Text::get('discover-group-success-header'),
                'archive' => Text::get('discover-group-archive-header')
            );

            $viewData['lists'] = array();

            $types = array(
                'popular',
                'recent',
                'success',
                'outdate',
                'archive'
            );

            // cada tipo tiene sus grupos
            foreach ($types as $type) {
                $projects = Model\Project::published($type);
                if (empty($projects)) continue;
                $viewData['lists'][$type] = Listing::get($projects);
            }

            return new View(
                'view/discover/index.html.php',
                $viewData
             );

        }

        /*
         * Descubre proyectos, resultados de búsqueda
         */
        public function results ($category = null) {

            $message = '';
            $results = null;

            // si recibimos categoria por get emulamos post con un parametro 'category'
            if (!empty($category)) {
                $_POST['category'][] = $category;
            }

			if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query']) && !isset($category)) {
                $errors = array();

                $params['query'] = \strip_tags($_GET['query']); // busqueda de texto

                $results = \Equity\Library\Search::text($params['query']);

			} elseif (($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searcher']) || !empty($category))) {

                // vamos montando $params con los 3 parametros y las opciones marcadas en cada uno
                $params = array('category'=>array(), 'location'=>array(), 'reward'=>array());

                foreach ($params as $param => $empty) {
                    foreach ($_POST[$param] as $key => $value) {
                        if ($value == 'all') {
                            $params[$param] = array();
                            break;
                        }
                        $params[$param][] = "'{$value}'";
                    }
                }

                $params['query'] = \strip_tags($_POST['query']);

                // para cada parametro, si no hay ninguno es todos los valores
                $results = \Equity\Library\Search::params($params);

            } else {
                throw new Redirection(SITE_URL.'/discover', Redirection::PERMANENT);
            }

            return new View(
                'view/discover/results.html.php',
                array(
                    'message' => $message,
                    'results' => $results,
                    'query'   => $query,
                    'params'  => $params
                )
             );

        }
        
        /*
         * Descubre proyectos, ver todos los de un tipo
         */
        public function view ($type = 'all') {

            if (!in_array($type, array('popular', 'outdate', 'recent', 'success', 'archive', 'all'))) {
                throw new Redirection(SITE_URL.'/discover');
            }

            $viewData = array();

            // segun el tipo cargamos el título de la página
            $viewData['title'] = Text::get('discover-group-'.$type.'-header');

            // segun el tipo cargamos la lista
            $viewData['list']  = Model\Project::published($type);


            return new View(
                'view/discover/view.html.php',
                $viewData
             );

        }
		
		public function view_ajax ($type = 'all') {

            if (!in_array($type, array('highlighted','popular', 'outdate', 'recent', 'success', 'archive', 'all'))) {
                throw new Redirection(SITE_URL.'/discover');
            }

            $viewData = array();

            // segun el tipo cargamos el título de la página
            $viewData['title'] = Text::get('discover-group-'.$type.'-header');

            // segun el tipo cargamos la lista
			$projects = Model\Project::published($type);
            $viewData['list']  = Listing::get($projects);
			
			//passa o parametro $type
			$viewData['type'] = $type;


            return new View(
                'view/discover/ajax.html.php',
                $viewData
             );

        }
		
		
		public function view_ajax_search ($search = null) {


            $viewData = array();

            // segun el tipo cargamos el título de la página
            $viewData['title'] = "Match";

            // segun el tipo cargamos la lista
			$projects = Model\Project::dynamic_search($search);
            $viewData['list']  = Listing::get($projects);
			
			//passa o parametro $type
			$viewData['type'] = "search";
			
			$viewData['search'] = $search;


            return new View(
                'view/discover/ajax_search.html.php',
                $viewData
             );

        }
		
		

    }
    
}