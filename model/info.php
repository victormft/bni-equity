<?php

namespace Equity\Model {

    use \Equity\Model\Project\Media,
        \Equity\Model\Image,
        \Equity\Library\Text,
        Equity\Library\Check;

    class Info extends \Equity\Core\Model {

        public
            $id,
            $title,
            $text,
            $image,
            $media,
            $legend,
            $publish,
            $order,
            $gallery = array(); // array de instancias image de info_image

        /*
         *  Devuelve datos de una entrada
         */
        public static function get ($id) {
                $query = static::query("
                    SELECT
                        info.id as id,
                        info.node as node,
                        IFNULL(info_lang.title, info.title) as title,
                        IFNULL(info_lang.text, info.text) as text,
                        IFNULL(info_lang.legend, info.legend) as legend,
                        info.media as `media`,
                        info.publish as `publish`,
                        info.order as `order`
                    FROM    info
                    LEFT JOIN info_lang
                        ON  info_lang.id = info.id
                        AND info_lang.lang = :lang
                    WHERE info.id = :id
                    ", array(':id' => $id, ':lang'=>\LANG));

                $info = $query->fetchObject(__CLASS__);

                // video
                if (isset($info->media)) {
                    $info->media = new Media($info->media);
                }

                // galeria
                $info->gallery = Image::getAll($id, 'info');
                $info->image = $info->gallery[0];

                return $info;
        }

        /*
         * Lista de entradas por orden alfabético
         */
        public static function getAll ($published = false, $node = \EQUITY_NODE) {

            $list = array();

            $sql = "
                SELECT
                    info.id as id,
                    IFNULL(info_lang.title, info.title) as title,
                    IFNULL(info_lang.text, info.text) as `text`,
                    IFNULL(info_lang.legend, info.legend) as `legend`,
                    info.media as `media`,
                    info.publish as `publish`,
                    info.order as `order`
                FROM    info
                LEFT JOIN info_lang
                    ON  info_lang.id = info.id
                    AND info_lang.lang = :lang
                WHERE info.node = :node
                ";

            if ($published == true) {
                $sql .= " AND info.publish = 1";
            }

            $sql .= " ORDER BY `order` ASC
                ";
            
            $query = static::query($sql, array(':node'=>$node, ':lang'=>\LANG));
                
            foreach ($query->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $info) {
                // galeria
                $info->gallery = Image::getAll($info->id, 'info');
                $info->image = $info->gallery[0];

                // video
                if (!empty($info->media)) {
                    $info->media = new Media($info->media);
                }
                
                $list[$info->id] = $info;
            }

            return $list;
        }

        public function validate (&$errors = array()) { 
            if (empty($this->title))
                $errors['title'] = 'Falta título';

            if (empty($this->text))
                $errors['text'] = 'Falta texto';

            if (empty($this->node))
                $this->node = \EQUITY_NODE;

            if (empty($errors))
                return true;
            else
                return false;
        }

        public function save (&$errors = array()) {
            if (!$this->validate($errors)) return false;

            $fields = array(
                'id',
                'node',
                'title',
                'text',
                'media',
                'legend',
                'order',
                'publish'
                );

            $values = array();

            foreach ($fields as $field) {
                if ($set != '') $set .= ", ";
                $set .= "`$field` = :$field ";
                $values[":$field"] = $this->$field;
            }

            try {
                $sql = "REPLACE INTO info SET " . $set;
                self::query($sql, $values);
                if (empty($this->id)) $this->id = self::insertId();

                // Luego la imagen
                if (!empty($this->id) && is_array($this->image) && !empty($this->image['name'])) {
                    $image = new Image($this->image);
                    if ($image->save($errors)) {
                        $this->gallery[] = $image;

                        /**
                         * Guarda la relación NM en la tabla 'info_image'.
                         */
                        if(!empty($image->id)) {
                            self::query("REPLACE info_image (info, image) VALUES (:info, :image)", array(':info' => $this->id, ':image' => $image->id));
                        }
                    }
                }

                return true;
            } catch(\PDOException $e) {
                $errors[] = "No se ha guardado correctamente. " . $e->getMessage();
                return false;
            }
        }

        /*
         * Para quitar una entrada
         */
        public static function delete ($id) {
            
            $sql = "DELETE FROM info WHERE id = :id";
            if (self::query($sql, array(':id'=>$id))) {

                // que elimine tambien sus imágenes
                $sql = "DELETE FROM info_image WHERE info = :id";
                self::query($sql, array(':id'=>$id));

                return true;
            } else {
                return false;
            }

        }

        /*
         * Para que una entrada salga antes  (disminuir el order)
         */
        public static function up ($id, $node = \EQUITY_NODE) {
            $extra = array (
                    'node' => $node
                );
            return Check::reorder($id, 'up', 'info', 'id', 'order', $extra);
        }

        /*
         * Para que una entrada salga despues  (aumentar el order)
         */
        public static function down ($id, $node = \EQUITY_NODE) {
            $extra = array (
                    'node' => $node
                );
            return Check::reorder($id, 'down', 'info', 'id', 'order', $extra);
        }

        /*
         * Orden para añadirlo al final
         */
        public static function next ($node = \EQUITY_NODE) {
            $query = self::query('SELECT MAX(`order`) FROM info WHERE node = :node'
                , array(':node'=>$node));
            $order = $query->fetchColumn(0);
            return ++$order;

        }

    }
    
}