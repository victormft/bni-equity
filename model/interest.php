<?php

namespace Equity\Model {

    class Interest extends \Equity\Model\Category {

        public
            $id,
            $name,
            $description,
            $used; // numero de usuarios que tienen este interés

        /*
         * Lista de intereses para usuarios
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
                            COUNT(user_interest.user)
                        FROM user_interest
                        WHERE user_interest.interest = category.id
                    ) as used,
                    category.order as `order`
                FROM    category
                LEFT JOIN category_lang
                    ON  category_lang.id = category.id
                    AND category_lang.lang = :lang
                ORDER BY `order` ASC";

            $query = static::query($sql, array(':lang'=>\LANG));

            foreach ($query->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $interest) {
                $list[$interest->id] = $interest;
            }

            return $list;
        }

    }

}


/**
 *
    use Equity\Library\Check;


        //  Devuelve datos de un interés
        public static function get ($id) {
                $query = static::query("
                    SELECT
                        id,
                        name,
                        description
                    FROM    interest
                    WHERE id = :id
                    ", array(':id' => $id));
                $interest = $query->fetchObject(__CLASS__);

                return $interest;
        }

        public function validate (&$errors = array()) {
            if (empty($this->name))
                $errors[] = 'Falta nombre';
                //Text::get('mandatory-interest-name');

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
                $sql = "REPLACE INTO interest SET " . $set;
                self::query($sql, $values);
                if (empty($this->id)) $this->id = self::insertId();

                return true;
            } catch(\PDOException $e) {
                $errors[] = "No se ha guardado correctamente. " . $e->getMessage();
                return false;
            }
        }

        // Para quitar un interes de la tabla
        public static function delete ($id) {

            $sql = "DELETE FROM interest WHERE id = :id";
            if (self::query($sql, array(':id'=>$id))) {
                return true;
            } else {
                return false;
            }

        }

        // Para que salga antes  (disminuir el order)
        public static function up ($id) {
            return Check::reorder($id, 'up', 'interest', 'id', 'order');
        }

        // Para que salga despues  (aumentar el order)
        public static function down ($id) {
            return Check::reorder($id, 'down', 'interest', 'id', 'order');
        }

        // Orden para añadirlo al final
        public static function next () {
            $query = self::query('SELECT MAX(`order`) FROM interest');
            $order = $query->fetchColumn(0);
            return ++$order;

        }
 */