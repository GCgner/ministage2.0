<?php

use Application\Lib\Tools;

ob_start();

?>
<?php

$loader = ob_get_clean();

ob_start();

?>
<article id="main-menu">
<div class="title-div">
    <h1><?= (!isset($userMod) || empty($userMod)) ? 'Création' : 'Modification'; ?> d'un utilisateur :</h1>
</div>
<?php 
    if(isset($success)) {
        if ($success) {
            ?>
                <div id="success">
                    L'utilisateur a bien été <?= (!isset($userMod) || empty($userMod)) ? 'créé' : 'modifié'; ?>
                </div>
            <?php
        } else {
            ?>
                <div id="err">
                    <?= $err ?>
                </div>
            <?php
        }
    }
?>
<div class="data">
    <form action="create-user" method="post">
        <div class="container">
            <div class="container">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname" required value="<?= (!isset($userMod) || empty($userMod)) ? '' : $userMod->getFirstname(); ?>">
            </div>
        </div>
        <div class="container">
            <div class="container">
                    <label>Nom de famille</label>
                    <input type="text" name="lastname" id="lastname" required value="<?= (!isset($userMod) || empty($userMod)) ? '' : $userMod->getLastname(); ?>">  
            </div>
        </div>
        <div class="container">
            <div class="container">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="<?= (!isset($userMod) || empty($userMod)) ? '' : $userMod->getEmail(); ?>">  
            </div>
        </div>
        <div class="container">
            <div class="container">
                <label for="email">Specialité</label>
                <input type="text" name="speciality" id="speciality" required value="<?= (!isset($userMod) || empty($userMod)) ? '' : $userMod->getSpeciality(); ?>">  
            </div>
        </div>
        <div class="container">
             <input type="submit" class="btn create" value="<?= (!isset($userMod) || empty($userMod)) ? 'Créer' : 'Modifier' ?>">
             <button type="reset" class="btn delete">Effacer</button>
        </div>
    </form>
</div>
</article>
<?php

$content = ob_get_clean();

$script = '';

require_once('panel_layout.php');