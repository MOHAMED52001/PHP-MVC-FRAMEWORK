<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;

$app = new Application(dirname(__DIR__));
$controller = new SiteController();
$auth = new AuthController();


$app->router->get("/", [$controller, 'home']);

$app->router->get("/contact", [$controller, 'contact']);
$app->router->post("/contact", [$controller, 'handleContact']);

$app->router->get("/login", [$auth, 'login']);
$app->router->post("/login", [$auth, 'login']);

$app->router->get("/register", [$auth, 'register']);
$app->router->post("/register", [$auth, 'register']);



$app->run();
