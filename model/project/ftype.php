<?php

namespace Equity\Model\Project {

    class Ftype extends \Equity\Core\Model {

        public
            $id,
            $project;


        /**
         * Get the categories for a project
         * @param varcahr(50) $id  Project identifier
         * @return array of categories identifiers
         */
	 	public static function get ($id) {
            $array = array ();
            try {
                $query = static::query("SELECT ftype FROM project_ftype WHERE project = ?", array($id));
                $ftypes = $query->fetchAll();
                foreach ($ftypes as $ft) {
                    $array[$ft[0]] = $ft[0];
                }

                return $array;
            } catch(\PDOException $e) {
				throw new \Equity\Core\Exception($e->getMessage());
            }
		}

        /**
         * Get all categories available
         *
         * @param void
         * @return array
         */
		public static function getAll () {
            $array = array ();
            try {
                $sql = "
                    SELECT
                        ftype.id as id,
						ftype.name as name                        
                    FROM    ftype                    
                    ";
					//IFNULL(category_lang.name, category.name) as name
					
					/*LEFT JOIN category_lang
                        ON  category_lang.id = category.id
                        AND category_lang.lang = :lang
                    ORDER BY name ASC*/

                $query = static::query($sql, array(':lang'=>\LANG));
                $ftypes = $query->fetchAll();
                foreach ($ftypes as $ft) {
                    $array[$ft[0]] = $ft[1];
                }

                return $array;
            } catch(\PDOException $e) {
				throw new \Equity\Core\Exception($e->getMessage());
            }
		}

        /**
         * Get all categories for this project by name
         *
         * @param void
         * @return array
         */
		public static function getNames ($project = null, $limit = null) {
            $array = array ();
            try {
                $sqlFilter = "";
                if (!empty($project)) {
                    $sqlFilter = " WHERE ftype.id IN (SELECT ftype FROM project_ftype WHERE project = '$project')";
                }

                $sql = "SELECT 
                            ftype.id,
							ftype.name as name                            
                        FROM ftype
                        
                        ";
						//IFNULL(category_lang.name, category.name) as name
						
						/*LEFT JOIN category_lang
                            ON  category_lang.id = category.id
                            AND category_lang.lang = :lang
                        $sqlFilter
                        ORDER BY `order` ASC*/
                if (!empty($limit)) {
                    $sql .= "LIMIT $limit";
                }
                $query = static::query($sql, array(':lang'=>\LANG));
                $ftypes = $query->fetchAll();
                foreach ($ftype as $ft) {
                    $array[$ft[0]] = $ft[1];
                }

                return $array;
            } catch(\PDOException $e) {
				throw new \Equity\Core\Exception($e->getMessage());
            }
		}

		public function validate(&$errors = array()) {
            // Estos son errores que no permiten continuar
            if (empty($this->id))
                $errors[] = 'There are no ftypes to store';
                //Text::get('validate-category-empty');

            if (empty($this->project))
                $errors[] = 'There ain\'t no project to asign';
                //Text::get('validate-category-noproject');

            //cualquiera de estos errores hace fallar la validación
            if (!empty($errors))
                return false;
            else
                return true;
        }

		public function save (&$errors = array()) {
            if (!$this->validate($errors)) return false;

			try {
	            $sql = "REPLACE INTO project_ftype (project, ftype) VALUES(:project, :ftype)";
                $values = array(':project'=>$this->project, ':ftype'=>$this->id);
				self::query($sql, $values);
				return true;
			} catch(\PDOException $e) {
				$errors[] = "Não foi asignado corretamente. Revise os dados." . $e->getMessage();
                return false;
			}

		}

		/**
		 * Quitar una palabra clave de un proyecto
		 *
		 * @param varchar(50) $project id de un proyecto
		 * @param INT(12) $id  identificador de la tabla keyword
		 * @param array $errors 
		 * @return boolean
		 */
		public function remove (&$errors = array()) {
			$values = array (
				':project'=>$this->project,
				':ftype'=>$this->id,
			);

			try {
                self::query("DELETE FROM project_ftype WHERE ftype = :ftype AND project = :project", $values);
				return true;
			} catch(\PDOException $e) {
				$errors[] = 'No se ha podido quitar la categoria ' . $this->id . ' del proyecto ' . $this->project . ' ' . $e->getMessage();
                //Text::get('remove-category-fail');
                return false;
			}
		}

	}
    
}