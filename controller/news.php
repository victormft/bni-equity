<?php

namespace Equity\Controller {

    use Equity\Library\Page,
        Equity\Core\View,
        Equity\Model;

    class News extends \Equity\Core\Controller {

        public function index () {

            $page = Page::get('news');
            $news = Model\News::getAll();

            return new View(
                'view/news.html.php',
                array(
                    'name' => $page->name,
                    'title' => $page->description,
                    'content' => $page->content,
                    'news' => $news
                )
             );

        }

    }

}