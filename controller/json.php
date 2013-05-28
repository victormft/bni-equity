<?php

namespace Equity\Controller {

    use Equity\Model,
        Equity\Model\User;

    class JSON extends \Equity\Core\Controller {

		private $result = array();

		/**
		 * Solo retorna si la sesion esta activa o no
		 * */
		public function keep_alive() {

			$this->result = array(
				'logged'=>false
			);
			if($_SESSION['user'] instanceof User) {
				$this->result['logged'] = true;
				$this->result['userid'] = $_SESSION['user']->id;
			}

			return $this->output();
		}

		/**
		 * Json encoding...
		 * */
		public function output() {

			header("Content-Type: application/javascript");

			return json_encode($this->result);
		}
    }
}
