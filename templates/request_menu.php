<?php

use Application\Lib\Tools;

ob_start();
$loader = ob_get_clean();

ob_start();
?>
    <article id="main-menu">
        <div class="data">
            <form action="create-request3" method="post">
                <?php if ($_SESSION['err']): ?>
                    <div class="error"><?= $_SESSION['err'] ?></div>
                    <?php unset($_SESSION['err']); ?>
                <?php endif; ?>

                <?php if ($_SESSION['success']): ?>
                    <div class="success">Demande envoyée avec succès !</div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <div class="div_input" id="div_firstname">
                    <label for="input_firstname">Prénom :</label>
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
                    <input id="input_birthday" type="date" name="birthday" value="2000-01-01" min="2000-01-01" max="<?= date("Y-m-d") ?>" required>
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
                    <label for="input_address">Adresse :</label>
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
                        <?php if (isset($slots) && is_array($slots)): ?>
                            <?php foreach($slots as $slot): ?>
                                <option value="<?= $slot->getSlotId() ?>">
                                    <?= $slot->getSector() ?> - <?= $slot->getDateStart()->format("d/m/Y H:i:s") ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option disabled>Aucun stage disponible</option>
                        <?php endif; ?>
                    </select>
                </div>


                <div class="container">
                    <input type="submit" class="btn create" value="Créer">
                    <button type="reset" class="btn delete">Effacer</button>
                </div>
            </form>
        </div>
    </article>
<?php
$content = ob_get_clean();
$script = '';
require_once('panel_layout.php');
