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
    <h1><?= (!isset($slotMod) || empty($slotMod)) ? 'Création' : 'Modification'; ?> d'un stage :</h1>
</div>
<?php 
    if(isset($success)) {
        if ($success) {
            ?>
                <div id="success">
                    Le stage a bien été <?= (!isset($slotMod) || empty($slotMod)) ? 'créé' : 'modifié'; ?>
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
    <form action="create-slot" method="post">
        <div class="container">
            <div class="container">
                <label for="date_start">Date de début</label>
                <input type="datetime-local" name="date_start" id="date_start" required value="<?= (!isset($slotMod) || empty($slotMod)) ? '' : $slotMod->getDateStart(); ?>">
            </div>
        </div>
        <div class="container">
            <div class="container">
                    <label for="date_end">Date de fin</label>
                    <input type="datetime-local" name="date_end" id="date_end" required value="<?= (!isset($slotMod) || empty($slotMod)) ? '' : $slotMod->getDateEnd(); ?>">  
            </div>
        </div>
        <div class="container">
            <div class="container">
                <label for="sector">Filière</label>
                <input type="text" name="sector" id="sector" required value="<?= (!isset($slotMod) || empty($slotMod)) ? '' : $slotMod->getSector(); ?>">  
            </div>
        </div>
        <div class="container">
            <div class="container">
                <label for="max_places">Nombre de places</label>
                <input type="number" name="max_places" id="max_places" required value="<?= (!isset($slotMod) || empty($slotMod)) ? '' : $slotMod->getMaxPlaces(); ?>">  
            </div>
        </div>
        <div class="container">
             <input type="submit" class="btn create" value="<?= (!isset($slotMod) || empty($slotMod)) ? 'Créer' : 'Modifier' ?>">
             <button type="reset" class="btn delete">Effacer</button>
        </div>
    </form>
</div>
</article>
<?php

$content = ob_get_clean();

$script = '';

require_once('panel_layout.php');