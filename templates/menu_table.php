<?php
    $title = 'Gestion des '.$tableName;

    ob_start();
?>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<?php

    $loader = ob_get_clean();

    ob_start();
?>
<h1><?= $title ?></h1>
<form action="?action=delete&what=<?= $table ?>" method="post">
    <table id="table" class="display">
        <thead>
            <tr>
                <?php
                    foreach($propertieName as $propertie)
                    {
                        if(str_starts_with($propertie,'id'))
                        {
                            ?>
                            <th>Sélection</th>
                            <?php
                        }
                        else
                        {
                            ?>
                            <th><?= $propertie ?></th>
                            <?php
                        }
                    }
                ?>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 0; 
                foreach($data as $row)
                {
                    ?>
                    <tr>
                        <?php
                            $c = 0;
                            foreach($properties as $propertie)
                            {
                                $functionName = str_replace('_','',ucwords($propertie,'_'));
                                $function = 'get'.$functionName;

                                if($c === 0)
                                {
                                    $display = '<input type="checkbox" name="'.$i.'" value="'.$row->{$function}().'">';
                                    $functionId = $function;
                                    $c ++;
                                }
                                elseif(is_bool($row->{$function}()))
                                {
                                    if($row->{$function}()) $display = 'Oui';
                                    else $display = 'Non';
                                }
                                else
                                {
                                    $display = $row->{$function}();
                                }
                                ?>
                                <td><?= $display ?></td>
                                <?php
                            }
                            $i ++;
                        ?>
                        <td>
                            <a href="?action=modify&what=<?= $table ?>&id=<?= $row->{$functionId}() ?>"><button>Modifier</button></a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</form>
<?php
    $content = ob_get_clean();

    ob_start();
?>
<script>
    $(document).ready( function () {
        $('#table').DataTable();
    } );
</script>
<?php
    $script = ob_get_clean();
    require('layout.php');
?>


