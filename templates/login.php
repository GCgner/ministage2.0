<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel='stylesheet' type='text/css' media='screen' href='css/login.css?<?= time() ?>'>
    <script src="https://kit.fontawesome.com/c0f7d5b473.js" crossorigin="anonymous"></script>
    <title>Ministage | Connexion</title>
</head>
<body id="body_login">
    <div id="bg"></div>
    <div id="bloc-top">
        <div id="bloc"></div>
        <form id="form_login" action="login" method="POST">
            <h2><span>Ministage</span> | Connexion</h2>
            <p id="para_connexion">Utilisez vos identifiants pour vous connecter à votre compte : </p>
            <?php
                if(isset($error)) {
                    ?>
                    <div id="err">
                    <p>Vos identifiants sont incorrect</p>
                    </div>
                    <?php
                }
            ?>
            <div id="div_email">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                <input placeholder="Email" id="input_email" type="text" name="email" required></div>
            <div id="div_password">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                <input placeholder="Mot de passe" id="input_password" type="password" name="password" required></div>
            <div id="div_connexion">
                <div>
                <p>Mot de passe oublié ? Cliquez <a href="./?action=forgot">ici</a></p>
                </div>
                <input id="btn" type="submit" name="submit" value="connexion">
            </div>
        </form>
    </div>
</body>
</html>