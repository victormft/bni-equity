<?php


namespace Equity\Controller {

    use Equity\Core\View,
        Equity\Model;

    class Preview extends \Equity\Core\Controller {
        
        public function index ($model = null, $id = null, $view = null, $viewData = array() ) {

            return new View(
                'view/about/sample.html.php',
                array(
                    'name' => 'preview',
                    'title' => 'Preview',
                    'content' => 'preview'
                )
             );

        }
        
    }
    
}