<?php


namespace Equity\Controller {

	use Equity\Core\Redirection,
		Equity\Core\Model,
        Equity\Core\View;

	class Mail extends \Equity\Core\Controller {

	    /**
	     * solo si recibe un token válido
	     */
		public function index ($token) {

            if (!empty($token) && !empty($_GET['email'])) {
                $token = base64_decode($token);
                $parts = explode('¬', $token);
                if(count($parts) > 2 && $_GET['email'] == $parts[1] && !empty($parts[2])) {
                    // cogemos el contenido de la bbdd y lo pintamos aqui tal cual
                    if ($query = Model::query('SELECT html FROM mail WHERE email = ? AND id = ?', array($parts[1], $parts[2]))) {
                        $content = $query->fetchColumn();
                        $baja = \SITE_URL . '/user/leave/?email=' . $parts[1];
                        return new View ('view/email/equity.html.php', array('content'=>$content, 'baja' => $baja));
                    }
                }
            }

            throw new Redirection(SITE_URL . '/');
		}

    }

}