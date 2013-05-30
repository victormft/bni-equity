<?php

namespace Equity\Model\User {

    class Web extends \Equity\Core\Model {

        public
            $id,
            $user,
            $url;


        /**
         * Get the interests for a user
         * @param varcahr(50) $id  user identifier
         * @return array of interests identifiers
         */
	 	public static function get ($id) {
            try {
                $query = static::query("SELECT id, user, url FROM user_web WHERE user = ?", array($id));
                $webs = $query->fetchAll(\PDO::FETCH_CLASS, __CLASS__);

                return $webs;
            } catch(\PDOException $e) {
				throw new \Equity\Core\Exception($e->getMessage());
            }
		}

		public function validate(&$errors = array()) {}

		/*
		 *  Guarda las webs del usuario
		 */
		public function save (&$errors = array()) {

            $values = array(':user'=>$this->user, ':id'=>$this->id, ':url'=>$this->url);

			try {
	            $sql = "REPLACE INTO user_web (id, user, url) VALUES(:id, :user, :url)";
				self::query($sql, $values);
				return true;
			} catch(\PDOException $e) {
				$errors[] = "La web {$this->url} no se ha asignado correctamente. Por favor, revise los datos." . $e->getMessage();
				return false;
			}

		}

		/**
		 * Quitar una palabra clave de un proyecto
		 *
		 * @param varchar(50) $user id de un proyecto
		 * @param INT(12) $id  identificador de la tabla keyword
		 * @param array $errors
		 * @return boolean
		 */
		public function remove (&$errors = array()) {
			$values = array (
				':user'=>$this->user,
				':id'=>$this->id,
			);

            try {
                self::query("DELETE FROM user_web WHERE id = :id AND user = :user", $values);
				return true;
			} catch(\PDOException $e) {
                $errors[] = 'No se ha podido quitar la web ' . $this->id . ' del usuario ' . $this->user . ' ' . $e->getMessage();
                //Text::get('remove-user_web-fail');
                return false;
			}
		}

	}

}