<?php

namespace Equity\Core {

    class DB extends \PDO {

        public function __construct() {

            $dsn = \EQUITY_DB_DRIVER . ':host=' . \EQUITY_DB_HOST . ';dbname=' . \EQUITY_DB_SCHEMA;

            if (defined('EQUITY_DB_PORT')) {
                $dsn .= ';port=' . \EQUITY_DB_PORT;
            }

            //If you use the UTF-8 encoding, you have to use the fourth parameter :
            if (defined('EQUITY_DB_CHARSET') && EQUITY_DB_DRIVER == 'mysql') {
                parent::__construct($dsn, \EQUITY_DB_USERNAME, \EQUITY_DB_PASSWORD, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            }
			else {
				parent::__construct($dsn, \EQUITY_DB_USERNAME, \EQUITY_DB_PASSWORD);
			}

            $this->setAttribute(static::ATTR_ERRMODE, static::ERRMODE_EXCEPTION);
        }

    }

}
