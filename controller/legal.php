<?php

namespace Equity\Controller {

    use Equity\Library\Page,
        Equity\Core\Redirection,
        Equity\Core\View,
        Equity\Library\Text,
        Equity\Library\Mail;

    class Legal extends \Equity\Core\Controller {
        
        public function index ($id = null) {

            if (empty($id)) {
                throw new Redirection('/about/legal', Redirection::PERMANENT);
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