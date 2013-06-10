<?php


namespace Equity\Controller {

    use Equity\Core\View,
        Equity\Model\Project,
        Equity\Core\Redirection;

    class Widget extends \Equity\Core\Controller {
        
        public function project ($id) {

            $project  = Project::get($id, LANG);

            if (! $project instanceof  Project) {
                throw new Redirection(SITE_URL . '/', Redirection::TEMPORARY);
            }

            return new View('view/widget/project.html.php', array('project' => $project, 'global' => true));
            
            throw new Redirection(SITE_URL . '/fail', Redirection::TEMPORARY);
        }
        
    }
    
}