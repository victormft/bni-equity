<?php


namespace Equity\Controller {

    use Equity\Model,
        Equity\Library;

    class Rss extends \Equity\Core\Controller {
        
        public function index () {
            
            // sacamos su blog
            $blog = Model\Blog::get(\EQUITY_NODE, 'node');

            $tags = Model\Blog\Post\Tag::getAll();

            /*
            echo '<pre>'.print_r($tags, 1).'</pre>';
            echo '<pre>'.print_r($blog->posts, 1).'</pre>';
            die;
             * 
             */

            // al ser xml no usaremos vista
            // usaremos FeedWriter

            // configuracion
            $config = array(
                'title' => 'Equity Rss',
                'description' => 'Blog Equity.org rss',
                'link' => SITE_URL,
                'indent' => 6
            );

            $data = array(
                'tags' => $tags,
                'posts' => $blog->posts
            );

            \header("Content-Type: application/rss+xml");
            echo Library\Rss::get($config, $data, $_GET['format']);

            // le preparamos los datos y se los pasamos
        }
        
    }
    
}