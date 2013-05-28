<?php


namespace Equity\Controller {

    use Equity\Core\Error,
		Equity\Library\WallFriends,
        Equity\Model;

    class Wof extends \Equity\Core\Controller {

        public function index($id, $width = 608, $all_avatars = 1) {
			if($wof = new WallFriends($id,$all_avatars)) {
				echo $wof->html($width);
			}
			else {
				throw new Error(Error::NOT_FOUND);
			}
        }

    }

}
