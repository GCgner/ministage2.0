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
        <h1>Utilisateurs :</h1>
    </div>
    <div class="container">
        <a href="create-user">
            <button class="btn create">
                Créer un utilisateur
            </button>
        </a>
        <div>
            <form action="delete-user" method="post">
                <select name="userId" id="selector">
                    <option value="0" default>Sélectionner un utilisateur</option>
                    <?php
                        foreach($users as $row) {
                            ?>
                            <option value="<?= $row->getUserId(); ?>"><?= $row->getFirstname().' '.strtoupper($row->getLastname()); ?></option>
                            <?php
                        }
                    ?>
                </select>
                <button  class="btn delete" type="submit">Supprimer un utilisateur</button>

            </form>
        </div>
    </div>
    <div class="data">
        <table id='table'>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom de famille</th>
                    <th>Email</th>
                    <th>Spécialité</th>
                    <th>Administrateur</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($users as $row)
                    {
                        ?>
                        <tr>
                            <td><?= $row->getFirstname(); ?></td>
                            <td><?= $row->getLastname(); ?></td>
                            <td><?= $row->getEmail(); ?></td>
                            <td><?= $row->getSpeciality(); ?></td>
                            <td><?= $row->getIsAdmin() ? 'Oui' : 'Non'; ?></td>
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