<?php

namespace Equity\Model {

    use Equity\Library\Check,
        Equity\Model\Image;


    class Sponsor extends \Equity\Core\Model {

        public
            $id,
            $name,
            $url,
            $image,
            $order;

        /*
         *  Devuelve datos de un destacado
         */
        public static function get ($id) {
                $sql = static::query("
                    SELECT
                        id,
                        name,
                        url,
                        image,
                        `order`
                    FROM    sponsor
                    WHERE id = :id
                    ", array(':id' => $id));
                $sponsor = $sql->fetchObject(__CLASS__);

                // imagen
                if (!empty($sponsor->image)) {
                    $image = Image::get($sponsor->image);
                    $sponsor->image = $image->id;
                }

                return $sponsor;
        }

        /*
         * Lista de patrocinadores
         */
        public static function getAll () {

            $list = array();

            $sql = static::query("
                SELECT
                    id,
                    name,
                    url,
                    image,
                    `order`
                FROM    sponsor
                ORDER BY `order` ASC, name ASC
                ");

            foreach ($sql->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $sponsor) {
                // imagen
                if (!empty($sponsor->image)) {
                    $image = Image::get($sponsor->image);
                    $sponsor->image = $image->id;
                }

                $list[] = $sponsor;
            }

            return $list;
        }

        /*
         * Lista de patrocinadores
         */
        public static function getList () {

            $list = array();

            $sql = static::query("
                SELECT
                    id,
                    name,
                    url,
                    image
                FROM    sponsor
                ORDER BY `order` ASC, name ASC
                ");

            foreach ($sql->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $sponsor) {
                // imagen
                if (!empty($sponsor->image)) {
                    $sponsor->image = Image::get($sponsor->image);
                }

                $list[] = $sponsor;
            }

            return $list;
        }

        public function validate (&$errors = array()) {
            if (empty($this->name))
                $errors[] = 'Falta nombre';
                //Text::get('mandatory-sponsor-name');

            if (empty($this->url))
                $errors[] = 'Falta url';
                //Text::get('mandatory-sponsor-url');

            if (empty($errors))
                return true;
            else
                return false;
        }

        public function save (&$errors = array()) {
            if (!$this->validate($errors)) return false;

            // Primero la imagenImagen
            if (is_array($this->image) && !empty($this->image['name'])) {
                $image = new Image($this->image);
                if ($image->save($errors)) {
                    $this->image = $image->id;
                } else {
                    $this->image = '';
                }
            }

            $fields = array(
                'id',
                'name',
                'url',
                'image',
                'order'
                );

            $set = '';
            $values = array();

            foreach ($fields as $field) {
                if ($set != '') $set .= ", ";
                $set .= "`$field` = :$field ";
                $values[":$field"] = $this->$field;
            }

            try {
                $sql = "REPLACE INTO sponsor SET " . $set;
                self::query($sql, $values);
                if (empty($this->id)) $this->id = self::insertId();

                Check::reorder($this->id, 'up', 'sponsor');

                return true;
            } catch(\PDOException $e) {
                $errors[] = "No se ha guardado correctamente. " . $e->getMessage();
                return false;
            }
        }

        /*
         * Para quitar una pregunta
         */
        public static function delete ($id) {

            $sql = "DELETE FROM sponsor WHERE id = :id";
            if (self::query($sql, array(':id'=>$id))) {
                return true;
            } else {
                return false;
            }

        }

        /*
         * Para que una pregunta salga antes  (disminuir el order)
         */
        public static function up ($id) {
            return Check::reorder($id, 'up', 'sponsor');
        }

        /*
         * Para que un proyecto salga despues  (aumentar el order)
         */
        public static function down ($id) {
            return Check::reorder($id, 'down', 'sponsor');
        }

        /*
         * Orden para añadirlo al final
         */
        public static function next () {
            $sql = self::query('SELECT MAX(`order`) FROM sponsor');
            $order = $sql->fetchColumn(0);
            return ++$order;

        }

    }

}