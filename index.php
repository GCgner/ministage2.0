<?php

session_start();

require 'Autoloader.php';

use Application\Lib\Tools;
use Application\Router\MainRouter;

if(!isset($_SESSION['user'])) Tools::defaultUser();

$uri = str_replace('Github/ministage2.0','',$_SERVER['REQUEST_URI']);

$_SESSION['err'] = isset($_SESSION['err']) ? $_SESSION['err'] : null;
$_SESSION['success'] = isset($_SESSION['success']) ? $_SESSION['success'] : null;

$router = new MainRouter($uri);

$router->get('/', 'MainForm#execute');
$router->post('/request', 'MainForm#request');
$router->post('/create-request', 'Request#createRequest');
$router->get('/login','Login#execute');
$router->post('/login','Login#login');
$router->get('/logout','Login#logout');
$router->get('/signup','Signup#execute');
$router->post('/signup','Signup#signup');
$router->get('/home','Panel#home');
$router->get('/users','User#userPanel');
$router->get('/slots','Slot#slotPanel');
$router->get('/requests','Request#requestPanel');
$router->get('/create-user','User#createUserMenu');
$router->post('/create-user','User#createUser');
$router->post('/delete-user','User#deleteUser');
// $router->get('/modify-user','');
// $router->post('/modify-user','');
$router->get('/create-slot','Slot#createSlotMenu');
$router->post('/create-slot','Slot#createSlot');
$router->post('/delete-slot','Slot#deleteSlot');
// $router->get('/modify-slot','');
// $router->post('/modify-slot','');
$router->post('/create-request','Request#createRequest');
$router->get('/valid-request/:id','Request#validRequest');
$router->get('/valid-request/:id','Request#validRequest');
$router->get('/valid-request/:id','Request#validRequest');



$router->run();