<?php


define('EQUITY_PATH', __DIR__ . DIRECTORY_SEPARATOR);
if (function_exists('ini_set')) {
    ini_set('include_path', EQUITY_PATH . PATH_SEPARATOR . '.');
} else {
    throw new Exception("No puedo añadir la API EQUITY al include_path.");
}

// Nodo actual
define('EQUITY_NODE', 'goteo');

define('PEAR', EQUITY_PATH . 'library' . '/' . 'pear' . '/');
if (function_exists('ini_set')) {
    ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . PEAR);
} else {
    throw new Exception("No puedo añadir las librerías PEAR al include_path.");
}

if (!defined('PHPMAILER_CLASS')) {
    define ('PHPMAILER_CLASS', EQUITY_PATH . 'library' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'class.phpmailer.php');
}
if (!defined('PHPMAILER_LANGS')) {
    define ('PHPMAILER_LANGS', EQUITY_PATH . 'library' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'language' . DIRECTORY_SEPARATOR);
}
if (!defined('PHPMAILER_SMTP')) {
    define ('PHPMAILER_SMTP', EQUITY_PATH . 'library' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'class.smtp.php');
}
if (!defined('PHPMAILER_POP3')) {
    define ('PHPMAILER_POP3', EQUITY_PATH . 'library' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'class.pop3.php');
}

// Metadata
define('EQUITY_META_TITLE', 'EQUITY.org  Crowdfunding the commons');
define('EQUITY_META_DESCRIPTION', 'Red social de financiacion colectiva');
define('EQUITY_META_KEYWORDS', 'crowdfunding, procomun, commons, social, network, financiacion colectiva, cultural, creative commons, proyectos abiertos, open source, free software, licencias libres');
define('EQUITY_META_AUTHOR', 'Onliners Web Development');
define('EQUITY_META_COPYRIGHT', 'Fundación Fuentes Abiertas');

// Database
define('EQUITY_DB_DRIVER', 'mysql');
define('EQUITY_DB_HOST', 'localhost');
define('EQUITY_DB_PORT', 3306);
define('EQUITY_DB_CHARSET', 'UTF-8');
define('EQUITY_DB_SCHEMA', 'equity');
define('EQUITY_DB_USERNAME', 'root');
define('EQUITY_DB_PASSWORD', '');

//Uploads i catxe
define('EQUITY_DATA_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);

// Mail
define('EQUITY_MAIL_FROM', 'victormft@gmail.com');
define('EQUITY_MAIL_NAME', 'victormft');
define('EQUITY_MAIL_TYPE', 'mail');
define('EQUITY_MAIL_SMTP_AUTH', true);
define('EQUITY_MAIL_SMTP_SECURE', 'ssl');
define('EQUITY_MAIL_SMTP_HOST', '');
define('EQUITY_MAIL_SMTP_PORT', 465);
define('EQUITY_MAIL_SMTP_USERNAME', '');
define('EQUITY_MAIL_SMTP_PASSWORD', '');

define('EQUITY_MAIL', 'victormft@gmail.com');

// Language
define('EQUITY_DEFAULT_LANG', 'en');
// name of the gettext .po file (used for admin only texts at the moment)
define('EQUITY_GETTEXT_DOMAIN', 'messages');
// gettext files are cached, to reload a new one requires to restart Apache which is stupid (and annoying while 
//	developing) this setting tells the langueage code to bypass caching by using a clever file-renaming 
// mechanism described in http://blog.ghost3k.net/articles/php/11/gettext-caching-in-php
define('EQUITY_GETTEXT_BYPASS_CACHING', true);

// url
define('SITE_URL', 'http://localhost/equity');
define('SRC_URL', 'http://localhost/equity');

// Cron params
define('CRON_PARAM', '');
define('CRON_VALUE', '');

// Código liberado
define('EQUITY_FREE', true);