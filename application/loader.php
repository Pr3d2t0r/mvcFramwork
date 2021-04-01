<?php
    // inicia a sessão caso seja nessesario
    session_start();

if ( !defined('DEBUG') || DEBUG === false ) {

    // Php para de reportar erros
    error_reporting(0);
} else {
    // php reporta todos os erros
    error_reporting(E_ALL);
}

require APPLICATIONPATH . '/libraries/autoloader.php';
require APPLICATIONPATH . '/libraries/util.php';
require_once APPLICATIONPATH . '/controllers/HomeControler.php';
require_once APPLICATIONPATH . '/controllers/LoginController.php';
require_once APPLICATIONPATH . '/controllers/RegisterController.php';
require_once APPLICATIONPATH . '/controllers/adminController.php';
require_once APPLICATIONPATH . '/pageHandlers/LoginHandler.php';
require_once APPLICATIONPATH . '/pageHandlers/HomeHandler.php';
require_once APPLICATIONPATH . '/pageHandlers/RegisterHandler.php';
$app = new Application();
$app->router->get('/', new HomeControler);
$app->router->get('home/', new HomeControler);
$app->router->post('home/', new HomeHandler);
$app->router->get('login/', new LoginController);
$app->router->post('login/', new LoginHandler);
$app->router->get('register/', new RegisterController);
$app->router->post('register/', new RegisterHandler);
$app->router->get('admin/', new AdminController);
$app->run();
