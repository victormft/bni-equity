<?php


namespace Equity\Controller {

    use Equity\Library\Page,
        Equity\Core\Redirection,
        Equity\Core\View,
        Equity\Library\Text;

    class Service extends \Equity\Core\Controller {
        
        public function index ($id = null) {

            if (empty($id)) {
                $id = 'service';
            }

            $page = Page::get($id);

            return new View(
                'view/about/sample.html.php',
                array(
                    'name' => $page->name,
                    'description' => $page->description,
                    'content' => $page->content
                )
             );

        }
        
    }
    
}