<?php


namespace Equity\Controller {

	use Equity\Core\Redirection,
        Equity\Core\Error,
        Equity\Core\View,
        Equity\Library\Feed,
        Equity\Library\Message,
		Equity\Model\User;

	class Impersonate extends \Equity\Core\Controller {

	    /**
	     * Suplantando al usuario
	     * @param string $id   user->id
	     */
		public function index () {

            $admin = $_SESSION['user'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST' 
                && !empty($_POST['id'])
                && !empty($_POST['impersonate'])
                && $_SESSION['user'] = User::get($_POST['id'])) {

                /*
                 * Evento Feed
                 */
                $log = new Feed();
                $log->title = 'Suplantación usuario (admin)';
                $log->url = '/admin/users';
                $log->type = 'user';
                $log_text = 'El admin %s ha %s al usuario %s';
                $log_items = array(
                    Feed::item('user', $admin->name, $admin->id),
                    Feed::item('relevant', 'Suplantado'),
                    Feed::item('user', $_SESSION['user']->name, $_SESSION['user']->id)
                );
                $log->html = \vsprintf($log_text, $log_items);
                $log->add($errors);

                unset($log);


                throw new Redirection('/dashboard');
                
            }
            else {
                Message::Error('Ha ocurrido un error');
                throw new Redirection('/dashboard');
            }
		}

    }

}