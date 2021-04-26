<?php

namespace App;

use App\{Controllers\AuthController,
    Controllers\ContactController,
    Controllers\SiteController
};

require_once __DIR__.'/../config/init.php';


$router->get('/', [SiteController::class, 'home']);
$router->get('/home', [SiteController::class, 'home']);
$router->get('/test', [SiteController::class, 'test']);
$router->get('/about', [SiteController::class, 'about']);
$router->get('/contact', [SiteController::class, 'contact']);
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/contact', [ContactController::class, 'contact']);
$router->post('/register', [AuthController::class, 'register']);
$app->run();
