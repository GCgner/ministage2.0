<?php

session_start();

require 'Autoloader.php';

use Application\Lib\Tools;
use Application\Router\MainRouter;

// Initialisation de l'utilisateur par défaut si non connecté
if (!isset($_SESSION['user'])) {
    Tools::defaultUser();
}

// Définir le chemin de base de l'application
$base = '/GitHub/ministage2.0';
$uri = str_replace($base, '', $_SERVER['REQUEST_URI']);

// Initialisation des messages flash s'ils ne sont pas définis
$_SESSION['err'] ??= null;
$_SESSION['success'] ??= null;

// Création du routeur principal
$router = new MainRouter($uri);

// === ROUTES === //

// Page d'accueil / formulaire principal
$router->get('/', 'MainForm#execute');

// Route corrigée : Enregistrement d'une demande
$router->post('/create-request', 'Request#createRequest');

// Authentification
$router->get('/login', 'Login#execute');
$router->post('/login', 'Login#login');
$router->get('/logout', 'Login#logout');

// Inscription
$router->get('/signup', 'Signup#execute');
$router->post('/signup', 'Signup#signup');

// Accueil du panel
$router->get('/home', 'Panel#home');

// Gestion des utilisateurs
$router->get('/users', 'User#userPanel');
$router->get('/create-user', 'User#createUserMenu');
$router->post('/create-user', 'User#createUser');
$router->post('/delete-user', 'User#deleteUser');

// Gestion des créneaux
$router->get('/slots', 'Slot#slotPanel');
$router->get('/create-slot', 'Slot#createSlotMenu');
$router->post('/create-slot', 'Slot#createSlot');
$router->post('/delete-slot', 'Slot#deleteSlot');

// Gestion des demandes
$router->get('/requests', 'Request#requestPanel');
$router->get('/validate-request', 'Request#validRequest');

// Lancer le routeur
$router->run();

// Nettoyage des messages flash
unset($_SESSION['err'], $_SESSION['success']);