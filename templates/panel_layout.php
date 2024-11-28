<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/panel.css?<?= time() ?>">
    <?= $loader ?>
    <title>Ministage | Dashboard</title>
</head>
<body>
    <aside>
        <div id="hero">
            <img id="avatar" src="../img/logo.png">
            <h1><?= $user->getFirstname() ?> <?=  $user->getLastname() ?></h1>
        </div>
        <nav>
        <ul>
            <li><a href="./home">Accueil</a></li>
            <?php 
                if ($isAdmin) {
            ?>
            <li><a href="./users">Utilisateurs</a>
            <?php 
                }
            ?>
            <li><a href="./slots">Stages</a></li>
            <li><a href="./requests">Demandes</a></li>
            <li id="logout"><a href="logout">Déconnexion</a></li>
        </ul>
        </nav>
    </aside>
    <main>
        <?= $content ?>
    </main>
<?= $script ?>
</body>
</html>