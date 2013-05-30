<?php

namespace Equity\Model {

    use Equity\Library\Check;
    
    class Category extends \Equity\Core\Model {

        public
            $id,
            $name,
            $description,
            $used; // numero de proyectos que usan la categoria

        /*
         *  Devuelve datos de una categoria
         */
        public static function get ($id) {
                $query = static::query("
                    SELECT
                        category.id,
                        IFNULL(category_lang.name, category.name) as name,
                        IFNULL(category_lang.description, category.description) as description
                    FROM    category
                    LEFT JOIN category_lang
                        ON  category_lang.id = category.id
                        AND category_lang.lang = :lang
                    WHERE category.id = :id
                    ", array(':id' => $id, ':lang'=>\LANG));
                $category = $query->fetchObject(__CLASS__);

                return $category;
        }

        /*
         * Lista de categorias para proyectos
         * @TODO añadir el numero de usos
         */
        public static function getAll () {

            $list = array();

            $sql = "
                SELECT
                    category.id as id,
                    IFNULL(category_lang.name, category.name) as name,
                    IFNULL(category_lang.description, category.description) as description,
                    (   SELECT 
                            COUNT(project_category.project)
                        FROM project_category
                        WHERE project_category.category = category.id
                    ) as numProj,
                    (   SELECT
                            COUNT(user_interest.user)
                        FROM user_interest
                        WHERE user_interest.interest = category.id
                    ) as numUser,
                    category.order as `order`
                FROM    category
                LEFT JOIN category_lang
                    ON  category_lang.id = category.id
                    AND category_lang.lang = :lang
                ORDER BY `order` ASC
                ";

            $query = static::query($sql, array(':lang'=>\LANG));

            foreach ($query->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $category) {
                $list[$category->id] = $category;
            }

            return $list;
        }

        /**
         * Get all categories used in published projects
         *
         * @param void
         * @return array
         */
		public static function getList () {
            $array = array ();
            try {
                $sql = "SELECT 
                            category.id as id,
                            IFNULL(category_lang.name, category.name) as name
                        FROM category
                        LEFT JOIN category_lang
                            ON  category_lang.id = category.id
                            AND category_lang.lang = :lang
                        LEFT JOIN project_category
                            ON category.id = project_category.category
                        LEFT JOIN user_interest
                            ON category.id = user_interest.interest
                        GROUP BY category.id
                        ORDER BY category.order ASC";

                $query = static::query($sql, array(':lang'=>\LANG));
                $categories = $query->fetchAll();
                foreach ($categories as $cat) {
                    $array[$cat[0]] = $cat[1];
                }

                return $array;
            } catch(\PDOException $e) {
				throw new \Equity\Core\Exception($e->getMessage());
            }
		}

        
        public function validate (&$errors = array()) { 
            if (empty($this->name))
                $errors[] = 'Falta nombre';
                //Text::get('mandatory-category-name');

            if (empty($errors))
                return true;
            else
                return false;
        }

        public function save (&$errors = array()) {
            if (!$this->validate($errors)) return false;

            $fields = array(
                'id',
                'name',
                'description'
                );

            $set = '';
            $values = array();

            foreach ($fields as $field) {
                if ($set != '') $set .= ", ";
                $set .= "`$field` = :$field ";
                $values[":$field"] = $this->$field;
            }

            try {
                $sql = "REPLACE INTO category SET " . $set;
                self::query($sql, $values);
                if (empty($this->id)) $this->id = self::insertId();

                return true;
            } catch(\PDOException $e) {
                $errors[] = "No se ha guardado correctamente. " . $e->getMessage();
                return false;
            }
        }

        /*
         * Para quitar una catgoria de la tabla
         */
        public static function delete ($id) {
            
            $sql = "DELETE FROM category WHERE id = :id";
            if (self::query($sql, array(':id'=>$id))) {
                return true;
            } else {
                return false;
            }

        }

        /*
         * Para que salga antes  (disminuir el order)
         */
        public static function up ($id) {
            return Check::reorder($id, 'up', 'category', 'id', 'order');
        }

        /*
         * Para que salga despues  (aumentar el order)
         */
        public static function down ($id) {
            return Check::reorder($id, 'down', 'category', 'id', 'order');
        }

        /*
         * Orden para añadirlo al final
         */
        public static function next () {
            $query = self::query('SELECT MAX(`order`) FROM category');
            $order = $query->fetchColumn(0);
            return ++$order;

        }
    }
    
}