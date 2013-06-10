<?php

namespace Equity\Controller {

    use Equity\Library\Page,
        Equity\Core\Redirection,
        Equity\Core\View,
        Equity\Model,
        Equity\Library\Text,
        Equity\Library\Mail,
        Equity\Library\Template;

    class About extends \Equity\Core\Controller {
        
        public function index ($id = null) {

            if (empty($id)) {
                $id = 'about';

                $posts = Model\Info::getAll(true, \EQUITY_NODE);

                return new View(
                    'view/about/info.html.php',
                    array(
                        'posts' => $posts
                    )
                 );
            }

            if ($id == 'faq' || $id == 'contact') {
                throw new Redirection(SITE_URL . '/'.$id, Redirection::TEMPORARY);
            }

            $page = Page::get($id);

            if ($id == 'howto') {
                return new View(
                    'view/about/howto.html.php',
                    array(
                        'name' => $page->name,
                        'description' => $page->description,
                        'content' => $page->content
                    )
                 );
            }

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