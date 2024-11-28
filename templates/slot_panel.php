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
        <h1>Stages :</h1>
    </div>
    <div class="container">
            <a href="create-slot">
                <button class="btn create">
                    Créer un stage
                </button>
            </a>
            <div>
                <form action="delete-slot" method="post">
                    <select name="slotId" id="selector">
                        <option value="0" default>Sélectionner un stage</option>
                        <?php 
                            foreach($slots as $row) {
                                ?>
                                <option value="<?= $row->getSlotId(); ?>"><?= $row->getSector().' '.$row->getDateStart()->format("d/m/Y H:i:s"); ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <button id="pre-suppr" class="btn delete" type="disabled">Supprimer un stage</button>
                    <div id="modal" class="inactive">
                        <div class="modal-in">
                            <h3>Attention !</h3>
                            <p>
                                Vous êtes sur le point de supprimer un stage, cette action n'est pas réversible.
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
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Filière</th>
                    <th>Places</th>
                    <th>Places restantes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($slots as $row)
                    {
                        ?>
                        <tr>
                            <td><?= $row->getDateStart()->format("d/m/Y H:i:s"); ?></td>
                            <td><?= $row->getDateEnd()->format("d/m/Y H:i:s"); ?></td>
                            <td><?= $row->getSector(); ?></td>
                            <td><?= $row->getMaxPlaces(); ?></td>
                            <td><?= $row->getMaxPlaces() - $row->getCountPlaces(); ?></td>  
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