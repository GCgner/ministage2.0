<?php 

$fold = substr_count($_SERVER['REQUEST_URI'],'/');
$p = '';

if($fold > 2) $p = '.';

use Application\Lib\Tools;

$account = Tools::getSessionUserId() == 1 ? ['login','Connexion'] : ['panel','Mon Compte'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $p ?>./css/main.css?<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600&display=swap" rel="stylesheet">
    <?= $loader ?>
    <title>Ministage | <?= $title ?></title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?= $p ?>./">Accueil</a></li>
                <li><a href="<?= $p ?>./tickets">Billets</a></li>
                <li><a href="<?= $p ?>./<?= $account[0] ?>"><?= $account[1] ?></a></li>
            </ul>
        </nav>
    <main>
        <?= $content ?>
    </main>
    <footer>
        
    </footer>
</body>
</html>
