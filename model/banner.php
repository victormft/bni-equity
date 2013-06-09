<?php

namespace Equity\Model {

    use Equity\Library\Text,
        Equity\Model\Project,
        Equity\Model\Image,
        Equity\Library\Check;

    class Banner extends \Equity\Core\Model {

        public
            $id,
            $node,
            $project,
            $image,
            $order;

        /*
         *  Devuelve datos de un banner de proyecto
         */
        public static function get ($project, $node = \EQUITY_NODE) {
                $query = static::query("
                    SELECT  
                        banner.id as id,
                        banner.node as node,
                        banner.project as project,
                        project.name as name,
                        banner.image as image,
                        banner.order as `order`
                    FROM    banner
                    INNER JOIN project
                        ON project.id = banner.project
                    WHERE banner.project = :project
                    AND banner.node = :node
                    ", array(':project'=>$project, ':node'=>$node));
                $banner = $query->fetchObject(__CLASS__);

                $banner->image = Image::get($banner->image);



                return $banner;
        }

        /*
         * Lista de proyectos en banners
         */
        public static function getAll ($node = \EQUITY_NODE) {

            // estados
            $status = Project::status();

            $banners = array();

            $query = static::query("
                SELECT
                    banner.id as id,
                    banner.project as project,
                    project.name as name,
                    project.status as status,
                    banner.image as image,
                    banner.order as `order`
                FROM    banner
                INNER JOIN project
                    ON project.id = banner.project
                WHERE banner.node = :node
                ORDER BY `order` ASC
                ", array(':node' => $node));
            
            foreach($query->fetchAll(\PDO::FETCH_CLASS, __CLASS__) as $banner) {
                $banner->image = Image::get($banner->image);
                $banner->status = $status[$banner->status];
                $banners[] = $banner;
            }

            return $banners;
        }

        /*
         * Lista de proyectos disponibles para destacar
         */
        public static function available ($current = null, $node = \EQUITY_NODE) {

            if (!empty($current)) {
                $sqlCurr = " AND banner.project != '$current'";
            } else {
                $sqlCurr = "";
            }

            $query = static::query("
                SELECT
                    project.id as id,
                    project.name as name,
                    project.status as status
                FROM    project
                WHERE status > 2
                AND status < 6
                AND project.id NOT IN (SELECT project FROM banner WHERE banner.node = :node{$sqlCurr} )
                ORDER BY name ASC
                ", array(':node' => $node));

            return $query->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
        }


        public function validate (&$errors = array()) {
            /*
            if (empty($this->node))
                $errors[] = 'Falta nodo';
                //Text::get('mandatory-banner-node');
*/
            if (empty($this->project))
                $errors[] = 'Falta proyecto';
                //Text::get('validate-banner-noproject');

            if (empty($this->image))
                $errors[] = 'Falta imagen';
                //Text::get('validate-banner-noproject');

            if (empty($errors))
                return true;
            else
                return false;
        }

        public function save (&$errors = array()) {
            if (!$this->validate($errors)) return false;

            // Imagen de fondo de banner
            if (is_array($this->image) && !empty($this->image['name'])) {
                $image = new Image($this->image);
                if ($image->save()) {
                    $this->image = $image->id;
                }
            }

            $fields = array(
                'node',
                'project',
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
                $sql = "REPLACE INTO banner SET " . $set;
                self::query($sql, $values);
                if (empty($this->id)) $this->id = self::insertId();

                return true;
            } catch(\PDOException $e) {
                $errors[] = "No se ha guardado correctamente. " . $e->getMessage();
                return false;
            }
        }

        /*
         * Para quitar un proyecto banner
         */
        public static function delete ($project, $node = \EQUITY_NODE) {
            
            $sql = "DELETE FROM banner WHERE project = :project AND node = :node";
            if (self::query($sql, array(':project'=>$project, ':node'=>$node))) {
                return true;
            } else {
                return false;
            }

        }

        /*
         * Para que un proyecto salga antes  (disminuir el order)
         */
        public static function up ($project, $node = \EQUITY_NODE) {
            $extra = array (
                    'node' => $node
                );
            return Check::reorder($project, 'up', 'banner', 'project', 'order', $extra);
        }

        /*
         * Para que un proyecto salga despues  (aumentar el order)
         */
        public static function down ($project, $node = \EQUITY_NODE) {
            $extra = array (
                    'node' => $node
                );
            return Check::reorder($project, 'down', 'banner', 'project', 'order', $extra);
        }

        /*
         *
         */
        public static function next ($node = \EQUITY_NODE) {
            $query = self::query('SELECT MAX(`order`) FROM banner WHERE node = :node'
                , array(':node'=>$node));
            $order = $query->fetchColumn(0);
            return ++$order;

        }


    }
    
}