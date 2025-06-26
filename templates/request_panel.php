<?php

use Application\Lib\Tools;

ob_start();

?>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<!-- <link rel="stylesheet" href="../css/reservations.css"> -->
<?php

$loader = ob_get_clean();

ob_start();

?>
<article id="main-menu">
    <div class="title-div">
        <h1>Demandes :</h1>
    </div>
     <div class="container">
        <a href="create-request2">
            <button class="btn create">
                Créer une demande
            </button>
        </a>
        <div>
            <form action="delete-request" method="post">
                <select name="userId" id="selector">
                    <option value="0" default>Sélectionner une demande</option>
                </select>
                <button id="pre-suppr" class="btn delete" type="disabled">Supprimer une demande</button>
                <div id="modal" class="inactive">
                    <div class="modal-in">
                        <h3>Attention !</h3>
                        <p>
                            Vous êtes sur le point de supprimer une demande, cette action n'est pas réversible.
                            </br>
                            Êtes-vous certain de vouloir supprimer <strong id="strong"></strong> ?
                        </p>
                        <div>
                            <button class="btn delete" type="submit">Supprimer</button>
                            <button class="btn create" id="back" type="disabled">Annuler</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

      <div class="data">
        <table id='table'>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom de famille</th>
                    <th>Classe</th>
                    <th>Date de naissance</th>
                    <th>Prénom du parent</th>
                    <th>Nom de famille du parent</th>
                    <th>Adresse</th>
                    <th>Numéro de téléphone du parent</th>
                    <th>Email du parent</th>
                    <th>Professeur(e) Principal(e)</th>
                    <th>Acceptée</th>
                    <th>Valider</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    foreach($requests as $row)
                    {
                        ?>
                        <tr>
                            <td><?= $row->getFirstname(); ?></td>
                            <td><?= $row->getLastname(); ?></td>
                            <td><?= $row->getClass(); ?></td>
                            <td><?= $row->getBirthday()->format("d-m-Y H:i:s"); ?></td>                        
                            <td><?= $row->getParentFirstname(); ?></td>
                            <td><?= $row->getParentLastname(); ?></td>
                            <td><?= $row->getAddress(); ?></td>
                            <td><?= $row->getPhone(); ?></td>
                            <td><?= $row->getEmail(); ?></td>
                            <td><?= $row->getMainTeacher(); ?></td>
                            <td><?= $row->getAccepted() ? 'Oui' : 'Non'; ?></td>
                            <td><a class="link-vld"href="valid-request/<?= $row->getRequestId(); ?>"><?= $row->getAccepted() ? '<button class="vld-btn decline">X</button>' : '<button class="vld-btn accept">V</button>'?></a></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
     </div>
</article>
<?php

$content = ob_get_clean();

ob_start();

?>
<script>
    $(document).ready( function () {
        $('#table').DataTable();
    } );
</script>
<script>
    const selector = document.getElementById('selector');
    const prebtn = document.getElementById('pre-suppr'); 
    const strong = document.getElementById('strong');
    const modal = document.getElementById('modal');
    // const back = docuemnt.getElementById('back');

    prebtn.onclick = (e) => {
        e.preventDefault();
        e.stopPropagation();
        strong.innerText = selector.options[selector.selectedIndex].text;
        modal.classList.remove('inactive');
    };

    back.onclick = (e) => {
        e.preventDefault();
        e.stopPropagation();
        modal.classList.add('inactive');
    };
</script>
<?php

$script = ob_get_clean();

require_once('panel_layout.php');