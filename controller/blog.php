<?php


namespace Equity\Controller {

    use Equity\Core\View,
        Equity\Library\Text,
        Equity\Library\Message,
        Equity\Model;

    class Blog extends \Equity\Core\Controller {
        
        public function index ($post = null) {

            if (!empty($post)) {
                $show = 'post';
                // -- Mensaje azul molesto para usuarios no registrados
                if (empty($_SESSION['user'])) {
                    $_SESSION['jumpto'] = '/blog/' .  $post;
                    Message::Info(Text::get('user-login-required'));
                }
            } else {
                $show = 'list';
            }

            // sacamos su blog
            $blog = Model\Blog::get(\EQUITY_NODE, 'node');

            if (isset($_GET['tag'])) {
                $tag = Model\Blog\Post\Tag::get($_GET['tag']);
                if (!empty($tag->id)) {
                    $blog->posts = Model\Blog\Post::getList($blog->id, $tag->id);
                }
            }

            if (isset($post) && !isset($blog->posts[$post]) && $_GET['preview'] != $_SESSION['user']->id) {
                throw new \Equity\Core\Redirection('/blog');
            }

            // segun eso montamos la vista
            return new View(
                'view/blog/index.html.php',
                array(
                    'blog' => $blog,
                    'show' => $show,
                    'tag'  => $tag,
                    'post' => $post,
                    'owner' => \EQUITY_NODE
                )
             );

        }
        
    }
    
}