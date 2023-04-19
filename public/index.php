<?php

define('BASE_PATH',__DIR__ . '/../');
require BASE_PATH . 'core/functions.php';
require base_path('vendor/autoload.php');
define('CONTROLLERS_PATH', base_path('controllers/'));
define('STYLES_CONFIG', require base_path('config/styles.php'));
define('ENV_FILE', base_path('env.local.ini'));

$router = new \Core\Router();
require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri,$method);
