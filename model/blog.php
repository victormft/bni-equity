<?php


namespace Equity\Model {

    use \Equity\Model\Project\Media,
        \Equity\Model\Image;

    class Blog extends \Equity\Core\Model {

        public
            $id,
            $type,
            $owner,
            $project,
            $node,
            $posts = array(),
            $active;

        /*
         *  Para conseguir el ide del blog de un proyecto o de un nodo
         *  Devuelve datos de un blog
         */
        public static function get ($owner, $type = 'project') {
                $query = static::query("
                    SELECT
                        id,
                        type,
                        owner,
                        active
                    FROM    blog
                    WHERE owner = :owner
                    AND type = :type
                    ", array(':owner' => $owner, ':type' => $type));
                
                $blog =  $query->fetchObject(__CLASS__);
                switch ($blog->type) {
                    case 'node':
                        $blog->node = $blog->owner;
                        break;
                    case 'project':
                        $blog->project = $blog->owner;
                        break;
                }
                $blog->posts = Blog\Post::getAll($blog->id);
                return $blog;
        }

        public function validate (&$errors = array()) {
            return true;
        }

        /*
         *  Para cuando se publica un proyecto o se crea un nodo
         */
        public function save (&$errors = array()) {
            if (!$this->validate($errors)) return false;

            $fields = array(
                'id',
                'type',
                'owner',
                'active'
                );

            $set = '';
            $values = array();

            foreach ($fields as $field) {
                if ($set != '') $set .= ", ";
                $set .= "`$field` = :$field ";
                $values[":$field"] = $this->$field;
            }

            try {
                $sql = "REPLACE INTO blog SET " . $set;
                self::query($sql, $values);
                if (empty($this->id)) $this->id = self::insertId();

                return true;
            } catch(\PDOException $e) {
                $errors[] = "No se ha guardado correctamente. " . $e->getMessage();
                return false;
            }
        }

    }
    
}