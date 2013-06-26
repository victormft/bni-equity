<?php


namespace Equity\Library {

	use Equity\Core\Model,
        Equity\Core\Exception;

	/*
	 * Clase para dividir una lista de proyectos en agruopaciones de 3 o 2 proyectos
	 */
    class Listing {

        public static function get($projects = array(), $each = 3) {

                $g = 1;
                $c = 1;
                foreach ($projects as $k=>$project) {
                    // al grupo
                    $list[$g]['items'][] = $project;

                    // cada 3 mientras no sea el ultimo
                    if (($c % $each) == 0 && $c<count($projects)) {
                        $list[$g]['prev'] = ($g-1);
                        $list[$g]['next'] = ($g+1);
                        $g++;
                    }
                    $c++;
                }

                $list[1]['prev']  = $g;
                $list[$g]['prev'] = $g == 1 ? 1 : ($g-1);
                $list[$g]['next'] = 1;

                return $list;
        }

    }
}