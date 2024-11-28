<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel='stylesheet' type='text/css' media='screen' >
    <script src="https://kit.fontawesome.com/c0f7d5b473.js" crossorigin="anonymous"></script>
    <title>NextBe | Inscription</title>
</head>
<body id="body_signup">
    <div id="bg"></div>
    <form id="form_signup" action="signup" method="post">
        <h2><span>NextBe</span> | Connexion</h2>
        <p id="para_connexion">Utilisez vos identifiants pour vous connecter à votre compte : </p>
        <?php
            if(isset($err)) {
                ?>
                <div id="err">
                    <p><?= $err ?></p>
                </div> 
                <?php
            }
        ?>  
            <div class="input_container">
                <span>
                    Prénom <input type="text" name="firstname" id="input_firstname">
                </span>
                <br>
                <span>
                    Nom de famille <input type="text" name="lastname" id="input_lastname">
                </span>
            </div>
        </div>
        <div id="div_email" class="container single">
            <span>
                E-mail <input type="email" name="email" id="input_email">
            </span>
        </div>
        <div id="div_password" class="container multiple">
            <span>
                Mot de passe <input type="password" name="password" id="input_password">
            </span> 
            <br>          
            <span>
                Confirmer mot de passe <input type="password" name="confirm" id="input_confirm">
            </span>
        </div>
        <div id="div_phone" class="container single">
            <span>
                Téléphone <input type="tel" name="phone" id="input_phone">
            </span>
        </div>
        <div id="div_birthday" class="container single">
            <span>
                Date de naissance <input type="date" name="birthday" id="input_birthday">
            </span>
        </div>
        <div id="div_address" class="container multiple">
            <span>
                Adresse <input type="text" name="address" id="input_address">
                <br>
                Code Postal <input type="text" name="postal" id="input_postal">
                <br>
                Pays <input type="text" name="country" id="input_country">
            </span>
        </div>
        <button type="submit">S'inscrire</button>
    </form>
    
</body>
</html>