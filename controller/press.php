<?php


namespace Equity\Controller {

    use Equity\Library\Page,
        Equity\Core\Redirection,
        Equity\Core\View,
        Equity\Library\Text;

    class Press extends \Equity\Core\Controller {
        
        public function index () {

            $page = Page::get('press');

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