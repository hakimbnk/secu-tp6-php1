<?php
// Tableau associatif  slide ??

$serveurs = [
    "api-01"   => ["cpu" => 45, "ram" => 60, "status" => "1"],
    "api-02"   => ["cpu" => 92, "ram" => 78, "status" => "1"],
    "db-prod"  => ["cpu" => 70, "ram" => 95, "status" => "1"],
    "web-01"   => ["cpu" => 30, "ram" => 40, "status" => "1"],
    "web-02"   => ["cpu" => 55, "ram" => 65, "status" => "0"],
    "cache-01" => ["cpu" => 88, "ram" => 92, "status" => "1"]
];


$totalOnline = 0;   
$sommeScores = 0;   
$bestScore   = -1;  
$bestServ    = ""; 
function calculerScore($cpu, $ram) {
    return 100 - ($cpu + $ram) / 2;
}
function estCritique($cpu, $ram) {
    return $cpu > 85 || $ram > 90;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Monitoring de serveurs</title>
</head>
<body>
    <table id="table1" border="1">
        <tr>
            <th>Serveur</th>
            <th>CPU%</th>
            <th>RAM%</th>
            <th>Status</th>
            <th>Score</th>
            <th>État</th>
        </tr>
        <?php
        // boucle foreach : slide 69
        foreach ($serveurs as $nom => $Val) {
            $cpu = $val["cpu"];
            $ram = $val["ram"];
            $online = ($val["status"] === "1");

            $score = calculerScore($cpu, $ram);
            $critique = estCritique($cpu, $ram);

            $status = $online ? "online" : "offline";

            // if / elseif / else : slide 67 
            if ($critique) {
                $etat = "CRITIQUE";
            } elseif ($score >= 50) {
                $etat = "OK";
            } else {
                $etat = "ATTENTION";
            }

            if (!$online) {
                $couleur = "rgb(200,200,200)";     
            } elseif ($critique) {
                $couleur = "rgb(255,180,180)";     
            } elseif ($score >= 50) {
                $couleur = "rgb(180,255,180)";      
            } else {
                $couleur = "rgb(255,220,150)";      
            }

            if ($online) {
                $totalOnline++;
            }

            $sommeScores += $score;

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestServ = $nom;
            }

            echo '<tr class="row" style="background-color: ' . $couleur . ';">';
            echo '<td class="serveur">' . $nom . '</td>';
            echo '<td class="cpu">' . $cpu . '</td>';
            echo '<td class="ram">' . $ram . '</td>';
            echo '<td class="status">' . $status . '</td>';
            echo '<td class="score">' . $score . '</td>';
            echo '<td class="etat">' . $etat . '</td>';
            echo '</tr>';
        }

        $moyScores = $sommeScores / count($serveurs);
        ?>
    </table>

    <h3>Résumé</h3>
    <p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
    <p>Score moyen: <span id="moy_scores"><?php echo $moyScores; ?></span></p>
    <p>Meilleur serveur: <span id="best_serv"><?php echo $bestServ . " (" . $bestScore . ")"; ?></span></p>
    
</body>
</html>