<?php

// tableau slide 63
$etudiantsNote = [
    "JOHN"   => 9,
    "BOB"    => 15.5,
    "RAYANE" => 7,
    "ROSIE"  => 13
];
function estAdmissible($note) {
    return $note >= 10;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Etudiants-Note</title>
</head>
<body>
    <table id="table1" border="1">
        <tr>
            <th>Etudiant</th>
            <th>Note</th>
        </tr>
        <?php
        // foreach slide 69
        foreach ($etudiantsNote as $nom => $note) {
            // if/else : slide 67
            if (estAdmissible($note)) {
                $couleur = "rgb(136,248,136)";
            } else {
                $couleur = "rgb(251,173,173)"; 
            }

            echo '<tr class="row">';
            echo '<td class="etud">' . $nom . '</td>';
            echo '<td class="note" style="background-color: ' . $couleur . ';">' . $note . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>