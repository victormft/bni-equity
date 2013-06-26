<?php

namespace Equity\Controller {

    use Equity\Library\Page,
        Equity\Library\Feed,
        Equity\Core\View,
        Equity\Model\User\Interest,
        Equity\Model\Invest;

    class Community extends \Equity\Core\Controller {

        public function index ($show = 'activity', $category = null) {

            return new View('view/community.html.php', $viewData);
            
//            $page = Page::get('community');
//
//            $items = array();
//            $shares = array();
//
//            if (!in_array($show, array('sharemates', 'activity'))) $show = 'activity';
//
//            $viewData = array(
//                    'description' => $page->description,
//                    'show' => $show
//                );
//
//            switch ($show) {
//
//                // compartiendo intereses global
//                case 'sharemates':
//                    $categories = Interest::getAll();
//
//                    foreach ($categories as $catId => $catName) {
//                        $gente = Interest::shareAll($catId);
//                        if (count($gente) == 0) continue;
//                        $shares[$catId] = $gente;
//                    }
//
//                    $viewData['category'] = $category;
//                    $viewData['categories'] = $categories;
//                    $viewData['shares'] = $shares;
//
//                    // top ten cofinanciadores en Equity
//                    $projects = Invest::projects(true);
//
//                    $investors = array();
//                    foreach ($projects as $projectId=>$projectName) {
//
//                        foreach (Invest::investors($projectId) as $key=>$investor) {
//                            if (\array_key_exists($investor->user, $investors)) {
//                                // ya est� en el array, quiere decir que cofinancia este otro proyecto
//                                // , a�adir uno, sumar su aporte, actualizar la fecha
//                                ++$investors[$investor->user]->projects;
//                                $investors[$investor->user]->amount += $investor->amount;
//                                $investors[$investor->user]->date = $investor->date;
//                            } else {
//                                $investors[$investor->user] = (object) array(
//                                    'user' => $investor->user,
//                                    'name' => $investor->name,
//                                    'projects' => 1,
//                                    'avatar' => $investor->avatar,
//                                    'worth' => $investor->worth,
//                                    'amount' => $investor->amount,
//                                    'date' => $investor->date
//                                );
//                            }
//                        }
//                    }
//
//                    $viewData['investors'] = $investors;
//
//                    break;
//
//                // feed p�blico
//                case 'activity':
//                    
//                    $items = array();
//
//                    $items['equity']     = Feed::getAll('equity', 'public');
//                    $items['projects']  = Feed::getAll('projects', 'public');
//                    $items['community'] = Feed::getAll('community', 'public');
//
//                    $viewData['items'] = $items;
//
//                    break;
//            }
//
//            return new View('view/community.html.php', $viewData);

        }

    }

}