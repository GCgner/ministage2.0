<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel='stylesheet' type='text/css' media='screen' href='css/mainForm.css?<?= time() ?>'>
    <script src="https://kit.fontawesome.com/c0f7d5b473.js" crossorigin="anonymous"></script>
    <title>Ministage | Demande</title>
</head>
<body id="body_request">
    <div id="bg"></div>
    <div id="bloc"></div>
    <form id="form_request" action="/create-request" method="POST">
        <div id="form_head">
            <h2><span>Ministage</span> | Demande</h2>
            <p id="para_request">Remplissez le formulaire pour faire une demande de stage : </p>
        </div>
        <?php
            if(isset($error)) {
                ?>
                <div id="err">
                <p>Vos identifiants sont incorrect</p>
                </div>
                <?php
            }
        ?>
        <div class="div_input" id="div_firstname">
            <Label for="input_firstname">Prénom :</Label>
            <input placeholder="Prénom" id="input_firstname" type="text" name="firstname" required>
        </div>
        <div class="div_input" id="div_lastname">
            <label for="input_lastname">Nom de famille :</label>
            <input placeholder="Nom de famille" id="input_lastname" type="text" name="lastname" required>
        </div>
        <div class="div_input" id="div_class">
            <label for="input_class">Classe :</label>
            <input placeholder="Classe" id="input_class" type="text" name="class" required>
        </div>
        <div class="div_input" id="div_birthday">
            <label for="input_birthday">Date de naissance :</label>
            <input id="input_birthday" type="date" name="birthday" value="2000-01-01" min="2000-01-01" max="<?php date("Y-m-d") ?>" required>
        </div>
        <div class="div_input" id="div_parent_firstname">
            <label for="input_parent_firstname">Prénom du parent :</label>
            <input placeholder="Prénom du parent" id="input_parent_firstname" type="text" name="parent_firstname" required>
        </div>
        <div class="div_input" id="div_parent_lastname">
            <label for="input_parent_lastname">Nom de famille du parent :</label>
            <input placeholder="Nom de famille du parent" id="input_parent_lastname" type="text" name="parent_lastname" required>
        </div>
        <div class="div_input" id="div_address">
            <label for="input_adress">Adresse :</label>
            <input placeholder="Adresse" id="input_address" type="text" name="address" required>
        </div>
        <div class="div_input" id="div_phone">
            <label for="input_phone">Téléphone :</label>
            <input placeholder="Téléphone" id="input_phone" type="tel" name="phone" required>
        </div>
        <div class="div_input" id="div_email">
            <label for="input_email">Email :</label>
            <input placeholder="Email" id="input_email" type="email" name="email" required>
        </div>
        <div class="div_input" id="div_main_teacher">
            <label for="input_main_teacher">Professeur(e) principal(e) :</label>
            <input placeholder="Professeur(e) principal(e)" id="input_main_teacher" type="text" name="main_teacher" required>
        </div>
        <div class="div_input" id="div_slot">
            <label for="input_slot">Stage :</label>
            <select id="input_slot" name="slot" required>
                <option value="0">Choisissez un stage</option>
                <?php
                    foreach($slots as $slot) {
                        ?>
                        <option value="<?= $slot->getSlotId() ?>"><?= $slot->getSector() ?> - <?= $slot->getDateStart()->format("d/m/Y H:i:s") ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div id="div_request">
            <input id="btn" type="submit" name="submit" value="Envoyer">
            <a href="login">Connexion</a>
        </div>
    </form>
</body>
</html>