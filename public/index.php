<?php

ini_set("display_errors", "on");

function dump($var)
{
    echo '<pre>', var_dump($var), '</pre>';
    die();
}

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('CORE', ROOT . DS . 'framework');
define('TEMPLATE', ROOT . DS . 'app' . DS . 'View' . DS);

require '../vendor/autoload.php';

use Framework\Configuration\ConfigurationParser;
use Framework\Kernel;

$config = new ConfigurationParser();

$config->register('Application', 'application.php');
$config->register('Database', 'database.php');
$config->register('Routes', 'routes.php');

$application = new Kernel($config->getApplication(), $config);

$application->getResponse();
