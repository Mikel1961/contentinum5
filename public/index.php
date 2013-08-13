<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
define('REQUEST_MICROTIME', microtime(true));
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

define('DS', DIRECTORY_SEPARATOR);
// Define root path
$parts = explode(DS, realpath(dirname(__FILE__) . '/..'));
define("CON_ROOT_PATH", implode(DS, $parts));
$parts = explode(DS, realpath(dirname(__FILE__)));
define("DOCUMENT_ROOT", implode(DS, $parts));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
