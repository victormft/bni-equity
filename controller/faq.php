<?php


namespace Equity\Controller {

    use Equity\Library\Page,
        Equity\Core\View,
        Equity\Model;

    class Faq extends \Equity\Core\Controller {

        public function index () {

            $page = Page::get('faq');
            $faqs = array();

            $sections = Model\Faq::sections();
            $colors   = Model\Faq::colors();

            foreach ($sections as $id=>$name) {
                $qs = Model\Faq::getAll($id);
                
                if (empty($qs))
                    continue;

                $faqs[$id] = $qs;
                foreach ($faqs[$id] as &$question) {
                    $question->description = nl2br(str_replace(array('%SITE_URL%'), array(SITE_URL), $question->description));
                }
            }

            return new View(
                'view/faq.html.php',
                array(
                    'faqs'     => $faqs,
                    'sections' => $sections,
                    'colors'   => $colors
                )
             );

        }

    }

}