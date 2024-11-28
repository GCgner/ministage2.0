<?php

use Application\Lib\Tools;

ob_start();

?>
<link rel="stylesheet" href="../css/account.css">
<?php

$loader = ob_get_clean();

ob_start();

?>
<div class="title-div">
    <h1>Vos informations :</h1>
</div>
<div class="data">
    <div class="container">
        <div class="title-div">
            <h3>Nom et prénom</h3>
        </div>
        <div class="info">
            <p><?= $user->getFirstname().' '.$user->getLastname() ?></p>    
        </div>
    </div>
    <div class="container">
        <div class="title-div">
            <h3>Email</h3>
        </div>
        <div class="info">
            <p><?= $user->getEmail() ?></p>    
        </div>
    </div>
    <div class="container">
        <div class="title-div">
            <h3>Téléphone</h3>
        </div>
        <div class="info">
            <p><?= $user->getPhone() ?></p>    
        </div>
    </div>
    <div class="container">
        <div class="title-div">
            <h3>Date de naissance</h3>
        </div>
        <div class="info">
            <p><?= $user->getBirthday()->format('d M. Y') ?></p>    
        </div>
    </div>
    <div class="container">
        <div class="title-div">
            <h3>Adresse</h3>
        </div>
        <div class="info">
            <p><?= $user->getAddress() ?></p>    
        </div>
    </div>
    <div class="container">
        <div class="title-div">
            <h3>Code postal</h3>
        </div>
        <div class="info">
            <p><?= $user->getPostalCode() ?></p>    
        </div>
    </div>
    <div class="container">
        <div class="title-div">
            <h3>Pays</h3>
        </div>
        <div class="info">
            <p><?= $user->getCountry() ?></p>    
        </div>
    </div>
    <div class="container">
        <div class="title-div">
            <h3>Date de création du compte</h3>
        </div>
        <div class="info">
            <p><?= $user->getBirthday()->format('d M. Y') ?></p>    
        </div>
    </div>
</div>
<?php

$content = ob_get_clean();

$script = '';

require_once($panel.'PanelLayout.php');