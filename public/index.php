<?php

use Reelz222z\Cryptoexchange\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';

// Set up Twig
$loader = new FilesystemLoader(__DIR__ . '/../src/View');
$twig = new Environment($loader);

// Set up the router
$router = new Router();

// Define routes
$router->get('/', [Reelz222z\Cryptoexchange\Controller\HomeController::class, 'index']);
$router->get('/about', [Reelz222z\Cryptoexchange\Controller\HomeController::class, 'about']);
$router->get('/contact', [Reelz222z\Cryptoexchange\Controller\HomeController::class, 'contact']);
$router->get('/login', [Reelz222z\Cryptoexchange\Controller\AuthController::class, 'login']);
$router->post('/login', [Reelz222z\Cryptoexchange\Controller\AuthController::class, 'login']);
$router->get('/register', [Reelz222z\Cryptoexchange\Controller\AuthController::class, 'register']);
$router->post('/register', [Reelz222z\Cryptoexchange\Controller\AuthController::class, 'register']);
$router->get('/logout', [Reelz222z\Cryptoexchange\Controller\AuthController::class, 'logout']);
$router->get('/crypto', [Reelz222z\Cryptoexchange\Controller\CryptoController::class, 'index']);
$router->get('/crypto/{id}', [Reelz222z\Cryptoexchange\Controller\CryptoController::class, 'show']);
$router->get('/crypto/create', [Reelz222z\Cryptoexchange\Controller\CryptoController::class, 'create']);
$router->post('/crypto/create', [Reelz222z\Cryptoexchange\Controller\CryptoController::class, 'create']);
$router->get('/crypto/edit/{id}', [Reelz222z\Cryptoexchange\Controller\CryptoController::class, 'edit']);
$router->post('/crypto/edit/{id}', [Reelz222z\Cryptoexchange\Controller\CryptoController::class, 'edit']);
$router->get('/portfolio', [Reelz222z\Cryptoexchange\Controller\CryptoController::class, 'portfolio']);
$router->get('/dashboard', [Reelz222z\Cryptoexchange\Controller\HomeController::class, 'dashboard']);

// Run the router
$response = $router->run();
echo $twig->render($response['template'], $response['params']);
